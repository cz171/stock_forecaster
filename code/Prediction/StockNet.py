#!/usr/bin/env python

import csv
import numpy as np
import lasagne
import lasagne.updates
import nolearn.lasagne
import pymysql
import json
import sys
# -------- Load in whole year every day close prices as TrainingPrices ------------
# -------- File path ------


db_conn = pymysql.connect(host='localhost',  user='root', passwd='ninolg',db='YUE')
coursor = db_conn.cursor()

s1=sys.argv[1]

end=s1[len(s1)-10:]
start=s1[len(s1)-20:len(s1)-10]
name=s1[0:len(s1)-20]

#print (start)
#print (end)
#print (name)

s11="SELECT * FROM  "+" "+name+" "+"WHERE DATE BETWEEN"+" '"+start+"' "+"AND"+" '"+end+"'"
#print (start)
#print (end)
#print (name)


#print(s11)


coursor.execute(s11)
data=coursor.fetchall()

StartPrice=[]
for row in data:
	#print (row[4])
	StartPrice.append(float(row[4]))

ClosePrice=[]

for i in range(0,len(StartPrice)):
	ClosePrice.append(StartPrice[len(StartPrice)-1-i])


market_vibration = 5
# -------- Create Training set --------

# print ClosePrice                                          # 251 items
# print ('ClosePrice length is ' + str(len(ClosePrice)))
TrainingPrices = ClosePrice[0:len(ClosePrice)-1]
# print TrainingPrices                                      # 250 items
# print ('TestPrices length is ' + str(len(TrainingPrices)))


# --------- Create time stamp for Training Prices -----------
predict_l=32;
TimeStamp = range(1, len(ClosePrice) + predict_l+1)
PredictTimeStamp = len(ClosePrice)                          # The last time stamp is the day we want to predict
# print TimeStamp                                           # TimeStamp 1-251

# --------- Create the input X based on the order M -------------
M=100
#M = int(input('Please input M (integer >0): '))
X = np.mat(TimeStamp).T
X_M = np.mat(np.zeros(shape=(len(ClosePrice)+predict_l, M+1)))
# print X
for i in range(0, M+1):
    X_temp = np.power(X, i)
    X_M[:, i] = X_temp
X = X_M                 # 251*(M+1) Matrix, first column elements are all "1"s, and then in order 1, order 2 ...order M
# print X

# --------- Reshape the input X into [0,1] -------------
X = X/X[len(ClosePrice)-1, M]  # scale pixel values to [0, 1], 251*(M+1)
X = X.astype(np.float32)
X_full = X                                                  # save the original X
X_last = X[-1, :]                                           # save the last X to make prediction
X = X[0:-1, :]
# print X

# --------- Reshape the label y(prices) into [-1, 1] -------------
Max = max(ClosePrice)
Min = min(ClosePrice)
Average = (Max + Min)/2
Distance = max(ClosePrice) - Average
y = np.subtract(ClosePrice, Average)
y = np.divide(y, Distance)                                  # y is in the range [-1, 1]
y = np.mat(y)
y = y.T
y = y.astype(np.float32)
y_full = y                                                  # save the original y
y_last = y[-1]                                              # save the true last y to compare prediction
y = y[0:-1, :]

# --------- Construct Neural Network ------------

net1 = nolearn.lasagne.NeuralNet(
    layers=[  # three layers: one hidden layer
        ('input', lasagne.layers.InputLayer),
        ('hidden', lasagne.layers.DenseLayer),
        ('output', lasagne.layers.DenseLayer),
        ],
    # layer parameters:
    input_shape=(None, M+1),  # 96x96 input pixels per batch
    hidden_num_units=100,  # number of units in hidden layer
    output_nonlinearity=None,  # output layer uses identity function
    output_num_units=1,  # 30 target values

    # optimization method:
    update=lasagne.updates.nesterov_momentum,
    update_learning_rate=0.01,
    update_momentum=0.1,

    regression=True,  # flag to indicate we're dealing with regression problem
    max_epochs=60,  # we want to train this many epochs
    verbose=0,
    )

net1.fit(X, y)



y_predict = net1.predict(X)
row, col = y_predict.shape
y_predict = y_predict*Distance+Average
for i in range(0, row):
    y_predict[i] += np.random.normal(0, market_vibration)  # add price vibration into consideration

std_p=np.mean(y_predict[len(ClosePrice):-1])
mean_p=np.std(y_predict[len(ClosePrice):-1])

std_l=np.std(ClosePrice[len(ClosePrice)-predict_l:-1])
mean_l=np.mean(ClosePrice[len(ClosePrice)-predict_l:-1])

#abs_error = np.absolute(y_predict-np.mat(ClosePrice[0:-1]).T)
#relative_error = abs_error/np.mean(ClosePrice[0:-1])

#print (float(y_predict[1]))
#print(std_p)
#print(mean_p)

#print(std_l)
#print(mean_l)

print(y_predict[len(ClosePrice):-1])




#1 
if mean_p>mean_l and std_p<std_l:
	print('Strong Buy')
#2 
if mean_p>mean_l and std_p>std_l:
	print('Positive Hold')
#3 
if mean_p<mean_l and std_p<std_l:
	print('Negative Hold')
#4 
if mean_p<mean_l and std_p>std_l:
	print('Strong Sell')








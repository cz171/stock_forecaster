#!/usr/bin/env python

import csv
import numpy as np
import scipy as Sci
import scipy.linalg as la
import sys
import json
import pymysql
import matplotlib.pyplot as plt

db_conn = pymysql.connect(host='localhost',  user='root', passwd='ninolg',db='REAL_TIME_YUE')
coursor = db_conn.cursor()



name=sys.argv[1]
#name='goog'
s11="SELECT * FROM  "+" "+name
#print(s11)

coursor.execute(s11)
data=coursor.fetchall()

StartPrice=[]
for row in data:
	#print (row[4])
	StartPrice.append(float(row[0]))

ClosePrice=[]

for i in range(0,len(StartPrice)):
	ClosePrice.append(StartPrice[len(StartPrice)-1-i])



#print (ClosePrice[len(ClosePrice)-1])


# ------------ Initialize -------------- #
Beta = 1

Alpha = 0.01
M = 2

#print ("h1")
# -------- load in every day close prices as TestPrices ------------ #
#ClosePrice = []
     


###decide dataset namely: how many training data are used to train bayesian

data_set=len(ClosePrice)
TestPrices = ClosePrice[0:data_set]
#print(TestPrices)
# create time stamp for test prices
TimeStamp = range(1, len(TestPrices) + 1)
#print (TimeStamp)


# ================== Define some functions ======================= #
# ----------- Calculate phi according to input x ------------ #
def phi(x):
    exponent = np.mat(range(0, M + 1))
    phi_x = np.power(x, exponent).T
    return phi_x
# x = 2
# print phi(x)


# ---------- Calculate sum_phi_xn ------------- #
def sum_phi_xn(xn):
    sum_phi = np.mat(np.zeros([M+1, M+1]))
    for i in range(0, len(xn)):
        sum_phi = sum_phi + phi(xn[i])*phi(xn[i]).T
    return sum_phi
# print sum_phi_xn(TimeStamp)
# print sum_phi_n(TimeStamp)


# ---------- Calculate sum_phi_xn_tn ------------- #
def sum_phi_xn_tn(xn, tn):
    sum_phi = np.mat(np.zeros([M + 1, 1]))
    for i in range(0, len(xn)):
        sum_phi = sum_phi + phi(xn[i]) * tn[i]
    return sum_phi
# print sum_phi_xn_tn(TimeStamp,TestPrices)


# ---------- Calculate S inverse -------------- #
def s_inv(xn):
    s_inverse = Alpha * np.mat(np.identity(M + 1)) + Beta * sum_phi_xn(xn)
    return s_inverse
# print s_inv(TimeStamp,2)


# ------------- Calculate m(x) according to input x ---------------- #
def m_x(xn, tn, x):
    mx = Beta * phi(x).T * la.pinv(s_inv(xn)) * sum_phi_xn_tn(xn, tn)
    return mx
# mx = m_x(TimeStamp,TestPrices,2)
# print mx


# ------------- Calculate S2_x according to input x ---------------- #
def sigma2_x(xn, x):
    sigma2x = np.power(Beta, -1) + phi(x).T * la.pinv(s_inv(xn)) * phi(x)
    return sigma2x


# ================== Start prediction ============================ #
# ----------- Normalization ------------ #


# ------------- Output the predicted values with de-normalization ----------- #
predict_l=10;
mu = np.mat(np.zeros([predict_l, 1]))
#sigma = np.mat(np.zeros([predict_l, 1]))
#sum_p is the summation for the 10 predict value
#sum_b is the summation for the 10 latest value
#print(len(ClosePrice))
for i in range(data_set, data_set+predict_l):
    mu[i-data_set] = m_x(TimeStamp, TestPrices, i+1)
    #print(i)
    #sigma[i-data_set] = np.power(sigma2_x(TimeStamp, i+1), 0.5)

mean_p=np.mean(mu)
std_p=np.std(mu)


print (mu) 
#print(mean_p)
#print(std_p)
#print (sigma[data_set+1])
# print x
# print output
###############get the latest 10 value
latest=np.mat(np.zeros([predict_l,1]))

for i in range(0,predict_l):
    latest[i]=TestPrices[data_set-1-i];

mean_l=np.mean(latest)
std_l=np.std(latest)
#print(latest)
#print(mean_l)
#print(std_l)

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
#######################################
TimeStamp = range(1, predict_l + 1)
fig=plt.figure()
x1=np.asarray(TimeStamp)
y1=np.asarray(mu)
plt.plot(x1,y1,'ro-')
plt.show()

















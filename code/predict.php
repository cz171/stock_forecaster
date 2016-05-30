<!--
Written & debugged by
	Chengguang Xu
	Jian Ren
	Yan Kang
	Yue Song
	Zhan Chen
Apr.30 2015
@All copyright reserved.
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
div#gallery {height:280px;}
div#shit{float:left;width:300px;}
div#fuck{float:right;width:300px;}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Stock forecaster</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="css/templatemo_style.css" rel="stylesheet" type="text/css" />
<link href="css_pirobox/white/style.css" media="screen" title="shadow" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/piroBox.1_2.js"></script>
</head>

<body>

<div id="templatemo_header_wrapper">
	<div id="templatemo_header">

		<div id="site_title">
            <h1><a href="index.html">
                <strong>Stock Forecaster</strong>
                <span>Free stock price prediction provider</span>   
            </a></h1>
        </div>
        
        <div id="templatemo_menu">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.html">About system</a></li>
                <li><a href="services.php">Stoc kData</a></li>
                <li><a href="predict.php"  class="current">Prediction</a></li>
                <li><a href="contact.html">Contact Us</a></li>
            </ul>    	
    	</div> <!-- end of templatemo_menu -->
        
        <div class="cleaner"></div>
	</div> <!-- end of header -->
</div> <!-- end of header_wrapper -->

<div id="templatemo_content_wrapper">
	<div id="templatemo_content">
    	
        <h1>Prediction</h1>
<div id="gallery"> 
	<div id="shit">
		  <h2>Long term:</h2>
                  <p><?php include 'tablelist.php'?></p>
	</div>
	<div id="fuck">
		  <h2>Short term:</h2>
		  <p><?php include 'shortterm.php'?></p> 

<img src=<?php echo $figure ?> height="420" width="420">

</div>



 </div>

<div class="cleaner"></div>
                </div>
    
    	<div class="cleaner"></div>
	</div> <!-- end of content -->
</div> <!-- end of content_wrapper -->

<div id="templatemo_footer_wrapper">
	<div id="templatemo_footer">
    
    	<div class="footer_box">
        
        	<h3>Website of Group 4</h3>
        
            <ul class="footer_menu">
                <li>Chengguang Xu</li>
                <li>Jian Ren</li>
                <li>Yan Kang</li>                	
		<li>Yue Song</li> 
                <li>Zhan Chen</li>              
            </ul>

        </div>
        
        <div class="footer_box">
        
            <div class="footer_menu">
            
                <h3>Navigation</h3>
    
                <ul class="footer_menu">
                    <li><a href="index.php"">Home</a></li>
                <li><a href="about.html">About System</a></li>
                <li><a href="services.php">Stock Data</a></li>
                <li><a href="predict.php">Prediction</a></li>
                <li><a href="contact.html">Contact Us</a></li>
                </ul>
                
            </div>
		</div>
        
        <div class="footer_box">
        
            <div class="footer_menu">
            
              <h3>About Us</h3>
    			
                 <img src="images/group4.png" alt="about us" />
                
            </div>
            
        </div>
	
    	<div class="cleaner"></div>
    </div> <!-- end of footer -->
</div> <!-- end of footer wrapper -->    

<div id="templatemo_copyright_wrapper">
	<div id="templatemo_copyright">
    
		Copyright © 2015 Software Engnieering II Web Application  Group 4
        
    </div> <!-- end of templatemo_copyright -->
</div> <!-- end of copyright wrapper -->
</body>
</html>

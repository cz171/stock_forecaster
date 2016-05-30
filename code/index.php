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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Stock forecaster</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="css/templatemo_style.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.ennui.contentslider.css" rel="stylesheet" type="text/css" media="screen,projection" />
</head>
<body>
<div id="templatemo_header_wrapper">
	<div id="templatemo_header">

		<div id="site_title">
            <h1><a href="index.php">
                <strong>Stock Forecaster</strong>
                <span>Free stock price prediction provider</span>     
            </a></h1>
        </div>
        
        <div id="templatemo_menu">
            <ul>
                <li><a href="index.php" class="current">Home</a></li>
                <li><a href="about.html">About system</a></li>
                <li><a href="services.php">Stock Data</a></li>
                <li><a href="predict.php">Prediction</a></li>
                <li><a href="contact.html">Contact Us</a></li>
            </ul>    	
    	</div> <!-- end of templatemo_menu -->
        
        <div class="cleaner"></div>
	</div> <!-- end of header -->
</div> <!-- end of header_wrapper -->

<div id="templatemo_slider_wrapper">
	<div id="templatemo_slider">
    
        <div id="one" class="contentslider">
        <div class="cs_wrapper">
            <div class="cs_slider">
            
                <div class="cs_article">
                	
                    <div class="article">
                
                        <div class="left">
                            <h2>Tech Companies Line Up Behind Surveillance Reform Bill</h2>
                            <p>A wide range of companies today released their support for a surveillance reform bill that would effectively end the NSA’s bulk collection of Americans’ phone records.

 </p>
  
                        </div>                         
                        
                        <div class="right">
                            <a href="http://techcrunch.com/2015/04/29/tech-companies-line-up-behind-surveillance-reform-bill/">
                                <img src="images/nsa-image.jpg" alt="template 1" />
                            </a>
                        </div>
                        
                    </div>
                    
                </div><!-- End cs_article -->
                
                <div class="cs_article">
                   <div class="article">
                
                        <div class="left">
                            <h2>Apple Watch Review</h2>
                            <p>The Apple Watch is now on the wrists of members of the general public for the first time, and opinions about its usefulness are flying fast and furious.</p>
                          
                       </div>
                        
                        <div class="right">
                            <a href="http://techcrunch.com/2015/04/29/apple-watch-review/#.mke40e:Pz5x">
                                <img src="images/slider/templatemo_slide02.jpg" alt="template 2" />
                            </a>
                        </div>
                        
                    </div>
                </div><!-- End cs_article -->
                
                <div class="cs_article">
                    <div class="article">
                
                        <div class="left">
                            <h2>Microsoft Launches Its .NET Distribution For Linux And Mac</h2>
                            <p>Last November, Microsoft said that it would bring some of the core features of its .NET platform — which has traditionally been Windows-only — to Linux and Mac. </p>
                         </div>   
                        
                        <div class="right">
                            <a href="http://techcrunch.com/2015/04/29/microsoft-launches-its-net-distribution-for-linux-and-mac/#.mke40e:Psmy">
                                <img src="images/slider/templatemo_slide03.jpg" alt="template 3" />
                            </a>
                        </div>
                        
                    </div>
                </div><!-- End cs_article -->
                
                <div class="cs_article">
                   <div class="article">
                
                        <div class="left">
                            <h2>Tencent Will Pay $126M For A 14.6% Stake In Glu Mobile, Maker Of Kim Kardashian: Hollywood</h2>
                            <p>Tencent, one of China’s biggest Internet companies, has agreed to purchase a 14.6 percent stake in Glu Mobile.</p>
                           
                      </div>   
                        <div class="right">
                            <a href="http://techcrunch.com/2015/04/29/tencent-glu/">
                                <img src="images/slider/templatemo_slide04.png" alt="template 4" />
                            </a>
                        </div>
                        
                    </div>
                </div><!-- End cs_article -->
          
            </div><!-- End cs_slider -->
        </div><!-- End cs_wrapper -->
        </div><!-- End contentslider -->
        
        <!-- Site JavaScript -->
        <script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>
        <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
        <script type="text/javascript" src="js/jquery.ennui.contentslider.js"></script>
        <script type="text/javascript">
        $(function() {
        $('#one').ContentSlider({
        width : '910px',
        height : '250px',
        speed : 500,
        easing : 'easeOutQuart'
        });
        });
        </script>
        <script src="js/jquery.chili-2.2.js" type="text/javascript"></script>
        <script src="js/chili/recipes.js" type="text/javascript"></script>
	
    </div> <!-- end of slider -->
</div> <!-- end of slider_wrapper -->

<div id="templatemo_top_row_wrapper">
	<div id="templatemo_top_row">
    
    	<div class="top_row_box">
        	<h5>Google</h5>
        <p>
	<?php 
		$conn = new mysqli('localhost', 'root', 'ninolg', 'REAL_TIME_YUE');
     		$sql = "SELECT * FROM goog ORDER BY STOCK_TIME DESC LIMIT 1;";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		echo "Latest Stock Price : ".$row["STOCK_PRICE"]."<br>";
		echo "Time Achived : ".$row["STOCK_TIME"]."<br>";
		echo "Volume : ".$row["STOCK_VOLUME"]."<br>";
	?></p>
        
        </div>
        
        <div class="top_row_box">
        	<h5>Costco</h5>
          <p>
	<?php 
		$conn = new mysqli('localhost', 'root', 'ninolg', 'REAL_TIME_YUE');
     		$sql = "SELECT * FROM cost ORDER BY STOCK_TIME DESC LIMIT 1;";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		echo "Latest Stock Price : ".$row["STOCK_PRICE"]."<br>";
		echo "Time Achived : ".$row["STOCK_TIME"]."<br>";
		echo "Volume : ".$row["STOCK_VOLUME"]."<br>";
	?></p>
        </div>
        
        <div class="top_row_box last">
        	<h5>Twitter</h5>
         <p>
	<?php 
		$conn = new mysqli('localhost', 'root', 'ninolg', 'REAL_TIME_YUE');
     		$sql = "SELECT * FROM twtr ORDER BY STOCK_TIME DESC LIMIT 1;";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		echo "Latest Stock Price : ".$row["STOCK_PRICE"]."<br>";
		echo "Time Achived : ".$row["STOCK_TIME"]."<br>";
		echo "Volume : ".$row["STOCK_VOLUME"]."<br>";
	?></p>
        </div>
    
    	<div class="cleaner"></div>
    </div> <!-- end of top row -->
</div> <!-- end of top row wrapper -->
<div id="templatemo_top_row_wrapper">
	<div id="templatemo_top_row">
    
    	<div class="top_row_box">
        	<h5>Facebook</h5>
        <p>
	<?php 
		$conn = new mysqli('localhost', 'root', 'ninolg', 'REAL_TIME_YUE');
     		$sql = "SELECT * FROM fb ORDER BY STOCK_TIME DESC LIMIT 1;";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		echo "Latest Stock Price : ".$row["STOCK_PRICE"]."<br>";
		echo "Time Achived : ".$row["STOCK_TIME"]."<br>";
		echo "Volume : ".$row["STOCK_VOLUME"]."<br>";
	?></p>
        
        </div>
        
        <div class="top_row_box">
        	<h5>Baidu</h5>
        <p>
	<?php 
		$conn = new mysqli('localhost', 'root', 'ninolg', 'REAL_TIME_YUE');
     		$sql = "SELECT * FROM bidu ORDER BY STOCK_TIME DESC LIMIT 1;";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		echo "Latest Stock Price : ".$row["STOCK_PRICE"]."<br>";
		echo "Time Achived : ".$row["STOCK_TIME"]."<br>";
		echo "Volume : ".$row["STOCK_VOLUME"]."<br>";
	?></p>
        </div>
        
        <div class="top_row_box last">
        	<h5>Yahoo</h5>
        <p>
	<?php 
		$conn = new mysqli('localhost', 'root', 'ninolg', 'REAL_TIME_YUE');
     		$sql = "SELECT * FROM yhoo ORDER BY STOCK_TIME DESC LIMIT 1;";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		echo "Latest Stock Price : ".$row["STOCK_PRICE"]."<br>";
		echo "Time Achived : ".$row["STOCK_TIME"]."<br>";
		echo "Volume : ".$row["STOCK_VOLUME"]."<br>";
	?></p>
        </div>
    
    	<div class="cleaner"></div>
    </div> <!-- end of top row -->
</div> <!-- end of top row wrapper -->

<div id="templatemo_content_wrapper">
	<div id="templatemo_content">
    	
        <h1>What we do?</h1>
        <div class="image_wrapper fl_img">
	        <img src="images/templatemo_image_05.jpg" alt="image" width="120" height="120" />        </div>
        <p> We give you the latest stock news and price information.</p>
        <p>We can show you the procise figure for the stock price in any period you need!</p>
        <p>We use different algorithms to implement predictions for different term.</p>
      <div class="cleaner"></div>
	</div> <!-- end of content -->
</div> <!-- end of content_wrapper -->

<div id="templatemo_footer_wrapper">
	<div id="templatemo_footer">
    
    	<div class="footer_box">
        
        	<h3>Group 4 Members</h3>
        
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
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.html">About System</a></li>
                    <li><a href="services.php">Stock Data</a></li>
                    <li><a href="predict.php">Predict</a></li>
                    <li><a href="contact.html">Contact Us</a></li>
                </ul>
                
            </div>
		</div>
        
        <div class="footer_box">
        
            <div class="footer_menu">
    			
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

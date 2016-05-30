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

<!----------------------SELECT STOCK------------------------------------------>

<?php
$dbname = 'YUE';

if (!mysql_connect('localhost', 'root', 'ninolg')) {
    echo 'Could not connect to mysql';
    exit;
}

$sql = "SHOW TABLES FROM $dbname";
$result = mysql_query($sql);

$i=1;

while ($tabel = mysql_fetch_row($result))
{
     $list[$i] = $tabel[0];
     $i++;
}

mysql_free_result($result);
?>

<!----------------------SELECT STOCK ENDS------------------------------------>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Extreme Services - free web template</title>
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
		<li><a href="index.php">Home</a></li>
                <li><a href="about.html">About system</a></li>
                <li><a href="services.php" class="current">Stock Data</a></li>
                <li><a href="predict.php">Prediction</a></li>
                <li><a href="contact.html">Contact Us</a></li>
            </ul>    	
    	</div> <!-- end of templatemo_menu -->
        
        <div class="cleaner"></div>
	</div> <!-- end of header -->
</div> <!-- end of header_wrapper -->

<div id="templatemo_content_wrapper">
	<div id="templatemo_content">
        	<h2>Historical Stock Data Showcase</h2>         
      <div class="cleaner_h30"></div>
    
        <div class="services_section">
        
            
      <div class="two_column float_l">
             	<p>
		Please select your interested stock from the right.<br>
		The date formate should be like '2015-02-14'.<br>
		For the minimum, maximum or average price from a certain range, just tick the corresponding options.<br>
		Then, you can see a list of stocks which average price less than the selected value above, by select [Show Comparision Result].
	 	</p>
          </div>
                
            <div class="two_column float_r">
	<form name="form1" enctype="multipart/form-data" method="post" action=""> 
	Select a stock:	
	<select name="select"> 
	<?php foreach($list as $option) : ?>
		<option value="<?php echo $option; ?>"><?php echo $option; ?></option>
	<?php endforeach;?>
	</select><br>
	Start Date: <input type="text" name="start"><br>
        End   Date: <input type="text" name="end"><br>
        <input type="radio" name="method" value="MIN">Min
        <input type="radio" name="method" value="MAX">Max
        <input type="radio" name="method" value="AVG">Average<br>
        <input type="radio" name="threshold" value="selected">Show Comparision Result<br>
	<input type="submit"> 
</form> 
             
                
            </div>
                
			<div class="cleaner"></div>

        </div>
        
        <div id="container" style="height: 400px; min-width: 310px">
	<?php include 'drawfigure.php'
        ?>
        </div>
        
  <div class="services_section">


<!----------------------PHP SHOW GRAPH AND STOCK INFO------------------------>

<?php
//$tbname="BABA";
$tbname=$_POST['select'];
    echo "Selected Stock: ".$tbname."<br>";

$servername = "localhost";
$username = "root";
$password = "ninolg";
$dbname="YUE";

$start_time=$_POST['start'];
$end_time=$_POST['end'];

$method=$_POST['method'];
$threshold=$_POST['threshold'];

$sql = "SHOW TABLES FROM $dbname";
$result = mysql_query($sql);

$i=1;

while ($tabel = mysql_fetch_row($result))
{
     $list[$i] = $tabel[0];
     $i++;
}

if ($method)
{    
	$conn = new mysqli($servername, $username, $password,$dbname);
     	$sql = "SELECT $method(CLOSE) FROM $tbname WHERE DATE BETWEEN '$start_time' AND '$end_time'";		
     	$result = $conn->query($sql);  
        $row = $result->fetch_assoc();
	$current_value=$row["$method(CLOSE)"];
	echo $method." value from ".$start_time." to ".$end_time." is: ".$current_value."<br>";
	
	if($threshold)
	{				
		echo "Requested Stock List: <br>";		
		for($j=1; $j<$i; $j++)
		{
			//echo $i;     			
			$conn = new mysqli($servername, $username, $password,$dbname);
     			$sql =  "SELECT AVG(CLOSE) FROM $list[$j]";	
     			$result = $conn->query($sql);     
			$row = $result->fetch_assoc();
	                $avg = $row["AVG(CLOSE)"];
			#print_r ($row);
			if ($avg < $current_value) {
				echo $list[$j]."<br>";
			}
		}
	}
}
else
{
	$conn = new mysqli($servername, $username, $password,$dbname);
        if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
	} 
	$sql = "SELECT * FROM $tbname WHERE DATE BETWEEN '$start_time' AND '$end_time'";
	$result = $conn->query($sql);

        while($row = $result->fetch_assoc()) {
        echo  $row["DATE"]." ".$row["OPEN"]." ".$row["HIGH"]." ".$row["LOW"]." ".$row["CLOSE"]." ".$row["VOLUME"]." ".$row["ADJCLOSE"]."<br>";
        }
	$conn->close();	
}
?>

<!----------------------PHP SHOW GRAPH AND STOCK INFO END ---------------------->
          
               
                
			<div class="cleaner"></div>

        </div>
    
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
                <li><a href="about.html">About system</a></li>
                <li><a href="services.php">Stock Data</a></li>
                <li><a href="predict.php">Prediction</a></li>
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


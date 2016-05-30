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
$dbname = 'REAL_TIME_YUE';

if (!mysql_connect('localhost', 'root', 'ninolg')) {
    echo 'Could not connect to mysql';
    exit;
}

$sql = "SHOW TABLES FROM $dbname";
$result = mysql_query($sql);

$i=1;

while ($tabel = mysql_fetch_row($result))
{
     #echo $tabel[0]."<br>";
     $list[$i] = $tabel[0];
     #echo  $list[$i];
     $i++;
}

mysql_free_result($result);
?>
<!----------------------SELECT STOCK ENDS------------------------------------>


<!----------------------FORM OF STOCK---------------------------------------->

<form name="form2" enctype="multipart/form-data" method="post" action=""> 
	Select a stock:	
	<select name="select2"> 
	<?php foreach($list as $option) : ?>
		<option value="<?php echo $option; ?>"><?php echo $option; ?></option>
	<?php endforeach;?>
	</select><br>

	<input type="submit"> 
</form> 

<!----------------------FORMS END-------------------------------------------->

<!----------------------PHP SHOW GRAPH AND STOCK INFO------------------------>
<?php

$tbname=$_POST['select2'];
    echo $tbname."<br>";

$servername = "localhost";
$username = "root";
$password = "ninolg";
$dbname="YUE";

#
#
$s1=$tbname.$start_time.$end_time;

ob_start();
passthru('python2 /home/yue/Desktop/Prediction/curve_fitting.py '.$tbname);
$output = ob_get_clean();
echo $output;
//print_r ($list);	
$figure="images/".$tbname.".png"		
//$figure=$tbname;
?>
<!----------------------PHP SHOW GRAPH AND STOCK INFO END ---------------------->

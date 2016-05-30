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
     #echo $tabel[0]."<br>";
     $list[$i] = $tabel[0];
     #echo  $list[$i];
     $i++;
}

mysql_free_result($result);
?>
<!----------------------SELECT STOCK ENDS------------------------------------>


<!----------------------FORM OF STOCK---------------------------------------->

<form name="form1" enctype="multipart/form-data" method="post" action=""> 
	Select a stock:	
	<select name="select"> 
	<?php foreach($list as $option) : ?>
		<option value="<?php echo $option; ?>"><?php echo $option; ?></option>
	<?php endforeach;?>
	</select><br>
	Start Date: <input type="text" name="start"><br>
        End   Date: <input type="text" name="end"><br>

	<input type="submit"> 
</form> 

<!----------------------FORMS END-------------------------------------------->

<!----------------------PHP SHOW GRAPH AND STOCK INFO------------------------>

<?php

$tbname=$_POST['select'];
    echo $tbname."<br>";

$servername = "localhost";
$username = "root";
$password = "ninolg";
$dbname="YUE";

$start_time=$_POST['start'];
$end_time=$_POST['end'];

#
#
$s1=$tbname.$start_time.$end_time;

ob_start();
passthru('python /home/yue/Desktop/Prediction/StockNet.py '.$tbname.$start_time.$end_time);
$output = ob_get_clean();
echo $output;
/*
ob_start();
passthru('python /home/yue/Desktop/Prediction/StockNet2.py '.$tbname.$start_time.$end_time);
$output = ob_get_clean();
echo $output;
*/
//print_r ($list);			

//$figure="images/".$tbname.".png"

?>

<!----------------------PHP SHOW GRAPH AND STOCK INFO END ---------------------->


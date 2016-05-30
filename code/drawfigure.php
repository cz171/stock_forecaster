<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="http://code.highcharts.com/stock/highstock.js"></script>
<script src="http://code.highcharts.com/stock/modules/exporting.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- TemplateBeginEditable name="doctitle" -->
<title></title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>

<body>
<div id="container" style="height: 400px; min-width: 310px"></div>


<?php

$servername = "localhost";
$username = "root";
$password = "ninolg";
$dbname="YUE";
$tbname=$_POST['select'];

$start_time=$_POST['start'];
$end_time=$_POST['end'];

//$tbname="BABA";
echo $tbname;
$conn = new mysqli($servername, $username, $password,$dbname);
        if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
	} 
	$sql = "SELECT * FROM $tbname WHERE DATE BETWEEN '$start_time' AND '$end_time'";
	$result = $conn->query($sql);

	$i=0;
$zero='';
	if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        //echo  $row["DATE"]." ".$row["OPEN"]." ".$row["HIGH"]." ".$row["LOW"]." ".$row["CLOSE"]." ".$row["VOLUME"]." ".$row["ADJCLOSE"]."<br>";
	//$list[$i][0] = strtotime('$row["DATE"]')+'000';
        $list[$i][0] =  strtotime($row["DATE"].$zero)*1000;
	$list[$i][1] = (float)$row["OPEN"];
	$list[$i][2] = (float)$row["HIGH"];
	$list[$i][3] = (float)$row["LOW"];
	$list[$i][4] = (float)$row["CLOSE"];
	$list[$i][5] = (float)$row["VOLUME"];
	$i++;
        }
	} else {
    		echo "No stock info.";
	}
	$conn->close();	
	$i--;
//print_r($list);
//echo $end_time;
?>

<script>

$(function () {


var data = <?php echo json_encode($list); ?>;
 // document.write(data[12][1]);
// split the data set into ohlc and volume
  var length = <?php echo json_encode($i); ?>;
 //document.write(length);
  var ohlc = [];
  var volume = [];
 // data=[<?php echo join($list, ',') ?>]
//document.write(data[12][1]);
  //dataLength = data.length,

//document.write(dataLength);
  // set the allowed units for data grouping
  groupingUnits = [[
  'week',                         // unit name
  [1]                             // allowed multiples
  ], [
  'month',
  [1, 2, 3, 4, 6]
  ]],
  
  i = length-1;
  
//document.write('sddsff');

  
  for (i; i>=0; i -= 1) {
//document.write(data[i][0]);
//document.write(data[i][1]);
//document.write(data[i][2]);
//document.write(data[i][3]);
//document.write(data[i][4]);
//document.write(data[i][5]);
  ohlc.push([
			data[i][0], // the date
			data[i][1], // open
			data[i][2], // high
			data[i][3], // low
			data[i][4] // close
			//566.700,
			//571.000,
			//557.378,
		        //565.435
			]);

  //document.write(ohlc);
  volume.push([
			  data[i][0],
			  //4911800.32666666666777777777777
			  data[i][5], // the date
			  //data[i][5] // the volume
			  ]);

}
//document.write(volume);  
  
  // create the chart
  $('#container').highcharts('StockChart', {
							 
							 rangeSelector: {
							 selected: 1
							 },
							 
							 title: {
							 text: <?php echo json_encode($tbname); ?>
							 },
							 
							 yAxis: [{
							 labels: {
							 align: 'right',
							 x: -3
							 },
							 title: {
							 text: 'OHLC'
							 },
							 height: '60%',
							 lineWidth: 2
							 }, {
							 labels: {
							 align: 'right',
							 x: -3
							 },
							 title: {
							 text: 'Volume'
							 },
							 top: '65%',
							 height: '35%',
							 offset: 0,
							 lineWidth: 2
							 }],
							 
							 series: [{
							 type: 'candlestick',
							 name:  <?php echo json_encode($tbname); ?>,
							 data: ohlc,
							 dataGrouping: {
							 units: groupingUnits
							 }
							 },{
							 type: 'column',
							 name: 'Volume',
							 data: volume,
							 yAxis: 1,
							 dataGrouping: {
							 units: groupingUnits
							 }
							 }]
        });
  });


</script>
</body>
</html>

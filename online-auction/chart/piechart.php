<?php
//include 'config.php';
/*$link=mysql_connect("$hostname","$username","$password")or 
die('Could not connect: ' . mysql_error());
mysql_select_db("$dbname",$link);
include 'create.php';*/

//$connection=mysql_connect('localhost','root') or die('unable to connect');
        #echo 'select the database';
  //      mysql_select_db("chart");
         


    $connection=mysql_connect('localhost','root') or die('unable to connect'); 
     mysql_select_db("corner");



//connect to database
$sql=mysql_query("select price_average,lead_time_average,free_shipment_average,discount_average,warranty_average from matrix");



//$result = mysql_query($sql) or die(mysql_error());
$x = 0;
while($row = mysql_fetch_row($sql)){
    $array[$x] = $row;
    $x++;
}
//echo $array[0][0];//the first row's title
//echo $array[1][0];//the 12th row's episode number







$sql=mysql_query("select supplier_average from supplier_normalize");

//$result = mysql_query($sql) or die(mysql_error());
$x = 0;
while($row = mysql_fetch_row($sql)){
    $array1[$x] = $row;
    $x++;
}
//echo $array1[0][0];//the first row's title


$supplier1=$array[0][0] * $array1[0][0] + $array[0][1] * $array1[1][0] + $array[0][2] *      $array1[2][0] + $array[0][3] * $array1[3][0] + $array[0][4] * $array1[4][0];

$supplier2=$array[1][0] * $array1[0][0] + $array[1][1] * $array1[1][0] + $array[1][2] *      $array1[2][0] + $array[1][3] * $array1[3][0] + $array[1][4] * $array1[4][0];

$supplier3=$array[2][0] * $array1[0][0] + $array[2][1] * $array1[1][0] + $array[2][2] *      $array1[2][0] + $array[2][3] * $array1[3][0] + $array[2][4] * $array1[4][0];

$supplier4=$array[3][0] * $array1[0][0] + $array[3][1] * $array1[1][0] + $array[3][2] *      $array1[2][0] + $array[3][3] * $array1[3][0] + $array[3][4] * $array1[4][0];

$supplier5=$array[4][0] * $array1[0][0] + $array[4][1] * $array1[1][0] + $array[4][2] *      $array1[2][0] + $array[4][3] * $array1[3][0] + $array[4][4] * $array1[4][0];

/*###################### END OF SUPPLIER SCORE CODE ################################*/



$itemval=array();
$itemnam=array();

$itemnam = Array
          (
			  0 => "Supp-1",
			  1 => "Supp-2",
			  2 => "Supp-3",
			  3 => "Supp-4",
			  4 => "Supp-5",
			);

$itemval = Array
           (
		      0 => $supplier1,
			  1 => $supplier2,
			  2 => $supplier3,
			  3 => $supplier4,
			  4 => $supplier5,
			);

//$sql="SELECT xvalue,yvalue FROM piechart"; //field name for xaxis value and yaxis value
//$result = mysql_query($sql);
$img_height=550;
$img_width=500;
$radious=80;
$bar_width=6;
/*$i=0;
 while($inf = mysql_fetch_array($result)) 
  {
  $itemval[$i]=$inf[1]; 
  $itemnam[$i]=$inf[0];
  $i++;  
 }
 */
include 'piecolor.php';
include("pChart/pData.class");
include("pChart/pChart.class");
//$count=count($maxval);

 // Dataset definition 
 $DataSet = new pData;
 $DataSet->AddPoint($itemval,"Serie1");
 //print_r($DataSet);
 $DataSet->AddPoint($itemnam,"Serie2");
 $DataSet->AddAllSeries();
 $DataSet->SetAbsciseLabelSerie("Serie2");
 // Initialise the graph
 $Test = new pChart($img_width,$img_height);
 $Test->drawFilledRoundedRectangle(4,0,$img_width-5,$img_height,5,$baground_colr,$baground_colg,$baground_colb);//225,144,82);
 $Test->drawRoundedRectangle(5,0,$img_width-5,$img_height,5,$baground_colr,$baground_colg,$baground_colb);
 $Test->createColorGradientPalette(255,204,56,223,1,2,1);

 // Draw the pie chart
 $Test->setFontProperties("Fonts/tahoma.ttf",8);
 $Test->AntialiasQuality = 0;
 $Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),$img_width/2,$img_height/2,$radious,PIE_PERCENTAGE_LABEL,FALSE,50,20,5,"",$txtcolr,$txtcolg,$txtcolb);
 $Test->drawPieLegend($img_width-65,20,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);

 // Write the title
 $Test->setFontProperties("Fonts/tahoma.ttf",12);
 $Test->drawTitle(($img_width-50)/2,20,$title,$titcolr,$titcolg,$titcolb);

 $Test->Render("piechart.png");
echo "<img src='piechart.png'>";                                        
?>
<div style="font-size: 10px;color: #dadada;" id="dumdiv">
<a href="http://www.bmsit.org" id="dum" style=" padding-left:200px; text-decoration:none;color: #dadada;">&copy;h</a></div>

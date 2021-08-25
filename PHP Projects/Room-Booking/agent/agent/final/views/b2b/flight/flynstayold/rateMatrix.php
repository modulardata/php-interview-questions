<?php /*?><style type="text/css">
    table.ratematrix
    {
	width: 100%;
	padding: 0px;
	margin: 0px;
    }
    table.ratematrix td
    {
	border: 1px solid #ccc;
	padding: 2px;
	text-align: center;
	color: #323232;
    }

    table.ratematrix  tr:first-child td
    {
	color:#336699;
	font-weight:bold;
    }    
</style>
<?php
session_start();
error_reporting(E_NOTICE ^ E_ALL);

if ($_SESSION['f_Domestic'] == 2)
{
    $price = $_SESSION['priceAry'];
    $time = $_SESSION['timeAry'];
    $flights = $_SESSION['airlineAry'];
}

$bounds = array(0, 360, 720, 1080, 1440);
foreach ($bounds as $i => $b)
{
    $cycle = array_intersect($time, range($b, $bounds[$i + 1]));
    $flightsAtBound = array_intersect_key($flights, array_flip(array_keys($cycle)));
    $flightsUnique = array_unique($flightsAtBound);
    foreach ($flightsUnique as $k => $f)
    {
	$matrix[$i][$f] = min(array_intersect_key($price, array_flip(array_keys($flightsAtBound, $f))));
	$timeValues[$i][$f] = min(array_intersect_key($time, array_flip(array_keys($flightsAtBound, $f))));
    }
    //break;
    if ($b == 1080)
	break;
}

//$values = min(array_intersect_key($price,$keys));
$boundsNew = array("0 am-6am", "6am-12am", "12am-6pm", "6pm-12pm");
$fnames=array("AI"=>"Air India","SG"=>"Spice Jet","9W"=>"Jet Airways","S2"=>"Jet Lite","G8"=>"Go Air","6E"=>"Indigo");
echo "<table class='ratematrix' cellspacing='0' cellpadding='0'>";
foreach ($bounds as $i => $b)
{
    if ($i == 0)
    {
	echo "<tr>";
	echo "<td>Rate<br/>Matrix</td>";
	foreach (array_unique($flights) as $h => $airline)
	{
	    if ($_SESSION['f_Domestic'] == 1)
		echo "<td><img src='" . WEB_DIR . "flight_icons/" . $airline . ".gif' /><br/>".$fnames[$airline]."</td>";
	    else
		echo "<td><img src='" . WEB_DIR . "IntFlight/" . $airline . ".jpg' /><br/>".$fnames[$airline]."</td>";
	    
	}
	echo "</tr>";
    }
    echo "<tr>";
    echo "<td>" . $boundsNew[$i] . "</td>";
    foreach (array_unique($flights) as $key => $val)
    {
	if ($matrix[$i][$val] > 0)
	    echo "<td><a href='javascript:void(0);' class='showThisMatrixInfo' data-time='" . $timeValues[$i][$val] . "' data-price='" . $matrix[$i][$val] . "'>Rs " . $matrix[$i][$val] . "</a></td>";
	else
	    echo "<td>****</td>";
    }
    echo "<tr>";
    if ($b == 1080)
	break;
}
echo '</table>';
?>
<div style="text-align: right; margin-bottom:25px;">
    <a href='javascript:void(0);' class='ShowAllMatrix'>Show All</a>
</div><?php */?>

	<table width="100%" height="100%" class="tableDetails" border="1" bordercolor="#CCCCCC" cellspacing="0" cellpadding="0">
      <tr>
        <td style="width:16%;"><label><a href="#">Show all Airlines</a></label>
          <span class="marginLeft4"><img src="<?php echo WEB_DIR?>public/images/right-arrow.jpg" alt="rightArrow" /></span><br />
          <label><a href="#">Departure</a></label>
          <span class="marginLeft4"><img src="<?php echo WEB_DIR?>public/images/down-arrow.jpg" alt="down" /></span> 
        </td>
      <?php 
	  		
	  		$flightsUnique = array_unique($flights);
			//echo '<pre/>';print_r($flights);
			//echo '<pre/>';print_r($flightsUnique);
				
      foreach ($flights as $key => $val) {?>
        <td style="padding: 10px 0;">
        <table width="100%" class="spiceJet" border="0" cellspacing="0" align="center" cellpadding="0">
            <tr>
              <td><img src="http://www.cleartrip.com/images/logos/air-logos/<?php echo $key;?>.png" alt="icon" /></td>
            </tr>
            <tr>
              <td><?php echo $val;?></td>
            </tr>
            <tr>
              <td class="flights-results"><a href="#">3 Flights</a></td>
            </tr>
          </table>
          </td>
    <?php } ?>
      
      </tr>
      
      <tr bgcolor="#eff2f7">
        <td>05.00 - 12.00</td>
      <?php foreach ($flights as $key => $val) {?>
        <td><span  class="WebRupee">₹</span>4,851</td>
      
        <?php } ?>
      </tr>
      
      <tr>
        <td>05.00 - 12.00</td>
        <?php foreach ($flights as $key => $val) {?>
        <td><span  class="WebRupee">₹</span>4,851</td>
        
        <?php } ?>
      </tr>
      
      <tr bgcolor="#eff2f7">
        <td>05.00 - 12.00</td>
         <?php foreach ($flights as $key => $val) {?>
        <td><span  class="WebRupee">₹</span>4,851</td>
       
        <?php } ?>
      </tr>
      
      <tr>
        <td>05.00 - 12.00</td>
        <?php foreach ($flights as $key => $val) {?>
        <td><span  class="WebRupee">₹</span>4,851</td>
       
        <?php } ?>
      </tr>
      
    </table>
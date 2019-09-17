<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
 <title>::FlyNStay::</title>
<script src="<?php echo WEB_DIR ?>public/js/jquery-1.9.1.js"></script>
<script src="<?php echo WEB_DIR ?>public/js/jquery-ui.js"></script> 
 
<script type="text/javascript">

function call()
{	
	document.searchProgress.submit();
}

</script>

<script type="text/javascript">

var ray={
ajax:function(st)
	{
		this.show('load');
	},
show:function(el)
	{
		this.getID(el).style.display='';
	},
getID:function(el)
	{
		return document.getElementById(el);
	}
}
</script>
<style type="text/css">
#load{	
	text-align:center;	
	font-family:"Trebuchet MS", verdana, arial,tahoma;
	font-size:13pt;
}
</style>

</head>

<body onload="call()">
<form name="searchProgress" action="<?php print WEB_URL; ?>flight/search_progress" onSubmit="return ray.ajax()" method="post">

	<input name="api_name" type="hidden" value="<?php echo $api_name_f;?>" readonly />
</form>
		<table width="100%" cellspacing="5" cellpadding="5" border="0" align="center">
            <tbody>
                <tr>
                    <td align="center">
                    <div><img border='0' src="<?php echo WEB_DIR ?>public/images/logo.png" /></div><br/>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                    <div id="load" style="display:block;">Search in progress... Please wait... <br/><br/>
                    	<img border='0' src="<?php echo WEB_DIR ?>public/images/progressbar.gif" />
                    </div>
                        <br/>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <h4>  We're looking for all available flights for your search.</h4>
                        <table width="50%" cellspacing="5" cellpadding="5" border="0" bgcolor="#bebebe">
                            <tbody><tr bgcolor="#CCC" >
                                    <td width="37%">From</td>
                                    <td width="37%">To</td>
                                    <td width="26%">Travel Date</td>
                                </tr>
                           <?php 
							$session_data = $this->session->userdata('flight_search_data');
							$sess_tripType = $session_data['tripType'];
							$originCity = explode(',',$session_data['originCity']);
							$destinationCity = explode(',',$session_data['destinationCity']);
							$sess_departDate = $session_data['departDate'];
							$sess_returnDate = $session_data['returnDate'];
							?>
                                <tr bgcolor="#ffffff" >
                                    <td><?php echo $originCity[1];?> </td>
                                    <td><?php echo $destinationCity[1];?></td>
                                    <td>
									<?php 
									$sess_departDate = preg_replace('!^([0-9]{2})/([0-9]{2})/([0-9]{4})$!',"$3-$2-$1",$sess_departDate);
									
									echo date('D, j M',strtotime($sess_departDate));
								?>
                                    </td>
                                </tr>
                            <?php 		
							if($sess_tripType == 'R') {
							?>
                                <tr bgcolor="#ffffff">
                                    <td><?php echo $destinationCity[1];?></td>
                                    <td><?php echo $originCity[1];?> </td>
                                    <td>
									<?php 
									$sess_returnDate = preg_replace('!^([0-9]{2})/([0-9]{2})/([0-9]{4})$!',"$3-$2-$1",$sess_returnDate);
									echo date('D, j M',strtotime($sess_returnDate));
									?>
                                    </td>
                                </tr>
                           <?php } ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td valign="top" height="200px" align="center">
                        <table width="50%" height="250px" border="0">
                            <tr>
                            <td width="300px">
                        <img border="0" src="<?php echo WEB_DIR ?>public/images/advertisement/index1.jpg" style="width:300px;height:250px;" />
                        </td>
                                <td width="50%">
                       <img border="0" src="<?php echo WEB_DIR ?>public/images/advertisement/index2.jpg" style="width: 300px;height: 250px;" />
                                    
                                </td>
                                </tr>
                        </table>
                    </td>                   
                </tr>

            </tbody>
        </table>

</body>
</html>
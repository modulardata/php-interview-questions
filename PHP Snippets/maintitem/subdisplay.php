<?php
/* subdisplay.php 						*/
/* Copyright (C) 2005 Toivo Talikka                    */

/* This library is free software; you can redistribute it and/or modify it under the terms of 	*/
/* of the GNU Lesser General Public License as published by the Free Software Foundation; 	*/
/* either version 2.1 of the License, or any later version.					      	*/

/* This library is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;  	*/ 
/* without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  	*/
/* See the GNU Lesser General Public License for more details. 					*/

/* You should have received a copy of the GNU Lesser General Public License along with this 	*/
/* library; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, 	*/
/* Boston, MA 02111-1307 USA									     	*/
/*													     	*/	
/* The GNU Lesser General Public Licence (GPL) can be viewed at: 					*/
/*			http://www.opensource.org/licenses/lgpl-license.php				*/
/*														*/
/* Toivo Talikka can be contacted by email:	toivo@totaldata.biz				       */
/* ---------------------------------------------------------------------------------------------*/

/* ----------------------------------------------------*/
/* Modification history				  	*/
/* 08/12/05 TJT Initial version			  	*/
/*								*/
/*								*/
/*								*/
/*								*/
/* ----------------------------------------------------*/

/* ----------------------------------------------------*/
/* Functions						  	*/	
/* ---------							*/

/* display functions */
/* ----------------- */

/* display a page heading with application and company name */
function sub_company_heading($my_company, $module_name, $application = NULL, $heading = NULL, $text = NULL) {
 echo "<h1 class=\"head\">$application&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$my_company</h1>";
 echo "<h1 class=\"head\">$module_name</h1><hr />";  
 if (strlen(trim($heading))) {
   echo "<h2>$heading</h2>&nbsp;&nbsp;&nbsp;$text";
  }
 }

/* display a page heading and optional subheading and text message in bold */
function sub_heading($module_name, $heading = NULL, $text = NULL) {
 echo "<h1>$module_name</h1><hr />";
 if ( !$heading ) {
   echo "<h2>$heading</h2>&nbsp;&nbsp;&nbsp;$text";
 }
}

/* display a heading and a text message in bold */
function sub_message($msg_heading, $message = NULL) {
 echo "<div class=\"left\"><hr />";
 echo "<p>&nbsp;&nbsp;<i><b>$msg_heading &nbsp;&nbsp;&nbsp; $message</b></i></p></div>";
 echo "<div><p>&nbsp;</p></div>";
 return;
}

/* display an error message in italic and bold */
function sub_message_error($message) {
 echo "<div class=\"error\"><hr />";
 echo "<p>&nbsp;&nbsp;<i><b>Error: &nbsp;&nbsp;&nbsp; $message</b></i></p></div>";
 echo "<div><p>&nbsp;</p></div>";
 return;
}

/* display an information message in italic and bold */
function sub_message_info($message) {
 echo "<div class=\"info\"><hr />";
 echo "<p>&nbsp;&nbsp;<i><b>Information: &nbsp;&nbsp;&nbsp; $message</b></i></p></div>";
 echo "<div><p>&nbsp;</p></div>";
 return;
}

/* display a warning message in italic and bold */
function sub_message_warning($message) {
 echo "<div class=\"warning\"><hr />";
 echo "<p>&nbsp;&nbsp;<i><b>Warning: &nbsp;&nbsp;&nbsp; $message</b></i></p></div>";
 echo "<div><p>&nbsp;</p></div>";
 return;
}

/* display a message with return instruction */
function sub_message_back($msg_heading, $message) {
 $msg_one = strtoupper($msg_heading);
 $msg_two = strtoupper($message);
 echo "<div class=\"left\"><hr />";
 echo "<p>&nbsp;&nbsp;<i><b>$msg_one &nbsp;&nbsp;&nbsp; $msg_two</b></i> &nbsp;&nbsp; - use the BACK button to return</p></div>";
echo "<div><p>&nbsp;</p></div>";
}

/* button functions */
/* ---------------- */

/* button to submit and run module                      */
/* 1st parameter:  module name e.g. menu.php            */
/* 2nd parameter:  submit button text e.g. Menu         */
/* 3rd parameter:  text in 2nd button  - does this work? */

function sub_button($button_action, $button_1, $button_2 = NULL) {
  echo "<div class=\"left\"><form method=\"post\" action=\"$button_action\"> 
        <p><input type=\"submit\" value=\"$button_1\" name=\"$button_1\" /></p>";
 if (isset($button_2)) {
  echo "<p><input type=\"submit\" value=\"$button_2\" name=\"$button_2\" /></p>";
  }
 echo "</form></div>";
}

/* submit and reset buttons return to the same form  */

/* submit button  */
function sub_button_submit($button_text, $button_name) {
?>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<?php
  echo "<p><input type=\"submit\" value=\"$button_text\" name=\"$button_name\" /></p>
  </form>";
}

/* reset button */
function sub_button_reset($button_text, $button_name) {
?>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<?php
  echo "<p><input type=\"reset\" value=\"$button_text\" name=\"$button_name\" /></p>
  </form>";
}

/* one button */
function sub_button_one($button_action, $button) {
 echo "<form method=\"post\" action=$button_action>
  <p><input type=\"submit\" value=\"$button\" name=\"$button\" /></p>
  </form>";
}

/* two buttons */
function sub_button_two($button_action, $button_1, $button_2) {
 echo "<form method=\"post\" action=$button_action>
  <p><input type=\"submit\" value=\"$button_1\" name=\"$button_1\" /></p>
  <p><input type=\"submit\" value=\"$button_2\" name=\"$button_2\" /></p>
  </form>";
}

/* submit -return - etc buttons - obsolete  */
function sub_return($routine, $text) {
 echo "<form method=\"post\" action=\"$routine\">
    <table class=\"entry\">
     <tbody>
        <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
        <tr>
           <td>&nbsp;</td><td><input type=\"submit\" value=\"$text\" /></td>
        </tr>
      </tbody>
    </table>
  </form>";
}

/* reporting and validation */
/* ------------------------ */

/* show date range                              */
function sub_show_date_range($from_date_in, $to_date_in) {
 echo "<form name=\"prompt\" action=\"action\">
  <table class=\"entry\">
   <tbody>
      <tr><td><strong>From</strong></td><td><input type=\"text\" size=\"12\" value=\"$from_date_in\" /></td></tr>
      <tr><td><strong>To</strong></td><td><input type=\"text\" size=\"12\" value=\"$to_date_in\" /></td></tr>
      <tr><td></td><td></td></tr>
    </tbody>
  </table>
 </form>";
}

/* show date range and company name             */
function sub_show_date_range_company($from_date_in, $to_date_in, $company_in) {
 echo "<form name=\"prompt\" action=\"action\">
   <table class=\"entry\">
    <tbody>
      <tr><td><strong>From</strong></td><td><input type=\"text\" size=\"12\" value=\"$from_date_in\" /></td></tr>
      <tr><td><strong>To</strong></td><td><input type=\"text\" size=\"12\" value=\"$to_date_in\" /></td></tr>
      <tr><td><strong>Company</strong></td><td><input type=\"text\" size=\"50\" value=\"$company_in\" /></td></tr>
     </tbody>
   </table>
  </form>";
 }

/* prompt for Continue or Cancel            */
function sub_prompt_continue($module_in, $menu_in) {
 echo "<p>&nbsp;</p>";
 echo "<p>Click Continue to run $module_in or Cancel to exit</p>";
 echo "<p>&nbsp;</p>";
?>
<form method="post" name="prompt" action="<?php echo $_SERVER['PHP_SELF'];?>">
  <table class="entry">
   <tbody>
    <tr><td></td><td></td></tr>
    <tr><td></td><td><input type="submit" value="Continue" name="submit" /></td>
   </tbody>
  </table>
 </form>
<?php
  sub_button($menu_in, "Cancel");
 }

/* prompt for date range and company name        */
/* need to use htmlspecialchars because of &     */
function sub_prompt_date_range_company($sql_company_result_in, $menu_in) {
?>
<form method="post" name="prompt" action="<?php echo $_SERVER['PHP_SELF'];?>">
  <table class="entry">
    <tbody>
      <tr><td><strong>From</strong></td><td><input type="text" size="12" name="from_date" /></td></tr>
      <tr><td><strong>To</strong></td><td><input type="text" size="12" name="to_date" /></td></tr>
      <tr><td><strong>Company</strong></td>
        <td><select name="sel_company"><option value=""> ---  Select Company  ---</option>
<?php
   while ($row = mysqli_fetch_array($sql_company_result_in)) {
      $company=htmlspecialchars($row["company"], ENT_QUOTES);
      echo "
      <option value=\"$company\">$company</option>
      ";
  }
?>
     </select></td></tr>
      <tr><td></td><td></td></tr>
      <tr><td></td><td><input type="submit" value="Report" name="submit" /></td>
          <td><input type="reset" value="Reset" name="reset" /></td></tr>
    </tbody>
  </table>
 </form>
<?php
  sub_button($menu_in, "Menu");
 }

/* valid_range_selection - validate date range and company  */
function valid_range_selection($from_date, $to_date, $company, $my_company, $module_name, $module, $menu, $date_separator, $date_format) {
global $application;
 if (!$company) {
    sub_company_heading($my_company, $module_name, $application);
    sub_show_date_range_company($from_date, $to_date, $company);
    sub_message_error("Company field is blank");
    sub_button($module, "Reset");
    sub_button($menu, "Menu");
    exit;
 }

/* if both dates are blank, get current period start and end date */
 if ((!$from_date) and (!$to_date)) {
   list($from_dt, $from_local_date, $to_dt, $to_local_date, $rate) = sub_period($date_separator, $date_format);
   $from_date = $from_local_date;
   $to_date = $to_local_date;
 } 

 if ((!$from_date) or (!$to_date)) {
    sub_company_heading($my_company, $module_name, $application);
    sub_show_date_range_company($from_date, $to_date, $company);
    sub_message_error("One of the date fields is blank");
    sub_button($module, "Reset");
    sub_button($menu, "Menu");
    exit;
 }

 list($start_date, $fmt_start_date) = valid_date($from_date, $date_separator, $date_format);
/* returns date string as yyyy-mm-dd and in local format */
 if (!$start_date) {
    sub_company_heading($my_company, $module_name, $application);
    sub_show_date_range_company($from_date, $to_date, $company);
    sub_message_error("From date is invalid");
    sub_button($module, "Reset");
    sub_button($menu, "Menu");
    exit;
 }

 list($end_date, $fmt_end_date) = valid_date($to_date, $date_separator, $date_format);
/* returns date string as yyyy-mm-dd and in local format */
 if (!$end_date) {
    sub_company_heading($my_company, $module_name, $application);
    sub_show_date_range_company($fmt_start_date, $to_date, $company);
    sub_message_error("To date is invalid");
    sub_button($module, "Reset");
    sub_button($menu, "Menu");
    exit;
 }

 if ( later_date($start_date, $end_date) ) {
    sub_company_heading($my_company, $module_name, $application);
    sub_show_date_range_company($fmt_start_date, $fmt_end_date, $company);
    sub_message_error("From date is later than To date");
    sub_button($module, "Reset");
    sub_button($menu, "Menu");
    exit;
 }
 return array($start_date, $fmt_start_date, $end_date, $fmt_end_date);
}

/* prompt for date range                       */
/* need to use htmlspecialchars because of &   */
function sub_prompt_date_range($menu) {
?>
<form method="post" name="prompt" action="<?php echo $_SERVER['PHP_SELF'];?>">
  <table class="entry">
    <tbody>
      <tr><td><strong>From</strong></td><td><input type="text" size="12" name="from_date" /></td></tr>
      <tr><td><strong>To</strong></td><td><input type="text" size="12" name="to_date" /></td></tr>
      <tr><td></td><td></td></tr>
      <tr><td></td><td><input type="submit" value="Report" name="submit" /></td>
          <td><input type="reset" value="Reset" name="reset" /></td></tr>
    </tbody>
  </table>
 </form>
<?php
  sub_button($menu, "Menu");
 }

/* valid_date_range - validate date range      */
function valid_date_range($from_date, $to_date, $my_company, $module_name, $module, $menu, $date_separator, $date_format) {
global $application;
/* if both dates are blank, get current period start and end date */
 if ((!$from_date) and (!$to_date)) {
   list($from_dt, $from_fmt, $to_dt, $to_fmt) = sub_period();
   $from_date = $from_fmt;
   $to_date = $to_fmt;
 } 

 if ((!$from_date) or (!$to_date)) {
    sub_company_heading($my_company, $module_name, $application);
    sub_show_date_range($from_date, $to_date);
    sub_message_error("One of the date fields is blank");
    sub_button($module, "Reset");
    sub_button($menu, "Menu");
    exit;
 }

 list($start_date, $fmt_start_date) = valid_date($from_date, $date_separator, $date_format);
/* returns date as yyyy-mm-dd and in local format */
 if (!$start_date) {
    sub_company_heading($my_company, $module_name, $application);
    sub_show_date_range($from_date, $to_date);
    sub_message_error("From date is invalid");
    sub_button($module, "Reset");
    sub_button($menu, "Menu");
    exit;
 }

list($end_date, $fmt_end_date) = valid_date($to_date, $date_separator, $date_format);
/* returns date as yyyy-mm-dd and in local format */
 if (!$end_date) {
    sub_company_heading($my_company, $module_name, $application);
    sub_show_date_range($from_date, $to_date);
    sub_message_error("To date is invalid");
    sub_button($module, "Reset");
    sub_button($menu, "Menu");
    exit;
 }

 if ( later_date($start_date, $end_date) ) {
    sub_company_heading($my_company, $module_name, $application);
    sub_show_date_range($fmt_start_date, $fmt_end_date);
    sub_message_error("From date is later than To date");
    sub_button($module, "Reset");
    sub_button($menu, "Menu");
    exit;
 }
 return array($start_date, $fmt_start_date, $end_date, $fmt_end_date);
}
?>
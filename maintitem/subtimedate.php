<?php
/* subtimedate.php                                */
/* Time and Date Functions 				  */
/* Copyright (C) 2005 Toivo Talikka               */

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
/* The GNU Lesser General Public Licence (LGPL) can be viewed at: 					*/
/*			http://www.opensource.org/licenses/lgpl-license.php				*/
/*														*/
/* Toivo Talikka can be contacted by email:	    toivo@totaldata.biz			       */
/* ---------------------------------------------------------------------------------------------*/


/* ----------------------------------------------------*/
/* Modification history				  	*/
/* 09/12/05 TJT Initial version			  	*/
/*								*/
/* ----------------------------------------------------*/

/* ----------------------------------------------------*/
/* Functions						  	*/	
/* ---------							*/
/* sec_to_hhmm($seconds)   			         	*/
/* sec_to_hours($seconds) 				  	*/
/* get_date_format($format_key, $separator)       	*/
/* get_date($format_key, $separator)              	*/
/* valid_date($in_date, $separator, $format_key)  	*/
/* make_std_date($in_date, $separator, $format_key) 	*/
/* make_local_date($in_date, $separator, $format_key) 	*/
/* later_date($first_date,$second_date)	         	*/
/* earlier_date($first_date,$second_date)	         	*/
/* equal_date($first_date,$second_date)	         	*/
/* valid_time($in_time)				  	*/
/* ----------------------------------------------------*/

/* ---------------------------------------------------------*/
/* convert seconds to hours and minutes */
function sec_to_hhmm($seconds) {
  if ($seconds >= 3600) {
    $hours = floor($seconds/3600);
    $remainder = $seconds % 3600;
   } else {
        $hours="0";
        $remainder = $seconds;
       }
    $minutes = floor($remainder/60);
  if ($minutes < "10") {
      $minutes = "0$minutes";
  }
  return "$hours:$minutes";
}

/* ---------------------------------------------------------*/
/* convert seconds to hours and decimals */
function sec_to_hours($seconds) {
  if ($seconds >= 3600) {
    $hours = floor($seconds/3600);
    $remainder = $seconds % 3600;
   } else {
        $hours="0";
        $remainder = $seconds;
       }
    $decimals = 100*(round($remainder/3600,2));
    if ($decimals < "10") {
        $decimals = "0$decimals";
    }
  return "$hours.$decimals";
}

/* ---------------------------------------------------------*/
// get date format description, mask, date element mapping, insert date separator

function get_date_format($date_format_key, $date_sep) {
global $date_format_array;
  list($date_format_description, $date_mask, $day_seq_out, $month_seq_out, $year_seq_out) = $date_format_array["$date_format_key"];
  $date_format_desc_out = str_replace(" ","$date_sep", $date_format_description);
  $date_mask_out = str_replace(" ","$date_sep", $date_mask);
  return array($date_format_desc_out, $date_mask_out, $day_seq_out, $month_seq_out, $year_seq_out);
}

/* ---------------------------------------------------------*/
// get long date format mask, insert date separator

function get_long_date_format($date_format_key, $date_sep) {
global $date_format_array;
  list($date_format_description, $date_mask, $day_seq_out, $month_seq_out, $year_seq_out) = $date_format_array["$date_format_key"];
  $date_mask_out = str_replace(" ","$date_sep", $date_mask);
  return $date_mask_out;
}

/* ---------------------------------------------------------*/
// get short date format mask, insert date separator

function get_short_date_format($date_format_key, $date_sep) {
global $date_format_array;
global $short_date_format_array;
  list($date_format_description, $date_mask, $day_seq_out, $month_seq_out, $year_seq_out) = $date_format_array["$date_format_key"];
  $short_date_mask = substr($date_mask, $short_date_format_array["$date_format_key"], 3);
  $short_date_mask_out = str_replace(" ","$date_sep", $short_date_mask);
  return $short_date_mask_out;
}

// columns 3 - 5 date element position mapping:  day month year
//                            0=day   1=month  2=year
$date_format_array = array (
 "dmY" => array("dd mm YYYY", "d m Y", "0", "1", "2"), 
 "mdY" => array("mm dd YYYY", "m d Y", "1", "0", "2"), 
 "Ymd" => array("YYYY mm dd", "Y m d", "2", "1", "0")
);

// columns 0  short date element start position in date mask
$short_date_format_array = array (
 "dmY" => "0", 
 "mdY" => "0", 
 "Ymd" => "2" 
);


/* ---------------------------------------------------------*/
/* validate date in local format and convert to yyyy-mm-dd  */
/*  default separator= /    default date format= dd/mm/yyyy */
/* accepts yy as 20yy, blank year as current year           */
/* checkdate() ignores invalid characters e.g. 8:/3:/2004   */
/* return array with date 1 - yyyy-mm-dd                    */
/*                        2 - date in local format          */

function valid_date($in_date, $separator, $in_format) {
// default date separator and date format
 if (!$separator) {
    $separator = "/";
  }

 if (!$in_format) {
    		$in_format = "dmY";
   }

// look up date format details from array
 list($date_format_desc, $date_format_mask, $day_seq, $month_seq, $year_seq) = get_date_format($in_format, $separator);

 $test_date = "";
 $out_date = "";
 $out_local_date = "";

// if no separators, date can be max 2 chars

 if (strstr($in_date, $separator)) {
    $date = explode($separator, $in_date);
    $parts = count($date);
    } elseif ( strlen($in_date) > 2) {
        $parts = 0;
    } else {
        $parts = 1;
        $date[0] = $in_date;
  }

// if no year, use current year
// if only day is given, use current month and year 
// if two parts, day and month - sequence from local date format
// if three parts - sequence from local date format
// if nothing, or case '0', reject date

 switch($parts) {
 
   case '1':
     $day = $date[0];
     $month = date("m");
     $year = date("Y");
     break;

// dependent on YYYY
   case '2':
     if ($in_format == "Ymd") {
         $day_seq = 1;
         $month_seq = 0;
      }
     $day = $date[$day_seq];
     $month = $date[$month_seq];
     $year = date("Y");
     break;

   case '3':
     $day = $date[$day_seq];
     $month = $date[$month_seq];
     $year = $date[$year_seq];
     break;

   default:
     $day = "0";
     $month = "0";
     $year = "0";  
 }
 
 settype($day, "integer");
 settype($month, "integer");
 settype($year, "integer");

// if dd/mm/yy, add 2000 to year
 if ($year < 100) {
   $year = $year +2000;
 }

// check day-month logic
 $result = checkdate($month, $day, $year);
 if ($result == 1) {
   $test_date = "$year-";
   $test_date .= "$month-";
   $test_date .= "$day";

// strtime() converts to time format and tests the date
   if (($timestamp = strtotime($test_date)) <> -1) {
       $out_date = date('Y-m-d', $timestamp);
       $out_local_date = date($date_format_mask, $timestamp);
   }
 }
 return array($out_date, $out_local_date);
}

/* ---------------------------------------------------------*/
/* validate date in local format and convert to yyyy-mm-dd  */
/* accepts yy as 20yy, blank year as current year           */
/* checkdate() ignores invalid characters e.g. 8:/3:/2004   */
/* return array with date 1 - date in date format           */
/*                        2 - yyyy-mm-dd                    */
/*                        3 - date in local format          */

function make_std_date($in_date, $separator, $in_format) {

// default date separator and date format
 if (!$separator) {
    $separator = "/";
  }

 if (!$in_format) {
    		$in_format = "dmY";
   }

 if (!$in_date) {
    $in_date="";
  }

 list($date_format_desc, $date_format_mask, $day_seq, $month_seq, $year_seq) = get_date_format($in_format, $separator);

 list($std_date, $local_date) = valid_date($in_date, $separator, $in_format);

// test
// echo "<p>in_date = $in_date &nbsp; &nbsp; std_date = $std_date</p>";

 if (($timestamp = strtotime($std_date)) === -1) {
    $timestamp = "";
  }
 return array($timestamp, $std_date, $local_date);
}

/* --------------------------------------------------*/
/* get today's date 					     */
/* return array with date 1 - date in date format    */
/*                        2 - yyyy-mm-dd             */
/*                        3 - date in local format   */

function get_date($in_format, $in_separator) {

// default date separator and date format
 if (!$in_separator) {
    $in_separator = "/";
  }

 if (!$in_format) {
    		$in_format = "dmY";
   }

// today's date in YYYY-mm-dd
 $today = date('Y-m-d');

// local format
 list($timestamp, $local_date) = make_local_date($today, $in_separator, $in_format);

/* test
 echo "<p>in_format = $in_format</p>";
 echo "<p>timestamp = $timestamp</p>";
 echo "<p>today = $today</p>";
 echo "<p>local = $local_date</p>";
*/

 return array($timestamp, $today, $local_date);
}

/* --------------------------------------------------------------------------------------*/
/* accept an already validated date in std format yyyy-mm-dd and convert to local format */
/* return array with date 1 - date as a date variable        */
/*                        2 - date in local format           */

function make_local_date($in_std_date, $separator, $in_local_format) {

// default date separator and date format
 if (!$separator) {
    $separator = "/";
  }
 if (!$in_local_format) {
    		$in_local_format = "dmY";
   }

 list($date_format_desc, $date_format_mask, $day_seq, $month_seq, $year_seq) = get_date_format($in_local_format, $separator);

// if date invalid, use today's date
 $std_separator = "-";
 if (!(strstr($in_std_date, $std_separator))) {
    $in_std_date = date('Y-m-d');
  }
 $date = explode($std_separator, $in_std_date);

// reverse map of date components
 $new_date[$day_seq] = $date[(2 - $day_seq)];
 $new_date[$month_seq] = $date[(2 - $month_seq)];
 $new_date[$year_seq] = $date[(2 - $year_seq)];

 $local_date = implode($separator, $new_date);

 $timestamp = strtotime($in_std_date);

 return array($timestamp, $local_date);
}



/* ---------------------------------------------------------*/
/* check if first date later than second date, both already validated */

function later_date($first_date,$second_date) {
  if ((strtotime($first_date)) > (strtotime($second_date))) {
    return 1;
    } else {
     return 0;
    }
}

/* ---------------------------------------------------------*/
/* check if first date is earlier than second date, both already validated */

function earlier_date($first_date,$second_date) {
  if ((strtotime($first_date)) > (strtotime($second_date))) {
    return 1;
    } else {
     return 0;
    }
}

/* ---------------------------------------------------------*/
/* check if two dates are equal, both already validated     */

function equal_date($first_date,$second_date) {
  if ((strtotime($first_date)) == (strtotime($second_date))) {
    return 1;
    } else {
     return 0;
    }
}

/* ---------------------------------------------------------*/
/* validate time hh:mm                     */
/* settype() gets rid of non-numeric input */
/* range check for hours and minutes       */
/* adds leading zeroes, max hh 24, min 59  */
/* hh interpreted as hh:00                 */
/* returns valid time or blank             */

function valid_time($in_time) {

// check if any separators
// if no separators, time can be max 2 chars

  if (strstr($in_time,":")) {
     $time = explode(":",$in_time);
     $parts = count($time);
     } elseif (strlen(trim($in_time)) > 2) {
	  $parts = 0;
     } else {
         $parts = 1;
         $time[0] = trim($in_time);
  }
 
  switch($parts) {

    case '1':
      $hour = $time[0];
      $min = "00";
      break;

    case '2':
      $hour = $time[0];
      $min = $time[1];
      break;

    default:
      $hour = "99";
      $min = "99";
  }

  $out_time="";
  settype($hour,"integer");
  settype($min,"integer");
  if ( ! ((($hour >= 0) and ($hour <= 24)) and (($min >= 0) and ($min < 60)))) {
     return $out_time;
     }
  if (strlen($hour) < 2) {
 	$out_time = "0";
     }
  $out_time .= "$hour:";
  if (strlen($min) < 2) {
       $out_time .= "0";
     }
  $out_time .= "$min";
  return $out_time;
}
?>


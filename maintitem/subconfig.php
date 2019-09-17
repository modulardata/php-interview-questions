<?php
/* subconfig.php 						*/
/* Configuration Functions					*/
/* Copyright (C) 2005 Toivo Talikka               	*/

/* This library is free software; you can redistribute it and/or modify it under the terms of 	*/
/* of the GNU General Public License as published by the Free Software Foundation; 	       */
/* either version 2 of the License, or any later version.					      	*/

/* This library is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;  	*/ 
/* without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  	*/
/* See the GNU Lesser General Public License for more details. 					*/

/* You should have received a copy of the GNU General Public License along with this 	       */
/* library; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, 	*/
/* Boston, MA 02111-1307 USA									     	*/
/*													     	*/	
/* The GNU General Public Licence (GPL) can be viewed at: 			     		       */
/*			http://www.opensource.org/licenses/gpl-license.php				*/
/*														*/
/* Toivo Talikka can be contacted by email:	toivo@totaldata.biz				       */
/* ---------------------------------------------------------------------------------------------*/


/* ----------------------------------------------------*/
/* Modification history				  	*/
/* 09/12/05 TJT Initial version			  	*/
/*								*/
/* ----------------------------------------------------*/

/* ----------------------------------------------------*/
/* Functions						  	*/	
/* ---------							*/
/* sub_period($date_separator, $date_format)         	*/
/* sub_config($db_name, $db_connection)		  	*/
/* ----------------------------------------------------*/

/* ----------------------------------------------------------------------*/
/* sub_period									     */
/*										     */	
/* retrieves start date, end date and rate of the current billing period */
/* returns both dates in standard date YYYY-mm-dd and local date format  */

function sub_period( $in_date_separator = NULL, $in_date_format = NULL ) {

// default date separator and date format
 if (!$in_date_separator) {
    $in_date_separator = "/";
  }

 if (!$in_date_format) {
    		$in_date_format = "dmY";
   }

$db = "billing";

$sql = "SELECT start, end, rate, period FROM period WHERE period=0"; 

$db_connection = sub_connect_select($db);
$sql_result = sub_query($sql, $db_connection);

if (!$sql_result)  {
  echo	"<p>Unable to access period table</p>";
  return array(0,0,0,0);
} 

while ($row = mysqli_fetch_array($sql_result)) {
    $start_date_std = $row['start'];
    $end_date_std = $row['end'];
    $rate = $row['rate'];
 };  

// convert the dates from YYYY-mm-dd to local date format
list($start_date, $start_date_local) = make_local_date($start_date_std, $in_date_separator, $in_date_format);
list($end_date, $end_date_local) = make_local_date($end_date_std, $in_date_separator, $in_date_format);
 
return array($start_date, $start_date_local, $end_date, $end_date_local, $rate); 
}


/* -----------------------------------------------------------------------------------------------*/
/* sub_config													  */
/*														  */
/* retrieve company name, date format, menu name, database name, date separator from config table */

function sub_config( $db = NULL, $db_connection = NULL ) {
// application dependent constant: database
if (!$db) {
  $db = "billing";
 }

// use existing connection if possible
if (!$db_connection ) {
  $db_connection = sub_connect_select($db);
 }

// lookup config details
$sql = "SELECT company, dateformat, dateseparator, application, menu FROM config WHERE rowkey='0'"; 

$sql_result = sub_query($sql, $db_connection);

if (!$sql_result)  {
  echo	"<p>Unable to access config table</p>";
  return array(0,0,0,0);
} 

while ($row = mysqli_fetch_array($sql_result)) {
    $company = $row['company'];
    $date_format = $row['dateformat'];
    $date_separator = $row['dateseparator'];
    $application = $row['application'];
    $menu = $row['menu'];
};  

return array($company, $date_format, $menu, $db, $date_separator, $db_connection, $application); 
}
?>


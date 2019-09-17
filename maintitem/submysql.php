<?php
/* submysql.php */
/* mysql functions */
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
/* sub_connect()	   			         	*/
/* sub_select_db($in_db, $in_connection)			*/
/* sub_connect_select($in_db)				*/
/* sub_query($in_query, $in_connection)			*/
/* ----------------------------------------------------*/


/* create database connection */
function sub_connect() {
// v4:  $out_connection = mysql_connect("localhost","sqluser","sssqql") or die ("Could not connect to the server: " . mysql_error());
   $out_connection = mysqli_connect("localhost","sqluser","sssqql") or die ("Could not connect to the server: " . mysqli_connect_error());
   return $out_connection;
}

/* select database */
function sub_select_db($in_db, $in_connection) {
// v4: $out_db = mysql_select_db($in_db, $in_connection) or die ("Could not select database: " . mysql_error());	
   $out_db = mysqli_select_db($in_connection, $in_db) or die ("Could not select database: " . mysqli_connect_error());	
   return $out_db;
}

/* create database connection and select database */
function sub_connect_select($in_db2) {
// v4:  $my_connection = mysql_connect("localhost","sqluser","sssqql") or die ("Could not connect to the server: " . mysql_error());
// default dbname can be provided here as 4th parameter
  $my_connection = mysqli_connect("localhost","sqluser","sssqql") or die ("Could not connect to the server: " . mysqli_connect_error());
  if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
   }
// v4: $dummy_db = mysql_select_db($in_db2, $my_connection) or die ("Could not select database: " . mysql_error());
  $dummy_db = mysqli_select_db($my_connection, $in_db2) or die ("Could not select database: " . mysql_error());
  return $my_connection;
}

/* execute SQL query and get result */
function sub_query($in_query, $in_connection) {
// v4:  $out_result = mysql_query($in_query, $in_connection) or die ("Could not execute query: <br>\n" . mysql_errno() . ": " . mysql_error() .
  $out_result = mysqli_query($in_connection, $in_query) or die ("Could not execute query: <br>\n" . mysql_errno() . ": " . mysql_error() . "<br>\n");
  return $out_result;
}
?>


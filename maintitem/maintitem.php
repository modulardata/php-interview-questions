<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
       "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Item Maintenance</title>
  <link type="text/css" rel="stylesheet" href="../stylea.css" />
  <link type="text/css" rel="stylesheet" media="print" href="../stylep.css" />
</head>
<body>

<?php
/* maintitem.php 	              									*/
/* Item Maintenance												*/
/* Copyright (C) 2005 Toivo Talikka               							*/

/* This program is free software; you can redistribute it and/or modify it under the terms of 	*/
/* of the GNU General Public License as published by the Free Software Foundation; 	       */
/* either version 2 of the License, or any later version.					      	*/

/* This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;  	*/ 
/* without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  	*/
/* See the GNU General Public License for more details. 						*/

/* You should have received a copy of the GNU General Public License along with this 	       */
/* program; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, 	*/
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

/* functions 		               */
include("../../sub/submysql.php");
include("../../sub/subconfig.php");
include("../../sub/subdisplay.php");
include("../../sub/subtimedate.php");

/* HTML special characters converted before data is displayed        */
/* CRLF in description stored in the database to retain formatting   */

// ----------
// item form
function show_item($item, $subcategory, $description, $supplier, $item_index, $menu) {
global $sql_result_subcategories, $sql_result_suppliers;
  if ($item) {
     $sel_subcategory = $subcategory;
     $sel_supplier = $supplier;
   }
?>
   <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
   <table class="entry">
   <tbody>
     <tr>
       <td><strong>Item</strong></td>  
<?php
     echo "<td><input type=\"text\" size=\"50\" name=\"item\" value=\"$item\" /></td>
     </tr>
     <tr>
       <td><strong>Subcategory</strong></td>
       <td><select name=\"sel_subcategory\"><option value=\"$subcategory\">$subcategory</option>";
     while ($row = mysqli_fetch_array($sql_result_subcategories)) {
         $subcat_opt = $row['subcategory'];
         echo "<option value=\"$subcat_opt\">$subcat_opt</option>";
       }
     echo "</select></td>
     </tr>
     <tr>
       <td><strong>Description</strong></td>
        <td><input type=\"text\" size=\"50\" name=\"description\" value=\"$description\" /></td>
     </tr>
     <tr>
       <td><strong>Supplier</strong></td>

       <td><select name=\"sel_supplier\"><option value=\"$supplier\">$supplier</option>";
     while ($row = mysqli_fetch_array($sql_result_suppliers)) {
         $supplier_opt = $row['supplier'];
         echo "<option value=\"$supplier_opt\">$supplier_opt</option>";
       }
     echo "</select></td>
     </tr>
     <tr><td><input type=\"hidden\" name=\"item_code\" value=\"$item\" /></td><td><input type=\"hidden\" name=\"item_index\" value=\"$item_index\" /></td></tr>";
?>
    <tr><td></td><td><table><tbody><tr><td><input type="submit" value="First" name="first" /></td><td><input type="submit" value="Previous" name="previous" /></td><td><input type="submit" value="Next" name="next" /></td><td><input type="submit" value="Last" name="last" /></td><td>&nbsp;</td><td><input type="submit" value="Reset" name="reset" /></td><td>&nbsp;</td><td>&nbsp;</td><td><input type="submit" value="Clear" name="clear" /></td><td>&nbsp;</td><td>&nbsp;</td><td><input type="submit" value="Add" name="add" /></td><td><input type="submit" value="Update" name="update" /></td><td><input type="submit" value="List" name="list" /></td><td><input type="submit" value="Delete" name="delete" /></td></tr></tbody></table></td>
   </tr>
   </tbody>
  </table></form>
<?php
  sub_button($menu, "Menu");
  return;
 }

// -----------------
// create item array , list of subcategories and suppliers
function create_item_list($db_connection) {
global $item_array, $sql_result_subcategories, $sql_result_suppliers;

// sql query - list items
 $sql_item_list = "SELECT item, subcategory, description, supplier FROM item ORDER BY item";

// list items
 $sql_item_list_result = sub_query($sql_item_list, $db_connection);

 if (!$sql_item_list_result) {
    sub_company_heading($my_company, $module_name, $application);
    sub_message_error("Unable to access item table");
    sub_button($module, "Reset");
    sub_button($menu, "Menu");
    exit;
  }

// create item array
 $item_index = 0;

// escape single, double quote, backslash
 while ($row = mysqli_fetch_array($sql_item_list_result)) {
      $item_esc = addslashes($row['item']);
      $subcategory_esc = addslashes($row['subcategory']);
      $description_esc = addslashes($row['description']);
      $supplier_esc = addslashes($row['supplier']);
      $item_array[$item_index] = array($item_esc, $subcategory_esc, $description_esc, $supplier_esc);
      $item_index += 1;
   }
 $last_item = $item_index - 1;

// sql query - list of subcategories
 $sql_list_subcategories = "SELECT subcategory, category, description from subcategory ORDER BY category, subcategory";

// execute SQL query
 $sql_result_subcategories = sub_query($sql_list_subcategories, $db_connection);

 if (!$sql_result_subcategories) {
   sub_company_heading($my_company, $module_name, $application);
   sub_message_error("Unable to access subcategory table");
   sub_button($module, "Reset");
   sub_button($menu, "Menu");
   exit;
  }

// sql query - list of suppliers
 $sql_list_suppliers = "SELECT supplier, address, contact, telephone FROM supplier ORDER BY supplier";

// execute SQL query
 $sql_result_suppliers = sub_query($sql_list_suppliers, $db_connection);

 if (!$sql_result_suppliers) {
   sub_company_heading($my_company, $module_name, $application);
   sub_message_error("Unable to access supplier table");
   sub_button($module, "Reset");
   sub_button($menu, "Menu");
   exit;
  }
//  -1 if no items
 return $last_item;
 }

// ------------------------------
// display item form with no data
function no_item_data($item_index, $my_company, $module_name, $menu, $application) {
 sub_company_heading($my_company, $module_name, $application);
 show_item("", "", "", "", $item_index, $menu);
 return;
 }

// ---------------------------------------------------
// extract item data from item array and use htmlspecialchars
function get_item_html($item_index) {
global $item_array;

  if (!($item_index < 0)) {
    list($item_esc, $subcategory_esc, $description_esc, $supplier_esc) = $item_array[$item_index];
    $item_html = htmlspecialchars(stripslashes($item_esc), ENT_QUOTES);
    $subcategory_html = htmlspecialchars(stripslashes($subcategory_esc), ENT_QUOTES);
    $description_html = htmlspecialchars(stripslashes($description_esc), ENT_QUOTES);
    $supplier_html = htmlspecialchars(stripslashes($supplier_esc), ENT_QUOTES);
    return array($item_html, $subcategory_html, $description_html, $supplier_html);
   } else {
       return array("", "", "", "");
     }
}

// ---------------------------------------------------
// extract item data from item array, with backslashes
function get_item_esc($item_index) {
global $item_array;
 if (!($item_index < 0)) {
      return $item_array[$item_index];
  } else {
	 return array("", "", "", "");
    }       
}

// ---------------------------------
// main module
// ---------------------------------

 $module_name="Item Maintenance";
 $module="maintitem.php";
 $db = "billing";

// get config variables and create connection
 list($my_company, $date_format, $menu, $database, $date_separator, $db_connection, $application) = sub_config($db);  

 $first_item = 0;
 $last_item = create_item_list($db_connection);

// check if form was submitted and which button was pressed, set switch
 $switch = "first";

 if (isset($_POST['update']))  {
   $switch = "update";
  }
 if (isset($_POST['previous']))  {
   $switch = "previous";
  }
 if (isset($_POST['next']))  {
   $switch = "next";
  }
 if (isset($_POST['first']))  {
   $switch = "first";
  }
 if (isset($_POST['last']))  {
   $switch = "last";
  }
 if (isset($_POST['reset']))  {
   $switch = "reset";
  }
 if (isset($_POST['clear']))  {
   $switch = "clear";
  }
 if (isset($_POST['add']))  {
   $switch = "add";
  }
 if (isset($_POST['list']))  {
   $switch = "list";
  }
 if (isset($_POST['delete']))  {
   $switch = "delete";
  }

switch($switch) {
//---------------------------------------------------
  case "first":
// start case - first item

  $item_index = $first_item;
  if ($last_item < 0) {
     no_item_data($last_item, $my_company, $module_name, $menu, $application);
     exit;
   }

// get item details from array processed for html
  list($item_html, $subcategory_html, $description_html, $supplier_html) = get_item_html($item_index);

// display form
  sub_company_heading($my_company, $module_name, $application);
  show_item($item_html, $subcategory_html, $description_html, $supplier_html, $item_index, $menu);
    
  break;
// end case first

//---------------------------------------------------
 case "add":
// start case - add pressed

// retrieve variables
  $item = trim($_POST['item']);
  $subcategory = trim($_POST['sel_subcategory']); 
  $description = trim($_POST['description']);
  $supplier = trim($_POST['sel_supplier']);
  $item_index = $_POST['item_index'];
 
// escape quotes and slash
  $item_esc = addslashes($item);
  $subcategory_esc = addslashes($subcategory);
  $description_esc = addslashes($description);
  $supplier_esc = addslashes($supplier);
  
// htmlspecialchars 
  $item_html = htmlspecialchars($item, ENT_QUOTES);
  $subcategory_html = htmlspecialchars($subcategory, ENT_QUOTES);
  $description_html = htmlspecialchars($description, ENT_QUOTES);
  $supplier_html = htmlspecialchars($supplier, ENT_QUOTES);
 
// validate input
  if ((!$item_esc) or (!$subcategory_esc) or (!$description_esc) or (!$supplier_esc)) {
     sub_company_heading($my_company, $module_name, $application);
     show_item($item_html, $subcategory_html, $description_html, $supplier_html, $last_item + 1, $menu);
     sub_message_warning("At least one field is blank");
     exit;
   }

// sql query - insert
 $sql_insert = "INSERT INTO item (item, subcategory, description, supplier) VALUES ('$item_esc', '$subcategory_esc', '$description_esc', '$supplier_esc')";

// sql query - lookup
 $sql_lookup = "SELECT item, subcategory, description, supplier FROM item WHERE item='$item_esc'";

// lookup item
 $sql_result = sub_query($sql_lookup,$db_connection);

 while ($row = mysqli_fetch_array($sql_result)) {
   $item2 =  $row['item'];
   $subcategory2 =  $row['subcategory']; 
   $description2 =  $row['description'];
   $supplier2 =  $row['supplier'];
  
// htmlspecialchars
   $item2_html = htmlspecialchars($item2, ENT_QUOTES);
   $subcategory2_html = htmlspecialchars($subcategory2, ENT_QUOTES);
   $description2_html = htmlspecialchars($description2, ENT_QUOTES);
   $supplier2_html = htmlspecialchars($supplier2, ENT_QUOTES);
  }

 if (isset($item2)) {
    sub_company_heading($my_company, $module_name, $application);
    show_item($item2_html, $subcategory2_html, $description2_html, $supplier2_html, $last_item, $menu);
    sub_message_error("Item already exists");
    exit;
  }

 $sql_result = sub_query($sql_insert,$db_connection);

// force 'invalid item' status
 $new_item_index = $last_item + 1;

 if (!$sql_result) {
    sub_company_heading($my_company, $module_name, $application);
    show_item($item_html, $subcategory_html, $description_html, $supplier_html, $new_item_index, $menu);
    sub_message_error("Unable to add item");
  } else {
     sub_company_heading($my_company, $module_name, $application);
     show_item($item_html, $subcategory_html, $description_html, $supplier_html, $new_item_index, $menu);
     sub_message_info("A new item was added");
  }

 break;
// end case add

//---------------------------------------------------
 case "update":
// start case - update item
// item_index from the original item
// item name is the key and cannot be changed

// retrieve variables
  $item = trim($_POST['item']);
  $subcategory = trim($_POST['sel_subcategory']); 
  $description = trim($_POST['description']);
  $supplier = trim($_POST['sel_supplier']);
  $item_index = $_POST['item_index'];
 
// escape quotes and slash
  $item_esc = addslashes($item);
  $subcategory_esc = addslashes($subcategory);
  $description_esc = addslashes($description);
  $supplier_esc = addslashes($supplier);
  
// htmlspecialchars
  $item_html = htmlspecialchars($item, ENT_QUOTES);
  $subcategory_html = htmlspecialchars($subcategory, ENT_QUOTES);
  $description_html = htmlspecialchars($description, ENT_QUOTES);
  $supplier_html = htmlspecialchars($supplier, ENT_QUOTES);
 
// validate input
  if ((!$item_esc) or (!$subcategory_esc) or (!$description_esc) or (!$supplier_esc)) {
     sub_company_heading($my_company, $module_name, $application);
     show_item($item_html, $subcategory_html, $description_html, $supplier_html, $item_index, $menu);
     sub_message_warning("At least one of the fields is blank");
     exit;
   }

// *******************
// validate item index
// *******************
 if (!is_numeric($item_index) or ($item_index > $last_item) or ($item_index < 0)) {
    sub_company_heading($my_company, $module_name, $application);
    show_item($item_html, $subcategory_html, $description_html, $supplier_html, $item_index, $menu);
    sub_message_error("Item does not exist, it cannot be updated");
    exit;
  }

// ***********************
// cannot change item key 
// ***********************
// get item details from array
 list($item2_esc, $subcategory2_esc, $description2_esc, $supplier2_esc) = get_item_esc($item_index);

// compare form to array
 if (!($item_esc == $item2_esc)) {
    sub_company_heading($my_company, $module_name, $application);
    show_item($item_html, $subcategory_html, $description_html, $supplier_html, $item_index, $menu);
    sub_message_error("Item code was changed, item cannot be updated");
    exit;
  }
 
// sql query - update a row in item table
   $sql_update_item = "UPDATE item SET subcategory='$subcategory_esc', description='$description_esc', supplier='$supplier_esc' WHERE item='$item_esc'";
   
   $sql_update_item_result = sub_query($sql_update_item, $db_connection);

   if (!$sql_update_item_result) {
       sub_company_heading($my_company, $module_name, $application);
       show_item($item_html, $subcategory_html, $description_html, $supplier_html, $item_index, $menu);
 	sub_message_error("Unable to update item");
	exit;
     }

// display form
  sub_company_heading($my_company, $module_name, $application);
  show_item($item_html, $subcategory_html, $description_html, $supplier_html, $item_index, $menu); 
  sub_message_info("Item was updated");

  break;
// end case update

//---------------------------------------------------
 case "delete":
// start case delete

// retrieve variables
  $item = trim($_POST['item']);
  $subcategory = trim($_POST['sel_subcategory']); 
  $description = trim($_POST['description']);
  $supplier = trim($_POST['sel_supplier']);
  $item_index = $_POST['item_index'];
 
// escape quotes and slash
  $item_esc = addslashes($item);
  
// htmlspecialchars
  $item_html = htmlspecialchars($item, ENT_QUOTES);
  $subcategory_html = htmlspecialchars($subcategory, ENT_QUOTES);
  $description_html = htmlspecialchars($description, ENT_QUOTES);
  $supplier_html = htmlspecialchars($supplier, ENT_QUOTES); 

// *******************
// validate item index
// *******************
 if (!is_numeric($item_index) or ($item_index > $last_item) or ($item_index < 0)) {
    sub_company_heading($my_company, $module_name, $application);
    show_item($item_html, $subcategory_html, $description_html, $supplier_html, $last_item + 1, $menu);
    sub_message_error("Item does not exist, it cannot be deleted");
    exit;
  }

// ***********************
// cannot change item key 
// ***********************
// get item details from array
 list($item2_esc, $subcategory2_esc, $description2_esc, $supplier2_esc) = get_item_esc($item_index);

// compare item
 if (!($item_esc == $item2_esc)) {
    sub_company_heading($my_company, $module_name, $application);
    show_item($item_html, $subcategory_html, $description_html, $supplier_html, $item_index, $menu);
    sub_message_error("Item code was changed, item cannot be deleted");
    exit;
  }

// sql delete query
 $sql_delete = "DELETE FROM item WHERE item='$item_esc'";

 $sql_delete_result = sub_query($sql_delete, $db_connection);

 if (!$sql_delete_result) {
    sub_company_heading($my_company, $module_name, $application);
    show_item($item_html, $subcategory_html, $description_html, $supplier_html, $item_index, $menu);
    sub_message_error("Unable to delete from item table");
    exit;
  } else {
      sub_company_heading($my_company, $module_name, $application);
      show_item($item_html, $subcategory_html, $description_html, $supplier_html, $item_index, $menu);
      sub_message_info("Item was deleted");
      exit;
  }

 break;
// end case delete

//---------------------------------------------------
  case "previous":
// start case - previous pressed

// retrieve hidden field from form
  $item_index = $_POST['item_index'];
 
  if (!is_numeric($item_index) or ($item_index > $last_item) or ($item_index < 0)) {
     no_item_data($last_item, $my_company, $module_name, $menu, $application);
     exit;
   }

// decrement item pointer, first --> last
  if (($item_index > 0) and ($item_index <= $last_item)) {
     $item_index -= 1; 
    } else {
     $item_index = $last_item;
   }

// get item details from array in html format
  list($item_html, $subcategory_html, $description_html, $supplier_html) = get_item_html($item_index);

// display form
  sub_company_heading($my_company, $module_name, $application);
  show_item($item_html, $subcategory_html, $description_html, $supplier_html, $item_index, $menu);

  break;
// end case previous

//---------------------------------------------------
  case "next":
// start case - next pressed

// retrieve hidden field from form
  $item_index = $_POST['item_index'];
 
  if (!is_numeric($item_index) or ($item_index > $last_item) or ($item_index < 0)) {
     no_item_data($last_item, $my_company, $module_name, $menu, $application);
     exit;
   }
 
// increment item pointer, last --> first
  if (($item_index >= 0) and ($item_index < $last_item)) {
     $item_index += 1; 
    } else {
     $item_index = 0;
   }

// get item details from array in html format
  list($item_html, $subcategory_html, $description_html, $supplier_html) = get_item_html($item_index);

// display the form
  sub_company_heading($my_company, $module_name, $application);
  show_item($item_html, $subcategory_html, $description_html, $supplier_html, $item_index, $menu);

  break;
// end case next

//---------------------------------------------------
  case "last":
// start case - last pressed

  $item_index = $last_item;

  if ($last_item < 0) {
     no_item_data($last_item, $my_company, $module_name, $menu, $application);
     exit;
   }

// get item details from array in html format
  list($item_html, $subcategory_html, $description_html, $supplier_html) = get_item_html($item_index);
 
// display form
  sub_company_heading($my_company, $module_name, $application);
  show_item($item_html, $subcategory_html, $description_html, $supplier_html, $item_index, $menu);
 
  break;
// end case last

//---------------------------------------------------
  case "reset":
// start case - reset pressed

// retrieve hidden field from form
  $item_index = $_POST['item_index'];
 
  if (!is_numeric($item_index) or ($item_index > $last_item) or ($item_index < 0)) {
     no_item_data($last_item, $my_company, $module_name, $menu, $application);
     exit;
   }

// get item details from array in html format
  list($item_html, $subcategory_html, $description_html, $supplier_html) = get_item_html($item_index);
 
// display form
  sub_company_heading($my_company, $module_name, $application);
  show_item($item_html, $subcategory_html, $description_html, $supplier_html, $item_index, $menu);
 
  break;
// end case reset

//---------------------------------------------------
  case "clear":
// start case - clear pressed

// retrieve hidden field from form
  $item_index = $_POST['item_index'];
 
  $item_html = "";
  $subcategory_html = "";
  $description_html = "";
  $supplier_html = "";

// display form
  sub_company_heading($my_company, $module_name, $application);
  show_item($item_html, $subcategory_html, $description_html, $supplier_html, $item_index, $menu);

  break;
// end case clear

//---------------------------------------------------
 case "list":
// start case - list items from the item array

// today's date
 list($timestamp, $today, $local_date) = get_date($date_format, $date_separator);

 $item_index = 0;
 echo "<h1>$my_company</h1><h1>&nbsp;</h1><h1>Inventory Items &nbsp; &nbsp; &nbsp; $local_date</h1><h1>&nbsp;</h1>
   <table><tbody>
   <tr style=\"font-family: helvetica; background-color: #FFEC69; font-weight: bold\">";
 echo "<td>Item</td><td style=\"background-color: #FFFFFF;\">&nbsp;</td><td>Subcategory</td><td>Description</td><td>Supplier</td></tr>"; 
 while (!($item_index > $last_item)) { 
     list($item_html, $subcategory_html, $description_html, $supplier_html) = get_item_html($item_index);
     $item_index += 1;
     echo "<tr><td>$item_html</td><td>&nbsp;</td><td>$subcategory_html</td><td>$description_html</td><td>$supplier_html</td></tr>";
   }
 echo "</tbody></table>"; 
 echo "<p><b>$item_index &nbsp; items</b></p>";
 break;
// end case list

//---------------------------------------------------
 default:
   sub_company_heading($my_company, $module_name, $application);
   sub_message_error("case = default");
 }
?>
</body>
</html>

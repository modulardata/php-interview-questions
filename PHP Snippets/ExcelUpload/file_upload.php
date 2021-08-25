<?php  
require_once("config.php"); 
mysql_query("truncate file_upload");
if (($handle = fopen("sample.xls", "r")) !== FALSE) 
{
	
    while (($data = fgetcsv($handle)) !== FALSE) 
	{   
        // Craft your SQL insert statement such as:
        $query = "INSERT INTO file_upload (`EmployeeCode`, `EmployeeName`, `Company`, `Department`, `LastPunch`, `Direction`, `PunchRecords`, `Status`) VALUES ('{$data[0]}','{$data[1]}','{$data[2]}','{$data[3]}','{$data[4]}','{$data[5]}','{$data[6]}','{$data[7]}')";
        // Use the appropriate backend functions depending on your DB, mysql, postgres, etc.
		 $result=mysql_query($query);
    }
	
}
?>
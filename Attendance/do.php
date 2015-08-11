<?php 

mysql_connect("127.0.0.1", "root", "");
mysql_select_db("attend");


/*
	takes from out_timem table and put in main table 
*/
	$query = mysql_query("SELECT * FROM `emps` ");
	while($array = mysql_fetch_array($query)){
		
		$query_out = mysql_query("SELECT * FROM `tbl_attend_out` WHERE `file_no` =  '".$array["file_no"]."'  AND `date` = '".$array["date"]."' ");
		while($array_out = mysql_fetch_array($query_out)){
			
			$query_insert = mysql_query(" UPDATE `tbl_attend` SET `out_time` = '".$array_out["out_time"]."' WHERE `id` = '".$array["id"]."' ");
			echo "Success<br />";
		}
	}


?>
<?php

	$target_month = 7;
	$target_year = 2015;

	include_once ('class.database.php');
	include_once ('class.ManageAttend.php');
	$d_b = new dbConnection();
	$db = $d_b->connect();
 	$attend_object = new ManageAttend($target_month,$target_year);
	$arr = $attend_object->emp_list;
	$days = $attend_object->month_days;

/* 	
	echo $days."<br />";
	
	$count = 0;
	foreach($arr as $value){
		
		$count ++;	
		echo $count ."- ".$value["file_no"]."<br />";
	}
	echo "Total: ".$count;
	 */
	
		
	foreach($arr as $value){
		
		for($i = 1; $i <= $days; $i++){
			
			$d = $target_year."-".$target_month."-".$i;
			$q = $db->query("SELECT * FROM `".$attend_object->tbl_pre_attend."` WHERE `file_no` = '".$value["file_no"]."' AND `date` = '".$d."'");
			
			$in_time = "00:00:00";
			$out_time = "00:00:00";
			if($q->rowCount()>=1){
					
					$result = $q->fetchAll();
					
					foreach($result as $res){
						if($res["time"] >= '12:00:00'){
							$out_time = $res["time"];
						}
						else{
							$in_time = $res["time"];
						}
					}

				$que = $db->prepare("INSERT INTO `tbl_attend` (`file_no`, `date`, `in_time`, `out_time`, `status`, `over_time`) VALUES (?, ?, ?, ?, ?, ?) ");
				$vals = array($value["file_no"], $d, $in_time, $out_time, "","");
				$que->execute($vals);					
			}

		}
		
	 
		$count ++;	
		echo $count ."- ".$value["file_no"]."<br />";
	}
	 
	 
?>

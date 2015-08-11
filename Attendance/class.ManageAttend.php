<?php


	include_once ('class.database.php');

	class ManageAttend{
		
			public $link;
			public $tbl_pre_attend = 'tbl_pre_attend';
			public $emp_list;
			public $month_days;
			public $full_date;
			public $end_time = '15:00:00';
			
		function __construct($month,$year){
			
			$db_connection = new dbConnection();
			$this->link = $db_connection->connect();
			$this->setMonthData($month,$year);
			$this->prepareAtten();
		}
		
		function setMonthData($month,$year){
			
			$this->month_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
			$this->full_date = $month." / ".$year;
		}
	
		function prepareAtten(){
			
			$query = $this->link->query("SELECT DISTINCT `file_no` FROM `".$this->tbl_pre_attend."`");
			if($query->rowCount() >=1){
				$unique_file_no_array = $query->fetchAll();
				$this->emp_list = $unique_file_no_array;
			}
		}

	}

?>
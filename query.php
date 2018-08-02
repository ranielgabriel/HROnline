<?php  
	include('auth.php');
	include('connect.php');

	if(isset($_POST['googlequerybtn'])){
		$sql = "SELECT tbl_application.ID as 'ID',
				`NAME` as `Name`,
				`reference_no` as `ReferenceCode`,
				`Timestamp` as 'Timestamp',
				`Email Address` as 'Email',
				`Contact No.` as 'Contact Number',
				`status` as 'Status',
				`Current Address` as 'Address',
				concat(`3.2 Position Title`, ' ', `2.2 Position Title`,' ',`1.2 Position Title`,' ',`4.2 Position Title`) as 'PreviousJobs',
				`Col_degree Course` as 'Course',
				(select `position_name` from tbl_position where `id` = `Position`) as 'Job Title',
				'source' as 'Source',
				`Age` as 'Age',
				`Note` as 'note',
				(CASE 
				  WHEN `Schedule` ='0000-00-00 00:00:00' THEN ''
				  ELSE SCHEDULE
				END) as `schedule`,
				(Select status from tbl_interview where referenceNo = tbl_application.reference_no and interviewStage = tbl_application.status limit 1) as 'Stage'
		FROM tbl_application";
		$thereswhere=0;
/////******		F I L T E R 	 ******/////
		if(isset($_POST['age1']) || isset($_POST['age2']) || isset($_POST['age3']) || isset($_POST['age4']) || isset($_POST['age5']) || isset($_POST['age6']) || isset($_POST['age7'])){/*AGE*/
			if(isset($_POST['age1'])){
			//$sql = $sql." where ( (Cast(`Age` AS INT) >=21 and Cast(`Age` AS INT)<=25) ";
			$sql = $sql." where ( (`Age` >= 18 and `Age` <= 25) ";
			$thereswhere++;
			}
			if(isset($_POST['age2'])){
				if($thereswhere > 0 ){
					$sql = $sql." or  (`Age` >= 26 and `Age` <= 30) ";
				}else{
					$sql = $sql." where ( (`Age` >= 26 and `Age` <= 30) ";
				}			$thereswhere++;
			}
			if(isset($_POST['age3'])){
				if($thereswhere > 0 ){
					$sql = $sql." or  (`Age` >= 31 and `Age` <= 35) ";
				}else{
					$sql = $sql." where ( (`Age` >= 31 and `Age` <= 35) ";
				}			$thereswhere++;
			}
			if(isset($_POST['age4'])){
				if($thereswhere > 0 ){
					$sql = $sql." or  (`Age` >= 36 and `Age` <= 40) ";
				}else{
					$sql = $sql." where ( (`Age` >= 36 and `Age` <= 40) ";
				}			$thereswhere++;

			}
			if(isset($_POST['age5'])){
				if($thereswhere > 0 ){
					$sql = $sql." or  (`Age` >= 41 and `Age` <= 45) ";
				}else{
					$sql = $sql." where ( (`Age` >= 41 and `Age` <= 45) ";
				}			$thereswhere++;

			}
			if(isset($_POST['age6'])){
				if($thereswhere > 0 ){
					$sql = $sql." or  (`Age` >= 46 and `Age` <= 50) ";
				}else{
					$sql = $sql." where ( (`Age` >= 46 and `Age` <= 50) ";
				}			$thereswhere++;

			}
			if(isset($_POST['age7'])){
				if($thereswhere > 0 ){
					$sql = $sql." or  (`Age` >= 51) ";
				}else{
					$sql = $sql." where ( (`Age` >= 51) ";
				}			$thereswhere++;

			}
				if($thereswhere > 0 ){
					$sql = $sql.") ";
				}
		}
		if(!empty($_POST['googlequeryappdate1']) && !empty($_POST['googlequeryappdate2'])){//DATE
			if(strtotime($_POST['googlequeryappdate2']) > strtotime($_POST['googlequeryappdate1'])){
				$strtDate = $_POST['googlequeryappdate1'];
				$endDate = $_POST['googlequeryappdate2'];
			}else{
				$strtDate = $_POST['googlequeryappdate2'];
				$endDate =$_POST['googlequeryappdate1'];
			}
			
			if($thereswhere > 0){
				$sql = $sql.' AND DATE_FORMAT(`Timestamp`, \'%Y-%m-%d\') >= \''.$strtDate.'\' AND DATE_FORMAT(`Timestamp`, \'%Y-%m-%d\') <= \''.$endDate.'\'';
			}else{
				$sql = $sql.' WHERE DATE_FORMAT(`Timestamp`, \'%Y-%m-%d\') >= \''.$strtDate.'\' AND DATE_FORMAT(`Timestamp`, \'%Y-%m-%d\') <= \''.$endDate.'\'';
				$thereswhere++;
			}
		}
		if(!empty($_POST['googlepositionquery'])){/*POSITION*/
			if($thereswhere > 0){
				$sql = $sql." AND tbl_application.POSITION LIKE '%".$_POST['googlepositionquery']."%'";
			}
			else{
				$sql = $sql." WHERE tbl_application.POSITION LIKE '%".$_POST['googlepositionquery']."%'";
				$thereswhere++;
			}
		}
		if(!empty($_POST['googlequerycourse'])){/*COURSE*/
			if($thereswhere > 0){
				$sql = $sql." AND `COL_Degree Course` LIKE '%".$_POST['googlequerycourse']."%'";
			}
			else{
				$sql = $sql." WHERE `COL_Degree Course` LIKE '%".$_POST['googlequerycourse']."%'";
                $thereswhere++;
			}
		}
		if($_POST['googlegenderquery'] == "Male"){/*GENDER*/
			if($thereswhere > 0){
				$sql = $sql.' AND `Gender` = "Male"';
			}
			else{
				$sql = $sql.' WHERE `Gender` = "Male"';
				$thereswhere++;
			}
		}
		elseif($_POST['googlegenderquery'] == "Female"){
			if($thereswhere > 0){
				$sql = $sql.' AND `Gender` = "Female"';
			}
			else{
				$sql = $sql.' WHERE `Gender` = "Female"';
				$thereswhere++;
			}
		}
		if(($_POST['googleRegionquery'])=='All'){/*Location*/
		}else{
			if($thereswhere > 0){ //if selected not only location
				if(($_POST['cities'])=='All'){
					if($_POST['googleRegionquery'] == 'Metro Manila (NCR)'){
						$sql = $sql." And EXISTS (SELECT 1 FROM `tbl_cities` WHERE Provinces like '%Metro Manila (NCR)%' AND `CURRENT ADDRESS` like  CONCAT('%',Cities,'%'))";
					}else{
						$sql = $sql." And EXISTS (SELECT 1 FROM tbl_prov WHERE Region_id =(select id from tbl_region where region_name = '".$_POST['googleRegionquery']."') And `Address` like CONCAT('%',Province_name,'%'))";	
					}
				}else{
					if($_POST['googleRegionquery'] == 'Metro Manila (NCR)'){
						$sql = $sql." And EXISTS (SELECT 1 FROM `tbl_cities` WHERE Cities like '%".$_POST['cities']."%' AND `CURRENT ADDRESS` like  CONCAT('%',Cities,'%'))";					
					}else{
						if(($_POST['municipality'])=='All'){
							$sql = $sql." And EXISTS (SELECT 1 FROM tbl_cities WHERE Provinces = '".$_POST['cities']."' And `CURRENT ADDRESS` like 	CONCAT('%',provinces,'%'))";
						}else{
							$sql = $sql." And EXISTS (SELECT 1 FROM tbl_cities WHERE Provinces = '".$_POST['cities']."' And Cities = '".$_POST['municipality']."'   And `CURRENT ADDRESS` like CONCAT('%',provinces,'%')  And `CURRENT ADDRESS` like CONCAT('%',Cities,'%'))";	
						}
					}
				}
			}else{ //if selected location only
				if(($_POST['cities'])=='All'){
					if($_POST['googleRegionquery'] == 'Metro Manila (NCR)'){
						$sql = $sql." Where EXISTS (SELECT 1 FROM `tbl_cities` WHERE Provinces like '%Metro Manila (NCR)%' AND `CURRENT ADDRESS` like  CONCAT('%',Cities,'%'))";
					}else{
						$sql = $sql." where EXISTS (SELECT 1 FROM tbl_prov WHERE Region_id =(select id from tbl_region where region_name = '".$_POST['googleRegionquery']."') And `CURRENT ADDRESS` like CONCAT('%',Province_name,'%'))";	
					}
				}else{	
					if($_POST['googleRegionquery'] == 'Metro Manila (NCR)'){
						$sql = $sql." Where EXISTS (SELECT 1 FROM `tbl_cities` WHERE Cities like '%".$_POST['cities']."%' AND `CURRENT ADDRESS` like  CONCAT('%',Cities,'%'))";					
					}else{
						if(($_POST['municipality'])=='All'){
							$sql = $sql." where EXISTS (SELECT 1 FROM tbl_cities WHERE Provinces = '".$_POST['cities']."' And `CURRENT ADDRESS` like CONCAT('%',provinces,'%'))";	
						}else{
							$sql = $sql." where EXISTS (SELECT 1 FROM tbl_cities WHERE Provinces = '".$_POST['cities']."' And Cities = '".$_POST['municipality']."'   And `Current Address` like CONCAT('%',provinces,'%')  And `Current Address` like CONCAT('%',Cities,'%'))";
						}
					}
				}
			}
			$thereswhere++;
		}	
		if(!empty($_POST['googlequeryworkexp'])){//WORK EXP
			if($thereswhere > 0){
				$sql = $sql." AND (`1.2 Position Title` like '%".$_POST['googlequeryworkexp']."%' OR `2.2 Position Title` like '%".$_POST['googlequeryworkexp']."%' OR `3.2 Position Title` like '%".$_POST['googlequeryworkexp']."%' OR `4.2 Position Title` like '%".$_POST['googlequeryworkexp']."%'  OR `5.2 Position Title` like '%".$_POST['googlequeryworkexp']."%')";
			}
			else{
				$sql = $sql." WHERE (`1.2 Position Title` like '%".$_POST['googlequeryworkexp']."%' OR `2.2 Position Title` like '%".$_POST['googlequeryworkexp']."%' OR `3.2 Position Title` like '%".$_POST['googlequeryworkexp']."%' OR `4.2 Position Title` like '%".$_POST['googlequeryworkexp']."%'  OR `5.2 Position Title` like '%".$_POST['googlequeryworkexp']."%')";
                $thereswhere++;
			}
		}

		$result = $conn->query($sql);
  		if (!$result) {
		    $_SESSION['queryerror'] = $sql;
			unset($_SESSION['googlequery']);
		    header('location: google.php');
		}
		else{
			unset($_SESSION['queryerror']);
			$_SESSION['googlequery'] = $sql;
			header('location: google.php');
		}
	
	}	
/////******		E N D   O F   F I L T E R	  ******/////
	
	/////for reports.php button nextAndPrev
	if(isset($_POST['currentYear'])){
		if($_POST['currentYear'] == 'minus'){
			$_SESSION['currentYear'] =$_SESSION['currentYear']-1 ;	
		}else{
			$_SESSION['currentYear'] =$_SESSION['currentYear']+1 ;	
		}
		echo $_SESSION['currentYear'];
		
	}
	
	/////for reports.php dateRange
	if(isset($_POST['changeDateValue'])){
		$start = $_POST['dateStart'];
		$end = $_POST['dateEnd'];
		 $sql2 =  "SELECT count(*) as 'total' from(SELECT tbl_application.ID as 'ID',
											`NAME` as `Name`,
											`Timestamp` as 'Timestamp',
											`reference_no` as `ReferenceCode`,
											`Email Address` as 'Email',
											`Contact No.` as 'Contact Number',
											`status` as 'Status',
											`Current Address` as 'Address',
											concat(`3.2 Position Title`, ' ', `2.2 Position Title`,' ',`1.2 Position Title`,' ',`4.2 Position Title`) as 'Previous Jobs',
											`Col_degree Course` as 'Course',
											(select `position_name` from tbl_position where `id` = `Position`) as 'Job Title',
											'tbl_application' as 'Source',
											'' as 'Gender',
											`Age` as 'Age',
											`Note` as 'note',
											(CASE 
											  WHEN `Schedule` ='0000-00-00 00:00:00' THEN ''
											  ELSE SCHEDULE
											END) as `schedule`
									FROM tbl_application )myTable  where DATE_FORMAT(`Timestamp`, '%Y-%m-%d') between '".$end."' and '".$start."' ";
		 $result = $conn->query($sql2);
		 $row = $result->fetch_assoc();
		 echo $row['total'];

		 
	}	
	////reports.php links to google.php
	if(isset($_POST['reports'])){
	$sql = "SELECT tbl_application.ID as 'ID',
											`NAME` as `Name`,
											`Timestamp` as 'Timestamp',
											`reference_no` as `ReferenceCode`,
											`Email Address` as 'Email',
											`Contact No.` as 'Contact Number',
											tbl_application.`status` as 'Status',
											`Current Address` as 'Address',
											concat(`3.2 Position Title`, ' ', `2.2 Position Title`,' ',`1.2 Position Title`,' ',`4.2 Position Title`) as 'PreviousJobs',
											`Col_degree Course` as 'Course',
											(select `position_name` from tbl_position where `id` = `Position`) as 'Job Title',
											`source` as 'Source',
											`Age` as 'Age',
											`Note` as 'note',
											(CASE 
											  WHEN `Schedule` ='0000-00-00 00:00:00' THEN ''
											  ELSE SCHEDULE
											END) as `schedule`,
											(Select tbl_interview.Status from tbl_interview where tbl_interview.ReferenceNo = tbl_application.reference_no and tbl_interview.InterviewStage = tbl_application.status limit 1) as 'Stage'
									FROM tbl_application";
/*--START--*/
	//TBL_APPLICATION, 2 , 3								
	if(isset($_POST['tbl'])){
		$status = $_POST['tbl'];
		$status = strtolower($status);
		$_SESSION['googlequery'] = $sql." WHERE `Source` = '".$status."' ";
		echo $_SESSION['googlequery'];
	}
/*--END--*/

	//status
	if(isset($_POST['status'])){
		$status = $_POST['status'];
		$year = $_POST['year'];
		if($status == 'Fail/Reject'){
			$_SESSION['googlequery'] = $sql." where UPPER(`Status`) in ('FAILED','REJECTED') ";
		}else{
			$_SESSION['googlequery'] = $sql." where UPPER(`Status`) like '%".$status."%'  and DATE_FORMAT(`Timestamp`, '%Y') = '".$year."'";
		}
		echo $_SESSION['googlequery'];
		}									
	//age
	if(isset($_POST['age'])){
		$status = $_POST['age'];
		$startDate = $_POST['dateStart'];
		$endDate = $_POST['dateEnd'];
		if($status == '18-25 Yrs.'){
			$_SESSION['googlequery'] = $sql." where `Age` >= 18 and `Age` <=25 and DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$startDate."' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$endDate	."'";
		}else if($status == '26-30 Yrs.'){
			$_SESSION['googlequery'] = $sql." where `Age` >= 26 and `Age` <=30 and DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$startDate."' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$endDate	."'";
		}else if($status == '31-35 Yrs.'){
			$_SESSION['googlequery'] = $sql." where `Age` >= 31 and `Age` <=35 and DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$startDate."' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$endDate	."'";
		}else if($status == '36-42 Yrs.'){
			$_SESSION['googlequery'] = $sql." where `Age` > 36 and `Age` <=42 and DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$startDate."' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$endDate	."'";
		}else if($status == '43-50 Yrs.'){
			$_SESSION['googlequery'] = $sql." where `Age` >42  and `Age` <=50 and DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$startDate."' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$endDate	."'";
		}else{
			$_SESSION['googlequery'] = $sql." where `Age` >50 and DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$startDate."' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$endDate	."'";
		}
		echo $_SESSION['googlequery'];
	}
		
	//gender
	if(isset($_POST['gender'])){
		$status = $_POST['gender'];
		$startDate = $_POST['dateStart'];
		$endDate = $_POST['dateEnd'];
		if($status == 'Male'){
			$_SESSION['googlequery'] = $sql." where UPPER(`Gender`) = 'MALE' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$startDate."' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$endDate."'";
		}else{
			$_SESSION['googlequery'] = $sql." where UPPER(`Gender`) = 'FEMALE' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$startDate."' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$endDate."'";
		}
		echo $_SESSION['googlequery'];
	}
	
	//months
	if(isset($_POST['month'])){
		$status = $_POST['month'];
		$year = $_POST['year'];
		if($status == 'January'){
			$_SESSION['googlequery'] = $sql." where DATE_FORMAT(`Timestamp`, '%m') = '01' and DATE_FORMAT(`Timestamp`, '%Y') = '".$year."'";
		}elseif($status == 'February'){
			$_SESSION['googlequery'] = $sql." where DATE_FORMAT(`Timestamp`, '%m') = '02' and DATE_FORMAT(`Timestamp`, '%Y') = '".$year."'";
		}elseif($status == 'March'){
			$_SESSION['googlequery'] = $sql." where DATE_FORMAT(`Timestamp`, '%m') = '03' and DATE_FORMAT(`Timestamp`, '%Y') = '".$year."'";
		}elseif($status == 'April'){
			$_SESSION['googlequery'] = $sql." where DATE_FORMAT(`Timestamp`, '%m') = '04' and DATE_FORMAT(`Timestamp`, '%Y') = '".$year."'";
		}elseif($status == 'May'){
			$_SESSION['googlequery'] = $sql." where DATE_FORMAT(`Timestamp`, '%m') = '05' and DATE_FORMAT(`Timestamp`, '%Y') = '".$year."'";
		}elseif($status == 'June'){
			$_SESSION['googlequery'] = $sql." where DATE_FORMAT(`Timestamp`, '%m') = '06' and DATE_FORMAT(`Timestamp`, '%Y') = '".$year."'";
		}elseif($status == 'July'){
			$_SESSION['googlequery'] = $sql." where DATE_FORMAT(`Timestamp`, '%m') = '07' and DATE_FORMAT(`Timestamp`, '%Y') = '".$year."'";
		}elseif($status == 'August'){
			$_SESSION['googlequery'] = $sql." where DATE_FORMAT(`Timestamp`, '%m') = '08' and DATE_FORMAT(`Timestamp`, '%Y') = '".$year."'";
		}elseif($status == 'September'){
			$_SESSION['googlequery'] = $sql." where DATE_FORMAT(`Timestamp`, '%m') = '09' and DATE_FORMAT(`Timestamp`, '%Y') = '".$year."'";
		}elseif($status == 'October'){
			$_SESSION['googlequery'] = $sql." where DATE_FORMAT(`Timestamp`, '%m') = '10' and DATE_FORMAT(`Timestamp`, '%Y') = '".$year."'";
		}elseif($status == 'November'){
			$_SESSION['googlequery'] = $sql." where DATE_FORMAT(`Timestamp`, '%m') = '11' and DATE_FORMAT(`Timestamp`, '%Y') = '".$year."'";
		}elseif($status == 'December'){
			$_SESSION['googlequery'] = $sql." where DATE_FORMAT(`Timestamp`, '%m') = '12' and DATE_FORMAT(`Timestamp`, '%Y') = '".$year."'";
		}
		echo $_SESSION['googlequery'];
	}
	
	//position
	if(isset($_POST['position'])){
	$status = $_POST['position'];
	$year = $_POST['year'];
		$_SESSION['googlequery'] = $sql." where UPPER(`JOB TITLE`) = '".$status."' and DATE_FORMAT(`Timestamp`, '%Y') = '".$year."'";
	echo $_SESSION['googlequery'];
	}			
	
	if(isset($_POST['total'])){
	$status = $_POST['total'];
	$endDate = $_POST['sDate'];
	$startDate = $_POST['eDate'];
	$_SESSION['googlequery'] = $sql."  where DATE_FORMAT(`Timestamp`, '%Y-%m-%d') between '".$startDate."' and '".$endDate."'";
	echo $_SESSION['googlequery'];
	}
	
	//application source
	if(isset($_POST['source'])){
		$source = $_POST['source'];
		$startDate = $_POST['eDate'];
		if($source == 'Others'){
		$_SESSION['googlequery'] = $sql."  where Application_source in('','Others')";
		}else{
		$_SESSION['googlequery'] = $sql."  where Application_source = '".$source."'";
		echo $_SESSION['googlequery'];
		}
	}	
	
	if(isset($_POST['activity'])){
		$status = $_POST['activity'];
		$year = $_POST['year'];
		if($status == "Active"){
				$_SESSION['googlequery'] = $sql." where `Status` = 'Pending' and  DATEDIFF(now(),DATE_FORMAT(`Timestamp`, '%Y-%m-%d'))<=90 ";
		}else{
				$_SESSION['googlequery'] = $sql." where `Status` = 'Pending' and  DATEDIFF(now(),DATE_FORMAT(`Timestamp`, '%Y-%m-%d'))>90 ";
		}
	
		echo $_SESSION['googlequery'];
		}
}	
if(isset($_POST['comment'])){
	$ID = $_POST['ID'];
	$value = $_POST['value'];
	$table = $_POST['Table'];
				
		$sqlUpdate = "UPDATE ".$table." SET note ='".$value."', `Timestamp` = '".date('Y-m-d')."'  WHERE id ='".$ID."' ";
		$result2 = $conn->query($sqlUpdate);
		if($result2){
			echo 'success Update';
		}
}
	
if(isset($_POST['commentValue'])){
	$ID = $_POST['ID'];
	$table = $_POST['Table'];
	$sql = "select note from ".$table." where id = '".$ID."'";
		$result = $conn->query($sql);
		 $row = $result->fetch_assoc();
		 echo $row['note'];
	
}
	if(isset($_POST['schedValue'])){
	$ID = $_POST['ID'];
	$table = $_POST['Table'];
	$sql = "select schedule from ".$table." where id = '".$ID."'";
		$result = $conn->query($sql);
		 $row = $result->fetch_assoc();
		 echo $row['schedule'];
	
}
if(isset($_POST['InitialInterview'])){
	
		$userID = $_GET['id'];
		$date = date("Y-m-d h:i:sa");
		$selectUser = "SELECT * FROM tbl_userlogs WHERE log_id = '$userID'";
		$resultUser = $conn->query($selectUser);
		while($rowUser=$resultUser->fetch_assoc()){
			$user = $rowUser['username'];
		}
		
			$sqlInsert = "INSERT INTO tbl_useractionlogs (username, updated_fieldname, updated_date, new_value) VALUES ('$user','Status', '$date', 'Initial Interview' ) ";
			$resultUserAction = $conn->query($sqlInsert);
}



	?>
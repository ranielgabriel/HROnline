<?php

	/*Total*/	

			$mainQuery = "from(SELECT tbl_application.ID as 'ID',

											`NAME` as `Name`,

											`Timestamp` as 'Timestamp',

											`Email Address` as 'Email',

											`Contact No.` as 'Contact Number',

											`status` as 'Status',

											`Current Address` as 'Address',
											
											`CURRENT_REGION` as 'CURRENT_REGION',

											concat(`3.2 Position Title`, ' ', `2.2 Position Title`,' ',`1.2 Position Title`,' ',`4.2 Position Title`) as 'Previous Jobs',

											`Col_degree Course` as 'Course',

											(select `position_name` from tbl_position where `id` = `Position`) as 'Job Title',

											'source' as 'Source',

											`Gender` as 'Gender',

											`Age` as 'Age',

											`Note` as 'note',

											(CASE 

											  WHEN `Schedule` ='0000-00-00 00:00:00' THEN ''

											  ELSE SCHEDULE

											END) as `schedule`,

											Application_source as 'Application_source'

									FROM tbl_application  )myTable";

			

			/*--START--*/

				$sql = "SELECT COUNT(*) AS totalGoogle FROM tbl_application WHERE source='application'";

				$result = $conn->query($sql);

				while($row = $result->fetch_assoc()){

					echo "<script>total.push(".$row['totalGoogle'].")</script>";

				}

				$sql = "SELECT COUNT(*) AS totalJobfair FROM tbl_application WHERE source='jobfair'";

				$result = $conn->query($sql);

				while($row = $result->fetch_assoc()){

					echo "<script>total.push(".$row['totalJobfair'].")</script>";

				}

				$sql = "SELECT COUNT(*) AS totalIndeed FROM tbl_application WHERE source='indeed'";

				$result = $conn->query($sql);

				while($row = $result->fetch_assoc()){

					echo "<script>total.push(".$row['totalIndeed'].")</script>";

				}

			/*--END--*/

				

			/*Gender*/

				$gerndersql1 = "SELECT COUNT(*) AS gender, SUM(CASE WHEN UPPER(`Gender`) = 'MALE' THEN 1 ELSE 0 END) as 'maleGoogle', SUM(CASE WHEN `Gender` like '%FEMALE%' THEN 1 ELSE 0 END) as 'femaleGoogle'  ".$mainQuery."  where  DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$startDate."' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$endDate."'";

				$result = $conn->query($gerndersql1);

				$row = $result->fetch_assoc();

				echo "<script>genderG.push(".$row['maleGoogle'].")</script>";

				echo "<script>genderG.push(".$row['femaleGoogle'].")</script>";



			/*specificDate*/		

				$gerndersql3 = "SELECT  count(*) as total  ".$mainQuery."  where DATE_FORMAT(`Timestamp`, '%Y-%m-%d') between '".$startDate."' and '".$endDate."'";

				$result3 = $conn->query($gerndersql3);				

				$row4 = $result3->fetch_assoc();

				echo "<script>currentDate+=".$row4['total'].";</script>";

		

			/*activityLog*/		

				$gerndersql2 = "SELECT 

				sum(CASE WHEN `Status` = 'Pending' and DATEDIFF(now(),DATE_FORMAT(`Timestamp`, '%Y-%m-%d'))<90  THEN 1 ELSE 0 END) as 'active',

				sum(CASE WHEN `Status` = 'Pending' and DATEDIFF(now(),DATE_FORMAT(`Timestamp`, '%Y-%m-%d'))>90 and DATEDIFF(now(),DATE_FORMAT(`Timestamp`, '%Y-%m-%d'))<60 THEN 1 ELSE 0 END) as 'inactive' ".$mainQuery;

				$result2 = $conn->query($gerndersql2);				

				$row3 = $result2->fetch_assoc();

				echo "<script>activeLog+=".$row3['active'].";</script>";

				echo "<script>inactiveLog+=".$row3['inactive'].";</script>";

				

			/*Age bracket*/

				$agebracket1 = "SELECT SUM(CASE WHEN `Age` > 17 AND `Age` < 26 THEN 1 ELSE 0 END) as '1st',

								SUM(CASE WHEN `Age` > 25 AND `Age` < 31 THEN 1 ELSE 0 END) as '2nd',

								SUM(CASE WHEN `Age` > 30 AND `Age` < 36 THEN 1 ELSE 0 END) as '3rd',

								SUM(CASE WHEN `Age` > 35 AND `Age` <= 42 THEN 1 ELSE 0 END) as '4th',

								SUM(CASE WHEN `Age` > 42 AND `Age` <= 50 THEN 1 ELSE 0 END) as '5th',

								SUM(CASE WHEN `Age` > 50 THEN 1 ELSE 0 END) as '6th'  ".$mainQuery."

								where  DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$startDate."' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$endDate	."'";

				$result = $conn->query($agebracket1);

				$row = $result->fetch_assoc();

				echo "<script>ageGoogle.push(".$row['1st'].")</script>";

				echo "<script>ageGoogle.push(".$row['2nd'].")</script>";

				echo "<script>ageGoogle.push(".$row['3rd'].")</script>";

				echo "<script>ageGoogle.push(".$row['4th'].")</script>";

				echo "<script>ageGoogle.push(".$row['5th'].")</script>";

				echo "<script>ageGoogle.push(".$row['6th'].")</script>";



		

				/*Application Status*/

				$statussql = "SELECT 

				SUM(CASE WHEN Status = 'Pending' AND DATEDIFF(now(),DATE_FORMAT(`Timestamp`, '%Y-%m-%d'))<60 then 1 else 0 end)  as 'Pending',

				SUM(CASE WHEN Upper(`Status`) like '%INTERVIEW%' AND  DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-01-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-12-31' THEN 1 ELSE 0 END) as 'interview',

				SUM(CASE WHEN UPPER(`Status`) = 'NO SHOW' AND  DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-01-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-12-31' THEN 1 ELSE 0 END) as 'scheduled'

				".$mainQuery;

				$statusresult = $conn->query($statussql);

				while($row = $statusresult->fetch_assoc()){

					echo "<script>statusNew += ".$row['Pending']."</script>";

					echo "<script>statusSched += ".$row['scheduled']."</script>";

					echo "<script>statusAccepted += ".$row['interview']."</script>";

				}

				/*--START--*/

				$statussql2 = "SELECT Count(`Status`) as 'comment' ".$mainQuery." where UPPER(`Status`) in ('FAILED','REJECTED') ";

				$statusresult2 = $conn->query($statussql2);

				while($row = $statusresult2->fetch_assoc()){

					echo "<script>statusComment += ".$row['comment']."</script>";

				}

				/*--END--*/

				

				/*Position*/

				$a = array();

				$topFive = "select distinct position, count(position) as 'total',(select position_name from tbl_position where id = tbl_application.position) as 'title' from tbl_application group by position order by `total` desc limit 15";

				$topresult = $conn->query($topFive);

				while($toprow = $topresult->fetch_assoc()){

					array_push($a,$toprow['title']);

					echo "<script>locationI.push('".$toprow['title']."');</script>";

					$locationsqlG = "SELECT SUM(CASE WHEN `Job Title` = '".$toprow['title']."' THEN 1 ELSE 0 END) as '".$toprow['title']."' ".$mainQuery."  where  DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-01-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-12-31'";

					$locresult = $conn->query($locationsqlG);			

						while($locrow = $locresult->fetch_assoc()){

							echo "<script>locationG.push('".$locrow[''.$toprow['title']]."');</script>";

						}			

					

				}



			/*Monthly*/	
			/*$slqStatus = "SELECT * FROM tbl_application";
			$resultStatus = $conn->query($slqStatus);
			while ($rowStatus = $resultStatus->fetch_assoc()){
			*/

				$monthsql = "SELECT SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-01-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') < '".$currentYear."-02-01' THEN 1 ELSE 0 END) as 'january', 

									SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-02-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') < '".$currentYear."-03-01' THEN 1 ELSE 0 END) as 'february', 

									SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-03-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-03-31'  THEN 1 ELSE 0 END) as 'march',

									SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-04-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-04-30' THEN 1 ELSE 0 END) as 'april', 

									SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-05-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-05-31' THEN 1 ELSE 0 END) as 'may',

									SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-06-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-06-30' THEN 1 ELSE 0 END) as 'june',

									SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-07-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-07-31' THEN 1 ELSE 0 END) as 'july',

									SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-08-01' AND  DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-08-31' THEN 1 ELSE 0 END) as 'august', 

									SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-09-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-09-30' THEN 1 ELSE 0 END) as 'september',  

									SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-10-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-10-31' THEN 1 ELSE 0 END) as 'october',

									SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-11-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-11-30' THEN 1 ELSE 0 END) as 'november', 

									SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-12-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-12-31' THEN 1 ELSE 0 END) as 'december' ".$mainQuery;

				

		/*	if ($rowStatus['Status'] = 'Pending'){	*/
				

				if($monthresult = $conn->query($monthsql)){

					while($row = $monthresult->fetch_assoc()){

						echo "<script>monthly.push(".$row['january'].")</script>";

						echo "<script>monthly.push(".$row['february'].")</script>";

						echo "<script>monthly.push(".$row['march'].")</script>";

						echo "<script>monthly.push(".$row['april'].")</script>";

						echo "<script>monthly.push(".$row['may'].")</script>";

						echo "<script>monthly.push(".$row['june'].")</script>";

						echo "<script>monthly.push(".$row['july'].")</script>";

						echo "<script>monthly.push(".$row['august'].")</script>";

						echo "<script>monthly.push(".$row['september'].")</script>";

						echo "<script>monthly.push(".$row['october'].")</script>";

						echo "<script>monthly.push(".$row['november'].")</script>";

						echo "<script>monthly.push(".$row['december'].")</script>";

					}

				}
		/*	}
		}*/
			



			/*Source*/

				$sourceSql = "select sum(Case when Application_source ='Job street' or Application_source = 'Jobstreet'then 1 else 0 end) as 'Job street',

				sum(Case when Application_source ='Linked In' then 1 else 0 end) as 'Linked In',

				sum(Case when Application_source ='Facebook' then 1 else 0 end) as 'Facebook',

				sum(Case when Application_source ='From a Friend' or Application_source ='Referral' then 1 else 0 end) as 'From a Friend',

				sum(Case when Application_source ='Website' or Application_source ='AndersonGroup Site' then 1 else 0 end) as 'Website',

				sum(Case when Application_source ='Others' or Application_source ='' then 1 else 0 end) as 'Others',
				
				sum(Case when Application_source ='Walk-in' or Application_source ='Walk in' then 1 else 0 end) as 'Walk-in',
				
				sum(Case when Application_source ='Jobfair' then 1 else 0 end) as 'Jobfair',
				
				sum(Case when Application_source ='Indeed' then 1 else 0 end) as 'Indeed'	".$mainQuery ;

			

				if($sourceResult = $conn->query($sourceSql)){

					while($row = $sourceResult->fetch_assoc()){

						echo "<script>allSource.push(".$row['Job street'].")</script>";

						echo "<script>allSource.push(".$row['Linked In'].")</script>";

						echo "<script>allSource.push(".$row['Facebook'].")</script>";

						echo "<script>allSource.push(".$row['From a Friend'].")</script>";

						echo "<script>allSource.push(".$row['Website'].")</script>";

						/* echo "<script>allSource.push(".$row['Others'].")</script>"; */
						
						echo "<script>allSource.push(".$row['Walk-in'].")</script>";
						
						echo "<script>allSource.push(".$row['Jobfair'].")</script>";
						
						echo "<script>allSource.push(".$row['Indeed'].")</script>";

					}

				}
				
			/*Locations*/

				$locationSql = "select sum(Case when CURRENT_REGION = 'Metro Manila (NCR)' then 1 else 0 end) as 'NCR',

				sum(Case when CURRENT_REGION = 'Ilocos Region' then 1 else 0 end) as 'Ilocos Region',

				sum(Case when CURRENT_REGION = 'Cagayan Valley' then 1 else 0 end) as 'Cagayan Valley',

				sum(Case when CURRENT_REGION = 'Central Luzon' then 1 else 0 end) as 'Central Luzon',

				sum(Case when CURRENT_REGION = 'CALABARZON' then 1 else 0 end) as 'CALABARZON',

				sum(Case when CURRENT_REGION = 'MIMARO' then 1 else 0 end) as 'MIMAROPA',
				
				sum(Case when CURRENT_REGION = 'Bicol Region' then 1 else 0 end) as 'Bicol Region',
				
				sum(Case when CURRENT_REGION = 'Western Visayas' then 1 else 0 end) as 'Western Visayas',
				
				sum(Case when CURRENT_REGION = 'Central Visayas' then 1 else 0 end) as 'Central Visayas',

				sum(Case when CURRENT_REGION = 'Eastern Visayas' then 1 else 0 end) as 'Eastern Visayas',
				
				sum(Case when CURRENT_REGION = 'Zamboanga Peninsula' then 1 else 0 end) as 'Zamboanga Peninsula',
				
				sum(Case when CURRENT_REGION = 'Northern Mindanao' then 1 else 0 end) as 'Northern Mindanao',
				
				sum(Case when CURRENT_REGION = 'Davao Region' then 1 else 0 end) as 'Davao Region',
				
				sum(Case when CURRENT_REGION = 'SOCCSKSARGEN' then 1 else 0 end) as 'SOCCSKSARGEN',
				
				sum(Case when CURRENT_REGION = 'CARAGA' then 1 else 0 end) as 'CARAGA',
				
				sum(Case when CURRENT_REGION = 'ARMM' then 1 else 0 end) as 'ARMM',
				
				sum(Case when CURRENT_REGION = 'Cordillera Administrative Region (CAR)' then 1 else 0 end) as 'CAR' ".$mainQuery ;

			

				if($locationResult = $conn->query($locationSql)){

					while($row = $locationResult->fetch_assoc()){

						echo "<script>allLocation.push(".$row['NCR'].")</script>";

						echo "<script>allLocation.push(".$row['Ilocos Region'].")</script>";

						echo "<script>allLocation.push(".$row['Cagayan Valley'].")</script>";

						echo "<script>allLocation.push(".$row['Central Luzon'].")</script>";

						echo "<script>allLocation.push(".$row['CALABARZON'].")</script>";

						echo "<script>allLocation.push(".$row['MIMAROPA'].")</script>";

						echo "<script>allLocation.push(".$row['Bicol Region'].")</script>";

						echo "<script>allLocation.push(".$row['Western Visayas'].")</script>";

						echo "<script>allLocation.push(".$row['Central Visayas'].")</script>";

						echo "<script>allLocation.push(".$row['Eastern Visayas'].")</script>";

						echo "<script>allLocation.push(".$row['Zamboanga Peninsula'].")</script>";

						echo "<script>allLocation.push(".$row['Northern Mindanao'].")</script>";

						echo "<script>allLocation.push(".$row['Davao Region'].")</script>";

						echo "<script>allLocation.push(".$row['SOCCSKSARGEN'].")</script>";

						echo "<script>allLocation.push(".$row['CARAGA'].")</script>";

						echo "<script>allLocation.push(".$row['ARMM'].")</script>";

						echo "<script>allLocation.push(".$row['CAR'].")</script>";
					}

				}

?>




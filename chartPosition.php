<?php

	$sql = "Select a.position_name as 'Description',sum(case when a.position_name = myTable.`Job Title` then 1 else 0 end) as 'counter' from(SELECT tbl_application.ID as 'ID',
				`NAME` as `Name`,
				`Timestamp` as 'Timestamp',
				`Email Address` as 'Email',
				`Contact No.` as 'Contact Number',
				`status` as 'Status',
				`Current Address` as 'Address',
				concat(`3.2 Position Title`, ' ', `2.2 Position Title`,' ',`1.2 Position Title`,' ',`4.2 Position Title`) as 'Previous Jobs',
				`Col_degree Course` as 'Course',
				(select `position_name` from tbl_position where `id` = `Position`) as 'Job Title',
				'tbl_application' as 'Source',
				`Gender` as 'Gender',
				`Age` as 'Age',
				`Note` as 'note',
				(CASE 
				  WHEN `Schedule` ='0000-00-00 00:00:00' THEN ''
				  ELSE SCHEDULE
				END) as `schedule`
		FROM tbl_application )myTable INNER JOIN tbl_position as a where   DATE_FORMAT(myTable.`Timestamp`, '%Y-%m-%d') between '".$startDate."' and '".$endDate."' GROUP BY a.position_name order by counter asc ";
									



									
		$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
				echo "
					<tr name = '".$row['Description']."'>
						<td><h6>".$row['Description']."</h6>
						</td>
						<td><h6>".$row['counter']."</h6>
						</td>
						
					</tr>
				";
		}
	}


?>
<?php
	require_once('auth.php');
	require_once('connect.php');
	if(isset($_POST['search'])) {
		$name = $_POST['search'];
		$string = '%'.$name.'%';
		$query = "SELECT ID, NAME, POSITION, `EMAIL ADDRESS` EMPLOYMENT_DATE, APPLICATION_SOURCE, `COL_Name of School`, `GRAD_Degree Course`, COL_Graduated FROM tbl_application WHERE (NAME LIKE '$string' OR POSITION LIKE '$string' OR `EMAIL ADDRESS` LIKE '$string' OR 'EMPLOYMENT_DATE' LIKE '$string' OR APPLICATION_SOURCE LIKE '$string' OR `COL_Name of School` LIKE '$string' OR `GRAD_Degree Course` LIKE '$string' OR COL_Graduated LIKE '$string') AND NOT NAME=',' AND NOT `EMAIL ADDRESS`='' ORDER BY ID";
		$result = $conn->query($query);
		$count = $result->num_rows;
		if($count <= 1) {
			$label = "applicant";
		} else {
			$label = "applicants";
		}
		echo '<table id="applicants" class="table table-condensed table-hover">';
		echo '<thead>';
		echo '<tr>';
		echo '<th>Name</th>';
		echo '<th>Position Applied</th>';
		echo '<th>Employment Date</th>';
		echo '<th>Application Source</th>';
		echo '<th>Education Status</th>';
		echo '<th>School</th>';
		echo '<th>Course</th>';
		echo '<th>Action</th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		while($row = $result->fetch_assoc()){
			echo '<tr class="applicant-data" data-toggle="modal" data-target="#applicant-info" data-id="'.$row['ID'].'">';
			echo '<td>'.$row['NAME'].'</td>';
			echo '<td>'.$row['POSITION'].'</td>';
			echo '<td>'.$row['EMPLOYMENT_DATE'].'</td>';
			echo '<td>'.$row['APPLICATION_SOURCE'].'</td>';
			if ($row['COL_Graduated']=="YES") 
                      		{ echo "<td> Graduated </td> "; } 
            else if ($row['COL_Graduated']=="NO") 
                       		{ echo "<td> Undergraduate </td>"; }
			echo '<td>'.$row['COL_Name of School'].'</td>';
			echo '<td>'.$row['GRAD_Degree Course'].'</td>';
			echo '<td>
					<button class="btn btn-danger btn-sm" onClick="return remove_applicant(this);" data-dismiss="modal" title="Remove" style="padding-left:20px;padding-right:20px;color: black" data-dismiss="toggle"
					 	data-content="<?php echo '.$row['ID'].'; ?>">
					 <span class="fa fa-trash"></span>
	                </button>
	             </td>';
			echo '</tr>';
		}
		echo '</tbody>';
		echo '</table>';
		echo '<center>';
		echo '<span>Total: '.$count.' '.$label.'</span>';
		echo '</center>';
	}
?>
<script type="text/javascript">
	$('.applicant-data').click(function(e) {
		var applid = $(this).attr("data-id");
           	$.ajax({
               type: "POST",
               url: "applicant-data.php",
               data: {
                   aid: applid
               },
               success: function(html) {
                   $("#modal-info").html(html).show();
               }
           });
	});
</script>

<script type="text/javascript">
		// remove application source
		 function remove_applicant(e) {
            var id = $(e).attr('data-content');
            var del = confirm("Are you sure to remove this source application?");
            if (del == true) {
                $.ajax({
                    type: "POST",
                    url: 'config/remove_applicant.php',
                    data: {id : id},
                    success:(function(data){
                        alert(data);
                        location.reload();
                    })
                });
                return true;
            } else {
                return false;
            }
        }
</script>
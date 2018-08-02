<html>
<select name="taskOption">
  <option value="1">First</option>
  <option value="2">Second</option>
  <option value="3">Third</option>
</select>
<input type = 'submit' name = 'save' value = "Submit">

<?php
include 'connect.php';
	if (isset($_POST['save'])){
		$selected_value = $_POST['taskOption'];
		$sqlInsert = "INSERT INTO tbl_useractionlogs (username, updated_fieldname, updated_date, new_value) VALUES ()";
	}
	else{
		
	}
?>
</html>
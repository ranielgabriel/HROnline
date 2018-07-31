<?php
	include ('connect.php');
	$id = $_POST['id'];

    $sqlDelete = "DELETE FROM tbl_application WHERE ID = '".$id."' ";
    $result = $conn->query($sqlDelete);
    if ($result == true) {
        echo "Application source has been removed!";
    }
    else {
        echo "An Error has occured!";
    }

?>
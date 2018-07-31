<?php
include('connect.php');

    $id = $_POST['id'];

    $sqlDelete = " UPDATE tbl_sourceapplication SET flag = '1' WHERE application_num = '".$id."' ";
    $result = $conn->query($sqlDelete);
    if ($result == true) {
        echo "Application source has been removed!";
    }
    else {
        echo "An Error has occured!";
    }
?>
<html>
<?php
$dbhost = "localhost"; //MySQL Server    
$dbuser = "root"; //MySQL Username     
$dbpass = "";             //MySQL Password     
$dbname = "hr_online_app_db4";         //MySQL Database Name  
//$DB_TBLName = "tbl_application"; //MySQL Table Name  
        $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
         if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = /*"CREATE TABLE tbl_accounts( ".
            "id INT NOT NULL AUTO_INCREMENT, ".
            "username VARCHAR(50) NOT NULL, ".
            "password VARCHAR(60) NOT NULL, ".
            "role VARCHAR(60) NOT NULL, ".
            "PRIMARY KEY ( id )); ";*/
			
	$sql =		"ALTER TABLE tbl_accounts
ADD age VARCHAR(45); ";

			
		if ($conn->query($sql) === TRUE) {
    echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>


</html>
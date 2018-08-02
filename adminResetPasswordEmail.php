
<?php 

    require 'connect.php';
    require 'validation_form.php';

    //variable declaration
    $admin_email = '';
    $admin_id = '';
    $random_code = 0;
    
    if(isset($_POST['btnResetPassword'])){
        
        inputValidation($admin_email = $_POST['txtAdminEmail']);

        $sql = "SELECT id, email FROM tbl_admin WHERE email = '{$admin_email}'";
        $result = $conn->query($sql);

        if($result->num_rows === 1){            
            //Generate a random code 6 digit
            $random_code = mt_rand(600000, 900000);

            //retrieve id of the admin
            $row = $result->fetch_assoc();
            $admin_id = $row['id'];

            //save to database 
            $sql = "INSERT INTO `tbl_reset_code` (reset_code_id, admin_id, reset_code_timestamp, reset_code, admin_email) VALUES(NULL, '{$admin_id}', CURRENT_TIMESTAMP, '{$random_code}', '{$admin_email}')";
            $result = $conn->query($sql);

            //send to email 6 digit code
            // $to = $admin_email;
            // $subject = "PASSWORD RESET CODE";
            // $reset_code = $random_code;
            // $headers = "From: Anderson Group BPO";
            // mail($to,$subject,$reset_code,$headers);

            //retrieve the latest timestamp of specific user
            $sql = "SELECT MAX(reset_code_timestamp) FROM tbl_reset_code WHERE admin_email ='{$admin_email}'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();

            echo $row;

            //redirect to change password
            header("Location: ../HRonline-master/adminChangePassword.php?id=$admin_id"); 

        }else{
            echo '<script type="text/javascript">';
            echo 'alert("Email do not exist!")';
            echo '</script>';
        }  
    }       

    $conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    
    <title> Reset Code </title>
</head>
<body>

    <div class="jumbotron">
        <h1 class="text-center"> Anderson Recruits </h1>
    </div>

    <div class="container"> 
    
        <div class="col-md-3">

        </div>

        <div class="col-md-6">

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                <div class="form-group">
                    <label for="email"> Email </label>
                    <input type="email" class="form-control" id="admin_email" placeholder="Enter email" name="txtAdminEmail" required>
                </div>
                
                <button type="submit" class="btn btn-primary" name="btnResetPassword"> Submit </button>
        </form>

        </div>

        <div class="col-md-3"> 

        </div>

    </div>

    <!-- JAVASCRIPT -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
</body>
</html>
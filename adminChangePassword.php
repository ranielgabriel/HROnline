<?php 

    require 'connect.php';
    require 'validation_form.php';

    //variable declaration
    if (isset($_POST['admin_id'])){
        $id = $_POST['admin_id'];
    }
   
    $new_password = '';
    $confirm_password = '';


    // function for the submit button
    // if(isset($_POST['btnChangePassword'])){
    //     //retrieving form data
    //     inputValidation($new_password = $_POST['txtNewPassword']);
    //     inputValidation($confirm_password = $_POST['txtConfirmPassword']);

    //     // retrieving code from database
    //     $sql = "SELECT `reset_code_timestamp`, `reset_code`, `reset_code_id`, `admin_id` FROM `tbl_reset_code` WHERE `admin_id` = '".$id."' AND `reset_code` = '".$_POST['input_reset_code']."' ";
    //     $result = $conn->query($sql);

    //     if ($result->num_rows===1){

    //         if($admin_new_password === $admin_confirm_password){
    //             $sqlmodifypw = "UPDATE tbl_admin SET password = '".$admin_new_password."' WHERE id = '".$id."' ";
    //             $resultmodify = $conn->execute($sqlmodifypw);
    //             if($resultmodify == true){
    //                 echo 'Password is now modified';
    //             }else{
    //                 echo 'An error has occured!';
    //             }
    //         }else if (($admin_confirm_password !== $admin_new_password) || ($admin_new_password !== $admin_confirm_password)){
    //             echo 'Input password mismatched';
    //         }
    //     }


    // }


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
    
    <!--custom css -->
    <link rel="stylesheet" href="custom_css/password_reset.css">
    <title> Change Password </title>
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
                    <label for="admin_new_password"> New Password </label>
                    <input type="password" class="form-control" placeholder="New Password" id="admin_new_password" name="txtNewPassword" required>
                </div>

                <div class="form-group">
                    <label for="admin_confirm_password"> Confirm Password </label>
                    <input type="password" class="form-control" id="admin_confirm_password" placeholder="Confirm Password" name="txtConfirmPassword" required>
                </div>

                <!-- <div class="form-group">
                    <label for="input_reset_code"> 6 Digit Code </label>
                    <input type="number" class="form-control" id="input_reset_code" placeholder="Enter 6 digit code" name="txtResetCode" required>
                </div> -->
                
                <button type="submit" class="btn btn-default" name="btnChangePassword">Reset</button>

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
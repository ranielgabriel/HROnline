<?php 

    //validation function
    //returns validated input
    function inputValidation($data){
        
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        
        return($data);
    }

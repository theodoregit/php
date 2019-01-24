<?php
    $connection = mysqli_connect("localhost", "root", "", "farm");

    //check the connectivity
    if(mysqli_connect_errno()){
        die("Database connection failed: " . mysqli_connect_error() . "(" . mysqli_connect_errno() . ")");
    }

    session_start();
    $new_comer = $_SESSION["userid"];
    $queried_dept = "";
    $query2 = "select * from users ";
    $query2 .= "where userid = '{$new_comer}'";

    $result2 = mysqli_query($connection, $query2);
        
    while($row = mysqli_fetch_assoc($result2)){
        $queried_fullname = $row["fullname"];
    }

    $table = "";
    switch($queried_dept){
        case "Chemical Dispensary":
            $table = "chemicals";
            break;
        case "Drug Dispensary":
            $table = "drugs";
            break;
        case "Seeds Dispensary":
            $table = "seeds";
            break;
        case "Fertilizers Dispensary":
            $table = "fertilizers";
            break;
        case "Farm Tools Dispensary":
            $table = "farmtools";
            break;
    }
    

    //hold the values from $_POST
    $new_password = $_POST["pass_one"];    
    $re_password = $_POST["pass_two"];

    $passes = array();
    
    if($new_password === $re_password){
        //check the uniqueness of the password
        $check = "select userid from users";
        $res = mysqli_query($connection, $check);
        while($row = mysqli_fetch_assoc($res)){
            $queried_pass = $row["userid"];
            array_push($passes, $queried_pass);
        }
        if(in_array($new_password, $passes)){
            header("Location: change-password.html");
        }

        else{
            $query = "update users set userid = '{$new_password}' where fullname = '{$queried_fullname}'";
            $result = mysqli_query($connection, $query);
            if(!$result){
                echo "Error while changing the password";
            }
            else{
                header("Location: login.html");
                // echo $queried_pass;
            }
        }
        
    }
    else{
        header("Location: login.html");
    }  

    
    

        

    mysqli_close($connection);
?>
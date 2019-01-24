<?php
    $connection = mysqli_connect("localhost", "root", "", "farm");

    //check the connectivity
    if(mysqli_connect_errno()){
        die("Database connection failed: " . mysqli_connect_error() . "(" . mysqli_connect_errno() . ")");
    }

    //hold the values from $_POST
    $user_name = $_POST["user_name"];
    // $underscored = str_replace(" ", "_", $item_name);
    $dept = $_POST["dept"];
    $salary = $_POST["salary"];
    $userid = $_POST["id"];
    $converted = floatval($salary);
    $time = date("H:m");
     
    echo $user_name . $dept . $salary;
    
    // $query3 = "insert into users (fullname, department, salary, userid) values('{$user_name}', '{$dept}', {$salary}, '{$userid}')";
    $query3 = "update users set department = '{$dept}', salary = {$salary}, userid = '{$userid}', date = current_timestamp where fullname = '{$user_name}'";

    $result3 = mysqli_query($connection, $query3);
    if(!$result3){
        echo "Error while inserting into users";
    }
    else{
        header("Location: update-user-info.php");
    }

    mysqli_close($connection);
?>
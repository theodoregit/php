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
    
    $query3 = "insert into users (fullname, department, salary, userid) values('{$user_name}', '{$dept}', {$salary}, '{$userid}')";
    
    $result3 = mysqli_query($connection, $query3);
    if(!$result3){
        echo "Error while inserting into users";
    }
    else{
        header("Location: add-new-user.php");
    }

        $drop1 = "alter table users drop id";
        $result_drop1 = mysqli_query($connection, $drop1);
        $auto1 = "alter table users auto_increment = 1";
        $result_auto1 = mysqli_query($connection, $auto1);
        $add1 = "alter table users add id int not null auto_increment primary key first";
        $result_add1 = mysqli_query($connection, $add1);

    
    mysqli_close($connection);
?>
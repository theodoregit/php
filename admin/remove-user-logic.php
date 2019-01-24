<?php
    $connection = mysqli_connect("localhost", "root", "", "farm");

    //check the connectivity
    if(mysqli_connect_errno()){
        die("Database connection failed: " . mysqli_connect_error() . "(" . mysqli_connect_errno() . ")");
    }

    //hold the values from $_POST
    $user_name = $_POST["fullname"];
    echo $user_name;
    

    //fetch name of students from database and assign to the option DOM element
    $query1 = "delete from users where fullname = '{$user_name}'";
    $result1 = mysqli_query($connection, $query1);
    if(!$result1){
        echo "Error while deleting";
    }
    else{
        $query2 = "alter table users drop id";
        $result2 = mysqli_query($connection, $query2);
        $query3 = "alter table users auto_increment = 1";
        $result3 = mysqli_query($connection, $query3);
        $query4 = "alter table users add id int not null auto_increment primary key first";
        $result4 = mysqli_query($connection, $query4);
        header("Location: remove-user.php");
    }
    


    mysqli_close($connection);
?>
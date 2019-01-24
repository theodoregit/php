<?php
    $connection = mysqli_connect("localhost", "root", "", "farm");

    //check the connectivity
    if(mysqli_connect_errno()){
        die("Database connection failed: " . mysqli_connect_error() . "(" . mysqli_connect_errno() . ")");
    }

    //Generate a random string.
    $token = openssl_random_pseudo_bytes(16);
    
    //Convert the binary data into hexadecimal representation.
    $token = bin2hex($token);
    
    //Print it out for example purposes.
    // echo $token;

    $username = $_POST["username"];
    $password = $_POST["password"];

    //let's validate the teacher form
    // if(!isset($email) || empty($email) || !isset($password) || empty($password)){
    //     echo "Failed";
    //     //here we need a modal to notify the the user unsuccessful login and remain in the login page
    //     //and exit from the code or leave other codes below it
    // }
    //query the teacher data from the database
    $query = "select username, password from admin";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die("Query failed");
    }
    //let's bring the email and password
    while($row = mysqli_fetch_assoc($result)){
        $username_queried = $row["username"];
        $password_queried = $row["password"];
        if($username == $username_queried && $password == $password_queried){
            header("Location: menu.html");
        }
        else{
            echo "Failed";
        }
    }
    //let's validate the user against the database result
    

    

    mysqli_close($connection);

?>
<?php
    $connection = mysqli_connect("localhost", "root", "", "farm");

    //check the connectivity
    if(mysqli_connect_errno()){
        die("Database connection failed: " . mysqli_connect_error() . "(" . mysqli_connect_errno() . ")");
    }

    

    $userid = $_POST["userid"];
    
    
    $query = "select userid, department from users";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die("Query failed");
    }
    while($row = mysqli_fetch_assoc($result)){
        $idnumber_queried = $row["userid"];
        $dept_queried = $row["department"];        
        if($idnumber_queried == $userid){
            switch($dept_queried){
                case "Chemical Dispensary":
                    header("Location: records/record-menu.html");
                    break;
                case "Drug Dispensary":
                    header("Location: records/record-menu.html");
                    break;
                case "Farm Tools Dispensary":
                    header("Location: records/record-menu.html");
                    break;
                case "Seeds Dispensary":
                    header("Location: records/record-menu.html");
                    break;
                case "Fertilizers Dispensary":
                    header("Location: records/record-menu.html");
                    break;
                case "Clinical Service":
                    header("Location: records/clinical-service.php");
                    break;
                case "General Store":
                    header("Location: records/record-new-items-general.php");
                    break;
            }          
        }
        else{
            // header("Location: login.html");
            // header("Location: login.html");
        }
    }
    echo "Incorrect password";
    //let's validate the user against the database result
    


    //let's make the $idnumber variable global
    session_start();
    $_SESSION["userid"] = $userid;
    


    // if(isset($_POST["submit"])){
    //     header("Location: ../grade/fill-grade.html");
    // }

    

    mysqli_close($connection);

?>
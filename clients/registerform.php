
<?php
    //let's connect mysql server

    $connection = mysqli_connect("localhost", "root", "", "portal");

    //check the connectivity
    if(mysqli_connect_errno()){
        die("Database connection failed: " . mysqli_connect_error() . "(" . mysqli_connect_errno() . ")");
    }
    
    $student_names = array();
    

    //create a table for each students
    $fullname = $_POST["fullname"];
    $idnumber = $_POST["idnumber"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repassword = $_POST["repassword"];

    //let's do some validation here

    $query2 = "insert into students (fullname, idnumber, email, password) values ('".$fullname."', '".$idnumber."', '".$email."', '".$password."')";
    $result2 = mysqli_query($connection, $query2);
    if(!$result2){
        echo "insertion failed";
    }


    //let's create a table for each students to handle their bussiness separately
    $trimmed = trim($fullname);
    $underscored = str_replace(" ", "_", $trimmed);
    echo $underscored;

    $query1 = "create table " . $underscored . "(id int(10) not null auto_increment, course varchar(30) not null, average float(10) not null, grade varchar(10) not null, primary key(id))";
    
    $result = mysqli_query($connection, $query1);
    if(!$result){
        die("query failed.");
    }
    else{
        $query3 = "insert into {$underscored} (course, average, grade) ";
        $query3 .= "values('Programming', 0, 'NG')";
        $result3 = mysqli_query($connection, $query3);
        if(!$result3){
            echo "Error";
        }

        $query4 = "insert into {$underscored} (course, average, grade) ";
        $query4 .= "values('Logic', 0, 'NG')";
        $result4 = mysqli_query($connection, $query4);
        if(!$result4){
            echo "Error";
        }

        $query5 = "insert into {$underscored} (course, average, grade) ";
        $query5 .= "values('Writing', 0, 'NG')";
        $result5 = mysqli_query($connection, $query5);
        if(!$result5){
            echo "Error";
        }
        header("Location: login.html");
    }
    //close the connection
    mysqli_close($connection);
?>


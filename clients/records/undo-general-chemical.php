<?php
    // include 'record-saled-logic.php';
    $connection = mysqli_connect("localhost", "root", "", "farm");

    session_start();

    //check the connectivity
    if(mysqli_connect_errno()){
        die("Database connection failed: " . mysqli_connect_error() . "(" . mysqli_connect_errno() . ")");
    }

    $drop1 = "alter table generalstorechemical drop id";
    $result_drop1 = mysqli_query($connection, $drop1);
    $auto1 = "alter table generalstorechemical auto_increment = 1";
    $result_auto1 = mysqli_query($connection, $auto1);
    $add1 = "alter table generalstorechemical add id int not null auto_increment primary key first";
    $result_add1 = mysqli_query($connection, $add1);

    

    // $new_amount =  $_SESSION['export_amount'];
    $query5 = "delete from generalstorechemical order by id desc limit 1";
    $result5 = mysqli_query($connection, $query5);
    if(!$result5){
        echo "error";
    }
    else{
        //let's update other tables affected by the undo action
        // $new_amount =  $_SESSION['e_amount'];
        // $new_itemname =  $_SESSION['e_itemname'];
        // $new_spec =  $_SESSION['e_spec'];
        // $query3 = "select amount from generalstorechemical where itemname = '{$new_itemname}' and specification = '{$new_spec}'";
        // $result3 = mysqli_query($connection, $query3);        
        // while($row = mysqli_fetch_assoc($result3)){            
        //     $queried_amt = $row["amount"];
        // }
        // echo $new_amount;
        // $new_amounttt = $new_amount + $queried_amt;
        // $query = "update generalstorechemical set amount = '{$new_amounttt}' where itemname = '{$new_itemname}' and specification = '{$new_spec}'";
        // $result = mysqli_query($connection, $query);
        // if(!$result){
        //     echo "Error";
        // }
        // else{
        //     header("Location: record-withdraw-chemicals.php");
        // }
        header("Location: record-new-items-general.php");

    }

    $drop1 = "alter table generalstorechemical drop id";
    $result_drop1 = mysqli_query($connection, $drop1);
    $auto1 = "alter table generalstorechemical auto_increment = 1";
    $result_auto1 = mysqli_query($connection, $auto1);
    $add1 = "alter table generalstorechemical add id int not null auto_increment primary key first";
    $result_add1 = mysqli_query($connection, $add1);

      

    mysqli_close($connection);
?>
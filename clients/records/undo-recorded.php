<?php
    // include 'record-saled-logic.php';
    $connection = mysqli_connect("localhost", "root", "", "farm");

    //check the connectivity
    if(mysqli_connect_errno()){
        die("Database connection failed: " . mysqli_connect_error() . "(" . mysqli_connect_errno() . ")");
    }

    
    session_start();
    $new_comer = $_SESSION["userid"];
    $queried_dept = "";
    $query2 = "select department from users ";
    $query2 .= "where userid = '{$new_comer}'";

    $result2 = mysqli_query($connection, $query2);
        
    while($row = mysqli_fetch_assoc($result2)){
        $queried_dept = $row["department"];
    }

    // $drop1 = "alter table withdraw drop id";
    // $result_drop1 = mysqli_query($connection, $drop1);
    // $auto1 = "alter table withdraw auto_increment = 1";
    // $result_auto1 = mysqli_query($connection, $auto1);
    // $add1 = "alter table withdraw add id int not null auto_increment primary key first";
    // $result_add1 = mysqli_query($connection, $add1);

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
        case "Farm Tools Dispensary":
            $table = "farmtools";
            break;
        case "Fertilizers Dispensary":
            $table = "fertilizers";
            break;
    }
    // $amount = $_POST["amnt"];
    $item_table = $table . "items";
    $query5 = "delete from $item_table order by id desc limit 1";
    $result5 = mysqli_query($connection, $query5);
    if(!$result5){
        echo "error";
    }
    else{
        //let's update other tables affected by the undo action
        // $new_amount =  $_SESSION['export_amount'];
        // $new_itemname =  $_SESSION['export_itemname'];
        // $new_spec =  $_SESSION['export_spec'];
        // $query3 = "select amount from itemlist where itemname = '{$new_itemname}' and specification = '{$new_spec}'";
        // $result3 = mysqli_query($connection, $query3);
        
        // while($row = mysqli_fetch_assoc($result3)){            
        //     $queried_amt = $row["amount"];
        // }
        // // echo $queried_amt;
        // $new_amounttt = $new_amount + $queried_amt; //this amount is the total amount in the itemlist
        // $query = "update itemlist set amount = '{$new_amounttt}' where itemname = '{$new_itemname}' and specification = '{$new_spec}'";
        // $result = mysqli_query($connection, $query);

        // $update_spec_table = $table . "items";
        // $query4 = "update $update_spec_table set amount = '{$new_amounttt}' where itemname = '{$new_itemname}' and specification = '{$new_spec}'";
        // $result4 = mysqli_query($connection, $query4);


        // //update the gross tables
        // $new_price = $_SESSION['export_price'];
        // $new_gross = $_SESSION['export_gross'];
        // $table_gross = $table . "price";
        // $get_values = "select * from $table_gross where itemname = '{$new_itemname}'";
        // $result_values = mysqli_query($connection, $get_values);

        // // echo $new_price;

        // while($row = mysqli_fetch_assoc($result_values)){
        //     $queried_a = $row["amount"];
        //     $queried_p = $row["price"];
        //     $queried_g = $row["gross"];
        // }
        // $summed_amt = $queried_a - $new_amount;
        // $summed_prc = $queried_p - $new_price;
        // $summed_grs = $queried_g - $new_gross;
        // $query_gross = "update $table_gross set amount = '{$summed_amt}', price = '{$summed_prc}', gross = '{$summed_grs}' where itemname = '{$new_itemname}'";
        // $result = mysqli_query($connection, $query_gross);
        // if(!$result){
        //     // echo $summed_prc;
        // }
        // else{
        //     // echo $new_gross . " " . $new_price;
        //     header("Location: record-saled-items.php");
        // }

        header("Location: record-new-items.php");

        


        
        // header("Location: record-saled-items.php");
    }
      

    mysqli_close($connection);
?>
<?php
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

    $drop1 = "alter table $table drop id";
    $result_drop1 = mysqli_query($connection, $drop1);
    $auto1 = "alter table $table auto_increment = 1";
    $result_auto1 = mysqli_query($connection, $auto1);
    $add1 = "alter table $table add id int not null auto_increment primary key first";
    $result_add1 = mysqli_query($connection, $add1);

    $drop2 = "alter table price drop id";
    $result_drop2 = mysqli_query($connection, $drop2);
    $auto2 = "alter table price auto_increment = 1";
    $result_auto2 = mysqli_query($connection, $auto2);
    $add2 = "alter table price add id int not null auto_increment primary key first";
    $result_add2 = mysqli_query($connection, $add2);

    $itemtable = $table . "items";
    

    //hold the values from $_POST
    $item_name = $_POST["items"];
    $underscored = str_replace(" ", "_", $item_name);
    $amount = $_POST["amnt"];
    $specification = $_POST["spec"];
    $unit = $_POST["unit"];
    $converted = floatval($amount);
    $time = date("H:m");
    $customer = $_POST["customer"];
    $address = $_POST["address"];
    $remark = $_POST["remark"];
    
    $price = $_POST["price"];
    $price = $price * $amount;
    

    //let's grub the amount of item left
    $query5 = "select amount, price from itemlist where itemname = '{$item_name}'";
    $result5 = mysqli_query($connection, $query5);

    while($row = mysqli_fetch_assoc($result5)){
        $queried_amount = $row["amount"];
        $queried_price = $row["price"];
    }


    //let's calculate the gross
    $purchase_price = $amount * $queried_price;
    // $sell_price = $amount * $price;
    $gross = $price - $purchase_price;


    if($queried_amount >= $amount){
        $new_amount = $queried_amount - $amount;
        $query3 = "insert into $table (itemname, amount, specification, unit, price, grossprofit, customer, address, remark) values('{$item_name}', '{$converted}', '{$specification}', '{$unit}', '{$price}', '{$gross}', '{$customer}', '{$address}', '{$remark}')";
        $result3 = mysqli_query($connection, $query3);        
        if(!$result3){
            echo $gross;
            echo "Error while inserting into saledlist";
        }
        else{
            //update the itemlist table
            $query4 = "update itemlist set amount = '{$new_amount}' where itemname = '{$item_name}' and specification = '{$specification}'";
            $query44 = "update $itemtable set amount = '{$new_amount}' where itemname = '{$item_name}' and specification = '{$specification}'";
            
            $result4 = mysqli_query($connection, $query4);
            $result44 = mysqli_query($connection, $query44);
            if(!$result4 || !$result44){
                echo $specification . "<br>";
                echo "error while updating itemlist";
            }
            else{
                //update the gross table
                $table_gross = $table . "price";
                $get_values = "select * from $table_gross where itemname = '{$item_name}'";
                $result_values = mysqli_query($connection, $get_values);
                while($row = mysqli_fetch_assoc($result_values)){
                    $queried_a = $row["amount"];
                    $queried_p = $row["price"];
                    $queried_g = $row["gross"];
                }
                $summed_amt = $queried_a + $amount;
                $summed_prc = $queried_p + $price;
                $summed_grs = $queried_g + $gross;
                $query_gross = "update $table_gross set amount = '{$summed_amt}', price = '{$summed_prc}', gross = '{$summed_grs}' where itemname = '{$item_name}'";
                $result = mysqli_query($connection, $query_gross);
                if(!$result){
                    echo $summed_prc;
                }
                else{
                    header("Location: record-saled-items.php");
                }
                
            }            
        }        
    }
    else{        
        //pop up a modal that notifies the shortage of item
        echo "Error, amount of item requested to sell is greater than the actual amount.";
    }
    
    // session_start();
    $_SESSION['export_amount'] = $amount;
    $_SESSION['export_itemname'] = $item_name;
    $_SESSION['export_spec'] = $specification;
    $_SESSION['export_price'] = $price;
    $_SESSION['export_gross'] = $gross;
    

    mysqli_close($connection);
?>
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
    
    
    //hold the values from $_POST
    $item_name = $_POST["item_name"];    
    $category = $_POST["cat"];
    $main_cat = $_POST["main_cat"];
    $specification = $_POST["spec"];    
    // $disease = $_POST["disease"];
    $unit = $_POST["unit"];
    $amount = $_POST["amount"];
    // $price = $_POST["price"];
    $disname = $_POST["disname"];
    // $price = $fee * $amount * $number_of_animals;

    $cat = "";
    switch($main_cat){
        case "Chemical":
            $cat = "chemical";
            break;
        case "Drug":
            $cat = "drug";
            break;
        case "Seed":
            $cat = "seed";
            break;
        case "Farm Tool":
            $cat = "farmtool";
            break;
        case "Fertilizer":
            $cat = "fertilizer";
            break;
    }

    $store_table = "generalstore" . $cat;
    $withdraw_table = "withdraw" . $cat;

    $query5 = "select amount from $store_table where itemname = '{$item_name}'";
    $result5 = mysqli_query($connection, $query5);

    while($row = mysqli_fetch_assoc($result5)){
        $queried_amount = $row["amount"];
    }
    if($queried_amount >= $amount){
        $query = "insert into $withdraw_table (itemname, category, specification, unit, amount, dispensary) ";
        $query .= "values('{$item_name}', '{$category}', '{$specification}', '{$unit}', '{$amount}', '{$disname}')";

        $result = mysqli_query($connection, $query);
        if(!$result){
            echo "Error while inserting into saledlist";
        }
        else{
            //update all items in store list
            $query3 = "select amount, price from $store_table where itemname = '{$item_name}' and specification = '{$specification}'";
            $result3 = mysqli_query($connection, $query3);
            while($row = mysqli_fetch_assoc($result3)){
                $queried_amount = $row["amount"];
                // $queried_price = $row["price"];
            }
            $new_amount = $queried_amount - $amount;
            // $new_totalprice = $new_amount * $queried_price;
            $query4 = "update $store_table set amount = '{$new_amount}' where itemname = '{$item_name}' and specification = '{$specification}'";
            $result4 = mysqli_query($connection, $query4);
            header("Location: record-withdraw-" . $cat . "s.php");
        }
    }
    else{        
        echo "No enough items in the store";
    }


    $drop1 = "alter table $withdraw_table drop id";
    $result_drop1 = mysqli_query($connection, $drop1);
    $auto1 = "alter table $withdraw_table auto_increment = 1";
    $result_auto1 = mysqli_query($connection, $auto1);
    $add1 = "alter table $withdraw_table add id int not null auto_increment primary key first";
    $result_add1 = mysqli_query($connection, $add1);


    $_SESSION['e_amount'] = $amount;
    $_SESSION['e_itemname'] = $item_name;
    $_SESSION['e_spec'] = $specification;

        

    mysqli_close($connection);
?>
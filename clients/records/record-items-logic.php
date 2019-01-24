<?php
    $connection = mysqli_connect("localhost", "root", "", "farm");

    //check the connectivity
    if(mysqli_connect_errno()){
        die("Database connection failed: " . mysqli_connect_error() . "(" . mysqli_connect_errno() . ")");
    }
    session_start();
    $new_comer = $_SESSION["userid"];
    $queried_dept = "";
    $query4 = "select department from users ";
    $query4 .= "where userid = '{$new_comer}'";
    $result4 = mysqli_query($connection, $query4);
        
    while($row = mysqli_fetch_assoc($result4)){
        $queried_dept = $row["department"];
    }

    $table = "";
    switch($queried_dept){
        case "Drug Dispensary":
            $category = "Drug";
            $table = "drugs";
            break;
        case "Chemical Dispensary":
            $category = "Chemical";
            $table = "chemicals";
            break;
        case "Farm Tools Dispensary":
            $category = "Farm Tools";
            $table = "farmtools";
            break;
        case "Seeds Dispensary":
            $category = "Seeds";
            $table = "seeds";
            break;
        case "Fertilizers Dispensary":
            $category = "Fertilizers";
            $table = "fertilizers";
            break;
    }

    $itemtable = $table . "items";
    //let's update the id
    $drop1 = "alter table itemlist drop id";
    $result_drop1 = mysqli_query($connection, $drop1);
    $auto1 = "alter table itemlist auto_increment = 1";
    $result_auto1 = mysqli_query($connection, $auto1);
    $add1 = "alter table itemlist add id int not null auto_increment primary key first";
    $result_add1 = mysqli_query($connection, $add1);

    $drop1 = "alter table $itemtable drop id";
    $result_drop1 = mysqli_query($connection, $drop1);
    $auto1 = "alter table $itemtable auto_increment = 1";
    $result_auto1 = mysqli_query($connection, $auto1);
    $add1 = "alter table $itemtable add id int not null auto_increment primary key first";
    $result_add1 = mysqli_query($connection, $add1);


    //hold the values from $_POST
    $item_name = $_POST["item_name"];
    $underscored = str_replace(" ", "_", $item_name);
    $item_cat = $_POST["item_cat"];
    $unit = $_POST["unit"];
    $amount = $_POST["amnt"];
    $specification = $_POST["spec"];
    $converted = floatval($amount);
    $price = $_POST["prc"];  


    //let's check whether the item is already recorded or not
    $query5 = "select itemname, specification from itemlist";
    $result5 = mysqli_query($connection, $query5);
    $names = array();
    $specs = array();
    while($row = mysqli_fetch_assoc($result5)){
        $queried_itemname = $row["itemname"];
        $queried_spec = $row["specification"];
        //let's create empty arrays to hold the values returned from the database        
        array_push($names, $queried_itemname);
        array_push($specs, $queried_spec);
    }
    $key1 = array_search($item_name, $names);
    $key2 = array_search($specification, $specs);
    echo $specs[$key2];
    if($item_name === $names[$key1]){
        if($specification === $specs[$key2]){
            $query7 = "select * from itemlist where itemname = '{$item_name}' and specification = '{$specification}'";
            $result7 = mysqli_query($connection, $query7);
            while($row = mysqli_fetch_assoc($result7)){
                $queried_amount = $row["amount"];
                $queried_price = $row["price"];
            }
            $new_amount = $queried_amount + $amount;
            $new_price = (($queried_price * $queried_amount) + ($price * $amount))/ $new_amount;
            $query6 = "update itemlist set amount = '{$new_amount}', price = '{$new_price}' where itemname = '{$item_name}' and specification = '{$specification}'";
            $query66 = "update $itemtable set amount = '{$new_amount}', price = '{$new_price}' where itemname = '{$item_name}' and specification = '{$specification}'";

            $result6 = mysqli_query($connection, $query6);
            $result66 = mysqli_query($connection, $query66);
            if(!$result6 || !$result66){
                echo "Error while updating";
            }
            else{
                // echo "here1";
                    $affected_rows = mysqli_affected_rows($connection);  
                    if($affected_rows == 0){
                        $query3 = "insert into itemlist (itemname, category, itemcat, specification, unit, amount, price) values('{$item_name}', '{$category}', '{$item_cat}', '{$specification}', '{$unit}', {$amount}, '{$price}')";    
                        $query33 = "insert into $itemtable (itemname, category, itemcat, specification, unit, amount, price) values('{$item_name}', '{$category}', '{$item_cat}', '{$specification}', '{$unit}', {$amount}, '{$price}')";    
                        
                        $result3 = mysqli_query($connection, $query3);
                        $result33 = mysqli_query($connection, $query33);    
                        if(!$result3 || !$result33){
                            echo "1. Error while inserting...";
                        }
                        else{      
                            // echo "here2";          
                            header("Location: record-new-items.php");
                        }
                    }
                    else{
                        header("Location: record-new-items.php");
                    }
            }
        }
        else{
            $query3 = "insert into itemlist (itemname, category, itemcat, specification, unit, amount, price) values('{$item_name}', '{$category}', '{$item_cat}', '{$specification}', '{$unit}', {$amount}, '{$price}')";    
            $query33 = "insert into $itemtable (itemname, category, itemcat, specification, unit, amount, price) values('{$item_name}', '{$category}', '{$item_cat}', '{$specification}', '{$unit}', {$amount}, '{$price}')";    
            
            $result3 = mysqli_query($connection, $query3);
            $result33 = mysqli_query($connection, $query33);    
            if(!$result3 || !$result33){
                echo "1. Error while inserting...";
            }
            else{      
                // echo "here2";          
                header("Location: record-new-items.php");
            }
        }
        //let's get the existing amount
        
    }
    else{
        $query3 = "insert into itemlist (itemname, category, itemcat, specification, unit, amount, price) values('{$item_name}', '{$category}', '{$item_cat}', '{$specification}', '{$unit}', {$amount}, '{$price}')";    
        $query33 = "insert into $itemtable (itemname, category, itemcat, specification, unit, amount, price) values('{$item_name}', '{$category}', '{$item_cat}', '{$specification}', '{$unit}', {$amount}, '{$price}')";    
        
        $result3 = mysqli_query($connection, $query3);
        $result33 = mysqli_query($connection, $query33);   
        if(!$result3 || !$result33){
            echo "2. Error while inserting";
        }
        else{
            $table_gross = $table . "price";
            $gross_query = "insert into $table_gross (itemname, amount, price, gross) values('{$item_name}', 0, 0, 0)";
            $gross_result = mysqli_query($connection, $gross_query);
            header("Location: record-new-items.php");
        }        
    }
    $table_gross = $table . "price";
    $drop1 = "alter table $table_gross drop id";
    $result_drop1 = mysqli_query($connection, $drop1);
    $auto1 = "alter table $table_gross auto_increment = 1";
    $result_auto1 = mysqli_query($connection, $auto1);
    $add1 = "alter table $table_gross add id int not null auto_increment primary key first";
    $result_add1 = mysqli_query($connection, $add1);
       
    mysqli_close($connection);
?>
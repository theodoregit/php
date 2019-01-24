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
    function updatestatus(){
        $connection = mysqli_connect("localhost", "root", "", "farm");
        $dates = array();
        $expiries = array();
        $status_query = "select date, expirydate from generalstore";
        $status_result = mysqli_query($connection, $status_query);
        while($row = mysqli_fetch_assoc($status_result)){
            $queried_date = $row["date"];
            $queried_expiry = $row["expirydate"];
            //arrays
            array_push($dates, $queried_date);
            array_push($expiries, $queried_expiry);
        }

        $days_left = " days are left";
        $query3 = "select now()";
        $result3 = mysqli_query($connection, $query3);
        while($row = mysqli_fetch_assoc($result3)){
            $queried_now = $row["now()"];                        
        }
        
        for($i = 0; $i < count($dates); $i+=1){          
            $date = $dates[$i];
            $expiry = $expiries[$i];
            
            $up_query = "update generalstore set status = timestampdiff(day, '{$queried_now}', '{$expiry}') where date = '{$date}'";
            $up_result = mysqli_query($connection, $up_query);
            if(!$up_result){
                echo "here" . '<br>';
            }
            else{
                // echo $date . "<br>";
            }
        }
    }
    updatestatus();
    //let's update the status
    

    


    $drop1 = "alter table generalstore drop id";
    $result_drop1 = mysqli_query($connection, $drop1);
    $auto1 = "alter table generalstore auto_increment = 1";
    $result_auto1 = mysqli_query($connection, $auto1);
    $add1 = "alter table generalstore add id int not null auto_increment primary key first";
    $result_add1 = mysqli_query($connection, $add1);

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
        case "Fertilizer Dispensary":
            $table = "fertilizers";
            break;
    }
    

    //hold the values from $_POST
    $item_name = $_POST["item_name"];    
    $category = $_POST["cat"];
    $specification = $_POST["spec"];
    $unit = $_POST["unit"];
    $amount = $_POST["amount"];       
    // $price = $_POST["price"];
    $expirydate = $_POST["expiry"];
    
    //let's check whether the item is already here or not
    $query5 = "select itemname, specification, amount, expirydate from generalstore";
    $result5 = mysqli_query($connection, $query5);
    $names = array();
    $specs = array();
    while($row = mysqli_fetch_assoc($result5)){
        $queried_itemname = $row["itemname"];  
        $queried_spec = $row["specification"];  
        $queried_exdate = $row["expirydate"];  
        $queried_amount = $row["amount"];    

        array_push($names, $queried_itemname);
        array_push($specs, $queried_spec);
    }
    $key1 = array_search($item_name, $names);
    $key2 = array_search($specification, $specs);
    // $trimmed_exdate = trim(str_replace("00:00:00", " ", $queried_exdate));
    // echo $trimmed_exdate . "<br>";
    // echo $expirydate;
    // echo $queried_itemname . " == " . $item_name;
    // echo $names[$key1];
    if(count($names) === 0){
        // $totalprice = $amount * $price;
        $query = "insert into generalstore (itemname, category, specification, unit, amount, expirydate) ";
        $query .= "values('{$item_name}', '{$category}', '{$specification}', '{$unit}', '{$amount}', '{$expirydate}')";

        $result = mysqli_query($connection, $query);
        if(!$result){
            echo "Error here?";
        }
        else{
            header("Location: record-new-items-general.php");
        }
    }
    else{    
        if($item_name === $names[$key1]){
            if($specification === $specs[$key2]){            
                $query7 = "select amount from generalstore where itemname = '{$item_name}' and specification = '{$specification}'";
                $result7 = mysqli_query($connection, $query7);
                while($row = mysqli_fetch_assoc($result7)){
                    $queried_amountt = $row["amount"];
                    // $queried_price = $row["price"];
                }
                $new_amount = $amount + $queried_amountt;
                // $new_price = (($queried_amount * $queried_price) + ($amount * $price)) / $new_amount;
                // $totalprice = $new_amount * $new_price;
                $query = "update generalstore set ";
                $query .= "amount = '{$new_amount}', expirydate = '{$expirydate}' where itemname = '{$item_name}' and specification = '{$specification}'";
                $result = mysqli_query($connection, $query);
                if(!$result){
                    echo "Error while updating into generalstore";
                }
                else{
                    echo "<br>";
                    echo $new_amount . " == " . $queried_amountt;       
                    header("Location: record-new-items-general.php");
                }
                // if($trimmed_exdate === $expirydate){
                //     echo "here 3";
                //     $new_amount = $amount + $queried_amountt;
                //     $query = "update generalstore set ";
                //     $query .= "amount = '{$new_amount}' where itemname = '{$item_name}' and specification = '{$specification}'";
                //     $result = mysqli_query($connection, $query);
                //     if(!$result){
                //         echo "Error while updating into generalstore";
                //     }
                //     else{
                //         header("Location: record-new-items-general.php");
                //     }
                // }
                // else{
                //     $query = "insert into generalstore (itemname, category, specification, unit, amount, price, expirydate) ";
                //     $query .= "values('{$item_name}', '{$category}', '{$specification}', '{$unit}', '{$amount}', '{$price}', '{$expirydate}')";

                //     $result = mysqli_query($connection, $query);
                //     if(!$result){
                //         echo "Error while inserting into saledlist";
                //     }
                //     else{
                //         header("Location: record-new-items-general.php");
                //     }
                // }
            }
            else{
                // $totalprice = $amount * $price;
                $query = "insert into generalstore (itemname, category, specification, unit, amount, expirydate) ";
                $query .= "values('{$item_name}', '{$category}', '{$specification}', '{$unit}', '{$amount}', '{$expirydate}')";

                $result = mysqli_query($connection, $query);
                if(!$result){
                    echo "Error while inserting into saledlist";
                }
                else{
                    header("Location: record-new-items-general.php");
                }
            }
        }
        else{
            // $totalprice = $amount * $price;
            $query = "insert into generalstore (itemname, category, specification, unit, amount, expirydate) ";
            $query .= "values('{$item_name}', '{$category}', '{$specification}', '{$unit}', '{$amount}', '{$expirydate}')";

            $result = mysqli_query($connection, $query);
            if(!$result){
                echo "Error";
            }
            else{
                header("Location: record-new-items-general.php");
            }
        }
    }
    $dates = array();
    $expiries = array();
    $status_query = "select date, expirydate from generalstore";
    $status_result = mysqli_query($connection, $status_query);
    while($row = mysqli_fetch_assoc($status_result)){
        $queried_date = $row["date"];
        $queried_expiry = $row["expirydate"];
        //arrays
        array_push($dates, $queried_date);
        array_push($expiries, $queried_expiry);
    }
    $days_left = " days are left";
    for($i = 0; $i < count($dates); $i +=1){          
        $date = $dates[$i];
        $expiry = $expiries[$i];
           
        $up_query = "update generalstore set status = timestampdiff(day, '{$date}', '{$expiry}') where date = '{$date}'";
        $up_result = mysqli_query($connection, $up_query);
        if(!$up_result){
            echo "here" . '<br>';
        }
        else{
            echo $date . "<br>";
            echo "here";
        }
    }
    

        

    mysqli_close($connection);
?>
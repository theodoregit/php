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

    $drop1 = "alter table clinic drop id";
    $result_drop1 = mysqli_query($connection, $drop1);
    $auto1 = "alter table clinic auto_increment = 1";
    $result_auto1 = mysqli_query($connection, $auto1);
    $add1 = "alter table clinic add id int not null auto_increment primary key first";
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
    }
    

    //hold the values from $_POST
    $customer = $_POST["customer"];    
    $animal = $_POST["animal"];
    $number_of_animals = $_POST["number"];    
    $disease = $_POST["disease"];
    $unit = $_POST["unit"];
    $medicine = $_POST["medicine"];
    $amount = $_POST["amount"];       
    $fee = $_POST["fee"];
    $price = $fee * $number_of_animals;

    
    $query = "insert into clinic (customername, animalname, number, disease, medication, unit, amount, servicefee) ";
    $query .= "values('{$customer}', '{$animal}', '{$number_of_animals}', '{$disease}', '{$medicine}', '{$unit}', '{$amount}', '{$price}')";

    $result = mysqli_query($connection, $query);
    if(!$result){
        echo "Error while inserting into saledlist";
    }
    else{
        // $gross_clinic = "insert into clinicprice (animalname, number, price) values('{$animal}', 0, 0)";
        // $gross_result = mysqli_query($connection, $gross_clinic);

        // $get_values = "select * from clinicprice where animalname = '{$animal}'";
        // $result_values = mysqli_query($connection, $get_values);
        // while($row = mysqli_fetch_assoc($result_values)){
        //     $queried_num = $row["number"];
        //     $queried_prc = $row["price"];
        // }
        // $summed_num = $queried_num + $number_of_animals;
        // $summed_prc = $queried_prc + $price;

        // $query_gross = "update clinicprice set number = '{$summed_num}', price = '{$summed_prc}' where animalname = '{$animal}'";
        // $result = mysqli_query($connection, $query_gross);
        header("Location: clinical-service.php");
    }

        

    mysqli_close($connection);
?>
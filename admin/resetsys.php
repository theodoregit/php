<?php
    $connection = mysqli_connect("localhost", "root", "", "farm");

    //check the connectivity
    if(mysqli_connect_errno()){
        die("Database connection failed: " . mysqli_connect_error() . "(" . mysqli_connect_errno() . ")");
    }

    //chemicals
    $query_chemical1 = "delete from chemicals";
    $result_chemical1 = mysqli_query($connection, $query_chemical1);

    $query_chemical2 = "delete from chemicalsitems";
    $result_chemical2 = mysqli_query($connection, $query_chemical2);

    $query_chemical3 = "delete from chemicalsprice";
    $result_chemical3 = mysqli_query($connection, $query_chemical3);

    $query_chemical4 = "delete from generalstorechemical";
    $result_chemical4 = mysqli_query($connection, $query_chemical4);

    $query_chemical5 = "delete from withdrawchemical";
    $result_chemical5 = mysqli_query($connection, $query_chemical5);

    //drugs
    $query_drug1 = "delete from drugs";
    $result_drug1 = mysqli_query($connection, $query_drug1);

    $query_drug2 = "delete from drugsitems";
    $result_drug2 = mysqli_query($connection, $query_drug2);

    $query_drug3 = "delete from drugsprice";
    $result_drug3 = mysqli_query($connection, $query_drug3);

    $query_drug4 = "delete from generalstoredrug";
    $result_drug4 = mysqli_query($connection, $query_drug4);

    $query_drug5 = "delete from withdrawdrug";
    $result_drug5 = mysqli_query($connection, $query_drug5);

    //seeds
    $query_seed1 = "delete from seeds";
    $result_seed1 = mysqli_query($connection, $query_seed1);

    $query_seed2 = "delete from seedsitems";
    $result_seed2 = mysqli_query($connection, $query_seed2);

    $query_seed3 = "delete from seedsprice";
    $result_seed3 = mysqli_query($connection, $query_seed3);

    $query_seed4 = "delete from generalstoreseed";
    $result_seed4 = mysqli_query($connection, $query_seed4);

    $query_seed5 = "delete from withdrawseed";
    $result_seed5 = mysqli_query($connection, $query_seed5);

    //fertilizers
    $query_fertilizer1 = "delete from fertilizers";
    $result_fertilizer1 = mysqli_query($connection, $query_fertilizer1);

    $query_fertilizer2 = "delete from fertilizersitems";
    $result_fertilizer2 = mysqli_query($connection, $query_fertilizer2);

    $query_fertilizer3 = "delete from fertilizersprice";
    $result_fertilizer3 = mysqli_query($connection, $query_fertilizer3);

    $query_fertilizer4 = "delete from generalstorefertilizer";
    $result_fertilizer4 = mysqli_query($connection, $query_fertilizer4);

    $query_fertilizer5 = "delete from withdrawfertilizer";
    $result_fertilizer5 = mysqli_query($connection, $query_fertilizer5);

    //farmtools
    $query_farmtool1 = "delete from farmtools";
    $result_farmtool1 = mysqli_query($connection, $query_farmtool1);

    $query_farmtool2 = "delete from farmtoolsitems";
    $result_farmtool2 = mysqli_query($connection, $query_farmtool2);

    $query_farmtool3 = "delete from farmtoolsprice";
    $result_farmtool3 = mysqli_query($connection, $query_farmtool3);

    $query_farmtool4 = "delete from generalstorefarmtool";
    $result_farmtool4 = mysqli_query($connection, $query_farmtool4);

    $query_farmtool5 = "delete from withdrawfarmtool";
    $result_farmtool5 = mysqli_query($connection, $query_farmtool5);
    
    
    //clinic
    $query_clinic = "delete from clinic";
    $result_clinic = mysqli_query($connection, $query_clinic);

    //users
    $query_users = "delete from users";
    $result_users = mysqli_query($connection, $query_users);

    //item list
    $query_items = "delete from itemlist";
    $result_items = mysqli_query($connection, $query_items);

    header("Location: menu.html");

    mysqli_close($connection);
?>
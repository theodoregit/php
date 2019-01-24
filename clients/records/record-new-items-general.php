<!DOCTYPE html>
<html lang="en">
<?php
        $connection = mysqli_connect("localhost", "root", "", "farm");

        $query_chemical = "select * from generalstorechemical order by category";
        $result_chemical = mysqli_query($connection, $query_chemical);

        $query_seed = "select * from generalstoreseed order by category";
        $result_seed = mysqli_query($connection, $query_seed);

        $query_farmtool = "select * from generalstorefarmtool order by category";
        $result_farmtool = mysqli_query($connection, $query_farmtool);

        $query_fertilizer = "select * from generalstorefertilizer order by category";
        $result_fertilizer = mysqli_query($connection, $query_fertilizer);

        $query_drug = "select * from generalstoredrug order by category";
        $result_drug = mysqli_query($connection, $query_drug);

        //check whether an items' left days are less than zero
        $query2 = "select status from generalstore";
        $result2 = mysqli_query($connection, $query2);
        $statuses = array();
        $mess = "expired";
        while($row = mysqli_fetch_assoc($result2)){
            $queried_status = $row["status"];
            $converted = floatval($queried_status);
            
            if($converted <= 0){                
                $upd = "update generalstore set status = '{$mess}' where status <= 0";
                $res = mysqli_query($connection, $upd);
            }
            else{
                // echo "nope";
            }
            // array_push($statuses, $queried_status);
        }


        
        $drop1 = "alter table generalstorechemical drop id";
        $result_drop1 = mysqli_query($connection, $drop1);
        $auto1 = "alter table generalstorechemical auto_increment = 1";
        $result_auto1 = mysqli_query($connection, $auto1);
        $add1 = "alter table generalstorechemical add id int not null auto_increment primary key first";
        $result_add1 = mysqli_query($connection, $add1);

        $drop1 = "alter table generalstoredrug drop id";
        $result_drop1 = mysqli_query($connection, $drop1);
        $auto1 = "alter table generalstoredrug auto_increment = 1";
        $result_auto1 = mysqli_query($connection, $auto1);
        $add1 = "alter table generalstoredrug add id int not null auto_increment primary key first";
        $result_add1 = mysqli_query($connection, $add1);

        $drop1 = "alter table generalstoreseed drop id";
        $result_drop1 = mysqli_query($connection, $drop1);
        $auto1 = "alter table generalstoreseed auto_increment = 1";
        $result_auto1 = mysqli_query($connection, $auto1);
        $add1 = "alter table generalstoreseed add id int not null auto_increment primary key first";
        $result_add1 = mysqli_query($connection, $add1);

        $drop1 = "alter table generalstorefarmtool drop id";
        $result_drop1 = mysqli_query($connection, $drop1);
        $auto1 = "alter table generalstorefarmtool auto_increment = 1";
        $result_auto1 = mysqli_query($connection, $auto1);
        $add1 = "alter table generalstorefarmtool add id int not null auto_increment primary key first";
        $result_add1 = mysqli_query($connection, $add1);

        $drop1 = "alter table generalstorefertilizer drop id";
        $result_drop1 = mysqli_query($connection, $drop1);
        $auto1 = "alter table generalstorefertilizer auto_increment = 1";
        $result_auto1 = mysqli_query($connection, $auto1);
        $add1 = "alter table generalstorefertilizer add id int not null auto_increment primary key first";
        $result_add1 = mysqli_query($connection, $add1);



        session_start();
        $new_comer = $_SESSION["userid"];
        $queried_name = "";
        $queried_dept = "";
        $query2 = "select fullname, department from users ";
        $query2 .= "where userid = '{$new_comer}'";

        $result2 = mysqli_query($connection, $query2);
        
        while($row = mysqli_fetch_assoc($result2)){
            $queried_name = $row["fullname"];
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
            // echo $queried_now;
            // $ee = $expiries[6];
            // $q = "select timestampdiff(day, '{$queried_now}', '{$ee}')";
            // $r = mysqli_query($connection, $q);
            // while($row = mysqli_fetch_assoc($r)){
            //     $rn = $row["timestampdiff(day, '{$queried_now}', '{$ee}')"];                        
            // }
            // echo $rn . "<br>";
        }
        updatestatus();
        
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>record new items - store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />    
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <style>
            body{
                background-image: url("../../img/Desktop-Backgrounds-Hd.jpg");
                background-attachment: fixed;
                background-repeat: no-repeat;
                background-position: center;
                
            }
            #heading{
                font-size: 110px;
                margin-left: 5%;
                color: cadetblue;
                border-bottom: white solid;
                border-right: white solid;
                border-radius: 75px;
            }
            #heading a{
                text-decoration-line: none;
                text-decoration-color: cadetblue;            
            }
            .containerr{
                margin-top: 10px;
                text-align: center;
                width: 100%;
                height: 150%;
                border: rgb(131, 179, 180);
                background-color: rgb(131, 179, 180);
                opacity: 1;
                border-radius: 15px;
            }
            .img-rounded{
                float: left;
                margin-top: 5px;
            }

            .dropdown {
                position: relative;
                display: inline-block;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #007BFF;
                min-width: 200px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                border-radius: 10px;
                opacity: 0.9;
            }

            .dropdown-content a {
                color: rgb(206, 213, 214);
                padding: 12px 16px;
                text-decoration: none;
                display: block;
            }

            .dropdown-content a:hover {
                background-color: #417BFF;
            }

            .dropdown:hover .dropdown-content {
                display: block;
            }


            h2{
                font-size: 40px;
                font-family: sans-serif;
                margin-top: 20px;
                margin-right: 30%;
            }
            form{
                margin-top: 95px;
            }
            .row{
                margin-top: 25px;
            }
            #login{
                margin-right: 10%;
            }
            #clear{
                margin-left: 10%;
            }
            #all{
                margin-top: 40px;
            }
            #sm{
                width: 5%;
            }
            #lg{
                width: 12%;
            }
            #now{
                font-size: 20px;
                color: white;
            }
            #copy{
                float: right;
            }

            #item_name{
                width: 12%;
            }
            #item_cat{
                width: 12%;
            }
            #amnt{
                width: 7%;
            }
            #prc{
                width: 7%;
            }
            #spec{
                width: 7%;
            }
            #unit{
                width: 7%;
            }
            #item_name2{
                width: 12%;
            }
            #item_cat2{
                width: 12%;
            }
            #amnt2{
                width: 7%;
            }
            #prc2{
                width: 7%;
            }
            #spec2{
                width: 7%;
            }
            #unit2{
                width: 7%;
            }
            #item_name3{
                width: 12%;
            }
            #item_cat3{
                width: 12%;
            }
            #amnt3{
                width: 7%;
            }
            #prc3{
                width: 7%;
            }
            #spec3{
                width: 7%;
            }
            #unit3{
                width: 7%;
            }
            #item_name4{
                width: 12%;
            }
            #item_cat4{
                width: 12%;
            }
            #amnt4{
                width: 7%;
            }
            #prc4{
                width: 7%;
            }
            #spec4{
                width: 7%;
            }
            #unit4{
                width: 7%;
            }
            #item_name5{
                width: 12%;
            }
            #item_cat5{
                width: 12%;
            }
            #amnt5{
                width: 7%;
            }
            #prc5{
                width: 7%;
            }
            #spec5{
                width: 7%;
            }
            #unit5{
                width: 7%;
            }
            #tableId1 tr{
                cursor: pointer;
            }
            #tableId2 tr{
                cursor: pointer;
            }
            #tableId3 tr{
                cursor: pointer;
            }
            #tableId4 tr{
                cursor: pointer;
            }
            #tableId5 tr{
                cursor: pointer;
            }


            /*collapsible*/
            input[type='checkbox'] {
                display: none;
            }
            .lbl-toggle {
                /* display: block; */

                font-weight: bold;
                font-family: monospace;
                font-size: 1.2rem;
                text-transform: uppercase;
                text-align: center;
                margin-right: 100%;
                
                padding: 1rem;

                color: #fff;
                background: #8363c9;
                height: 20px;
                cursor: pointer;

                border-radius: 7px;
                transition: all 0.25s ease-out;
            }

            .lbl-toggle:hover {
                color: #455;
            }

            .collapsible-content {
                max-height: 0px;
                overflow: hidden;
                transition: max-height .25s ease-in-out;
            }

            .toggle:checked + .lbl-toggle + .collapsible-content {
                max-height: 100%;
            }

            .toggle:checked + .lbl-toggle::before {
                transform: rotate(90deg) translateX(-3px);
            }

            .toggle:checked + .lbl-toggle {
                border-bottom-right-radius: 0;
                border-bottom-left-radius: 0;
            }






            input[type='checkbox'] {
                display: none;
            }
            .lbl-toggle2 {
                /* display: block; */

                font-weight: bold;
                font-family: monospace;
                font-size: 1.2rem;
                text-transform: uppercase;
                text-align: center;
                margin-right: 100%;
                
                padding: 1rem;

                color: #fff;
                background: #8363c9;
                height: 20px;
                cursor: pointer;

                border-radius: 7px;
                transition: all 0.25s ease-out;
            }

            .lbl-toggle2:hover {
                color: #455;
            }

            .collapsible-content2 {
                max-height: 0px;
                overflow: hidden;
                transition: max-height .25s ease-in-out;
            }

            .toggle2:checked + .lbl-toggle2 + .collapsible-content2 {
                max-height: 100%;
            }

            .toggle2:checked + .lbl-toggle2::before {
                transform: rotate(90deg) translateX(-3px);
            }

            .toggle2:checked + .lbl-toggle2 {
                border-bottom-right-radius: 0;
                border-bottom-left-radius: 0;
            }


            


            input[type='checkbox'] {
                display: none;
            }
            .lbl-toggle3 {
                /* display: block; */

                font-weight: bold;
                font-family: monospace;
                font-size: 1.2rem;
                text-transform: uppercase;
                text-align: center;
                margin-right: 100%;
                
                padding: 1rem;

                color: #fff;
                background: #8363c9;
                height: 20px;
                width: 150px;
                cursor: pointer;

                border-radius: 7px;
                transition: all 0.25s ease-out;
            }

            .lbl-toggle3:hover {
                color: #455;
            }

            .collapsible-content3 {
                max-height: 0px;
                overflow: hidden;
                transition: max-height .25s ease-in-out;
            }

            .toggle3:checked + .lbl-toggle3 + .collapsible-content3 {
                max-height: 100%;
            }

            .toggle3:checked + .lbl-toggle3::before {
                transform: rotate(90deg) translateX(-3px);
            }

            .toggle3:checked + .lbl-toggle3 {
                border-bottom-right-radius: 0;
                border-bottom-left-radius: 0;
            }}





            input[type='checkbox'] {
                display: none;
            }
            .lbl-toggle4 {
                /* display: block; */

                font-weight: bold;
                font-family: monospace;
                font-size: 1.2rem;
                text-transform: uppercase;
                text-align: center;
                margin-right: 100%;
                
                padding: 1rem;

                color: #fff;
                background: #8363c9;
                height: 20px;
                cursor: pointer;

                border-radius: 7px;
                transition: all 0.25s ease-out;
            }

            .lbl-toggle4:hover {
                color: #455;
            }

            .collapsible-content4 {
                max-height: 0px;
                overflow: hidden;
                transition: max-height .25s ease-in-out;
            }

            .toggle4:checked + .lbl-toggle4 + .collapsible-content4 {
                max-height: 100%;
            }

            .toggle4:checked + .lbl-toggle4::before {
                transform: rotate(90deg) translateX(-3px);
            }

            .toggle4:checked + .lbl-toggle4 {
                border-bottom-right-radius: 0;
                border-bottom-left-radius: 0;
            }




            input[type='checkbox'] {
                display: none;
            }
            .lbl-toggle5 {
                /* display: block; */

                font-weight: bold;
                font-family: monospace;
                font-size: 1.2rem;
                text-transform: uppercase;
                text-align: center;
                margin-right: 100%;
                
                padding: 1rem;

                color: #fff;
                background: #8363c9;
                height: 20px;
                cursor: pointer;

                border-radius: 7px;
                transition: all 0.25s ease-out;
            }

            .lbl-toggle5:hover {
                color: #455;
            }

            .collapsible-content5 {
                max-height: 0px;
                overflow: hidden;
                transition: max-height .25s ease-in-out;
            }

            .toggle5:checked + .lbl-toggle5 + .collapsible-content5 {
                max-height: 100%;
            }

            .toggle5:checked + .lbl-toggle5::before {
                transform: rotate(90deg) translateX(-3px);
            }

            .toggle5:checked + .lbl-toggle5 {
                border-bottom-right-radius: 0;
                border-bottom-left-radius: 0;
            }

            
            
            
            
        </style>
</head>
<body>
        <header class="row">
            <h1 id="heading"><a href="#">DM Farm Service</a></h1>
        </header>
        <nav class="navbar navbar-expand-sm navbar-dark bg-primary mb-3">           
                <a class="navbar-brand" href="#">General Store</a>
                
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div id="nnn" class="navbar-nav">                        
                    <a class="nav-item nav-link" href="#" id="now">Add Items</a>                    
                    <div class="dropdown">
                    <a class="nav-item nav-link" href="#">Withdraw Items</a>
                            <div class="dropdown-content">
                                <a href="record-withdraw-chemicals.php">Withdraw Chemicals</a>
                                <a href="record-withdraw-farmtools.php">Withdraw Farm Tools</a>
                                <a href="record-withdraw-seeds.php">Withdraw Seeds</a>
                                <a href="record-withdraw-drugs.php">Withdraw Drugs</a>
                                <a href="record-withdraw-fertilizers.php">Withdraw Fertilizers</a>
                                <!-- <a href="withdrawed.php">Withdrawed Items</a> -->
                            </div>
                        </div>
                    <a class="nav-item nav-link" href="../change-password.html">Change Password</a>
                    <a class="nav-item nav-link" href="../login.html">Logout</a>
                    </div>
                </div>
            
    
        </nav>
        <div class="containerr">
                <?php
                    echo $queried_name . "</br>";
                    echo $queried_dept;                 
                    
                    // echo $item;
                ?>
            
                        <form role="form" class="form-inline" action="record-items-general-logic-chemical.php" method="POST">
                            <h5>Record Chemical items</h5>
                            <div id="all" class="form-group">
                                <label for="item-name">Name of Item</label>
                                <input type="text" class="form-control" id="item_name" name="item_name" required>
                                <label for="course">Sub Category</label>
                                <input type="text" class="form-control" id="item_cat" name="cat">
                                <!-- <select class="form-control" name="cat">
                                    <option>Chemical</option>
                                    <option>Seed</option>
                                    <option>Farm Tool</option>
                                    <option>Drug</option>
                                </select> -->
                                <label for="course">Specification</label>
                                <input type="text" class="form-control" id="spec" name="spec" required>  
                                <label for="unit">Unit</label>
                                <input type="text" class="form-control" id="unit" name="unit" required>
                                <!-- <select class="form-control" name="unit">
                                    <option>unit one</option>
                                    <option>unit two</option>
                                    <option>unit three</option>
                                    <option>unit four</option>
                                </select>               -->
                                <label for="aver">Amount</label>
                                <input type="number" id="amnt" class="form-control" name="amount" required>
                                <!-- <label for="grd">Price</label>
                                <input type="text" id="sm" class="form-control" name="price" required> -->
                                <label for="date">Expiry Date</label>
                                <input type="date" class="form-control" id="" name="expiry" required>
                            
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            </div>
                        </form><br><br>
                        <div class="wrap-collabsible">
                <input id="collapsible" class="toggle" type="checkbox">
                <label for="collapsible" class="lbl-toggle">Chemical</label>
                <div class="collapsible-content">
                    <div class="content-inner">
                        <input id="copy" type="button" class="btn btn-primary" value="copy table" onclick="selectElementContents( document.getElementById('tableId1') );">
                        <form role="form" class="form-inline" action="undo-general-chemical.php" method="POST">
                            <button type="submit" class="btn btn-primary" name="submit">Undo</button>
                        </form>
                        <table class="table table-striped table-bordered" id="tableId1">
                            <!-- <caption>Student's Grade</caption> -->
                            <thead>
                                <tr>
                                    <!-- <th>No</th> -->
                                    <th>Item Name</th>
                                    <th>Sub Category</th>
                                    <th>Specification</th>
                                    <th>Unit</th>
                                    <th>Total Amount</th>
                                    <th>Amount</th>
                                    <!-- <th>Price</th>
                                    <th>T. Price</th> -->
                                    <th>Date</th>
                                    <th>Expiry Date</th>
                                    <th>Days Left</th>
                                </tr>
                            </thead>
                                <?php
                                    while($row = mysqli_fetch_array($result_chemical)):;
                                ?>
                            <tbody>
                                <tr>
                                    <!-- <td><?php echo $row[0]; ?></td> -->
                                    <td><?php echo $row[1]; ?></td>
                                    <td><?php echo $row[2]; ?></td>
                                    <td><?php echo $row[3]; ?></td>
                                    <td><?php echo $row[4]; ?></td>
                                    <td><?php echo $row[5]; ?></td>                    
                                    <td><?php echo $row[6]; ?></td>
                                    <td><?php echo $row[7]; ?></td>
                                    <td><?php echo $row[8]; ?></td>
                                    <td><?php echo $row[9]; ?></td>
                                </tr>   
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


                
                <form role="form" class="form-inline" action="record-items-general-logic-seed.php" method="POST">
                <h5>Record Seed items</h5>
                <div id="all" class="form-group">
                    <label for="item-name">Name of Item</label>
                    <input type="text" class="form-control" id="item_name2" name="item_name" required>
                    <label for="course">Sub Category</label>
                    <input type="text" class="form-control" id="item_cat2" name="cat">
                    <!-- <select class="form-control" name="cat">
                        <option>Chemical</option>
                        <option>Seed</option>
                        <option>Farm Tool</option>
                        <option>Drug</option>
                    </select> -->
                    <label for="course">Specification</label>
                    <input type="text" class="form-control" id="spec2" name="spec" required>  
                    <label for="unit">Unit</label>
                    <input type="text" class="form-control" id="unit2" name="unit" required>
                    <!-- <select class="form-control" name="unit">
                        <option>unit one</option>
                        <option>unit two</option>
                        <option>unit three</option>
                        <option>unit four</option>
                    </select>               -->
                    <label for="aver">Amount</label>
                    <input type="number" id="amnt" class="form-control" name="amount" required>
                    <!-- <label for="grd">Price</label>
                    <input type="text" id="sm" class="form-control" name="price" required> -->
                    <label for="date">Expiry Date</label>
                    <input type="date" class="form-control" id="" name="expiry" required>
                
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </form>
            <div class="wrap-collabsible">
                <input id="collapsible2" class="toggle2" type="checkbox">
                <label for="collapsible2" class="lbl-toggle2">Seed</label>
                <div class="collapsible-content2">
                    <div class="content-inner">
            <input id="copy" type="button" class="btn btn-primary" value="copy table" onclick="selectElementContents( document.getElementById('tableId2') );">
                        <form role="form" class="form-inline" action="undo-general-seed.php" method="POST">
                            <button type="submit" class="btn btn-primary" name="submit">Undo</button>
                        </form>
                            <table class="table table-striped table-bordered" id="tableId2">
                            <!-- <caption>Student's Grade</caption> -->
                            <thead>
                                <tr>
                                    <!-- <th>No</th> -->
                                    <th>Item Name</th>
                                    <th>Sub Category</th>
                                    <th>Specification</th>
                                    <th>Unit</th>
                                    <th>Total Amount</th>
                                    <th>Amount</th>
                                    <!-- <th>Price</th>
                                    <th>T. Price</th> -->
                                    <th>Date</th>
                                    <th>Expiry Date</th>
                                    <th>Days Left</th>
                                </tr>
                            </thead>
                                <?php
                                    while($row = mysqli_fetch_array($result_seed)):;
                                ?>
                            <tbody>
                                <tr>
                                    <!-- <td><?php echo $row[0]; ?></td> -->
                                    <td><?php echo $row[1]; ?></td>
                                    <td><?php echo $row[2]; ?></td>
                                    <td><?php echo $row[3]; ?></td>
                                    <td><?php echo $row[4]; ?></td>
                                    <td><?php echo $row[5]; ?></td>                    
                                    <td><?php echo $row[6]; ?></td>
                                    <td><?php echo $row[7]; ?></td>
                                    <td><?php echo $row[8]; ?></td>
                                    <td><?php echo $row[9]; ?></td>
                                </tr>   
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        </div>
                </div>
            </div>
            <hr><hr>
            
                <form role="form" class="form-inline" action="record-items-general-logic-farmtool.php" method="POST">
                <h5>Record Farm Tools items</h5>
                <div id="all" class="form-group">
                    <label for="item-name">Name of Item</label>
                    <input type="text" class="form-control" id="item_name3" name="item_name" required>
                    <label for="course">Sub Category</label>
                    <input type="text" class="form-control" id="item_cat3" name="cat">
                    <!-- <select class="form-control" name="cat">
                        <option>Chemical</option>
                        <option>Seed</option>
                        <option>Farm Tool</option>
                        <option>Drug</option>
                    </select> -->
                    <label for="course">Specification</label>
                    <input type="text" class="form-control" id="spec3" name="spec" required>  
                    <label for="unit">Unit</label>
                    <input type="text" class="form-control" id="unit3" name="unit" required>
                    <!-- <select class="form-control" name="unit">
                        <option>unit one</option>
                        <option>unit two</option>
                        <option>unit three</option>
                        <option>unit four</option>
                    </select>               -->
                    <label for="aver">Amount</label>
                    <input type="number" id="amnt" class="form-control" name="amount" required>
                    <!-- <label for="grd">Price</label>
                    <input type="text" id="sm" class="form-control" name="price" required> -->
                    <label for="date">Expiry Date</label>
                    <input type="date" class="form-control" id="" name="expiry" required>
                
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </form>
            <div class="wrap-collabsible">
                <input id="collapsible3" class="toggle3" type="checkbox">
                <label for="collapsible3" class="lbl-toggle3">Farm Tools</label>
                <div class="collapsible-content3">
                    <div class="content-inner">
            <input id="copy" type="button" class="btn btn-primary" value="copy table" onclick="selectElementContents( document.getElementById('tableId3') );">
            <form role="form" class="form-inline" action="undo-general-farmtool.php" method="POST">
                            <button type="submit" class="btn btn-primary" name="submit">Undo</button>
                        </form>
                        <table class="table table-striped table-bordered" id="tableId3">
                                <!-- <caption>Student's Grade</caption> -->
                                <thead>
                                    <tr>
                                        <!-- <th>No</th> -->
                                        <th>Item Name</th>
                                        <th>Sub Category</th>
                                        <th>Specification</th>
                                        <th>Unit</th>
                                        <th>Total Amount</th>
                                        <th>Amount</th>
                                        <!-- <th>Price</th>
                                        <th>T. Price</th> -->
                                        <th>Date</th>
                                        <th>Expiry Date</th>
                                        <th>Days Left</th>
                                    </tr>
                                </thead>
                                    <?php
                                        while($row = mysqli_fetch_array($result_farmtool)):;
                                    ?>
                                <tbody>
                                    <tr>
                                        <!-- <td><?php echo $row[0]; ?></td> -->
                                        <td><?php echo $row[1]; ?></td>
                                        <td><?php echo $row[2]; ?></td>
                                        <td><?php echo $row[3]; ?></td>
                                        <td><?php echo $row[4]; ?></td>
                                        <td><?php echo $row[5]; ?></td>                    
                                        <td><?php echo $row[6]; ?></td>
                                        <td><?php echo $row[7]; ?></td>
                                        <td><?php echo $row[8]; ?></td>
                                        <td><?php echo $row[9]; ?></td>
                                    </tr>   
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                            </div>
                </div>
            </div>
            <hr>
            
                <form role="form" class="form-inline" action="record-items-general-logic-fertilizer.php" method="POST">
                <h5>Record Fertilizer items</h5>
                <div id="all" class="form-group">
                    <label for="item-name">Name of Item</label>
                    <input type="text" class="form-control" id="item_name4" name="item_name" required>
                    <label for="course">Sub Category</label>
                    <input type="text" class="form-control" id="item_cat4" name="cat">
                    <!-- <select class="form-control" name="cat">
                        <option>Chemical</option>
                        <option>Seed</option>
                        <option>Farm Tool</option>
                        <option>Drug</option>
                    </select> -->
                    <label for="course">Specification</label>
                    <input type="text" class="form-control" id="spec4" name="spec" required>  
                    <label for="unit">Unit</label>
                    <input type="text" class="form-control" id="unit4" name="unit" required>
                    <!-- <select class="form-control" name="unit">
                        <option>unit one</option>
                        <option>unit two</option>
                        <option>unit three</option>
                        <option>unit four</option>
                    </select>               -->
                    <label for="aver">Amount</label>
                    <input type="number" id="amnt" class="form-control" name="amount" required>
                    <!-- <label for="grd">Price</label>
                    <input type="text" id="sm" class="form-control" name="price" required> -->
                    <label for="date">Expiry Date</label>
                    <input type="date" class="form-control" id="" name="expiry" required>
                
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </form>
            <div class="wrap-collabsible">
                <input id="collapsible4" class="toggle4" type="checkbox">
                <label for="collapsible4" class="lbl-toggle4">Fertilizer</label>
                <div class="collapsible-content4">
                    <div class="content-inner">
            <input id="copy" type="button" class="btn btn-primary" value="copy table" onclick="selectElementContents( document.getElementById('tableId4') );">
            <form role="form" class="form-inline" action="undo-general-fertilizer.php" method="POST">
                            <button type="submit" class="btn btn-primary" name="submit">Undo</button>
                        </form>
                        <table class="table table-striped table-bordered" id="tableId4">
                                <!-- <caption>Student's Grade</caption> -->
                                <thead>
                                    <tr>
                                        <!-- <th>No</th> -->
                                        <th>Item Name</th>
                                        <th>Sub Category</th>
                                        <th>Specification</th>
                                        <th>Unit</th>
                                        <th>Total Amount</th>
                                        <th>Amount</th>
                                        <!-- <th>Price</th>
                                        <th>T. Price</th> -->
                                        <th>Date</th>
                                        <th>Expiry Date</th>
                                        <th>Days Left</th>
                                    </tr>
                                </thead>
                                    <?php
                                        while($row = mysqli_fetch_array($result_fertilizer)):;
                                    ?>
                                <tbody>
                                    <tr>
                                        <!-- <td><?php echo $row[0]; ?></td> -->
                                        <td><?php echo $row[1]; ?></td>
                                        <td><?php echo $row[2]; ?></td>
                                        <td><?php echo $row[3]; ?></td>
                                        <td><?php echo $row[4]; ?></td>
                                        <td><?php echo $row[5]; ?></td>                    
                                        <td><?php echo $row[6]; ?></td>
                                        <td><?php echo $row[7]; ?></td>
                                        <td><?php echo $row[8]; ?></td>
                                        <td><?php echo $row[9]; ?></td>
                                    </tr>   
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                            </div>
                </div>
            </div>
            <hr>
            
                <form role="form" class="form-inline" action="record-items-general-logic-drug.php" method="POST">
                <h5>Record Drug items</h5>
                <div id="all" class="form-group">
                    <label for="item-name">Name of Item</label>
                    <input type="text" class="form-control" id="item_name5" name="item_name" required>
                    <label for="course">Sub Category</label>
                    <input type="text" class="form-control" id="item_cat5" name="cat">
                    <!-- <select class="form-control" name="cat">
                        <option>Chemical</option>
                        <option>Seed</option>
                        <option>Farm Tool</option>
                        <option>Drug</option>
                    </select> -->
                    <label for="course">Specification</label>
                    <input type="text" class="form-control" id="spec5" name="spec" required>  
                    <label for="unit">Unit</label>
                    <input type="text" class="form-control" id="unit5" name="unit" required>
                    <!-- <select class="form-control" name="unit">
                        <option>unit one</option>
                        <option>unit two</option>
                        <option>unit three</option>
                        <option>unit four</option>
                    </select>               -->
                    <label for="aver">Amount</label>
                    <input type="number" id="amnt" class="form-control" name="amount" required>
                    <!-- <label for="grd">Price</label>
                    <input type="text" id="sm" class="form-control" name="price" required> -->
                    <label for="date">Expiry Date</label>
                    <input type="date" class="form-control" id="" name="expiry" required>
                
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </form>
            <div class="wrap-collabsible">
                <input id="collapsible5" class="toggle5" type="checkbox">
                <label for="collapsible5" class="lbl-toggle5">Drug</label>
                <div class="collapsible-content5">
                    <div class="content-inner">
            <input id="copy" type="button" class="btn btn-primary" value="copy table" onclick="selectElementContents( document.getElementById('tableId5') );">
            <form role="form" class="form-inline" action="undo-general-drug.php" method="POST">
                            <button type="submit" class="btn btn-primary" name="submit">Undo</button>
                        </form>
                        <table class="table table-striped table-bordered" id="tableId5">
                                <!-- <caption>Student's Grade</caption> -->
                                <thead>
                                    <tr>
                                        <!-- <th>No</th> -->
                                        <th>Item Name</th>
                                        <th>Sub Category</th>
                                        <th>Specification</th>
                                        <th>Unit</th>
                                        <th>Total Amount</th>
                                        <th>Amount</th>
                                        <!-- <th>Price</th>
                                        <th>T. Price</th> -->
                                        <th>Date</th>
                                        <th>Expiry Date</th>
                                        <th>Days Left</th>
                                    </tr>
                                </thead>
                                    <?php
                                        while($row = mysqli_fetch_array($result_drug)):;
                                    ?>
                                <tbody>
                                    <tr>
                                        <!-- <td><?php echo $row[0]; ?></td> -->
                                        <td><?php echo $row[1]; ?></td>
                                        <td><?php echo $row[2]; ?></td>
                                        <td><?php echo $row[3]; ?></td>
                                        <td><?php echo $row[4]; ?></td>
                                        <td><?php echo $row[5]; ?></td>                    
                                        <td><?php echo $row[6]; ?></td>
                                        <td><?php echo $row[7]; ?></td>
                                        <td><?php echo $row[8]; ?></td>
                                        <td><?php echo $row[9]; ?></td>
                                    </tr>   
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                            </div>
                </div>
            </div>
            <!-- <div>                
                <table class="" border="1">
                    
                    <thead>
                        <tr>                 
                            <th><h3>Total Price</h3></th>                                 
                        </tr>
                    </thead>
                    <?php
                        $sum = array();
                        $total_query = "select totalprice from generalstorefertilizer";
                        $total_result = mysqli_query($connection, $total_query);
                        while($row = mysqli_fetch_assoc($total_result)){
                            $queried_totals = $row["totalprice"];
                            array_push($sum, $queried_totals);     
                        }
                        $out = array_sum($sum);
                    ?>
                    <tbody>
                        <tr>
                            <td><h3><?php echo $out; ?></h3></td>                            
                        </tr>       
                    </tbody>
                </table>
            </div> -->
        </div>
        <script>
            function selectElementContents(el) {                
                var body = document.body, range, sel;
                var body = document.body, range, sel;
                if (document.createRange && window.getSelection) {
                    range = document.createRange();
                    sel = window.getSelection();
                    sel.removeAllRanges();
                    try {
                        range.selectNodeContents(el);
                        sel.addRange(range);
                        range.execCommand("Copy");  
                    } catch (e) {
                        range.selectNode(el);
                        sel.addRange(range);
                    }
                } else if (body.createTextRange) {
                    range = body.createTextRange();
                    range.moveToElementText(el);
                    range.select();
                    range.execCommand("Copy");                    
                }
            }

            
            function run1(){
            document.getElementById('tableId1').onclick = function(event){
                event = event || window.event; //for IE8 backward compatibility
                var target = event.target || event.srcElement; //for IE8 backward compatibility
                while (target && target.nodeName != 'TR') {
                    target = target.parentElement;
                }
                var cells = target.cells; //cells collection
                //var cells = target.getElementsByTagName('td'); //alternative
                if (!cells.length || target.parentNode.nodeName == 'THEAD') { // if clicked row is within thead
                    return;
                }
                var f1 = document.getElementById('item_name');
                var f2 = document.getElementById('item_cat');
                var f3 = document.getElementById('spec');
                var f4 = document.getElementById('unit');
                // var f5 = document.getElementById('amnt');
                // var f6 = document.getElementById('prc');

                f1.value = cells[0].innerHTML;
                f2.value = cells[1].innerHTML;
                f3.value = cells[2].innerHTML;
                f4.value = cells[3].innerHTML;
                // f5.value = cells[6].innerHTML;
                // f6.value = cells[7].innerHTML;
                }
            }
            run1();
            function run2(){
            document.getElementById('tableId2').onclick = function(event){
                event = event || window.event; //for IE8 backward compatibility
                var target = event.target || event.srcElement; //for IE8 backward compatibility
                while (target && target.nodeName != 'TR') {
                    target = target.parentElement;
                }
                var cells = target.cells; //cells collection
                //var cells = target.getElementsByTagName('td'); //alternative
                if (!cells.length || target.parentNode.nodeName == 'THEAD') { // if clicked row is within thead
                    return;
                }
                var f1 = document.getElementById('item_name2');
                var f2 = document.getElementById('item_cat2');
                var f3 = document.getElementById('spec2');
                var f4 = document.getElementById('unit2');
                // var f5 = document.getElementById('amnt');
                // var f6 = document.getElementById('prc');

                f1.value = cells[0].innerHTML;
                f2.value = cells[1].innerHTML;
                f3.value = cells[2].innerHTML;
                f4.value = cells[3].innerHTML;
                // f5.value = cells[6].innerHTML;
                // f6.value = cells[7].innerHTML;
                }
            }
            run2();

            function run3(){
            document.getElementById('tableId3').onclick = function(event){
                event = event || window.event; //for IE8 backward compatibility
                var target = event.target || event.srcElement; //for IE8 backward compatibility
                while (target && target.nodeName != 'TR') {
                    target = target.parentElement;
                }
                var cells = target.cells; //cells collection
                //var cells = target.getElementsByTagName('td'); //alternative
                if (!cells.length || target.parentNode.nodeName == 'THEAD') { // if clicked row is within thead
                    return;
                }
                var f1 = document.getElementById('item_name3');
                var f2 = document.getElementById('item_cat3');
                var f3 = document.getElementById('spec3');
                var f4 = document.getElementById('unit3');
                // var f5 = document.getElementById('amnt');
                // var f6 = document.getElementById('prc');

                f1.value = cells[0].innerHTML;
                f2.value = cells[1].innerHTML;
                f3.value = cells[2].innerHTML;
                f4.value = cells[3].innerHTML;
                // f5.value = cells[6].innerHTML;
                // f6.value = cells[7].innerHTML;
                }
            }
            run3();

            function run4(){
            document.getElementById('tableId4').onclick = function(event){
                event = event || window.event; //for IE8 backward compatibility
                var target = event.target || event.srcElement; //for IE8 backward compatibility
                while (target && target.nodeName != 'TR') {
                    target = target.parentElement;
                }
                var cells = target.cells; //cells collection
                //var cells = target.getElementsByTagName('td'); //alternative
                if (!cells.length || target.parentNode.nodeName == 'THEAD') { // if clicked row is within thead
                    return;
                }
                var f1 = document.getElementById('item_name4');
                var f2 = document.getElementById('item_cat4');
                var f3 = document.getElementById('spec4');
                var f4 = document.getElementById('unit4');
                // var f5 = document.getElementById('amnt');
                // var f6 = document.getElementById('prc');

                f1.value = cells[0].innerHTML;
                f2.value = cells[1].innerHTML;
                f3.value = cells[2].innerHTML;
                f4.value = cells[3].innerHTML;
                // f5.value = cells[6].innerHTML;
                // f6.value = cells[7].innerHTML;
                }
            }
            run4();

            function run5(){
            document.getElementById('tableId5').onclick = function(event){
                event = event || window.event; //for IE8 backward compatibility
                var target = event.target || event.srcElement; //for IE8 backward compatibility
                while (target && target.nodeName != 'TR') {
                    target = target.parentElement;
                }
                var cells = target.cells; //cells collection
                //var cells = target.getElementsByTagName('td'); //alternative
                if (!cells.length || target.parentNode.nodeName == 'THEAD') { // if clicked row is within thead
                    return;
                }
                var f1 = document.getElementById('item_name5');
                var f2 = document.getElementById('item_cat5');
                var f3 = document.getElementById('spec5');
                var f4 = document.getElementById('unit5');
                // var f5 = document.getElementById('amnt');
                // var f6 = document.getElementById('prc');

                f1.value = cells[0].innerHTML;
                f2.value = cells[1].innerHTML;
                f3.value = cells[2].innerHTML;
                f4.value = cells[3].innerHTML;
                // f5.value = cells[6].innerHTML;
                // f6.value = cells[7].innerHTML;
                }
            }
            run5();

        </script>
    
        <script src="../../jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <?php


            //check whether an items' left days are less than zero
        $query2 = "select status from generalstore";
        $result2 = mysqli_query($connection, $query2);
        $statuses = array();
        $mess = "expired";
        while($row = mysqli_fetch_assoc($result2)){
            $queried_status = $row["status"];
            $converted = floatval($queried_status);
            
            if($converted <= 0){                
                $upd = "update generalstorestore set status = '{$mess}' where status <= 0";
                $res = mysqli_query($connection, $upd);
            }
            else{
                // echo "nope";
            }
            // array_push($statuses, $queried_status);
        }
            mysqli_close($connection);
        ?>
    </body>
</html>
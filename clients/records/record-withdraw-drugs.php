<!DOCTYPE html>
<html lang="en">
<?php
        $connection = mysqli_connect("localhost", "root", "", "farm");

        $query = "select * from withdrawdrug";
        $result = mysqli_query($connection, $query);

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

        $query3 = "select * from users where department != 'General Store'";
        $result3 = mysqli_query($connection, $query3);

        //fetch items
        $query4 = "select * from generalstoredrug where amount > 0";
        $result4 = mysqli_query($connection, $query4);

        $query5 = "select * from generalstoredrug where amount > 0";
        $result5 = mysqli_query($connection, $query5);
        
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>withdraw items</title>
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
                width: 8%;
            }
            #lg{
                width: 12%;
            }
            #now{
                font-size: 20px;
                color: white;
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
                    <a class="nav-item nav-link" href="record-new-items-general.php">Add Items</a>
                    <div class="dropdown">
                    <a class="nav-item nav-link" href="#">Withdraw Items</a>
                            <div class="dropdown-content">
                                <a href="record-withdraw-chemicals.php">Withdraw Chemicals</a>
                                <a href="record-withdraw-farmtools.php">Withdraw Farm Tools</a>
                                <a href="record-withdraw-seeds.php">Withdraw Seeds</a>
                                <a href="#">Withdraw Drugs</a>
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
                
            <form role="form" class="form-inline" action="record-withdraw-logic.php" method="POST">
                <div id="all" class="form-group">
                    <label for="item-name">Name of Item</label>
                    <!-- <input type="text" class="form-control" id="lg" name="item_name"> -->
                    <select class="form-control" name="item_name">
                        <?php
                            while($row = mysqli_fetch_array($result4)){
                                echo "<option>".$row['itemname']."</option>";
                            }
                        ?>
                        
                    </select>
                    <label for="course">Category</label>
                    <!-- <input type="text" class="form-control" id="lg" name="cat"> -->
                    <select class="form-control" name="main_cat">
                            <option>Chemical</option>
                            <option>Farm Tool</option>
                            <option>Drug</option>
                            <option>Seed</option>
                            <option>Fertilizer</option>
                    </select>
                    <label for="course">Sub Category</label>
                    <!-- <input type="text" class="form-control" id="lg" name="cat"> -->
                    <select class="form-control" name="cat">
                    <?php
                            while($row = mysqli_fetch_array($result5)){
                                echo "<option>".$row['category']."</option>";
                            }
                        ?>
                    </select>
                    <label for="course">Specification</label>
                    <input type="text" class="form-control" id="lg" name="spec" required>  
                    <label for="unit">Unit</label>
                    <input type="text" class="form-control" id="lg" name="unit" required>
                    <!-- <select class="form-control" name="unit">
                        <option>unit one</option>
                        <option>unit two</option>
                        <option>unit three</option>
                        <option>unit four</option>
                    </select>               -->
                    <label for="aver">Amount</label>
                    <input type="number" id="sm" class="form-control" name="amount" required>
                    <!-- <label for="grd">S. Price</label>
                    <input type="text" id="sm" class="form-control" name="price"> -->
                    <label for="dis">Dis.Name</label>
                    <!-- <input type="text" class="form-control" name="dispensary"> -->
                    <select class="form-control" name="disname">
                        <?php
                            while($row = mysqli_fetch_array($result3)){
                                echo "<option>".$row['fullname']."</option>";
                            }
                        ?>
                        
                    </select> 
                
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </form><br><br>
            <form role="form" class="form-inline" action="undo-withdraw-drug.php" method="POST">
                <button type="submit" class="btn btn-primary" name="submit">Undo</button>
            </form>
            <h4>Withdrawed Items</h4>
            <table class="table table-striped table-bordered">
                    <!-- <caption>Student's Grade</caption> -->
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Item Name</th>
                            <th>Sub Category</th>
                            <th>Specification</th>
                            <th>Unit</th>
                            <th>Amount</th>
                            <!-- <th>S.Price</th> -->
                            <th>Dis.Name</th>
                            <th>Date</th>                           
                            
                        </tr>
                    </thead>
                        <?php
                            while($row = mysqli_fetch_array($result)):;
                        ?>
                    <tbody>
                        <tr>
                            <td><?php echo $row[0]; ?></td>
                            <td><?php echo $row[1]; ?></td>
                            <td><?php echo $row[2]; ?></td>
                            <td><?php echo $row[3]; ?></td>
                            <td><?php echo $row[4]; ?></td>
                            <td><?php echo $row[5]; ?></td>
                            <!-- <td><?php echo $row[6]; ?></td> -->
                            <td><?php echo $row[6]; ?></td>
                            <td><?php echo $row[7]; ?></td>
                        </tr>   
                        <?php endwhile; ?>
                    </tbody>
                </table>
            
        </div>
    
        <script src="../../jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <?php
            mysqli_close($connection);
        ?>
    </body>
</html>
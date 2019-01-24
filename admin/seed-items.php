<!DOCTYPE html>
<html lang="en">
<?php
        $connection = mysqli_connect("localhost", "root", "", "farm");

        $query = "select * from seedsitems ";
        $query .= "where category = 'Seeds'";
        $result = mysqli_query($connection, $query);
        
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>seed items</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />    
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
            body{
                background-image: url("../img/Desktop-Backgrounds-Hd.jpg");
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
            .container{
                margin-top: 10px;
                text-align: center;
                width: 80%;
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
            .nav-item{
                border-right: solid rgb(192, 187, 187);
                border-radius: 10px;
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
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                border-radius: 10px;
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
            #copy{
                float: right;
            }
            
            
        </style>
</head>
<body>
        <header class="row">
            <h1 id="heading"><a href="#">DM Farm Service</a></h1>
        </header>
        <nav class="navbar navbar-expand-sm navbar-dark bg-primary mb-3">
                
                <a class="navbar-brand" href="menu.html">Admin's Main Menu</a>
                
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div id="nnn" class="navbar-nav">                        
                        <a class="nav-item nav-link" href="add-new-user.php">Add New Users</a>
                        <a class="nav-item nav-link" href="update-user-info.php">Update User Info</a>
                        <a class="nav-item nav-link" href="remove-user.php">Remove User</a>
                        <div class="dropdown">
                            <a class="nav-item nav-link" href="#">See Items List</a>
                            <div class="dropdown-content">
                                <a href="chemical-items.php">Chemicals</a>
                                <a href="farm-tools-items.php">Farm Tools</a>
                                <a href="#">Seeds</a>
                                <a href="drug-items.php">Drugs</a>
                                <a href="fertilizer-items.php">Fertilizers</a>
                                <a href="all-items.php">All Items in Dispensary</a>
                                <a href="all-items-store.php">All Items in Store</a>
                            </div>
                        </div>
                        <a class="nav-item nav-link" href="saled-items.php">See Sold Items</a>
                        <a class="nav-item nav-link" href="clinic-service.php">Clinical Services</a>
                        <a class="nav-item nav-link" href="gross-profit.php">See Profit</a>
                        <a class="nav-item nav-link" href="reset.php">Reset</a>
                        <a class="nav-item nav-link" href="login.html">Logout</a>
                    </div>
                </div>
            
            
        </nav>
        
        <div class="container">
                
        <br><br><br>
            <h4>List of seeds items</h4>
            <input id="copy" type="button" class="btn btn-primary" value="copy table" onclick="selectElementContents( document.getElementById('tableId') );">
            
            <table class="table table-striped table-bordered" id="tableId">
                    <!-- <caption>Student's Grade</caption> -->
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Item Name</th>
                            <th>Category</th>
                            <th>Item Category</th>
                            <th>Specification</th>
                            <th>Unit</th>
                            <th>Amount</th>
                            <th>Sell Price</th>
                            <!-- <th>Status</th> -->
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
                            <td><?php echo $row[6]; ?></td>
                            <td><?php echo $row[7]; ?></td>
                        </tr>   
                        <?php endwhile; ?>
                    </tbody>
                </table>
            
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
        </script>
    
        <script src="../jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <?php
            mysqli_close($connection);
        ?>
    </body>
</html>
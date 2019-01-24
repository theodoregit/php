<!DOCTYPE html>
<html lang="en">
<?php
        $connection = mysqli_connect("localhost", "root", "", "farm");

        $query = "select * from itemlist";
        $result = mysqli_query($connection, $query);
        
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>dm-farm-service || new items</title>
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
            #sm{
                width: 8%;
            }
            #lg{
                width: 12%;
            }
            
            
            
            
        </style>
</head>
<body>
        <header class="row">
            <h1 id="heading"><a href="#">DM Farm Service</a></h1>
        </header>
        <nav class="navbar navbar-expand-sm navbar-dark bg-primary mb-3">
                
                <a class="navbar-brand" href="#">Record New Items</a>
                
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div id="nnn" class="navbar-nav">                        
                    <a class="nav-item nav-link" href="record-menu.html">Main Menu</a>
                    <a class="nav-item nav-link" href="../all-items.php">See all Items</a>
                    <a class="nav-item nav-link" href="#">Get a copy of saled items</a>
                    <a class="nav-item nav-link" href="../login.html">Logout</a>
                    </div>
                </div>
            
    
        </nav>
        <div class="container">
                
            <form role="form" class="form-inline" action="record-items-logic.php" method="POST">
                <div id="all" class="form-group">
                    <label for="item-name">Name of Item</label>
                    <input type="text" class="form-control" id="lg" name="item_name">
                    <label for="course">Category</label>
                    <input type="text" class="form-control" id="lg" name="cat">  
                    <label for="unit">Unit</label>
                    <select class="form-control" name="unit">
                        <option>unit one</option>
                        <option>unit two</option>
                        <option>unit three</option>
                        <option>unit four</option>
                    </select>              
                    <label for="aver">Amount</label>
                    <input type="number" id="sm" class="form-control" name="amnt">
                    <label for="grd">Price</label>
                    <input type="text" id="sm" class="form-control" name="prc">
                
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </form><br><br>
            <table class="table table-striped table-bordered">
                    <!-- <caption>Student's Grade</caption> -->
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Category</th>
                            <th>Unit</th>
                            <th>Amount</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                        <?php
                            while($row = mysqli_fetch_array($result)):;
                        ?>
                    <tbody>
                        <tr>
                            <td><?php echo $row[0]; ?></td>
                            <td><?php echo $row[1]; ?></td>
                            <td></td>
                            <td><?php echo $row[2]; ?></td>
                            <td><?php echo $row[3]; ?></td>
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
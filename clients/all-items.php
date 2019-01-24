<!DOCTYPE html>
<html lang="en">
<?php
        $connection = mysqli_connect("localhost", "root", "", "farm");

        $query = "select * from itemlist";
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
        switch($queried_dept){
            case "Drug Dispensary":
                $cat = "Drug";
                $table = "drugs";
                break;
            case "Chemical Dispensary":
                $cat = "Chemical";
                $table = "chemicals";
                break;
            case "Farm Tools Dispensary":
                $cat = "Farm Tools";
                $table = "farmtools";
                break;
            case "Seeds Dispensary":
                $cat = "Seeds";
                $table = "seeds";
                break;
            case "Fertilizers Dispensary":
                $cat = "Fertilizers";
                $table = "fertilizers";
                break;
        }
        $itemtable = $table . "items";
        $query = "select * from $itemtable ";
        $query .= "where category = '{$cat}'";
        $result = mysqli_query($connection, $query);  
        
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>all items</title>
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
            #now{
                font-size: 20px;
                color: white;
            }
            
            
        </style>
</head>
<body>
        <header class="row">
            <h1 id="heading"><a href="#">DM Farm Service</a></h1>
        </header>
        <nav class="navbar navbar-expand-sm navbar-dark bg-primary mb-3">
                
                <a class="navbar-brand" href="#">See All Items List</a>
                
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div id="nnn" class="navbar-nav">                        
                    <a class="nav-item nav-link" href="records/record-menu.html">Main Menu</a>
                            <a class="nav-item nav-link" href="#" id="now">See all Items</a>
                            <a class="nav-item nav-link" href="change-password.html">Change Password</a>
                            <a class="nav-item nav-link" href="login.html">Logout</a>
                    </div>
                </div>
            
            
        </nav>
        
        <div class="container">
                <?php
                    echo $queried_name . "</br>";
                    echo $queried_dept;
                ?>
                
        <br><br><br>
            <h4>List of all items</h4>
            <table class="table table-striped table-bordered">
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
    
        <script src="../jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <?php
            mysqli_close($connection);
        ?>
    </body>
</html>
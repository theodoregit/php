<!DOCTYPE html>
<html lang="en">
<?php
        $connection = mysqli_connect("localhost", "root", "", "farm");
        
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

        $item = "";
        $saled = "";
                            switch($queried_dept){
                                case "Chemical Dispensary":
                                    $item = "Chemical";
                                    $saled = "chemicals";
                                    break;
                                case "Drug Dispensary":
                                    $item = "Drug";
                                    $saled = "drugs";
                                    break;
                                case "Farm Tools Dispensary":
                                    $item = "Farm Tools";
                                    $saled = "farmtools";
                                    break;
                                case "Seeds Dispensary":
                                    $item = "Seeds";
                                    $saled = "seeds";
                                    break;
                                case "Fertilizers Dispensary":
                                    $item = "Fertilizer";
                                    $saled = "fertilizers";
                                    break;
                            }
                            
                            $query = "select * from clinic";
                           
        
                            $result = mysqli_query($connection, $query);

        
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>clinical service</title>
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
                /* width: 6000px;; */
                height: 150%;
                border: rgb(131, 179, 180);
                background-color: rgb(131, 179, 180);
                opacity: 1;
                border-radius: 15px;
            }
            #cont{
                width: 100%;
                margin-top: 10px;
                text-align: center;
                /* width: 6000px;; */
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
                margin-left: 20%;
            }
            #above{
                background-color: aquamarine;
                width: 20%;
                height: 150px;
                text-align: center;
                margin-left: 40%;
            }

            /* #ave{
                width: 8%;
            } */
            
            
            
        </style>
</head>
<body>
        <header class="row">
            <h1 id="heading"><a href="#">DM Farm Service</a></h1>
        </header>
        <nav class="navbar navbar-expand-sm navbar-dark bg-primary mb-3">
                
                    <a class="navbar-brand" href="#">Record Clinical Service</a>
                    
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div id="nnn" class="navbar-nav">                        
                            <a class="nav-item nav-link" href="#"></a>
                            <a class="nav-item nav-link" href="#"></a>
                            <a class="nav-item nav-link" href="../change-password.html">Change Password</a>
                            <a class="nav-item nav-link" href="../login.html">Logout</a>
                            
                        </div>
                    </div>
                
        
            </nav>
        <div class="" id="cont">
                <?php
                    echo $queried_name . "</br>";
                    echo $queried_dept;
                    // echo $item;
                ?>
                
            <form role="form" class="form-inline" action="record-clinic-logic.php" method="POST">
                <div id="all" class="form-group">
                    <div class="mr-5">
                        <label for="item-name">Name of Customer</label>
                        <input type="text" id="ave" class="form-control" name="customer" required>                                        
                        <label for="aver">Animal Name</label>
                        <input type="text" id="ave" class="form-control" name="animal" required>
                    </div>
                    <div class="mr-5">
                        <label for="price">Number of Animals</label>
                        <input type="number" name="number" id="ave" class="form-control" required>
                        <label for="aver">Disease</label>
                        <input type="text" id="" class="form-control" name="disease" required>
                    </div>
                    <div class="mr-5">
                        <label for="aver">Medication</label>
                        <input type="text" id="" class="form-control" name="medicine" required>
                        <label for="aver">Unit</label>
                        <input type="text" id="" class="form-control" name="unit" required>
                    </div>
                    <div>
                        <label for="aver">Amount</label>
                        <input type="number" id="" class="form-control" name="amount" required>
                        <label for="aver">Service Fee</label>
                        <input type="number" id="" class="form-control" name="fee" required>
                    </div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    
                </div>
            </form><br><br>
            <h4>Services</h4>
            <table class="table table-striped table-bordered">
                    
                    <thead>
                        <tr>            
                            <th>No</th>                
                            <th>Name of Customer</th>
                            <th>Animal Name</th>                            
                            <th>Number</th>
                            <th>Disease</th>
                            <th>Medication</th>
                            <th>Unit</th>
                            <th>Amount</th>
                            <th>Service Fee</th>
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
                            <td><?php echo $row[6]; ?></td>                            
                            <td><?php echo $row[7]; ?></td>
                            <td><?php echo $row[8]; ?></td>
                            <td><?php echo $row[9]; ?></td>
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
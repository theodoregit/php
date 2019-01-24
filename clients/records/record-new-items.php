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
        echo $itemtable;

        $query = "select * from $itemtable ";
        $query .= "where category = '{$cat}'";
        $result = mysqli_query($connection, $query);       
        
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>record new items - dispensary</title>
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
                width: 5%;
            }
            #lg{
                width: 8%;
            }
            #item_name{
                width: 8%;
            }
            #item_cat{
                width: 8%;
            }
            #amnt{
                width: 5%;
            }
            #prc{
                width: 5%;
            }
            #spec{
                width: 5%;
            }
            #unit{
                width: 5%;
            }
            #myTable tr{
                cursor: pointer;
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
                    <a class="nav-item nav-link" href="../change-password.html">Change Password</a>
                    <a class="nav-item nav-link" href="../login.html">Logout</a>
                    </div>
                </div>
            
    
        </nav>
        <div class="container">
                <?php
                    echo $queried_name . "</br>";
                    echo $queried_dept;
                ?>
                
            <form role="form" class="form-inline" action="record-items-logic.php" method="POST">
                <div id="all" class="form-group">
                    <label for="item-name">Name of Item</label>
                    <input type="text" class="form-control" id="item_name" name="item_name" required>
                    <label for="item-name">Category</label>
                    <input type="text" class="form-control" id="item_cat" name="item_cat" required> 
                    <label for="item-name">Specification</label>
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
                    <input type="number" id="amnt" class="form-control" name="amnt" required>
                    <label for="grd">Price</label>
                    <input type="text" id="prc" class="form-control" name="prc" required>
                
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </form><br><br>
            <form role="form" class="form-inline" action="undo-recorded.php" method="POST">
                <button type="submit" class="btn btn-primary" name="submit">Undo</button>
            </form>
            <table class="table table-striped table-bordered" id="myTable">
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
                        </tr>   
                        <?php endwhile; ?>
                    </tbody>
                </table>
            
        </div>

        <script>
            function run(){
            document.getElementById('myTable').onclick = function(event){
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
                var f6 = document.getElementById('prc');

                f1.value = cells[1].innerHTML;
                f2.value = cells[3].innerHTML;
                f3.value = cells[4].innerHTML;
                f4.value = cells[5].innerHTML;
                // f5.value = cells[6].innerHTML;
                f6.value = cells[7].innerHTML;
                }
            }
            run();

        </script>
    
        <script src="../../jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <?php
            mysqli_close($connection);
        ?>
    </body>
</html>
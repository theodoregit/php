<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>reset system</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="main.css" />         -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
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
                width: 95%;
                height: 450px;
                border: rgb(131, 179, 180);
                background-color: rgb(131, 179, 180);
                opacity: 1;
                border-radius: 15px;
            }
            #banner{
                width: 1150px;
                height: 450px;
                margin-left: -20px;
                border-radius: 20px;
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


            slider{
                display: block;
                width: 100%;
                height: 100%;
                overflow: hidden;
                position: absolute;
            }

            slide > * {
                position: absolute;
                display: block;
                width: 100%;
                height: 100%;
                animation: slide 12s infinite;
                overflow: hidden;
            }
            silde:nth-child(1){
                left: 0%;
                animation-delay: -1s;
                background-image: url("../img/1.jpg");
                background-size: cover;
                background-position: center;
            }
            silde:nth-child(2){
                animation-delay: 2s;
                background-image: url("../img/2.jpg");
                background-size: cover;
                background-position: center;
            }
            silde:nth-child(3){
                animation-delay: 5s;
                background-image: url("../img/3.jpg");
                background-size: cover;
                background-position: center;
            }
            silde:nth-child(4){
                animation-delay: 8s;
                background-image: url("../img/4.jpg");
                background-size: cover;
                background-position: center;
            }

            slide p{
                font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
                font-size: 30px;
                text-align: center;
                display: inline-block;
                width: 20%;
                color: #fff;
            }

            @keyframes slide{
                0% {left: 100%; width: 100%;}
                5% {left: 0%;}
                25% {left: 0%;}
                30% {left: -100%; width: 100%;}
                30.0001% {left: -100%; width: 0%;}
                100% {left: 100%; width: 0%;}
            }
            #foo{
                color: white;
                float: right;
            }
            .btn {
                font-size: 45px;
                padding: 10px;
                margin-top: 20px;
            }
            
            
        </style>
</head>
<body>
        <header class="row">
            <h1 id="heading"><a href="#">DM Farm Service</a></h1>
        </header>

        <!-- Button trigger modal -->

      
      <!-- Modal -->
      <!-- <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Notifications</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>        
      </div>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
            Launch demo modal
          </button> -->
        
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
                                <a href="seed-items.php">Seeds</a>
                                <a href="drug-items.php">Drugs</a>
                                <a href="fertilizer-items.php">Fertilizers</a>
                                <a href="all-items.php">All Items in Dispensary</a>
                                <a href="all-items-store.php">All Items in Store</a>
                            </div>
                        </div>
                        
                        <a class="nav-item nav-link" href="saled-items.php">See Sold Items</a>
                        <a class="nav-item nav-link" href="clinic-service.php">Clinical Services</a>
                        <a class="nav-item nav-link" href="gross-profit.php">See Profit</a>
                        <a class="nav-item nav-link" href="#">Reset</a>
                        <a class="nav-item nav-link" href="login.html">Logout</a>
                    </div>
                </div>
            
    
        </nav>
        <!-- <slider>
                <slide><p>Slide 1</p></slide>
                <slide><p>Slide 2</p></slide>
                <slide><p>Slide 3</p></slide>
                <slide><p>Slide 4</p></slide>
            </slider> -->
        
        <div class="container mb-5">            
            <form action="resetsys.php" method="POST">
                <button class="btn btn-danger" type="submit">Reset</button>
                <h3>This Button will reset the overall system.</h3>
            </form>
        </div>
        <br><br><br><br>
    

        
    
        <script src="../jquery-3.3.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> -->
        <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->
    </body>
</html>
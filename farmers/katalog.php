<?php include('server.php');

if ($_SESSION['user_type'] != 'kunde') {
         session_destroy();
		
		header("location: login.php");
       
     }


	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "Du er ikke logget ind korrekt";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Farmers Market </title>
        <meta name="robots" content="noindex, nofollow">
        <link rel="stylesheet" href="css/flexboxgrid.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
        <link rel="icon" href="img/ifapple.png">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .slet {
                margin-top: 2vh;
            }
            
            footer {
                margin-top: 10vh;
            }
        </style>
    </head>

    <body>
        <header>
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header"> <a class="navbar-brand" href="kundeindex.php">Farmers Market</a> </div>
                    <ul class="nav navbar-nav">
                        <li><a href="bestil.php">Bestil</a></li>
                        <li><a href="kundetjek.php">Tjek bestilling</a></li>
                        <li class="active"><a href="katalog.php">Ugens tilbud</a></li>
                        <li><a href="season.php">Sæson</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li> <a class="logud" href="kundeindex.php?logout='1'">Log ud</a> </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="container">
            <div class="row con">
                <h3>Ugens tilbud</h3></div>
            <div class="container karousel">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!--    /*
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                    </ol> -->
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active"> <img src="img/fruitstand.jpg">
                            <div class="carousel-caption">
                                <h3>Ugens tilbud</h3>
                                <p>Swipe videre for at se vores tilbud</p>
                            </div>
                        </div>
                        <?php

    $query = "SELECT * FROM tilbud";
    
  $result = mysqli_query($db, $query);
                  if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
                      $picture = $row["img"];
      
                        ?>
                            <div class="item"> <img class="imgblur" src="img/fruitstand.jpg">
                                <div class="carousel-caption">
                                    <h3><?php echo ucfirst ($row["variant"]);?><?php echo " "?><?php echo ucfirst ($row["navn"]);?><?php echo " "?><?php echo "til"?><?php echo " "?><?php echo $row["pris"];?><?php echo ",-"?></h3>
                                    <p>
                                        <?php echo $row["tekst"];?>
                                    </p>
                                </div>
                            </div>
                            <?php 
    }
                  }
                        ?>
                    </div>
                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span> <span class="sr-only">Previous</span> </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span> <span class="sr-only">Next</span> </a>
                </div>
            </div>
        </div>
        <footer class="footer row">
            <div class="col-xs-4">
                <h4>Adresse</h4>
                <p><cite>Farmers Market ApS
                    <br> Litauen Allé 13
                    <br> 2630 Tåstrup
                    <br> Stade 2043 </cite></p>
            </div>
            <div class="col-xs-4">
                <h4>Farmers Market</h4>
                <p><cite>Hverdage: kl. 04.00 - 14.00
                    <br> Lørdag: kl: 04.00 - 12.00
                    <br> Telefon: 70 222 812
                    <br>farmers@farmersmarket.dk</cite></p>
            </div>
            <div class="col-xs-4">
                <h4>Solfrugt</h4>
                <p><cite>Torvehallerne Israels Plads Kbh K.
                    <br> Telefon: 40192862</cite></p>
            </div>
        </footer>
    </body>

    </html>
<?php 

include('server.php');
    
    if ($_SESSION['user_type'] != 'admin') {
         session_destroy();
		
		header("location: login.php");
       
     }

	if(!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "Du er ikke logget ind korrekt";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}

?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Farmers Admin </title>
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
            
            .karousel {
                margin-top: 2vh;
            }
            
            .container {
                margin-bottom: 3vh;
            }
            
            .frugter {
                display: flex;
                justify-content: center;
            }
            
            .btn {
                margin-left: 2vw;
            }
        </style>
    </head>

    <body>
        <header>
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header"> <a class="navbar-brand" href="adminindex.php">Farmers Market</a> </div>
                    <ul class="nav navbar-nav">
                        <li><a href="tjek.php">Tjek bestillinger</a></li>
                        <li><a href="lager.php">Lager</a></li>
                        <li><a href="register.php">Tilføj bruger</a></li>
                        <li><a href="tjeklogin.php">Håndter brugere</a></li>
                        <li class="active"><a href="tilbud.php">Katalog</a></li>
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
            <div class="row tjek">
                <div class="frugter col-xs-12">
                    <h3>Tilføj varer til kataloget her: </h3></div>
                <div class="frugter col-xs-12">


                    <form class="tilbud_box" method="post" action="tilbud.php">
                        <input type="text" name="navn" placeholder="navn" size="10">
                        <input type="text" name="variant" placeholder="variant" size="10">
                        <select name="enhed">
                            <option value="styk">Styk</option>
                            <option value="kasser">Kasser</option>
                            <option value="poser">Poser</option>
                        </select>
                        <input type="number" name="prisen" placeholder="Pris pr enhed" size="10">
                        <input type="text" name="tekst" placeholder="tekst" size="10">
                        <button type="submit" class="btn-success" name="tilbud_btn">Tilføj</button>
                    </form>

                </div>
                <div class="frugter col-xs-12"> <a href="stilbud.php" class="btn-warning">Slet fra Katalog</a></div>
            </div>
            <div class="container karousel">
                <div class="con row">
                    <h3>Nuværende katalog</h3></div>
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
        <footer>
            <?php

    $queryy = "SELECT * FROM tilbud";
    
  $result = mysqli_query($db, $queryy);
                  if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
                    $picture = $row['img'];
        
                ?> <img src="<?php echo $picture; ?>" height="70vh">
                <?php
                       
    }
                  }
                        ?>
        </footer>
    </body>

    </html>
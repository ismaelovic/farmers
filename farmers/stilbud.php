<?php include('server.php');
    if ($_SESSION['user_type'] != 'admin') {
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
            .knap {
                margin-top: 2vh;
            }
            
            .container {
                width: 50%;
            }
            
            .container,
            footer {
                margin-top: 7vh;
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
                <h3>Slet fra katalog</h3></div>
            <div class="frugter col-xs-12">
                <form action="stilbud.php" method="post">
                    <?php
          
        
                 $query = "SELECT * FROM tilbud";
         
      //vare fundet fundet
		$result = mysqli_query($db, $query);

      if ($result->num_rows > 0) {
    // output data of each row
           ?>
                        <div class="titel">
                            <h3>Nuværende tilbud i systemet:</h3></div>
                        <?php
          
          
    while($row = $result->fetch_assoc()) {
        echo "<table border = 0>";
       $tilbudid = $row["id"];
        $navnet = $row["navn"];
        ?>
                            <div class="round">
                                <input type="radio" id="checkbox" name="productid" value="<?php echo $tilbudid ?>">
                                <?php echo ucfirst($row["variant"])?>
                                    <?php echo " "?>
                                        <?php echo ucfirst($navnet) ?>
                                            <?php echo "  til "?>
                                                <?php echo $row["pris"];?>
                                                    <?php echo ",-"?>
                            </div>
                            <?php
        
        echo "</table>";
    }
          
} 
            
        ?>
                                <input type="submit" class=" btn-danger" name="slet_tilbud_btn" value="Slet"> </form>
            </div>
        </div>
        <footer> </footer>
    </body>

    </html>
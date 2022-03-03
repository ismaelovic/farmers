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
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
        <link rel="icon" href="img/ifapple.png">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .slet {
                margin-top: 2vh;
            }
            
            .container {
                margin-top: 10vh;
            }
            
            .resultat input[type=text] {
                width: 5vw;
                border: none;
                background-color: gainsboro;
                text-align: center;
            }
            
            footer {
                margin-top: 12vh;
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
                        <li class="active"><a href="tjeklogin.php">Håndter brugere</a></li>
                        <li><a href="tilbud.php">Katalog</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li> <a class="logud" href="kundeindex.php?logout='1'">Log ud</a> </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="container">
            <div class="row con">
                <h3>Vis eller slet brugere i systemet</h3></div>
            <div class="row tjek">
                <form class="login_tjek_box col-xs-4" action="tjeklogin.php" method="post">
                    <label for="navn">Indtast navn eller brugertype: </label>
                    <br>
                    <input type="text" name="navn">
                    <br>
                    <br>
                    <input type="submit" class="btn-success" name="check_login_btn" value="Vis!">
                    <input type="submit" class="btn-success" name="check_login_btn_alt" value="Vis alt!">
                    <br>
                    <br> </form>
                <br>
                <br>
                <br>
                <div class="resultat col-xs-8">
                    <?php
        
        
        if (isset($_POST['check_login_btn'])) {
            
             if (empty($_POST['navn'])){
                 echo "Søgefeltet er tomt!!";
             }
            
            else if (isset($_POST['navn'])){
            
             ?>
                        <form action="tjeklogin.php" method="post">
                            <?php
           $name = $_POST['navn']; 
          
            
             $query = "SELECT * FROM login WHERE brugernavn LIKE '$name%' OR brugertype LIKE '$name%' OR sted LIKE '$name%'";
        
      //vare fundet fundet
		$result = mysqli_query($db, $query);

      if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        echo "<table border = 0>";
       
    $brugernavn = $row["brugernavn"];
        ?>
                                <div class="round">
                                    <input type="radio" id="checkbox" name="username" value="<?php echo $brugernavn ?>">
                                    <input type="text" readonly value="<?php echo ucfirst($brugernavn)?>">
                                    <?php echo " fra"?>
                                        <?php echo ucfirst ($row["sted"]);?>
                                            <?php echo " " ?>
                                                <input type="text" readonly value="<?php echo ucfirst($row['brugertype'])?>">

                                                <?php echo " Kode: "?>
                                                    <?php echo $row["adgangskode"];?>
                                </div>
                                <?php
        
   
        
     
        
        
        
        
        
        
        
        
        
        echo "</table>";
    }
      }
            

          
        ?>
                                    <input type="submit" class="btn-danger" name="slet_login_btn" value="Slet"> </form>
                        <?php
        }
        }
                    if (isset($_POST['check_login_btn_alt'])) {
        
                         ?>
                            <form action="tjeklogin.php" method="post">
                                <?php
                        
                 $query = "SELECT * FROM login ORDER BY id DESC";
         
      //vare fundet fundet
		$result = mysqli_query($db, $query);
           ?>
                                    <div class="titel">
                                        <h3>Brugere i systemet:</h3></div>
                                    <?php
      if ($result->num_rows > 0) {
    // output data of each row

          
          
    while($row = $result->fetch_assoc()) {
        echo "<table border = 0>";
       
        $brugernavn = $row["brugernavn"];
        ?>
                                        <div class="round">
                                            <input type="radio" id="checkbox" name="username" value="<?php echo $brugernavn ?>">
                                            <input id="demo" type="text" readonly value="<?php echo ucfirst($brugernavn)?>">
                                            <?php echo " fra"?>
                                                <?php echo ucfirst ($row["sted"]);?>
                                                    <?php echo " " ?>
                                                        <input type="text" readonly value="<?php echo ucfirst($row['brugertype'])?>">

                                                        <?php echo " Kode: "?>
                                                            <?php echo $row["adgangskode"];?>
                                        </div>
                                        <?php
        
        echo "</table>";
    }
          
} 
                           ?>
                                            <input type="submit" class="btn-danger" name="slet_login_btn" value="Slet"> </form>
                            <?php
            }




        ?>
                </div>
            </div>
        </div>
        <footer>

        </footer>
    </body>


    </html>
<?php 
include('server.php');

	session_start(); 

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
        <title>Farmers Admin</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="css/flexboxgrid.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
        <link rel="icon" href="img/ifapple.png">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>
            body {
                background-color: #f1f1f1;
            }
            
            .container {
                margin-top: 7vh;
                width: 60%;
            }
            
            .status {
                width: 100%;
                height: 100%;
                text-align: center;
                font-size: 5vh;
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
                    <div class="navbar-header"> <a class="navbar-brand" href="adminindex.php">Farmers Market</a> </div>
                    <ul class="nav navbar-nav">
                        <li><a href="tjek.php">Tjek bestillinger</a></li>
                        <li><a href="lager.php">Lager</a></li>
                        <li><a href="register.php">Tilføj bruger</a></li>
                        <li><a href="tjeklogin.php">Håndter brugere</a></li>
                        <li><a href="tilbud.php">Katalog</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li> <a class="logud" href="kundeindex.php?logout='1'">Log ud</a> </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="container">
            <div class="con row">
                <h3><strong>Velkommen tilbage</strong></h3> </div>
            <div class="wrapper row">
                <div class="col-xs-12 index">
                    <?php  if (isset($_SESSION['username'])&&($_SESSION['user_type'])) : ?>
                        <h3> <br><img src="img/user.png"><strong><?php echo ucfirst($_SESSION['username']);?></strong> <cite><?php echo " ("; echo ucfirst($_SESSION['user_type']); echo ")"?> </cite></h3>
                        <?php endif ?>
                </div>
            </div>
            <div class="wrapper row">
                <div class="col-xs-12 col-md-4 status">
                    <div class="titel">
                        <h3>Status</h3></div>
                    <?php
                
        
                 $query = "SELECT count(id) AS total FROM bestillinger WHERE tid > timestampadd(day, -2, now())";
               
         
      //vare fundet fundet
		$result = mysqli_query($db, $query);
        $values = mysqli_fetch_assoc($result);
        $num_rows = $values['total'];                    

    // output data of each row
           ?>
                        <div class="tekst">
                            <h4> <strong><?php echo $num_rows ?></strong> bestillinger</h4></div>



                        <?php
                
        
                 $query2 = "SELECT count(DISTINCT(bruger)) AS total2 FROM bestillinger WHERE tid > timestampadd(day, -2, now())";
               
         
      //vare fundet fundet
		$result2 = mysqli_query($db, $query2);
        $values2 = mysqli_fetch_assoc($result2);
        $num_orders = $values2['total2'];                    

    // output data of each row
           ?>
                            <div class="tekst">
                                <h4>Fra <strong><?php echo $num_orders ?></strong> kunder</h4></div>


                </div>
                <div class="col-xs-12 col-md-8 indhold">
                    <?php
                
        
                 $query = "SELECT * FROM bestillinger order by tid desc limit 3";
               
         
      //vare fundet fundet
		$result = mysqli_query($db, $query);

      if ($result->num_rows > 0) {
    // output data of each row
           ?>
                        <div class="titel">
                            <h3>Seneste bestillinger:</h3></div>
                        <?php
          
          
    while($row = $result->fetch_assoc()) {
        echo "<table border = 0>";
      
       
        ?>
                            <div class="round"> <strong><?php echo $row["tid"]?></strong>
                                <?php echo " - "?>
                                    <?php echo ucfirst($row["variant"])?>
                                        <?php echo ucfirst($row["navn"]) ?>
                                            <?php echo " (" ?>
                                                <?php echo $row["antal"]?>
                                                    <?php echo $row["enhed"]; ?>
                                                        <?php echo " )" ?>
                                                            <?php echo "til: "?>
                                                                <?php echo ucfirst($row["bruger"])?>
                            </div>
                            <?php
        
        echo "</table>";
       
    }
           
} 
            
        ?>
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
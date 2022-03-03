<?php 
include('server.php');

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
	}
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Farmers Market</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="robots" content="noindex, nofollow">
        <link rel="stylesheet" href="css/flexboxgrid.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
        <link rel="icon" href="img/ifapple.png">
        <style>
            .round {
                border-bottom: solid gainsboro 1px;
            }
            
            .container {
                margin-top: 7vh;
                width: 70%;
                min-height: 80vh;
                position: relative;
            }
            
            .buy {
                font-size: 1vw;
                margin-left: 1vw;
            }
            
            .indhold {
                border-bottom: solid green 1px;
                padding-bottom: 1vh;
            }
            
            footer {
                margin-top: 5vh;
            }
            
            input {
                margin-right: 0.1vw;
                margin-left: 0.1vw;
            }
            
            input[type=number] {
                width: 4vw;
                -moz-appearance: textfield;
                margin-left: 0.5vw;
            }
            
            input[type=text] {
                width: 6vw;
                border: none;
                background-color: whitesmoke;
                text-align: center;
            }
            
            .round .tekst {
                width: 2.5vw;
                -moz-appearance: textfield;
                border: none;
                background-color: whitesmoke;
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
                        <li><a href="katalog.php">Ugens tilbud</a></li>
                        <li><a href="season.php">Sæson</a></li>
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
                <div class="col-xs-12 col-md-3 index">
                    <?php  if (isset($_SESSION['username'])&&($_SESSION['user_place'])) : ?>
                        <h3> <br><img src="img/user.png"><strong><?php echo ucfirst($_SESSION['username']);?></strong> <cite><?php echo " ("; echo ucfirst($_SESSION['user_place']); echo ")"?> </cite></h3>
                        <?php endif ?>
                </div>
                <div class="col-xs-12 col-md-9 indhold genbestil">
                    <?php
                $bruger = $_SESSION['username'];
        
                 $query = "SELECT * FROM bestillinger WHERE bruger='$bruger' ORDER BY tid DESC LIMIT 6";
         
      //vare fundet fundet
		$result = mysqli_query($db, $query);

      if ($result->num_rows > 0) {
    // output data of each row
           ?>
                        <div class="titel">
                            <h3>Genbestil?</h3></div>
                        <?php
          
          
    while($row = $result->fetch_assoc()) {
        echo "<table border = 0>";
       $ordreid = $row["id"];
        $navnet = $row["navn"];
        $varianten = $row["variant"];
        $enheden = $row["enhed"];
        $prisen = ($row["pris"]/$row["antal"])
        ?>
                            <div class="round">
                                <form action="kundeindex.php" method="post">
                                    <input type="text" name="variant" title="<?php echo $varianten ?>" readonly value="<?php echo ucfirst($varianten) ?>">
                                    <input type="text" title="<?php echo $navnet ?>" name="navn" readonly value="<?php echo ucfirst($navnet) ?>">
                                    <input type="text" class="tekst" readonly value="<?php echo " i "?>">
                                    <input type="text" name="enhed" readonly value="<?php echo $enheden ?>">
                                    <input type="text" class="tekst" readonly value="<?php echo " til " ?>">
                                    <input type="number" class="tekst" name="pris" readonly value="<?php echo $prisen?>">
                                    <input type="text" class="tekst" readonly value="<?php echo " ,- " ?>">
                                    <input type="number" name="antal" placeholder="antal...">
                                    <input type="submit" class="btn-success" name="buy_btn" value="Køb"> </form>
                            </div>
                            <?php
        
        echo "</table>";
    }
          
} 
            
        ?>
                </div>
            </div>
            <div class="wrapper row">
                <div class="col-xs-12 col-md-6 indhold">
                    <?php
                
        
                 $query = "SELECT navn, variant, enhed, count(navn) c FROM bestillinger group by navn order by c DESC LIMIT 3";
         
      //vare fundet fundet
		$result = mysqli_query($db, $query);

      if ($result->num_rows > 0) {
    // output data of each row
           ?>
                        <div class="titel">
                            <h3>Populære køb</h3></div>
                        <?php
          
          
    while($row = $result->fetch_assoc()) {
        echo "<table border = 0>";
      
       
        ?>
                            <div class="round">
                                <?php echo ucfirst($row["variant"])?>
                                    <?php echo " "?>
                                        <?php echo ucfirst($row["navn"]) ?>
                                            <?php echo " (" ?>
                                                <?php echo ucfirst($row["enhed"])?>
                                                    <?php echo " )" ?>
                            </div>
                            <?php
        
        echo "</table>";
       
    }
           
} 
            
        ?>
                </div>
                <div class="col-xs-12 col-md-6 indhold">
                    <?php
                
        
                 $query = "SELECT * FROM tilbud ORDER BY id DESC LIMIT 2";
         
      //vare fundet fundet
		$result = mysqli_query($db, $query);

      if ($result->num_rows > 0) {
    // output data of each row
           ?>
                        <div class="titel">
                            <h3>Seneste tilbud</h3></div>
                        <?php
          
          
    while($row = $result->fetch_assoc()) {
        echo "<table border = 0>";
      
       
        ?>
                            <div class="round">
                                <?php echo ucfirst($row["variant"])?>
                                    <?php echo " "?>
                                        <?php echo ucfirst($row["navn"]) ?>
                                            <?php echo " til"?>
                                                <?php echo $row["pris"]?>
                                                    <?php echo ",-" ?>
                                                        <?php echo " (" ?>
                                                            <?php echo ucfirst($row["enhed"]) ?>
                                                                <?php echo ")" ?>
                            </div>
                            <?php
        
        echo "</table>";
       
    }
           ?><a href="katalog.php" class="btn-success">Se Katalog</a>
                                <?php
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
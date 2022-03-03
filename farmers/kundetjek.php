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
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
        <link rel="icon" href="img/ifapple.png">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {
                overflow-x: hidden;
            }
            
            .container,
            footer {
                margin-top: 6vh;
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
                        <li class="active"><a href="kundetjek.php">Tjek bestilling</a></li>
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
            <div class="row con">
                <h3>Tjek dine bestillinger</h3></div>
            <div class="row tjek">
                <form class="kunde_tjek_box col-md-4 col-xs-12" action="kundetjek.php" method="post">
                    <br>
                    <label for="dt">For</label>
                    <input name="dt" type="date" placeholder="åååå-mm-dd" />
                    <br>
                    <br>
                    <input type="submit" class="btn-success" name="tjek_btn" value="Vis!">
                    <br>
                    <br>
                    <br> </form>
                <div class="resultat col-md-8 col-xs-12">
                    <?php
        
        
        if (isset($_POST['tjek_btn'])) {
           $name = $_SESSION['username'];
           $date = $_POST['dt'];
    
           if (empty($_POST['dt'])) {
                
              $query = "SELECT bruger, navn, variant, enhed, antal, pris, tid FROM bestillinger WHERE bruger='$name' ORDER BY tid DESC";
              $queryTo = "SELECT SUM(pris) AS pris_ialt FROM bestillinger WHERE bruger='$name'";    
      //vare fundet fundet
		$result = mysqli_query($db, $query);
         $resultTo = mysqli_query($db, $queryTo);      

      if ($result->num_rows > 0) {
    // output data of each row
          
          echo "Du har bestilt følgende: <br />"; 
          //echo " " . $row["bruger"];
    while($row = $result->fetch_assoc()) {
        echo "<table class=table-striped table-hover table-bordered>";
        echo "<tr class=table-active>";
        echo "<td>". $row["tid"]. " --- " .$row["antal"] . " " . $row["enhed"]. " " . $row["variant"].  " " . $row["navn"]. " " . $row["pris"] . " kr" . "</td>" . " ";
        echo "</tr>";
        echo "</table>";
    }
}
               else if($result->num_rows < 1){
                   echo "ingen bestillinger";
               }
               while($row = $resultTo->fetch_assoc()) {
               echo "<br>" . "For ialt: " .$row["pris_ialt"]. ".00 kr";
           } 
               
            }
            else{
             $query = "SELECT bruger, navn, variant, enhed, antal, pris, tid FROM bestillinger WHERE bruger='$name' AND tid='$date'";
            
             $queryTo = "SELECT SUM(pris) AS pris_ialt FROM bestillinger WHERE bruger='$name' AND tid='$date'";
            
      //vare fundet fundet
		    $result = mysqli_query($db, $query);
            $resultTo = mysqli_query($db, $queryTo);

      if ($result->num_rows > 0) {
    // output data of each row
          echo "For $date har du bestilt følgende: <br />"; 
          //echo " " . $row["bruger"];
    while($row = $result->fetch_assoc()) {
        echo "<table class=table-striped table-hover table-bordered>";
        echo "<tr>";
        echo "<td>" .$row["antal"] . " " . $row["enhed"]. " " . $row["variant"].  " " . $row["navn"]. " " . $row["pris"] . " kr" . "</td>" . " ";
        echo "</tr>";        
        echo "</table>";
    }
     while($row = $resultTo->fetch_assoc()) {
               echo "<br>" . "For ialt: " .$row["pris_ialt"]. ".00 kr";
           }    
          
}  
            else if($result->num_rows < 1){
          echo "ingen bestillinger";
      }
            
            
            
            
                
           
    
        }
        
        }



        
        ?>
                </div>
            </div>
            <br> </div>
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
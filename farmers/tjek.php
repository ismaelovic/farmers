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
            .container {
                margin-top: 7vh;
                font-family: 'Ubuntu', sans-serif;
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
                        <li class="active"><a href="tjek.php">Tjek bestillinger</a></li>
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
            <div class="row con mb20">
                <h3>Tjek bestillinger</h3></div>
            <div class="row mb20">
                <form class="admin_tjek_box col-md-4 col-xs-12" action="tjek.php" method="post">
                    <br>
                    <label for="dt">Fra</label>
                    <br>
                    <input name="dt" type="date" placeholder="åååå-mm-dd" />
                    <br>
                    <br>
                    <label for="navn">Indtast kundens navn: </label>
                    <br>
                    <input type="text" name="navn">
                    <br>
                    <br>
                    <input type="submit" class="btn-success" name="check_btn" value="Vis!">
                    <br>
                    <br> </form>
                <div class="resultat col-md-8 col-xs-12">
                    <?php
        
        
        if (isset($_POST['check_btn'])) {
             ?>
                        <form class="sletknap" action="tjek.php" method="post">
                            <?php
           $name = $_POST['navn']; 
           $date = $_POST['dt'];
            
             $query = "SELECT * FROM bestillinger WHERE bruger='$name' AND tid='$date'";
        
      //vare fundet fundet
		$result = mysqli_query($db, $query);

      if ($result->num_rows > 0) {
    // output data of each row
          echo "<strong>$name</strong> har bestilt følgende: <br />"; 
          ?>
                                <br>
                                <?php
    while($row = $result->fetch_assoc()) {
        echo "<table table class=table-striped table-hover table-bordered>";
       $orderid = $row["id"];
        ?>
                                    <input type="radio" name="vareid" value="<?php echo $orderid ?>"> <strong><?php echo $row["tid"]?></strong>
                                    <?php echo " - "?>
                                        <?php echo ucfirst($row["variant"])?>
                                            <?php echo ucfirst($row["navn"]) ?>
                                                <?php echo " (" ?>
                                                    <?php echo $row["antal"]?>
                                                        <?php echo $row["enhed"]; ?>
                                                            <?php echo " )" ?>
                                                                <?php echo "til: "?>
                                                                    <?php echo ucfirst($row["bruger"])?>
                                                                        <?php
        
        echo "</table>";
    }
         
} 
            if ((empty($_POST['dt']) && empty($_POST['navn']))) {
        
                 $query = "SELECT * FROM bestillinger ORDER BY tid DESC";
        
      //vare fundet fundet
		$result = mysqli_query($db, $query);

      if ($result->num_rows > 0) {
    // output data of each row
          echo "Der er bestilt følgende: <br />"; 
          //echo " " . $row["bruger"];
    while($row = $result->fetch_assoc()) {
        echo "<table class=table-striped table-hover table-bordered>";
       $orderid = $row["id"];
        ?>
                                                                            <input type="radio" class="tabel" name="vareid" value="<?php echo $orderid ?>"> <strong><?php echo $row["tid"]?></strong>
                                                                            <?php echo " - "?>
                                                                                <?php echo ucfirst($row["variant"])?>
                                                                                    <?php echo ucfirst($row["navn"]) ?>
                                                                                        <?php echo " (" ?>
                                                                                            <?php echo $row["antal"]?>
                                                                                                <?php echo $row["enhed"]; ?>
                                                                                                    <?php echo " )" ?>
                                                                                                        <?php echo "til: "?>
                                                                                                            <?php echo ucfirst($row["bruger"])?>
                                                                                                                <?php
        
        echo "</table>";
    }
} 
                 
                 
                 //        echo "<script type='text/javascript'>alert('Indtast en dato og kundenavn for at se bestillinger')</script>";
            }
            else if (empty($_POST['dt'])) {
                
              $query = "SELECT * FROM bestillinger WHERE bruger='$name' ORDER BY tid DESC";
        
      //vare fundet fundet
		$result = mysqli_query($db, $query);

      if ($result->num_rows > 0) {
    // output data of each row
          echo "<strong> $name</strong> har bestilt følgende: <br />"; 
          ?>
                                                                                                                    <br>
                                                                                                                    <?php
          //echo " " . $row["bruger"];
  while($row = $result->fetch_assoc()) {
        echo "<table class=table-striped table-hover table-bordered>";
       $orderid = $row["id"];
        ?>
                                                                                                                        <input type="radio" class="tabel" name="vareid" value="<?php echo $orderid ?>"> <strong>  <?php echo $row["tid"];?></strong>
                                                                                                                        <?php echo $row["antal"];?>
                                                                                                                            <?php echo $row["enhed"];?>
                                                                                                                                <?php echo $row["variant"];?>
                                                                                                                                    <?php echo $row["navn"];?>
                                                                                                                                        <?php echo $row["pris"];?>
                                                                                                                                            <?php echo ",-"?>
                                                                                                                                                <?php
        
        echo "</table>";
    }
} 
               
            } 
            else if(empty($_POST['navn'])){
               
                $query = "SELECT bruger, navn, variant, enhed, antal, pris, tid FROM bestillinger WHERE tid='$date' ORDER BY bruger DESC";
        
      //vare fundet fundet
		$result = mysqli_query($db, $query);

      if ($result->num_rows > 0) {
    // output data of each row
          echo "For <strong>$date</strong> Er der bestilt følgende:"; 
?>
                                                                                                                                                    <br>
                                                                                                                                                    <br>
                                                                                                                                                    <?php
     while($row = $result->fetch_assoc()) {
        echo "<table class=table-striped table-hover table-bordered>";
       $orderid = $row["id"];
        ?>
                                                                                                                                                        <input type="radio" class="tabel" name="vareid" value="<?php echo $orderid ?>">
                                                                                                                                                        <strong><?php echo ucfirst($row["bruger"])?></strong>

                                                                                                                                                        <?php echo $row["antal"];?>
                                                                                                                                                            <?php echo $row["enhed"];?>
                                                                                                                                                                <?php echo $row["variant"];?>
                                                                                                                                                                    <?php echo $row["navn"];?>
                                                                                                                                                                        <?php echo $row["pris"];?>
                                                                                                                                                                            <?php echo ",-"?>
                                                                                                                                                                                <?php
        
        echo "</table>";
    }
} else {
     echo "<table class=table-striped table-hover table-bordered>";
          echo "Ingen bestillinger";
          echo "</table>";
}
            }
                ?>
                                                                                                                                                                                    <br>
                                                                                                                                                                                    <input type="submit" class="btn-danger" name="slet_btn" value="Slet"> </form>
                        <?php 
            }


        ?>
                </div>
            </div>
        </div>
        <footer>


            <?php 
             //$query = "DELETE FROM bestillinger WHERE tid < timestampadd(day, -70, now())";
               //vare fundet fundet
		//$result = mysqli_query($db, $query);
          //          ?>
        </footer>
    </body>

    </html>
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
        <script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
        <script src="css/jquery.modal.min.js" type="text/javascript" charset="utf-8"></script>
        <link rel="stylesheet" href="css/jquery.modal.css" type="text/css" media="screen">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .container {
                margin-top: 10vh;
            }
            
            footer {
                margin-top: 12vh;
            }
            
            .wrapper {
                align-content: center;
                border: solid gainsboro 2px;
                border-radius: 10px;
                margin-top: 2vh;
            }
            
            .wrapper input,
            .wrapper select {
                margin-right: 0.2vw;
                margin-left: 0.2vw;
                height: 3vh;
                text-align: center;
                border-radius: 5px;
                border: gainsboro solid 1px;
                box-shadow: none;
            }
            
            .wrapper input[type=number] {
                width: 7vw;
                -moz-appearance: textfield;
                margin-left: 0.5vw;
            }
            
            .wrapper input[type=text] {
                width: 6vw;
            }
            
            .add {
                display: flex;
                justify-content: center;
            }
            
            .tjek input[type=text] {
                text-align: center;
                border-radius: 5px;
                border: gainsboro solid 1px;
                box-shadow: none;
            }
            
            .titel h3 {
                font-size: 2.5vh;
            }
            
            .output {
                border-bottom: dashed black 1px;
            }
            
            .out {
                display: inline-block;
                width: 4.5vw;
                margin-left: 0.5vw;
                margin-right: 1vw;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            
            radio {
                border: solid red 3px;
                color: aqua;
            }
            
            #modalupdate input {
                margin-right: 0.1vw;
                margin-left: 0.1vw;
            }
            
            #modalupdate input[type=number] {
                -moz-appearance: textfield;
                margin-left: 0.5vw;
            }
            
            #modalupdate input[type=text] {
                text-align: center;
            }
            
            #modalupdate .round .tekst {
                -moz-appearance: textfield;
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
                        <li class="active"><a href="lager.php">Lager</a></li>
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

            <div class="row con">
                <h3>Farmers Lager</h3> </div>
            <div class="row wrapper">
                <div class="col-xs-12 add">
                    <h3>Tilføj varer til lager </h3></div>
                <div class="col-md-12 add">

                    <form method="post" action="lager.php">
                        <?php include('errors.php'); ?>
                            <select name="klasse" title="Klasse">

                                <option value="frugt">Frugt</option>
                                <option value="bær">Bær</option>
                                <option value="tomat">Tomat</option>
                                <option value="blomst">Blomst</option>
                                <option value="øko">Øko</option>
                                <option value="special">Special varer</option>
                                <option value="tør">Tørvarer</option>
                                <option value="svamp">Svampe</option>
                                <option value="salat">Salater</option>
                            </select>
                            <input type="text" name="navn" placeholder="navn">
                            <input type="text" name="variant" placeholder="oprindsland">
                            <select name="enhed">
                                <option value="styk">Styk</option>
                                <option value="kasser">Kasser</option>
                                <option value="poser">Poser</option>
                            </select>
                            <input type="number" name="antal" placeholder="antal">
                            <input type="number" name="prisen" placeholder="Pris pr enhed">
                            <button type="submit" class="btn-success" name="add_btn">Tilføj</button>
                    </form>
                </div>
            </div>
            <div class="row tjek">
                <form class="admin_tjek_box col-xs-12 col-md-4" action="lager.php" method="post">
                    <label for="navn">Evt. filtrering </label>
                    <br>
                    <input type="text" name="navn" placeholder="Søg i lageret">
                    <br>
                    <br>
                    <input type="submit" class="btn-success" name="lager_btn" value="Søg!">

                    <input type="submit" class="btn-success" name="lager_btn_alt" value="Vis alt!">
                    <br> </form>
                <div class="resultat col-xs-12 col-md-8">
                    <?php
        
        
        if (isset($_POST['lager_btn'])) {
            
             if (empty($_POST['navn'])){
                 echo "Søgefeltet er tomt!!";
             }
            else if (isset($_POST['navn'])){
                 
             
            
             ?>
                        <form action="lager.php" method="post">
                            <?php
           $name = $_POST['navn']; 
           
            
             $query = "SELECT * FROM lager WHERE bruger LIKE '$name%' OR navn LIKE '$name%' OR variant LIKE '$name%' OR enhed LIKE '$name%' OR klasse LIKE '$name%'";
        
      //vare fundet fundet
		$result = mysqli_query($db, $query);

      if ($result->num_rows > 0) {
    // output data of each row
          ?>
                                <div class="titel row">
                                    <h3><?php echo "Resultat for: ", ucfirst($name) ?></h3>
                                    <br> </div>
                                <?php
          //echo " " . $row["bruger"];
    while($row = $result->fetch_assoc()) {
        echo "<table table class=table-striped table-hover table-bordered>";
       $productid = $row["id"];
        $title = $row["navn"];
        ?>
                                    <div class="output">
                                        <input type="radio" class="box" name="vareid" value="<?php echo $productid ?>">
                                        <div class="out">
                                            <?php echo $row["antal"];?>
                                                <?php echo $row["enhed"];?>
                                        </div>
                                        <div class="out">
                                            <?php echo $row["variant"];?>
                                        </div>
                                        <div class="out" title="<?php echo $title?>">
                                            <?php echo $row["navn"];?>

                                        </div>
                                        <div class="out">
                                            <?php echo $row["klasse"]?>
                                        </div>
                                        <div class="out">
                                            <?php echo $row["pris"], ",-";?>
                                        </div>
                                        <div class="out">
                                            <?php echo "(", $row["bruger"], ")";?>
                                        </div>
                                    </div>
                                    <?php
        
        echo "</table>";
    }
         
} 
            
                ?>
                                        <br>
                                        <input type="submit" class="btn btn-danger" name="slet_btn" value="Slet">







                        </form>






                        <?php 
            }
        }
                    if (isset($_POST['lager_btn_alt'])) {
                        ?>
                            <form action="lager.php" method="post">
                                <?php
                 $query = "SELECT * FROM lager ORDER BY navn DESC";
        
      //vare fundet fundet
		$result = mysqli_query($db, $query);

      if ($result->num_rows > 0) {
     ?>
                                    <div class="titel row">
                                        <h3>Sådan ser hele lageret ud:</h3>
                                        <br> </div>
                                    <?php
         
    while($row = $result->fetch_assoc()) {
        echo "<table class=table-striped table-hover table-bordered>";
       $productid = $row["id"];
        $title = $row["navn"];
        ?>
                                        <div class="output">
                                            <input type="radio" class="box" name="vareid" value="<?php echo $productid ?>">
                                            <div class="out">
                                                <?php echo $row["antal"];?>
                                                    <?php echo $row["enhed"];?>
                                            </div>
                                            <div class="out">
                                                <?php echo $row["variant"];?>
                                            </div>
                                            <div class="out" title="<?php echo $title?>">
                                                <?php echo $row["navn"];?>
                                            </div>
                                            <div class="out">
                                                <?php echo $row["klasse"]?>
                                            </div>
                                            <div class="out">
                                                <?php echo $row["pris"], ",-";?>
                                            </div>
                                            <div class="out">
                                                <?php echo "(", $row["bruger"], ")";?>
                                            </div>
                                        </div>
                                        <?php
        
        echo "</table>";
    }
}?>
                                            <br>
                                            <input type="submit" class="btn-danger" name="slet_btn" value="Slet">







                            </form>

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
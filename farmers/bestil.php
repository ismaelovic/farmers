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
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/jquery.modal.css" type="text/css" media="screen">
        <link rel="icon" href="img/ifapple.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
        <script src="css/jquery.modal.min.js" type="text/javascript" charset="utf-8"></script>
        <style>
            *,
            *:before,
            *:after {
                box-sizing: border-box;
            }
            
            .container {
                padding: 4rem;
                text-align: justify;
                font-size: 0.1px;
                font-family: 'Ubuntu', sans-serif;
            }
            
            .container:after {
                content: '';
                display: inline-block;
                position: relative;
                width: 100%;
            }
            /* Target Elements
---------------------------------------------------------------------- */
            
            .mix {
                border-radius: 10px 10px 10px 10px;
                margin-bottom: 1vh;
                position: relative;
                justify-content: center;
                border: solid gainsboro 2px;
                border-top: 1vh solid dimgray;
                padding-top: 2vh;
                padding-left: 2vw;
                height: 50%;
            }
            
            .mix img {
                position: relative;
                height: 15vh;
                margin: auto;
            }
            
            .mix h4 {
                font-size: 1.3vw;
                font-weight: bold;
                font-family: 'Ubuntu', sans-serif;
            }
            
            .mix p {
                position: relative;
                margin-top: 10vh;
                font-size: 1.8vh;
                font-family: 'Ubuntu', sans-serif;
                background-color: dimgray;
                border-radius: 2px;
                width: 5vw;
                text-align: center;
                cursor: pointer;
                position: absolute;
                bottom: 2vh;
                right: 1.5vw;
            }
            
            .mix a {
                color: white;
                text-decoration: none;
                font-family: 'Ubuntu', sans-serif;
            }
            
            .mix p:hover {
                opacity: 0.7;
                cursor: pointer;
            }
            
            .mix:before {
                content: '';
                display: inline-block;
                padding-top: 20vh;
            }
            /* Grid Breakpoints
---------------------------------------------------------------------- */
            /* 1 Column */
            
            .mix {
                width: 20vw;
            }
            
            .container,
            footer {
                margin-top: 6vh;
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
                width: 7vw;
                border: none;
                background-color: white;
                text-align: center;
                text-overflow: ellipsis;
            }
            
            .round .tekst {
                width: 2.5vw;
                -moz-appearance: textfield;
                border: none;
                background-color: white;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            
            .round {
                border-bottom: solid gainsboro 1px;
                padding-bottom: 1vh;
            }
        </style>
    </head>

    <body>
        <header>
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header"> <a class="navbar-brand" href="kundeindex.php">Farmers Market</a> </div>
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="bestil.php">Bestil</a></li>
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
            <div class=" titel row">
                <h3>Varebestilling</h3></div>
            <div class="row">
                <div class="mix frugt col-md-4 col-xs-12">
                    <div class="col-xs-8"><img src="img/Img22.jpg" alt="frugt"> </div>
                    <div class="col-xs-4">
                        <h4>Frugt</h4> </div>
                    <p><a href="#modalfrugt" rel="modal:open">Køb</a></p>
                </div>
                <div class="mix bær col-md-4 col-xs-12">
                    <div class="col-xs-8"><img src="img/Img20.jpg" alt="bær"> </div>
                    <div class="col-xs-4">
                        <h4>Bær</h4> </div>
                    <p><a href="#modalberry" rel="modal:open">Køb</a></p>
                </div>
                <div class="mix tomater col-md-4 col-xs-12">
                    <div class="col-xs-8"><img src="img/Img10.jpg" alt="tomater"> </div>
                    <div class="col-xs-4">
                        <h4>Tomater</h4> </div>
                    <p><a href="#modaltomater" rel="modal:open">Køb</a></p>
                </div>
            </div>
            <div class="row">
                <div class="mix blomster col-md-4 col-xs-12">
                    <div class="col-xs-8"><img src="img/Img28.jpg" alt="blomster"> </div>
                    <div class="col-xs-4">
                        <h4>Blomster</h4> </div>
                    <p><a href="#modalflower" rel="modal:open">Køb</a></p>
                </div>
                <div class="mix øko col-md-4 col-xs-12">
                    <div class="col-xs-8"><img src="img/Img23.jpg" alt="øko"> </div>
                    <div class="col-xs-4">
                        <h4>Øko produkter</h4> </div>
                    <p><a href="#modaløko" rel="modal:open">Køb</a></p>
                </div>
                <div class="mix special col-md-4 col-xs-12">
                    <div class="col-xs-8"><img src="img/Img25.jpg" alt="special"> </div>
                    <div class="col-xs-4">
                        <h4>Special varer</h4> </div>
                    <p><a href="#modalspecial" rel="modal:open">Køb</a></p>
                </div>
            </div>
            <div class="row">
                <div class="mix tørfrugt col-md-4 col-xs-12">
                    <div class="col-xs-8"><img src="img/Img16.jpg" alt="tørfrugt"> </div>
                    <div class=" col-xs-4">
                        <h4>Tørfrugt</h4> </div>
                    <p><a href="#modaltørvarer" rel="modal:open">Køb</a></p>
                </div>
                <div class="mix svampe col-md-4 col-xs-12">
                    <div class="col-xs-8"><img src="img/Img21.jpg" alt="svampe"> </div>
                    <div class=" col-xs-4">
                        <h4>Svampe</h4> </div>
                    <p><a href="#modalsvampe" rel="modal:open">Køb</a></p>
                </div>
                <div class="mix salat col-md-4 col-xs-12">
                    <div class="col-xs-8"><img src="img/Img19.jpg" alt="salat"> </div>
                    <div class=" col-xs-4">
                        <h4>Salat</h4> </div>
                    <p><a href="#modalsalat" rel="modal:open">Køb</a></p>
                </div>
            </div>
        </div>
        <div id="modalfrugt" class="modal" style="display:none;">
            <div class="container-fluid indhold">
                <div class="modaltop"><img src="img/apple.png">
                    <h3>Frugt</h3></div>
                <div class="udvalg">
                    <div class="frugter">
                        <?php
                $bruger = $_SESSION['username'];
        
                 $query = "SELECT * FROM lager WHERE klasse='frugt'";
         
      //vare fundet fundet
		$result = mysqli_query($db, $query);
                        
if ($result->num_rows == 0){
    echo "<table border = 0>";
    ?>
         <div class="round">
         <p>Desværre ikke noget på lager i øjeblikket...</p>
         </div>
    <?php
    echo "</table>";
}                        
     else if ($result->num_rows > 0) {
    // output data of each row
         
          
          
    while($row = $result->fetch_assoc()) {
        echo "<table border = 0>";
       $ordreid = $row["id"];
        $navnet = $row["navn"];
        $varianten = $row["variant"];
        $enheden = $row["enhed"];
        $prisen = $row["pris"];
        ?>
                            <div class="round">
                                <form action="bestil.php" method="post">
                                    <input type="text" name="variant" readonly value="<?php echo ucfirst($varianten) ?>">
                                    <?php echo " "?>

                                        <input type="text" title="<?php echo $navnet ?>" name="navn" readonly value="<?php echo ucfirst($navnet); ?>">

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
            </div>
        </div>
        <div id="modalberry" class="modal" style="display:none;">
            <div class="container-fluid indhold">
                <div class="modaltop"><img src="img/cherry.png">
                    <h3>Bær</h3></div>
                <div class="udvalg">
                    <?php include('errors.php'); ?>
                        <div class="frugter">
                            <?php
                $bruger = $_SESSION['username'];
        
                 $query = "SELECT * FROM lager WHERE klasse='bær'";
         
      //vare fundet fundet
		$result = mysqli_query($db, $query);

    if ($result->num_rows == 0){
    echo "<table border = 0>";
    ?>
         <div class="round">
         <p>Desværre ikke noget på lager i øjeblikket...</p>
         </div>
    <?php
    echo "</table>";
}                        
     else if ($result->num_rows > 0) {
    // output data of each row
         
          
          
    while($row = $result->fetch_assoc()) {
        echo "<table border = 0>";
       $ordreid = $row["id"];
        $navnet = $row["navn"];
        $varianten = $row["variant"];
        $enheden = $row["enhed"];
        $prisen = $row["pris"];
        ?>
                                <div class="round">
                                    <form action="bestil.php" method="post">
                                        <input type="text" name="variant" readonly value="<?php echo ucfirst($varianten) ?>">
                                        <?php echo " "?>
                                            <input type="text" title="<?php echo $navnet ?>" name="navn" readonly value="<?php echo ucfirst($navnet); ?>">
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
            </div>
        </div>
        <div id="modalflower" class="modal" style="display:none;">
            <div class="container-fluid indhold">
                <div class="modaltop"><img src="img/rose.png">
                    <h3>Blomster</h3></div>
                <div class="udvalg">
                    <?php include('errors.php'); ?>
                        <div class="frugter">
                            <?php
                $bruger = $_SESSION['username'];
        
                 $query = "SELECT * FROM lager WHERE klasse='blomst'";
         
      //vare fundet fundet
		$result = mysqli_query($db, $query);

      if ($result->num_rows == 0){
    echo "<table border = 0>";
    ?>
         <div class="round">
         <p>Desværre ikke noget på lager i øjeblikket...</p>
         </div>
    <?php
    echo "</table>";
}   
                            
                            
    else if ($result->num_rows > 0) {
    // output data of each row
         
          
          
    while($row = $result->fetch_assoc()) {
        echo "<table border = 0>";
       $ordreid = $row["id"];
        $navnet = $row["navn"];
        $varianten = $row["variant"];
        $enheden = $row["enhed"];
        $prisen = $row["pris"];
        ?>
                                <div class="round">
                                    <form action="bestil.php" method="post">
                                        <input type="text" name="variant" readonly value="<?php echo ucfirst($varianten) ?>">
                                        <?php echo " "?>
                                            <input type="text" title="<?php echo $navnet ?>" name="navn" readonly value="<?php echo ucfirst($navnet); ?>">
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
            </div>
        </div>
        <div id="modaltørvarer" class="modal" style="display:none;">
            <div class="container-fluid indhold">
                <div class="modaltop"><img src="img/nut.png">
                    <h3>Tørvarer</h3></div>
                <div class="udvalg">
                    <?php include('errors.php'); ?>
                        <div class="frugter">
                            <?php
                $bruger = $_SESSION['username'];
        
                 $query = "SELECT * FROM lager WHERE klasse='tør'";
         
      //vare fundet fundet
		$result = mysqli_query($db, $query);

     if ($result->num_rows == 0){
    echo "<table border = 0>";
    ?>
         <div class="round">
         <p>Desværre ikke noget på lager i øjeblikket...</p>
         </div>
    <?php
    echo "</table>";
}                        
     else if ($result->num_rows > 0) {
    // output data of each row
         
          
          
    while($row = $result->fetch_assoc()) {
        echo "<table border = 0>";
       $ordreid = $row["id"];
        $navnet = $row["navn"];
        $varianten = $row["variant"];
        $enheden = $row["enhed"];
        $prisen = $row["pris"];
        ?>
                                <div class="round">
                                    <form action="bestil.php" method="post">
                                        <input type="text" name="variant" readonly value="<?php echo ucfirst($varianten) ?>">
                                        <?php echo " "?>
                                            <input type="text" title="<?php echo $navnet ?>" name="navn" readonly value="<?php echo ucfirst($navnet); ?>">
                                            <input type="text" class="tekst" readonly value="<?php echo " i "?>">
                                            <input type="text" name="enhed" readonly value="<?php echo $enheden ?>">
                                            <input type="text" class="tekst" readonly value="<?php echo " til " ?>">
                                            <input type="number" class="tekst" name="pris" readonly value="<?php echo $prisen?>">
                                            <input type="text" class="tekst" readonly value="<?php echo " ,- " ?>">
                                            <input type="number" name="antal" placeholder="antal...">
                                            <input type="submit" class=" btn-success" name="buy_btn" value="Køb"> </form>
                                </div>
                                <?php
        
        echo "</table>";
    }
          
} 
            
        ?>
                        </div>
                </div>
            </div>
        </div>
        <div id="modaltomater" class="modal" style="display:none;">
            <div class="container-fluid indhold">
                <div class="modaltop"><img src="img/tomato.png">
                    <h3>Tomater</h3></div>
                <div class="udvalg">
                    <?php include('errors.php'); ?>
                        <div class="frugter">
                            <?php
                $bruger = $_SESSION['username'];
        
                 $query = "SELECT * FROM lager WHERE klasse='tomat'";
         
      //vare fundet fundet
		$result = mysqli_query($db, $query);

      if ($result->num_rows == 0){
    echo "<table border = 0>";
    ?>
         <div class="round">
         <p>Desværre ikke noget på lager i øjeblikket...</p>
         </div>
    <?php
    echo "</table>";
}                        
     else if ($result->num_rows > 0) {
    // output data of each row
         
          
          
    while($row = $result->fetch_assoc()) {
        echo "<table border = 0>";
       $ordreid = $row["id"];
        $navnet = $row["navn"];
        $varianten = $row["variant"];
        $enheden = $row["enhed"];
        $prisen = $row["pris"];
        ?>
                                <div class="round">
                                    <form action="bestil.php" method="post">
                                        <input type="text" name="variant" readonly value="<?php echo ucfirst($varianten) ?>">
                                        <?php echo " "?>
                                            <input type="text" title="<?php echo $navnet ?>" name="navn" readonly value="<?php echo ucfirst($navnet); ?>">
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
            </div>
        </div>
        <div id="modaløko" class="modal" style="display:none;">
            <div class="container-fluid indhold">
                <div class="modaltop"><img src="img/lime.png">
                    <h3>Øko</h3></div>
                <div class="udvalg">
                    <?php include('errors.php'); ?>
                        <div class="frugter">
                            <?php
                $bruger = $_SESSION['username'];
        
                 $query = "SELECT * FROM lager WHERE klasse='øko'";
         
      //vare fundet fundet
		$result = mysqli_query($db, $query);

      if ($result->num_rows == 0){
    echo "<table border = 0>";
    ?>
         <div class="round">
         <p>Desværre ikke noget på lager i øjeblikket...</p>
         </div>
    <?php
    echo "</table>";
}                        
     else if ($result->num_rows > 0) {
    // output data of each row
         
          
          
    while($row = $result->fetch_assoc()) {
        echo "<table border = 0>";
       $ordreid = $row["id"];
        $navnet = $row["navn"];
        $varianten = $row["variant"];
        $enheden = $row["enhed"];
        $prisen = $row["pris"];
        ?>
                                <div class="round">
                                    <form action="bestil.php" method="post">
                                        <input type="text" name="variant" readonly value="<?php echo ucfirst($varianten) ?>">
                                        <?php echo " "?>
                                            <input type="text" title="<?php echo $navnet ?>" name="navn" readonly value="<?php echo ucfirst($navnet); ?>">
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
            </div>
        </div>
        <div id="modalsvampe" class="modal" style="display:none;">
            <div class="container-fluid indhold">
                <div class="modaltop"><img src="img/mushroom.png">
                    <h3>Svampe</h3></div>
                <div class="udvalg">
                    <?php include('errors.php'); ?>
                        <div class="frugter">
                            <?php
                $bruger = $_SESSION['username'];
        
                 $query = "SELECT * FROM lager WHERE klasse='svamp'";
         
      //vare fundet fundet
		$result = mysqli_query($db, $query);

      if ($result->num_rows == 0){
    echo "<table border = 0>";
    ?>
         <div class="round">
         <p>Desværre ikke noget på lager i øjeblikket...</p>
         </div>
    <?php
    echo "</table>";
}                        
     else if ($result->num_rows > 0) {
    // output data of each row
         
          
          
    while($row = $result->fetch_assoc()) {
        echo "<table border = 0>";
       $ordreid = $row["id"];
        $navnet = $row["navn"];
        $varianten = $row["variant"];
        $enheden = $row["enhed"];
        $prisen = $row["pris"];
        ?>
                                <div class="round">
                                    <form action="bestil.php" method="post">
                                        <input type="text" name="variant" readonly value="<?php echo ucfirst($varianten) ?>">
                                        <?php echo " "?>
                                            <input type="text" title="<?php echo $navnet ?>" name="navn" readonly value="<?php echo ucfirst($navnet); ?>">
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
            </div>
        </div>
        <div id="modalspecial" class="modal" style="display:none;">
            <div class="container-fluid indhold">
                <div class="modaltop"><img src="img/melon.png">
                    <h3>Specialvarer</h3></div>
                <div class="udvalg">
                    <?php include('errors.php'); ?>
                        <div class="frugter">
                            <?php
                $bruger = $_SESSION['username'];
        
                 $query = "SELECT * FROM lager WHERE klasse='special'";
         
      //vare fundet fundet
		$result = mysqli_query($db, $query);

      if ($result->num_rows == 0){
    echo "<table border = 0>";
    ?>
         <div class="round">
         <p>Desværre ikke noget på lager i øjeblikket...</p>
         </div>
    <?php
    echo "</table>";
}                        
     else if ($result->num_rows > 0) {
    // output data of each row
         
          
          
    while($row = $result->fetch_assoc()) {
        echo "<table border = 0>";
       $ordreid = $row["id"];
        $navnet = $row["navn"];
        $varianten = $row["variant"];
        $enheden = $row["enhed"];
        $prisen = $row["pris"];
        ?>
                                <div class="round">
                                    <form action="bestil.php" method="post">
                                        <input type="text" name="variant" readonly value="<?php echo ucfirst($varianten) ?>">
                                        <?php echo " "?>
                                            <input type="text" title="<?php echo $navnet ?>" name="navn" readonly value="<?php echo ucfirst($navnet); ?>">
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
            </div>
        </div>
        <div id="modalsalat" class="modal" style="display:none;">
            <div class="container-fluid indhold">
                <div class="modaltop"><img src="img/salad.png">
                    <h3>Salater</h3></div>
                <div class="udvalg">
                    <?php include('errors.php'); ?>
                        <div class="frugter">
                            <?php
                $bruger = $_SESSION['username'];
        
                 $query = "SELECT * FROM lager WHERE klasse='salat'";
         
      //vare fundet fundet
		$result = mysqli_query($db, $query);

      if ($result->num_rows == 0){
    echo "<table border = 0>";
    ?>
         <div class="round">
         <p>Desværre ikke noget på lager i øjeblikket...</p>
         </div>
    <?php
    echo "</table>";
}                        
     else if ($result->num_rows > 0) {
    // output data of each row
         
          
          
    while($row = $result->fetch_assoc()) {
        echo "<table border = 0>";
       $ordreid = $row["id"];
        $navnet = $row["navn"];
        $varianten = $row["variant"];
        $enheden = $row["enhed"];
        $prisen = $row["pris"];
        ?>
                                <div class="round">
                                    <form action="bestil.php" method="post">
                                        <input type="text" name="variant" readonly value="<?php echo ucfirst($varianten) ?>">
                                        <?php echo " "?>
                                            <input type="text" title="<?php echo $navnet ?>" name="navn" readonly value="<?php echo ucfirst($navnet); ?>">
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
            </div>
        </div>
        <footer></footer>
    </body>

    </html>
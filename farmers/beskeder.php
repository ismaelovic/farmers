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
            input[type=number]::-webkit-inner-spin-button,
            input[type=number]::-webkit-outer-spin-button {
                -webkit-appearance: none;
                margin: 0;
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
                </div>
            </nav>
        </header>
        <br>
        <br>
        <br>
        <br>
        <div class="container">
            <div class="row tjek">
                <form class="kunde_tjek_box col-md-8 col-xs-12" action="beskeder.php" method="post">
                    <label>Skriv din besked her</label>
                    <br>
                    <br>
                    <textarea name="msg" rows="5" cols="50"> </textarea>
                    <br>
                    <br>
                    <input type="submit" class="btn" name="send_mail_btn" value="Send">
                    <br>
                    <br> </form>
                <br>
                <br>
                <br>
                <div class="resultat col-md-4 col-xs-12">
                    <?php
        
        
        if (isset($_POST['send_mail_btn'])) {
         
           $adresse = "ziyani.ismael@live.dk";
               $bruger = $_SESSION['username'];
               $besked = $_POST['msg'];
               $headers = "From: ismaelovich94@hotmail.com" ;
            
            mail($adresse, $bruger, $besked, $headers);
               
    
        }



        
        ?>
                </div>
            </div>
            <br> </div>
        <footer></footer>
    </body>

    </html>
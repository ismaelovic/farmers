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
        <link rel="stylesheet" href="css/flexboxgrid.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
        <link rel="icon" href="img/ifapple.png">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>
            .btn-success {
                margin-top: 4vh;
                margin-bottom: 3vh;
                font-family: 'Ubuntu', sans-serif;
                border-radius: 10px;
            }
            
            input,
            select {
                text-align: left;
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
                        <li class="active"><a href="register.php">Tilføj bruger</a></li>
                        <li><a href="tjeklogin.php">Håndter brugere</a></li>
                        <li><a href="tilbud.php">Katalog</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li> <a class="logud" href="kundeindex.php?logout='1'">Log ud</a> </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="content">
            <div class="con row">
                <h3>Tilføj bruger</h3> </div>
            <form method="post" action="register.php">
                <?php include('errors.php'); ?>
                    <div class="input-group">
                        <label>Brugernavn</label>
                        <input type="text" name="username"> </div>
                    <div class="input-group">
                        <label>Type</label>
                        <select name="user_type" id="user_type">
                            <option value=""></option>
                            <option value="admin">Admin</option>
                            <option value="kunde">Kunde</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label>Sted</label>
                        <input type="text" name="place" placeholder="Admins behøver ikke..."> </div>
                    <div class="input-group">
                        <label>Adgangskode</label>
                        <input type="password" name="password_1"> </div>
                    <div class="input-group">
                        <label>Bekræft adgangskode</label>
                        <input type="password" name="password_2"> </div>
                    <div class="input-group">
                        <button type="submit" class="btn-success" name="reg_user">Opret </button>
                    </div>
            </form>
        </div>
    </body>

    </html>
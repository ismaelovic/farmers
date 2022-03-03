<?php include('server.php') ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Farmers Market </title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="css/flexboxgrid.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
        <link rel="icon" href="img/ifapple.png">
        <style>
            body {
                overflow: hidden;
                background: linear-gradient( rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url(img/strawb.jpg);
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-position: center;
                padding: 0;
                font-family: 'Ubuntu', sans-serif;
            }
            
            .con {
                border: none;
                padding: 0.5vh;
            }
            
            .con h3 {
                margin-left: 3vw;
            }
            
            input {
                text-align: left;
            }
            
            .btn {
                position: absolute;
                right: 3vw;
            }
        </style>
    </head>

    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <ul class="nav navbar-nav navbar-right">
                    <li> <a class=" logud" href="index.html">Tilbage til forside</a> </li>
                </ul>
            </div>
        </nav>
        <div class="content-login">
            <div class="con row">
                <h3>Log ind for at forsætte</h3> </div>
            <form method="post" action="login.php">
                <?php include('errors.php'); ?>
                    <div class="input-group-login">
                        <label>Brugernavn</label>
                        <input type="text" name="username"> </div>
                    <div class="input-group-login">
                        <label>Adgangskode</label>
                        <input type="password" name="password"> </div>
                    <br>
                    <div class="input-group-login">
                        <button type="submit" class="btn btn-success " name="login_user">Log ind</button>
                    </div>
                    <p><cite> Har du ikke en konto? Så kontakt os</cite></p>
            </form>
        </div>
    </body>

    </html>
<!doctype html>
<html lang="da">

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
        /* Style er udelukkende for Mixitup funktion*/

        *,
        *:before,
        *:after {
            box-sizing: border-box;
        }
        /* Controls
---------------------------------------------------------------------- */

        .controls {
            padding: 1rem;
            background-color: grey;
            font-size: 5vh;
            position: relative;
            margin: auto;
            width: 90%;
            display: flex;
            justify-content: center;
        }

        .knap {
            position: relative;
            display: inline-block;
            width: 5vw;
            margin-left: 0.5vw;
            margin-right: 0.5vw;
            cursor: pointer;
            font-size: 1.8vh;
            font-family: 'Ubuntu', sans-serif;
            color: black;
            border: none;
            padding: 0.2vw;
            border-radius: 5px;
        }

        .knap.vin {
            background-color: skyblue;
        }

        .knap.for {
            background-color: orange;
        }

        .knap.som {
            background-color: red;
        }

        .knap.eft {
            background-color: green;
        }

        .knap:hover {
            opacity: 0.6;
        }

        .mixitup-control-active {
            opacity: 0.6;
            background-color: whitesmoke;
        }

        .mixitup-control-active[data-toggle]:after {
            opacity: 0.8;
            background-color: whitesmoke;
        }
        /* Container
---------------------------------------------------------------------- */

        .container {
            padding: 4rem;
            text-align: justify;
            font-size: 0.1px;
        }

        .container:after {
            content: '';
            display: inline-block;
            position: relative;
            width: 100%;
        }
        /* Target Elements
---------------------------------------------------------------------- */

        .mix,
        .gap {
            display: inline-block;
            vertical-align: top;
        }

        .mix {
            background-color: whitesmoke;
            font-family: 'Ubuntu', sans-serif;
            border-radius: 2px;
            margin-bottom: 1vh;
            position: relative;
            justify-content: center;
            border: solid gainsboro 5px;
            padding: 1vw;
        }

        .mix img {
            position: relative;
            width: 12vw;
            height: 18vh;
            margin: auto;
            border-radius: 10px;
        }

        .mix h4 {
            font-size: 1.3vw;
            font-weight: bold;
        }

        .mix a {
            color: white;
            text-decoration: none;
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

        .mix.jan {
            border-top: .5rem solid skyblue;
        }

        .mix.feb {
            border-top: .5rem solid skyblue;
        }

        .mix.mar {
            border-top: .5rem solid orange;
        }

        .mix.apr {
            border-top: .5rem solid orange;
        }

        .mix.maj {
            border-top: .5rem solid orange;
        }

        .mix.jun {
            border-top: .5rem solid red;
        }

        .mix.jul {
            border-top: .5rem solid red;
        }

        .mix.aug {
            border-top: .5rem solid red;
        }

        .mix.sep {
            border-top: .5rem solid green;
        }

        .mix.okt {
            border-top: .5rem solid green;
        }

        .mix.nov {
            border-top: .5rem solid green;
        }

        .mix.dec {
            border-top: .5rem solid skyblue;
        }
        /* Grid Breakpoints
---------------------------------------------------------------------- */
        /* 1 Column */

        .mix,
        .gap {
            width: calc(100%/2 - (((2 - 1) * 1rem) / 2));
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
                    <li class="active"><a href="season.php">Sæson</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li> <a class="logud" href="kundeindex.php?logout='1'">Log ud</a> </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="container-fluid">
        <div class="resultat row" id="olep">
            <div class="controls">
                <button type="button" class="knap" data-filter="all">All</button>
                <button type="button" class="knap vin" data-toggle=".jan">Januar</button>
                <button type="button" class="knap vin" data-toggle=".feb">Februar</button>
                <button type="button" class="knap for" data-toggle=".mar">Marts</button>
                <button type="button" class="knap for" data-toggle=".apr">April</button>
                <button type="button" class="knap for" data-toggle=".maj">Maj</button>
                <button type="button" class="knap som" data-toggle=".jun">Juni</button>
                <button type="button" class="knap som" data-toggle=".jul">Juli</button>
                <button type="button" class="knap som" data-toggle=".aug">August</button>
                <button type="button" class="knap eft" data-toggle=".sep">September</button>
                <button type="button" class="knap eft" data-toggle=".okt">Oktober</button>
                <button type="button" class="knap eft" data-toggle=".nov">November</button>
                <button type="button" class="knap vin" data-toggle=".dec">December</button>
            </div>
            <div class="container">
                <div class="mix jan">
                    <div class="col-xs-8"><img src="img/orange.jpg"> </div>
                    <div class="col-xs-4">
                        <h4>Appelsiner</h4> </div>
                </div>
                <div class="mix jan">
                    <div class="col-xs-8"><img src="img/borange.jpg"> </div>
                    <div class="col-xs-4">
                        <h4>Blod Appelsiner</h4> </div>
                </div>
                <div class="mix jan feb">
                    <div class="col-xs-8"><img src="img/cabbage.jpg"> </div>
                    <div class="col-xs-4">
                        <h4>Hvidkål</h4> </div>
                </div>
                <div class="mix mar">
                    <div class="col-xs-8"><img src="img/potatoes.jpg"> </div>
                    <div class="col-xs-4">
                        <h4>Kartofler</h4> </div>
                </div>
                <div class="mix mar">
                    <div class="col-xs-8"><img src="img/Img10.jpg"> </div>
                    <div class="col-xs-4">
                        <h4>Tomater</h4> </div>
                </div>
                <div class="mix apr">
                    <div class="col-xs-8"><img src="img/asparagus.jpg"> </div>
                    <div class="col-xs-4">
                        <h4>Asparges</h4> </div>
                </div>
                <div class="mix apr">
                    <div class="col-xs-8"><img src="img/radish.jpg"> </div>
                    <div class="col-xs-4">
                        <h4>Radiser</h4> </div>
                </div>
                <div class="mix apr">
                    <div class="col-xs-8"><img src="img/salad.jpg"> </div>
                    <div class="col-xs-4">
                        <h4>Frillice</h4> </div>
                </div>
                <div class="mix jun">
                    <div class="col-xs-8"><img src="img/raspberry.jpg"> </div>
                    <div class="col-xs-4">
                        <h4>Hindbær</h4> </div>
                </div>
                <div class="mix jun">
                    <div class="col-xs-8"><img src="img/blueberries.jpg"> </div>
                    <div class="col-xs-4">
                        <h4>Blåbær</h4> </div>
                </div>
                <div class="mix jul">
                    <div class="col-xs-8"><img src="img/cucumber.jpg"> </div>
                    <div class="col-xs-4">
                        <h4>Drueagurker</h4> </div>
                </div>
                <div class="mix jul">
                    <div class="col-xs-8"><img src="img/strawberries.jpg"> </div>
                    <div class="col-xs-4">
                        <h4>Jordbær</h4> </div>
                </div>
                <div class="mix aug">
                    <div class="col-xs-8"><img src="img/savoy.jpg"> </div>
                    <div class="col-xs-4">
                        <h4>Savoy Kål</h4> </div>
                </div>
                <div class="mix sep">
                    <div class="col-xs-8"><img src="img/kantareller.jpg"> </div>
                    <div class="col-xs-4">
                        <h4>Kantareller</h4> </div>
                </div>
                <div class="mix okt">
                    <div class="col-xs-8"><img src="img/pear.jpg"> </div>
                    <div class="col-xs-4">
                        <h4>Pærer</h4> </div>
                </div>
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
    <script src="index.js"></script>
    <script src="css/mixitup.min.js"></script>
    <script>
        var containerEl = document.querySelector('.container');
        var mixer = mixitup(containerEl);
    </script>
</body>

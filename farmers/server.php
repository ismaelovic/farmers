<?php
session_start();

// variabler fra forms
$username = "";
$user_type = "";

$errors = array(); 
$_SESSION['success'] = "";

// Database opsættelse
$db = mysqli_connect('mysql14.unoeuro.com', 'izkea_dk', 'jemobid94', 'izkea_dk_db');

// Ved Log ind 
if (isset($_POST['login_user'])) {
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$password = mysqli_real_escape_string($db, $_POST['password']);
    
    // tjek om felterne er udfyldt
	if (empty($username)) {
		array_push($errors, "Brugernavn mangler");
	}
	if (empty($password)) {
		array_push($errors, "Adgangskode mangler");
	}
    
	if (count($errors) == 0) {
		
        //Validere om inputs findes i tabellen
		$query = "SELECT * FROM login WHERE brugernavn='$username' AND adgangskode='$password'";
        //bruger fundet
		$results = mysqli_query($db, $query);
       
        //tjek om bruger er admin eller kunde
		if (mysqli_num_rows($results) == 1) {
            
            $logged_in_user = mysqli_fetch_assoc($results);
            
            if ($logged_in_user['brugertype'] == 'admin') {
                
                $_SESSION['username'] = $logged_in_user['brugernavn'];
				$_SESSION['user_type'] = $logged_in_user['brugertype'];
    
                //admin siden
                header('location: adminindex.php');		  
			}
            //bruger = kunde henvis til kundeside
            else{
                 
                $_SESSION['username'] = $logged_in_user['brugernavn'];
				$_SESSION['user_type'] = $logged_in_user['brugertype'];
                $_SESSION['user_place'] = $logged_in_user['sted'];
                
				
                
                //kunde siden
				header('location: kundeindex.php');
			}
            
            
			
           
        }
            
		else {    
			array_push($errors, "Forkert brugernavn eller kode!");
		}
	}
}

// Ny bruger
if (isset($_POST['reg_user'])) {
	// Input fra forms
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$user_type = mysqli_real_escape_string($db, $_POST['user_type']);
    $user_place = mysqli_real_escape_string($db, $_POST['place']);
	$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
	$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

	// Validering af input i felterne
	if (empty($username)) { array_push($errors, "Brugernavn mangler"); }
	if (empty($password_1)) { array_push($errors, "Adgangskode mangler"); }
    if (empty($user_type)) { array_push($errors, "Brugertype mangler"); }
	
    //koderne skal være ens
    if ($password_1 != $password_2) {
		array_push($errors, "De indtastede koder er ikke ens");
	}
    

	// registrer bruger hvis der er ingen fejl 
	if (count($errors) == 0) {
		$password = ($password_1);
        
        //tilføj til tabellen hvis der 0 fejl
		$query = "INSERT INTO login (brugernavn, adgangskode, brugertype, sted) 
				  VALUES('$username', '$password', '$user_type', '$user_place')";
		mysqli_query($db, $query);
         

		echo "<script type='text/javascript'>alert('$username er nu oprettet som $user_type i systemet')</script>";         
	
    }
}
//tilføj varer til lager
if (isset($_POST['add_btn'])) {
    // Input fra forms
    $class = mysqli_real_escape_string($db, $_POST['klasse']);
	$name = mysqli_real_escape_string($db, $_POST['navn']);
	$type = mysqli_real_escape_string($db, $_POST['variant']);
	$unit = mysqli_real_escape_string($db, $_POST['enhed']);
	$quantity = mysqli_real_escape_string($db, $_POST['antal']);
    $price = mysqli_real_escape_string($db, $_POST['prisen']);
    
    	// Validering af input i felterne
if (empty($name)) {  array_push($errors, "Navn mangler");}
    if (empty($class)) { array_push($errors, "Klasse mangler"); }
	if (empty($type)) { array_push($errors, "Variant mangler"); }
    if (empty($unit)) {  array_push($errors, "Enhed mangler");}
    if (empty($quantity)) {  array_push($errors, "Antal mangler"); }
    if (empty($price)) {  array_push($errors, "Pris mangler"); }
    
    $bruger = $_SESSION['username'];
    
    // Tilføj til lager hvis der er ingen fejl
	if (count($errors) == 0) {
		
		$query = "INSERT INTO lager (bruger, klasse, navn, variant, enhed, antal, pris) 
				  VALUES('$bruger', '$class','$name', '$type', '$unit', '$quantity', '$price')
                  ON DUPLICATE KEY UPDATE
                  antal = antal + VALUES(antal),
                  pris = VALUES(pris)";
                  
		mysqli_query($db, $query);
     
        //respons
      echo "<script type='text/javascript'>alert('$quantity $unit $name er nu tilføjet til lageret')</script>";
       //header('location: tilvarer.php'); 

} 
    //fejl 
    else{
        echo "<script type='text/javascript'>alert('Varen blev ikke tilføjet')</script>";
        echo '<script>console.log("Varen blev IKKE tilføjet")</script>';
    }
      
}

//køb fra lager
if (isset($_POST['buy_btn'])) {
    // Input fra forms
    $kundenavn = mysqli_real_escape_string($db, $_POST['kundenavn']);
	$name = mysqli_real_escape_string($db, $_POST['navn']);
	$type = mysqli_real_escape_string($db, $_POST['variant']);
	$unit = mysqli_real_escape_string($db, $_POST['enhed']);
	$quantity = mysqli_real_escape_string($db, $_POST['antal']);
    
    	// Validering af input i felterne
	if (empty($name)) {  echo "<script type='text/javascript'>alert('Du har ikke valgt en vare')</script>";}
	if (empty($type)) {echo "<script type='text/javascript'>alert('Du har ikke valgt variant')</script>"; }
    if (empty($unit)) { echo "<script type='text/javascript'>alert('Du har ikke valgt hvilken enhed')</script>"; }
    if (empty($quantity)) { echo "<script type='text/javascript'>alert('Du har ikke valgt antal')</script>"; }
    
    //hvis kundenavn ikke findes er kundenavn = den bruger der er logget ind 
    if (!$kundenavn){
        $bruger = $_SESSION['username'];
    } 
    // hvis admin bestiller på vegne af kunden
    else {
        $bruger = $kundenavn;
    }
    
    // Tilføj til bestillinger hvis der er ingen fejl
	if (count($errors) == 0) {
		//tjek om bestilling findes i lageret
        $query = "SELECT * FROM lager WHERE navn='$name' and variant='$type' and enhed='$unit'";
    
       $result = mysqli_query($db, $query); 
        
    //produkt funder
      if ($result->num_rows > 0) {
        
       while($row = $result->fetch_assoc()) {
        
        $price = $row['pris'];
           //samlede pris for det købte produkt
        $prisialt = $quantity * $price;
           $status="ny";
//tilføj til bestillinger, med et timestamp. findes varen i forvejen opdateres antal og samlede pris
           $query = "INSERT INTO bestillinger (bruger, navn, variant, enhed, antal, pris, tid)
                  VALUES('$bruger', '$name', '$type', '$unit', '$quantity', '$prisialt' , NOW()) 
                  ON DUPLICATE KEY UPDATE
                  antal = antal + VALUES(antal),
                  pris = pris + VALUES(pris)";   
//træk antallet det købte produkt fra lageret            
          $queryy = "UPDATE lager SET antal = antal - '$quantity' WHERE navn='$name' and variant='$type' and enhed='$unit'";
       }
               
		  mysqli_query($db, $query);
          mysqli_query($db, $queryy);
          echo "<script type='text/javascript'>alert('$quantity $name er nu købt. Tjek bestillinger for at se alle dine køb')</script>";

//        header('location: bestil.php');

      } 
          //bestilling findes ikke i lageret og derfor afvist
        else{
         echo "<script type='text/javascript'>alert('Det valgte produkt kan i øjeblikket ikke fås. kontakt os for mere info')</script>";
            //  '<script>console.log("Varen blev IKKE tilføjet")</script>'; 
         
      }
      
} else{
        echo '<script>console.log("Fejl i dine indtast")</script>';
       
    }
}

 if (isset($_POST['slet_btn'])) {
        $vareid = $_POST['vareid'];
     
          $query = "DELETE FROM bestillinger WHERE id='$vareid'";
        
     
		$result = mysqli_query($db, $query);
      echo "<script type='text/javascript'>alert('bestillingen er nu slettet nr.($vareid)')</script>";
 }

//slet bruger fra system
if (isset($_POST['slet_login_btn'])) {
        
        $username = $_POST['username'];
    
    if($username == $_SESSION['username'] || $username == 'helle'){
        echo "<script type='text/javascript'>alert('Ugyldig handling!')</script>";
    }
    else{
     
          $query = "DELETE FROM login WHERE brugernavn='$username'";
        
     
		$result = mysqli_query($db, $query);
    echo "<script type='text/javascript'>alert(' $username er nu slette fra systemet')</script>";
 }
}

//tilføj tilbud til kataloget
  if (isset($_POST['tilbud_btn'])) {
        
    
      
             $name = $_POST['navn'];
             $type = $_POST['variant'];
             $unit = $_POST['enhed'];
             $price = $_POST['prisen'];
             $text = $_POST['tekst'];
            
            
            $query = "SELECT * FROM lager WHERE navn='$name' and variant='$type' and enhed='$unit'";
       
      //vare fundet fundet
		$result = mysqli_query($db, $query);

      if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
       
       //$vareid = $row["id"];
        
          $query = "INSERT INTO tilbud (navn, variant, enhed, pris, tekst)
                  VALUES('$name', '$type', '$unit', '$price',  '$text')"; 
          
          $queryy = "UPDATE lager SET pris = '$price' WHERE navn='$name' and variant='$type' and enhed='$unit'";
     
    }
           mysqli_query($db, $query);
                     mysqli_query($db, $queryy);
         
          echo "<script type='text/javascript'>alert('$name er nu tilføjet til kataloget!.')</script>";
         
} else{
           echo "<script type='text/javascript'>alert('Varen findes ikke i lageret')</script>";
      }
        }


if (isset($_POST['slet_tilbud_btn'])) {
        $productid = $_POST['productid'];
     
      
     
          $query = "DELETE FROM tilbud WHERE id='$productid'";
        
     
		$result = mysqli_query($db, $query);
	
    echo "<script type='text/javascript'>alert('Tilbuddet er nu slettet fra kataloget')</script>";
 }



?>
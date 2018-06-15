<?php
include_once("includes/db_connect.php");
include_once 'includes/functions.php';
sec_session_start();
?>

<html>
<head>
    <title>Add Data</title>
</head>
 
<body>
<?php if (login_check($mysqli) == true) : ?>
<?php
 
	$fout = 0;
 
if(isset($_POST['Submit'])) {    
    $titel = $_POST['titel'];
    $ln = $_POST['leeftijdscategorienummer'];
	$link = $_POST['imdblink'];
	$image = $_FILES['image']['name'];
	$genren = $_POST['genrenaam'];
	$geweld = $_POST['geweld'];
	$angst = $_POST['angst'];
	$seks = $_POST['seks'];
	$grof = $_POST['grof'];
	$dralc = $_POST['dralc'];
	$discr = $_POST['discr'];
	
	if($ln == 1) {
		if($angst == 1  || $geweld == 1 || $seks == 1 || $grof == 1  || $dralc == 1  || $discr == 1) {
			$fout = 1;
		};
	};
	
	if($ln == 2) {
		if( $seks == 1 || $grof == 1  || $dralc == 1  || $discr == 1) {
			$fout = 1;
		};
	};
	
	if($ln == 3) {
		if( $seks == 1 || $grof == 1  || $dralc == 1  || $discr == 1) {
			$fout = 1;
		};
	};
	
	if($ln == 4) {
		if( $seks == 1   || $dralc == 1 ) {
			$fout = 1;
		};
	};
        
    // checking empty fields
    if(empty($titel) || empty($ln) || empty($link) || empty($genren)) {                
        if(empty($titel)) {
            echo "<font color='red'>Titel field is empty.</font><br/>";
        }
        
        if(empty($ln)) {
            echo "<font color='red'>Leeftijdscategorienummer field is empty.</font><br/>";
        }
		if(empty($genren)) {
            echo "<font color='red'>Genre field is empty.</font><br/>";
        }
        if(empty($link)) {
            echo "<font color='red'>imdblink field is empty.</font><br/>";
        }
		
        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    }elseif($fout == 1){
		echo "<font color='red'>De minimumleeftijd komt niet overeen met de waarschuwingen van de film.</font><br/>";
	}else { 
        
		$controlle=mysqli_query($mysqli,"select * from film where titel='$titel'");
    	$controllerows=mysqli_num_rows($controlle);
		
		if($controllerows>0) {
      		echo "film exists";
   		} else {
			$image = $_FILES['image']['name'];
		  	// image file directory
		  	$target = "image/".basename($image);
	
		  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
		  		$msg = "Image uploaded successfully";
		  	}else{
		  		$msg = "Failed to upload image";
		  	}

          	$a = mysqli_query($mysqli, "INSERT INTO film(titel,leeftijdscategorienummer,imdblink,image) VALUES('$titel','$ln','$link','$image')");

  	
			//display success message
	        echo "<font color='green'>Data added successfully.";
			echo "<br/><a href='gegevens.php'>View Result</a>";
			//printf ("New Record has id %d.\n", $mysqli->insert_id);
			$idnummer = $mysqli->insert_id;
			echo $idnummer;
   		}
   	}		
}
?>
<?php else : ?>
     <p>
         <span class="error">You are not authorized to access this page.</span> Please <a href="index.php">login</a>.
     </p>
<?php endif; ?>
</body>
</html>
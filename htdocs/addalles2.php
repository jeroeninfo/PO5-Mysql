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
	//$lc = $_POST['leeftijdscategorie'];
	$link = $_POST['imdblink'];
	$aa = $_POST['acteurachternaam'];
	$av = $_POST['acteurvoornaam'];
	$ra = $_POST['regisseurachternaam'];
	$rv = $_POST['regisseurvoornaam'];
	$genren = $_POST['genrenaam'];
	$geweld = $_POST['geweld'];
	$angst = $_POST['angst'];
	$seks = $_POST['seks'];
	$grof = $_POST['grof'];
	$dralc = $_POST['dralc'];
	$discr = $_POST['discr'];
	$image = $_FILES['image']['name'];
   
	//if(empty($image)) {
//		echo "<font color='red'>geen foto gevonden.</font><br/>";
	//	$image = $_FILES['image']['notfound.jpg'];
	//};	 
	
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
    if(empty($titel) || empty($ln)/* || empty($lc)*/ || empty($link) || empty($aa) || empty($av) || empty($ra) || empty($rv) || empty($genren)) {                
        if(empty($titel)) {
            echo "<font color='red'>Titel field is empty.</font><br/>";
        }
        if(empty($ln)) {
            echo "<font color='red'>Leeftijdscategorienummer field is empty.</font><br/>";
        }
		/*if(empty($lc)) {
			echo "<font color='red'>Leeftijdscategorie field is empty.</font><br/>";
		}*/
		if(empty($link)) {
            echo "<font color='red'>imdblink field is empty.</font><br/>";
        }
		if(empty($aa)) {
            echo "<font color='red'>Achternaam Acteur field is empty.</font><br/>";
        }
		if(empty($av)) {
            echo "<font color='red'>Voornaam Acteur field is empty.</font><br/>";
        }
		if(empty($ra)) {
            echo "<font color='red'>Achternaam regisseur field is empty.</font><br/>";
        }
		if(empty($rv)) {
            echo "<font color='red'>Voornaam regisseur field is empty.</font><br/>";
        }
		if(empty($genren)) {
            echo "<font color='red'>Genre field is empty.</font><br/>";
        }
		
		
		/*if(empty($waarschuwing)) {
            echo "<font color='red'>Waarschuwing field is empty.</font><br/>";
        }*/
		
		
	
        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
		
	}elseif($fout == 1){
		echo "<font color='red'>De minimumleeftijd komt niet overeen met de waarschuwingen van de film.</font><br/>";
	}else {
		
		$controlle1=mysqli_query($mysqli,"select * from film where titel='$titel'");
    	$controllerows1=mysqli_num_rows($controlle1);
		
		
		if($controllerows1>0) {
      		echo "film exists";
   		}else{
   			$image = $_FILES['image']['name'];
			  	// image file directory
			  	$target = "image/".basename($image);
		
			  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
			  		$msg = "Image uploaded successfully";
			  	}else{
			  		$msg = "Failed to upload image";
			  	}
        	$a = mysqli_query($mysqli, "INSERT IGNORE INTO film(titel,leeftijdscategorienummer,imdblink,image) VALUES('$titel','$ln','$link','$image')");
			$idfilm = $mysqli->insert_id;
			echo "filmid" .$idfilm;
			
				$controlle2=mysqli_query($mysqli,"select * from acteur where acteurachternaam='$aa' and acteurvoornaam='$av'");
		    	$controllerows2=mysqli_num_rows($controlle2);
				
				if($controllerows2>0) {
		      		echo "acteur exists";
					$result2 = mysqli_query($mysqli,"SELECT acteurnummer FROM acteur WHERE acteurachternaam='$aa' AND acteurvoornaam='$av'");
			   		$row = mysqli_fetch_assoc($result2);
			   		$row2 = implode(" ",$row);	
			   		
			   		$bb = mysqli_query($mysqli,"INSERT INTO filmacteur(filmnummer,acteurnummer) VALUES('$idfilm','$row2')");
			   		echo "id".$row4."<br>acteurnummer".$row2;
			        echo "<font color='green'>Data added successfully.";		  		
		   		} else {
		        	$b = mysqli_query($mysqli, "INSERT INTO acteur(acteurvoornaam,acteurachternaam) VALUES('$av','$aa')");
					$idacteur = $mysqli->insert_id;
					$bb = mysqli_query($mysqli,"INSERT INTO filmacteur(filmnummer, acteurnummer) VALUES('$idfilm','$idacteur')");
					echo "acteur " .$idacteur;
		   		}		
		   		
				$controlle3=mysqli_query($mysqli,"select * from regisseur where regisseurachternaam='$ra' and regisseurvoornaam='$rv'");
		    	$controllerows3=mysqli_num_rows($controlle3);
				
				if($controllerows3>0) {
		      		echo "regisseur exists";
					$result3 = mysqli_query($mysqli,"SELECT regisseurnummer FROM regisseur WHERE regisseurachternaam='$ra' AND regisseurvoornaam='$rv'");
			   		$row3 = mysqli_fetch_assoc($result3);
			   		$row4 = implode(" ",$row3);	
			   		
			   		$bb = mysqli_query($mysqli,"INSERT INTO filmregisseur(filmnummer,regisseurnummer) VALUES('$idfilm','$row4')");
			   		echo "id".$idfilm."<br>regisseurnummer".$row4;
			        echo "<font color='green'>Data added successfully.";	
		   		} else {
		        	$c = mysqli_query($mysqli, "INSERT INTO regisseur(regisseurvoornaam,regisseurachternaam) VALUES('$rv','$ra')");	
					$idregisseur = $mysqli->insert_id;
					$cc = mysqli_query($mysqli,"INSERT INTO filmregisseur(filmnummer, regisseurnummer) VALUES('$idfilm','$idregisseur')");
					echo "regisseur " .$idregisseur;
		   		}
		   			
				$controlle4=mysqli_query($mysqli,"select * from genre where genrenaam='$genren'");
		    	$controllerows4=mysqli_num_rows($controlle4);
				
				if($controllerows4>0) {
		      		echo "genre exists";
			  		$result4 = mysqli_query($mysqli,"SELECT genrenummer FROM genre WHERE genrenaam='$genren'");
		   			$row5 = mysqli_fetch_assoc($result4);
		   			$row6 = implode(" ",$row5);
		   			
		 			$e = mysqli_query($mysqli, "INSERT INTO filmgenre(filmnummer,genrenummer) VALUES('$idfilm','$row6')");
		 			echo $idfilm."<br>".$row6;
		 			echo "<font color='green'>Data added successfully in filmgenre.";
		   		} else {
					$d = mysqli_query($mysqli, "INSERT INTO genre(genrenaam) VALUES('$genren')");
					$idgenre = $mysqli->insert_id;
					$dd = mysqli_query($mysqli,"INSERT INTO filmgenre(filmnummer, genrenummer) VALUES('$idfilm','$idgenre')");
					echo "genre " .$idgenre;
		   		}
		   		
		   		//display success message
        		echo "<font color='green'>Data added successfully.";
				
   		}
        echo "<br/><a href='gegevens.php'>View Result</a>";
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
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
 
if(isset($_POST['Submit'])) {    
    $rv = $_POST['regisseurvoornaam'];
    $ra = $_POST['regisseurachternaam'];
	$film = $_POST['film'];
	
        
    // checking empty fields
    if(empty($rv) || empty($ra)) {                
        if(empty($rv)) {
            echo "<font color='red'>Voornaam Regisseur field is empty.</font><br/>";
        }
        
        if(empty($ra)) {
            echo "<font color='red'>Achternaam Regisseur field is empty.</font><br/>";
        }
        if(empty($film)) {
            echo "<font color='red'>Film Regisseur field is empty.</font><br/>";
        }

		
        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else { 
		$result1 = mysqli_query($mysqli,"SELECT regisseurnummer FROM regisseur WHERE regisseurachternaam='$ra' AND regisseurvoornaam='$rv'");
   		$row = mysqli_fetch_assoc($result1);
   		$row2 = implode(" ",$row);	        
		$controlle=mysqli_query($mysqli,"select * from regisseur where regisseurachternaam='$ra' and regisseurvoornaam='$rv'");
    	$controllerows=mysqli_num_rows($controlle);
		
		$result2 = mysqli_query($mysqli,"SELECT id FROM film WHERE titel='$film'");
   		$row3 = mysqli_fetch_assoc($result2);
   		$row4 = implode(" ",$row3);
   		$controlle2=mysqli_query($mysqli,"SELECT * FROM filmregisseur WHERE filmnummer='$row4' AND regisseurnummer='$row2'");
		$controllerows2=mysqli_num_rows($controlle2);

		if($controllerows>0 & $controllerows2<1){
			$result2 = mysqli_query($mysqli,"SELECT id FROM film WHERE titel='$film'");
   			$row3 = mysqli_fetch_assoc($result2);
   			$row4 = implode(" ",$row3);
   			
			$result1 = mysqli_query($mysqli,"SELECT regisseurnummer FROM regisseur WHERE regisseurachternaam='$ra' AND regisseurvoornaam='$rv'");
	   		$row = mysqli_fetch_assoc($result1);
	   		$row2 = implode(" ",$row);	
	   		
	   		$bb = mysqli_query($mysqli,"INSERT INTO filmregisseur(filmnummer,regisseurnummer) VALUES('$row4','$row2')");
	   		echo "id".$row4."<br>regisseurnummer".$row2;
	        echo "<font color='green'>Data added successfully.";			
    	}else if($controllerows>0 & $controllerows2>0){
      		echo "regisseur exists";
	  		echo "<br>controllerows ".$controllerows;
			echo "<br>controllerows2 ".$controllerows2;
   		} else {
   			$result2 = mysqli_query($mysqli,"SELECT id FROM film WHERE titel='$film'");
   			$row3 = mysqli_fetch_assoc($result2);
			$row4 = implode(" ",$row3);   			
   			
        	$c = mysqli_query($mysqli, "INSERT INTO regisseur(regisseurvoornaam,regisseurachternaam) VALUES('$rv','$ra')");	
			$idregisseur = $mysqli->insert_id;
			
			echo $idregisseur.' | '.$rv.' '.$ra.'<br>';
			echo $row4." | ".$film.'<br>';
			$c = mysqli_query($mysqli, "INSERT INTO filmregisseur(filmnummer,regisseurnummer) VALUES('$row4','$idregisseur')");
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

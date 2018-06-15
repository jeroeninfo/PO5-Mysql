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
    $genren = $_POST['genrenaam'];
	$film = $_POST['film'];
	
        
    // checking empty fields
    if(empty($genren) || empty($film)) {                
        if(empty($genren)) {
            echo "<font color='red'>Genre field is empty.</font><br/>";
        }
        if(empty($film)) {
            echo "<font color='red'>Film field is empty.</font><br/>";
        }

	
        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else { 
        
		$result2 = mysqli_query($mysqli,"SELECT genrenummer FROM genre WHERE genrenaam='$genren'");
   		$row3 = mysqli_fetch_assoc($result2);
   		$row4 = implode(" ",$row3);
   		$controlle = mysqli_query($mysqli,"SELECT * FROM genre WHERE genrenaam='$genren'");		
    	$controllerows=mysqli_num_rows($controlle);
		
		$result1 = mysqli_query($mysqli,"SELECT id FROM film WHERE titel='$film'");
   		$row = mysqli_fetch_assoc($result1);
   		$row2 = implode(" ",$row);
		//$controlle2=mysqli_query($mysqli,"select * from filmgenre where filmnummer='$row2'");
    	//$controllerows2=mysqli_num_rows($controlle2);
		
		$controlle3=mysqli_query($mysqli,"SELECT * FROM filmgenre WHERE filmnummer='$row2' AND genrenummer='$row4'");
		$controllerows3=mysqli_num_rows($controlle3);
		
		if($controllerows>0 & $controllerows3<1) {
   			$result1 = mysqli_query($mysqli,"SELECT id FROM film WHERE titel='$film'");
   			$row = mysqli_fetch_assoc($result1);
   			$row2 = implode(" ",$row);
   				  		  
	  		$result2 = mysqli_query($mysqli,"SELECT genrenummer FROM genre WHERE genrenaam='$genren'");
   			$row3 = mysqli_fetch_assoc($result2);
   			$row4 = implode(" ",$row3);
   			
 			$e = mysqli_query($mysqli, "INSERT INTO filmgenre(filmnummer,genrenummer) VALUES('$row2','$row4')");
 			echo $row2."<br>".$row4;
 			echo "<font color='green'>Data added successfully in filmgenre.";				
		} else if ($controllerows>0 & $controllerows3>0){
			echo "file exist";
			//echo "controllerows ".$controllerows;
			//echo "controllerows3 ".$controllerows3;	
   		} else {			
			$d = mysqli_query($mysqli, "INSERT INTO genre(genrenaam) VALUES('$genren')");
			$genre = $mysqli->insert_id;
			$result1 = mysqli_query($mysqli,"SELECT id FROM film WHERE titel='$film'");
   			$row = mysqli_fetch_assoc($result1);
   			$row2 = implode(" ",$row);
			
			echo $genre.' | '.$genren.'<br>';
			echo $row2." | ".$film.'<br>';
			$c = mysqli_query($mysqli, "INSERT INTO filmgenre(filmnummer,genrenummer) VALUES('$row2','$genre')");
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
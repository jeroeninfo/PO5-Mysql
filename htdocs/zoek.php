<?php
include_once("includes/db_connect.php");
include_once 'includes/functions.php';
sec_session_start();

$username = $_SESSION['username'];
$result5 = mysqli_query($mysqli, "SELECT premission_number FROM members WHERE username='$username'");
$row3 = mysqli_fetch_assoc($result5);
$row10 = implode(" ",$row3);
?>

<html>
<head>
    <title>Add Data</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
 
<body>
<?php if (login_check($mysqli) == true) : ?>
	<?php include "includes/menu.php" ?>
	<h2>Zoekmachine</h2>
	    <form id="gegevens" action="zoek.php" method="post">
			<input type="text" name="zoek" value="<?php echo  $_POST['zoek']; ?>"></td>
			<input type="submit" name="Submit" value="zoek"></td>
    </form>
	</ hr>
<?php
 
if(isset($_POST['Submit'])) {    
    $zoek = $_POST['zoek'];
        
    // checking empty fields
    if(empty($zoek)) {                
        if(empty($zoek)) {
            echo "<font color='red'>Search field is empty.</font><br/>";
        }
        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else { 
		
		$result1 = mysqli_query($mysqli,"SELECT id FROM film WHERE titel LIKE '%".$zoek."%'");
   		$controllerow = mysqli_num_rows($result1);
   		$result2 = mysqli_query($mysqli,"SELECT acteurnummer FROM acteur WHERE acteurvoornaam LIKE '%".$zoek."%'");
   		$controllerow2 = mysqli_num_rows($result2);
   		$result3 = mysqli_query($mysqli,"SELECT acteurnummer FROM acteur WHERE acteurachternaam LIKE '%".$zoek."%'");
   		$controllerow3 = mysqli_num_rows($result3);
   		$result4 = mysqli_query($mysqli,"SELECT regisseurnummer FROM regisseur WHERE regisseurvoornaam LIKE '%".$zoek."%'");
   		$controllerow4 = mysqli_num_rows($result4);
   		$result5 = mysqli_query($mysqli,"SELECT regisseurnummer FROM regisseur WHERE regisseurachternaam LIKE '%".$zoek."%'");
   		$controllerow5 = mysqli_num_rows($result5);
   		$result6 = mysqli_query($mysqli,"SELECT genrenummer FROM genre WHERE genrenaam LIKE '%".$zoek."%'");
   		$controllerow6 = mysqli_num_rows($result6);   		

   
   		if($controllerow>0 || $controllerow2>0 || $controllerow3>0 || $controllerow4>0 || $controllerow5>0 || $controllerow6>0){
	   		/*echo "controllerow ".$controllerow."<br>";
	   		echo "controllerow2 ".$controllerow2."<br>";
	   		echo "controllerow3 ".$controllerow3."<br>";
	   		echo "controllerow4 ".$controllerow4."<br>";
	   		echo "controllerow5 ".$controllerow5."<br>";
	   		echo "controllerow6 ".$controllerow6."<br>";*/
	   		echo "<table>";
				echo "<tr bgcolor='#CCCCCC'>";
				echo "<td>Cover</td>";
		        echo "<td>Titel</td>";
		        echo "<td>leeftijdscategorie</td>";
		        echo "<td>imdblink</td>";
		        echo "<td>acteurvoornaam</td>";
				echo "<td>acteurachternaam</td>";
				//echo "<td>acteurnummer</td>";
				echo "<td>regisseurvoornaam</td>";
				echo "<td>regisseurachternaam</td>";
				echo "<td>Genre</td>";
		        echo "</tr>";
				if($controllerow>0){
					//film
					$zoek = $_POST['zoek'];
					$result1 = mysqli_query($mysqli,"SELECT DISTINCT f.*, fr.*, fa.*, fg.*, r.*, a.*, g.*, lc.* FROM film f, filmregisseur fr, filmacteur fa, filmgenre fg, regisseur r, acteur a, genre g, leeftijdscategorie lc WHERE titel LIKE '%".$zoek."%' AND a.acteurnummer = fa.acteurnummer AND fa.filmnummer = f.id AND f.id = fr.filmnummer AND fr.regisseurnummer = r.regisseurnummer AND f.id = fg.filmnummer AND fg.genrenummer = g.genrenummer AND lc.leeftijdscategorienummer = f.leeftijdscategorienummer");	
						while($res1 = mysqli_fetch_array($result1)) {         
							echo "<tr>";
							echo "<td><img id='cover' src='Image/".$res1['image']."' ></td>";
				            echo "<td><b>".$res1['titel']."</b></td>";
				            echo "<td>".$res1['leeftijdscategorie']."</td>";
							//echo "<td><img src=".$res1['afbeelding']." alt=".$res1['leeftijdscategorie']."></td>";
				            echo "<td><a href=".$res1['imdblink'].">imdb</a></td>";
							echo "<td>".$res1['acteurvoornaam']."</td>";
							echo "<td>".$res1['acteurachternaam']."</td>";
							//echo "<td>".$res1['acteurnummer']."</td>";
							echo "<td>".$res1['regisseurvoornaam']."</td>";
							echo "<td>".$res1['regisseurachternaam']."</td>";
							echo "<td>".$res1['genrenaam']."</td>";          
				        }			
					}
					if ($controllerow2>0){
						//acteurvoornaam
						$zoek = $_POST['zoek'];
						$result2 = mysqli_query($mysqli,"SELECT DISTINCT f.*, fr.*, fa.*, fg.*, r.*, a.*, g.*, lc.* FROM film f, filmregisseur fr, filmacteur fa, filmgenre fg, regisseur r, acteur a, genre g, leeftijdscategorie lc WHERE acteurvoornaam LIKE '%".$zoek."%' AND a.acteurnummer = fa.acteurnummer AND fa.filmnummer = f.id AND f.id = fr.filmnummer AND fr.regisseurnummer = r.regisseurnummer AND f.id = fg.filmnummer AND fg.genrenummer = g.genrenummer AND lc.leeftijdscategorienummer = f.leeftijdscategorienummer");	
							while($res2 = mysqli_fetch_array($result2)) {         
								echo "<tr>";
								echo "<td><img id='cover' src='Image/".$res2['image']."' ></td>";
					            echo "<td>".$res2['titel']."</td>";
					            echo "<td>".$res2['leeftijdscategorie']."</td>";
					            echo "<td><a href=".$res2['imdblink'].">imdb</a></td>";
								echo "<td><b>".$res2['acteurvoornaam']."</b></td>";
								echo "<td>".$res2['acteurachternaam']."</td>";
								//echo "<td>".$res2['acteurnummer']."</td>";
								echo "<td>".$res2['regisseurvoornaam']."</td>";
								echo "<td>".$res2['regisseurachternaam']."</td>";
								echo "<td>".$res2['genrenaam']."</td>";         
					        }
					}
					if ($controllerow3>0){
						//acteurachternaam
						$zoek = $_POST['zoek'];
						$result3 = mysqli_query($mysqli,"SELECT DISTINCT f.*, fr.*, fa.*, fg.*, r.*, a.*, g.*, lc.* FROM film f, filmregisseur fr, filmacteur fa, filmgenre fg, regisseur r, acteur a, genre g, leeftijdscategorie lc WHERE acteurachternaam LIKE '%".$zoek."%' AND a.acteurnummer = fa.acteurnummer AND fa.filmnummer = f.id AND f.id = fr.filmnummer AND fr.regisseurnummer = r.regisseurnummer AND f.id = fg.filmnummer AND fg.genrenummer = g.genrenummer AND lc.leeftijdscategorienummer = f.leeftijdscategorienummer");	
							while($res3 = mysqli_fetch_array($result3)) {         
								echo "<tr>";
								echo "<td><img id='cover' src='Image/".$res3['image']."' ></td>";
					            echo "<td>".$res3['titel']."</td>";
					            echo "<td>".$res3['leeftijdscategorie']."</td>";
					            echo "<td><a href=".$res3['imdblink'].">imdb</a></td>";
								echo "<td>".$res3['acteurvoornaam']."</td>";
								echo "<td><b>".$res3['acteurachternaam']."</b></td>";
								//echo "<td>".$res3['acteurnummer']."</td>";
								echo "<td>".$res3['regisseurvoornaam']."</td>";
								echo "<td>".$res3['regisseurachternaam']."</td>";
								echo "<td>".$res3['genrenaam']."</td>";        
					        }
					}
					if ($controllerow4>0){
						//regisseurvoornaam
						$zoek = $_POST['zoek'];
						$result4 = mysqli_query($mysqli,"SELECT DISTINCT f.*, fr.*, fa.*, fg.*, r.*, a.*, g.*, lc.* FROM film f, filmregisseur fr, filmacteur fa, filmgenre fg, regisseur r, acteur a, genre g, leeftijdscategorie lc WHERE regisseurvoornaam LIKE '%".$zoek."%' AND a.acteurnummer = fa.acteurnummer AND fa.filmnummer = f.id AND f.id = fr.filmnummer AND fr.regisseurnummer = r.regisseurnummer AND f.id = fg.filmnummer AND fg.genrenummer = g.genrenummer AND lc.leeftijdscategorienummer = f.leeftijdscategorienummer");	
							while($res4 = mysqli_fetch_array($result4)) {         
								echo "<tr>";
								echo "<td><img id='cover' src='Image/".$res4['image']."' ></td>";
					            echo "<td>".$res4['titel']."</td>";
					            echo "<td>".$res4['leeftijdscategorie']."</td>";
					            echo "<td><a href=".$res4['imdblink'].">imdb</a></td>";
								echo "<td>".$res4['acteurvoornaam']."</td>";
								echo "<td>".$res4['acteurachternaam']."</td>";
								//echo "<td>".$res4['acteurnummer']."</td>";
								echo "<td><b>".$res4['regisseurvoornaam']."</b></td>";
								echo "<td>".$res4['regisseurachternaam']."</td>";
								echo "<td>".$res4['genrenaam']."</td>";				       
					        }
					}
					if ($controllerow5>0){
						//regisseurachternaam
						$zoek = $_POST['zoek'];
						$result5 = mysqli_query($mysqli,"SELECT DISTINCT f.*, fr.*, fa.*, fg.*, r.*, a.*, g.*, lc.* FROM film f, filmregisseur fr, filmacteur fa, filmgenre fg, regisseur r, acteur a, genre g, leeftijdscategorie lc WHERE regisseurachternaam LIKE '%".$zoek."%' AND a.acteurnummer = fa.acteurnummer AND fa.filmnummer = f.id AND f.id = fr.filmnummer AND fr.regisseurnummer = r.regisseurnummer AND f.id = fg.filmnummer AND fg.genrenummer = g.genrenummer AND lc.leeftijdscategorienummer = f.leeftijdscategorienummer");	
							while($res5 = mysqli_fetch_array($result5)) {         
								echo "<tr>";
								echo "<td><img id='cover' src='Image/".$res5['image']."' ></td>";
					            echo "<td>".$res5['titel']."</td>";
					            echo "<td>".$res5['leeftijdscategorie']."</td>";
					            echo "<td><a href=".$res5['imdblink'].">imdb</a></td>";
								echo "<td>".$res5['acteurvoornaam']."</td>";
								echo "<td>".$res5['acteurachternaam']."</td>";
								//echo "<td>".$res5['acteurnummer']."</td>";
								echo "<td>".$res5['regisseurvoornaam']."</td>";
								echo "<td><b>".$res5['regisseurachternaam']."</b></td>";
								echo "<td>".$res5['genrenaam']."</td>";        
							}
					}
					if ($controllerow6>0){
						//genre
						$zoek = $_POST['zoek'];
						$result6 = mysqli_query($mysqli,"SELECT DISTINCT f.*, fr.*, fa.*, fg.*, r.*, a.*, g.*, lc.* FROM film f, filmregisseur fr, filmacteur fa, filmgenre fg, regisseur r, acteur a, genre g, leeftijdscategorie lc WHERE genrenaam LIKE '%".$zoek."%' AND a.acteurnummer = fa.acteurnummer AND fa.filmnummer = f.id AND f.id = fr.filmnummer AND fr.regisseurnummer = r.regisseurnummer AND f.id = fg.filmnummer AND fg.genrenummer = g.genrenummer AND lc.leeftijdscategorienummer = f.leeftijdscategorienummer");	
							while($res6 = mysqli_fetch_array($result6)) {         
								echo "<tr>";
								echo "<td><img id='cover' src='Image/".$res6['image']."' ></td>";
					            echo "<td>".$res6['titel']."</td>";
					            echo "<td>".$res6['leeftijdscategorie']."</td>";
					            echo "<td><a href=".$res6['imdblink'].">imdb</a></td>";
								echo "<td>".$res6['acteurvoornaam']."</td>";
								echo "<td>".$res6['acteurachternaam']."</td>";
								//echo "<td>".$res6['acteurnummer']."</td>";
								echo "<td>".$res6['regisseurvoornaam']."</td>";
								echo "<td>".$res6['regisseurachternaam']."</td>";
								echo "<td><b>".$res6['genrenaam']."</b></td>";       
							}
					}	
			echo "</table>"; 	
   		}else{
   			echo "Geen zoek resultaten";
   		}
    
        echo "<br/><a href='gegevens.php'>Terug naar homepage</a>";	
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
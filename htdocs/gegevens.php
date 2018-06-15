<?php
//including the database connection file
include_once("includes/db_connect.php");
include_once 'includes/functions.php';
 
sec_session_start();

$username = $_SESSION['username'];
//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result1 = mysqli_query($mysqli, "SELECT * FROM film ORDER BY id DESC");
$result2 = mysqli_query($mysqli, "SELECT * FROM acteur");
$result3 = mysqli_query($mysqli, "SELECT * FROM regisseur");
$result4 = mysqli_query($mysqli, "SELECT * FROM genre");
$result5 = mysqli_query($mysqli, "SELECT premission_number FROM members WHERE username='$username'");
$row3 = mysqli_fetch_assoc($result5);
$row10 = implode(" ",$row3);
?>
 
<html>
<head>    
    <title>Film</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
 
<body>
<?php if (login_check($mysqli) == true) : ?>
	<?php include "includes/menu.php" ?>
	
	<?php if ($row10 >0): ?>
		<a href="addalles.php">Add New Alles</a>
	<?php else : ?>
		<p></p>
	<?php endif; ?>
		
    <br></br>

	<?php if ($row10 >0) : ?>
		<a href="addfilm.php">Add New Film</a>
	<?php else : ?>
		<p></p>
	<?php endif; ?>
    <table>
		<tbody>
	        <tr bgcolor='#CCCCCC'>
				<td>Picture</td>
	            <td>Titel</td>
	            <td>Leeftijdscategorienummer</td>
	            <td>imdblink</td>
				<?php if ($row10 >0) : ?>
	            	<td>Update</td>
				<?php else : ?>
					<p></p>
				<?php endif; ?>
	        </tr>
	        <?php 
		        //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
		        while($res1 = mysqli_fetch_array($result1)) {         
		            echo "<tr>";
					echo "<td><img id='cover' src='Image/".$res1['image']."' ></td>";
		            echo "<td>".$res1['titel']."</td>";
		            echo "<td>".$res1['leeftijdscategorienummer']."</td>";
		            echo "<td>".$res1['imdblink']."</td>";
					if ($row10 >0){   
		            echo "<td><a href=\"filmedit.php?id=$res1[id]\">Edit</a> | <a href=\"filmdelete.php?id=$res1[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
					}else{
						echo"";
					}     
		        }
	        ?>
		</tbody>
	</table>
	
	<br></br>
	
	<?php if ($row10 >0) : ?>
		<a href="addacteur.php">Add New Acteur</a>	
	<?php else : ?>
		<p></p>
	<?php endif; ?>
	<table>
		<tbody>
	        <tr bgcolor='#CCCCCC'>
	            <td>Acteurnummer</td>
	            <td>Acteurvoornaam</td>
	            <td>Acteurachternaam</td>
	            <?php if ($row10 >0) : ?>
	            	<td>Update</td>
				<?php else : ?>
					<p></p>
				<?php endif; ?>
	        </tr>
	        <?php 
		        //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
		        while($res2 = mysqli_fetch_array($result2)) {         
		            echo "<tr>";
		            echo "<td>".$res2['acteurnummer']."</td>";
		            echo "<td>".$res2['acteurvoornaam']."</td>";
		            echo "<td>".$res2['acteurachternaam']."</td>";   
		            if ($row10 >0){   
		            echo "<td><a href=\"acteuredit.php?an=$res2[acteurnummer]\">Edit</a> | <a href=\"acteurdelete.php?an=$res2[acteurnummer]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
					}else{
						echo"";
					}           
		        }
        	?>
		</tbody>
	</table>
	
	<br></br>

	<?php if ($row10 >0) : ?>
	<a href="addregisseur.php">Add New Regisseur</a>
	<?php else : ?>
		<p></p>
	<?php endif; ?>
	<table>
		<tbody>
	        <tr bgcolor='#CCCCCC'>
	            <td>regisseurnummer</td>
	            <td>regisseurvoornaam</td>
	            <td>regisseurachternaam</td>
	            <?php if ($row10 >0) : ?>
	            	<td>Update</td>
				<?php else : ?>
					<p></p>
				<?php endif; ?>
	        </tr>
	        <?php 
		        //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
		        while($res3 = mysqli_fetch_array($result3)) {         
		            echo "<tr>";
		            echo "<td>".$res3['regisseurnummer']."</td>";
		            echo "<td>".$res3['regisseurvoornaam']."</td>";
		            echo "<td>".$res3['regisseurachternaam']."</td>";   
					if ($row10 >0){   
		            echo "<td><a href=\"regisseuredit.php?rn=$res3[regisseurnummer]\">Edit</a> | <a href=\"regisseurdelete.php?rn=$res3[regisseurnummer]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
					}else{
						echo"";
					}   	        	
				}
        	?>
		</tbody>
	</table>
	
	<br></br>

	<?php if ($row10 >0) : ?>
	<a href="addgenre.php">Add New Genre</a>
	<?php else : ?>
		<p></p>
	<?php endif; ?>
	<table>
		<tbody>
	        <tr bgcolor='#CCCCCC'>
	            <td>genrenummer</td>
	            <td>genrenaam</td>
	            <?php if ($row10 >0) : ?>
	            	<td>Update</td>
				<?php else : ?>
					<p></p>
				<?php endif; ?>
	        </tr>
	        <?php 
		        //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
		       	while($res4 = mysqli_fetch_array($result4)) {         
		            echo "<tr>";
		            echo "<td>".$res4['genrenummer']."</td>";
		            echo "<td>".$res4['genrenaam']."</td>";
					if ($row10 >0){   
		            echo "<td><a href=\"genreedit.php?gn=$res4[genrenummer]\">Edit</a> | <a href=\"genredelete.php?gn=$res4[genrenummer]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
					}else{
						echo"";
					}   		        
				}
	        ?>
		</tbody>
    </table>
<?php else : ?>
    <p>
      <span class="error">You are not authorized to access this page.</span> Please <a href="index.php">login</a>.
    </p>
<?php endif; ?>
</body>
</html>
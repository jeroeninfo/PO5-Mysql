<?php
//including the database connection file
include_once("includes/db_connect.php");
include_once 'includes/functions.php';
sec_session_start();

$username = $_SESSION['username'];
$result1 = mysqli_query($mysqli, "SELECT premission_number FROM members WHERE username='$username'");
$row1 = mysqli_fetch_assoc($result1);
$row10 = implode(" ",$row1);
$result2 = mysqli_query($mysqli, "SELECT * FROM members");
?>
 
<html>
<head>    
    <title>Film</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
 
<body>
<?php if (login_check($mysqli) == true & $row2 = 1) : ?>
	<?php include "includes/menu.php" ?>
		<table>
			<tbody>
		        <tr bgcolor='#CCCCCC'>
		            <td>Id</td>
		            <td>Username</td>
		            <td>Premission_number</td>
					<td>Premission</td>
		        </tr>
		        <?php 
			       	while($res2 = mysqli_fetch_array($result2)) {         
			            echo "<tr>";
			            echo "<td>".$res2['id']."</td>";
			            echo "<td>".$res2['username']."</td>";
						echo "<td>".$res2['premission_number']."</td>";
						echo "<td><a href=\"admin.php?id=$res2[id]\">Verander toestemming</a></td>";  		        
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
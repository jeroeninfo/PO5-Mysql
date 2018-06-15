<?php
//including the database connection file
include_once("includes/db_connect.php");
include_once 'includes/functions.php';
sec_session_start();

$username = $_SESSION['username'];
$result5 = mysqli_query($mysqli, "SELECT premission_number FROM members WHERE username='$username'");
$row1 = mysqli_fetch_assoc($result5);
$row10 = implode(" ",$row1);
?>
 
<html>
<head>    
    <title>Film</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
 
<body>
<?php if (login_check($mysqli) == true) : ?>
	<?php include "includes/menu.php" ?>
	<h2>Zoekmachine</h2>
	    <form id="gegevens" action="zoek.php" method="post">
			<input type="text" name="zoek"></td>
			<input type="submit" name="Submit" value="zoek"></td>
    </form>
<?php else : ?>
     <p>
         <span class="error">You are not authorized to access this page.</span> Please <a href="index.php">login</a>.
     </p>
<?php endif; ?>
</body>
</html>
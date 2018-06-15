<?php
//including the database connection file
include("includes/db_connect.php");
 
//getting id of the data from url
$rn = $_GET['rn'];
 
//deleting the row from table
$result = mysqli_query($mysqli, "DELETE FROM regisseur WHERE regisseurnummer=$rn");
$result2 = mysqli_query($mysqli, "DELETE FROM filmregisseur WHERE regisseurnummer=$rn");
 
//redirecting to the display page (index.php in our case)
header("Location:gegevens.php");
?>

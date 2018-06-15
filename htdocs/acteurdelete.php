<?php
//including the database connection file
include("includes/db_connect.php");
 
//getting id of the data from url
$an = $_GET['an'];
  
//deleting the row from table
$result = mysqli_query($mysqli, "DELETE FROM acteur WHERE acteurnummer=$an");
$result2 = mysqli_query($mysqli, "DELETE FROM filmacteur WHERE acteurnummer=$an");
 
//redirecting to the display page (index.php in our case)
header("Location:gegevens.php");
?>

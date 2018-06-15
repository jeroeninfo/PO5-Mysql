<?php
//including the database connection file
include("includes/db_connect.php");
 
//getting id of the data from url
$gn = $_GET['gn'];
 
//deleting the row from table
$result = mysqli_query($mysqli, "DELETE FROM genre WHERE genrenummer=$gn");
$result2 = mysqli_query($mysqli, "DELETE FROM filmgenre WHERE genrenummer=$gn");
 
//redirecting to the display page (index.php in our case)
header("Location:gegevens.php");
?>


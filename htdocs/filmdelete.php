<?php
//including the database connection file
include("includes/db_connect.php");
 
//getting id of the data from url
$id = $_GET['id'];
 
//deleting the row from table
$result = mysqli_query($mysqli, "DELETE FROM film WHERE id=$id");
$result = mysqli_query($mysqli, "DELETE FROM filmacteur WHERE id=$id");
$result = mysqli_query($mysqli, "DELETE FROM filmregisseur WHERE id=$id");
$result = mysqli_query($mysqli, "DELETE FROM filmgenre WHERE id=$id");
$result = mysqli_query($mysqli, "DELETE FROM filmwaarschuwing WHERE id=$id");
 
//redirecting to the display page (index.php in our case)
header("Location:gegevens.php");
?>

<?php
//including the database connection file
include_once("includes/db_connect.php");
include_once 'includes/functions.php';
sec_session_start();
?>

<html>
<head>
    <title>Add Data</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
 
<body>
<?php if (login_check($mysqli) == true) : ?>
    <a href="gegevens.php">Home</a>
    <br/><br/>
 
    <form id="gegevens" action="addregisseur2.php" method="post" name="form1">
        <table id="gegevens">
            <tr> 
                <td>Voornaam regisseur</td>
                <td><input type="text" name="regisseurvoornaam"></td>
            </tr>
            <tr> 
                <td>Achternaam regisseur</td>
                <td><input type="text" name="regisseurachternaam"></td>
            </tr>
			<tr> 
                <td>Film</td>
                <td><input type="text" name="film"></td>
            </tr>
            <tr> 
                <td></td>
                <td><input type="submit" name="Submit" value="Add"></td>
            </tr>
        </table>
    </form>
<?php else : ?>
     <p>
         <span class="error">You are not authorized to access this page.</span> Please <a href="index.php">login</a>.
     </p>
<?php endif; ?>
</body>
</html>


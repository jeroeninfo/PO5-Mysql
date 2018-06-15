<?php
//including the database connection file
include_once("includes/db_connect.php");
include_once 'includes/functions.php';
sec_session_start();
$result1 = mysqli_query($mysqli, "SELECT * FROM leeftijdscategorie");
$result2 = mysqli_query($mysqli, "SELECT * FROM waarschuwing");
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
 
    <form id="gegevens" action="addfilm2.php" method="post" name="form1" enctype="multipart/form-data">
        <table id="gegevens">
            <tr> 
                <td>Titel</td>
                <td><input type="text" name="titel" enctype="multipart/form-data"></td>
            </tr>
			<tr>
				<td>Leeftijdscategorie</td>
				<td><input name="leeftijdscategorienummer" type="radio" value="1">Alle leeftijden</td>
				<td><input name="leeftijdscategorienummer" type="radio" value="2">Vanaf 6 jaar</td>
				<td><input name="leeftijdscategorienummer" type="radio" value="3">Vanaf 9 jaar</td>
				<td><input name="leeftijdscategorienummer" type="radio" value="4">Vanaf 12 jaar</td>
				<td><input name="leeftijdscategorienummer" type="radio" value="5">Vanaf 16 jaar</td>
			</tr>
			<tr>
				<td>Waarschuwing</td>
				<td><input type="checkbox" name="geweld" value="1">Geweld<br></td>
				<td><input type="checkbox" name="angst" value="1">Angst<br></td>
				<td><input type="checkbox" name="seks" value="1">Seks<br></td>
				<td><input type="checkbox" name="grof" value="1">Grof taalgebruik<br></td>
				<td><input type="checkbox" name="dralc" value="1">Drugs- en/of alcoholgebruik<br></td>
				<td><input type="checkbox" name="discr" value="1">Discriminatie</td>
            </tr>
			<tr> 
                <td>Genre</td>
                <td><input type="text" name="genrenaam"></td>
            </tr>
            <tr> 
                <td>imdblink</td>
                <td><input type="text" name="imdblink"></td>
            </tr>
		  	<tr>
				  <td><input type="file" name="image" enctype="multipart/form-data"></td>
		  	</tr>
            <tr> 
                <td></td>
                <td><input type="submit" name="Submit" value="Add"></td>
            </tr>
        </table>
    </form>

	<table id="leeftijd">
	<tbody>
        <?php 
        //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
        while($res1 = mysqli_fetch_array($result1)) {         
            echo "<td>";?> <img src="<?php echo $res1['afbeelding']; ?>"> <?php "</td>";
            echo "<td>".$res1['leeftijdscategorie']."</td>";          
        }
        ?>
	</tbody>
    </table>
	<table id="waarschuwing">
	<tbody>
        <?php  
        while($res2 = mysqli_fetch_array($result2)) {         
			echo "<td>";?> <img src="<?php echo $res2['afbeelding']; ?>"> <?php "</td>";
            echo "<td>".$res2['waarschuwing']."</td>";       
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

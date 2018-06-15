<?php
// including the database connection file
include_once("includes/db_connect.php");
include_once 'includes/functions.php';
sec_session_start();
 
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $titel=$_POST['titel'];
    $lc=$_POST['leeftijdscategorienummer'];
	$link=$_POST['imdblink'];
	$image = $_FILES['image']['name'];    
    
    // checking empty fields
    if(empty($titel) || empty($lc) || empty($link) || empty($image)) {            
        if(empty($titel)) {
            echo "<font color='red'>Titel field is empty.</font><br/>";
        }
   
        if(empty($lc)) {
            echo "<font color='red'>Leeftijdscategorienummer field is empty.</font><br/>";
        }
        if(empty($link)) {
            echo "<font color='red'>imdblink field is empty.</font><br/>";
        }            
    } else {    
        //updating the table
        $result = mysqli_query($mysqli, "UPDATE film SET titel = '$titel', leeftijdscategorienummer = '$lc', imdblink = '$link', image = '$image' WHERE id = ".$id);
		  	// image file directory
		  	$target = "image/".basename($image);
	
		  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
		  		$msg = "Image uploaded successfully";
		  	}else{
		  		$msg = "Failed to upload image";
		  	}
        //redirectig to the display page. In our case, it is index.php
        header("Location: ../gegevens.php");
    }
}
?>
<?php
//getting id from url
$id = $_GET['id'];
 
//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM film WHERE id = $id");
 
while($res = mysqli_fetch_array($result))
{
    $titel = $res['titel'];
    $lc = $res['leeftijdscategorienummer'];
	$link = $res['imdblink'];
	$image = $res['image'];
}
?>
<html>
<head>    
    <title>Edit Data</title>
</head>
 
<body>
<?php if (login_check($mysqli) == true) : ?>
    <a href="../gegevens.php">Home</a>
    <br/><br/>
	
    <form name="form1" method="post" action="filmedit.php" enctype="multipart/form-data">
        <table border="0">
            <tr> 
                <td>Titel</td>
                <td><input type="text" name="titel" value="<?php echo $titel;?>"></td>
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
                <td>imdblink</td>
                <td><input type="text" name="imdblink" value="<?php echo $link;?>"></td>
            </tr>
			<tr>
				  <td><input type="file" name="image" enctype="multipart/form-data"></td>
		  	</tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
                <td><input type="submit" name="update" value="Update"></td>
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
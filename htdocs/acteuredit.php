<?php
// including the database connection file
include_once("includes/db_connect.php");
include_once 'includes/functions.php';
sec_session_start();
 
if(isset($_POST['update']))
{    
    $an = $_POST['acteurnummer'];
    
    $av=$_POST['acteurvoornaam'];
    $aa=$_POST['acteurachternaam'];
    
    // checking empty fields
    if(empty($av) || empty($aa)) {            
        if(empty($av)) {
            echo "<font color='red'>Voornaam Acteur field is empty.</font><br/>";
        }
        
        if(empty($aa)) {
            echo "<font color='red'>Achternaam Acteur field is empty.</font><br/>";
        }
        
    } else {    
        //updating the table
        $result = mysqli_query($mysqli, "UPDATE acteur SET acteurvoornaam='$av',acteurachternaam='$aa' WHERE acteurnummer=$an");
        
        //redirectig to the display page. In our case, it is index.php
        header("Location: gegevens.php");
    }
}
?>
<?php
//getting id from url
$an = $_GET['an'];
 
//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM acteur WHERE acteurnummer=$an");
 
while($res = mysqli_fetch_array($result))
{
    $av = $res['acteurvoornaam'];
    $aa = $res['acteurachternaam'];
}
?>
<html>
<head>    
    <title>Edit Data</title>
</head>
 
<body>
<?php if (login_check($mysqli) == true) : ?>
    <a href="gegevens.php">Home</a>
    <br/><br/>
	
	
    <form name="form1" method="post" action="acteuredit.php">
        <table border="0">
            <tr> 
                <td>Voornaam Acteur</td>
                <td><input type="text" name="acteurvoornaam" value="<?php echo $av;?>"></td>
            </tr>
            <tr> 
                <td>Achternaam Acteur</td>
                <td><input type="text" name="acteurachternaam" value="<?php echo $aa;?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="acteurnummer" value=<?php echo $_GET['an'];?>></td>
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
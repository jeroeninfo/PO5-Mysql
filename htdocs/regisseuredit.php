<?php
// including the database connection file
include_once("includes/db_connect.php");
include_once 'includes/functions.php';
sec_session_start();

 
if(isset($_POST['update']))
{    
    $rn = $_POST['regisseurnummer'];
    
    $rv=$_POST['regisseurvoornaam'];
    $ra=$_POST['regisseurachternaam'];
    
    // checking empty fields
    if(empty($rv) || empty($ra)) {            
        if(empty($rv)) {
            echo "<font color='red'>Voornaam Regisseur field is empty.</font><br/>";
        }
        
        if(empty($ra)) {
            echo "<font color='red'>Achternaam Regisseur field is empty.</font><br/>";
        }
        
    } else {    
        //updating the table
        $result = mysqli_query($mysqli, "UPDATE regisseur SET regisseurvoornaam='$rv',regisseurachternaam='$ra' WHERE regisseurnummer=$rn");
        
        //redirectig to the display page. In our case, it is index.php
        header("Location: gegevens.php");
    }
}
?>
<?php
//getting id from url
$rn = $_GET['rn'];
 
//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM regisseur WHERE regisseurnummer=$rn");
 
while($res = mysqli_fetch_array($result))
{
    $rv = $res['regisseurvoornaam'];
    $ra = $res['regisseurachternaam'];
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
	
	
    <form name="form1" method="post" action="regisseuredit.php">
        <table border="0">
            <tr> 
                <td>Voornaam Acteur</td>
                <td><input type="text" name="regisseurvoornaam" value="<?php echo $rv;?>"></td>
            </tr>
            <tr> 
                <td>Achternaam Acteur</td>
                <td><input type="text" name="regisseurachternaam" value="<?php echo $ra;?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="regisseurnummer" value=<?php echo $_GET['rn'];?>></td>
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
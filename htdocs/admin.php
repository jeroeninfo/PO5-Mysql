<?php
//including the database connection file
include_once("includes/db_connect.php");
include_once 'includes/functions.php';
sec_session_start();

if(isset($_POST['update']))
{    
	$ui = $_POST['userid'];
    $admin = $_POST['admin'];
    
    // checking empty fields
    if($admin <0) {            
        if($admin <0) {
            echo "<font color='red'>Geen veld geselecteerd.</font><br/>";
        }
        
    } else {    
        //updating the table
        $result = mysqli_query($mysqli, "UPDATE members SET premission_number='$admin' WHERE id=$ui");
        
        //redirectig to the display page. In our case, it is index.php
        header("Location: gebruikers.php");
    }
}
?>
<?php
//getting id from url
$id = $_GET['id'];
?>
 
<html>
<head>    
    <title>Film</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
 
<body>
<?php if (login_check($mysqli) == true & $row2 = 1) : ?>
	<?php echo $admin; ?>
    <form name="form1" method="post" action="admin.php">
        <table border="0">
            <tr> 
                <td>Member</td>
				<td><input name="admin" type="radio" value="0">Gebruiker</td>
				<td><input name="admin" type="radio" value="1">Admin</td>
            </tr>
            <tr>
                <td><input type="hidden" name="userid" value=<?php echo $_GET['id'];?>></td>
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

<?php session_start(); //start a session

$username = $_POST ["username"];
$password = $_POST ["password"];

if ($_POST){
	$c = mysqli_connect("localhost", "root", "XXXXX", "sakila");
	
	//set up mysql variables
	$stmt = mysqli_prepare($c, "SET @username = ?, @password = ?;");
	mysqli_stmt_bind_param($c, "ss", $username, $password);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	//done setting up variables
	
	//get our data
	$table = mysqli_query($c,"
	
SELECT -- get data from the database
     staff_id 
 FROM
     staff 
 WHERE 
    username=@username AND password=@password;
	");
	if ($table){
		if ($row = mysqli_fetch_assoc($table)){
			$_SESSION["staff"]= (int) $row["staff_id"];//cast string to int
		}
		mysqli_free_result($table);
	}
	
	//done getting our data
	
	mysql_close($c);
}
 
	if ($_SESSION["staff"]){
		header("Location: discount.php");
		//sends users to another page if login is correct
	}
	session_commit(); //close the session
	
?>

		<?php include 'template/header.php';?>
<!-- puts the header on this page -->

<form action="login.php" method="post"><!-- send action to this page -->
<table cellpadding="2" width="50%" bgcolor="#ffffff" align="center"
	cellspacing="4">
	<!-- centers the login table and aligns -->

	<tr>
		<td></td>
		<td>Login</td>
		<!--login label -->

	</tr>
	<tr>
		<td class="rightAlign">Username</td>
		<!-- username label -->

		<td><input  name="username" type="text" value=" <?php echo $username;?>"/></td>
		<!-- username text field -->
	</tr>
	<tr>
		<td class="rightAlign">Password</td>
		<!-- password label -->
		<td><input type="password" name="password"/></td>
		<!-- password text field -->
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="Login"/> 
	<input type="reset" value="Cancel"/></td>
</tr>
</table>
</form>

		<?php include 'template/footer.php';?>
<!-- puts the footer on this page -->


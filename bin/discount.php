<?php session_start();?><!-- start session -->

<!DOCTYPE html>

<html>

<head>
<link type="text/css" rel="stylesheet" href="new.css" media="screen">
<!-- style sheet, colors and layout or the page-->
</head>

<body>
<div class="spacing"><!-- start navigation-->
<div id="navigation"><!-- id is unique --> <!-- buttons tell the user where to go-->
<div><a href="index.php">Home</a></div>
<div><a href="locations.php">Locations</a></div>
<div><a href="category.php">Categories</a></div>
<div><a href="baby.php">Baby Club</a></div>
<div><a href="online.php">Online Easy Order</a></div>
<div><a href="contact.php">Contact Us</a></div>
<div><a href="index.php">Log Out</a></div>

</div>
</div>
<br />
<br />
<!-- search button -->
<div><script type="text/javascript"
	src="http://app.ecwid.com/script.js?6839060" charset="utf-8"></script>
<script type="text/javascript"> xSearchPanel("id=my-search-6839060"); </script>
</div>


<!-- end of the navigation -->
<div class="spacing">
<div class="container"><!-- repeating types of styles -->
 <!-- Variety Grocery Mart Logo container -->
<img src="images/logo2.png" height="150 px" /></div>
</div>
<div>

<?php

$staff_id = $_SESSION["staff"];
$c = mysqli_connect("localhost", "root", "root", "sakila");

//set up variables
$stmt = mysqli_prepare($c, "SET @staff_id = ?;");
mysqli_stmt_bind_param($stmt, "i", $staff_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
//done with setting up varibles

//get the data
$table = mysqli_query($c,"
	select
	first_name,
    last_name
from
	staff
where
	staff_id=@staff_id;
");
if($table){
	if($row = mysqli_fetch_assoc($table)){
		echo "Hello ";
		echo $row["first_name"];
		echo " ";
		echo $row["last_name"];
	}else{
		echo "Hello Stranger, you are not logged in";
	}
	mysql_free_result($table);
	
}
mysqli_close($c);             
?>
</div>
<button style="background: yellowgreen;">Print coupons</button> <!--print button-->

<img src="images/coupon.jpg"><!--picture of the coupons-->



<?php include 'template/footer.php';?> <!-- puts the footer on this page -->

<?php session_commit();?>
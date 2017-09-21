<?php 
	session_start();

 include "template/header.php";

	$categories = array();
	$c = mysqli_connect("127.0.0.1", "root", "root", "sakila");
	//mysqli_connect("127.0.0.1", "my_user", "my_password", "my_db");
	$table = mysql_query($c,"SELECT name, category_id FROM sakila.category;");
	if($table){
		while($row = mysqli_fetch_assoc($table)){//while there are rows to get, get them
			//put each category row on the top of the array category
			$categories[] = $row;
		}
		mysqli_free_result($table);
	}
	else {
		echo "Error: Unable to connect to MySQL." . PHP_EOL;
    	echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    	echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
	}
	$i = 0;//what index in the array are we?
	while($i < count($categories)){
		echo "<div class='title'>";
		echo $categories[$i]["name"];
		echo "</div>";
		//print the pictures for the category
		$i++;
		
	}
	
 include "template/footer.php";

  session_commit();
  ?>
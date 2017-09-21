<?php 
	session_start();

 include "template/header.php";

	$categories = array();
	$conn = mysqli_connect("127.0.0.1", "root", "XXXXX", "sakila"); 
	$sql="SELECT name, category_id FROM sakila.category;";
	$result = $conn->query($sql);
        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
	 while($row = mysqli_fetch_assoc($result)){//while there are rows to get, get them
			//put each category row on the top of the array category
			$categories[] = $row;
		}
	 mysqli_free_result($result);
	 
	 
	$i = 0;//what index in the array are we?
	while($i < count($categories)){
		echo "<div class='title'>";
		echo $categories[$i]["name"];
		echo "</div>";
		//print the pictures for the category
		$i++;
		
	}
	
  include "template/footer.php";
  $conn->close();
  session_commit();
  ?>

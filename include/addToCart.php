<?php

		$item = $_POST['item'];
		$user = $_POST['user'];

		$dbc = @mysqli_connect("localhost", "giara", "latenight", "giara")
	       or die("Could not open menu db, " . mysqli_connect_error());
		$query = "insert into Cart (Item_Id, User_Id) values ($item, $user)";				
		//$result = mysqli_query($dbc, $query) or die ("Error in Select" . mysqli_error($dbc));
		
		if(mysqli_query($dbc, $query)) {
			$result = true;
		}
		else {
			$result = false;
		}
	
		$data_from_post = array('item' => $item);
		echo json_encode($result);
		mysqli_close($dbc);
?>
?>
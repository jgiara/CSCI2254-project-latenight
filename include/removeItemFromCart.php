<?php

		$user = $_POST['user'];
		$item = $_POST['item'];
	
		$dbc = @mysqli_connect("localhost", "giara", "latenight", "giara")
	       or die("Could not open menu db, " . mysqli_connect_error());
		$query = "delete from Cart where User_Id = $user and Item_Id = $item";			
		//$result = mysqli_query($dbc, $query) or die ("Error in Select" . mysqli_error($dbc));
		
		if(mysqli_query($dbc, $query)) {
			$result = true;
		}
		else {
			$result = false;
		}
	
		$data_from_post = array('user' => $user);
		echo json_encode($result);
		mysqli_close($dbc);


?>
<?php

		
		$user = $_POST['user'];
		$password = $_POST['password'];

		$dbc = @mysqli_connect("localhost", "giara", "latenight", "giara")
	       or die("Could not open menu db, " . mysqli_connect_error());
		$query = "update Users set Password = sha1('$password')
		where Eagle_Id = $user";				
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
?>
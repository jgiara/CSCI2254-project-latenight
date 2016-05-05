<?php

		
		$user = $_POST['user'];
		$first = $_POST['fn'];
		$last = $_POST['ln'];
		$addr = $_POST['addr'];
		$phone = $_POST['phone'];

		$dbc = @mysqli_connect("localhost", "giara", "latenight", "giara")
	       or die("Could not open menu db, " . mysqli_connect_error());
		$query = "update Users set First_Name = '$first', Last_Name = '$last', Address = '$addr', Phone = '$phone'
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
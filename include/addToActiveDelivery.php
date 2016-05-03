<?php

		$order = $_POST['order'];
		$user = $_POST['user'];

		$dbc = @mysqli_connect("localhost", "giara", "latenight", "giara")
	       or die("Could not open menu db, " . mysqli_connect_error());
		$query = "insert into Deliveries (Order_Id, User_Id) values ($order, $user)";				
		//$result = mysqli_query($dbc, $query) or die ("Error in Select" . mysqli_error($dbc));
		
		if(mysqli_query($dbc, $query)) {
			$result = true;
		}
		else {
			$result = false;
		}

		$query = "update Orders set Stage = 'In Progress', Fulfilled_By = $user where Id = $order";

		if(mysqli_query($dbc, $query)) {
			$result = true;
		}
		else {
			$result = false;
		}
	
		$data_from_post = array('order' => $order);
		echo json_encode($result);
		mysqli_close($dbc);
?>
?>
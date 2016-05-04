<?php

		$order = $_POST['order'];
		$user = $_POST['user'];
		$nextStage = $_POST['nextt'];

		$dbc = @mysqli_connect("localhost", "giara", "latenight", "giara")
	       or die("Could not open menu db, " . mysqli_connect_error());
		$query = "update Orders set Stage = '$nextStage' where Id = $order";				
		//$result = mysqli_query($dbc, $query) or die ("Error in Select" . mysqli_error($dbc));
		
		if(mysqli_query($dbc, $query)) {
			$result = true;
		}
		else {
			$result = false;
		}

		if($nextStage == 'Delivered') {
			$query = "update Orders set Time_Fulfilled = now() where Id = $order";
			if(mysqli_query($dbc, $query)) {
			$result = true;
			}
			else {
			$result = false;
			}
		}
	
		$data_from_post = array('order' => $order);
		echo json_encode($result);
		mysqli_close($dbc);
?>
?>
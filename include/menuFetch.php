<?php

		$loc = $_GET['location'];

		$dbc = @mysqli_connect("localhost", "giara", "latenight", "giara")
	       or die("Could not open menu db, " . mysqli_connect_error());
		$query = "SELECT Id, Name, Price FROM Items where Availability = '$loc'";				
		$result = mysqli_query($dbc, $query) or die ("Error in Select" . mysqli_error($dbc));
		
		$menu_items = array();	// put the rows as objects in an array
		while ( $row = mysqli_fetch_assoc( $result ) ) {
			$menu_items[] = $row;
		}
		echo json_encode($menu_items);
		mysqli_close($dbc);


?>
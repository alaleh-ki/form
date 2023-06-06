<?php 

	// connect to the database
	$conn = mysqli_connect('localhost', 'alaleh', 'test1234', 'project');

	// check connection
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}

?>
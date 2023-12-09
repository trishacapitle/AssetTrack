<?php

require_once 'db_conn.php';


function dispaly_data(){
	global $conn;
	$query = "select * from checkinout";
	$result = mysqli_query($conn,$query);
	return $result;
}

?>
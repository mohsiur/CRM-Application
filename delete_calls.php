<?php 
	
	include_once 'db/conn.php';
	include_once 'db/calls.php';

	$database = new Database();
	$db = $database->getConnection();

	$calls = new Calls($db);

	$data = json_decode(file_get_contents("php://input"));

	$calls->callsID = $data->callsID;

	if($calls->delete()){
		echo "Call was deleted";
	}
	else{
		echo "Unable to delete call";
	}

?>
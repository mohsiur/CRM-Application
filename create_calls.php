<?php 


	// Connect to the database
	include_once 'db/conn.php';
	$databse = new Database();
	$db = $databse->getConnection();

	//initialize new call object
	include_once 'db/calls.php';
	$calls = new Calls($db);

	//get data from form
	$data = json_decode(file_get_contents("php://input"));

	//Set Call property values
	$calls->subject = $data->subject;
	$calls->phoneNum = $data->phoneNum;
	$calls->description = $data->description;
	$calls->createdAt = date('Y-m-d H:i:s');
	$calls->relatedTo = $data->relatedTo;
	if($calls->create()){
		echo "Call was created";
	}

	else{
		echo "Unable to create product";
	}
?>
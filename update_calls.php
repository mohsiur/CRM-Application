<?php 
	// include database and object files 
	include_once 'db/conn.php'; 
	include_once 'db/calls.php'; 
	 
	// get database connection 
	$database = new Database(); 
	$db = $database->getConnection();
	 
	// prepare calls object
	$calls = new Calls($db);
	 
	// get id of calls to be edited
	$data = json_decode(file_get_contents("php://input"));     
	 
	// set ID property of calls to be edited
	$calls->callsID = $data->callsID;
	 
	// set calls property values
	$calls->subject = $data->subject;
	$calls->phoneNum = $data->phoneNum;
	$calls->description = $data->description;
	$calls->updatedAt = date('Y-m-d H:i:s');
	$calls->relatedTo = $data->relatedTo;
	 
	// update the calls
	if($calls->update()){
	    echo "Calls was updated." + $calls->callsID;
	}
	 
	// if unable to update the calls, tell the user
	else{
	    echo "Unable to update calls.";
	}
?>
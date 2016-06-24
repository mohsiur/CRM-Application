<?php  

include_once 'db/conn.php';
include_once 'db/calls.php';

$database = new Database();
$db = $database->getConnection();

$calls = new Calls($db);

$data = json_decode(file_get_contents("php://input"));

$calls->callsID = $data->callsID;
$calls->readOne();

$calls_arr[] = array(
	"callsID" => $calls->callsID,
	"subject" => $calls->subject,
	"phoneNum" => $calls->phoneNum,
	"description" => $calls->description,
	"relatedTo" => $calls->relatedTo
);
	print_r(json_encode($calls_arr));

?>
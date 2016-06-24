<?php  

	include_once 'db/conn.php';
	include_once 'db/contacts.php';

	$database = new Database();
	$db = $database->getConnection();

	$contacts = new Contacts($db);

	$data = json_decode(file_get_contents("php://input"));

	$contacts->contactID = $data->contactID;
	$contacts->readOne();

	$contacts_arr[] = array(
		"contactID" => $contacts->contactID,
		"firstName" => $contacts->firstName,
		"lastName" => $contacts->lastName,
		"officeNum" => $contacts->officeNum,
		"mobileNum" => $contacts->mobileNum,
		"faxNum" => $contacts->faxNum,
		"email" => $contacts->email,
		"street" => $contacts->street,
		"city" => $contacts->city,
		"state" => $contacts->state,
		"postalCode" => $contacts->postalCode,
		"country" => $contacts->country,
		"description" => $contacts->description,
		"contactSource" => $contacts->contactSource
	);
		print_r(json_encode($contacts_arr));
?>
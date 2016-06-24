<?php 


	// Connect to the database
	include_once 'db/conn.php';
	$databse = new Database();
	$db = $databse->getConnection();

	//initialize new call object
	include_once 'db/contacts.php';
	$contacts = new Contacts($db);

	//get data from form
	$data = json_decode(file_get_contents("php://input"));

	//Set Call property values
	$contacts->firstName = $data->firstName;
	$contacts->lastName = $data->lastName;
	$contacts->officeNum = $data->officeNum;
	$contacts->mobileNum = $data->mobileNum;
	$contacts->faxNum = $data->faxNum;
	$contacts->email = $data->email;
	$contacts->street = $data->street;
	$contacts->city = $data->city;
	$contacts->state = $data->state;
	$contacts->postalCode = $data->postalCode;
	$contacts->country = $data->country;
	$contacts->description = $data->description;
	$contacts->contactSource = $data->contactSource;
	
	if($contacts->create()){
		echo "Contact was created";
	}

	else{
		echo "Unable to create product";
	}
?>
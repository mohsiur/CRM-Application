<?php 

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	include_once 'db/conn.php';
	include_once 'db/contacts.php';

	$database = new Database();
	$db = $database->getConnection();

	$contacts = new Contacts($db);

	$stmt = $contacts->readAll();
	$num = $stmt->rowCount();

	if($num>0){
		$data = "";
		$x = 1;

		// retrieve our table contents
	    // fetch() is faster than fetchAll()
	    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
	    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	        // extract row
	        // this will make $row['name'] to
	        // just $name only
	        extract($row);
	          
	        $data .= '{';
	            $data .= '"contactID":"'  . $contactID . '",';
	            $data .= '"firstName":"' . $firstName . '",';
	            $data .= '"lastName":"' . $lastName . '",';
	            $data .= '"officeNum":"' . $officeNum . '",';
	            $data .= '"mobileNum":"' . $mobileNum . '",';
	            $data .= '"faxNum":"' . $faxNum . '",';
	            $data .= '"email":"' . $email . '",';
	            $data .= '"address":"' . $address . '",';
	            $data .= '"description":"' . html_entity_decode($description) . '",';
	            $data .= '"contactSource":"' . $contactSource . '"';
	        $data .= '}'; 
	          
	        $data .= $x<$num ? ',' : ''; $x++; } 
	} 
	 
	// json format output 
	echo '{"records":[' . $data . ']}'; 
?>
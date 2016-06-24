<?php 

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	include_once 'db/conn.php';
	include_once 'db/calls.php';

	$database = new Database();
	$db = $database->getConnection();

	$calls = new Calls($db);

	$stmt = $calls->readAll();
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
	            $data .= '"callsID":"'  . $callsID . '",';
	            $data .= '"subject":"' . $subject . '",';
	            $data .= '"phoneNum":"' . $phoneNum . '",';
	            $data .= '"createdAt":"' . $createdAt . '",';
	            $data .= '"updatedAt":"' . $updatedAt . '",';
	            $data .= '"description":"' . html_entity_decode($description) . '",';
	            $data .= '"relatedTo":"' . $relatedTo . '"';
	        $data .= '}'; 
	          
	        $data .= $x<$num ? ',' : ''; $x++; } 
	} 
	 
	// json format output 
	echo '{"records":[' . $data . ']}'; 
?>
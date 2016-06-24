<?php  

	class Contacts{

		private $conn;
		private $table_name = "contacts";

		public $contactID;
		public $firstName;
		public $lastName;
		public $officeNum;
		public $mobileNum;
		public $faxNum;
		public $email;
		public $street;
		public $city;
		public $state;
		public $postalCode;
		public $country;
		public $description;
		public $contactSource;

		// constructor with $db as database connection 
	    public function __construct($db){ 
	        $this->conn = $db;
	    }

	    function create(){
	    	$query = "INSERT INTO
	    				" . $this->table_name . "
	    				SET
	    					firstName=:firstName,
	    					lastName=:lastName,
	    					officeNum=:officeNum,
	    					mobileNum=:mobileNum,
	    					faxNum=:faxNum,
	    					email=:email,
	    					street=:street,
	    					city=:city,
	    					state=:state,
	    					postalCode=:postalCode,
	    					country=:country,
	    					description=:description,
	    					contactSource=:contactSource";

	    	$stmt = $this->conn->prepare($query);

	    	//posted values
	    	$this->firstName = htmlspecialchars(strip_tags($this->firstName));
	    	$this->lastName = htmlspecialchars(strip_tags($this->lastName));
	    	$this->officeNum = htmlspecialchars(strip_tags($this->officeNum));
	    	$this->mobileNum = htmlspecialchars(strip_tags($this->mobileNum));
	    	$this->faxNum = htmlspecialchars(strip_tags($this->faxNum));
	    	$this->email = htmlspecialchars(strip_tags($this->email));
	    	$this->street = htmlspecialchars(strip_tags($this->street));
	    	$this->city = htmlspecialchars(strip_tags($this->city));
	    	$this->state = htmlspecialchars(strip_tags($this->state));
	    	$this->postalCode = htmlspecialchars(strip_tags($this->postalCode));
	    	$this->country = htmlspecialchars(strip_tags($this->country));
	    	$this->description = htmlspecialchars(strip_tags($this->description));
	    	$this->contactSource = htmlspecialchars(strip_tags($this->contactSource));

	    	//bind values
	    	$stmt->bindParam(":firstName", $this->firstName);
	    	$stmt->bindParam(":lastName", $this->lastName);
	    	$stmt->bindParam(":officeNum", $this->officeNum);
	    	$stmt->bindParam(":mobileNum", $this->mobileNum);
	    	$stmt->bindParam(":faxNum", $this->faxNum);
	    	$stmt->bindParam(":email", $this->email);
	    	$stmt->bindParam(":street", $this->street);
	    	$stmt->bindParam(":city", $this->city);
	    	$stmt->bindParam(":state", $this->state);
	    	$stmt->bindParam(":postalCode", $this->postalCode);
	    	$stmt->bindParam(":country", $this->country);
	    	$stmt->bindParam(":description", $this->description);
	    	$stmt->bindParam(":contactSource", $this->contactSource);

	    	//execute query
	    	if($stmt->execute()){
	    		return true;
	    	}else{
	    		echo "<pre>";
	    			print_r($stmt->errorInfo());
	    		echo "</pre>";
	    		return false;
	    	}

		}

		function readAll(){
			$query = "SELECT
						contactID, firstName, lastName, officeNum, mobileNum, faxNum, email, description, contactSource,
							CONCAT(street, ', ' , city ,' ' , state, ', ', country,' ', postalCode) as address
						FROM
							" . $this->table_name . "
						ORDER BY
							contactID DESC";

			$stmt = $this->conn->prepare($query);

			if($stmt->execute()){
	    		return $stmt;
	    	}else{
	    		echo "<pre>";
	    			print_r($stmt->errorInfo());
	    		echo "</pre>";
	    		return false;
	    	}
		}

		function readOne(){
			$query = "SELECT
						firstName,
						lastName,
						officeNum,
						mobileNum,
						faxNum,
						email,
						street,
						city,
						state,
						postalCode,
						country,
						description,
						contactSource
						FROM 
							" . $this->table_name . "
						WHERE
							contactID = ?
						LIMIT
							0, 1";
			$stmt = $this->conn->prepare( $query );

			$stmt->bindParam(1, $this->contactID);

			$stmt->execute();
			
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			$this->firstName = $row['firstName'];
			$this->lastName = $row['lastName'];
			$this->officeNum = $row['officeNum'];
			$this->mobileNum = $row['mobileNum'];
			$this->faxNum = $row['faxNum'];
			$this->email = $row['email'];
			$this->street = $row['street'];
			$this->city = $row['city'];
			$this->state = $row['state'];
			$this->postalCode = $row['postalCode'];
			$this->country = $row['country'];
			$this->description = $row['description'];
			$this->contactSource = $row['contactSource'];
		}
	}




?>
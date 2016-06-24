

<?php 
class Calls{ 
    // database connection and table name 
    private $conn; 
    private $table_name = "calls"; 
 
    // object properties 
    public $callsID; 
    public $subject; 
    public $phoneNum; 
    public $createdAt; 
    public $updatedAt;
    public $description;
    public $relatedTo;
    public $contactID; 
 
    // constructor with $db as database connection 
    public function __construct($db){ 
        $this->conn = $db;
    }

    function create(){
    	$query = "INSERT INTO 
    				". $this->table_name . "
    			SET
    				subject=:subject,
    				phoneNum=:phoneNum,
    				description=:description,
    				relatedTo=:relatedTo,
    				createdAt=:createdAt";

    	//prepare query
    	$stmt = $this->conn->prepare($query);

    	//posted values
    	$this->subject = htmlspecialchars(strip_tags($this->subject));
    	$this->phoneNum = htmlspecialchars(strip_tags($this->phoneNum));
    	$this->description = htmlspecialchars(strip_tags($this->description));
    	$this->relatedTo = htmlspecialchars(strip_tags($this->relatedTo));

    	//bind values
    	$stmt->bindParam(":subject", $this->subject);
    	$stmt->bindParam(":phoneNum", $this->phoneNum);
    	$stmt->bindParam(":description", $this->description);
    	$stmt->bindParam(":relatedTo", $this->relatedTo);
    	$stmt->bindParam(":createdAt", $this->createdAt);

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
 
	    // select all query
	    $query = "SELECT 
	                callsID, subject, phoneNum, createdAt, updatedAt, description, relatedTo 
	            FROM 
	                " . $this->table_name . "
	            ORDER BY 
	                callsID DESC";
	 
	    // prepare query statement
	    $stmt = $this->conn->prepare( $query );
	     
	    // execute query
	    $stmt->execute();
	     
	    return $stmt;
	}

	// used when filling up the update product form
	function readOne(){
	     
	    // query to read single record
	    $query = "SELECT 
	                subject, phoneNum, description, relatedTo  
	            FROM 
	                " . $this->table_name . "
	            WHERE 
	                callsID = ? 
	            LIMIT 
	                0,1";
	 
	    // prepare query statement
	    $stmt = $this->conn->prepare( $query );
	     
	    // bind id of calls to be updated
	    $stmt->bindParam(1, $this->callsID);
	     
	    // execute query
	    $stmt->execute();
	 
	    // get retrieved row
	    $row = $stmt->fetch(PDO::FETCH_ASSOC);
	     
	    // set values to object properties
	    $this->subject = $row['subject'];
	    $this->phoneNum = $row['phoneNum'];
	    $this->description = $row['description'];
	    $this->relatedTo = $row['relatedTo'];
	}

	// update the calls
	function update(){
	 
	    // update query
	    $query = "UPDATE 
	                " . $this->table_name . "
	            SET 
	                subject=:subject,
    				phoneNum=:phoneNum,
    				description=:description,
    				relatedTo=:relatedTo,
    				updatedAt=:updatedAt 
	            WHERE
	                callsID=:callsID";
	 
	    // prepare query statement
	    $stmt = $this->conn->prepare($query);
	 
	    //posted values
    	$this->subject = htmlspecialchars(strip_tags($this->subject));
    	$this->phoneNum = htmlspecialchars(strip_tags($this->phoneNum));
    	$this->description = htmlspecialchars(strip_tags($this->description));
    	$this->relatedTo = htmlspecialchars(strip_tags($this->relatedTo));

    	//bind values
    	$stmt->bindParam(":subject", $this->subject);
    	$stmt->bindParam(":phoneNum", $this->phoneNum);
    	$stmt->bindParam(":description", $this->description);
    	$stmt->bindParam(":relatedTo", $this->relatedTo);
    	$stmt->bindParam(":updatedAt", $this->updatedAt);
    	$stmt->bindParam(':callsID', $this->callsID);
	     
	    // execute the query
	    if($stmt->execute()){
	        return true;
	    }else{
	        return false;
	    }
	}

	function delete(){
		$query = "DELETE FROM " . $this->table_name . 
				 " WHERE callsID = ?";
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(1, $this->callsID);

		if($stmt->execute()){
			return true;
		}
		else{
			return false;
		}
	}
}
?>
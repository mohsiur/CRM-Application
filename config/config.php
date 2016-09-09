<?php

	include_once '../db/conn.php';

	$database = new Database();
	$conn = $database->getConnection();

	$sql = "CREATE TABLE IF NOT EXISTS calls(
	callsID		int(10) unsigned NOT NULL AUTO_INCREMENT,
	subject		varchar(255) NOT NULL,
	phoneNum	int(10) unsigned NOT NULL,
	createdAt	timestamp NULL DEFAULT NULL,
	updatedAt	timestamp NULL DEFAULT NULL,
	description	text COLLATE utf8_unicode_ci NOT NULL,
	relatedTo	int(10) unsigned NULL,
	contactID	int(10) unsigned NULL,
	PRIMARY KEY (callsID)
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table MyGuests created successfully";
	} else {
	    echo "Error creating table: " . $conn->error;
	}

	$conn->close();


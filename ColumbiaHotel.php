<!DOCTYPE html>
	<html>
		<head>
		<meta charset = "utf-8">
	<title>Columbia Hotel</title>
</head>
<body>

<?php
$conn = mysqli_connect('localhost', 'root', '');
if($conn){
  echo "<p>Connection set up successfully.</p>";
mysqli_query($conn, "DROP DATABASE IF EXISTS hotelDB");
if (mysqli_query($conn, "CREATE DATABASE hotelDB"))
	echo "<p>Database created successfully.</p>";
mysqli_select_db($conn, "hotelDB");

//room type table
$myStatement = "CREATE TABLE room_type
(
	room_type_id INT NOT NULL  AUTO_INCREMENT,
	room_type_name VARCHAR(100) NULL,
	total_room INT DEFAULT 5 NULL,
	CONSTRAINT pk_room_type PRIMARY KEY (room_type_id)	
); 
";
if(mysqli_query($conn, $myStatement))
	echo "<p>Room type table created successfully.</p>";
	
//customer table
$myStatement = "CREATE TABLE customer 
(
	customer_id INT NOT NULL AUTO_INCREMENT,
	first_name VARCHAR(120) NULL,
	last_name VARCHAR(120) NULL,
	street_address VARCHAR(120) NULL,
	city VARCHAR(120) NULL,
	state VARCHAR(120) NULL,
	zipcode INT NOT NULL,
	CONSTRAINT pk_customer PRIMARY KEY(customer_id)

); ";
if(mysqli_query($conn, $myStatement))
	echo "<p>Customer table created successfully.</p>";
	
//reservation table

$myStatement = "CREATE TABLE reservation 
(
	reservation_id INT NOT NULL AUTO_INCREMENT,
	customer_id INT NOT NULL,
	room_type_id INT NOT NULL,
	checkin_date DATE NOT NULL,
	checkout_date DATE NOT NULL,
	confirm_number CHAR(13) NULL,
	CONSTRAINT pk_reservation PRIMARY KEY(reservation_id),
	CONSTRAINT fk_reservation_room_type FOREIGN KEY(room_type_id) REFERENCES room_type(room_type_id),
	CONSTRAINT fk_reservation_customer FOREIGN KEY(customer_id) REFERENCES customer(customer_id)	
); ";
if(mysqli_query($conn, $myStatement))
	echo "<p>Reservation table created successfully.</p>";
else
	echo "<p>table create failed</p>";
	
	//manager table
$myStatement = "CREATE TABLE manager
(
	manager_id INT NOT NULL AUTO_INCREMENT,
	username VARCHAR(120)  NOT NULL,
	password VARCHAR(120)  NOT NULL,
	CONSTRAINT pk_manager PRIMARY KEY(manager_id)
); ";
if(mysqli_query($conn, $myStatement))
	echo"<p>Manager table created successfully.</p>";
else	
	echo "<p>Table not created.</p>";
	
}	

mysqli_close($conn);
	
?>
</body>
</html>
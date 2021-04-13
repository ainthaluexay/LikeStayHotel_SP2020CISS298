<?php
INCLUDE ("DBConn.php");
connDB();
$statement = "
INSERT INTO customer (first_name, last_name, street_address, city, state, zipcode) VALUES ('Michael', 'Williams', '1999 Planters Lane', 'Jefferson City', 'MO', '65101');
INSERT INTO customer (first_name, last_name, street_address, city, state, zipcode) VALUES ('Holly', 'Scott', '2152 Flower Street', 'Scranton', 'PA', '62399');
INSERT INTO customer (first_name, last_name, street_address, city, state, zipcode) VALUES ('Joan', 'Huggins', '6791 Ocean Ave', 'Santa Clara', 'CA', '64101');";


if (mysqli_multi_query($mysqli, $statement))
	echo "<p>Rows inserted successfully.</p>";
else
	echo "<p>Something went wrong.</p>";

mysqli_close($mysqli);
?>

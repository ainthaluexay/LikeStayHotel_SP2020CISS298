<?php
INCLUDE ("DBConn.php");
connDB();
$statement = "
INSERT INTO manager (username, password) VALUES ('hotelManager', '20Columbia20');";


if(mysqli_query($mysqli, $statement))
	echo "<p>Rows inserted successfully</p>";
else 
	echo "<p>Something went wrong.</p>";
mysqli_close($mysqli);
?>

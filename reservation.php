<?php
INCLUDE ("DBConn.php");
connDB();
$statement = "
INSERT INTO reservation (customer_id, room_type_id, checkin_date, checkout_date, confirm_number) VALUES ('1', '1', '2020-03-21', '2020-03-29', '445566');
INSERT INTO reservation (customer_id, room_type_id, checkin_date, checkout_date, confirm_number) VALUES ('2', '2', '2020-04-05', '2020-04-11', '334455');
INSERT INTO reservation (customer_id, room_type_id, checkin_date, checkout_date, confirm_number) VALUES ('3', '3', '2020-04-18', '2020-05-03', '112233');";


if (mysqli_multi_query($mysqli, $statement))
	echo "<p>Rows inserted successfully.</p>";
else
	echo "<p>Something went wrong.</p>";

mysqli_close($mysqli);
?>

<?php
$page_title = "Reservation";
include ("header.inc");
?>
<!-- Page Unique Content -->
<div id = "main">
<?php
session_start();
	if(isset($_SESSION['availability']))
	echo $_SESSION['availability'];
	?>
<form action = "" method = "post">
<p>
	<label for = "checkInDate">Pick Check In Date:</label>
	<input type = "text" id = "checkInDate" name = "checkInDate" size = "10">
	</p>
<p>
	<label for = "checkOutDate">Pick Check Out Date:</label>
	<input type = "text" id = "checkOutDate" name = "checkOutDate" size = "10">
	</p>
<p>
	<label for = "roomType">Pick Room Type:</label>
	<select name = "roomType">
	<option value = "Single">Single</option>
	<option value = "Double">Double</option>
	<option value = "Family">Family</option>
	</select>
	</p>
<p>	
	<input type = "submit" name = "submit" value = "Make Reservation">
	</p>
</form>

<?php	
if (isset($_POST['submit']))
{
	//connect to server
	INCLUDE ("DBConn.php");
	connDb();
	$checkInDate = $_POST['checkInDate'];
	$checkOutDate = $_POST['checkOutDate'];
	$roomType = $_POST['roomType'];
	$confirmNumber = uniqid();
	//nedd room type id
	$idstatement = "SELECT room_type_id, total_room FROM room_type WHERE room_type_name = '$roomType'";
	if ($result = mysqli_query($mysqli, $idstatement)) 
	{
		while ($row = mysqli_fetch_object($result))
	{
		$roomTypeId = $row->room_type_id;
		$noOfRoom = $row->total_room;
	}
}
//find out how many rooms are not available
$statement = "SELECT COUNT(*) AS roomReserved FROM reservation WHERE room_type_id = '$roomTypeId' AND (checkin_date <='$checkInDate' AND checkout_date >='$checkOutDate' OR checkin_dateDate > '$checkInDate' AND checkout_date < '$checkOutDate') ";
if ($result = mysqli_query($mysqli, $statement))
	{
	while ($row = mysqli_fetch_object($result))
	{
		$roomTaken = $row->roomReserved;
	}
}
$available = $noOfRoom - $roomTaken;
//insert reservation
if ($available > 0) {
	$insertStatement  = "INSERT INTO reservation (room_type_id, checkin_date, checkout_date, confirm_number) VALUES ('$roomTypeId', '$checkInDate', '$checkOutDate', '$confirmNumber')";
	if (mysqli_query($mysqli, $insertStatement))
	echo "<p>Reservation success. Your confirmation number is $confirmNumber</p>";
} else {
	echo "<p>Sorry, those dates are unavailable. Please select a different date or try a different room type.</p>";
}
mysqli_close($mysqli);
}
?>

</div>
<?php
INCLUDE ("footer.inc");
?>


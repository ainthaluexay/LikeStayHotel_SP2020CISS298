<?php
session_start();
if (isset($_POST['submit']))
{
	INCLUDE ("DBConn.php");
	connDB();
	$checkInDate = $_POST['checkin'];
	$checkOutDate = $_POST['checkout'];
	$roomType = $_POST['roomtype'];
	$statement = "SELECT room_type_id, total_room FROM room_type WHERE room_type_name = '$roomType'";
	if ($result = mysqli_query($mysqli, $statement))
	{
		while ($row = mysqli_fetch_object($result))
		{
			$roomTypeId = $row->room_type_id;
			$noOfRoom = $row->total_room;
		}
	}
	
	//find out how many rooms are not available
	$statement = "SELECT COUNT(*) AS roomReserved FROM reservation
	WHERE room_type_id = '$roomTypeId'
	AND (checkin_date <='$checkInDate' 
	AND checkout_date > '$checkInDate' 
	OR checkin_date < '$checkOutDate' 
	AND checkout_date >= '$checkOutDate' 
	OR checkin_date >'$checkInDate' 
	AND checkout_date < '$checkOutDate') ";
	
	if ($result = mysqli_query($mysqli, $statement))
	{
		while ($row = mysqli_fetch_object($result))
		{
			$roomTaken = $row->roomReserved;
		}
	}
	$available = $noOfRoom - $roomTaken;
	
	if ($available > 0){
		$_SESSION['availability'] = "This room is available. Reserve your room now.";
	} else{
		$_SESSION['availability'] = "This room is not available. Please select a different date or room type to reserve your choice.";
	}
	header("Location: reservation.php");
	
	mysqli_close($mysqli);	
}
?>
<aside>
<form action = "checkAvailability.php" method = "post">
<label for = "checkin">Check In:</label>
<input type = "text" id = "checkin" name = "checkin">
<label for = "checkout">Check Out:</label>
<input type = "text" id = "checkout" name = "checkout">
<label for = "roomtype">Room Type:</label>
<select id = "roomtype" name = "roomtype">
	<option value = "single">Single Room</option>
	<option value = "double">Double Room</option>
	<option value = "family">Family Room</option>
</select>
<input type = "submit" name = "submit" value = "Check Availability">
</form>
</aside>
<footer>
<span>Copyright &copy; Like Stay Hotel 2000-<?php echo date("Y"); ?> </span>
	<div id = "socialgroup">
		<img class = "social" src = "facebook.png">
		<img class = "social" src = "linkedin.png">
		<img class = "social" src = "twitter.png">
		<img class = "social" src = "instagram.png">
		</div>
</footer>
<script src = "https://code.jquery.com-1.12.4.js"></script>
<script src = "https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src = "calendar.js"></script>
</body>
</html>
	
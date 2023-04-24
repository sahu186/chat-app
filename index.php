<!DOCTYPE html>
<html>
<head>
	<title>Chatbot Example</title>
</head>
<body>
	<h1>Chatbot Example</h1>
	<form method="POST">
		<label for="message">Enter your message:</label><br>
		<input type="text" id="message" name="message"><br><br>
		<input type="submit" name="submit" value="Send">
	</form>
	<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chatbot";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if user has submitted a message
if (isset($_POST['submit'])) {
	// Get user message
	$message = mysqli_real_escape_string($conn, $_POST['message']);
	
	// Query database for matching response
	$sql = "SELECT response FROM responses WHERE keyword LIKE '%$message%'";
	$result = mysqli_query($conn, $sql);
	
	// If a response is found, output it. Otherwise, output a default message.
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		$response = $row["response"];
	} else {
		$response = "I'm sorry, I don't understand.";
	}
	
	// Output response
	echo "<p><strong>You:</strong> $message</p>";
	echo "<p><strong>Chatbot:</strong> $response</p>";
}

// Close database connection
mysqli_close($conn);
?>

</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mysite";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$surname = $_POST['surname'];
$fname = $_POST['fname'];
$address = $_POST['address'];
$number = $_POST['number'];
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare and bind
$sql = $conn->prepare("INSERT INTO cbtreg(surname, firstname, address, number, email, password) VALUES (?, ?, ?, ?, ?, ?)");
$sql->bind_param("ssssss", $surname, $fname, $address, $number, $email, $password);

// Execute and redirect
if ($sql->execute()) {
    $last_id = $conn->insert_id;
    // Redirect to jamb.php
    header("Location: jamb.php");
    exit();
} else {
    echo "Error: " . $sql->error;
}

$sql->close();
$conn->close();
?>

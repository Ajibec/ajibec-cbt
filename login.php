<?php
session_start();

// Database connection parameters
$servername="localhost";
$username="root";
$password="";
$dbname="mysite";

// Create database connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// When form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"] ?? '');
    $password = trim($_POST["password"] ?? '');

    // Basic validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } else {
        // Prepare SQL statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM cbtreg WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password); // Note: For real apps, passwords should be hashed

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            // User found - optionally start a session
            $_SESSION["email"] = $email;

            // Redirect to jamb.php
            header("Location: subject.html");
            exit();
        } else {
            $error = "Invalid email or password.";
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
	<style type="text/css">
	.back{
		background-color: blue;
	}
	body{
		background-color:cyan;
	}
	</style>
</head>
<body>
<div class="back">
    <h2>Login Form</h2>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post" action="">
        <label>Email: <input type="email" name="email" required></label><br><br>
        <label>Password: <input type="password" name="password" required></label><br><br>
        <input type="submit" value="Login">
    </form>
	</div>
</body>
</html>
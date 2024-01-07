<?php
$db_hostname = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'users';

$mysqli = new mysqli($db_hostname, $db_username, $db_password, $db_name);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
<?php
$registration_success = false;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Perform basic input validation (you should enhance this)
    if (empty($username) || empty($email) || empty($password)) {
        echo "All fields are required.";
    } else {
        // Insert user data into the database (you should also handle potential errors)
        $sql = "INSERT INTO user (username, email, password) VALUES (?, ?, ?)";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sss", $username, $email, $password); // No hashing
            if ($stmt->execute()) {
                // Registration successful
                $registration_success = true;
            } else {
                echo "Registration failed. Please try again later.";
            }
            $stmt->close();
        } else {
            echo "Registration failed. Please try again later.";
        }
    }
}

// Close the database connection
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="registration-confirmation-container">
        <?php if ($registration_success) { ?>
            <h2>Registration Successful</h2>
            <p>Your account has been created successfully.</p>
            <a href="index.php" class="login-button">Go to Login</a>
        <?php } else { ?>
            <h2>Registration Failed</h2>
            <p>There was an issue with your registration. Please try again.</p>
        <?php } ?>
    </div>
</body>
</html>

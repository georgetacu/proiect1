<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Connect to the database
    $mysqli = new mysqli("localhost", "root", "", "users");


    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Perform user authentication
    $sql = "SELECT id, username, password FROM user WHERE username = ? AND password = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $_SESSION["user"] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "Invalid username or password.";
    }

    $stmt->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Result</title>
    <link rel="stylesheet" type="text/css" href="styles.css">

</head>
<body>
    <?php if (isset($error_message)) echo "<p>{$error_message}</p>"; ?>
</body>
</html>


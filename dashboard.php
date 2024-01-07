<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    
    <link rel="stylesheet" type="text/css" href="styles.css">


</head>
<body>
    <h2>Welcome, <?php echo $_SESSION["user"]; ?>!</h2>
    <p>This is your dashboard.</p>
    <a href="logout.php">Logout</a>
</body>
</html>

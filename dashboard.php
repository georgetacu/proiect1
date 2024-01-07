<?php
session_start();

// Simulated car data (you would fetch this from a database in a real application)
$carListings = [
    [
        'make' => 'Toyota',
        'model' => 'Camry',
        'year' => 2020,
        'price' => 25000,
        'category' => 'Sedan',
    ],
    [
        'make' => 'Ford',
        'model' => 'Explorer',
        'year' => 2019,
        'price' => 35000,
        'category' => 'SUV',
    ],
    // Add more car listings here
];

// Check if the user is logged in
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Marketplace Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Welcome, <?php echo $_SESSION["user"]; ?>!</h1>
        <a href="logout.php">Logout</a>
    </header>

    <nav>
        <ul>
            <li><a href="#">All Cars</a></li>
            <li><a href="#">SUVs</a></li>
            <li><a href="#">Sedans</a></li>
            <!-- Add more category links here -->
        </ul>
    </nav>

    <section class="car-listings">
        <h2>Car Listings</h2>
        <ul>
            <?php foreach ($carListings as $car) { ?>
                <li>
                    <div class="car-info">
                        <h3><?php echo $car['make'] . ' ' . $car['model']; ?></h3>
                        <p>Year: <?php echo $car['year']; ?></p>
                        <p>Price: $<?php echo number_format($car['price'], 2); ?></p>
                        <p>Category: <?php echo $car['category']; ?></p>
                    </div>
                    <button>View Details</button>
                </li>
            <?php } ?>
        </ul>
    </section>
</body>
</html>
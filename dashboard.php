<?php
// Conexiune la baza de date (asigură-te că ai setat datele de conectare corecte)
$mysqli = new mysqli("localhost", "root", "", "users");

// Verifică conexiunea
if ($mysqli->connect_error) {
    die("Conexiunea la baza de date a eșuat: " . $mysqli->connect_error);
}

// Interogare pentru a prelua datele din tabela "cars"
$sql = "SELECT * FROM cars";
$result = $mysqli->query($sql);

// Verifică dacă există rezultate
if ($result->num_rows > 0) {
    $carListings = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $carListings = [];
}

// Închide conexiunea la baza de date
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Marketplace Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="cars.css">
    
    
   
</head>
<header>
    <button onclick="location.href='logout.php';">Log Out</button>  
    <h2>Car Listings</h2>
</header>
<body>

    <!-- Restul codului HTML așa cum ai avut înainte -->
    <!-- ... -->
    <section class="car-listings">
 
        <?php foreach ($carListings as $car) { ?>
            <div class="car-item">
                <div class="car-image">
                    <img src="images/<?php echo $car['photo']; ?>" alt="<?php echo $car['make']; ?>">
                </div>
                <div class="car-info">
                    
                    <p>Year: <?php echo $car['year']; ?></p>
                    <p>Price: $<?php echo number_format($car['price'], 2); ?></p>
                    <p>Category: <?php echo $car['category']; ?></p>
                </div>
                <button>View Details</button>
            </div>
        <?php } ?>
    </section>
</body>

</html>

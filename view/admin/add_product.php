<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/product.style.css">
</head>

<body>
    

    <!-- <header>
        <nav class="navbar navbar-expand-lg navbar-custom">
            <a class="navbar-brand" href="home.php">Cafeteria</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="home.php">HOME</a></li>
                    <li class="nav-item"><a class="nav-link" href="products.php">PRODUCTS</a></li>
                    <li class="nav-item"><a class="nav-link" href="users.php">USERS</a></li>
                    <li class="nav-item"><a class="nav-link" href="manual_orders.php">MANUAL ORDERS</a></li>
                    <li class="nav-item"><a class="nav-link" href="checks.php">CHECKS</a></li>
                </ul>
                <div class="navbar-text"> -->
                    <?php
                    session_start();

                    require("../layout/adminHeader.php");
                    require("../../module/DBconection.php");
                     $DB = new db();

                    $adminSql = "SELECT Name, Picture FROM Users WHERE Role = 'Admin'";
                    $adminStmt = $DB->get_connection()->prepare($adminSql);
                    $adminStmt->execute();
                    $admin = $adminStmt->fetch(PDO::FETCH_ASSOC);

                    // if ($admin) {
                    //     echo "<img src='" . $admin['Picture'] . "' alt='Admin Profile Picture' class='img-fluid rounded-circle' style='width: 40px; height: 40px;'>";
                    //     echo "<span class='ml-2'>" . $admin['Name'] . "</span>";
                    // } else {
                    //     echo "No admin found";
                    // }
                    ?>
                <!-- </div>
            </div>
        </nav>
    </header> -->
    <main class="container mt-5">
        <h1 class="text-center mb-4">Add Product</h1>

        <form method="post" action="" enctype="multipart/form-data" class="p-4 bg-light rounded shadow-sm">
    <div class="form-group">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" name="price" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="category">Category:</label>
        <input type="text" name="category" class="form-control">
    </div>

    <div class="form-group">
        <label for="product_image">Product Image:</label>
        <input type="file" name="product_image" class="form-control-file" required>
    </div>

    <button type="submit" class="btn btn-custom btn-sm mb-2 mr-2">Save</button>
    <button type="reset" class="btn btn-custom btn-sm mb-2 mr-2">Reset</button>
</form>

        <?php
        // Include database connection
        // require_once 'database.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get form data
            $productName = $_POST['product_name'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $productImage = $_FILES['product_image']['tmp_name'];

            // Create uploads directory if it doesn't exist
            $targetDir = "../../assets/";
            // if (!file_exists($targetDir)) {
            //     mkdir($targetDir, 0777, true);
            // }

            // Handle image upload
            $targetFile = $targetDir . basename($_FILES['product_image']['name']);
            if (move_uploaded_file($productImage, $targetFile)) {
                // Image uploaded successfully

                // Insert product data into the database
                try {
                    $sql = "INSERT INTO Products (Name, Price, Category, Picture) VALUES (:name, :price, :category, :picture)";
                    $stmt = $DB->get_connection()->prepare($sql);
                    $stmt->bindParam(':name', $productName);
                    $stmt->bindParam(':price', $price);
                    $stmt->bindParam(':category', $category);
                    $stmt->bindParam(':picture', $targetFile);
                    $stmt->execute();

                    // Redirect back to the index page with a success message
                    header('Location: allProduct.php?success=Product added successfully');
                    exit();
                } catch (PDOException $e) {
                    // Handle insert failure
                    echo 'Error adding product: ' . $e->getMessage();
                }
            } else {
                // Handle image upload failure
                echo 'Error uploading image: ' . upload_error_msg($_FILES['product_image']['error']);
            }
        }
        ?>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
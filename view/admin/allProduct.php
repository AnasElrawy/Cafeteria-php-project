<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafeteria - Product Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/product.style.css">
</head>

<body>
    <header>
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
                <div class="navbar-text">
                    <?php

                    require("../../module/DBconection.php");
                    $DB = new db();
                    $adminSql = "SELECT Name, Picture FROM Users WHERE Role = 'Admin'";
                    $adminStmt = $DB->get_connection()->prepare($adminSql);
                    $adminStmt->execute();
                    $admin = $adminStmt->fetch(PDO::FETCH_ASSOC);

                    if ($admin) {
                        echo "<img src='" . $admin['Picture'] . "' alt='Admin Profile Picture' class='img-fluid rounded-circle' style='width: 40px; height: 40px;'>";
                        echo "<span class='ml-2'>" . $admin['Name'] . "</span>";
                    } else {
                        echo "No admin found";
                    }
                    ?>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-4">
        <h1 class="mb-4">Product Management</h1>

        <a href="add_product.php" class="btn btn-custom mb-4">Add Product</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>PRODUCT NAME</th>
                    <th>CATEGORY</th>
                    <th>PRICE (EGP)</th>
                    <th>IMAGE</th>
                    <th>STATUS</th>
                    <th>CONTROLLERS</th>
                </tr>
            </thead>
            <tbody>
                <?php


                $sql = "SELECT * FROM Products";

                try {
                    $stmt = $DB->get_connection()->prepare($sql);
                    $stmt->execute();

                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . $row["Product_ID"] . "</td>";
                            echo "<td>" . $row["Name"] . "</td>";
                            echo "<td>" . $row["Category"] . "</td>";
                            echo "<td>" . $row["Price"] . "</td>";
                            echo "<td><img src='" . $row["Picture"] . "' alt='" . $row["Name"] . "' class='img-fluid' style='width: 100px;'></td>";
                            echo "<td>" . $row["Status"] . "</td>";
                            echo "<td>";
                            echo "<a href='EditProd.php?id=" . $row["Product_ID"] . "' class='btn btn-custom btn-sm mb-2 mr-2'>Edit</a>";
                            echo "<form action='../../controller/delete_product.php' method='POST' class='d-inline'>";
                            echo "<input type='hidden' name='product_id' value='" . $row["Product_ID"] . "'>";
                            echo "<button type='submit' class='btn btn-danger btn-sm mb-2'>Delete</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No products found.</td></tr>";
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='7'>Error: " . $e->getMessage() . "</td></tr>";
                }

                $pdo = null;
                ?>
            </tbody>
        </table>
    </main>

    <!-- <footer>
        <nav class="container">
            <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </footer> -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- <script src="script.js"></script> -->
</body>

</html>
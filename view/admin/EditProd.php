<?php
// Include the database connection file

require("../../module/DBconection.php");
$DB = new db();
// $connection = $DB->get_connection();

// Get the product ID from the URL
$productId = $_GET['id'];

// Fetch the product data
$sql = "SELECT * FROM Products WHERE Product_ID = :id";
$stmt = $DB->get_connection()->prepare($sql);
$stmt->bindParam(':id', $productId);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle form submission (if the edit form is submitted)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update product data
    $updatedName = $_POST['name'];
    $updatedCategory = $_POST['category'];
    $updatedPrice = $_POST['price'];
    $updatedStatus = $_POST['status'];

    $updateSql = "UPDATE Products SET Name = :name, Category = :category, Price = :price, Status = :status WHERE Product_ID = :id";
    $updateStmt = $DB->get_connection()->prepare($updateSql);
    $updateStmt->bindParam(':name', $updatedName);
    $updateStmt->bindParam(':category', $updatedCategory);
    $updateStmt->bindParam(':price', $updatedPrice);
    $updateStmt->bindParam(':status', $updatedStatus);
    $updateStmt->bindParam(':id', $productId);

    if ($updateStmt->execute()) {
        // Redirect back to the index page
        header('Location: allProduct.php');
        exit();
    } else {
        // Handle update failure
        echo 'Error updating product.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/product.style.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Product</h1>

        <form method="post" action="" class="p-4 bg-light rounded shadow-sm">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($product['Name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" name="category" class="form-control" value="<?php echo htmlspecialchars($product['Category']); ?>" required>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" name="price" class="form-control" value="<?php echo htmlspecialchars($product['Price']); ?>" required>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" class="form-control">
                    <option value="available" <?php if ($product['Status'] === 'available') echo 'selected'; ?>>Available</option>
                    <option value="unavailable" <?php if ($product['Status'] === 'unavailable') echo 'selected'; ?>>Unavailable</option>
                </select>
            </div>

            <button type="submit" class="btn btn-custom btn-block mt-4">Save Changes</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
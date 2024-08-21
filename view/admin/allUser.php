
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add User</title>
        <!-- <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css"> -->
        
        <link rel="stylesheet" href="../css/allIUser.style.css"> 

    </head>
    <body>
    </body>
    </html>


    <nav class="navbar navbar-expand-lg d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a class="navbar-brand" href="homeUser.php">CAFETERIA</a>
            <a class="nav-link" href="http://localhost/proj_php/view/admin/orderByAdmain.php">Home</a>
            <a class="nav-link" href="http://localhost/proj_php/view/admin/allOrders.php?page-nr=1">Orders</a>
            <a class="nav-link" href="#lamiaa">Products</a>
            <a class="nav-link" href="#lamiaa">Add Products</a>
            <a class="nav-link" href="http://localhost/proj_php/view/admin/allUser.php">Users</a>
            <a class="nav-link" href="http://localhost/proj_php/view/admin/register.php">Add Users</a>
            <a class="nav-link" href="http://localhost/proj_php/view/admin/orderByAdmain.php">Manual Orders</a>
            <a class="nav-link" href="#Hadeer">Checks</a>
        </div>
        <div class="d-flex align-items-center">
            <a class="nav-link" href="../logout.php">Log Out</a>
            <span class="navbar-text"><?php echo $_SESSION['Name'];?></span>
            <img src="assets/user.jpg" alt="User" class="user-picture">
        </div>
    </nav>


    <?php

    
    // include ("../layout/adminHeader.php");

    require("../../module/DBconection.php");

    $DB = new db();

    

    try {
        // $DB = new db();
        // $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
    ?>

    <br>
    <h2 style="text-align:center;">All Users</h2>
    <br>
    <a href="register.php" class="button" style="position: absolute; top:210px; left: 490px;">Add User</a>
    <br>

    <table class="table" style="position: absolute; top: 320px; left: 110px; width:80%">
    <body>
    

    <h2 class="text-center mt-4">All Users</h2>
    <a href="register.php" class="button">Add User</a>

    <table class="table table-striped mx-auto" style="width:80%">
        <thead class="table-light">
            <tr>
                <th>User_ID</th>
                <th>Name</th>
                <th>Room_Number</th>
                <th>Picture</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {
                $connection = $DB->get_connection();
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $dataAll = $connection->query("SELECT User_ID, Name, Room_Number, Picture FROM Users");
                $data = $dataAll->fetchAll(PDO::FETCH_ASSOC);

                foreach ($data as $row) {
                    echo "<tr>"; 
                    foreach ($row as $key => $value) {
                        if ($key == 'Picture') {
                            $imagePath = "../../uploads/" . basename($value); 
                            echo "<td><img src='$imagePath' alt='Profile Picture' style='width: 50px; height: 50px;'></td>";
                        } else {
                            echo "<td>" . htmlspecialchars($value) . "</td>"; 
                        }
                    }
                    echo "<td>
                    <a href=\"EditUser.php?id={$row['User_ID']}\" class='btn btn-warning btn-sm'>Edit</a>
                    <a href=\"javascript:void(0);\" onclick=\"confirmDelete({$row['User_ID']});\" class='btn btn-danger btn-sm ml-2'>Delete</a>
                </td>";
                echo "</tr>";
                }
            } catch (PDOException $e) {
                echo 'Query failed: ' . $e->getMessage();
            }
            ?>
        </tbody>
    </table>

    <script>
        function confirmDelete(userId) {
            if (confirm("Are you sure you want to delete this user?")) {
                window.location.href = "../../controller/DeleteUser.php?id=" + userId;
            }
        }
    </script>

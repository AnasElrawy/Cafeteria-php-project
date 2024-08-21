<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
$targetDir = '../../uploads/';
$targetFile = $targetDir . basename($_FILES["profile_image"]["name"]);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && 
    isset($_POST['Name'], $_POST['Email'], $_POST['Password'], 
          $_POST['Room_Number'], $_FILES['profile_image'], $_POST['Role'])) {


            // echo "in regester";

            $target_dir = "../../uploads/";
            $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);

            echo $target_file;
            // echo $_FILES["profile_image"]["tmp_name"];
            move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file);


            require("../../module/DBconection.php");
            require("../../controller/insertUser.php");



            // if($_FILES["profile_image"]["name"]){

             
            // }



    // $resource = fopen('file.txt', 'a');
    // if (is_resource($resource)) {
    //     if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == UPLOAD_ERR_OK) {
    //         if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetFile)) {
    //             fwrite($resource, 
    //                 $_POST['Name'] . ',' . 
    //                 $_POST['Email'] . ',' . 
    //                 $_POST['Password'] . ',' . 
    //                 $_POST['Room_Number'] . ',' . 
    //                 $targetFile . ',' . 
    //                 $_POST['Role'] . "\n"
    //             );
    //             fclose($resource);
    //         } else {
    //             echo "Error moving the uploaded file.";
    //         }
    //     } else {
    //         echo "Error uploading file: " . (isset($_FILES['profile_image']) ? $_FILES['profile_image']['error'] : 'File not selected');
    //     }
    // } else {
    //     echo 'Invalid filename'
    //     ;
    // }
}  else {
    include("../layout/regesterForm.html");
}

?>

<script>
        function validatePassword() {
            var password = document.getElementById("Password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;

            if (password != confirmPassword) {
                alert("Passwords do not match. Please try again.");
                return false; 
            }
            return true; 
        }

        function togglePasswordVisibility() {
    var passwordField = document.getElementById("Password");
    var confirmPasswordField = document.getElementById("confirmPassword");

    if (passwordField.type === "password" || confirmPasswordField.type === "password") {
        passwordField.type = "text";
        confirmPasswordField.type = "text";
    } else {
        passwordField.type = "password";
        confirmPasswordField.type = "password";
    }
}
    </script>

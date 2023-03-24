<?php
session_start();
require_once('config.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Manager</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="registration.css">
</head>

<body>
<div>
    <?php
    if (isset($_POST["create"])) {

        // Take previous user ID
        $user = $_SESSION['user'];
        $user_id = $user["user_id"];

        $age = $_POST['age'];
        $description = $_POST['description'];
        $gender = $_POST['gender'];
        $profile_picture_link = $_POST['profile_picture_link'];


        // create INSERT statement
        $sql = "INSERT INTO manager_profile_t (user_id, age, description, gender, profile_picture_link) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if (!$stmt->execute([$user_id, $age, $description, $gender, $profile_picture_link])) {
            echo "Error: " . $stmt->errorInfo()[2];
            exit();
        }

        echo "New manager created successfully with user ID: " . $user_id;

        // close connection
        $pdo = null;
        echo "<script>window.location.href='Gladiator_Bowl_Home.php';</script>";

    }
    ?>
</div>

<div class="logoBox">
    <img class="logo" src="images/2023-03-20%20(1).png" alt="test logo">
</div>
<div>
    <form action="registration_manager.php" method="post">
        <div class="container">
            <div class="row">
                <div class="col-5.5">

                    <h1>Manager Registration</h1>
                    <p>Please Enter Your Manager Account Details</p>
                    <hr class="mb-2">

                    <label for="age"><b> Age</b></label>
                    <input class="form-control" type="number" name="age" required>

                    <label for="description"><b>Description</b></label>
                    <input class="form-control" type="text" name="description">

                    <label for="gender"><b>Gender:</b></label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>

                    <label for="profile_picture_link"><b>Profile_picture_link</b></label>
                    <input class="form-control" type="text" name="profile_picture_link">

                    <hr class="mb-2">

                    <input class="submit-button" type="submit" name="create" value="Create Account">
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>
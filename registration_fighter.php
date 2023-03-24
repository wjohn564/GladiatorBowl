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
        $gender = $_POST['gender'];
        $style_ = $_POST['style_'];
        $profile_picture_link = $_POST['profile_picture_link'];
        $description = $_POST['description'];
        $medical_history = $_POST['medical_history'];
        $height = $_POST['height'];
        $weight = $_POST['weight'];
        $win = $_POST['win'];
        $draws = $_POST['draws'];
        $loss = $_POST['loss'];



        // create INSERT statement
        $sql = "INSERT INTO fighter_profile_t (user_id, age, gender, style_, profile_picture_link, description, medical_history,
                               height, weight, win, draws, loss) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if (!$stmt->execute([$user_id, $age, $gender, $style_, $profile_picture_link, $description, $medical_history,
            $height, $weight, $win, $draws, $loss])) {
            echo "Error: " . $stmt->errorInfo()[2];
            exit();
        }

        echo "New fighter created successfully with user ID: " . $user_id;

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

                    <label for="gender"><b>Gender:</b></label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>

                    <label for="style_"><b>Style</b></label>
                    <input class="form-control" type="text" name="style_" required>

                    <label for="profile_picture_link"><b>Profile_picture_link</b></label>
                    <input class="form-control" type="text" name="profile_picture_link">

                    <label for="description"><b>Description</b></label>
                    <input class="form-control" type="text" name="description">

                    <label for="medical_history"><b>Medical history</b></label>
                    <input class="form-control" type="text" name="medical_history">

                    <label for="height"><b>Height</b></label>
                    <input class="form-control" type="number" name="height">

                    <label for="weight"><b>Weight</b></label>
                    <input class="form-control" type="number" name="weight">

                    <label for="win"><b>Win</b></label>
                    <input class="form-control" type="number" name="win">

                    <label for="draws"><b>Draws</b></label>
                    <input class="form-control" type="number" name="draws">

                    <label for="loss"><b>Loss</b></label>
                    <input class="form-control" type="number" name="loss">



                    <hr class="mb-2">

                    <input class="submit-button" type="submit" name="create" value="Create Account">
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>
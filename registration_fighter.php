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
        $fighting_style = $_POST['fighting_style'];
        $profile_picture_link = $_POST['profile_picture_link'];
        $fight_videos = $_POST['fight_videos'];
        $description = $_POST['description'];
        $medical_history = $_POST['medical_history'];
        $height = $_POST['height'];
        $weight = $_POST['weight'];
        $wins = $_POST['wins'];
        $draws = $_POST['draws'];
        $losses = $_POST['losses'];



        // create INSERT statement
        $sql = "INSERT INTO fighter_profile_t (user_id, age, gender, fighting_style, profile_picture_link, fight_videos, description, medical_history,
                               height, weight, wins, draws, losses) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        if (!$stmt->execute([$user_id, $age, $gender, $fighting_style, $profile_picture_link, $fight_videos, $description, $medical_history,
            $height, $weight, $wins, $draws, $losses])) {
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
    <form action="registration_fighter.php" method="post">
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
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>

                    <label for="fighting_style"><b>Fighting style</b></label>
                    <select class="form-control" id="fighting_style" name="fighting_style" required>
                        <option value="Striker">Striker</option>
                        <option value="Wrestler">Wrestler</option>
                    </select>

                    <label for="profile_picture_link"><b>Profile_picture_link</b></label>
                    <input class="form-control" type="url" name="profile_picture_link">

                    <label for="fight_videos"><b>Fight video link</b></label>
                    <input class="form-control" type="url" name="fight_videos">

                    <label for="description"><b>Description</b></label>
                    <input class="form-control" type="text" name="description">

                    <label for="medical_history"><b>Medical history</b></label>
                    <input class="form-control" type="text" name="medical_history">

                    <label for="height"><b>Height</b></label>
                    <input class="form-control" type="number" name="height" required>

                    <label for="weight"><b>Weight</b></label>
                    <input class="form-control" type="number" name="weight" required>

                    <label for="wins"><b>Wins</b></label>
                    <input class="form-control" type="number" name="wins" required>

                    <label for="draws"><b>Draws</b></label>
                    <input class="form-control" type="number" name="draws" required>

                    <label for="losses"><b>Losses</b></label>
                    <input class="form-control" type="number" name="losses" required>

                    <hr class="mb-2">

                    <input class="submit-button" type="submit" name="create" value="Create Account">
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>
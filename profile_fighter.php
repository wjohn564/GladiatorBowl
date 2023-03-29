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
    $user_profile = $_SESSION['user_profile'];

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

        if (isset($_SESSION['user_profile']))
        {

            $sql = "UPDATE fighter_profile_t SET age=?, gender=?, fighting_style=?, profile_picture_link=?,
                             fight_videos=?, description=?, medical_history=?,
                             height=?, weight=?, wins=?, draws=?, losses=? WHERE user_id='$user_id'";
            $stmt = $pdo->prepare($sql);

            if (!$stmt->execute([$age, $gender, $fighting_style, $profile_picture_link, $fight_videos, $description, $medical_history,
                $height, $weight, $wins, $draws, $losses])) {
                echo "Error: " . $stmt->errorInfo()[2];
                exit();
            }
        }
        else {

            // create INSERT statement
            $sql = "INSERT INTO fighter_profile_t (user_id, age, gender, fighting_style, profile_picture_link, fight_videos, description, medical_history,
                               height, weight, wins, draws, losses) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);

            if (!$stmt->execute([$user_id, $age, $gender, $fighting_style, $profile_picture_link, $fight_videos, $description, $medical_history,
                $height, $weight, $wins, $draws, $losses])) {
                echo "Error: " . $stmt->errorInfo()[2];
                exit();
            }
        }

        $query = "SELECT * FROM `fighter_profile_t` WHERE user_id = '$user_id'";
        $search_result = filterTable($query);
        $user_profile = mysqli_fetch_array($search_result);
        $_SESSION['user_profile'] = $user_profile;



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
    <form action="profile_fighter.php" method="post">
        <div class="container">
            <div class="row">
                <div class="col-5.5">

                    <h1>Fighter Profile</h1>
                    <p>Please Enter Your Fighter Account Details</p>
                    <hr class="mb-2">

                    <label for="age"><b> Age</b></label>
                    <input class="form-control" type="number" name="age" value="<?php echo $user_profile['age']?>" required>

                    <label for="gender"><b>Gender:</b></label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="Male" <?php if ($user_profile['gender'] == 'Male') echo Selected ?> >Male</option>
                        <option value="Female" <?php if ($user_profile['gender'] == 'Female') echo Selected ?> >Female</option>
                        <option value="Other" <?php if ($user_profile['gender'] == 'Other') echo Selected ?> >Other</option>
                    </select>

                    <label for="fighting_style"><b>Fighting style</b></label>
                    <select class="form-control" id="fighting_style" name="fighting_style" required>
                        <option value="Striker" <?php if ($user_profile['fighting_style'] == 'Striker') echo Selected ?> >Striker</option>
                        <option value="Wrestler" <?php if ($user_profile['fighting_style'] == 'Wrestler') echo Selected ?>>Wrestler</option>
                    </select>

                    <label for="profile_picture_link"><b>Profile_picture_link</b></label>
                    <input class="form-control" type="url" name="profile_picture_link" value="<?php echo $user_profile['profile_picture_link']?>">

                    <label for="fight_videos"><b>Fight video link</b></label>
                    <input class="form-control" type="url" name="fight_videos" value="<?php echo $user_profile['fight_videos']?>">

                    <label for="description"><b>Description</b></label>
                    <input class="form-control" type="text" name="description" value="<?php echo $user_profile['description']?>">

                    <label for="medical_history"><b>Medical history</b></label>
                    <input class="form-control" type="text" name="medical_history" value="<?php echo $user_profile['medical_history']?>">

                    <label for="height"><b>Height</b></label>
                    <input class="form-control" type="number" name="height" value="<?php echo $user_profile['height']?>">

                    <label for="weight"><b>Weight</b></label>
                    <input class="form-control" type="number" name="weight" value="<?php echo $user_profile['weight']?>">

                    <label for="wins"><b>Wins</b></label>
                    <input class="form-control" type="number" name="wins" value="<?php echo $user_profile['wins']?>">

                    <label for="draws"><b>Draws</b></label>
                    <input class="form-control" type="number" name="draws" value="<?php echo $user_profile['draws']?>">

                    <label for="losses"><b>Losses</b></label>
                    <input class="form-control" type="number" name="losses" value="<?php echo $user_profile['losses']?>">

                    <hr class="mb-2">

                    <input class="submit-button" type="submit" name="create" value="<?php if (isset($_SESSION['user_profile'])) echo 'Update Profile'; else echo 'Create Profile';?>">
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>
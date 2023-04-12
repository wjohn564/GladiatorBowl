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
        $email = $user["email"];

        $age = $_POST['age'];
        $description = $_POST['description'];
        $gender = $_POST['gender'];
        $profile_picture_link = $_POST['profile_picture_link'];

        if (isset($_SESSION['user_profile']))
        {
            $sql = "UPDATE manager_profile_t SET age=?, description=?, gender=?, profile_picture_link=? WHERE user_id='$user_id'";
            $stmt = $pdo->prepare($sql);

            if (!$stmt->execute([$age, $description, $gender, $profile_picture_link])) {
                echo "Error: " . $stmt->errorInfo()[2];
                exit();
            }
        }
        else {

            // create INSERT statement
            $sql = "INSERT INTO manager_profile_t (email, user_id, age, description, gender, profile_picture_link) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            if (!$stmt->execute([$email, $user_id, $age, $description, $gender, $profile_picture_link])) {
                echo "Error: " . $stmt->errorInfo()[2];
                exit();
            }
        }

        $query = "SELECT * FROM `manager_profile_t` WHERE user_id = '$user_id'";
        $search_result = filterTable($query);
        $user_profile = mysqli_fetch_array($search_result);
        $_SESSION['user_profile'] = $user_profile;



        echo "New manager created successfully with email: " . $email;

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
    <form action="profile_manager.php" method="post">
        <div class="container">
            <div class="row">
                <div class="col-5.5">

                    <h1>Manager Profile</h1>
                    <p>Please Enter Your Manager Account Details</p>
                    <hr class="mb-2">

                    <label for="age"><b> Age</b></label>
                    <input class="form-control" type="number" name="age" value="<?php echo $user_profile['age']?>" required>

                    <label for="description"><b>Description</b></label>
                    <input class="form-control" type="text" name="description" value="<?php echo $user_profile['description']?>">

                    <label for="gender"><b>Gender:</b></label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="Male" <?php if ($user_profile['gender'] == 'Male') echo Selected ?> >Male</option>
                        <option value="Female" <?php if ($user_profile['gender'] == 'Female') echo Selected ?> >Female</option>
                        <option value="Other" <?php if ($user_profile['gender'] == 'Other') echo Selected ?> >Other</option>
                    </select>

                    <label for="profile_picture_link"><b>Profile_picture_link</b></label>
                    <input class="form-control" type="url" name="profile_picture_link" value="<?php echo $user_profile['profile_picture_link']?>">

                    <hr class="mb-2">

                    <input class="submit-button" type="submit" name="create" value="<?php if (isset($_SESSION['user_profile'])) echo 'Update Profile'; else echo 'Create Profile';?>">
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>
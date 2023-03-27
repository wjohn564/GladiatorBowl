<?php
session_start();
require_once('config.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="registration.css">
</head>

<body>
<div>
    <?php
    if (isset($_POST["create"])) {
        // Generate unique user ID
        $user_id = uniqid();


        $user_type = $_POST['profession'];
        $email = $_POST['email'];
        $first_name = $_POST['firstname'];
        $last_name = $_POST['lastname'];
        $password = sha1($_POST['password']);

        // create INSERT statement
        $sql = "INSERT INTO user_t (user_id, user_type, email, first_name, last_name, password) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if (!$stmt->execute([$user_id, $user_type, $email, $first_name, $last_name, $password])) {
            echo "Error: " . $stmt->errorInfo()[2];
            exit();
        }

        echo "New user created successfully with user ID: " . $user_id;

        // For Session
        $sql = "SELECT * FROM user_t WHERE email = ? AND password = ?";
        $stmt = $pdo->prepare($sql);
        if (!$stmt->execute([$email, $password])) {
            echo "Error: " . $stmt->errorInfo()[2];
            exit();
        }
        $user = $stmt->fetch();
        $_SESSION['user'] = $user;

        // close connection
        $pdo = null;

        switch ($user_type) {
            case "fighter":
                echo "<script>window.location.href='profile_fighter.php';</script>";
                break;
            default:
                echo "<script>window.location.href='profile_manager.php';</script>";
        }


    }
    ?>
</div>

<div class="logoBox">
    <img class="logo" src="images/2023-03-20%20(1).png" alt="test logo">
</div>
<div>
    <form action="registration.php" method="post">
        <div class="container">
            <div class="row">
                <div class="col-5.5">

                    <h1>Registration</h1>
                    <p>Please Enter Your Account Details</p>
                    <hr class="mb-2">

                    <label for="firstname"><b> First Name</b></label>
                    <input class="form-control" type="text" name="firstname" required>

                    <label for="lastname"><b>Last Name</b></label>
                    <input class="form-control" type="text" name="lastname" required>

                    <label for="email"><b>Email</b></label>
                    <input class="form-control" type="email" name="email" required>

                    <label for="password"><b>Password</b></label>
                    <input class="form-control" type="password" name="password" required>

                    <label for="profession"><b>Profession:</b></label>
                    <select class="form-control" id="profession" name="profession" required>
                        <option value="fighter">Fighter</option>
                        <option value="manager">Manager</option>
                    </select>

                    <hr class="mb-2">

                    <input class="submit-button" type="submit" name="create" value="Create Account">
                    <input class="login-button" type="button" value="Login" onclick="window.location.href='login.php'">
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>
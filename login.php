<?php
session_start();
require_once('config.php');
unset($_SESSION['user_profile']);
?>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="login.css">

</head>
<body>
<div>
    <?php
    if (isset($_POST["login"])) {
        $email = $_POST['email'];
        $password = sha1($_POST['password']);


        // create SELECT statement
        $sql = "SELECT * FROM user_t WHERE email = ? AND password = ?";
        $stmt = $pdo->prepare($sql);
        if (!$stmt->execute([$email, $password])) {
            echo "Error: " . $stmt->errorInfo()[2];
            exit();
        }


        $user = $stmt->fetch();
        $_SESSION['user'] = $user;
        if ($user) {

            if ($email == 'admin@access.com') {
                echo "<script>window.location.href='admin.php';</script>";
            } else {
                echo "<script>window.location.href='Gladiator_Bowl_Home.php';</script>";
            }

            // put in session user_profile ( may have issue because of the few first profile create without profile )
            $user_to_search = $user["user_id"];
            switch ($user["user_type"]) {
                case "fighter":
                    $query = "SELECT * FROM `fighter_profile_t` WHERE user_id = '$user_to_search'";
                    break;
                default:
                    $query = "SELECT * FROM `manager_profile_t` WHERE user_id = '$user_to_search'";
            }
            $search_result = filterTable($query);
            $user_profile = mysqli_fetch_array($search_result);
            $_SESSION['user_profile'] = $user_profile;


        } else {

            echo "Invalid email or password.";
        }


        // close connection
        $pdo = null;
    }
    ?>
</div>
<div class="logoBox">
    <img class="logo" src="images/2023-03-20%20(1).png" alt="test logo">
</div>
<div>
    <form action="login.php" method="post">
        <div class="container">
            <div class="row">
                <div class="col-5.5">
                    <h1>Login</h1>
                    <p>Please Enter Your Account Details</p>
                    <hr class="mb-2">

                    <label for="email"><b>Email</b></label>
                    <input class="form-control" type="email" name="email" required>

                    <label for="password"><b>Password</b></label>
                    <input class="form-control" type="password" name="password" required>

                    <hr class="mb-2">

                    <input class="submit-button" type="submit" name="login" value="Log In">
                    <input class="register-button" type="button" value="Register"
                           onclick="window.location.href='registration.php'">

                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>
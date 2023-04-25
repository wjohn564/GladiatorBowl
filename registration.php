<?php
session_start();
require_once('config.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/registration.css">
</head>

<body>

<?php
require_once 'banner.php'
?>
<div>
    <?php
    if (isset($_POST["create"])) {
        // Generate unique user ID
        $user_id = uniqid();


        $user_type = $_POST['profession'];
        $email = $_POST['email'];
        $first_name = $_POST['firstname'];
        $last_name = $_POST['lastname'];
        $password = ($_POST['password']);
        $re_password = ($_POST['password2']);

        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8 || strlen($password) > 50) {
            echo "<div class='alert alert-danger'>Invalid Password. Please try again. Password requires an uppercase, lowercase, 
               number and a special character.</div>";
        } else {
            if ($re_password == $password) {
                $re_password = null;
                $encrypted_password = sha1($password);

                // create INSERT statement
                $sql = "INSERT INTO user_t (user_id, user_type, email, first_name, last_name, password) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                if (!$stmt->execute([$user_id, $user_type, $email, $first_name, $last_name, $encrypted_password])) {
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
                        echo "<script>window.location.href='Gladiator_Bowl_Home.php';</script>";
                        break;
                    case "manager":
                        echo "<script>window.location.href='Gladiator_Bowl_Home.php';</script>";
                        break;
                    default:
                        echo "<script>window.location.href='admin.php';</script>";
                }
            } else {
                echo "<div class='alert alert-danger'>Passwords don't match!</div>";
            }
        }

    }
    ?>
</div>
<div>
    <form action="registration.php" method="post">
        <div class="container">
            <div class="row">
                <div class="col-5.5">

                    <h1>Registration</h1>
                    <p>Please Enter Your Account Details:</p>
                    <hr class="mb-2">

                    <label for="firstname"><b> First Name</b></label>
                    <input class="form-control" type="text" name="firstname" required>

                    <label for="lastname"><b>Last Name</b></label>
                    <input class="form-control" type="text" name="lastname" required>

                    <label for="email"><b>Email</b></label>
                    <input class="form-control" type="email" name="email" required>

                    <label for="password"><b>Password</b></label>
                    <input class="form-control" type="password" name="password" required>

                    <label for="re_password"><b>Re-Enter Password</b></label>
                    <input class="form-control" type="password" name="password2" required>

                    <label for="profession"><b>Profession:</b></label>
                    <select class="form-control" id="profession" name="profession" required>
                        <option value="fighter">Fighter</option>
                        <option value="manager">Manager</option>
                        <option value="admin">Admin (test)</option>
                    </select>

                    <hr class="mb-2">

                    <input class="submit-button" type="submit" name="create" value="Create Account">
                    <input class="login-button" type="button" value="Login" onclick="window.location.href='login.php'">
                </div>
            </div>
        </div>
    </form>
</div>
<?php
require_once 'footer.php';
?>
</body>
</html>
<?php
session_start();
require_once('config.php');
unset($_SESSION['user_profile']);
?>

<?php 

function is_ban($user_id) {

    $sql = "SELECT * FROM banned_t WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute([$user_id])) {
        echo "Error: " . $stmt->errorInfo()[2];
        exit();
    }

    $test = $stmt->fetch();
    if ($test)
        return true;
    return false;
}

?>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="login.css">

</head>
<body>

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

    if ($user) {

        $sql = "SELECT * FROM banned_t WHERE user_id = ?";
        $stmt = $pdo->prepare($sql);
        if (!$stmt->execute([$user['user_id']])) {
            echo "Error: " . $stmt->errorInfo()[2];
            exit();
        }

        $test = $stmt->fetch();

        if (! ($test))
        {
            $_SESSION['user'] = $user;

            echo "<script>window.location.href='Gladiator_Bowl_Home.php';</script>";

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
            echo "Your account have been banned";
            echo "<script> $('#myModal').modal('show');</script>";
        }


    } else {

        echo "Invalid email or password.";
    }


    // close connection
    $pdo = null;
}
?>

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
                    <p id="msg_error"></p>

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

<button type="button" class="interaction-button" data-toggle="modal" data-target="#modal_ban" >wehs</button>
                                            
<div class="modal fade" id="modal_ban" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title">Your account have beeen banned.</h5>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="modal_reason" class="col-form-label">Reason:</label>
            <p class="form-control" id="modal_reason"></p>
          </div>
          <div class="form-group">
            <label for="modal_duration" class="col-form-label">Duration: (in days)</label>
            <p type="number" class="form-control" id="modal_duration"></p>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</body>

</html>
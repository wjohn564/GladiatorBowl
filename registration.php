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
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $profession = $_POST['profession'];

        echo $firstname . " " . $lastname . " " . $email . " " . $password . " " . $profession;
    }
    ?>
</div>

<div class="logoBox">
    <img class="logo" src="Images/2023-03-20%20(1).png" alt="test logo">
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
                </div>
            </div>
        </div>
    </form>
</div>

</body>
</html>


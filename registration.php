<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="registration.css">
</head>

<body>
<!--<div>-->
<!--    --><?php
//    if (isset($_POST["create"])) {
//        echo "user submitted";
//    }
//    ?>
<!--</div>-->

<div class="logoBox">
    <img  class="logo" src="Images/2023-03-20%20(1).png" alt="test logo">
</div>
<div>
    <form action="registration.php" method="post">
        <div class="container">

            <h1>Registration</h1>
            <p>Please Enter Your Account Details</p>

            <label for="firstname"><b> First Name</b></label>
            <input type="text" name="firstname" required>

            <label for="lastname"><b>Last Name</b></label>
            <input type="text" name="lastname" required>

            <label for="email"><b>Email</b></label>
            <input type="email" name="email" required>

            <label for="password"><b>Password</b></label>
            <input type="password" name="password" required>

            <label for="profession"><b>Profession:</b></label>
            <select class="form-control" id="profession" name="profession" required>
                <option value="fighter">Fighter</option>
                <option value="manager">Manager</option>
            </select>

            <input type="submit" name="create" value="Create Account">
        </div>
    </form>
</div>

</body>
</html>


<?php
$current_url = $_SERVER['REQUEST_URI'];
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="banner.css">
</head>
<body>

<link rel="stylesheet" href="banner.css">
<div class="banner">
    <div class="logo">
        <img src="images/Gladiator_Bowl_Home_Banner_Logo_Ver2.jpg" alt="Gladiator Bowl Logo">
    </div>
    <?php if ($current_url === '/' || $current_url === '/index.php') { ?>
        <div class="links" style="display:flex;">
            <a href="login.php" style="margin-right:100px;">Log In</a>
            <a href="registration.php">Register</a>
        </div>
    <?php }
    if ($current_url === '/Gladiator_Bowl_Home.php' || $current_url === '/Gladiator_Bowl_Message.php'
        || $current_url === '/Gladiator_Bowl_Contact_Us.php' || $current_url === '/Gladiator_Bowl_About_Us.php'
        || $current_url === '/post_job.php' || $current_url === '/find_job.php') { ?>
        <div class="links">
            <a href="Gladiator_Bowl_Home.php">Home</a>
            <a href="find_job.php">Find a Job</a>
            <a href="post_job.php">Post a Job</a>
            <a href="Gladiator_Bowl_About_Us.php">About Us</a>
            <a href="Gladiator_Bowl_Contact_Us.php">Contact Us</a>
            <a href="Gladiator_Bowl_Message.php">Message</a>
            <a href="login.php">Log Out</a>
        </div>
    <?php } ?>
    <?php if ($current_url === '/login.php' || $current_url === '/registration.php') { ?>
        <div class="back-link">
            <a href="index.php">Back-></a>
        </div>
    <?php } ?>
</div>
</body>
</html>

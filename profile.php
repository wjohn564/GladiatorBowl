<?php
session_start();
require_once "config.php";
$user = $_SESSION['user'];


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

?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="profile.css">
</head>



<body>

<div class="profile">

    <div class="container" style="background-color: #100d2b;">
        <div class="row">
            <div class="">

                <img class="profile_picture" src="<?php echo $user_profile['profile_picture_link']?>"
                     onerror="this.onerror=null; this.src='https://www.nicepng.com/png/detail/933-9332131_profile-picture-default-png.png';">
                <br><br>
                <h2 style="color: white;"> <?php echo $user['first_name'] . '  ' . $user['last_name']?> </h2>
                <h3 style="color: #0b5ed7 "> <?php echo $user_profile['age'] . ' | ' . $user['user_type']?> </h3>
                <hr style="color: grey"><br>

                <h4 style="color: #999999;"> <?php echo $user_profile['description'] ?></h4>
                <br>
                <?php if ($user['user_type'] == "fighter"): ?>
                <h3 style="color: white;"> <?php echo "wins :" . $user_profile['wins'] ?> </h3>
                <h3 style="color: white;"> <?php echo "draws :" . $user_profile['draws'] ?> </h3>
                <h3 style="color: white;"> <?php echo "losses :" . $user_profile['losses'] ?> </h3>
                <?php endif; ?>



            </div>
        </div>
    </div>

</div>

</body>
</html>

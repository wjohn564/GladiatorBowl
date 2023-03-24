<?php
session_start();
require_once "config.php";
$user = $_SESSION['user'];


$user_to_search = $user["user_id"];

switch ($_POST["job_filter"]) {
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
    <link rel="stylesheet" href="search_bar.css">
</head>



<body>

<div class="profile">
    <div class="container">
        <div class="row">
            <div class="col-5.5">
                <div class="col-4"></div>
                <h2 style="color:#100d2b"> <?php echo $user['first_name']?> </h2>
                <br><br><br>
                <h2 style="color:#100d2b"> <?php echo $user['user_id']?> </h2>
                <br><br><br>
                <h2 style="color:#100d2b"> <?php echo $user_profile['age']?> </h2>


            </div>
        </div>
    </div>

</div>

</body>
</html>

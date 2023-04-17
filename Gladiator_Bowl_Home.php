<?php // Var
session_start();
require_once "config.php";
$user = $_SESSION['user'];
$user_profile = $_SESSION['user_profile'];


?>


<?php // Search
require_once "config.php";

if (isset($_POST['search']) and $_POST["value_to_search"] != "")
{

    $value_to_search = $_POST["value_to_search"];

    switch ($_POST["job_filter"]) {
        case "all":
            $query = "SELECT * FROM `user_t` WHERE user_id = '$value_to_search' OR first_name = '$value_to_search' OR last_name = '$value_to_search'";
            break;
        case "fighter":
            $query = "SELECT * FROM `user_t` WHERE ((user_id = '$value_to_search' OR first_name = '$value_to_search' OR last_name = '$value_to_search') AND user_type = 'fighter' )";
            break;
        default:
            $query = "SELECT * FROM `user_t` WHERE ((user_id = '$value_to_search' OR first_name = '$value_to_search' OR last_name = '$value_to_search') AND user_type = 'manager' )";
    }
    $search_result = filterTable($query);
}
else
{
    switch ($_POST["job_filter"]) {
        case "all":
            $query = "SELECT * FROM `user_t`";
            break;
        case "fighter":
            $query = "SELECT * FROM `user_t` WHERE user_type = 'fighter'";
            break;
        default:
            $query = "SELECT * FROM `user_t` WHERE user_type = 'manager'";
    }
    $search_result = filterTable($query);
}


?>




<!DOCTYPE html>
<html>
<head>
    <title>Gladiator Bowl - Home</title>
    
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="Gladiator_Bowl_Home.css">
    
    <script type="text/javascript" scr="js/jq"> </script>

</head>

<body>
    <?php require "banner.php"; ?>

<div id="main">
    <h1 style="color: #100d2b">Join the Ultimate Fighting Network</h1>
    <h4 style="color: #100d2b">Connect with other MMA fighters from around the world, showcase your skills, and grow your career.</h4>


    <div>
        <div class="container2 Profile">
            <a style="float: right;" href="<?php if ($user['user_type'] == "fighter") echo 'profile_fighter.php'; else echo 'profile_manager.php';?>">Edit profile</a>

            <?php require "full_profile.php"; ?>

        </div>

        <div class="container2 Profile search_show_profile" style="float: right" id="search_show_profile">
            <?php require "full_profile_search.php"; ?>
        </div>

        <form action="Gladiator_Bowl_Home.php" method="post">
            <div class="container Search col-6" style="float: inside">
                <div class="row">
                    <div class="col-5.5">

                        <h2 class="col-5" style="color:#100d2b">Search for users</h2>
                        :
                        <?php if (isset($_POST['value_to_search'])): ?>
                            <input class="search-request" type="text" name="value_to_search" value="<?php echo $_POST['value_to_search']?>">
                            <label for="job_type"><b>Job Filter:</b></label>
                            <select class="form-control" id="job" name="job_filter">
                                <option value="all" <?php if ($_POST['job_filter'] == 'all') echo 'Selected' ?> >All</option>
                                <option value="fighter" <?php if ($_POST['job_filter'] == 'fighter') echo 'Selected' ?> >Fighter</option>
                                <option value="manager" <?php if ($_POST['job_filter'] == 'manager') echo 'Selected' ?> >Manager</option>
                            </select>
                        <?php else: ?>
                            <input class="search-request" type="text" name="value_to_search">
                            <label for="job_type"><b>Job Filter:</b></label>
                            <select class="form-control" id="job" name="job_filter">
                                <option value="all">All</option>
                                <option value="fighter">Fighter</option>
                                <option value="manager">Manager</option>
                            </select>
                        <?php endif; ?>



                        <input class="submit-button" type="submit" name="search" value="Enter">
                        <br><br><br>

                        <hr class="mb-2">

                        <table class="table">
                            <tr style="color:#100d2b">
                                <th>Id</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>User Type</th>
                                <th>Interaction <?php echo $_GET['arg'] ?></th>
                            </tr>
                            <?php $size = 15; while ($row = mysqli_fetch_array($search_result) and $size > 0 ): $size--;?>

                                <tr>
                                    <td> <?php echo $row["user_id"] ?></td>
                                    <td> <?php echo $row["first_name"] ?></td>
                                    <td> <?php echo $row["last_name"] ?></td>
                                    <td> <?php echo $row["user_type"] ?></td>

                                    <td> <input class="submit-button"  type="submit" id="<?php echo $row["user_id"];?>;" onclick="transfer_id() ;<?php fi_($_GET['arg']) ?> ; show_profile();"  value="View profile" > </td>
                                </tr>
                            <?php endwhile; ?>


                        </table>


                    </div>

                </div>
            </div>

        </form>



    </div>


</div>
</body>

<script>

    function show_profile() {
        const search_show_profile = document.querySelector('#search_show_profile');
        if (search_show_profile.style.display === 'block')
            search_show_profile.style.display = 'none';
        else
            search_show_profile.style.display = 'block';
    }


    function transfer_id() {
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("txtHint").innerHTML = xhttp.responseText;
            }
        };
        const str1 = "'641ef1100d51f'"
        const str = "Gladiator_Bowl_Home.php?arg=".concat(str1);
        xhttp.open("GET", str , true);
        xhttp.send();   
    }

    /*
    function transfer_id() {
        var a = {}
        a.id = '641ef1100d51f';

        $.ajax({
            url: "Gladiator_Bowl_Home.php",method: "get", data: a, success:function() {};
        })
    } */

    
</script>



<?php

function fi_($id) {

    $sql = "SELECT * FROM user_t WHERE user_id = '$id'";

    $search_result = filterTable($sql);
    $user_search = mysqli_fetch_array($search_result);


    $user_to_search = $user_search["user_id"];
    switch ($user_search["user_type"]) {
        case "fighter":
            $query = "SELECT * FROM `fighter_profile_t` WHERE user_id = '$user_to_search'";
            break;
        default:
            $query = "SELECT * FROM `manager_profile_t` WHERE user_id = '$user_to_search'";
    }
    $search_result = filterTable($query);
    $user_profile_search = mysqli_fetch_array($search_result);

    $user_search['first_name'] = "dawn";
    $_SESSION['user_search'] = $user_search;
    $_SESSION['user_profile_search'] = $user_profile_search;

}
?>

</html>

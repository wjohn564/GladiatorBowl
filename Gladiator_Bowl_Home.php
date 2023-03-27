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
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        #banner {
            background-color: #100d2c;
            color: white;
            height: 100px;
            display: flex;
            align-items: center;
            padding: 0 20px;
            justify-content: space-between;
        }
        #logo img {
            height: 60px;
            width: auto;
        }
        #links {
            display: flex;
            flex: 1;
            justify-content: space-between;
            margin-left: 80px;
            margin-right: 80px;
        }
        #links a {
            color: white;
            text-decoration: none;
        }
        #links a:hover {
            color: #fcad36;
        }
        #main {
            text-align: center;
            padding: 50px 0;
        }
        #main h1 {
            font-size: 36px;
            color: black;
            margin: 0 0 40px 0;
        }
        #main h4 {
            font-size: 20px;
            color: black;
            margin: 0;
        }
    </style>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="Gladiator_Bowl_Home.css">

</head>

<body>
    <div id="banner">
        <div id="logo">
            <img src="images/Gladiator_Bowl_Home_Banner_Logo_Ver2.jpg" alt="Gladiator Bowl Logo">
        </div>
        <div id="links">
            <a href="Gladiator_Bowl_Home.php">Home</a>
            <a href="#">Find a Job</a>
            <a href="#">Post a Job</a>
            <a href="Gladiator_Bowl_About_Us.php">About Us</a>
            <a href="Gladiator_Bowl_Contact_Us.php">Contact Us</a>
            <a href="login.php">Log In</a>
            <a href="registration.php">Sign Up</a>
        </div>
    </div>
    <div id="main">
        <h1 style="color: #100d2b">Join the Ultimate Fighting Network</h1>
        <h4 style="color: #100d2b">Connect with other MMA fighters from around the world, showcase your skills, and grow your career.</h4>


        <div>
            <div class="container2 Profile">
                <a style="float: right;" href="<?php if ($user['user_type'] == "fighter") echo 'profile_fighter.php'; else echo 'profile_manager.php';?>">Edit profile</a>

                <br>
                <img class="profile_picture" src="<?php echo $user_profile['profile_picture_link']?>"
                     onerror="this.onerror=null; this.src='https://www.nicepng.com/png/detail/933-9332131_profile-picture-default-png.png';">
                <br><br>
                <h2 style="color: white;"> <?php echo $user['first_name'] . '  ' . $user['last_name']?> </h2>
                <h3 style="color: #0b5ed7 "> <?php echo $user_profile['age'] . ' | ' . $user['user_type']?> </h3>
                <hr style="color: grey"><br>

                <h4 style="color: #999999;"> <?php echo $user_profile['description'] ?></h4>
                <br>
                <?php if ($user['user_type'] == "fighter"): ?>
                    <h3 style="color: white;"> <?php echo "wins : " . $user_profile['wins'] ?> </h3>
                    <h3 style="color: white;"> <?php echo "draws : " . $user_profile['draws'] ?> </h3>
                    <h3 style="color: white;"> <?php echo "losses : " . $user_profile['losses'] ?> </h3>
                <?php endif; ?>

            </div>
            <form action="Gladiator_Bowl_Home.php" method="post">
                <div class="container Search col-6">
                    <div class="row">
                        <div class="col-5.5">

                            <h2 class="col-5" style="color:#100d2b">Search for users</h2>
    :
                            <?php if (isset($_POST['value_to_search'])): ?>
                                <input class="search-request" type="text" name="value_to_search" value="<?php echo $_POST['value_to_search']?>">
                                <label for="job_type"><b>Job Filter:</b></label>
                                <select class="form-control" id="job" name="job_filter">
                                    <option value="all" <?php if ($_POST['job_filter'] == 'all') echo Selected ?> >All</option>
                                    <option value="fighter" <?php if ($_POST['job_filter'] == 'fighter') echo Selected ?> >Fighter</option>
                                    <option value="manager" <?php if ($_POST['job_filter'] == 'manager') echo Selected ?> >Manager</option>
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
                                </tr>

                                <?php $size = 15; while ($row = mysqli_fetch_array($search_result) and $size > 0 ): $size--;?>
                                    <tr>
                                        <td> <?php echo $row["user_id"] ?></td>
                                        <td> <?php echo $row["first_name"] ?></td>
                                        <td> <?php echo $row["last_name"] ?></td>
                                        <td> <?php echo $row["user_type"] ?></td>
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
</html>
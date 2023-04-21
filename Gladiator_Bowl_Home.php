<?php // Var
session_start();
require_once "config.php";
$user = $_SESSION['user'];
$user_profile = $_SESSION['user_profile'];

$user_search = null;
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
        case "manager":
            $query = "SELECT * FROM `user_t` WHERE user_type = 'manager'";
            break;
        case "fighter":
            $query = "SELECT * FROM `user_t` WHERE user_type = 'fighter'";
            break;
        default:
            $query = "SELECT * FROM `user_t`";
    }
    $search_result = filterTable($query);
}



?>




<!DOCTYPE html>
<html>
<head>
    <title>Gladiator Bowl - Home</title>
    
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="Gladiator_Bowl_Home.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    
    <script type="text/javascript" scr="js/jq"> </script>

</head>

<body>
    <?php require "banner.php"; ?>

    <div id="main">
        <h1 style="color: #100d2b">Join the Ultimate Fighting Network</h1>
        <h4 style="color: #100d2b">Connect with other MMA fighters from around the world, showcase your skills, and grow your career.</h4>


        <div>
            <div class="container2 Profile">
                <a style="float: right;" href="<?php if ($user['user_type'] == "fighter") echo 'profile_fighter.php'; else echo 'profile_manager.php';?>">
                    <i class="material-icons ">edit</i> Edit profile</a>

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

                            <h1 id="test"></h1>

                            <table class="table">
                                <tr style="color:#100d2b">
                                    <th>Id</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>User Type</th>
                                    <th>Interaction <?php echo $_GET['arg'] ?></th>
                                </tr>
                                <script> const tab = []; </script>
                                <?php $size = -1; while ($row = mysqli_fetch_array($search_result) and $size < 15 ):
                                    $size++;
                                    $row_encode = json_encode($row);

                                    $user_search = $row;
                                    $user_to_search = $user_search['user_id'];
                                    switch ($user_search["user_type"]) {
                                        case "fighter":
                                            $query = "SELECT * FROM `fighter_profile_t` WHERE user_id = '$user_to_search'";
                                            break;
                                        default:
                                            $query = "SELECT * FROM `manager_profile_t` WHERE user_id = '$user_to_search'";
                                    }
                                    $search_profile_result = filterTable($query);
                                    $user_profile_search = mysqli_fetch_array($search_profile_result);
                                    if ( count($user_profile_search) > 0)
                                        $user_profile_encode = json_encode($user_profile_search);


                                    ?>
                                <script>
                                    var myUser = JSON.parse('<?php echo $row_encode; ?>');

                                    //var myUserProfile = JSON.parse('<?php echo $user_profile_encode; ?>');
                                    //tab.push(myUserProfile);

                                    tab.push(myUser);

                                </script>
                                    <tr>
                                        <td> <?php echo $row["user_id"] ?></td>
                                        <td> <?php echo $row["first_name"] ?></td>
                                        <td> <?php echo $row["last_name"] ?></td>
                                        <td> <?php echo $row["user_type"] ?></td>

                                        <td> <button class="interaction-button"  type="button" id="<?php echo  $row["user_id"]?>" onclick="sendToPHP_(this.id)"><i class='material-icons '>add</i></button>
                                            <button class="interaction-button"  type="button" id="<?php echo  $size?>" onclick="transfer_id(this.id);"><i class='material-icons '>visibility</i></button>


                                        </td>
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

    function transfer_id(id_) {
        var search_name = document.querySelector('#search_name');
        var search_type = document.querySelector('#search_type');

        /*
        var search_description = document.querySelector('#search_description');
        var search_wins = document.querySelector('#search_wins');
        var search_draws = document.querySelector('#search_draws');
        var search_losses = document.querySelector('#search_losses');
        var search_fighting_style = document.querySelector('#search_fighting_style');
        var search_gender = document.querySelector('#search_gender');
        var search_age = document.querySelector('#search_age');
        var search_weight = document.querySelector('#search_weight');
        var search_height = document.querySelector('#search_height');
        var search_medical_history = document.querySelector('#search_medical_history');*/

        //tab[id_].age
        search_name.innerHTML = tab[id_].first_name + " " + tab[id_].last_name;
        search_type.innerHTML =  + " | " + tab[id_].user_type;
        /*
        search_description.innerHTML = tab[id_].description;
        search_wins.innerHTML = tab[id_].wins;
        search_draws.innerHTML = tab[id_].draws;
        search_losses.innerHTML = tab[id_].losses;
        search_fighting_style.innerHTML = tab[id_].fighting_style;
        search_gender.innerHTML = tab[id_].gender;
        search_age.innerHTML = tab[id_].age;
        search_weight.innerHTML = tab[id_].weight;
        search_height.innerHTML = tab[id_].height;
        search_medical_history.innerHTML = tab[id_].medical_history;*/





    }

    function sendToPHP_(id_) {
        test.innerHTML = "not passing";
        $.ajax({
            type: "POST",
            url: "https://gladiatorbowl.000webhostapp.com/contact.php",
            data: { user_ask: "641ef1100d51f",
                    user_receive: id_},
            success: (response) => {
                test.innerHTML = response;
            }
        });

    }


        function sendToPHP() {
        const test = document.querySelector('#test');
        test.innerHTML = "not passing";
        $.ajax({
            type: "POST",
            url: "https://gladiatorbowl.000webhostapp.com/Gladiator_Bowl_Home.php",
            data: { arg: "passing" },
            success: () => {
                test.innerHTML = "<?php echo $_POST['arg'] ?>";
            }
        });
    }

</script>



</html>

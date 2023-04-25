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
            $query = "SELECT * FROM `user_t` WHERE  first_name LIKE '%$value_to_search%' OR last_name LIKE '%$value_to_search%'";
            break;
        case "fighter":
            $query = "SELECT * FROM `user_t` WHERE ((first_name LIKE '%$value_to_search%' OR last_name LIKE '%$value_to_search%') AND user_type = 'fighter')";
            break;
        default:
            $query = "SELECT * FROM `user_t` WHERE ((first_name LIKE '%$value_to_search%' OR last_name LIKE '%$value_to_search%') AND user_type = 'manager' )";
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


<?php 

$user_contact = array();

$user_id = $user['user_id'];
$query = "SELECT * FROM `contact_t` WHERE user_ask = '$user_id' OR user_receive = '$user_id'";
$contact_result = filterTable($query);

while ($row = mysqli_fetch_array($contact_result)) {
    if ($user_id == $row['user_ask'])
        $user_contact[] = $row['user_receive'];
    else
        $user_contact[] = $row['user_ask'];
}

    
?>


<script>
    var user_to_ban_id = null;
</script>

<!DOCTYPE html>
<html>
<head>
    <title>Gladiator Bowl - Home</title>
    
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="Gladiator_Bowl_Home.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    
    <script type="text/javascript" scr="js/jq"> </script>

</head>

<body>
    <?php require "banner.php"; ?>

    <div id="main">
        <!-- <h1 style="color: #100d2b">Join the Ultimate Fighting Network</h1> -->
        <!-- <h4 style="color: #100d2b">Connect with other MMA fighters from around the world, showcase your skills, and grow your career.</h4> -->


        <div class="row" style="min-height: calc(90vh);">
            
        <div class="container_center col">
            <a style="float: right;" href="<?php if ($user['user_type'] == "fighter") echo 'profile_fighter.php'; else echo 'profile_manager.php';?>">
                <i class="material-icons ">edit</i> Edit profile</a>

            <?php require "full_profile.php"; ?>

        </div>

        <div class="container_center col-md-6" style="background-color: #100d2b" >
            <h1 style="color: white;">To complete here</h1>
        </div>
        
        <div class="container_center col"> 
            <form action="Gladiator_Bowl_Home.php" method="post">
                <div class="container" >   
                    <div class="row">
                        <div class="col-5.5">

                            <h2 style="color:#100d2b; margin-top: 15px;">Search for users</h2>

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
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>User Type</th>
                                    <th>Interaction</th>
                                </tr>
                                <script> const tab = []; </script>
                                <?php $size = -1; while ($row = mysqli_fetch_array($search_result) and $size < 15 ):
                                    $size++;


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
                                    $row['have_profile'] = 0;
                                    if ( count($user_profile_search) > 0) {
                                        $row['have_profile'] = 1;
                                        $user_profile_encode = json_encode($user_profile_search);
                                    }
                                    $row_encode = json_encode($row);
                                    ?>
                                <script>

                                    var myUser = JSON.parse('<?php echo $row_encode; ?>');

                                    var have_profile = '<?php echo ( count($user_profile_search) > 0); ?>';

                                    if (have_profile)
                                    {
                                        var myUserProfile = JSON.parse('<?php echo $user_profile_encode; ?>');

                                        const dict = Object.assign({}, myUser, myUserProfile);
                                        tab.push(dict);
                                    }
                                    else
                                        tab.push(myUser);



                                </script>
                                    <tr>
                                        <td> <?php echo $row["first_name"] ?></td>
                                        <td> <?php echo $row["last_name"] ?></td>
                                        <td> <?php echo $row["user_type"] ?></td>

                                        <td>
                                            <?php if ($user['user_type'] == "admin"): ?>
                                                <button type="button" class="interaction-button" id="<?php echo  $row["user_id"]?>" onclick="ban_click(this.id)"><i class='material-icons '>no_accounts</i></button>
                                            <?php endif; ?>
                                            <?php if (in_array($row['user_id'], $user_contact)): ?>
                                                <button class="interaction-button"  type="button" id="<?php echo  $row["user_id"]?>" onclick="modify_contact(this.id)"><i class='material-icons ' onclick="change_sign_contact(this) ">person_remove</i></button>
                                            <?php else: ?>
                                                <button class="interaction-button"  type="button" id="<?php echo  $row["user_id"]?>" onclick="modify_contact(this.id)"><i class='material-icons ' onclick="change_sign_contact(this) ">group_add</i></button>
                                                <?php endif; ?>
                                            <button class="interaction-button"  type="button" id="<?php echo  $size?>" onclick="switch_profile(this.id);" data-toggle="modal" data-target="#modal_profile"><i class='material-icons '>visibility</i></button>
                                            
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

<div class="modal fade" id="modal_profile" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
        <div class="container_center" id="search_show_profile">
            <?php require "full_profile_search.php" ?>
        </div>
        <div class="modal-footer" style="background-color: #100d2b">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modal_to_ban" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header container_center">
        <h5 class="modal-title" id="exampleModalLabel">Ban</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="ban_reason" class="col-form-label">Reason:</label>
            <textarea class="form-control" id="ban_reason"></textarea>
          </div>
          <div class="form-group">
            <label for="ban_duration" class="col-form-label">Duration: (in days)</label>
            <input type="number" class="form-control" id="ban_duration">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="ban_user();" data-dismiss="modal">Ban user</button>
      </div>
    </div>
  </div>
</div>

                                  
<div class="modal fade" id="modal_is_ban" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">The user is already banned</h5>
        </div>
        <div class="modal-body">
            
            <div class="form-group">
                <label for="modal_reason" class="col-form-label">Reason:</label>
                <p class="form-control" id="modal_reason"></p>
            </div>
            <div class="form-group">
                <label for="modal_duration" class="col-form-label">Duration: (in days)</label>
                <p type="number" class="form-control" id="modal_duration"></p>
            </div>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="unban_user();">Remove ban</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="$('#modal_to_ban').modal('show');;">Modify ban</button>
        </div>
        </div>
    </div>
    </div>


<script>

    function ban_click(id_) {
        var modal_reason = document.querySelector('#modal_reason');
        var modal_duration = document.querySelector('#modal_duration');

        user_to_ban_id = id_;
        $.ajax({
            type: "POST",
            url: "https://gladiatorbowl.000webhostapp.com/is_ban.php",
            data: { user_to_ban: id_},
            success: (response) => {
                if (response == 0)
                {
                    $('#modal_to_ban').modal('show');
                }
                else
                {
                    var ban = JSON.parse(response);
                    modal_reason.innerHTML = ban.reason;
                    modal_duration.innerHTML = ban.duration + " days";
                    // the user is already ban
                    $('#modal_is_ban').modal('show');
                    
                }

            }
        });
    }


    function change_sign_contact(ele) {
        if (ele.innerHTML == 'group_add')
            ele.innerHTML = 'person_remove';
        else                        
            ele.innerHTML = 'group_add';
    }
    function show_profile() {
        const search_show_profile = document.querySelector('#search_show_profile');
        if (search_show_profile.style.display === 'block')
            search_show_profile.style.display = 'none';
        else
            search_show_profile.style.display = 'block';
    }

    function switch_profile(ind) {

        var search_profile_picture = document.querySelector('#search_profile_picture');
        var search_name = document.querySelector('#search_name');
        var search_type = document.querySelector('#search_type');
        var search_description = document.querySelector('#search_description');


        if (tab[ind].have_profile) {
            var search_wins = document.querySelector('#search_wins');
            var search_draws = document.querySelector('#search_draws');
            var search_losses = document.querySelector('#search_losses');
            var search_fighting_style = document.querySelector('#search_fighting_style');
            var search_gender = document.querySelector('#search_gender');
            var search_age = document.querySelector('#search_age');
            var search_weight = document.querySelector('#search_weight');
            var search_height = document.querySelector('#search_height');
            var search_medical_history = document.querySelector('#search_medical_history');
        }
        //

        search_name.innerHTML = tab[ind].first_name + " " + tab[ind].last_name;

        if (tab[ind].have_profile) {
            search_profile_picture.src = tab[ind].profile_picture_link;
            search_type.innerHTML = tab[ind].age + " | " + tab[ind].user_type;
            search_description.innerHTML = tab[ind].description;
            search_wins.innerHTML = "wins : " . tab[ind].wins;
            search_draws.innerHTML = "draws : " . tab[ind].draws;
            search_losses.innerHTML = "losses : " . tab[ind].losses;
            search_fighting_style.innerHTML = "fighting style : " . tab[ind].fighting_style;
            search_gender.innerHTML = "gender : " . tab[ind].gender;
            search_age.innerHTML = "age : " . tab[ind].age;
            search_weight.innerHTML = "weight : " . tab[ind].weight;
            search_height.innerHTML = "height : " . tab[ind].height;
            search_medical_history.innerHTML = tab[ind].medical_history;
        }
        else {
            search_type.innerHTML = tab[ind].user_type;
            search_profile_picture.src = 'https://www.nicepng.com/png/detail/933-9332131_profile-picture-default-png.png';
            search_description.innerHTML = "";
        }
        /*
        search_description.innerHTML = tab[ind].description;
        search_wins.innerHTML = tab[ind].wins;
        search_draws.innerHTML = tab[ind].draws;
        search_losses.innerHTML = tab[ind].losses;
        search_fighting_style.innerHTML = tab[ind].fighting_style;
        search_gender.innerHTML = tab[ind].gender;
        search_age.innerHTML = tab[ind].age;
        search_weight.innerHTML = tab[ind].weight;
        search_height.innerHTML = tab[ind].height;
        search_medical_history.innerHTML = tab[ind].medical_history;*/





    }

    function modify_contact(id_) {
        //change sign
        //contact_sign' . $row["user_id"]

        const user_id = "<?php echo $user['user_id'] ?>";
        $.ajax({
            type: "POST",
            url: "https://gladiatorbowl.000webhostapp.com/contact.php",
            data: { user_ask: user_id,
                    user_receive: id_},
            success: (response) => {}
        });
    }

    function ban_user() {
        var admin_id = '<?php echo $user['user_id']?>';
        var ban_reason = document.querySelector('#ban_reason').value;
        var ban_duration = document.querySelector('#ban_duration').value;

        $.ajax({
            type: "POST",
            url: "https://gladiatorbowl.000webhostapp.com/ban_user.php",
            data: { user_id: user_to_ban_id,
                    banned_by: admin_id,
                    reason: ban_reason, 
                    duration: ban_duration},
            success: (response) => {
            
            }
        });

    }

    function unban_user() {

        $.ajax({
            type: "POST",
            url: "https://gladiatorbowl.000webhostapp.com/unban_user.php",
            data: { user_id: user_to_ban_id},
            success: (response) => {
            }
        });

    }




</script>



</html>

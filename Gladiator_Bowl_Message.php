<?php // Var
session_start();
require_once "config.php";
$user = $_SESSION['user'];
$user_profile = $_SESSION['user_profile'];

$search_message_result = null;
?>

<?php // Mini profile  ini
require_once "config.php";

$contact_profile = array();
$contact_profile_json = array();

$user_id = $user['user_id'];
$query = "SELECT * FROM `contact_t` WHERE user_ask = '$user_id'";
$search_result = filterTable($query);

while ($row = mysqli_fetch_array($search_result)) {

    $sql = "SELECT * FROM user_t WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute([$row['user_receive']])) {
        echo "Error: " . $stmt->errorInfo()[2];
        exit();
    }
    $res_user = $stmt->fetch();

    //profile
    $user_to_search = $res_user['user_id'];
    switch ($res_user["user_type"]) {
        case "fighter":
            $query = "SELECT * FROM `fighter_profile_t` WHERE user_id = '$user_to_search'";
            break;
        default:
            $query = "SELECT * FROM `manager_profile_t` WHERE user_id = '$user_to_search'";
    }
    $search_profile_result = filterTable($query);
    $user_profile_search = mysqli_fetch_array($search_profile_result);
    $res_user['have_profile'] = 0;


    //message

    $query = "SELECT * FROM message_t WHERE sender_id = '$user_id' AND receiver_id = '$user_to_search' OR sender_id =  '$user_to_search' AND receiver_id =  '$user_id'";
    $search_message_result = filterTable($query);
    



    if ( count($user_profile_search) > 0) {

        $res_user['have_profile'] = 1;
        $prof = array_merge($user_profile_search, $res_user);
        $prof['messages'] = $search_message_result;
        $contact_profile_json[] = json_encode($prof);
        $contact_profile[] = $prof;
    }
    else
    {
        $res_user['profile_picture_link'] = 'https://www.nicepng.com/png/detail/933-9332131_profile-picture-default-png.png';
        $res_user['messages'] = $search_profile_result;
        $contact_profile_json[] = json_encode($res_user);
        $contact_profile[] = $res_user;
    }





}

$user_link = reset($contact_profile_json);

?>

<script>
    const tab = [];
    <?php foreach ($contact_profile_json as $row):?>
        var user_contact = JSON.parse('<?php echo $row; ?>');
        tab.push(user_contact);
    <?php endforeach;?>

</script>


<script>

    function send_message() {

        var message_ = document.querySelector('#message');
        var message = message_.value;


        const user_id = "<?php echo $user['user_id'] ?>";
        $.ajax({
            type: "POST",
            url: "https://gladiatorbowl.000webhostapp.com/send_message.php",
            data: { sender_id: user_id,
                    receiver_id: user_link.user_id,
                    message: message},
            success: (response) => {}
        });

        var bottom = document.querySelector('#bottom');
        bottom.innerHTML = bottom.innerHTML + '<div class="msg right-msg"> <div class="msg-img" style="background-image: url(https://image.flaticon.com/icons/svg/145/145867.svg)"></div><div class="msg-bubble"><div class="msg-info"><div class="msg-info-name"> <?php echo $user['first_name']?></div><div class="msg-info-time">12:46</div></div><div class="msg-text">' + message + '</div></div></div><br>';
        message_.value = "";
    }

    function switch_message(id_) {
        switch_profile(id_);
        var bottom = document.querySelector('#bottom');
        var test = document.querySelector('#test');
        test.innerHTML = "pass";
        bottom.innerHTML = "";

        user_link = tab[id_];
        bottom.innerHTML = "fbezuifbenzn";

        /*
        $.ajax({
            type: "POST",
            url: "https://gladiatorbowl.000webhostapp.com/switch_message.php",
            data: { sender_id: "641ef1100d51f",
                    receiver_id: "641b38af91e77"},
            success: (response) => {
                var messages = JSON.parse(response);

                test.innerHTM = messages.length;

            }
        });*/
    }

    function switch_profile(id_) {

        user_link = tab[id_];

        var search_profile_picture = document.querySelector('#search_profile_picture');
        var search_name = document.querySelector('#search_name');
        var search_type = document.querySelector('#search_type');
        var search_description = document.querySelector('#search_description');


        if (user_link.have_profile) {
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

        var change_name = document.querySelector('#change_name');
        change_name.innerHTML = user_link.first_name + " " + user_link.last_name;

        search_name.innerHTML = user_link.first_name + " " + user_link.last_name;

        if (user_link.have_profile) {
            search_profile_picture.src = user_link.profile_picture_link;
            search_type.innerHTML = user_link.age + " | " + user_link.user_type;
            search_description.innerHTML = user_link.description;
            search_wins.innerHTML = user_link.wins;
            search_draws.innerHTML = user_link.draws;
            search_losses.innerHTML = user_link.losses;
            search_fighting_style.innerHTML = user_link.fighting_style;
            search_gender.innerHTML = user_link.gender;
            search_age.innerHTML = user_link.age;
            search_weight.innerHTML = user_link.weight;
            search_height.innerHTML = user_link.height;
            search_medical_history.innerHTML = user_link.medical_history;
        }
        else {
            search_type.innerHTML = user_link.user_type;
            search_profile_picture.src = 'https://www.nicepng.com/png/detail/933-9332131_profile-picture-default-png.png';
            search_description.innerHTML = "";
        }
    }


</script>




<!DOCTYPE html>
<html>
<head>
    <title>Gladiator Bowl - Message</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="css/Gladiator_Bowl_Message.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>

    </style>

</head>




<body>
<div class="row">
    <?php require "banner.php"; ?>
</div>

<div id="main" class="row">

    <div class="container_contact col-md-3 col-sm-3">
        <h1 style="text-align: center;"> <i class="material-icons ">contacts</i> Contacts</h1>
        <div class="container_mini_profile">

            <?php $ind = -1; foreach ($contact_profile as $row): $ind += 1;?>
                <div  id="<?php echo $ind ?>" type="button" onclick="switch_message(this.id)" class="mini_profile row">
                    <div class="col-md-2 col-sm-2" style="margin: 20px">
                        <img class="mini_profile_picture" src="<?php echo $row['profile_picture_link'] ?>">
                    </div>
                    <div class="col-md-7 col-sm-7" style="margin-top: 25px; margin-left: 10px">
                        <h3> <?php echo $row['first_name'] . " " . $row['last_name'] ?> </h3>
                        <h5 style="color: #999999"> <?php echo $row['user_type'] ?> </h5>
                    </div>
                </div>
                <br>
            <?php endforeach; ?>




        </div>
    </div>


    <div class="container_center col-md-6 col-sm-6">

        <div class="container_title">
            <h1 id="test" > <i class="material-icons ">chat</i> Message </h1>
        </div>

        <div class="row " style="height: 90%; width: 100%">

            <div style="height: 100%; width: 100%">

                <section class="msger">
                    <header class="msger-header">
                        <div class="msger-header-title">
                            <i class="fas fa-comment-alt" id="change_name"></i>
                        </div>
                        <div class="msger-header-options">
                            <span><i class="fas fa-cog"></i></span>
                        </div>
                    </header>

                    <main class="msger-chat container_only_message">
                        <div id="bottom">



                        </div>

                    </main>

                    <form class="msger-inputarea">
                        <input type="text" class="msger-input" placeholder="Enter your message..." id="message">
                        <button type="button" class="msger-send-btn" onclick="send_message()">Send</button>
                    <form>
                </section>
            </div>

        </div>

    </div>


    <div class="container_center col-md-3 col-sm-3">
        <?php require "full_profile_search.php" ?>
        <script>
            switch_profile(0);
        </script>

    </div>



</div>
</body>

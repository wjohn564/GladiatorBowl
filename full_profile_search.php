<?php
session_start();
$user_profile_search = $_SESSION['user_profile_search'];
$user_search = $_SESSION['user_search'];

?>
<style>
    .show_more {
        display: none;
    }
</style>

<br>
<img class="profile_picture" src="<?php echo $user_profile_search['profile_picture_link']?>"
     onerror="this.onerror=null; this.src='https://www.nicepng.com/png/detail/933-9332131_profile-picture-default-png.png';">
<br><br>
<h2 style="color: white;"> <?php echo $user_search['first_name'] . '  ' . $user_search['last_name']?> </h2>
<h3 style="color: #0b5ed7 "> <?php echo $user_profile_search['age'] . ' | ' . $user_search['user_type']?> </h3>
<hr style="color: grey"><br>

<h4 style="color: #999999;"> <?php echo $user_profile_search['description'] ?></h4>

<br>

<?php
if ($user_search['user_type'] == "fighter"): ?>
    <h6 style="color: white; text-align: left;" > Fight result</h6>
    <hr style="color: #a8a8a8 ; height: 3px; background-color: #a8a8a8;" ><br>
    <h3 style="color: white;"> <?php echo "wins : " . $user_profile_search['wins'] ?> </h3>
    <h3 style="color: white;"> <?php echo "draws : " . $user_profile_search['draws'] ?> </h3>
    <h3 style="color: white;"> <?php echo "losses : " . $user_profile_search['losses'] ?> </h3>


    <div class="show_more" id="show_more">

        <br>
        <h6 style="color: white; text-align: left;" > Specification </h6>
        <hr style="color: #a8a8a8 ; height: 3px; background-color: #a8a8a8;" ><br>
        <h3 style="color: white; "> <?php echo "fighting style : " . $user_profile_search['fighting_style'] ?></h3>
        <h3 style="color: white;"> <?php echo "gender : " . $user_profile_search['gender'] ?> </h3>
        <h3 style="color: white;"> <?php echo "age : " . $user_profile_search['age'] ?> </h3>
        <h3 style="color: white;"> <?php echo "weight : " . $user_profile_search['weight'] ?> </h3>
        <h3 style="color: white;"> <?php echo "height : " . $user_profile_search['height'] ?> </h3>

        <br>
        <h6 style="color: white; text-align: left;" > Medical history </h6>
        <hr style="color: #a8a8a8 ; height: 3px; background-color: #a8a8a8;" ><br>
        <h4 style="color: #999999;"> <?php echo $user_profile_search['medical_history'] ?> </h4>

        <br>

        <h6 style="color: white; text-align: left;" > Fight videos </h6>
        <hr style="color: #a8a8a8 ; height: 3px; background-color: #a8a8a8;" ><br>
        <iframe src="<?php echo $user_profile_search['fight_videos'] ?>"></iframe>

    </div>
<?php endif; ?>


<input type="button" id="btn_more" value="More">

<script src="js/profile_more.js"></script>


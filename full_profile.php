<?php
session_start();

?>
<script>
    function show_more() {
        var show_more = document.querySelector('#show_more');
        if (show_more.style.display === 'block')
            show_more.style.display = 'none';
        else
            show_more.style.display = 'block';
    }
        
</script>

<br><br>
<img class="profile_picture" src="<?php echo $user_profile['profile_picture_link']?>"
     onerror="this.onerror=null; this.src='https://www.nicepng.com/png/detail/933-9332131_profile-picture-default-png.png';">
<br><br><br><br>
<h2 style="color: white;"> <?php echo $user['first_name'] . '  ' . $user['last_name']?> </h2>
<h3 style="color: #0b5ed7 "> <?php echo $user_profile['age'] . ' | ' . $user['user_type']?> </h3>
<hr style="color: grey"><br>

<h4 style="color: #999999;"> <?php echo $user_profile['description'] ?></h4>

<br>

<div id="show_more" style="display = 'none';">
    <?php
    if ($user['user_type'] == "fighter"): ?>
        <h6 style="color: white; text-align: left;" > Fight result</h6>
        <hr style="color: #a8a8a8 ; height: 3px; background-color: #a8a8a8;" ><br>
        <h3 style="color: white;"> <?php echo "wins : " . $user_profile['wins'] ?> </h3>
        <h3 style="color: white;"> <?php echo "draws : " . $user_profile['draws'] ?> </h3>
        <h3 style="color: white;"> <?php echo "losses : " . $user_profile['losses'] ?> </h3>

        <br>
        <h6 style="color: white; text-align: left;" > Specification </h6>
        <hr style="color: #a8a8a8 ; height: 3px; background-color: #a8a8a8;" ><br>
        <h3 style="color: white; "> <?php echo "fighting style : " . $user_profile['fighting_style'] ?></h3>
        <h3 style="color: white;"> <?php echo "gender : " . $user_profile['gender'] ?> </h3>
        <h3 style="color: white;"> <?php echo "age : " . $user_profile['age'] ?> </h3>
        <h3 style="color: white;"> <?php echo "weight : " . $user_profile['weight'] ?> </h3>
        <h3 style="color: white;"> <?php echo "height : " . $user_profile['height'] ?> </h3>

        <br>
        <h6 style="color: white; text-align: left;" > Medical history </h6>
        <hr style="color: #a8a8a8 ; height: 3px; background-color: #a8a8a8;" ><br>
        <h4 style="color: #999999;"> <?php echo $user_profile['medical_history'] ?> </h4>

        <br>

        <h6 style="color: white; text-align: left;" > Fight videos </h6>
        <hr style="color: #a8a8a8 ; height: 3px; background-color: #a8a8a8;" ><br>
        <iframe src="<?php echo $user_profile['fight_videos'] ?>"></iframe>


    <?php endif; ?>
</div>

<input type="button" onclick="show_more();" value="More">


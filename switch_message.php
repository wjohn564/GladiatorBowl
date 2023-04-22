<?php
require "config.php";
$ind = $_POST['ind'];
$user = $contact_profile[$ind];
$user_id = $user['user_id'];
$user_link = $user;
$query = "SELECT * FROM message_t WHERE sender_id =  '$user_id' OR receiver_id =  '$user_id'";
$search_message_result = filterTable($query);

echo "done";
?>

<?php while ($row = mysqli_fetch_array($search_message_result)) :?>
    <div class="msg right-msg">
        <div
            class="msg-img"
            style="background-image: url('https://image.flaticon.com/icons/svg/145/145867.svg')"
        ></div>

        <div class="msg-bubble">
            <div class="msg-info">
                <div class="msg-info-name"> <?php echo "name"?></div>
                <div class="msg-info-time">12:46</div>
            </div>

            <div class="msg-text">
                <?php echo $row['message'] ?>
            </div>
        </div>
    </div>
<?php endwhile; ?>

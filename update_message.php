<?php

require "config.php";

$user_id = $_POST['user_id'];
$user_to_search = $_POST['user_to_search'];

$query = "SELECT * FROM message_t WHERE sender_id = '$user_id' AND receiver_id = '$user_to_search' OR sender_id =  '$user_to_search' AND receiver_id =  '$user_id'";
$search_message_result = filterTable($query);

$msg = array();
while ($row2 = mysqli_fetch_array($search_message_result))
{   
    $msg[] = $row2;
}

$msg_json = json_encode($msg);
echo $msg_json;

?>
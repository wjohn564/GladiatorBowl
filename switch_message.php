<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php
session_start();
require "config.php";
$sender_id = $_POST['sender_id'];
$receiver_id = $_POST['receiver_id'];

$query = "SELECT * FROM message_t WHERE sender_id = '$sender_id' AND receiver_id = '$receiver_id' OR sender_id =  '$receiver_id' AND receiver_id =  '$sender_id'";
//$search_message_result = filterTable($query);

$stmt = $pdo->prepare($sql);
if (!$stmt->execute([$user_ask, $user_receive])) {
    echo "Error: " . $stmt->errorInfo()[2];
    exit();
}
$search_message_result = $stmt->fetch();

$a = array();
while ($row = $search_message_result->fetch(PDO::FETCH_ASSOC)) {
    $a[] = $row;
}

echo json_encode($a);
?>



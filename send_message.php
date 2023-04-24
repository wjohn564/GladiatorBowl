<?php
require "config.php";

$message_id = uniqid();
$sender_id = $_POST['sender_id'];
$receiver_id = $_POST['receiver_id'];
$message = $_POST['message'];

$sql = "INSERT INTO message_t (message_id, sender_id, receiver_id, message) VALUES (?, ?, ?, ?)";

$stmt = $pdo->prepare($sql);
if (!$stmt->execute([$message_id, $sender_id, $receiver_id, $message])) {
    echo "Error: " . $stmt->errorInfo()[2];
    exit();
}

echo "done";
?>

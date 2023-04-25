<?php
require "config.php";

$ban_id = uniqid();
$user_id = $_POST['user_id'];
$banned_by = $_POST['banned_by'];
$reason = $_POST['reason'];
$duration = $_POST['duration'];



$sql = "SELECT * FROM banned_t WHERE user_id = ?";
$stmt = $pdo->prepare($sql);
if (!$stmt->execute([$user_id])) {
    echo "Error: " . $stmt->errorInfo()[2];
    exit();
}

$ban = $stmt->fetch();

if ($ban) {

    $sql = "DELETE FROM banned_t WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute([$user_id])) {
        echo "Error: " . $stmt->errorInfo()[2];
        exit();
    }
}

if ($duration == "")
    $duration = 30;

$sql = "INSERT INTO banned_t (ban_id, user_id, banned_by, reason, duration) VALUES (?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
if (!$stmt->execute([$ban_id, $user_id, $banned_by, $reason, $duration])) {
    echo "Error: " . $stmt->errorInfo()[2];
    exit();
}

?>

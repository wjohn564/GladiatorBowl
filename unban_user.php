<?php
require "config.php";

$user_id = $_POST['user_id'];

$sql = "DELETE FROM banned_t WHERE user_id = ?";
$stmt = $pdo->prepare($sql);
if (!$stmt->execute([$user_id])) {
    echo "Error: " . $stmt->errorInfo()[2];
    exit();
}

?>

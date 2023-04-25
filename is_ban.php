<?php 
require "config.php";

$sql = "SELECT * FROM banned_t WHERE user_id = ?";
$stmt = $pdo->prepare($sql);
if (!$stmt->execute([$_POST['user_to_ban']])) {
    echo "Error: " . $stmt->errorInfo()[2];
    exit();
}

$ban = $stmt->fetch();

if ($ban)
    echo json_encode($ban);
else
    echo 0;
?>
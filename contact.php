<?php
require "config.php";


$user_ask = $_POST['user_ask'];
$user_receive = $_POST['user_receive'];

$sql = "SELECT * FROM contact_t WHERE user_ask = ? AND user_receive = ?";
$stmt = $pdo->prepare($sql);
if (!$stmt->execute([$user_ask, $user_receive])) {
    echo "Error: " . $stmt->errorInfo()[2];
    exit();
}

if (($stmt->fetch()) && $user_ask != $user_receive)
    echo "trouvé";
else
{
    $contact_id = uniqid();
    $sql = "INSERT INTO contact_t (contact_id, user_ask, user_receive) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute([$contact_id, $user_ask, $user_receive])) {
        echo "Error: " . $stmt->errorInfo()[2];
        exit();
    }
}

?>
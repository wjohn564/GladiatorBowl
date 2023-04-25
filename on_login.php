<?php
session_start();
require "config.php";

$email = $_POST['email'];
$password = sha1($_POST['password']);


// create SELECT statement
$sql = "SELECT * FROM user_t WHERE email = ? AND password = ?";
$stmt = $pdo->prepare($sql);
if (!$stmt->execute([$email, $password])) {
    echo "Error: " . $stmt->errorInfo()[2];
    exit();
}


$user = $stmt->fetch();

if ($user) {
    
    $sql = "SELECT * FROM banned_t WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute([$user['user_id']])) {
        echo "Error: " . $stmt->errorInfo()[2];
        exit();
    }

    $ban = $stmt->fetch();

    if (! ($ban))
    {
        $_SESSION['user'] = $user;

       

        // put in session user_profile ( may have issue because of the few first profile create without profile )
        $user_to_search = $user["user_id"];
        switch ($user["user_type"]) {
            case "fighter":
                $query = "SELECT * FROM `fighter_profile_t` WHERE user_id = '$user_to_search'";
                break;
            default:
                $query = "SELECT * FROM `manager_profile_t` WHERE user_id = '$user_to_search'";
        }
        $search_result = filterTable($query);
        $user_profile = mysqli_fetch_array($search_result);
        $_SESSION['user_profile'] = $user_profile;

        echo 0; // success login
    } else {
        echo json_encode($ban); // ban
    }

} else {

    echo 1; // Invalid email or password.
}


// close connection
$pdo = null;

?>
<?php
$db_host = 'localhost';
$db_name = 'id20430866_gladiator_db';
$db_user = 'id20430866_grp16login';
$db_password = '()^a12$1U1y3Fzqw';

$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);


function filterTable($query)
{

    $db_host = 'localhost';
    $db_name = 'id20430866_gladiator_db';
    $db_user = 'id20430866_grp16login';
    $db_password = '()^a12$1U1y3Fzqw';
    $connect = mysqli_connect($db_host, $db_user, $db_password,$db_name);
    return mysqli_query($connect, $query);
}

?>


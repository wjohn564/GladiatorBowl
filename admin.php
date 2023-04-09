<?php
require_once('config.php');
?>


?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome Admin</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
    <link rel="stylesheet" type="text/css" href="search_bar.css">
</head>
<body>
<div class="container">
    <h1>Welcome Administrator</h1>
    <h2>All users</h2>
    <?php
    $sql = "SELECT * FROM user_t WHERE user_type='fighter' OR user_type='manager'";
    $result = filterTable($sql);
    $queryResults = mysqli_num_rows($result);
    echo $queryResults;
    if ($queryResults > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div><h3>" . $row['email'] + "  " + $row['first_name'] + " " + $row['last_name'] . "</h3> </div>";
        }
    }

    ?>


    <form action="admin.php" method="post">
        <input type="text" name="search" placeholder="Search">
        <button type="submit" name=submit-search">Search</button>
        <input class="logout-button" type="button" value="Log out"
               onclick="window.location.href='login.php'">
    </form>


</div>
</body>






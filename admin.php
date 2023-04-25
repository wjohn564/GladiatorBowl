<?php
require_once('config.php');
require_once ('admin_search.php');
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="admin.css">
</head>
<body>

<div class="container">
    <h1>Welcome Administrator</h1>
    <br>
    <?php


    $sql = "SELECT * FROM user_t WHERE user_type='fighter' OR user_type='manager'";
    $result = filterTable($sql);
    $queryResults = mysqli_num_rows($result);
    echo "<h2>All users</h2>" . " " . $queryResults;
    if ($queryResults > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='user-box'><h3>" . "<div >"
                . "Email: " . $row['email'] . "<br>"
                . "User ID: " . $row['user_id'] . "<br>"
                . "First Name: " . $row['first_name'] . "<br>"
                . "Last Name: " . $row['last_name'] . "<br>"
                .
                "</div>" . "</h3> </div> <br>";
        }
        if ($queryResults == 0 || $queryResults < 0) {
            echo "No Data to Show";
        }
    }


    ?>
    <form action="admin_search.php" method="post">
        <label for='search'><b>Search Email: </b> </label>
        <input type="text" name="search">

        <button type="submit" name="submit-search">Search</button>
        <input class="logout-button" type="button" value="Log out"
               onclick="window.location.href='login.php'">
        <button type="submit" name=ban">Ban User</button>

    </form>


</div>
</body>






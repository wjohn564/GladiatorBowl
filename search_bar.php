<!DOCTYPE html>
<html>
<head>
    <title>Search</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="search_bar.css">
</head>


<?php
if (isset($_POST['search']) and $_POST["value_to_search"] != "")
{

    $value_to_search = $_POST["value_to_search"];
    //$query = "SELECT * FROM `user_t` WHERE (CONCAT('user_id', 'fisrt_name', 'last_name') LIKE '%".$value_to_search."%')";
    //$query = "SELECT * FROM `user_t` WHERE strpos( CONCAT('user_id', 'fisrt_name', 'last_name'),'$value_to_search'";
    $query = "SELECT * FROM `user_t` WHERE user_id = '$value_to_search' OR first_name = '$value_to_search' OR last_name = '$value_to_search'";
    $search_result = filterTable($query);
}
else
{
    $query = "SELECT * FROM `user_t`";
    $search_result = filterTable($query);
}

function filterTable($query)
{
    $connect = mysqli_connect("localhost", "id20430866_grp16login", "()^a12$1U1y3Fzqw","id20430866_gladiator_db");
    $filter_result = mysqli_query($connect, $query);
    return $filter_result;
}

?>

<body>

<div>
    <form action="search_bar.php" method="post">
        <div class="container">
            <div class="row">
                <div class="col-5.5">

                    <h2 class="col-3" style="color:#100d2b">Search :</h2>

                    <input class="search-request" type="text" name="value_to_search">
                    <input class="submit-button" type="submit" name="search" value="Enter">
                    <br><br><br>

                    <hr class="mb-2">

                    <table class="table">
                        <tr style="color:#100d2b">
                            <th>Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                        </tr>

                        <?php while ($row = mysqli_fetch_array($search_result)): ?>
                            <tr>
                                <td> <?php echo $row["user_id"] ?></td>
                                <td> <?php echo $row["first_name"] ?></td>
                                <td> <?php echo $row["last_name"] ?></td>
                            </tr>
                        <?php endwhile; ?>


                    </table>


                </div>
            </div>
        </div>
    </form>
</div>

</body>
</html>


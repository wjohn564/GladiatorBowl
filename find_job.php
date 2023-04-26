<?php
session_start();

$user = $_SESSION['user'];
$prof = $user['user_type'];
$user_id = $user['user_id'];

require_once "config.php";
require_once "session.php";


require_once "banner.php";

$sql = "SELECT * FROM job_t WHERE applied_by = ?";
$stmt = $pdo->prepare($sql);
if (!$stmt->execute([$user_id])) {
    echo "Error: " . $stmt->errorInfo()[2];
    exit();
}

$user_job = $stmt->fetch();



if (isset($_POST["resign"])) {
    $job_title = $user_job["title"];

    $sql = "DELETE FROM job_t WHERE title='$job_title'";
    $stmt = $pdo->prepare($sql);

    if (!$stmt->execute([$user_id])) {
        echo "Error: " . $stmt->errorInfo()[2];
        exit();
    }

    unset($user_job);

    echo '<h6 style="color: red; text-align: center;"> You have Resigned, best of luck!</h6>';
}

if (isset($_POST["apply_job"])) {


    if (!($user_job)) {
        $job_title = $_POST['job_title'];

        $sql = "UPDATE job_t SET applied_by=? WHERE title='$job_title'";
        $stmt = $pdo->prepare($sql);

        if (!$stmt->execute([$user_id])) {
            echo "Error: " . $stmt->errorInfo()[2];
            exit();
        }
        $user_job = $stmt->fetch();
        echo "Applied to job successfully!";

    }
    else {

        echo '<h6 style="color: red; text-align: center;"> You are currently employed please resign before applying for a new job</h6>';
    }

}



$search_query = isset($_GET["search"]) ? $_GET["search"] : "";
if (!empty($search_query)) {
    $stmt = $pdo->prepare("SELECT * FROM job_t WHERE title LIKE :search");
    $stmt->execute(array(":search" => "%" . $search_query . "%"));
}

if ($prof == 'manager') {
    $query = "SELECT * FROM job_t WHERE job_need = 'manager' AND applied_by IS Null";
}

if ($prof == 'fighter') {
    $query = "SELECT * FROM job_t WHERE job_need = 'fighter' AND applied_by IS NULL";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Find a Job</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="find_job.css">
</head>
<body>


<form action="find_job.php" method="get">
    <input type="text" name="search" placeholder="Search job titles..."
           value="<?php echo htmlspecialchars($search_query); ?>">
    <button type="submit">Search</button>
</form>

<?php

if ($user_job) {

    echo '<div class="job-card" style="text-align: center;">';
    echo 'current job: ';
    echo '<h4>' . $user_job["title"] . '</h4>';
    echo '<br>';
    echo '<p>' . $user_job["description"] . '</p>';
    echo '<form method="post">';
    echo '<button type="submit" name="resign">Resign</button>';
    echo '</form>';
    echo '</div>';
}
?>

<?php
$search_job_result = filterTable($query);


while ($row = mysqli_fetch_array($search_job_result)) {
    echo '<div class="card">';
    echo '<h2>' . htmlspecialchars($row['title']) . '</h2>';
    echo '<p>' . htmlspecialchars($row['description']) . '</p>';
    echo '<form method="post">';
    echo '<input type="hidden" name="job_title" value="' . htmlspecialchars($row['title']) . '">';
    echo '<input type="hidden" name="job_description" value="' . htmlspecialchars($row['description']) . '">';
    echo '<button type="submit" name="apply_job">Apply</button>';
    echo '</form>';
    echo '</div>';
}
?>

</body>
<?php
require_once "footer.php";
?>
</html>

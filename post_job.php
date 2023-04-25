<?php
require_once "config.php";
require_once "session.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Post your Job</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="post_job.css">
</head>
<body>
<?php
require_once "banner.php";
if (isset($_POST["post_job"])) {
    $job_title = $_POST['job_title'];
    $job_description = $_POST['job_description'];

    // create insert
    $sql = "INSERT INTO job_t (title, description) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);

    if (!$stmt->execute([$job_title, $job_description])) {
        echo "Error: " . $stmt->errorInfo()[2];
        exit();
    }

    echo "Job inserted into DB successfully" . $job_title;

}
?>


<div>
    <form action="post_job.php" method="post">
        <div class="container">
            <div class="row">
                <div class="col-5.5">
                    <h1>Post Your Job Here</h1>
                    <hr class="mb-2">

                    <div class="form-group">
                        <label class="my-3" for="job_title"><b>Job Title</b></label>
                        <input class="form-control" type="text" name="job_title" required>
                    </div>

                    <div class="form-group">
                        <label class="my-3" for="job_description"><b>Job Description</b></label>
                        <textarea class="form-control" name="job_description" rows="5" required></textarea>
                    </div>

                    <input class="submit-button my-3" type="submit" name="post_job" value="Post Job">
                </div>
            </div>
        </div>
    </form>
</div>


</body>
<?php
require_once "footer.php";
?>
</html>

<?php
include("../Assets/Connection/connection.php");
session_start();
include("Head.php");
$uid = $_SESSION['uid'];
$jid = isset($_GET['job_id']) ? $_GET['job_id'] : 0;

if (isset($_POST['btn_apply'])) {
    //To upload resume
    $resumeName = $_FILES["file_resume"]["name"];
    $tempName   = $_FILES["file_resume"]["tmp_name"];
    move_uploaded_file($tempName, "../Assets/Files/UserResume/" . $resumeName);

    // insert user deatils to table without reading with textboxes
    $insQry = "INSERT INTO tbl_apply 
               (apply_date, apply_status, apply_file, user_id, job_post_id)
               VALUES 
               (curdate(), 'Applied', '" . $resumeName . "', '" . $uid . "', '" . $jid . "')";

    if ($con->query($insQry)) {
        ?>
        <script>
            alert("Application submitted successfully");
            window.location = "ViewPost.php";
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Error: <?php echo $con->error; ?>");
        </script>
        <?php
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<title>JobC – Job Apply</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="../Assets/Templates/Main/css/bootstrap.min.css" rel="stylesheet">
<link href="../Assets/Templates/Main/css/style.css" rel="stylesheet">
<link href="../Assets/Templates/Main/css/JobPost.css" rel="stylesheet">
<script src="../Assets/Templates/Main/JQ/jQuery.js"></script>

<!-- some extra styles for the page -->
<style>
  .skill-box {
    border: 1px solid #ced4da;
    border-radius: .375rem;
    padding: 10px 15px;
    max-height: 180px;
    overflow-y: auto;
    background: #f9f9f9;
}
.skill-box label {
    display: block;
    margin-bottom: 6px;
    cursor: pointer;
}
.job-post-body .form-group label i.fas {
    color: #0d6efd;
}
</style>


</head>

<body>
<div class="container-xxl bg-white p-0">
    <div class="job-post-container">
        <div class="job-post-card">
            <div class="job-post-header">
                <h2><font color="white"> Apply For Job</font></h2>
                <p>Upload Your Resume Here</p>
            </div>

            <form method="post" enctype="multipart/form-data">
                <div class="job-post-body">

                    <div class="form-group">
                        <label><i class="fas fa-file-alt"></i> Resume (PDF/DOC/DOCX)</label>
                        <input type="file" name="file_resume" class="form-control" required accept=".pdf,.doc,.docx">
                        <small class="text-muted">Please upload your latest resume in PDF, DOC, or DOCX format</small>
                    </div>

                </div><!-- body -->

                <div class="form-actions">
                    <button type="submit" name="btn_apply" class="btn-submit">
                        <i class="fas fa-paper-plane"></i> Apply Now
                    </button>
                    <button type="reset" class="btn-reset">
                        <i class="fas fa-redo"></i> Reset
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include('Foot.php'); ?>
</body>
</html>
<?php
include("../Assets/Connection/connection.php");
session_start();
include('Head.php');

//Check user 
if(!isset($_SESSION['uid'])){
    header('Location: Login.php');
    exit;
}

$userId = (int)$_SESSION['uid'];

// Handle Bookmark
if(isset($_GET['action']) && $_GET['action'] == 'add' && isset($_GET['job_id'])){
    $jobId = (int)$_GET['job_id'];
    
    // Check if already bookmarked
    $checkQuery = "SELECT * FROM tbl_job_bookmark WHERE user_id = $userId AND job_poster_id = $jobId";
    $checkResult = mysqli_query($con, $checkQuery);
    
    if(mysqli_num_rows($checkResult) == 0){
        // Add bookmark
        $insertQuery = "INSERT INTO tbl_job_bookmark (user_id, job_poster_id) VALUES ($userId, $jobId)";
        mysqli_query($con, $insertQuery);
        $successMsg = "Job bookmarked successfully!";
    } else {
        $infoMsg = "";
    }
}

// Remove Bookmark
if(isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['job_id'])){
    $jobId = (int)$_GET['job_id'];
    
    $deleteQuery = "DELETE FROM tbl_job_bookmark WHERE user_id = $userId AND job_poster_id = $jobId";
    mysqli_query($con, $deleteQuery);
    $successMsg = "Bookmark removed successfully!";
}

// Fetch all bookmarked jobs
$sql = "SELECT 
            jp.*,
            jc.job_category_name,
            jt.job_type_name,
            c.company_name,
            c.company_logo
            
        FROM 
            tbl_job_bookmark b
        INNER JOIN 
            tbl_job_poster jp ON b.job_poster_id = jp.job_post_id
        LEFT JOIN 
            tbl_job_category jc ON jp.job_category_id = jc.job_category_id
        LEFT JOIN 
            tbl_job_type jt ON jp.job_type_id = jt.job_type_id
        LEFT JOIN 
            tbl_company c ON jp.company_id = c.company_id
        WHERE 
            b.user_id = $userId
      ";

$result = mysqli_query($con, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

//display bookmarked job
function displayBookmarkedJob($job) {
    global $userId;
    $logoPath = isset($job['company_logo']) && !empty($job['company_logo']) 
        ? "../Assets/Files/CompanyDocs/" . $job['company_logo'] 
        : "../Assets/Files/CompanyDocs/company_null.jpeg";
    
    $jobTypeName = isset($job['job_type_name']) ? $job['job_type_name'] : 'Full Time';
    ?>
    <div class="job-item p-4 mb-4">
        <div class="row g-4">
            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                <a href="ViewCompanyProfile.php?company_id=<?php echo $job['company_id']; ?>">
             <!--logo-->       <img class="flex-shrink-0 img-fluid border rounded"
                      src="<?php echo htmlspecialchars($logoPath); ?>"
                         alt="<?php echo htmlspecialchars($job['company_name']); ?>"
                         style="width: 80px; height: 80px;">
                </a>
                <div class="text-start ps-4">
                    <h5 class="mb-3"><?php echo htmlspecialchars($job['job_post_title']); ?></h5>
                    <span class="text-truncate me-3">
                        <i class="fa fa-map-marker-alt text-primary me-2"></i>
                        <?php echo htmlspecialchars($job['job_post_location']); ?>
                    </span>
                    <span class="text-truncate me-3">
                        <i class="far fa-clock text-primary me-2"></i>
                        <?php echo htmlspecialchars($jobTypeName); ?>
                    </span>
                    <span class="text-truncate me-0">
                        <i class="fas fa-business-time text-primary me-2"></i>
                        <?php echo htmlspecialchars($job['job_post_experience']); ?> Years
                    </span>
                    <br>
                    <small class="text-muted mt-2 d-block">
                       
                       
                    </small>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                <div class="d-flex mb-3"> 
                    <a class="btn btn-secondary" href="JobDetail.php?job_id=<?php echo $job['job_post_id']; ?>">
                        View Now
                    </a>
                    &nbsp;&nbsp;
                    <a class="btn btn-primary" href="ApplyNow.php?job_id=<?php echo $job['job_post_id']; ?>">
                        Apply Now
                    </a>
                    &nbsp;&nbsp;
                    <a class="btn btn-danger" 
                       href="Bookmarks.php?action=remove&job_id=<?php echo $job['job_post_id']; ?>"
                       onclick="return confirm('Remove this job from bookmarks?');">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
                <small class="text-truncate">
                    <i class="far fa-calendar-alt text-primary me-2"></i>
                    Deadline: <?php echo date('d M, Y', strtotime($job['job_post_deadline'])); ?>
                </small>
            </div>
        </div>
    </div>
    <?php
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>My Bookmarked Jobs - JobC</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <!-- Favicon -->
    <link href="../Assets/Templates/Main/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../Assets/Templates/Main/lib/animate/animate.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../Assets/Templates/Main/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../Assets/Templates/Main/css/style.css" rel="stylesheet">
</head>

<body>

<!-- Page Header -->
<div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
    <div class="container">
        <div class="row g-2">
            <div class="col-md-10" >
                <h1 class="display-6 text-white mb-0">
                   <center> <i class="fas fa-bookmark me-3"></i>My Bookmarked Jobs </center>
                </h1>
            </div>
            
        </div>
    </div>
</div>

<!-- Messages -->
<?php if(isset($successMsg)): ?>
<div class="container">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i><?php echo $successMsg; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
</div>
<?php endif; ?>

<!-- Bookmarked Jobs -->
<div class="container-xxl py-5">
    <div class="container">
        <?php if(mysqli_num_rows($result) > 0): ?>
            <div class="row mb-4">
                <div class="col-12">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        You have <strong><?php echo mysqli_num_rows($result); ?></strong> bookmarked jobs
                    </div>
                </div>
            </div>
            
            <?php while($job = mysqli_fetch_assoc($result)): ?>
                <?php displayBookmarkedJob($job); ?>
            <?php endwhile; ?>
            
        <?php else: ?>
            <div class="text-center py-5">
                <i class="fas fa-bookmark fa-5x text-muted mb-4"></i>
                <h4 class="mb-3">No Bookmarked Jobs Yet!</h4>
                <p class="text-muted mb-4">Start bookmarking jobs you're interested in to view them here.</p>
                <a href="ViewPost.php" class="btn btn-primary">
                    <i class="fas fa-search me-2"></i>Browse Jobs
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../Assets/Templates/Main/lib/wow/wow.min.js"></script>
<script src="../Assets/Templates/Main/lib/easing/easing.min.js"></script>

<!-- Template Javascript -->
<script src="../Assets/Templates/Main/js/main.js"></script>

</body>
</html>

<?php include('Foot.php'); ?>
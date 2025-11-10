<?php
include("../Assets/Connection/connection.php");
session_start();
include('Head.php');

// Get job ID from URL(that clicked job from other page)
$job_id = isset($_GET['job_id']) ? intval($_GET['job_id']) : 0;

if ($job_id == 0) {
    echo "<script>alert('Invalid Job ID'); window.location='ViewPost.php';</script>";
    exit;
}

// Fetch job details 
$sql = "SELECT 
            jp.*,
            jc.job_category_name,
            jt.job_type_name,
            c.company_name,
            c.company_logo,
            c.company_address,
            c.company_contact,
            c.company_email
        FROM 
            tbl_job_poster jp
        LEFT JOIN 
            tbl_job_category jc ON jp.job_category_id = jc.job_category_id
        LEFT JOIN 
            tbl_job_type jt ON jp.job_type_id = jt.job_type_id
        LEFT JOIN 
            tbl_company c ON jp.company_id = c.company_id
        WHERE 
            jp.job_post_id = ? AND jp.job_post_status = 1";

$stmt = $con->prepare($sql);
$stmt->bind_param("i", $job_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<script>alert('Job not found or no longer available'); window.location='ViewPost.php';</script>";
    exit;
}

$job = $result->fetch_assoc();

// Set values
$logoPath = isset($job['company_logo']) && !empty($job['company_logo']) 
    ? "../Assets/Files/CompanyDocs/" . $job['company_logo'] 
    : "../Assets/Templates/Main/img/company_null.jpeg";

$jobTypeName = isset($job['job_type_name']) ? $job['job_type_name'] : 'Full Time';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($job['job_post_title']); ?> - Job Details</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">          
    <meta content="" name="keywords">
    <meta content="" name="description">

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
    <link href="../Assets/Templates/Main/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../Assets/Templates/Main/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../Assets/Templates/Main/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
        <div class="container">
            <div class="row g-2">
                <div class="col-md-10">
                    <h1 class="display-6 text-white mb-0">Job Details</h1>
                </div>
                <div class="col-md-2">
                    <a href="ViewPost.php" class="btn btn-light w-100">
                        <i class="fa fa-arrow-left me-2"></i>Back to Jobs
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Job detail Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row gy-5 gx-4">
                <div class="col-lg-8">
                    <!-- logo & name -->
                    <div class="d-flex align-items-center mb-5">
                        <a href="ViewCompanyProfile.php?company_id=<?php echo $job['company_id']; ?>">
                <img class="flex-shrink-0 img-fluid border rounded"
                src="<?php echo htmlspecialchars($logoPath); ?>"
                alt="<?php echo htmlspecialchars($job['company_name']); ?>"
                style="width: 80px; height: 80px;">
                </a>
                        <div class="text-start ps-4"><!-- title -->
                            <h3 class="mb-3"><?php echo htmlspecialchars($job['job_post_title']); ?></h3>
                            <span class="text-truncate me-3"><!-- loc -->
                                <i class="fa fa-map-marker-alt text-primary me-2"></i>
                                <?php echo htmlspecialchars($job['job_post_location']); ?>
                            </span><!-- jobtype  -->
                            <span class="text-truncate me-3">
                                <i class="far fa-clock text-primary me-2"></i>
                                <?php echo htmlspecialchars($jobTypeName); ?>
                            </span><!-- salary -->
                            <span class="text-truncate me-0">
                                <i class="far fa-money-bill-alt text-primary me-2"></i>
                                ₹<?php echo htmlspecialchars($job['job_post_salary']); ?>
                            </span>
                        </div>
                    </div>
<!-- description -->
                    <div class="mb-5">
                        <h4 class="mb-3">Job Description</h4>
                        <p><?php echo nl2br(htmlspecialchars($job['job_post_content'])); ?></p>
<!-- responsibilities -->                       
                        <?php if (!empty($job['job_post_responsibility'])): ?>
                        <h4 class="mb-3">Responsibilities</h4>
                        <p><?php echo nl2br(htmlspecialchars($job['job_post_responsibility'])); ?></p>
                        <?php endif; ?>
 <!-- qual -->                       
                        <?php if (!empty($job['job_post_qualification'])): ?>
                        <h4 class="mb-3">Qualifications</h4>
                        <p><?php echo nl2br(htmlspecialchars($job['job_post_qualification'])); ?></p>
                        <?php endif; ?>
<!-- skills need -->                     
                        <?php if (!empty($job['job_post_skills'])): ?>
                        <h4 class="mb-3">Required Skills</h4>
                        <p><?php echo nl2br(htmlspecialchars($job['job_post_skills'])); ?></p>
                        <?php endif; ?>
                    </div>
  <!-- apply button -->  
                    <div class="">
                        <h4 class="mb-4">Apply For This Job</h4>
                        <?php if (isset($_SESSION['uid'])): ?>
                        <div class="text-center">
                            <a href="ApplyNow.php?job_id=<?php echo $job['job_post_id']; ?>" 
                               class="btn btn-primary py-3 px-5">
                                <i class="fa fa-paper-plane me-2"></i>Apply Now
                            </a>

        <!-- bookmark jobs-->
<?php
// Check if job is already bookmarked
$isBookmarked = false;
if(isset($_SESSION['uid'])){
    $checkBookmark = mysqli_query($con, "SELECT * FROM tbl_job_bookmark 
                                          WHERE user_id = {$_SESSION['uid']} 
                                          AND job_poster_id = {$job['job_post_id']}");
    $isBookmarked = mysqli_num_rows($checkBookmark) > 0;
}
?>


<?php if(!$isBookmarked): ?>
    <a href="Bookmarks.php?action=add&job_id=<?php echo $job['job_post_id']; ?>" 
       class="btn btn-warning py-3 px-5">
        <i class="far fa-bookmark me-2"></i>Bookmark Job
    </a>
    <?php else: ?>
    <a href="Bookmarks.php" class="btn btn-success py-3 px-5">
        <i class="fas fa-bookmark me-2"></i>Already Bookmarked
    </a>
    <?php endif; ?>
    
    
</div>
<br>
<a href="ReportJob.php?job_id=<?php echo $job['job_post_id']; ?>" 
class="btn btn-danger py-3 px-5">
        <i class="fas fa-user-secret me-2"></i>Report Job
    </a>





                        <?php else: ?>
                        <div class="alert alert-warning">
                            Please <a href="Login.php">login</a> to apply for this job.
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
    <!--summary -->
                <div class="col-lg-4">
                    <div class="bg-light rounded p-5 mb-4 wow slideInUp" data-wow-delay="0.1s">
                        <h4 class="mb-4">Job Summary</h4>
                        <p><i class="fa fa-angle-right text-primary me-2"></i>
                            <strong>Published On:</strong> <?php echo date('d M, Y', strtotime($job['job_post_date'])); ?>
                        </p>
                        <p><i class="fa fa-angle-right text-primary me-2"></i>
                            <strong>Vacancy:</strong> <?php echo htmlspecialchars($job['job_post_vacancy']); ?> Position(s)
                        </p>
                        <p><i class="fa fa-angle-right text-primary me-2"></i>
                            <strong>Job Type:</strong> <?php echo htmlspecialchars($jobTypeName); ?>
                        </p>
                        <p><i class="fa fa-angle-right text-primary me-2"></i>
                            <strong>Experience:</strong> <?php echo htmlspecialchars($job['job_post_experience']); ?> Years
                        </p>
                        <p><i class="fa fa-angle-right text-primary me-2"></i>
                            <strong>Salary:</strong> ₹<?php echo htmlspecialchars($job['job_post_salary']); ?>
                        </p>
                        <p><i class="fa fa-angle-right text-primary me-2"></i>
                            <strong>Location:</strong> <?php echo htmlspecialchars($job['job_post_location']); ?>
                        </p>
                        <p><i class="fa fa-angle-right text-primary me-2"></i>
                            <strong>Category:</strong> <?php echo htmlspecialchars($job['job_category_name']); ?>
                        </p>
                        <p class="m-0"><i class="fa fa-angle-right text-primary me-2"></i>
                            <strong>Deadline:</strong> <?php echo date('d M, Y', strtotime($job['job_post_deadline'])); ?>
                        </p>
                    </div>
                    <!-- about company -->
                    <div class="bg-light rounded p-5 wow slideInUp" data-wow-delay="0.1s">
                        <h4 class="mb-4">Company Details</h4>
                        <p><strong><?php echo htmlspecialchars($job['company_name']); ?></strong></p>
                        
                        <?php if (!empty($job['company_address'])): ?>
                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>
                            <?php echo htmlspecialchars($job['company_address']); ?>
                        </p>
                        <?php endif; ?>
                        
                        <?php if (!empty($job['company_contact'])): ?>
                        <p><i class="fa fa-phone text-primary me-2"></i>
                            <?php echo htmlspecialchars($job['company_contact']); ?>
                        </p>
                        <?php endif; ?>
                        
                        <?php if (!empty($job['company_email'])): ?>
                        <p class="m-0"><i class="fa fa-envelope text-primary me-2"></i>
                            <?php echo htmlspecialchars($job['company_email']); ?>
                        </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Job Detail End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../Assets/Templates/Main/lib/wow/wow.min.js"></script>
    <script src="../Assets/Templates/Main/lib/easing/easing.min.js"></script>
    <script src="../Assets/Templates/Main/lib/waypoints/waypoints.min.js"></script>
    <script src="../Assets/Templates/Main/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="../Assets/Templates/Main/js/main.js"></script>
</body>
</html>

<?php include('Foot.php'); ?>
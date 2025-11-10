<?php
include("../Assets/Connection/connection.php");
include("Head.php");
// this page shows all the jobs with specific category
//category ID
$categoryId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch category details and jobs
$categoryName = '';
$categoryQuery = "SELECT job_category_name FROM tbl_job_category WHERE job_category_id = $categoryId";
$categoryResult = mysqli_query($con, $categoryQuery);
if ($categoryResult && mysqli_num_rows($categoryResult) > 0) {
    $categoryData = mysqli_fetch_assoc($categoryResult);
    $categoryName = $categoryData['job_category_name'];
}

// Fetch jobs for this category with company details
$jobsQuery = "
    SELECT 
        j.*,
        c.company_name,
        c.company_logo,
        t.job_type_name
    FROM tbl_job_poster j
    INNER JOIN tbl_company c ON j.company_id = c.company_id
    LEFT JOIN tbl_job_type t ON j.job_type_id = t.job_type_id
    WHERE j.job_category_id = $categoryId 
    AND j.job_post_status = 1
    AND c.company_status = 1
    ORDER BY j.job_post_date DESC
";
$jobsResult = mysqli_query($con, $jobsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Jobs in <?php echo htmlspecialchars($categoryName); ?> - JobC</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

<!-- This page shows all the jobs with specific category -->
    
    <!-- Favicon -->
    <link href="./Assets/Templates/Main/img/favicon.ico" rel="icon">

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

<!-- some extra styles -->
    <style>
        .category-header {
            background: linear-gradient(135deg, #0d6efd 0%, #0d6efd 100%);
            padding: 80px 0 60px;
            margin-bottom: 0;
        }
        .breadcrumb-custom {
            background: transparent;
            padding: 0;
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="container-xxl bg-white p-0">
        
        <!-- Category Header -->
        <div class="category-header">
            <div class="container">
                <h1 class="display-4 text-white mb-3 animated slideInDown">
                    <?php echo htmlspecialchars($categoryName); ?> Jobs
                </h1>
                <nav class="breadcrumb-custom">
                    <a href="index.php" class="text-white text-decoration-none">
                        <i class="fa fa-home me-2"></i>Home
                    </a>
                    <span class="text-white mx-2">/</span>
                    <span class="text-white"><?php echo htmlspecialchars($categoryName); ?></span>
                </nav>
            </div>
        </div>

        <!-- Jobs List section -->
        <div class="container-xxl py-5">
            <div class="container">
                
                <!-- Title -->
                <div class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                    <h2 class="mb-3">Available Positions</h2>
                    <p class="text-muted">
                        <i class="fa fa-briefcase text-primary me-2"></i>
                        <?php echo mysqli_num_rows($jobsResult); ?> 
                        <?php echo mysqli_num_rows($jobsResult) == 1 ? 'Job' : 'Jobs'; ?> Found
                    </p>
                </div>

                <!-- Jobs Listing -->
                <div class="tab-content">
                    <?php
                    if ($jobsResult && mysqli_num_rows($jobsResult) > 0) {
                        $delay = 0.1;
                        while ($job = mysqli_fetch_assoc($jobsResult)) {
                            $daysLeft = floor((strtotime($job['job_post_deadline']) - time()) / (60 * 60 * 24));
                            $urgentClass = $daysLeft < 7 ? 'text-danger' : '';

                            //logo

                            $logoPath = isset($job['company_logo']) && !empty($job['company_logo']) 
                                ? "../Assets/Files/CompanyDocs/" . $job['company_logo'] 
                                : "../Assets/Files/CompanyDocs/company_null.jpeg";
                            
                            $jobTypeName = isset($job['job_type_name']) ? $job['job_type_name'] : 'Full Time';
                    ?>
                    <!-- display logo -->
                            <div class="job-item p-4 mb-4 wow fadeInUp" data-wow-delay="<?php echo number_format($delay, 1); ?>s">
                                <div class="row g-4">
                                    <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                        <a href="ViewCompanyProfile.php?company_id=<?php echo $job['company_id']; ?>">
                <img class="flex-shrink-0 img-fluid border rounded"
                src="<?php echo htmlspecialchars($logoPath); ?>"
                alt="<?php echo htmlspecialchars($job['company_name']); ?>"
                style="width: 80px; height: 80px;">
                </a>
                <!-- title -->
                                        <div class="text-start ps-4">
                                            <h5 class="mb-3">
                                                <?php echo htmlspecialchars($job['job_post_title']); ?>
                                            </h5>
                                            <span class="text-truncate me-3">
                                                <i class="fa fa-building text-primary me-2"></i>

                                        <!-- name -->    
                                             <?php echo htmlspecialchars($job['company_name']); ?>
                                            </span>
                                            <!-- loc -->
                                            <span class="text-truncate me-3">
                                                <i class="fa fa-map-marker-alt text-primary me-2"></i>
                                                <?php echo htmlspecialchars($job['job_post_location']); ?>
                                            </span>
                                            <!-- type -->
                                            <span class="text-truncate me-3">
                                                <i class="far fa-clock text-primary me-2"></i>
                                                <?php echo htmlspecialchars($jobTypeName); ?>
                                            </span>
                                            <!-- experience -->
                                            <span class="text-truncate me-0">
                                                <i class="fas fa-business-time text-primary me-2"></i>
                                                <?php echo htmlspecialchars($job['job_post_experience']); ?> Years
                                            </span>
                                        </div>
                                    </div>
<!-- job detailed -->
                                    <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                        <div class="d-flex mb-3">
                                            <a class="btn btn-secondary" href="JobDetail.php?job_id=<?php echo $job['job_post_id']; ?>">
                                                View Now
                                            </a>
                                            &nbsp;&nbsp;
        <!-- apply button -->
                                            <a class="btn btn-primary" href="ApplyNow.php?job_id=<?php echo $job['job_post_id']; ?>">
                                                Apply Now
                                            </a>
                                        </div>
                                        <small class="text-truncate <?php echo $urgentClass; ?>">
                                            <i class="far fa-calendar-alt text-primary me-2"></i>
                                            Deadline: <?php echo date("d M, Y", strtotime($job['job_post_deadline'])); ?>
                                        </small>
                                        <?php if ($daysLeft > 0): ?>
                                            <small class="text-muted">
                                                (<?php echo $daysLeft; ?> days left)
                                            </small>
                                        <?php elseif ($daysLeft == 0): ?>
                                            <small class="text-warning">
                                                (Closes Today!)
                                            </small>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                    <?php
                            $delay += 0.1;
                        }
                    } else {
                        
                    ?>
                        <div class="text-center py-5 wow fadeInUp">
                            <i class="fas fa-search fa-5x text-muted mb-4"></i>
                            <h3 class="mb-3">No Jobs Found</h3>
                            <p class="text-muted mb-4">
                                There are currently no active job postings in this category.<br>
                                Check back later or explore other categories.
                            </p>
                            <a href="HomePage.php" class="btn btn-primary px-5">
                                <i class="fa fa-arrow-left me-2"></i>Back to Home
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>

                <!-- Back button -->
                <?php if (mysqli_num_rows($jobsResult) > 0): ?>
                <div class="text-center mt-5 wow fadeInUp" data-wow-delay="0.3s">
                    <a class="btn btn-outline-primary py-3 px-5" href="HomePage.php">
                        <i class="fa fa-arrow-left me-2"></i>Explore More Categories
                    </a>
                </div>
                <?php endif; ?>

            </div>
        </div>
        <!-- Jobs List End -->

    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../Assets/Templates/Main/lib/wow/wow.min.js"></script>
    <script src="../Assets/Templates/Main/lib/easing/easing.min.js"></script>
    <script src="../Assets/Templates/Main/lib/waypoints/waypoints.min.js"></script>
    <script src="../Assets/Templates/Main/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="../Assets/Templates/Main/js/main.js"></script>

    <script>
        //  WOW.js for animations
        new WOW().init();
    </script>
</body>
</html>
<?php include("Foot.php"); ?>
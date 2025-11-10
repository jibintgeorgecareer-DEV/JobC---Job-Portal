<?php
include("../Assets/Connection/Connection.php");
include("Head.php");
//The page shows serch results enters by the search bar
//Every search bar points to this page

// Get search keyword
$keyword = "";
if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - JobC</title>
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
<!-- extra styles -->
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
                    Search Results
                </h1>
                <nav class="breadcrumb-custom">
                    <a href="HomePage.php" class="text-white text-decoration-none">
                        <i class="fa fa-home me-2"></i>Home
                    </a>
                    <span class="text-white mx-2">/</span>
                    <span class="text-white">Search: "<?php echo htmlspecialchars($keyword); ?>"</span>
                </nav>
            </div>
        </div>

        <!-- Jobs List Section -->
        <div class="container-xxl py-5">
            <div class="container">
                
                <?php
                if (!empty($keyword)) {
                    // Search query with JOIN to get company details
                    $searchQuery = "SELECT 
                        jp.job_post_id,
                        jp.job_post_title,
                        jp.job_post_content,
                        jp.job_post_location,
                        jp.job_post_salary,
                        jp.job_post_experience,
                        jp.job_post_vacancy,
                        jp.job_post_deadline,
                        jp.job_post_qualification,
                        jp.additional_skill,
                        c.company_name,
                        c.company_logo,
                        c.company_id,
                        jt.job_type_name,
                        jc.job_category_name
                    FROM tbl_job_poster jp
                    INNER JOIN tbl_company c ON jp.company_id = c.company_id
                    INNER JOIN tbl_job_type jt ON jp.job_type_id = jt.job_type_id
                    INNER JOIN tbl_job_category jc ON jp.job_category_id = jc.job_category_id
                    WHERE jp.job_post_status = 1 
                    AND c.company_status = 1
                    AND (jp.job_post_title LIKE '%$keyword%' 
                        OR jp.job_post_content LIKE '%$keyword%'
                        OR jc.job_category_name LIKE '%$keyword%'
                        OR c.company_name LIKE '%$keyword%')
                    ORDER BY jp.job_post_date DESC";
                    
                    $result = $con->query($searchQuery);
                    
                    // Page Title
                    ?>
                    <div class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                        <h2 class="mb-3">Search Results for "<?php echo htmlspecialchars($keyword); ?>"</h2>
                        <p class="text-muted">
                            <i class="fa fa-briefcase text-primary me-2"></i>
                            <?php echo $result->num_rows; ?> 
                            <?php echo $result->num_rows == 1 ? 'Job' : 'Jobs'; ?> Found
                        </p>
                    </div>

                    <!-- Jobs Listing  all the details-->
                    <div class="tab-content">
                        <?php
                        if ($result->num_rows > 0) {
                            $delay = 0.1;
                            while ($job = $result->fetch_assoc()) {
                                $daysLeft = floor((strtotime($job['job_post_deadline']) - time()) / (60 * 60 * 24));
                                $urgentClass = $daysLeft < 7 ? 'text-danger' : '';
                                
                                $logoPath = isset($job['company_logo']) && !empty($job['company_logo']) 
                                    ? "../Assets/Files/CompanyDocs/" . $job['company_logo'] 
                                    : "../Assets/Files/CompanyDocs/company_null.jpeg";
                                
                                $jobTypeName = isset($job['job_type_name']) ? $job['job_type_name'] : 'Full Time';
                        ?>
                                <div class="job-item p-4 mb-4 wow fadeInUp" data-wow-delay="<?php echo number_format($delay, 1); ?>s">
                                    <div class="row g-4">
                                        <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                             <a href="ViewCompanyProfile.php?company_id=<?php echo $job['company_id']; ?>">
                                            <img class="flex-shrink-0 img-fluid border rounded"
                                            src="<?php echo htmlspecialchars($logoPath); ?>"
                                            alt="<?php echo htmlspecialchars($job['company_name']); ?>"
                                            style="width: 80px; height: 80px;">
                                            </a>
                                            <div class="text-start ps-4">
                                                <h5 class="mb-3">
                                                    <?php echo htmlspecialchars($job['job_post_title']); ?>
                                                </h5>
                                                <span class="text-truncate me-3">
                                                    <i class="fa fa-building text-primary me-2"></i>
                                                    <?php echo htmlspecialchars($job['company_name']); ?>
                                                </span>
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
                                    No jobs match your search for "<?php echo htmlspecialchars($keyword); ?>".<br>
                                    Try different keywords or explore other categories.
                                </p>
                                <a href="HomePage.php" class="btn btn-primary px-5">
                                    <i class="fa fa-arrow-left me-2"></i>Back to Home
                                </a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>

                    <!-- Back Button -->
                    <?php if ($result->num_rows > 0): ?>
                    <div class="text-center mt-5 wow fadeInUp" data-wow-delay="0.3s">
                        <a class="btn btn-outline-primary py-3 px-5" href="HomePage.php">
                            <i class="fa fa-arrow-left me-2"></i>Explore More Jobs
                        </a>
                    </div>
                    <?php endif; ?>

                <?php
                } else {
                    //If no keyword entered
                ?>
                    <div class="text-center py-5 wow fadeInUp">
                        <i class="fas fa-search fa-5x text-muted mb-4"></i>
                        <h3 class="mb-3">No Search Query</h3>
                        <p class="text-muted mb-4">
                            Please enter a keyword to search for jobs.
                        </p>
                        <a href="HomePage.php" class="btn btn-primary px-5">
                            <i class="fa fa-arrow-left me-2"></i>Back to Home
                        </a>
                    </div>
                <?php
                }
                ?>

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
</body>
</html>
<?php
//This page shows random job posts by Intership,Fresher,Experienced
include("../Assets/Connection/connection.php");
session_start();
include('Head.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>JobC - View Jobs</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">          
    <meta content="" name="keywords">
    <meta content="" name="description">

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
</head>

<body>

 <!-- Search Start -->
       <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
    <div class="container">
         <form action="SearchResult.php" method="GET">
        <div class="row g-2 justify-content-center">
            <div class="col-md-4">
                <input type="text" name="keyword" class="form-control border-0" placeholder="Search by category" />
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-dark border-0 w-100">Search</button>
            </div>
        </div>
        </form>
    </div>
</div>
        <!-- Search End -->



<!-- Jobs Start -->
<?php
// Fetch all active job postings with company and job type
$sql = "SELECT 
            jp.*,
            jc.job_category_name,
            jt.job_type_name,
            c.company_name,
            c.company_logo
        FROM 
            tbl_job_poster jp
        LEFT JOIN 
            tbl_job_category jc ON jp.job_category_id = jc.job_category_id
        LEFT JOIN 
            tbl_job_type jt ON jp.job_type_id = jt.job_type_id
        LEFT JOIN 
            tbl_company c ON jp.company_id = c.company_id
        WHERE 
            jp.job_post_status = 1
        ORDER BY 
            jp.job_post_date DESC";

$result = mysqli_query($con, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

// Categorize jobs by 3
$internships = array();
$freshers = array();
$experienced = array();

if ($result) {
    while($row = mysqli_fetch_assoc($result)) {
        // Check job type for internship using job_type_name
        $jobTypeLower = strtolower(trim($row['job_type_name']));
        
        //internship based on job type
        if (strpos($jobTypeLower, 'intern') !== false) {
            $internships[] = $row;
        } 
        // or, categorize by experience
        else {
            //experience - extract numeric value
            $exp = $row['job_post_experience'];
            
            //numbers from string
            preg_match('/(\d+)/', $exp, $matches);
            $expYears = isset($matches[1]) ? intval($matches[1]) : 0;
            
            // experience is 0-1 years (Freshers)
            if ($expYears <= 1) {
                $freshers[] = $row;
            } 
            //experience>1 year (Experienced)
            else {
                $experienced[] = $row;
            }
        }
    }
}

// Function to display job items
//Company logo
function displayJobItem($job) {
    $logoPath = isset($job['company_logo']) && !empty($job['company_logo']) 
        ? "../Assets/Files/CompanyDocs/" . $job['company_logo'] 
        : "../Assets/Files/CompanyDocs/company_null.jpeg";
    
    $jobTypeName = isset($job['job_type_name']) ? $job['job_type_name'] : 'Full Time';
    
    ?>
    <!-- name -->
    <div class="job-item p-4 mb-4">
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
                    <h5 class="mb-3"><?php echo htmlspecialchars($job['job_post_title']); ?></h5>
                    <span class="text-truncate me-3">
                        <i class="fa fa-map-marker-alt text-primary me-2"></i>
                        <?php echo htmlspecialchars($job['job_post_location']); ?>
                    </span>
                     <!-- ttype -->
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
 <!-- buttons -->
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

<!-- Jobs Start 3 tabs-->
<div class="container-xxl py-5">
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Latest Job Listing</h1>
        <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
            <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-1">
                        <h6 class="mt-n1 mb-0">Internship</h6>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-2">
                        <h6 class="mt-n1 mb-0">Freshers</h6>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 me-0 pb-3" data-bs-toggle="pill" href="#tab-3">
                        <h6 class="mt-n1 mb-0">Experienced</h6>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <!-- Internship Tab -->
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <?php 
                    if (count($internships) > 0) {
                        foreach($internships as $job) {
                            displayJobItem($job);
                        }
                    } else {
                        echo '<div class="alert alert-info">No internship positions available at the moment.</div>';
                    }
                    ?>
                </div>

                <!-- Freshers Tab -->
                <div id="tab-2" class="tab-pane fade show p-0">
                    <?php 
                    if (count($freshers) > 0) {
                        foreach($freshers as $job) {
                            displayJobItem($job);
                        }
                    } else {
                        echo '<div class="alert alert-info">No fresher positions available at the moment.</div>';
                    }
                    ?>
                </div>

                <!-- Experienced Tab -->
                <div id="tab-3" class="tab-pane fade show p-0">
                    <?php 
                    if (count($experienced) > 0) {
                        foreach($experienced as $job) {
                            displayJobItem($job);
                        }
                    } else {
                        echo '<div class="alert alert-info">No experienced positions available at the moment.</div>';
                    }
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Jobs End -->

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
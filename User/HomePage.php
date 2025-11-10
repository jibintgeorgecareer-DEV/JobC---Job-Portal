
<?php
include("SessionValidation.php");
include("../Assets/Connection/connection.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>JobC - User HomePage</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- icon -->
    <link href="../Assets/Templates/Main/img/JobC_logo.png" rel="icon">

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
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start --> 
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
            <a href="HomePage.php" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
                <h1 class="m-0 text-primary">JobC</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- All main links to pages -->
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="HomePage.php" class="nav-item nav-link active">Home</a>
                    <a href="ApplyStatus.php" class="nav-item nav-link">Applications</a>
                    <a href="Bookmarks.php" class="nav-item nav-link ">Bookmarks</a>
                    <a href="About.html" class="nav-item nav-link ">About</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Profile</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="MyProfile.php" class="dropdown-item">My Profile</a>
                            <a href="EditProfile.php" class="dropdown-item">Edit Profile</a>
                            <a href="ChangePassword.php" class="dropdown-item">Change Password</a>
                            <a href="../Guest/LogOut.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                   
                </div>
                <a href="ViewPost.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">New Listings<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </nav>
        <!-- Navbar End -->


        <!-- Carousel Start -->
        <div class="container-fluid p-0">
            <div class="owl-carousel header-carousel position-relative">
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="../Assets/Templates/Main/img/workplace4.jpg" alt="big image">   
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(43, 57, 64, .5);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h1 class="display-3 text-white animated slideInDown mb-4">Thousands of jobs. One perfect fit. Let’s find it.</h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">Discover roles that match your skills and passion.Apply today and take the next step in your career.</p>
                                    <a href="ViewPost.php" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Search A Job</a>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="../Assets/Templates/Main/img/workplace8.jpg" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(43, 57, 64, .5);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h1 class="display-3 text-white animated slideInDown mb-4">Your dream job is out there. Let’s go get it</h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">Every application brings you closer to success.Stay motivated, stay focused, stay moving forward.</p>
                                    <a href="ViewPost.php" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Search A Job</a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel End -->


        <!-- Search bar Start -->
       <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
    <div class="container">
         <form action="SearchResult.php" method="GET">
        <div class="row g-2 justify-content-center">
            <div class="col-md-4">
                <input type="text" name="keyword" class="form-control border-0" placeholder="Search" />
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
// Fetch all active job postings with company and job type (tbl_company,tbl_job_type)
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

//3 categories
$internships = array();
$freshers = array();
$experienced = array();

if ($result) {
    while($row = mysqli_fetch_assoc($result)) {
        // Check job type for internship
        $jobTypeLower = strtolower(trim($row['job_type_name']));
        
        // Check internship based on job type
        if (strpos($jobTypeLower, 'intern') !== false) {
            $internships[] = $row;
        } 
        // Or categorize by experience
        else {
            
            $exp = $row['job_post_experience'];
            
            //  numbers to string for experience
            preg_match('/(\d+)/', $exp, $matches);
            $expYears = isset($matches[1]) ? intval($matches[1]) : 0;
            
            // Check experience is 0-1 years (freshers)
            if ($expYears <= 1) {
                $freshers[] = $row;
            } 
            // experience>1 year (Experienced)
            else {
                $experienced[] = $row;
            }
        }
    }
}

//Job Listings 
function displayJobItem($job) {
    $logoPath = isset($job['company_logo']) && !empty($job['company_logo']) 
        ? "../Assets/Files/CompanyDocs/" . $job['company_logo'] 
        : "../Assets/Templates/Main/img/company_null.jpeg";
    
    $jobTypeName = isset($job['job_type_name']) ? $job['job_type_name'] : 'Full Time';
    
    ?>
    <div class="job-item p-4 mb-4">
        <div class="row g-4">
            <div class="col-sm-12 col-md-8 d-flex align-items-center"><!-- name & com logo -->
                 <a href="ViewCompanyProfile.php?company_id=<?php echo $job['company_id']; ?>">
                <img class="flex-shrink-0 img-fluid border rounded"
                src="<?php echo htmlspecialchars($logoPath); ?>"
                alt="<?php echo htmlspecialchars($job['company_name']); ?>" 
                style="width: 80px; height: 80px;">
                </a>
                <div class="text-start ps-4"><!-- loc -->
                    <h5 class="mb-3"><?php echo htmlspecialchars($job['job_post_title']); ?></h5>
                    <span class="text-truncate me-3">
                        <i class="fa fa-map-marker-alt text-primary me-2"></i>
                        <?php echo htmlspecialchars($job['job_post_location']); ?>
                    </span><!-- job type -->
                    <span class="text-truncate me-3">
                        <i class="far fa-clock text-primary me-2"></i>
                        <?php echo htmlspecialchars($jobTypeName); ?>
                    </span><!-- experience -->
                    <span class="text-truncate me-0">
                        <i class="fas fa-business-time text-primary me-2"></i>
                        <?php echo htmlspecialchars($job['job_post_experience']); ?> Years
                    </span>
                </div>
            </div>
<!-- job details JobDetails.php -->
            <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                <div class="d-flex mb-3"> 
                    <a class="btn btn-secondary" href="JobDetail.php?job_id=<?php echo $job['job_post_id']; ?>">
                        View Now
                    </a>
                    &nbsp;&nbsp;
<!-- applly -->
                    <a class="btn btn-primary" href="ApplyNow.php?job_id=<?php echo $job['job_post_id']; ?>">
                        Apply Now
                    </a>
                </div>
<!-- deadline -->
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

<!-- Jobs Start -->
<div class="container-xxl py-5">
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Job Listing</h1>
        <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
            <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-1">
 <!-- tab 1 -->                  <h6 class="mt-n1 mb-0">Internship</h6>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-2">
 <!-- tab 2 -->                       <h6 class="mt-n1 mb-0">Freshers</h6>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 me-0 pb-3" data-bs-toggle="pill" href="#tab-3">
<!-- tab 3 -->                      <h6 class="mt-n1 mb-0">Experienced</h6>
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



 <!-- Category start -->
<div class="container-xxl py-5">
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Explore By Category</h1>
        <div class="row g-4">

        <?php
        // Live jobs 
        $sql = "
            SELECT  job_category_id,
                    SUM(job_post_vacancy) AS total_vacancy
            FROM    tbl_job_poster
            WHERE   job_post_status = 1
            GROUP BY job_category_id
        ";
        $res = mysqli_query($con, $sql);
        
        if (!$res) {
            die('Vacancy query: ' . mysqli_error($con));
        }

        $vacancies = [];
        while ($row = mysqli_fetch_assoc($res)) {
            $vacancies[ (int)$row['job_category_id'] ] = (int)$row['total_vacancy'];
        }

        
        function getVacancy($catId, $array){
            return isset($array[$catId]) ? $array[$catId] : 0;
        }

        //cards
        $cards = [
            ['icon'=>'fa-mail-bulk',          'name'=>'Sales & Marketing',              'catId'=>3],
            ['icon'=>'fa-headset',            'name'=>'Customer Support & Service',     'catId'=>12],
            ['icon'=>'fa-user-tie',           'name'=>'Human Resources',                'catId'=>4],
            ['icon'=>'fa-tasks',              'name'=>'Data Science & Analytics',       'catId'=>5],
            ['icon'=>'fa-chart-line',         'name'=>'IT & Software Development',      'catId'=>1],
            ['icon'=>'fa-dollar-sign',        'name'=>'Finance & Accounting',           'catId'=>2],
            ['icon'=>'fa-book-reader',        'name'=>'Teaching & Education',           'catId'=>7],
            ['icon'=>'fa-drafting-compass',   'name'=>'Design & Creative',              'catId'=>6],
        ];

        
        $delay = 0.1;
        foreach ($cards as $c):
            $vacCount = getVacancy($c['catId'], $vacancies);
        ?>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="<?php echo number_format($delay, 1); ?>s">
               
                <a class="cat-item rounded p-4" href="ListCategory.php?id=<?php echo $c['catId']; ?>">
                    <i class="fa fa-3x <?php echo $c['icon']; ?> text-primary mb-4"></i>
                    <h6 class="mb-3"><?php echo htmlspecialchars($c['name']); ?></h6>
                    <p class="mb-0"><?php echo $vacCount; ?> <?php echo $vacCount == 1 ? 'Vacancy' : 'Vacancies'; ?></p>
                </a>
            </div>
        <?php
            $delay += 0.2;
        endforeach;
        ?>

        </div>
    </div>
</div>
<!-- Category End -->

        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="row g-0 about-bg rounded overflow-hidden">
                            <div class="col-6 text-start">
                                <img class="img-fluid w-100" src="../Assets/Templates/Main/img/about1.jpg">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid" src="../Assets/Templates/Main/img/about2.jpg" style="width: 85%; margin-top: 15%;">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid" src="../Assets/Templates/Main/img/about3.jpg" style="width: 85%;">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid w-100" src="../Assets/Templates/Main/img/about4.jpg">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="mb-4">We Help You Land Great Jobs.</h1>
                        <p class="mb-4">A smart platform that connects job seekers with top employers—streamlining applications, showcasing skills, and unlocking career opportunities across industries</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Clean, User-Friendly Interface</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Multi-Domain Job Categories</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Secure & Private</p>
                        <a class="btn btn-primary py-3 px-5 mt-3" href="About.html">Read More</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

<!-- Down section -->
        

        <!-- Testimonial Start -->
        <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container">
                <h1 class="text-center mb-5">Our Clients Say!!!</h1>
                <div class="owl-carousel testimonial-carousel">
                    <div class="testimonial-item bg-light rounded p-4">
                        <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                        <p>Its a nice platform for students</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" src="../Assets/Templates/Main/img/bill_gates.jpeg" style="width: 50px; height: 50px;">
                            <div class="ps-3">
                                <h5 class="mb-1">Bill Gates</h5>
                                <small>Businessman</small>
                            </div>
                        </div>
                    </div>
                   <div class="testimonial-item bg-light rounded p-4">
                        <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                        <p>Many indivituals can find best opportunities</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" src="../Assets/Templates/Main/img/sundar_pichai.jpeg" style="width: 50px; height: 50px;">
                            <div class="ps-3">
                                <h5 class="mb-1">Sundar Pichai</h5>
                                <small>CEO Google</small>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded p-4">
                        <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                        <p>Better than LinkedIn</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" src="../Assets/Templates/Main/img/sam_altman.jpeg" style="width: 50px; height: 50px;">
                            <div class="ps-3">
                                <h5 class="mb-1">Sam Altman</h5>
                                <small>CEO OpenAI</small>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded p-4">
                        <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                        <p>Becoming a client at JobC makes my career awsome</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" src="../Assets/Templates/Main/img/elon_musk.jpeg" style="width: 50px; height: 50px;">
                            <div class="ps-3">
                                <h5 class="mb-1">Elon Musk</h5>
                                <small>Entrepreneur</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->
        

       <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Company</h5>
                        <a class="btn btn-link text-white-50" href="About.html">About Us</a>
                        <a class="btn btn-link text-white-50" href="About.html">Privacy Policy</a>
                        <a class="btn btn-link text-white-50" href="Complaint.php">Complaints</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Quick Links</h5>
                        
                        <a class="btn btn-link text-white-50" href="Contact.html">Contact Us</a>
                        <a class="btn btn-link text-white-50" href="MyProfile.php">Profile</a>
                        <a class="btn btn-link text-white-50" href="ViewPost.php">Find Job</a>
                     
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Contact</h5>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Kanjar , Moolamattom</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+91 7012482173</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>jobcofficial.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href="https://www.linkedin.com/in/jibintgeorge"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Newsletter</h5>
                        <p>Stay connected, stay inspired—and let’s build your future together.</p>
                       
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                       
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
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
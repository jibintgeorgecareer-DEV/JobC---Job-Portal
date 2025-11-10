<?php
include("../Assets/Connection/connection.php");
include("SessionValidation.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>JobC - Company HomePage</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
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
<!-- All amin links -->
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="PostList.php" class="nav-item nav-link">Job Posted</a>
                    <a href="CandidateList.php" class="nav-item nav-link">View Candidates</a>
                     
                    
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Profile</a>
                        <div class="dropdown-menu rounded-0 m-0">
                             <a href="CompanyProfile.php" class="dropdown-item">Company Profile</a>
                            <a href="CompanyEditProfile.php" class="dropdown-item">Edit</a>
                            <a href="CompanyChangePassword.php" class="dropdown-item">Change Pasword</a>
                            <a href="../Guest/LogOut.php" class="dropdown-item">Log Out</a>
                           
                        </div>
                    </div>
                    <a href="About.html" class="nav-item nav-link">About</a>
                </div>
                <a href="JobPost.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Post A Job<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </nav>
        <!-- Navbar End -->


        <!-- Carousel Start -->
        <div class="container-fluid p-0">
            <div class="owl-carousel header-carousel position-relative">
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="../Assets/Templates/Main/img/workplace4.jpg" alt="jj">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(43, 57, 64, .5);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h1 class="display-3 text-white animated slideInDown mb-4">Find The Best Talent</h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">Build your dream team with the brightest minds in the industry.</p>
                                    
                                    <a href="#explore-by-category" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Find A Talent</a>
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
                                    <h1 class="display-3 text-white animated slideInDown mb-4">Hire the Best. From 10,000+ Brilliant Minds</h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">Let us help you discover talent that transforms your vision into reality.</p>
                                    
                                    <a href="#explore-by-category" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Find A Talent</a>
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
        <form method="GET" action="SearchResult.php"> 
            <div class="row g-2 justify-content-center">
                <div class="col-md-4">
                    <input type="text" name="keyword" class="form-control border-0" placeholder="Search Candidates" value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>" />
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
//Fetch random candidates 
$user_sql = "SELECT 
                u.user_id,
                u.user_name,
                u.user_address,
                u.user_qualification,
                u.user_photo,
                jc.job_category_name
            FROM 
                tbl_user u
            LEFT JOIN 
                tbl_job_category jc ON u.user_job_category = jc.job_category_id
            ORDER BY RAND()
            LIMIT 6";

$user_result = mysqli_query($con, $user_sql);

if (!$user_result) {
    die("Query failed: " . mysqli_error($con));
}

?>

<div class="container-xxl py-5">
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Top Talent, Ready to Join You</h1>
        <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <?php
                    if (mysqli_num_rows($user_result) > 0) {
                       
                      while($user = mysqli_fetch_assoc($user_result)) {
    $profile_image = !empty($user['user_photo']) //user profile pic
        ? '../Assets/Files/UserPhoto/' . $user['user_photo'] : '../Assets/Files/UserPhoto/profile_null.jpeg';
        
?>
    <div class="job-item p-4 mb-4">
        <div class="row g-4"><!-- Essential Details of candidates -->
            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                <img class="flex-shrink-0 img-fluid border rounded" 
                     src="<?php echo htmlspecialchars($profile_image); ?>" 
                     alt="<?php echo htmlspecialchars($user['user_name']); ?>" 
                     style="width: 80px; height: 80px; object-fit: cover;">
                                <div class="text-start ps-4">
                                    <h5 class="mb-3"><?php echo htmlspecialchars($user['user_name']); ?></h5>
                                    <span class="text-truncate me-3">
                                        <i class="fa fa-map-marker-alt text-primary me-2"></i>
                                        <?php echo htmlspecialchars($user['user_address']); ?>
                                    </span>
                                    <span class="text-truncate me-3">
                                        <i class="fas fa-user-tie text-primary me-2"></i>
                                        <?php echo htmlspecialchars($user['job_category_name']); ?>
                                    </span>
                                    <span class="text-truncate me-0">
                                        <i class="fas fa-graduation-cap text-primary me-2"></i>
                                        <?php echo htmlspecialchars($user['user_qualification']); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                <div class="d-flex mb-3">
                                   <a class="btn btn-primary" href="ViewCandidateProfile.php?id=<?php echo $user['user_id']; ?>">View Profile</a>
                                </div>
                                <small class="text-truncate">
                                    <i class="fas fa-user-check text-primary me-2"></i>OPEN TO WORK
                                </small>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    } else {
                        echo '<div class="col-12"><p class="text-center">No users available at the moment</p></div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
                          
<!-- job list end-->






<!-- Candidates by category-->


<?php
$sql = "SELECT 
            jc.job_category_name,
            COUNT(u.user_id) AS total_users
        FROM 
            tbl_job_category jc
        LEFT JOIN 
            tbl_user u ON jc.job_category_id = u.user_job_category
        GROUP BY 
            jc.job_category_id, jc.job_category_name";

$result = mysqli_query($con, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

// Store categories in array
$categories = array();
if ($result) {
    while($row = mysqli_fetch_assoc($result)) {
        $categories[$row['job_category_name']] = $row['total_users'];
    }
}

function getCategoryCount($categories, $categoryName) {
    return isset($categories[$categoryName]) ? $categories[$categoryName] : 0;
}
?>
<!-- 8 main job Category -->
<div class="container-xxl py-5">
    <div class="container">
        <h1  id="explore-by-category" class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Explore By Category</h1>
        <div class="row g-4">
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <a class="cat-item rounded p-4" href="ListCategory.php?category=<?php echo urlencode('Sales & Marketing'); ?>">
                    <i class="fa fa-3x fa-mail-bulk text-primary mb-4"></i>
                    <h6 class="mb-3">Sales & Marketing</h6>
                    <p class="mb-0"><?php echo getCategoryCount($categories, 'Sales & Marketing'); ?> Profiles</p>
                </a>
            </div>

            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                <a class="cat-item rounded p-4" href="ListCategory.php?category=<?php echo urlencode('IT & Software Development'); ?>">
                    <i class="fa fa-3x fa-headset text-primary mb-4"></i>
                    <h6 class="mb-3">IT & Software Development</h6>
                    <p class="mb-0"><?php echo getCategoryCount($categories, 'IT & Software Development'); ?> Profiles</p>
                </a>
            </div>

            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                <a class="cat-item rounded p-4" href="ListCategory.php?category=<?php echo urlencode('Human Resources'); ?>">
                    <i class="fa fa-3x fa-user-tie text-primary mb-4"></i>
                    <h6 class="mb-3">Human Resources</h6>
                    <p class="mb-0"><?php echo getCategoryCount($categories, 'Human Resources'); ?> Profiles</p>
                </a>
            </div>

            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                <a class="cat-item rounded p-4" href="ListCategory.php?category=<?php echo urlencode('Data Science & Analytics'); ?>">
                    <i class="fa fa-3x fa-tasks text-primary mb-4"></i>
                    <h6 class="mb-3">Data Science & Analytics</h6>
                    <p class="mb-0"><?php echo getCategoryCount($categories, 'Data Science & Analytics'); ?> Profiles</p>
                </a>
            </div>

            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <a class="cat-item rounded p-4" href="ListCategory.php?category=<?php echo urlencode('Customer Support & Service'); ?>">
                    <i class="fa fa-3x fa-chart-line text-primary mb-4"></i>
                    <h6 class="mb-3">Customer Support & Service</h6>
                    <p class="mb-0"><?php echo getCategoryCount($categories, 'Customer Support & Service'); ?> Profiles</p>
                </a>
            </div>

            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                <a class="cat-item rounded p-4" href="ListCategory.php?category=<?php echo urlencode('Finance & Accounting'); ?>">
                    <i class="fa fa-3x fa-dollar-sign text-primary mb-4"></i>
                    <h6 class="mb-3">Finance & Accounting</h6>
                    <p class="mb-0"><?php echo getCategoryCount($categories, 'Finance & Accounting'); ?> Profiles</p>
                </a>
            </div>

            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                <a class="cat-item rounded p-4" href="ListCategory.php?category=<?php echo urlencode('Teaching & Education'); ?>">
                    <i class="fa fa-3x fa-book-reader text-primary mb-4"></i>
                    <h6 class="mb-3">Teaching & Education</h6>
                    <p class="mb-0"><?php echo getCategoryCount($categories, 'Teaching & Education'); ?> Profiles</p>
                </a>
            </div>

            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                <a class="cat-item rounded p-4" href="ListCategory.php?category=<?php echo urlencode('Design & Creative'); ?>">
                    <i class="fa fa-3x fa-drafting-compass text-primary mb-4"></i>
                    <h6 class="mb-3">Design & Creative</h6>
                    <p class="mb-0"><?php echo getCategoryCount($categories, 'Design & Creative'); ?> Profiles</p>
                </a>
            </div>
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
                        <h1 class="mb-4">We Help To Get The Best Talent</h1>
                        <p class="mb-4">"Great companies are built by great people."
</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Build Your Team with Top Talent</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Hire Faster, Smarter, and Better</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Manage All Your Job Posts in One Place</p>
                        <a class="btn btn-primary py-3 px-5 mt-3" href="About.html">Read More</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

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
                                <small>Buissnessman</small>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded p-4">
                        <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                        <p>Many indivituals can find best opportunities</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" src="../Assets/Templates/Main/img/elon_musk.jpeg" style="width: 50px; height: 50px;">
                            <div class="ps-3">
                                <h5 class="mb-1">Elon Musk</h5>
                                <small>Entrepreneur</small>
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
                                <small>CEO openAI</small>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded p-4">
                        <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                        <p>Becoming a client at JobC makes my career awsome</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" src="../Assets/Templates/Main/img/sundar_pichai.jpeg" style="width: 50px; height: 50px;">
                            <div class="ps-3">
                                <h5 class="mb-1">Sundar Pichai</h5>
                                <small>CEO Google</small>
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
                        <a class="btn btn-link text-white-50" href="About.html">Our Services</a>
                        <a class="btn btn-link text-white-50" href="About.html">Privacy Policy</a>
                        <a class="btn btn-link text-white-50" href="About.html">Terms & Condition</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Quick Links</h5>
                        
                        <a class="btn btn-link text-white-50" href="Contact.html">Contact Us</a>
                        <a class="btn btn-link text-white-50" href="CompanyProfile.php">Profile</a>
                        <a class="btn btn-link text-white-50" href="JobPost.php">Post Job</a>
                     
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Contact</h5>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Kanjar , Moolamattom</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+91 7012482173</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>jobcofficial.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
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
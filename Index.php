<?php
include("./Assets/Connection/connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

<!-- The buttons or links direct to Login.php 
     All the job listing and candidates list can view after login by the company/candidate -->

    <meta charset="utf-8">
    <title>JobC - Job Portal</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="Assets/Templates/Main/img/JobC_logo.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="./Assets/Templates/Main/lib/animate/animate.min.css" rel="stylesheet">
    <link href="./Assets/Templates/Main/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="./Assets/Templates/Main/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="./Assets/Templates/Main/css/style.css" rel="stylesheet">
</head>

<body>
    
    <div class="container-xxl bg-white p-0">
          <!-- spinnar -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <!-- Spinner End -->


        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
            <a href="" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
                <h1 class="m-0 text-primary">JobC</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="index.html" class="nav-item nav-link active">Home</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Register</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="./Guest/NewUser.php" class="dropdown-item">User</a>
                            <a href="./Guest/NewCompany.php" class="dropdown-item">Company</a>
                        </div>
                    </div>
                   
                </div>
                <a href="./Guest/Login.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Login<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </nav>
        <!-- Navbar End -->


        <!-- big picture Start -->
        <div class="container-fluid p-0">
            <div class="owl-carousel header-carousel position-relative">
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="./Assets/Templates/Main/img/workplace4.jpg" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(43, 57, 64, .5);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h1 class="display-3 text-white animated slideInDown mb-4">Thousands of jobs. One perfect fit. Let’s find it.</h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">Discover roles that match your skills and passion.Apply today and take the next step in your career.</p>
                                    <a href="./Guest/Login.php" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Search A Job</a>
                                    <a href="./Guest/Login.php" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Find A Talent</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="./Assets/Templates/Main/img/workplace8.jpg" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(43, 57, 64, .5);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h1 class="display-3 text-white animated slideInDown mb-4">Hire the Best. From 10,000+ Brilliant Minds.</h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">>Let us help you discover talent that transforms your vision into reality.</p>
                                    <a href="./Guest/Login.php" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Search A Job</a>
                                    <a href="./Guest/Login.php" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Find A Talent</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel End -->

<!-- Jobs Start -->
<div class="container-xxl py-5">
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Lets Find,</h1>

        <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
            <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active"
                       data-bs-toggle="pill" href="#tab-1">
                        <h6 class="mt-n1 mb-0">Jobs</h6>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 pb-3"
                       data-bs-toggle="pill" href="#tab-2">
                        <h6 class="mt-n1 mb-0">Talents</h6>
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <!-- TAB 1/2 JOB LISTINGS -->
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <?php
                    include("./Assets/Connection/connection.php");

                    // Fetch random job listings 
                    $selQry = "SELECT j.*, c.company_name, c.company_logo 
                               FROM tbl_job_poster j 
                               INNER JOIN tbl_company c ON j.company_id = c.company_id 
                               WHERE j.job_post_status = 1 
                               ORDER BY RAND() 
                               LIMIT 5";
                    $result = $con->query($selQry);

                    if ($result && $result->num_rows > 0) {
                        while ($data = $result->fetch_assoc()) {
                            ?>
                            <div class="job-item p-4 mb-4">
                                <div class="row g-4">
                                    <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                        <!-- company logo -->
                                        <img class="flex-shrink-0 img-fluid border rounded"
                                             src="./Assets/Files/CompanyDocs/<?php echo htmlspecialchars($data['company_logo']); ?>"
                                             alt="<?php echo htmlspecialchars($data['company_name']); ?>"
                                             style="width: 80px; height: 80px; object-fit: cover;">
                                    <!-- job title -->
                                        <div class="text-start ps-4">
                                            <h5 class="mb-3"><?php echo htmlspecialchars($data['job_post_title']); ?></h5>
                                            <span class="text-truncate me-3">
                                                <i class="fa fa-building text-primary me-2"></i>
                                                <?php echo htmlspecialchars($data['company_name']); ?>
                                            </span>
                                    <!-- location -->
                                            <span class="text-truncate me-3">
                                                <i class="fa fa-map-marker-alt text-primary me-2"></i>
                                                <?php echo htmlspecialchars($data['job_post_location']); ?>
                                            </span>
                                            <!-- Type -->
                                            <span class="text-truncate me-3">
                                                <i class="far fa-clock text-primary me-2"></i>
                                                Full Time
                                            </span>
                                            <!-- Vacancy -->
                                            <span class="text-truncate me-0">
                                                <i class="far fa-money-bill-alt text-primary me-2"></i>
                                                Vacancy: <?php echo htmlspecialchars($data['job_post_vacancy']); ?>
                                            </span>
                                        </div>
                                    </div>
<!-- button & deadline -->
                                    <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                        <div class="d-flex mb-3">
                                           <!-- <a class="btn btn-light btn-square me-3" href=""> -->
                                               
                                            </a>
                                            <a class="btn btn-primary"
                                               href="Guest/Login.php">
                                                Apply Now
                                            </a>
                                        </div>
                                        <small class="text-truncate">
                                            <i class="far fa-calendar-alt text-primary me-2"></i>
                                            Date Line: <?php echo date("d M, Y", strtotime($data['job_post_deadline'])); ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<div class="alert alert-info">No job listings available right now.</div>';
                    }
                    ?>
                    <a class="btn btn-primary py-3 px-5" href="Guest/Login.php">Browse More Jobs</a>
                </div>

                <!-- TAB 2/2: TALENTS (candidates) for company -->
                <div id="tab-2" class="tab-pane fade show p-0">
                    <?php
                    // Fetch random active users: user_status=1
                    $selUser = "SELECT * FROM tbl_user WHERE user_status = 1 ORDER BY RAND() LIMIT 5";
                    $resultUser = $con->query($selUser);

                    if ($resultUser === false) {
                        error_log("MySQL error: " . $con->error);
                        echo '<div class="alert alert-danger">Unable to load users at the moment.</div>';
                    } elseif ($resultUser->num_rows > 0) {
                        while ($user = $resultUser->fetch_assoc()) {
                            $photo = htmlspecialchars($user['user_photo'] ?? 'default-user.png');
                            $name = htmlspecialchars($user['user_name'] ?? 'No name');
                            $address = htmlspecialchars($user['user_address'] ?? '');
                            $email = htmlspecialchars($user['user_email'] ?? '');
                            $qualification = htmlspecialchars($user['user_qualification'] ?? '');
                            $resume = htmlspecialchars($user['user_resume'] ?? '');
                            $contact = htmlspecialchars($user['user_contact'] ?? '');
                            ?>
                            <div class="job-item p-4 mb-4">
                                <div class="row g-4">
                                    <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                        <!-- profile pic -->
                                        <img class="flex-shrink-0 img-fluid border rounded"
                                             src="./Assets/Files/UserPhoto/<?php echo $photo; ?>"
                                             alt="<?php echo $name; ?>"
                                             style="width: 80px; height: 80px;">
                                        <div class="text-start ps-4">
                                            <!-- name -->
                                            <h5 class="mb-3"><?php echo $name; ?></h5>
                                            <span class="text-truncate me-3">
                                                <i class="fa fa-map-marker-alt text-primary me-2"></i>
                                                <?php echo $address; ?>
                                            </span>
                                            <!-- email -->
                                            <span class="text-truncate me-3">
                                                <i class="far fa-envelope text-primary me-2"></i>
                                                <?php echo $email; ?>
                                            </span>
                                            <!-- qualification -->
                                            <span class="text-truncate me-0">
                                                <i class="fa fa-user-graduate text-primary me-2"></i>
                                                <?php echo $qualification; ?>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                        <div class="d-flex mb-3">
                                           <!-- profile -->
                                            </a>
                                            <?php if (!empty($resume)) : ?>
                                                <a class="btn btn-primary"
                                                   href="Guest/Login.php" target="_blank">
                                                    View Profile
                                                </a>
                                            <?php else : ?>
                                                <a class="btn btn-secondary disabled">No Resume</a>
                                            <?php endif; ?>
                                        </div>
                                        <!-- contact -->
                                        <small class="text-truncate">
                                            <i class="fa fa-phone text-primary me-2"></i>
                                            <?php echo $contact; ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<div class="alert alert-info">No active users found.</div>';
                    }
                    ?>
                    <a class="btn btn-primary py-3 px-5" href="Guest/Login.php">Browse More Talents</a>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Jobs End -->



   <!-- Category Start -->
<div class="container-xxl py-5">
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Explore By Category</h1>
        <div class="row g-4">

        <?php
        // FETCH LIVE VACANCIES  
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

        // Cards
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

        //Render
        $delay = 0.1;
        foreach ($cards as $c):
            $vacCount = getVacancy($c['catId'], $vacancies);
        ?>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="<?php echo number_format($delay, 1); ?>s">
                
<a class="cat-item rounded p-4" href="Guest/Login.php">
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
                                <img class="img-fluid w-100" src="./Assets/Templates/Main/img/about1.jpg">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid" src="./Assets/Templates/Main/img/about2.jpg" style="width: 85%; margin-top: 15%;">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid" src="./Assets/Templates/Main/img/about3.jpg" style="width: 85%;">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid w-100" src="./Assets/Templates/Main/img/about4.jpg">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="mb-4">We Help You To Land Great Jobs And Get Best Talent</h1>
                        <p class="mb-4">A smart platform that connects job seekers with top employers—streamlining applications, showcasing skills, and unlocking career opportunities across industries</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Clean, User-Friendly Interface</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Hire Faster, Smarter, and Better</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Secure & Private</p>
                        <a class="btn btn-primary py-3 px-5 mt-3" href="">Read More</a>
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
                            <img class="img-fluid flex-shrink-0 rounded" src="./Assets/Templates/Main/img/bill_gates.jpeg" style="width: 50px; height: 50px;">
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
                            <img class="img-fluid flex-shrink-0 rounded" src="./Assets/Templates/Main/img/elon_musk.jpeg" style="width: 50px; height: 50px;">
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
                            <img class="img-fluid flex-shrink-0 rounded" src="./Assets/Templates/Main/img/sam_altman.jpeg" style="width: 50px; height: 50px;">
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
                            <img class="img-fluid flex-shrink-0 rounded" src="./Assets/Templates/Main/img/sundar_pichai.jpeg" style="width: 50px; height: 50px;">
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
                        <a class="btn btn-link text-white-50" href="">About Us</a>
                        <a class="btn btn-link text-white-50" href="">Our Services</a>
                        <a class="btn btn-link text-white-50" href="">Privacy Policy</a>
                        <a class="btn btn-link text-white-50" href="">Terms & Condition</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Quick Links</h5>
                        
                        <a class="btn btn-link text-white-50" href="">Contact Us</a>
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
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
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


        <!-- Back to Top button-->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./Assets/Templates/Main/lib/wow/wow.min.js"></script>
    <script src="./Assets/Templates/Main/lib/easing/easing.min.js"></script>
    <script src="./Assets/Templates/Main/lib/waypoints/waypoints.min.js"></script>
    <script src="./Assets/Templates/Main/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="./Assets/Templates/Main/js/main.js"></script>
</body>





</html>
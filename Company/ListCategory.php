<?php
include("../Assets/Connection/connection.php");
include("Head.php");
//List candidate by specific categopry
// Get category from URL 
$category = isset($_GET['category']) ? mysqli_real_escape_string($con, $_GET['category']) : '';

if (empty($category)) {
    die("No category specified.");
}

//Fetch job category details
$categoryQuery = "SELECT job_category_id, job_category_name 
                  FROM tbl_job_category 
                  WHERE job_category_name = '$category'";
$categoryResult = mysqli_query($con, $categoryQuery);

if (!$categoryResult || mysqli_num_rows($categoryResult) == 0) {
    die("Invalid category.");
}

$categoryData = mysqli_fetch_assoc($categoryResult);
$categoryId = $categoryData['job_category_id'];
$categoryName = $categoryData['job_category_name'];

//Fetch users in this category
$sql = "SELECT 
            u.user_id,
            u.user_name,
            u.user_email,
            u.user_contact,
            u.user_address,
            u.user_photo,
            u.user_qualification,
            jc.job_category_name
        FROM 
            tbl_user u
        INNER JOIN 
            tbl_job_category jc ON u.user_job_category = jc.job_category_id
        WHERE 
            u.user_job_category = '$categoryId'";

$result = mysqli_query($con, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

$userCount = mysqli_num_rows($result);
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
    <link href="img/favicon.ico" rel="icon">

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
    <div class="container-xxl py-5">
        <div class="container">
            <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <?php echo htmlspecialchars($categoryName); ?> - Candidates
            </h1>
             <!--Count  -->
            <p class="text-center mb-4">Total Candidates: <?php echo $userCount; ?></p>
            <!-- Candidate details -->
            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <?php
                        if ($userCount > 0) {
                            while($user = mysqli_fetch_assoc($result)) {
                                $profile_image = !empty($user['user_photo']) //Profile pic
                                    ? '../Assets/Files/UserPhoto/' . $user['user_photo'] 
                                    : '../Assets/Files/UserPhoto/profile_null.jpeg';
                        ?>
                        <!--Name & details  -->
                        <div class="job-item p-4 mb-4">
                            <div class="row g-4">
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
                        ?>
                            <div class="col-12">
                                <p class="text-center">No candidates found in this category.</p>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="HomePage.php" class="btn btn-secondary">Back to All Categories</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close database connection
mysqli_close($con);
include("Foot.php");
?>
<?php
include("../Assets/Connection/connection.php");
include("Head.php");
//This page shows Search results 
//All serch bar enterd results shoen on this page
// Get search parameters
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$search_performed = !empty($keyword);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>JobC - Search Candidates</title>
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
    <!-- Search Start -->
    <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
        <div class="container">
            <form method="GET" action="SearchResult.php">
                <div class="row g-2 justify-content-center">
                    <div class="col-md-4">
                        <input type="text" name="keyword" class="form-control border-0" placeholder="Keyword" value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>" />
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-dark border-0 w-100">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Candidates List Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <?php if ($search_performed): ?>
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                    Search Results for "<?php echo htmlspecialchars($keyword); ?>"
                </h1>
                
                <?php
                //Keyword 
                $safe_keyword = $con->real_escape_string($keyword);
                
                //Search query 
                $search_query = "SELECT DISTINCT u.*, 
                                jc.job_category_name,
                                GROUP_CONCAT(DISTINCT jc2.job_category_name SEPARATOR ', ') as applied_categories
                                FROM tbl_user u
                                LEFT JOIN tbl_job_category jc ON u.user_job_category = jc.job_category_id
                                LEFT JOIN tbl_apply a ON u.user_id = a.user_id
                                LEFT JOIN tbl_job_poster jp ON a.job_post_id = jp.job_post_id
                                LEFT JOIN tbl_job_category jc2 ON jp.job_category_id = jc2.job_category_id
                                WHERE (u.user_name LIKE '%$safe_keyword%' 
                                OR jc.job_category_name LIKE '%$safe_keyword%'
                                OR jc2.job_category_name LIKE '%$safe_keyword%')
                                GROUP BY u.user_id";
                
                $result = $con->query($search_query);
                $userCount = $result ? $result->num_rows : 0;
                ?>
                
                <p class="text-center mb-4">Total Candidates: <?php echo $userCount; ?></p>
                
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <?php
                            if ($userCount > 0) {
                                while($user = $result->fetch_assoc()) {
                                    $profile_image = !empty($user['user_photo']) //User pic
                                        ? '../Assets/Files/UserPhoto/' . $user['user_photo'] 
                                        : '../Assets/Files/UserPhoto/profile_null.jpeg';
                            ?>
                            <div class="job-item p-4 mb-4">
                                <div class="row g-4">
                                    <!--Candidate Details -->
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
                                            <?php if (!empty($user['applied_categories'])): ?>
                                            <br>
                                            <span class="text-truncate me-0">
                                                <i class="fas fa-briefcase text-primary me-2"></i>
                                                Applied: <?php echo htmlspecialchars($user['applied_categories']); ?>
                                            </span>
                                            <?php endif; ?>
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
                                    <div class="alert alert-info">
                                        <p class="text-center">No candidates found matching your search criteria or name</p>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                
            <?php else: ?>
                <div class="alert alert-secondary text-center">
                    <p>Enter a keyword to search for candidates by name or job category</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- Candidates List End -->

    <!-- Add your JS references here -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close database connection
mysqli_close($con);
include("Foot.php");
?>
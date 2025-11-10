<?php
include("Head.php");
include("../Assets/Connection/Connection.php");
//To view company profile by user
// Check if company ID is provided
if (!isset($_GET['company_id']) || empty($_GET['company_id'])) {
    header("Location: HomePage.php");
    exit();
}

$company_id = intval($_GET['company_id']);

// Fetch company details
$company_sql = "SELECT 
                company_id,
                company_name,
                company_email,
                company_contact,
                company_address,
                company_logo,
                about_company,
                company_type,
                company_introduction,
                company_industry
            FROM 
                tbl_company
            WHERE 
                company_id = $company_id AND company_status = 1";

$company_result = mysqli_query($con, $company_sql);

if (!$company_result || mysqli_num_rows($company_result) == 0) {
    echo "<div class='container mt-5'><div class='alert alert-danger'>Company not found!</div></div>";
    include("Foot.php");
    exit();
}
//logo
$company = mysqli_fetch_assoc($company_result);
$company_logo = !empty($company['company_logo']) 
    ? '../Assets/Files/CompanyDocs/' . $company['company_logo'] 
    : '../Assets/Files/CompanyDocs/company_null.png';

// Get industry and type 
$industry_name = "Industry " . $company['company_industry'];
$type_name = "Type " . $company['company_type'];

// Try to fetch names 
$industry_query = mysqli_query($con, "SELECT industry_name FROM tbl_company_industry WHERE industry_id = " . $company['company_industry']);
if ($industry_query && mysqli_num_rows($industry_query) > 0) {
    $industry_row = mysqli_fetch_assoc($industry_query);
    $industry_name = $industry_row['industry_name'];
}

$type_query = mysqli_query($con, "SELECT company_type_name FROM tbl_company_type WHERE company_type_id = " . $company['company_type']);
if ($type_query && mysqli_num_rows($type_query) > 0) {
    $type_row = mysqli_fetch_assoc($type_query);
    $type_name = $type_row['company_type_name'];
}

// Fetch job posts by this company
$jobs_sql = "SELECT 
                jp.job_post_id,
                jp.job_post_title,
                jp.job_post_content,
                jp.job_post_vacancy,
                jp.job_post_experience,
                jp.job_post_location,
                jp.job_post_salary,
                jp.job_post_deadline,
                jc.job_category_name,
                jt.job_type_name
            FROM 
                tbl_job_poster jp
            LEFT JOIN 
                tbl_job_category jc ON jp.job_category_id = jc.job_category_id
            LEFT JOIN 
                tbl_job_type jt ON jp.job_type_id = jt.job_type_id
            WHERE 
                jp.company_id = $company_id AND jp.job_post_status = 1
            ORDER BY 
                jp.job_post_date DESC";

$jobs_result = mysqli_query($con, $jobs_sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Company Profile - <?php echo htmlspecialchars($company['company_name']); ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="../Assets/Templates/Main/css/CandidateProfile.css" rel="stylesheet">
</head>

<body>



<!-- Profile Header -->
<div class="profile-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3 text-center">
                <div class="profile-image-container">
                    <img src="<?php echo htmlspecialchars($company_logo); ?>" 
                         alt="<?php echo htmlspecialchars($company['company_name']); ?>" 
                         class="profile-image">
                </div>
            </div>
            <div class="col-md-9">
                <h2 class="mb-3"><?php echo htmlspecialchars($company['company_name']); ?></h2>
                <h5 class="mb-3">
                    <i class="fas fa-industry me-2"></i>
                    <?php echo htmlspecialchars($industry_name); ?>
                </h5>
                <div class="mb-3">
                    <span class="status-badge status-available">
                        <i class="fas fa-check-circle me-2"></i>HIRING NOW
                    </span>
                </div>
                <p class="mb-0">
                    <i class="fas fa-map-marker-alt me-2"></i>
                    <?php echo htmlspecialchars($company['company_address']); ?>
                </p>
            </div>
        </div>
    </div>
</div>



<!-- Profile Content -->
<div class="container pb-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Company details card -->
            <div class="profile-card">
                <h4 class="section-title">
                    <i class="fas fa-building me-2"></i>About Company
                </h4>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="me-3" style="font-size: 30px; color: #667eea;">
                                <i class="fas fa-industry"></i>
                            </div>
                            <div>
                                <div style="font-size: 12px; color: #666;">Industry</div>
                                <div style="font-weight: 600; color: #333;">
                                    <?php echo htmlspecialchars($industry_name); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
<div class="col-md-6 mb-3">
    <div class="d-flex align-items-center">
        <div class="me-3" style="font-size: 30px; color: #667eea;">
            <i class="fas fa-briefcase"></i>
        </div>
        <div>
            <div style="font-size: 12px; color: #666;">Company Type</div>
            <div style="font-weight: 600; color: #333;">
                <?php echo htmlspecialchars($type_name); ?>
            </div>
        </div>
    </div>
</div>
<!-- company vedio -->
<?php if (!empty($company['company_introduction'])): ?>
<div class="col-md-6 mb-3">
    <div class="d-flex align-items-center">
        <div class="me-3" style="font-size: 30px; color: #667eea;">
            <i class="fas fa-video"></i>
        </div>
        <div>
            <div style="font-size: 12px; color: #666;">Company Introduction</div>
            <div style="font-weight: 600; color: #333;">
                <a href="#" data-bs-toggle="modal" data-bs-target="#videoModal" style="color: #667eea; text-decoration: none;">
                    <i class="fas fa-play-circle me-1"></i>Watch Video
                </a>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>




                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="me-3" style="font-size: 30px; color: #667eea;">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <div style="font-size: 12px; color: #666;">Location</div>
                                <div style="font-weight: 600; color: #333;">
                                    <?php echo htmlspecialchars($company['company_address']); ?>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (!empty($company['about_company'])): ?>
            <!-- About Company  -->
            <div class="profile-card">
                <h4 class="section-title">
                    <i class="fas fa-info-circle me-2"></i>About Company
                </h4>
                <p style="color: #555; line-height: 1.8;">
                    <?php echo htmlspecialchars($company['about_company']); ?>
                </p>
            </div>
            <?php endif; ?>
        <br><br><br>
            
           

            <!-- Job Posts Card, Current job posted by the company -->
            <div class="profile-card">
                <h4 class="section-title">
                    <i class="fas fa-briefcase me-2"></i>Current Job Openings
                </h4>
                <?php if (mysqli_num_rows($jobs_result) > 0): ?>
                    <div class="row">
                        <?php while ($job = mysqli_fetch_assoc($jobs_result)): ?>
                        <div class="col-md-12 mb-3">
                            <div style="border: 1px solid #e0e0e0; border-radius: 10px; padding: 20px; background: #f9f9f9;">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 style="color: #333; margin: 0;">
                                        <?php echo htmlspecialchars($job['job_post_title']); ?>
                                    </h5>
                                    <span style="background: #667eea; color: white; padding: 5px 15px; border-radius: 20px; font-size: 12px;">
                                        <?php echo htmlspecialchars($job['job_type_name']); ?>
                                    </span>
                                </div>
                                <p style="color: #666; margin: 10px 0;">
                                    <i class="fas fa-list me-2"></i><?php echo htmlspecialchars($job['job_category_name']); ?>
                                </p>
                                <p style="color: #555; margin: 10px 0;">
                                    <?php echo htmlspecialchars(substr($job['job_post_content'], 0, 100)) . '...'; ?>
                                </p>
                                <div class="row mt-3">
                                    <div class="col-md-3 mb-2">
                                        <small style="color: #888;"><i class="fas fa-map-marker-alt me-1"></i>Location</small>
                                        <div style="font-weight: 600; color: #333;"><?php echo htmlspecialchars($job['job_post_location']); ?></div>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <small style="color: #888;"><i class="fas fa-users me-1"></i>Vacancies</small>
                                        <div style="font-weight: 600; color: #333;"><?php echo htmlspecialchars($job['job_post_vacancy']); ?></div>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <small style="color: #888;"><i class="fas fa-briefcase me-1"></i>Experience</small>
                                        <div style="font-weight: 600; color: #333;"><?php echo htmlspecialchars($job['job_post_experience']); ?> years</div>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <small style="color: #888;"><i class="fas fa-money-bill-wave me-1"></i>Salary</small>
                                        <div style="font-weight: 600; color: #333;"><?php echo htmlspecialchars($job['job_post_salary']); ?></div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <small style="color: #888;"><i class="fas fa-calendar-times me-1"></i>Deadline</small>
                                    <div style="font-weight: 600; color: #e74c3c;">
                                        <?php echo date('d M Y', strtotime($job['job_post_deadline'])); ?>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    
                                    <a href="JobDetail.php?job_id=<?php echo $job['job_post_id']; ?>" 
                                       class="btn btn-contact" 
                                       style="display: inline-block; padding: 8px 20px; text-decoration: none;">
                                        <i class="fas fa-eye me-2"></i>View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>No job openings available at the moment.
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-lg-4">
        
            <div class="stats-card">
                <div class="stats-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div class="stats-title">Active Job Posts</div>
                <div class="stats-value"><?php echo mysqli_num_rows($jobs_result); ?></div>
            </div>
            </div>       
 



<!-- Video Modal -->
<?php if (!empty($company['company_introduction'])): ?>
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="videoModalLabel">
                    <i class="fas fa-video me-2"></i>Company Introduction - <?php echo htmlspecialchars($company['company_name']); ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="video-container" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; background: #000;">
                    <video 
                        id="introVideo"
                        controls 
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
                        preload="metadata">
                    
                        <source src="../Assets/Files/CompanyIntroduction/<?php echo htmlspecialchars($company['company_introduction']); ?>" type="video/mp4">
                        <source src="../Assets/Files/CompanyIntroduction/<?php echo htmlspecialchars($company['company_introduction']); ?>" type="video/webm">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Stop video when closed
document.getElementById('videoModal').addEventListener('hidden.bs.modal', function () {
    var video = document.getElementById('introVideo');
    video.pause();
    video.currentTime = 0;
});
</script>
<?php endif; ?>     
       
        
<?php
include("Foot.php");
?>

</body>
</html>
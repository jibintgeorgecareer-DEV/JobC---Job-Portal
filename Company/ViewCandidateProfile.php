<?php
include("Head.php");
include("../Assets/Connection/Connection.php");
//To view candidate profile


// Check  user ID is provided
/* if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: ViewCandidateProfile.php");
    exit();
}
*/
$user_id = intval($_GET['id']);

//Fetch candidate details 
//Fetch candidate details 
$profile_sql = "SELECT 
                u.user_id,
                u.user_name,
                u.user_email,
                u.user_contact,
                u.user_address,
                u.user_qualification,
                u.user_photo,
                u.user_resume,
                u.user_gender,
                u.user_introduction,
                u.user_experience,
                jc.job_category_name
            FROM 
                tbl_user u
            LEFT JOIN 
                tbl_job_category jc ON u.user_job_category = jc.job_category_id
            WHERE 
                u.user_id = $user_id";

$profile_result = mysqli_query($con, $profile_sql);

if (!$profile_result || mysqli_num_rows($profile_result) == 0) {
    echo "<div class='container mt-5'><div class='alert alert-danger'>Candidate not found!</div></div>";
    include("Foot.php");
    exit();
}
//Profile pic
$candidate = mysqli_fetch_assoc($profile_result);
$profile_image = !empty($candidate['user_photo']) 
    ? '../Assets/Files/UserPhoto/' . $candidate['user_photo'] 
    : '../Assets/Files/UserPhoto/profile_null.jpeg';


    //For certifications 
$certQuery = "SELECT * FROM tbl_user_certifications WHERE user_id = $user_id ORDER BY user_certification_id DESC";
$certResult = $con->query($certQuery);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>JobC - View Candidates</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
<link href="../Assets/Templates/Main/css/CandidateProfile.css" rel="stylesheet">

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



<!-- Profile Header -->
<div class="profile-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3 text-center">
                <div class="profile-image-container">
                    <img src="<?php echo htmlspecialchars($profile_image); ?>" 
                         alt="<?php echo htmlspecialchars($candidate['user_name']); ?>" 
                         class="profile-image">
                </div>
            </div>
            <!--Essential Details -->
            <div class="col-md-9">
                <h2 class="mb-3"><?php echo htmlspecialchars($candidate['user_name']); ?></h2>
                <h5 class="mb-3">
                    <i class="fas fa-briefcase me-2"></i>
                    <?php echo htmlspecialchars($candidate['job_category_name']); ?>
                </h5>
                <div class="mb-3">
                    <span class="status-badge status-available">
                        <i class="fas fa-check-circle me-2"></i>OPEN TO WORK
                    </span>
                </div>
                <p class="mb-0">
                    <i class="fas fa-map-marker-alt me-2"></i>
                    <?php echo htmlspecialchars($candidate['user_address']); ?>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Profile Content -->
<div class="container pb-5">
    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-8">
            <!-- Professional Summary Card -->
            <div class="profile-card">
                <h4 class="section-title">
                    <i class="fas fa-user me-2"></i>Professional Summary
                </h4>
                <div class="row">

                   <!-- Video Introduction Section -->
<?php if (!empty($candidate['user_introduction'])): ?>
<div class="col-md-6 mb-3">
    <div class="d-flex align-items-center">
        <div class="me-3" style="font-size: 30px; color: #667eea;">
            <i class="fas fa-video"></i>
        </div>
        <div>
            <div style="font-size: 12px; color: #666;">Video Introduction</div>
            <div style="font-weight: 600; color: #333;">
                <a href="#" data-bs-toggle="modal" data-bs-target="#videoModal" 
                   style="color: #667eea; text-decoration: none;">
                    <i class="fas fa-play-circle me-1"></i>Watch Video
                </a>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

                    <!-- qual -->
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="me-3" style="font-size: 30px; color: #667eea;">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div>
                                <div style="font-size: 12px; color: #666;">Qualification</div>
                                <div style="font-weight: 600; color: #333;">
                                    <?php echo htmlspecialchars($candidate['user_qualification']); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="me-3" style="font-size: 30px; color: #667eea;">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <!-- loc -->
                                <div style="font-size: 12px; color: #666;">Location</div>
                                <div style="font-weight: 600; color: #333;">
                                    <?php echo htmlspecialchars($candidate['user_address']); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if (!empty($candidate['user_resume'])): ?>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="me-3" style="font-size: 30px; color: #667eea;">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div>
                                <div style="font-size: 12px; color: #666;">Resume</div>
                                <div style="font-weight: 600; color: #333;">




<?php 
 //Existing array
        $user_resu = !empty($candidate['user_resume']) 
            ? '../Assets/Files/UserResume/' . $candidate['user_resume'] 
            : '../Assets/Files/UserResume/profile.jpeg';
?>

<a href="<?php echo $user_resu; ?>">View Resume</a>
                        
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Contact Candidate card -->
            <div class="profile-card">
                <h4 class="section-title">
                    <i class="fas fa-address-card me-2"></i>Contact Information
                </h4>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="info-row" style="border: none; padding: 10px; background: #f8f9fa; border-radius: 5px;">
                            <div class="info-label" style="min-width: auto;">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="info-value" style="word-break: break-word;">
                                <?php echo htmlspecialchars($candidate['user_email']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="info-row" style="border: none; padding: 10px; background: #f8f9fa; border-radius: 5px;">
                            <div class="info-label" style="min-width: auto;">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="info-value">
                                <?php echo htmlspecialchars($candidate['user_contact']); ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                 <h4 class="section-title">
                    <i class="fas fa-business-time  me-2"></i>Experiences
                </h4>
                <div class="col-md-6 mb-3">
                        <div class="info-row" style="border: none; padding: 10px; background: #f8f9fa; border-radius: 5px;">
                            <div class="info-label" style="min-width: auto;">
                                <i class=""></i>
                            </div>
                            <div class="info-value" style="word-break: break-word;">
                                <?php echo htmlspecialchars($candidate['user_experience']); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Certifications Section -->
<h4 class="section-title mt-4">
    <i class="fas fa-award me-2"></i>Certifications
</h4>
<?php if($certResult->num_rows > 0): ?>
    <div class="row">
        <?php while($cert = $certResult->fetch_assoc()): 
            //image path for each certification
            $certimg = !empty($cert['user_certification_photo']) 
                ? '../Assets/Files/UserCertification/' . $cert['user_certification_photo'] 
                : '../Assets/Files/UserCertification/certification_null.jpeg';
        ?>
            <div class="col-md-12 mb-3">
                <div class="info-row" style="border: none; padding: 15px; background: #f8f9fa; border-radius: 8px;">
                    <div class="d-flex align-items-start">
                        <!-- Certification Image -->
                        <div class="me-3">
                            <img src="<?php echo htmlspecialchars($certimg); ?>" 
                                 alt="<?php echo htmlspecialchars($cert['user_certification_name']); ?>"
                                 style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; border: 2px solid #667eea;"
                                 onclick="window.open(this.src, '_blank') ">
                        </div>
                        <!-- Details -->
                        <div class="flex-grow-1">
                            <h6 class="mb-2" style="color: #333; font-weight: 600;">
                                <i class="fas fa-certificate me-2" style="color: #667eea;"></i>
                                <?php echo htmlspecialchars($cert['user_certification_name']); ?>
                            </h6>
                            <p class="mb-0" style="color: #666; font-size: 14px;">
                                <?php echo nl2br(htmlspecialchars($cert['user_certification_content'])); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <div class="alert alert-info">
        <i class="fas fa-info-circle me-2"></i>No certifications added yet.
    </div>
<?php endif; ?>
            </div>
        </div>
        
        
        <div class="col-lg-4">
            <!--Candidate status-->
            <div class="stats-card">
                <div class="stats-icon">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="stats-title">Current Status</div>
                <div class="stats-value">Available</div>
            </div>
            
            <!--Buttons -->
            <div class="profile-card">
                <h4 class="section-title">
                    <i class="fas fa-paper-plane me-2"></i>Contact Candidate
                </h4>
                <div class="action-buttons">
                    <a href="mailto:<?php echo htmlspecialchars($candidate['user_email']); ?>" 
                       class="btn btn-contact d-block mb-3 text-center">
                        <i class="fas fa-envelope me-2"></i>Send Email
                    </a>
                    <a href="tel:<?php echo htmlspecialchars($candidate['user_contact']); ?>" 
                       class="btn btn-contact d-block mb-3 text-center">
                        <i class="fas fa-phone me-2"></i>Call Now
                    </a>
                    <a href="HomePage.php" class="btn btn-back d-block text-center">
                        <i class="fas fa-arrow-left me-2"></i>Back to HomePage
                    </a>
                </div>
            </div>


<!-- Video Modal -->
<?php if (!empty($candidate['user_introduction'])): ?>
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="videoModalLabel">
                    <i class="fas fa-video me-2"></i>Video Introduction - <?php echo htmlspecialchars($candidate['user_name']); ?>
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
                    
                        <source src="../Assets/Files/UserIntroduction/<?php echo htmlspecialchars($candidate['user_introduction']); ?>" type="video/mp4">
                        <source src="../Assets/Files/UserIntroduction/<?php echo htmlspecialchars($candidate['user_introduction']); ?>" type="video/webm">
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
            
            <!-- Additional details -->
            <div class="profile-card">
                <h4 class="section-title">
                    <i class="fas fa-info-circle me-2"></i>Details
                </h4>
                
<!--Resume  -->                
<div class="info-row">
    <div class="info-label">
        <i class="fas fa-briefcase"></i>
        Job Category
    </div>
    <div class="info-value">
        <?php   echo htmlspecialchars($candidate['job_category_name']); ?>
      
    </div>
</div>
                
                <div class="info-row">
                    <div class="info-label">
                        <i class="fas fa-graduation-cap"></i>
                        Education
                    </div>
                    <div class="info-value">
                        <?php echo htmlspecialchars($candidate['user_qualification']); ?>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">
                        <i class="fas fa-venus-mars"></i>
                        Gender
                    </div>
                    <div class="info-value">
                        <?php echo htmlspecialchars($candidate['user_gender']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include("Foot.php");
?>
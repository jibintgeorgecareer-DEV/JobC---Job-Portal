<?php
include("../Assets/Connection/connection.php");
session_start();
include("Head.php");

//fetch data from tbl_user tbl_category 
$selQry = "
    SELECT  u.*,
            c.job_category_name,
            n.user_now,
            n.user_now_id
    FROM    tbl_user u
    LEFT JOIN tbl_job_category c ON c.job_category_id = u.user_job_category
    LEFT JOIN tbl_user_now n     ON n.user_now_id     = u.user_now_id
    WHERE   u.user_id = '".$_SESSION['uid']."'
";
$row  = $con->query($selQry);
$data = $row->fetch_assoc();

// Determine status from user_now_id
$statusBadgeClass = '';
$statusIcon = '';
switch($data['user_now_id']) {
    case 1: // Internship
        $statusBadgeClass = 'badge-internship';
        $statusIcon = 'fas fa-user-check';
        break;
    case 2: // Open to Work
        $statusBadgeClass = 'badge-open';
        $statusIcon = 'fa-briefcase';
        break;
    case 3: // Working
        $statusBadgeClass = 'badge-working';
        $statusIcon = 'fa-building';
        break;
    case 4: // Student <i class="fas fa-user-check"></i>
        $statusBadgeClass = 'badge-student';
        $statusIcon = 'fas fa-user-check';
        break;
    default:
        $statusBadgeClass = 'badge-default';
        $statusIcon = 'fa-user';
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="utf-8">
    <title>JobC- Profile</title>
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
    <link href="../Assets/Templates/Main/css/CompanyProfile.css" rel="stylesheet">
    
    
</head>

<body>
<!-- Profile Section -->
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="profile-card">
               <!-- User photo -->
                <div class="profile-header">
                    <div class="profile-avatar">
                    <?php
                    if(!empty($data['user_photo']) && file_exists("../Assets/Files/UserPhoto/".$data['user_photo'])) {
                        echo '<img src="../Assets/Files/UserPhoto/'.htmlspecialchars($data['user_photo']).'" 
                                   alt="user Logo" 
                                   style="width:100%; height:100%; object-fit:cover; border-radius:50%;">';
                    } else {
                        echo strtoupper(substr($data['user_name'],0,1));
                    }
                    ?>
                    </div>
                    <h2 class="mb-0" style="color:white;"><?php echo htmlspecialchars($data['user_name']); ?></h2>
                    
                    <!-- Status Badge   -->
                    <?php if(!empty($data['user_now'])): ?>
                    <div class="status-badge-container"><br>
                        <span class="status-badge <?php echo $statusBadgeClass; ?>">
                            <i class="fas fa-check-circle <?php echo $statusIcon; ?>"></i>
                            <?php echo htmlspecialchars($data['user_now']); ?>
                        </span>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Main details -->
                <div class="profile-body">
                    <div class="profile-item">
                        <div class="profile-label"><i class="fas fa-user"></i> Name</div>
                        <div class="profile-value"><?php echo htmlspecialchars($data['user_name']); ?></div>
                    </div>

<!-- Introduction Video -->
                    <div class="profile-item" style="display: block;">
                        <div class="profile-label">
                            <i class="fas fa-video"></i>Self Introduction
                        </div>
                        <div class="profile-value" style="margin-top: 15px;">
                            <?php
                            if(!empty($data['user_introduction']) && file_exists("../Assets/Files/UserIntroduction/".$data['user_introduction'])) {
                                ?>
                                <video width="300" height="200" controls style="border-radius: 8px; max-width: 640px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                    <source src="../Assets/Files/UserIntroduction/<?php echo htmlspecialchars($data['user_introduction']); ?>" type="video/mp4">
                                    <source src="../Assets/Files/UserIntroduction/<?php echo htmlspecialchars($data['user_introduction']); ?>" type="video/webm">
                                    Your browser does not support the video tag.
                                </video>
                                <p style="margin-top: 8px; font-size: 12px; color: #666;">
                                    <i class="fas fa-file-video"></i> <?php echo htmlspecialchars($data['user_introduction']); ?>
                                </p>
                                <?php
                            } else {
                                ?>
                                <div style="padding: 30px; text-align: center; background: #f8f9fa; border-radius: 8px; border: 2px dashed #dee2e6;">
                                    <i class="fas fa-video-slash" style="font-size: 48px; color: #ccc;"></i>
                                    <p style="margin-top: 12px; color: #999; margin-bottom: 0;">No introduction video uploaded</p>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>


                    <div class="profile-item">
                        <div class="profile-label"><i class="fas fa-envelope"></i> Email</div>
                        <div class="profile-value"><?php echo htmlspecialchars($data['user_email']); ?></div>
                    </div>
                    
                    <div class="profile-item">
                        <div class="profile-label"><i class="fas fa-phone"></i> Contact</div>
                        <div class="profile-value"><?php echo htmlspecialchars($data['user_contact']); ?></div>
                    </div>

                    <div class="profile-item">
                        <div class="profile-label"><i class="fas fa-lock"></i> Password</div>
                        <div class="profile-value">••••••••</div>
                    </div>

                    <div class="profile-item">
                        <div class="profile-label"><i class="fas fa-map-marker-alt"></i> Address</div>
                        <div class="profile-value"><?php echo htmlspecialchars($data['user_address']); ?></div>
                    </div>

                    <div class="profile-item">
                        <div class="profile-label"><i class="fas fa-briefcase"></i> Job Category</div>
                        <div class="profile-value"><?php echo htmlspecialchars($data['job_category_name'] ?? 'Not specified'); ?></div>
                    </div>

                    <div class="profile-item">
                        <div class="profile-label"><i class="fas fa-graduation-cap"></i> Qualification</div>
                        <div class="profile-value"><?php echo htmlspecialchars($data['user_qualification'] ?? 'Not specified'); ?></div>
                    </div>

                    <!-- Current Status -->
                    <div class="profile-item <?php echo ($data['user_now_id'] == 4) ? 'student-highlight' : ''; ?>">
                        <div class="profile-label">
                            <i class="fas <?php echo $statusIcon; ?>"></i> Current Status
                        </div>
                        <div class="profile-value">
                            <?php 
                            if(!empty($data['user_now'])) {
                                echo htmlspecialchars($data['user_now']);
                                // Showing special message for students
                                if($data['user_now_id'] == 4) {
                                    echo ' <span style="font-size:12px; color:#667eea;">(📚 Learning & Growing)</span>';
                                }
                            } else {
                                echo 'Add Status';
                            }
                            ?>
                        </div>
                    </div>

                    

<!-- Work experience -->
                    <div class="profile-item">
                        <div class="profile-label"><i class="fas fa-business-time text-primary me-2"></i> Experience</div>
                        <div class="profile-value"><?php echo htmlspecialchars($data['user_experience']); ?></div>
                    </div>

                    <div class="profile-item">
                        <div class="profile-label"><i class="fas fa-certificate"></i> Certifications</div>
                        <div class="profile-value"><a href="ViewCertification.php">View </a></div>
                    </div>




                </div>

                <!--Buttons -->
                <div class="profile-actions">
                    <a href="EditProfile.php" class="btn btn-primary py-3 px-5">
                        <i class="fas fa-edit me-2"></i> Edit Profile
                    </a>
                    <a href="ChangePassword.php" class="btn btn-outline-primary py-3 px-5">
                        <i class="fas fa-key me-2"></i> Change Password
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Video Introduction nofification (if user_introduction==empty) -->
<?php if (empty($data['user_introduction'])): ?>
<div class="modal fade" id="missingVideoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border: none; border-radius: 15px; overflow: hidden;">
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #0d6efd 0%, #0d6efd 100%); border: none;">
                <h5 class="modal-title">
                    <i class="fas fa-star me-2"></i>Boost Your Profile!
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-4">
                <div class="mb-3" style="font-size: 60px; color: #667eea;">
                    <i class="fas fa-video"></i>
                </div>
                <h5 class="mb-3">Add Your Video Introduction</h5>
                <p class="text-muted mb-4">
               A strong <strong style="color: #667eea;">self introduction</strong> on your <strong style="color: #667eea;">Profile</strong> helps recruiters quickly evaluate your confidence and potential.
                </p>
                <div class="d-grid gap-2">
                    <a href="EditProfile.php" class="btn btn-lg" style="background: linear-gradient(135deg, #0d6efd 0%, #0d6efd 100%); color: white; border: none; font-weight: 600;">
                        <i class="fas fa-upload me-2"></i>Upload Video Introduction
                    </a>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Maybe Later
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Show modal on page load
window.addEventListener('load', function() {
    var modal = new bootstrap.Modal(document.getElementById('missingVideoModal'));
    modal.show();
});
</script>
<?php endif; ?>

<?php
include("Foot.php");
?>
</body>
</html>
<?php
include("../Assets/Connection/connection.php");
session_start();
include("Head.php");

//current user details
$select = "SELECT  u.*,
                c.job_category_name,
                n.user_now
        FROM    tbl_user u
        LEFT JOIN tbl_job_category c ON c.job_category_id = u.user_job_category
        LEFT JOIN tbl_user_now     n ON n.user_now_id     = u.user_now_id
        WHERE   u.user_id = '" . $_SESSION['uid'] . "'";
$data = $con->query($select)->fetch_assoc();

// user certifications
$certQuery = "SELECT * FROM tbl_user_certifications WHERE user_id = '{$data['user_id']}' ORDER BY user_certification_id DESC";
$certResult = $con->query($certQuery);


// Delete certification
if (isset($_GET['del_id'])) {
    $delId = $_GET['del_id'];
    $del = "DELETE FROM tbl_user_certifications WHERE user_certification_id = '$delId' ";
    
    if ($con->query($del)) {
        echo "<script>alert('Certification deleted successfully!'); window.location='ViewCertification.php';</script>";
        exit;
    } else {
        echo "<script>alert('Failed to delete certification!');</script>";
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="utf-8">
<title>JobC - My Certifications</title>
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
        <div class="col-lg-8 col-md-10" style="width: 80%;" >
            <div class="profile-card" >
                                <div style="background-color: #0d6efd;">
                <div style="background-color: #0d6efd;">

                    
                    </div>
                    <br>
                    <h2 class="mb-0" style="color:white;">My Certifications</h2>
                    
                    <div class="status-badge-container"><br>  
                    <h6 style="color: white;">Showcase Your Certifications And Achievements</h6 >
                    </div></div>
                

                <!-- Certifications Section -->
                <div class="profile-body">
                    <div class="profile-item" style="display: block;">
                        <div class="profile-label">
                            <i class="fas fa-certificate"></i>
                        </div>
                        
                        <?php
                        if($certResult->num_rows > 0) {
                            while($cert = $certResult->fetch_assoc()) {
                        ?>
                        
                            <div class="profile-value" style="margin-top: 20px; padding: 20px; background: #f8f9fa; border-radius: 8px; border-left: 4px solid #00B074;">
                                <div style="margin-bottom: 10px;">
                                    <div align="right">

                                    
                            <button class="btn-delete" onclick="if(confirm('Are you sure you want to delete this certification?')) window.location='ViewCertification.php?del_id=<?= $cert['user_certification_id'] ?>' "
                            style="background-color: #f44336; color: white; padding: 8px 16px; text-decoration: none; border: none; border-radius: 4px; font-weight: bold;">
                            <i class="fas fa-trash"></i> Delete
                            </button>
                            </div>  

<!-- name ,details -->
                                    <strong style="font-size: 1.1em; color: #333;">
                                        <i class="fas fa-award" style="color: #00B074;"></i>
                                        <?php echo htmlspecialchars($cert['user_certification_name']); ?>
                                    </strong>
                                </div>
                            
                                
                                <div style="margin-bottom: 15px; color: #666; line-height: 1.6;">
                                    <?php echo nl2br(htmlspecialchars($cert['user_certification_content'])); ?>
                                </div>
                                
                                <?php
                                if(!empty($cert['user_certification_photo']) && file_exists("../Assets/Files/UserCertification/".$cert['user_certification_photo'])) {
                                    $fileExtension = strtolower(pathinfo($cert['user_certification_photo'], PATHINFO_EXTENSION));
                                    
                                    if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                                        // Display image
                                ?>
                                    <div style="margin-top: 15px;">
                                        <img src="../Assets/Files/UserCertification/<?php echo htmlspecialchars($cert['user_certification_photo']); ?>" 
                                             alt="Certificate" 
                                             style="max-width: 50%; height: 1000%; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); cursor: pointer;"
                                             onclick="window.open(this.src, '_blank')">
                                        <p style="margin-top: 8px; font-size: 12px; color: #999;">
                                            <i class="fas fa-file-image"></i> Click image to view full size
                                        </p>
                                    </div>
                                <?php
                                    } elseif($fileExtension === 'pdf') {
                                        //PDF link
                                ?>
                                    <div style="margin-top: 15px;">
                                        <a href="../Assets/Files/UserCertification/<?php echo htmlspecialchars($cert['user_certification_photo']); ?>" 
                                           target="_blank" 
                                           style="display: inline-block; padding: 10px 20px; background: #00B074; color: white; text-decoration: none; border-radius: 5px; transition: all 0.3s;">
                                            <i class="fas fa-file-pdf"></i> View Certificate PDF
                                        </a>
                                    </div>
                                <?php
                                    } else {
                                        //download link 
                                ?>
                                    <div style="margin-top: 15px;">
                                        <a href="../Assets/Files/UserCertification/<?php echo htmlspecialchars($cert['user_certification_photo']); ?>" 
                                           target="_blank" 
                                           style="display: inline-block; padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 5px; transition: all 0.3s;">
                                            <i class="fas fa-download"></i> Download Certificate
                                        </a>

                                        
                                    </div>
                                <?php
                                    }
                                } else {
                                ?>
                                    <div style="margin-top: 15px; padding: 20px; text-align: center; background: #fff; border-radius: 8px; border: 2px dashed #dee2e6;">
                                        <i class="fas fa-file-image" style="font-size: 36px; color: #ccc;"></i>
                                        <p style="margin-top: 10px; color: #999; margin-bottom: 0;">No certificate image uploaded</p>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        <?php
                            }
                        } else {
                        ?>
                            <div class="profile-value" style="margin-top: 20px;">
                                <div style="padding: 40px; text-align: center; background: #f8f9fa; border-radius: 8px; border: 2px dashed #dee2e6;">
                                    <i class="fas fa-certificate" style="font-size: 64px; color: #ccc;"></i>
                                    <p style="margin-top: 15px; color: #999; font-size: 1.1em;">No certifications added yet</p>
                                    <a href="AddCertification.php" 
                                       style="display: inline-block; margin-top: 15px; padding: 10px 25px; background: #0d6efd; color: white; text-decoration: none; border-radius: 5px; transition: all 0.3s;">
                                        <i class="fas fa-plus-circle"></i> Add Your First Certification
                                    </a>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>

                    <!-- Action Buttons -->
                    <div style="margin-top: 30px; text-align: center; padding-top: 20px; border-top: 1px solid #dee2e6;">
                        <a href="AddCertification.php" 
                           style="display: inline-block; margin: 0 10px; padding: 12px 30px; background: #0d6efd; color: white; text-decoration: none; border-radius: 5px; transition: all 0.3s;">
                            <i class="fas fa-plus-circle"></i> Add New Certification
                        </a>
                        <a href="MyProfile.php" 
                           style="display: inline-block; margin: 0 10px; padding: 12px 30px; background: #667eea; color: white; text-decoration: none; border-radius: 5px; transition: all 0.3s;">
                            <i class="fas fa-user"></i> Back to Profile
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
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
<?php
include("Foot.php");
?>
<?php
include("../Assets/Connection/connection.php");
include("Head.php");
session_start();

$selQry="select * from tbl_company where company_id='".$_SESSION['cid']."'";
$row=$con->query($selQry);
$data=$row->fetch_assoc();
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
                        <div class="profile-header">
                            <div class="profile-avatar">
                               <?php 
                               //logo
                        if(!empty($data['company_logo']) && file_exists("../Assets/Files/CompanyDocs/".$data['company_logo'])) { 
                        ?>
                            <img src="../Assets/Files/CompanyDocs/<?php echo $data['company_logo']; ?>" 
                                 alt="Company Logo" 
                                 style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                        <?php 
                        } else { 
                            echo strtoupper(substr($data['company_name'], 0, 1));
                        } 
                        ?>




<!-- company name & details-->

                            </div>
                            <h2 class="mb-0" style="color: white;"><?php echo $data['company_name']; ?></h2>
                           
                        </div>
                        
                        <div class="profile-body">
                            <div class="profile-item">
                                <div class="profile-label">
                                    <i class="fas fa-building"></i> Company Name 
                                </div>
                                <div class="profile-value" align="center">
                                    <?php echo $data['company_name']?>
                                </div>
                            </div>
<!-- Introduction Video -->
                    <div class="profile-item" style="display: block;">
                        <div class="profile-label">
                            <i class="fas fa-video"></i>Comapany Vedio
                        </div>
                        <div class="profile-value" style="margin-top: 15px;" align="center">
                            <?php
                            if(!empty($data['company_introduction']) && file_exists("../Assets/Files/CompanyIntroduction/".$data['company_introduction'])) {
                                ?>
                                <video width="300" height="200" controls style="border-radius: 8px; max-width: 640px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                    <source src="../Assets/Files/CompanyIntroduction/<?php echo htmlspecialchars($data['company_introduction']); ?>" type="video/mp4">
                                    <source src="../Assets/Files/CompanyIntroduction/<?php echo htmlspecialchars($data['company_introduction']); ?>" type="video/webm">
                                    Your browser does not support the video tag.
                                </video>
                                <p style="margin-top: 8px; font-size: 12px; color: #666;">
                                    <i class="fas fa-file-video"></i> <?php echo htmlspecialchars($data['company_introduction']); ?>
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
                                <div class="profile-label">
                                    <i class="fas fa-envelope"></i> Email
                                </div>
                                <div class="profile-value" align="center">
                                    <?php echo $data['company_email']?>
                                </div>
                            </div>
                            
                            <div class="profile-item">
                                <div class="profile-label" >
                                    <i class="fas fa-phone"></i> Contact
                                </div>
                                <div class="profile-value" align="center">
                                    <?php echo $data['company_contact']?>
                                </div>
                            </div>
                            
                            <div class="profile-item">
                                <div class="profile-label" >
                                    <i class="fas fa-lock"></i> Password
                                </div>
                                <div class="profile-value" align="center">
                                    ••••••••
                                </div>
                            </div>
                            
                            <div class="profile-item">
                                <div class="profile-label" >
                                    <i class="fas fa-map-marker-alt"></i> Address
                                </div>
                                <div class="profile-value" align="center">
                                    <?php echo $data['company_address']?>
                                </div>
                            </div>
                            
                            <div class="profile-item">
                                <div class="profile-label" >
                                    <i class="fas fa-calendar"></i> Date Joined
                                </div>
                                <div class="profile-value" align="center">
                                    <?php echo date('F d, Y', strtotime($data['company_date_join']))?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="profile-actions">
                            <a href="CompanyEditProfile.php" class="btn btn-primary py-3 px-5">
                                <i class="fas fa-edit me-2"></i> Edit Profile
                            </a>
                            <a href="CompanyChangePassword.php" class="btn btn-outline-primary py-3 px-5">
                                <i class="fas fa-key me-2"></i> Change Password
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
</body>
</html>
<?php include("Foot.php") ?>





















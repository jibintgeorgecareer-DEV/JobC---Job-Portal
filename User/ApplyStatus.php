<?php
include("../Assets/Connection/connection.php");
include("Head.php");
session_start();

// not the user go to Login.php
if (!isset($_SESSION['uid'])) {
    header("Location: ../Login.php");
    exit();
}

$session_id = $_SESSION['uid'];

// Get user details
$userQry = "SELECT * FROM tbl_user WHERE user_id = '$session_id'";
$userResult = $con->query($userQry);
$userData = $userResult->fetch_assoc();

// Get all applications by this user with job details
//connecting 3 tables 
$s = "SELECT a.apply_id,
             a.apply_date,
             a.apply_status,
             a.apply_file,
             a.hr_view,
             u.user_name,
             j.job_post_title,
             j.job_post_content,
             j.job_post_location,
             j.job_post_salary,
             j.job_post_deadline,
             j.job_post_experience,
             j.job_post_qualification,
             j.job_post_vacancy,
             j.additional_skill,
             j.company_id,
             c.company_name,
             c.company_logo
      FROM tbl_apply a
      INNER JOIN tbl_user u ON a.user_id = u.user_id
      INNER JOIN tbl_job_poster j ON a.job_post_id = j.job_post_id
      INNER JOIN tbl_company c ON j.company_id = c.company_id
      WHERE a.user_id = '$session_id'
      ORDER BY a.apply_date DESC";

$ex = $con->query($s);

//delete job post by user
if(isset($_GET["DelID"]))
{
    $qur="DELETE FROM tbl_apply WHERE apply_id='".$_GET["DelID"]."' ";
    if($con->query($qur))
    {
        ?>
        <script>
						alert("Job Post Deleted");
						window.location="ApplyStatus.php";
		</script>
<?php
    }
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="utf-8">
    <title>JobC - My Applications</title>
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
    <link href="../Assets/Templates/Main/css/PostList.css" rel="stylesheet"> 
</head>
<body>
    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1><i class="fas fa-briefcase me-3"></i>My Job Applications</h1>
            <p>Track all your job applications in one place</p>
        </div>
    </div>

    <div class="container mb-5">
        <?php
        // Some maths to calculate user and its id,status 
        $totalApplications = mysqli_num_rows($ex);
        $pendingQry = "SELECT COUNT(*) as count FROM tbl_apply WHERE user_id = $session_id AND apply_status = 0";
        $pendingResult = $con->query($pendingQry);
        $pendingCount = $pendingResult->fetch_assoc()['count'];
        
        $approvedQry = "SELECT COUNT(*) as count FROM tbl_apply WHERE user_id = $session_id AND apply_status = 1";
        $approvedResult = $con->query($approvedQry);
        $approvedCount = $approvedResult->fetch_assoc()['count'];
        ?>
        
        <!-- Summary of application -->
        <div class="stats-summary">
            <div class="stat-box">
                <div class="stat-number"><?php echo $totalApplications; ?></div>
                <div class="stat-label">Total Applications</div>
            </div>
            <div class="stat-box">
                <div class="stat-number"><?php echo $pendingCount; ?></div>
                <div class="stat-label">Pending</div>
            </div>
            
        </div>

        <?php
        if ($totalApplications > 0) {
            mysqli_data_seek($ex, 0); 
            while($row = $ex->fetch_assoc()) {
                //apply_dateto readable format
                $date_str = (string)$row['apply_date'];
                $formatted_date = substr($date_str, 0, 4) . '-' . substr($date_str, 4, 2) . '-' . substr($date_str, 6, 2);
                
                //status of appliaction
                $status_text = '';
                $status_class = '';
                switch ($row['apply_status']) {
                    case 0:
                        $status_text = 'Pending';
                        $status_class = 'active';
                        break;
                    case 1:
                        $status_text = 'Applied';
                        $status_class = 'active';
                        break;
                    case 2:
                        $status_text = 'ShortListed';
                        $status_class = 'active';
                        break;
                    case 3:
                        $status_text = 'Rejected';
                        $status_class = 'inactive';
                        break;
                    
                    case 4:
                        $status_text = 'Selected';
                        $status_class = 'active';
                        break;

                    default:
                        $status_text = 'Unknown';
                        $status_class = 'inactive';
                }
//company logo
$logoPath = isset($row['company_logo']) && !empty($row['company_logo']) 
    ? "../Assets/Files/CompanyDocs/" . $row['company_logo'] 
    : "../Assets/Templates/Main/img/company_null.jpeg";
?>





            <div class="post-card">
                <div class="post-header">

<!-- Company Logo -->
<a href="ViewCompanyProfile.php?company_id=<?php echo $row['company_id']; ?>">
<img class="flex-shrink-0 img-fluid border rounded"
src="<?php echo htmlspecialchars($logoPath); ?>"
alt="<?php echo htmlspecialchars($row['company_name']); ?>"
style="width: 80px; height: 80px;">
</a>


<!-- Name company -->
                    <h3 class="post-title" align="left"><?php echo htmlspecialchars($row['company_name']); ?></h3>

<!-- Check HR viwed resume -->
 <?php 
 if($row['hr_view']==1)
 {
    echo "<h5 style=\"color: white;\">HR Viewed Your Resume</h5>";
 }
 ?>



                    <span class="post-status <?php echo $status_class; ?>">
                        <?php echo $status_text; ?>
                    </span>
                </div>
                <!-- content -->
                <div class="post-body">
                    <div class="post-description">
                        <strong><i class="fas fa-align-left me-2"></i><?php echo htmlspecialchars($row['job_post_title']); ?>:</strong>
                        <p class="mb-0 mt-2"><?php echo htmlspecialchars($row['job_post_content']); ?></p>
                    </div>
                    <!-- Location -->
                    <div class="post-info-row">
                        <div class="post-info-item">
                            <div class="post-info-label">
                                <i class="fas fa-map-marker-alt"></i> Location
                            </div>
                            <div class="post-info-value">
                                <?php echo htmlspecialchars($row['job_post_location']); ?>
                            </div>
                        </div>
                        
                        <!-- salary -->
                        <div class="post-info-item">
                            <div class="post-info-label">
                                <i class="fas fa-dollar-sign"></i> Salary
                            </div>
                            <div class="post-info-value">
                                <?php echo htmlspecialchars($row['job_post_salary']); ?>
                            </div>
                        </div>
                        <!-- vacancy -->
                        <div class="post-info-item">
                            <div class="post-info-label">
                                <i class="fas fa-users"></i> Vacancies
                            </div>
                            <div class="post-info-value">
                                <?php echo $row['job_post_vacancy']; ?>
                            </div>
                        </div>
                    </div>
                    <!-- experience -->
                    <div class="post-info-row">
                        <div class="post-info-item">
                            <div class="post-info-label">
                                <i class="fas fa-clock"></i> Experience
                            </div>
                            <div class="post-info-value">
                                <?php echo htmlspecialchars($row['job_post_experience']); ?> years
                            </div>
                        </div>
                        <!-- qual -->
                        <div class="post-info-item">
                            <div class="post-info-label">
                                <i class="fas fa-graduation-cap"></i> Qualification
                            </div>
                            <div class="post-info-value">
                                <?php echo htmlspecialchars($row['job_post_qualification']); ?>
                            </div>
                        </div>
                        <!-- resume -->
                        <div class="post-info-item">
                            <div class="post-info-label">
                                <i class="fas fa-file-alt"></i> Resume
                            </div>
                            <div class="post-info-value">
                                <?php echo htmlspecialchars($row['apply_file']); ?>
                            </div>
                        </div>
                    </div>
                    <!-- date -->
                    <div class="post-info-row">
                        <div class="post-info-item">
                            <div class="post-info-label">
                                <i class="fas fa-calendar-alt"></i> Applied Date
                            </div>
                            <div class="post-info-value">
                                <?php echo date('F d, Y', strtotime($formatted_date)); ?>
                            </div>
                        </div>
                        <!-- expire -->
                        <div class="post-info-item">
                            <div class="post-info-label">
                                <i class="fas fa-calendar-times"></i> Deadline
                            </div>
                            <div class="post-info-value">
                                <?php echo date('F d, Y', strtotime($row['job_post_deadline'])); ?>
                            </div>
                        </div>
                        <!-- id -->
                        <div class="post-info-item">
                            <div class="post-info-label">
                                <i class="fas fa-id-card"></i> Application ID
                            </div>
                            <div class="post-info-value">
                                #<?php echo $row['apply_id']; ?>
                            </div>
                        </div>
                    </div>




                    <!-- Skills additional -->
                    <?php if(!empty($row['additional_skill'])) { ?>
                    <div class="mt-3">
                        <strong><i class="fas fa-star me-2"></i>Additional Skills:</strong>
                        <div class="mt-2">
                            <span class="badge-tag"><?php echo htmlspecialchars($row['additional_skill']); ?></span>
                        </div>
                    </div>


<!-- Delete Button -->
<div style="text-align: right;">
  <a href="ApplyStatus.php?DelID=<?php echo $row['apply_id']?>"
     onclick="return confirm('Do you want to delete job application?')"
     style="background-color: #f44336; color: white; padding: 8px 16px; text-decoration: none; border: none; border-radius: 4px; font-weight: bold;">
     Delete
  </a>
</div>

                    <?php } ?>
                </div>
            </div>
        <?php
            }
        } else {
        ?>
            <div class="no-posts">
                <i class="fas fa-clipboard-list"></i>
                <h3>No Applications Yet</h3>
                <p class="text-muted mb-4">You haven't applied to any jobs. Start exploring job opportunities!</p>
                <a href="JobList.php" class="btn btn-primary py-3 px-5">
                    Browse Jobs
                </a>
            </div>
        <?php
        }
        ?>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php include("Foot.php") ?>

<?php
$con->close();
?>
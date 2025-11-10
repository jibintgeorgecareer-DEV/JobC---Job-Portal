<?php
include("../Assets/Connection/connection.php");
include("Head.php");
session_start();
//All job post by company
$cid = $_SESSION['cid'];

// Get company details
$companyQry = "SELECT * FROM tbl_company WHERE company_id = '$cid'";
$companyResult = $con->query($companyQry);
$companyData = $companyResult->fetch_assoc();

// Get all job posts by this company
$qry = "SELECT jp.*, jt.job_type_name, jc.job_category_name 
        FROM tbl_job_poster jp
        LEFT JOIN tbl_job_type jt ON jp.job_type_id = jt.job_type_id
        LEFT JOIN tbl_job_category jc ON jp.job_category_id = jc.job_category_id
        WHERE jp.company_id = $cid
        ORDER BY jp.job_post_date DESC";
$sel = mysqli_query($con, $qry);

if(isset($_GET["deid"])) 
{
    //To delete a job post
    $deid = $_GET["deid"];
    $quer = "DELETE FROM tbl_job_poster WHERE job_post_id = '$deid' AND company_id = '$cid'";
    
    if($con->query($quer)) 
    {
        echo "<script>
        alert('Job Deleted Successfully!'); 
        window.location='PostList.php';
        </script>";
        exit();
    }
    else
    {
        echo "<script>
        alert('Error deleting job posting!'); 
        window.location='PostList.php';
        </script>";
        exit();
    }
}

// Get company details
$companyQry = "SELECT * FROM tbl_company WHERE company_id = '$cid'";
$companyResult = $con->query($companyQry);
$companyData = $companyResult->fetch_assoc();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="utf-8">
    <title>JobC - My Job Postings</title>
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
            <h1><i class="fas fa-briefcase me-3"></i>My Job Postings</h1>
            <p>Manage all your job postings in one place</p>
        </div>
    </div>

    <div class="container mb-5">
        <?php
        // Some maths
        $totalPosts = mysqli_num_rows($sel);
        $activeQry = "SELECT COUNT(*) as count FROM tbl_job_poster WHERE company_id = $cid AND job_post_status = 1";
        $activeResult = $con->query($activeQry);
        $activeCount = $activeResult->fetch_assoc()['count'];
        ?>
        
        <!-- Summary of jobs-->
        <div class="stats-summary">
            <div class="stat-box">
                <div class="stat-number"><?php echo $totalPosts; ?></div>
                <div class="stat-label">Total Postings</div>
            </div>
            <div class="stat-box">
                <div class="stat-number"><?php echo $activeCount; ?></div>
                <div class="stat-label">Active Postings</div>
            </div>
            <div class="stat-box">
                <div class="stat-number"><?php echo $totalPosts - $activeCount; ?></div>
                <div class="stat-label">Inactive Postings</div>
            </div>
        </div>

        <?php
        if ($totalPosts > 0) {
            mysqli_data_seek($sel, 0); 
            while($r = $sel->fetch_assoc()) {
        ?>
            <div class="post-card">
                <div class="post-header">
                    <h3 class="post-title"><?php echo htmlspecialchars($r['job_post_title']); ?></h3>
                    <span class="post-status <?php echo $r['job_post_status'] == 1 ? 'active' : 'inactive'; ?>">
                        <?php echo $r['job_post_status'] == 1 ? 'Active' : 'Inactive'; ?>
                    </span>
                </div>
                
                <div class="post-body">
                    <div class="post-description">
                        <strong><i class="fas fa-align-left me-2"></i>Description:</strong>
                        <p class="mb-0 mt-2"><?php echo htmlspecialchars($r['job_post_content']); ?></p>
                    </div>
                    
                    <div class="post-info-row">
                        <div class="post-info-item">
                            <div class="post-info-label">
                                <i class="fas fa-briefcase"></i> Job Type
                            </div>
                            <div class="post-info-value">
                                <?php echo htmlspecialchars($r['job_type_name']); ?>
                            </div>
                        </div>
                        
                        <div class="post-info-item">
                            <div class="post-info-label">
                                <i class="fas fa-tag"></i> Category
                            </div>
                            <div class="post-info-value">
                                <?php echo htmlspecialchars($r['job_category_name']); ?>
                            </div>
                        </div>
                        
                        <div class="post-info-item">
                            <div class="post-info-label">
                                <i class="fas fa-users"></i> Vacancies
                            </div>
                            <div class="post-info-value">
                                <?php echo $r['job_post_vacancy']; ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="post-info-row">
                        <div class="post-info-item">
                            <div class="post-info-label">
                                <i class="fas fa-map-marker-alt"></i> Location
                            </div>
                            <div class="post-info-value">
                                <?php echo htmlspecialchars($r['job_post_location']); ?>
                            </div>
                        </div>
                        
                        <div class="post-info-item">
                            <div class="post-info-label">
                                <i class="fas fa-clock"></i> Experience
                            </div>
                            <div class="post-info-value">
                                <?php echo htmlspecialchars($r['job_post_experience']); ?> years
                            </div>
                        </div>
                        
                        <div class="post-info-item">
                            <div class="post-info-label">
                                <i class="fas fa-dollar-sign"></i> Salary
                            </div>
                            <div class="post-info-value">
                                <?php echo htmlspecialchars($r['job_post_salary']); ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="post-info-row">
                        <div class="post-info-item">
                            <div class="post-info-label">
                                <i class="fas fa-graduation-cap"></i> Qualification
                            </div>
                            <div class="post-info-value">
                                <?php echo htmlspecialchars($r['job_post_qualification']); ?>
                            </div>
                        </div>
                        
                        <div class="post-info-item">
                            <div class="post-info-label">
                                <i class="fas fa-calendar-alt"></i> Posted Date
                            </div>
                            <div class="post-info-value">
                                <?php echo date('F d, Y', strtotime($r['job_post_date'])); ?>
                            </div>
                        </div>
                        
                        <div class="post-info-item">
                            <div class="post-info-label">
                                <i class="fas fa-calendar-times"></i> Deadline
                            </div>
                            <div class="post-info-value">
                                <?php echo date('F d, Y', strtotime($r['job_post_deadline'])); ?>
                            </div>
                        </div>
                    </div>
                    
                    <?php if(!empty($r['additional_skill'])) { ?>
                    <div class="mt-3">
                        <strong><i class="fas fa-star me-2"></i>Additional Skills:</strong>
                        <div class="mt-2">
                            <span class="badge-tag"><?php echo htmlspecialchars($r['additional_skill']); ?></span>
                        </div>
                    </div>
                    <?php } ?>
                    
                    <div class="post-actions">
                        <a href="CandidateList.php?jid=<?php echo $r['job_post_id']; ?>" class="btn-action btn-view">
                            <i class="fas fa-eye"></i> View Applications
                        </a>
                        <a href="EditPost.php?jid=<?php echo $r['job_post_id']; ?>" class="btn-action btn-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
    
                        <a href="PostList.php?deid=<?php echo $r['job_post_id']; ?>" class="btn-action btn-delete" 
                        onclick="return confirm('Are you sure you want to delete this job posting?')">
                            <i class="fas fa-trash"></i> Delete
                            </a>
                    </div>
                </div>
            </div>
        <?php
            }
        } else {
        ?>
            <div class="no-posts">
                <i class="fas fa-clipboard-list"></i>
                <h3>No Job Postings Yet</h3>
                <p class="text-muted mb-4">You haven't created any job postings. Start posting jobs to find the best candidates!</p>
                <a href="JobPost.php" class="btn btn-primary py-3 px-5">
                    Post Job
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
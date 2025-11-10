<?php
include("../Assets/Connection/connection.php");
session_start();
include('Head.php');

// Get job ID from URL(that clicked job from other page)
$job_id = isset($_GET['job_id']) ? intval($_GET['job_id']) : 0;


// Fetch job details 
$sql = "SELECT 
            jp.*,
            jc.job_category_name,
            jt.job_type_name,
            c.company_name,
            c.company_logo,
            c.company_address,
            c.company_contact,
            c.company_email
        FROM 
            tbl_job_poster jp
        LEFT JOIN 
            tbl_job_category jc ON jp.job_category_id = jc.job_category_id
        LEFT JOIN 
            tbl_job_type jt ON jp.job_type_id = jt.job_type_id
        LEFT JOIN 
            tbl_company c ON jp.company_id = c.company_id
        WHERE 
            jp.job_post_id = ? AND jp.job_post_status = 1";

$stmt = $con->prepare($sql);
$stmt->bind_param("i", $job_id);
$stmt->execute();
$result = $stmt->get_result();



$job = $result->fetch_assoc();

// Set values
$logoPath = isset($job['company_logo']) && !empty($job['company_logo']) 
    ? "../Assets/Files/CompanyDocs/" . $job['company_logo'] 
    : "../Assets/Templates/Main/img/company_null.jpeg";

$jobTypeName = isset($job['job_type_name']) ? $job['job_type_name'] : 'Full Time';


if(isset($_POST['btn_submit']))  
{
//submit report
$title=$_POST['txt_title'];
$content=$_POST['txt_content'];
$in="INSERT INTO tbl_job_report(report_title,report_content,user_id,job_post_id,company_id)
     VALUES ('".$title."','".$content."','".$_SESSION['uid']."','".$job['job_post_id']."',
       '".$job['company_id']."') ";
 
  if($con->query($in))
     {
?>
        <script>
        alert("Complaint Submitted Successfully!");
        window.location="HomePage.php";
        </script>
<?php
     }
}











?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>JobC- Report Job</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">          
    <meta content="" name="keywords">
    <meta content="" name="description">

    

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

    <!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">

<!-- Icon Font Stylesheet -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Bootstrap CSS -->
<link href="../Assets/Templates/Main/css/bootstrap.min.css" rel="stylesheet">
<link href="../Assets/Templates/Main/css/style.css" rel="stylesheet">
<link href="../Assets/Templates/Main/css/JobPost.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 text-center">
                <h1 class="display-6 text-white mb-0"><i class="fas fa-user-secret me-2"></i>Report Job</h1>
            </div>
        </div>
    </div>
</div>


    <!-- Job detail Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row gy-5 gx-4">
                <div class="col-lg-8">
                    <!-- logo & name -->
                    <div class="d-flex align-items-center mb-5">
                        <a href="ViewCompanyProfile.php?company_id=<?php echo $job['company_id']; ?>">
                <img class="flex-shrink-0 img-fluid border rounded"
                src="<?php echo htmlspecialchars($logoPath); ?>"
                alt="<?php echo htmlspecialchars($job['company_name']); ?>"
                style="width: 80px; height: 80px;">
                </a>
                        <div class="text-start ps-4"><!-- title -->
                            <h3 class="mb-3"><?php echo htmlspecialchars($job['job_post_title']); ?></h3>
                            <span class="text-truncate me-3"><!-- loc -->
                                <i class="fa fa-map-marker-alt text-primary me-2"></i>
                                <?php echo htmlspecialchars($job['job_post_location']); ?>
                            </span><!-- jobtype  -->
                            <span class="text-truncate me-3">
                                <i class="far fa-clock text-primary me-2"></i>
                                <?php echo htmlspecialchars($jobTypeName); ?>
                            </span><!-- salary -->
                            <span class="text-truncate me-0">
                                <i class="far fa-money-bill-alt text-primary me-2"></i>
                                ₹<?php echo htmlspecialchars($job['job_post_salary']); ?>
                            </span>
                        </div>
                    </div>


 <style>
.job-post-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 80vh;
    padding: 20px;
}

.job-post-card {
    max-width: 800px;  
    width: 100%;
}
</style>

<div class="job-post-container">
    <div class="job-post-card">
        <div class="job-post-header">
            <h2><font color="white">Report Job</font></h2>
            <p>Write Your Report</p>
        </div>

        <form id="form1" name="form1" method="post" action="">
            <div class="job-post-body">

                <div class="form-group">
                    <label class="form-label"> Title</label>
                    <input type="text" name="txt_title" id="txt_title" class="form-control" placeholder="Enter title" required />
                </div>

                <div class="form-group">
                    <label class="form-label"> Content</label>
                    <textarea id="txt_content" name="txt_content" rows="5" class="form-control" placeholder="Type details..." required></textarea>
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" name="btn_submit" id="btn_submit" class="btn-submit">
                    <i class="fas fa-paper-plane"></i> Submit Complaint
                </button>
                <button type="reset" name="btn_clear" id="btn_clear" class="btn-reset">
                    <i class="fas fa-eraser"></i> Clear
                </button>
            </div>
        </form>
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

<?php include('Foot.php'); ?>
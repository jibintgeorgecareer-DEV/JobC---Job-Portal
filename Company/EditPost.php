<?php
include("../Assets/Connection/connection.php");
session_start();
//include("Head.php");
//Edit existing Job post

//Check company log in
if(!isset($_SESSION['cid'])) {
    header("Location: CompanyLogin.php");
    exit();
}

$cid = $_SESSION['cid'];
$job_id = $_GET['jid'];

//Fetch job post details of company
$selqry = "SELECT * FROM tbl_job_poster WHERE job_post_id = '$job_id' AND company_id = '$cid'";
$result = $con->query($selqry);

if($result->num_rows == 0) {
    echo "<script>alert('Job post not found!'); window.location='PostList.php';</script>";
    exit();
}

$job_data = $result->fetch_assoc();

if(isset($_POST['btn_update'])) {
    $title = $_POST['txt_title'];
    $content = $_POST['txt_content'];
    $vacancy = $_POST['txt_vacancy'];
    $experience = $_POST['txt_experience'];
    $location = $_POST['txt_location'];
    $deadline = $_POST['txt_deadline'];
    $qualification = $_POST['txt_qualification'];
    $salary = $_POST['txt_salary'];
    $job_type = $_POST['sel_jobtype'];
    $job_category = $_POST['sel_jobcategory'];
    $additional_skill = $_POST['txt_skills'];
    
    //file upload
    $photo = $job_data['job_post_photo'];
    if(!empty($_FILES["file_photo"]["name"])) {
        $photo = $_FILES["file_photo"]["name"];
        $temp = $_FILES["file_photo"]["tmp_name"];
        move_uploaded_file($temp, "../Assets/Files/JobPostPhoto/".$photo);
    }
    //update Job post
    $update = "UPDATE tbl_job_poster SET 
                job_post_title = '$title',
                job_post_content = '$content',
                job_post_vacancy = '$vacancy',
                job_post_experience = '$experience',
                job_post_location = '$location',
                job_post_deadline = '$deadline',
                job_post_qualification = '$qualification',
                job_post_salary = '$salary',
                job_type_id = '$job_type',
                job_category_id = '$job_category',
                additional_skill = '$additional_skill',
                job_post_photo = '$photo'
              WHERE job_post_id = '$job_id' AND company_id = '$cid'";
    
    if($con->query($update)) {
        echo "<script>
            alert('Job post updated successfully!');
            window.location='PostList.php';
        </script>";
    } else {
        echo "<script>alert('Failed to update job post!');</script>";
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="utf-8">
    <title>JobC - Edit Job Post</title>
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
    <link href="../Assets/Templates/Main/css/JobPost.css" rel="stylesheet">
    
</head>

<body>
 
<!-- Edit Job post  -->
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="job-post-container">
                <div class="job-post-card">
                    <div class="job-post-header">
                        <h2><i class="fas fa-edit"></i><font color="white"> Edit Job Post</font></h2>
                        <p>Update your job posting information</p>
                    </div>

                    <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
                        <div class="job-post-body">

                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-heading"></i> Job Title</label>
                                <input type="text" name="txt_title" id="txt_title" class="form-control" 
                                       value="<?php echo htmlspecialchars($job_data['job_post_title']); ?>" required />
                            </div>

                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-align-left"></i> Job Description</label>
                                <textarea name="txt_content" id="txt_content" class="form-control" rows="4" 
                                          required><?php echo htmlspecialchars($job_data['job_post_content']); ?></textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-users"></i> Vacancies</label>
                                <input type="number" name="txt_vacancy" id="txt_vacancy" class="form-control" 
                                       value="<?php echo htmlspecialchars($job_data['job_post_vacancy']); ?>" required />
                            </div>

                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-clock"></i> Experience (Years)</label>
                                <input type="text" name="txt_experience" id="txt_experience" class="form-control" 
                                       value="<?php echo htmlspecialchars($job_data['job_post_experience']); ?>" required />
                            </div>

                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-map-marker-alt"></i> Location</label>
                                <input type="text" name="txt_location" id="txt_location" class="form-control" 
                                       value="<?php echo htmlspecialchars($job_data['job_post_location']); ?>" required />
                            </div>

                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-calendar-times"></i> Application Deadline</label>
                                <input type="date" name="txt_deadline" id="txt_deadline" class="form-control" 
                                       value="<?php echo htmlspecialchars($job_data['job_post_deadline']); ?>" required />
                            </div>

                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-graduation-cap"></i> Qualification</label>
                                <input type="text" name="txt_qualification" id="txt_qualification" class="form-control" 
                                       value="<?php echo htmlspecialchars($job_data['job_post_qualification']); ?>" required />
                            </div>

                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-dollar-sign"></i> Salary</label>
                                <input type="text" name="txt_salary" id="txt_salary" class="form-control" 
                                       value="<?php echo htmlspecialchars($job_data['job_post_salary']); ?>" required />
                            </div>

                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-briefcase"></i> Job Type</label>
                                <select name="sel_jobtype" id="sel_jobtype" class="form-control" required>
                                    <option value="">Select Job Type</option>
                                    <?php
                                    $type_qry = "SELECT * FROM tbl_job_type";
                                    $type_result = $con->query($type_qry);
                                    while($type_row = $type_result->fetch_assoc()) {
                                        $selected = ($type_row["job_type_id"] == $job_data['job_type_id']) ? 'selected' : '';
                                        echo "<option value='".$type_row["job_type_id"]."' $selected>".$type_row["job_type_name"]."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
<!-- Category -->
                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-tag"></i> Job Category</label>
                                <select name="sel_jobcategory" id="sel_jobcategory" class="form-control" required>
                                    <option value="">Select Job Category</option>
                                    <?php
                                    $cat_qry = "SELECT * FROM tbl_job_category";
                                    $cat_result = $con->query($cat_qry);
                                    while($cat_row = $cat_result->fetch_assoc()) {
                                        $selected = ($cat_row["job_category_id"] == $job_data['job_category_id']) ? 'selected' : '';
                                        echo "<option value='".$cat_row["job_category_id"]."' $selected>".$cat_row["job_category_name"]."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
<!-- Skills aditional -->
                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-star"></i> Additional Skills</label>
                                <input type="text" name="txt_skills" id="txt_skills" class="form-control" 
                                       value="<?php echo htmlspecialchars($job_data['additional_skill']); ?>" />
                            </div>

                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-image"></i> Job Post Photo</label>
                                <input type="file" name="file_photo" id="file_photo" class="form-control" />
                                <?php if(!empty($job_data['job_post_photo'])){ ?>
                                    <small class="text-muted">Current: <?php echo $job_data['job_post_photo']; ?></small>
                                <?php } ?>
                            </div>

                        </div>

                        <div class="form-actions">
                            <button type="submit" name="btn_update" id="btn_update" class="btn-submit">
                                <i class="fas fa-save"></i> Update Job Post
                            </button>
                            <a href="PostList.php" class="btn-reset">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
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
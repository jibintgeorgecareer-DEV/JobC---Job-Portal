<?php
include("../Assets/Connection/connection.php");
session_start();
include("Head.php");

//user details
$select = "SELECT  u.*,
                c.job_category_name,
                n.user_now
        FROM    tbl_user u

        LEFT JOIN tbl_job_category c ON c.job_category_id = u.user_job_category
        LEFT JOIN tbl_user_now     n ON n.user_now_id     = u.user_now_id
        WHERE   u.user_id = '" . $_SESSION['uid'] . "'";


$userRow = $con->query($select)->fetch_assoc();

//uploaded certifications
$up="SELECT * FROM tbl_user_certifications WHERE user_id = '{$userRow['user_id']}' 
        ORDER BY user_certification_id DESC";
$existingCerts = $con->query($up);

                                // Add new certification
if (isset($_POST['btn-submit'])) {
    $Name = $_POST['txt_cert_name'];
    $Content = $_POST['txt_cert_content'];
    
    
    $Photo = ''; //Store cer photo
    if (!empty($_FILES['file_cert_photo']['name'])) {
        $Photo = $_FILES['file_cert_photo']['name'];
        move_uploaded_file($_FILES['file_cert_photo']['tmp_name'], "../Assets/Files/UserCertification/" . $Photo);
    }
    
    $ins = "INSERT INTO tbl_user_certifications(user_certification_name, user_certification_content, user_certification_photo, user_id) 
            VALUES('$Name', '$Content', '$Photo', '{$userRow['user_id']}')";
    
                if ($con->query($ins)) 
                    {
                echo "<script>alert('Certification added successfully!'); window.location='AddCertification.php';</script>";
                exit;
                } 
                else 
                {
                echo "<script>alert('Failed to add certification: " . $con->error . "');</script>";
                }
}

// Delete certification
if (isset($_GET['del_id'])) {
    $delId = $_GET['del_id'];
    $delete = "DELETE FROM tbl_user_certifications WHERE user_certification_id = '$delId' AND user_id = '{$userRow['user_id']}'";
    
    if ($con->query($delete)) {
        echo "<script>alert('Certification deleted successfully!'); window.location='AddCertification.php';</script>";
        exit;
    } else {
        echo "<script>alert('Failed to delete certification!');</script>";
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<title>JobC – Add Certifications</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="../Assets/Templates/Main/css/bootstrap.min.css" rel="stylesheet">
<link href="../Assets/Templates/Main/css/style.css" rel="stylesheet">
<link href="../Assets/Templates/Main/css/JobPost.css" rel="stylesheet">
<script src="../Assets/Templates/Main/JQ/jQuery.js"></script>

</head>

<body>
<div class="container-xxl bg-white p-0">
    <div class="job-post-container">
        <div class="job-post-card">
            <div class="job-post-header">
                <h2><i class="fas fa-certificate"></i><font color="white">&nbsp Add Certifications</font></h2>
                <p>Add Your Certifications And Achievements</p>
            </div>

            <form method="post" enctype="multipart/form-data">
                <div class="job-post-body">

                    <div class="form-group">
                        <label><i class="fas fa-award"></i> Certification Name</label>
                        <input type="text" name="txt_cert_name" class="form-control" placeholder="" required maxlength="50">
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-file-alt"></i> Certification Details</label>
                        <textarea name="txt_cert_content" class="form-control" rows="3" placeholder="" ></textarea>
                        <small class="text-muted">Include issuing organization, validity period, or certificate ID</small>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-image"></i> Certification Photo</label>
                        <input type="file" name="file_cert_photo" class="form-control" accept="image/*,application/pdf">
                        <small class="text-muted">Upload certificate image or PDF (optional)</small>
                    </div>

                </div>

                <div class="job-post-footer" align="center">
                    <button type="submit" name="btn-submit" class="btn-submit" >
                        <i class="fas fa-plus-circle"></i> Add Certification
                    </button>
                    
                </div>
            </form>

        </div>
        <br>
       

       

    </div>
</div>

<script src="../Assets/Templates/Main/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
include("Foot.php");
?>
<?php
include("../Assets/Connection/connection.php");
//All job posts
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>District-JobC</title>
<link href="../Assets/Templates/Main/img/JobC_logo.png" rel="icon">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.0.96/css/materialdesignicons.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <link rel="stylesheet" href="../Assets/Templates/Admin/Admin-Template/Styles/Dashboard.css">
    <link rel="stylesheet" href="../Assets/Templates/Admin/Admin-Template/Styles/ButtonImage.css">
	  <link rel="stylesheet" href="../Assets/Templates/Admin/Admin-Template/Styles/FormsTextbox.css">
    <link rel="stylesheet" href="../Assets/Templates/Admin/Admin-Template/Styles/Dropdown.css">
    <script src="../Assets/JQ/jQuery.js"></script>
</head>
<body>
     <p> <a href="AdminHome.php" class="link-with-icon">
        <i class="fas fa-home"></i>
        Dashboard
        </a>  
</p>

<center>
<form id="form1" name="form1" method="post" action="">
  <div class="form-container">
    <div class="form-header">
      <i class="fas fa-edit"></i> Job Listings
    </div>
<!-- Job lists by compnay -->
    <div class="form-body">
      <div class="form-group">
        <label for="companySelect" class="form-label">Select Company</label>
        <select id="companySelect" name="companySelect" class="form-control" onchange="this.form.submit()">
            <option value="">Select a Company</option>
            <?php
            $selCompany = "SELECT * FROM tbl_company WHERE company_status = 1 ORDER BY company_name";
            $resCompany = $con->query($selCompany);

            if ($resCompany->num_rows > 0) {
                while ($company = $resCompany->fetch_assoc()) {
                    $selected = "";
                    if(isset($_POST['companySelect']) && $_POST['companySelect'] == $company['company_id']) {
                        $selected = "selected";
                    }
                    echo "<option value='{$company['company_id']}' $selected>{$company['company_name']}</option>";
                }
            } else {
                echo "<option value=''>No companies found</option>";
            }
            ?>
        </select>
      </div>
      
      <div class="form-actions">
       
      </div>
    </div>
  </div>
</form>





<!-- Handle Delete & Remove-->
<?php
if(isset($_GET['action']) && isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];
    $action = $_GET['action'];
    
    if($action == 'delete') {
        //Delete the job post 
        $delQuery = "DELETE FROM tbl_job_poster WHERE job_post_id = $job_id";
        if($con->query($delQuery)) {
            echo "<script>alert('Job post deleted successfully');</script>";
            echo "<script>window.location.href='JobListing.php';</script>";
        } else {
            echo "<script>alert('Failed to delete job post');</script>";
        }
    } 
    elseif($action == 'remove') {
        //Set job_post_status to 2 (remove)
        $updateQuery = "UPDATE tbl_job_poster SET job_post_status = 2 WHERE job_post_id = $job_id";
        if($con->query($updateQuery)) {
            echo "<script>alert('Job post removed successfully');</script>";
            echo "<script>window.location.href='JobListing.php';</script>";
        } else {
            echo "<script>alert('Failed to remove job post');</script>";
        }
    }
}
?>





<!-- Job Posts Area -->
<div id="jobPosts" class="job-list">
    <?php
    if(isset($_POST['companySelect']) && $_POST['companySelect'] != "") {
        $company_id = $_POST['companySelect'];
        
        $selJobs = "SELECT j.*, c.company_name, cat.job_category_name 
                    FROM tbl_job_poster j 
                    INNER JOIN tbl_company c ON j.company_id = c.company_id 
                    INNER JOIN tbl_job_category cat ON j.job_category_id = cat.job_category_id 
                    WHERE j.company_id = $company_id 
                    AND j.job_post_status = 1 
                    ORDER BY j.job_post_date DESC";
        
        $resJobs = $con->query($selJobs);
        
        if($resJobs->num_rows > 0) {
            echo '<center>
                    <div class="table-container">
                        <div class="table-header">
                            <i class="mdi mdi-briefcase-check"></i> Job Posts List
                        </div>
                        <div class="table-responsive">
                            <table border="1" height="150" class="table">
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Company Name</th>
                                    <th>Job Title</th>
                                    <th>Category</th>
                                    <th>Location</th>
                                    <th>Vacancy</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>';
            
            $count = 1;
            while($job = $resJobs->fetch_assoc()) {
                echo '<tr>
                        <td>'.$count.'</td>
                        <td>'.$job['company_name'].'</td>
                        <td>'.$job['job_post_title'].'</td>
                        <td>'.$job['job_category_name'].'</td>
                        <td>'.$job['job_post_location'].'</td>
                        <td>'.$job['job_post_vacancy'].'</td>
                        <td>'.($job['job_post_status'] == 1 ? 'Active' : 'Inactive').'</td>
                        <td>
                            <a href="JobListing.php?action=remove&job_id='.$job['job_post_id'].'" class="btn btn-warning btn-sm" onclick="return confirm(\'Are you sure you want to remove this job post?\')">Remove</a>
                            <a href="JobListing.php?action=delete&job_id='.$job['job_post_id'].'" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to permanently delete this job post?\')">Delete</a>
                        </td>
                      </tr>';
                $count++;
            }
            echo '</table>
                </div>
            </div>
        </center>';
        } else {
            echo "<p>No job posts found for this company.</p>";
        }
    } else {
        echo "<h5>Select a company to view its job posts...</h5>";
    }
    ?>


</body>
</html>
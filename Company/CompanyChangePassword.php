<?php
session_start();
include("../Assets/Connection/connection.php");
include("Head.php");

   
	//Update query
	
if(isset($_POST['btn_save']))
{
	
	$current=$_POST['txt_current'];
	$new=$_POST['txt_new'];
	$confirm=$_POST['txt_confirm'];
	
	
	$sel="SELECT * FROM tbl_company WHERE company_id='".$_SESSION['cid']."' ";
	$row=$con->query($sel);
	$data=$row->fetch_assoc();
	$pwd=$data['company_password'];
	
	
			
				if($current==$data['company_password'])
				{
					if($new==$confirm)
					{
						$upQry="update tbl_company set company_password='".$new."' where company_id='".$_SESSION['cid']."'";
							 if($con->query($upQry))
			 {
			?>
              <script>
			  alert("Updated Company Password");
			  window.location="CompanyProfile.php";
			  </script>
			<?php
			 }
					}
					else
					{
						?>
              <script>
			  alert("Password Is Not Same");
			
			  </script>
			<?php
					}
				}
				else
				{?>
              <script>
			  alert("Current Password  Not same");
			 
			  </script>
			<?php
				}
}
		




?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<title>JobC - Edit Password</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport">

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

<script src="../../Assets/Templates/Main/JQ/jQuery.js"></script>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Navbar -->
    
        <!-- Change Password Section -->
        <div class="job-post-container">
            <div class="job-post-card">
                <div class="job-post-header">
                    <h2><i class="fas fa-lock"></i><font color="white"> Change Password</h2>
                    <p>Update your account password securely</p>
                </div>

                <form id="form1" name="form1" method="post" action="">
                    <div class="job-post-body">

                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-key"></i> Current Password</label>
                            <input type="password" name="txt_current" id="txt_current" class="form-control" placeholder="Enter current password" required />
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-lock"></i> New Password</label>
                            <input type="password" name="txt_new" id="txt_new" class="form-control" placeholder="Enter new password" required />
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-check-circle"></i> Confirm Password</label>
                            <input type="password" name="txt_confirm" id="txt_confirm" class="form-control" placeholder="Re-enter new password" required />
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" name="btn_save" id="btn_save" class="btn-submit">
                            <i class="fas fa-save"></i> Save Password
                        </button>
                        <button type="reset" name="btn_clear" id="btn_clear" class="btn-reset">
                            <i class="fas fa-redo"></i> Clear
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php include("Foot.php") ?>
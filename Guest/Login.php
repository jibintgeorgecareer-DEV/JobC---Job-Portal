<?php
session_start();
include("../Assets/Connection/connection.php");

//Check 3 modules with the email and pass
	if(isset($_POST['btn_submit']))
	{
		$email=$_POST['txt_email'];
		$pass=$_POST['txt_pass'];
		
		
	    $sel="SELECT * FROM tbl_admin WHERE admin_email='".$email."' AND admin_password='".$pass."' ";
		$row=$con->query($sel);
		
		
		$selUser="SELECT * FROM tbl_user WHERE user_email='".$email."' AND user_password='".$pass."' ";
		$rowUser=$con->query($selUser);
		
		
		
	    $selCompany="SELECT * FROM tbl_company WHERE company_email='".$email."' AND company_password='".$pass."' ";
		$rowCompany=$con->query($selCompany);
		
		
		
	//create session id	
		if($data=$row->fetch_assoc())
		{
			$_SESSION['aid']=$data['admin_id'];
			$_SESSION['aname']=$data['admin_name'];
			
            header("location:../Admin/AdminHome.php");
		 }
		 
		 else if($datacompany=$rowCompany->fetch_assoc())
		{
			echo $_SESSION['cid']=$datacompany['company_id'];
			$_SESSION['cname']=$datacompany['company_name'];
			
			header("location:../Company/HomePage.php");
		 }
		 
		 
		  else if($datauser=$rowUser->fetch_assoc())
		{
			$_SESSION['uid']=$datauser['user_id'];
			$_SESSION['uname']=$datauser['user_name'];
			
			header("location:../User/HomePage.php");
		 }
		 

		 else
		 {
			 ?>
             
             <script>
			 			alert("Invalid Inputs");
						window.location="Login.php";
			 </script>
<?php
		 }}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>JobC - Login</title>
<link href="../Assets/Templates/Main/img/JobC_logo.png" rel="icon">
<style>

.jobentry-login-body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #000000 0%, #000000
 100%);
    margin: 0;
    padding: 0;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.jobentry-login-container {
    display: flex;
    width: 900px;
    height: 550px;
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
}

.jobentry-login-left {
    flex: 1;
    background: linear-gradient(to bottom right, #0d6efd, #0d6efd);
    color: white;
    padding: 50px 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.jobentry-login-right {
    flex: 1;
    padding: 50px 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.jobentry-login-title {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 15px;
    line-height: 1.2;
}

.jobentry-login-subtitle {
    font-size: 16px;
    margin-bottom: 30px;
    opacity: 0.9;
    line-height: 1.6;
}

.jobentry-login-features {
    margin-top: 30px;
}

.jobentry-login-feature {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.jobentry-login-feature-icon {
    background: rgba(255, 255, 255, 0.2);
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    font-weight: bold;
}

.jobentry-login-form-title {
    font-size: 28px;
    font-weight: 600;
    color: #1e3c72;
    margin-bottom: 30px;
    text-align: center;
}

.jobentry-login-form-group {
    margin-bottom: 20px;
}

.jobentry-login-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #333;
    font-size: 14px;
}

.jobentry-login-input {
    width: 100%;
    padding: 14px 15px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 15px;
    transition: all 0.3s;
    box-sizing: border-box;
    background-color: #f9f9f9;
}

.jobentry-login-input:focus {
    outline: none;
    border-color: #2a5298;
    box-shadow: 0 0 0 2px rgba(42, 82, 152, 0.2);
    background-color: #fff;
}

.jobentry-login-btn-group {
    display: flex;
    gap: 12px;
    margin-top: 25px;
}

.jobentry-login-btn {
    flex: 1;
    padding: 14px;
    border: none;
    border-radius: 6px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}

.jobentry-login-btn-primary {
    background: linear-gradient(to right, #0d6efd, #0d6efd);
    color: white;
}

.jobentry-login-btn-primary:hover {
    background: linear-gradient(to right, #2a5298, #1e3c72);
    box-shadow: 0 4px 12px rgba(42, 82, 152, 0.3);
}

.jobentry-login-btn-secondary {
    background-color: #f1f1f1;
    color: #555;
}

.jobentry-login-btn-secondary:hover {
    background-color: #e5e5e5;
}

.jobentry-login-links {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 25px;
    padding-top: 20px;
    border-top: 1px solid #eee;
}

.jobentry-login-link {
    color: #2a5298;
    text-decoration: none;
    font-weight: 500;
    font-size: 14px;
    transition: color 0.3s;
}

.jobentry-login-link:hover {
    color: #1e3c72;
    text-decoration: underline;
}

.jobentry-login-footer {
    text-align: center;
    margin-top: 20px;
    color: #777;
    font-size: 13px;
}

@media (max-width: 950px) {
    .jobentry-login-container {
        width: 95%;
        height: auto;
        flex-direction: column;
    }
    
    .jobentry-login-left, .jobentry-login-right {
        padding: 40px 30px;
    }
}
</style>
</head>

<body class="jobentry-login-body">

<div class="jobentry-login-container">
    <div class="jobentry-login-left">
        <h1 class="jobentry-login-title">Find The Perfect Job That You Deserved</h1>
        <p class="jobentry-login-subtitle">"Where ambition meets opportunity — empowering companies to hire smarter and individuals to grow faster."</p>
        
        <div class="jobentry-login-features">
            <div class="jobentry-login-feature">
                <div class="jobentry-login-feature-icon">1</div>
                <div>Search thousands of job listings</div>
            </div>
            <div class="jobentry-login-feature">
                <div class="jobentry-login-feature-icon">2</div>
                <div>Connect with top employers</div>
            </div>
            <div class="jobentry-login-feature">
                <div class="jobentry-login-feature-icon">3</div>
                <div>Advance your career path</div>
            </div>
        </div>
    </div>
    
    <div class="jobentry-login-right">
        <h2 class="jobentry-login-form-title">Welcome Back</h2>
        
        <form id="form1" name="form1" method="post" action="">
            <div class="jobentry-login-form-group">
                <label for="txt_email" class="jobentry-login-label">Email</label>
                <input type="email" name="txt_email" id="txt_email" class="jobentry-login-input" placeholder="Enter your email" required />
            </div>
            
            <div class="jobentry-login-form-group">
                <label for="txt_pass" class="jobentry-login-label">Password</label>
                <input type="password" name="txt_pass" id="txt_pass" class="jobentry-login-input" placeholder="Enter your password" required />
            </div>
            
            <div class="jobentry-login-btn-group">
                <input type="submit" name="btn_submit" id="btn_submit" class="jobentry-login-btn jobentry-login-btn-primary" value="Login" />
                <input type="reset" name="btn_reset" id="btn_reset" class="jobentry-login-btn jobentry-login-btn-secondary" value="Cancel" />
            </div>
            
            <div class="jobentry-login-links">
                <a href="NewCompany.php" class="jobentry-login-link">New Company</a>
                <a href="NewUser.php" class="jobentry-login-link">New User</a>
            </div>
        </form>
        
        <div class="jobentry-login-footer">
            &copy; 2025 JobC. All rights reserved.
        </div>
    </div>
</div>
</body>
</html> 
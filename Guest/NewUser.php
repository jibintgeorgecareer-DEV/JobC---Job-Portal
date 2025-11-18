<?php
include("../Assets/Connection/connection.php");
session_start();

if(isset($_POST["btn_submit"])){
    //insert to tbl_user
    $name    = $_POST["txt_name"];
    $gender  = $_POST["radio"];
    $email   = $_POST["txt_email"];
    $contact = $_POST["txt_contact"];
    $pass    = $_POST["txt_pass"];
    $address = $_POST["txt_address"];
    $jobcategory=$_POST["sel_category"];
    $qual=$_POST["qual"];

    $photo   = $_FILES["photo"]["name"];
    $temp    = $_FILES["photo"]["tmp_name"];
    move_uploaded_file($temp,"../Assets/Files/UserPhoto/".$photo);

    $resume      = $_FILES["resume"]["name"];
    $resume_temp = $_FILES["resume"]["tmp_name"];
    move_uploaded_file($resume_temp,"../Assets/Files/UserResume/".$resume);

    $insQry = "INSERT INTO tbl_user(user_name,user_gender,user_email,user_contact,user_password,user_address,user_photo,user_resume,user_job_category,user_qualification)
               VALUES('".$name."','".$gender."','".$email."','".$contact."','".$pass."','".$address."','".$photo."','".$resume."','".$jobcategory."','".$qual."')";

    if($con->query($insQry)){
        $uid = mysqli_insert_id($con);

       //skills & languages using Foreign key
        if(!empty($_POST['technical_skills'])){
            foreach($_POST['technical_skills'] as $tid)
                $con->query("INSERT INTO tbl_user_technical_skills(technical_skill_id,user_id) VALUES('".$tid."','".$uid."')");
        }
        if(!empty($_POST['soft_skill'])){
            foreach($_POST['soft_skill'] as $sid)
                $con->query("INSERT INTO tbl_user_soft_skills(soft_skill_id,user_id) VALUES('".$sid."','".$uid."')");
        }
        if(!empty($_POST['language'])){
            foreach($_POST['language'] as $lid)
                $con->query("INSERT INTO tbl_user_languages(languages_id,user_id) VALUES('".$lid."','".$uid."')");
        }
        ?>
        <script>alert("User registered!"); window.location="Login.php";</script>
        <?php
    }else{
        ?><script>alert("Error : <?= $con->error ?>");</script><?php
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>JobEntry | User Registration</title>
<link href="../Assets/Templates/Main/img/JobC_logo.png" rel="icon">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
.jobentry-user-register-body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #000000 0%, #000000 100%);
    margin: 0;
    padding: 0;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.jobentry-user-register-container {
    width: 100%;
    max-width: 1000px;
    margin: 30px auto;
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
}

.jobentry-user-register-header {
    background: linear-gradient(135deg, #0d6efd, #0d6efd);

    color: white;
    padding: 25px 30px;
    text-align: center;
}

.jobentry-user-register-title {
    font-size: 32px;
    font-weight: 700;
    margin: 0 0 10px 0;
    letter-spacing: 0.5px;
}

.jobentry-user-register-subtitle {
    font-size: 16px;
    margin: 0;
    opacity: 0.9;
    font-weight: 300;
}

.jobentry-user-register-form {
    padding: 30px 40px;
}

.jobentry-user-register-row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -15px;
}

.jobentry-user-register-col {
    flex: 1;
    min-width: 300px;
    padding: 0 15px;
    margin-bottom: 20px;
}

.jobentry-user-register-form-group {
    margin-bottom: 20px;
}

.jobentry-user-register-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #333;
    font-size: 14px;
}

.jobentry-user-register-input {
    width: 100%;
    padding: 14px 15px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 15px;
    transition: all 0.3s;
    box-sizing: border-box;
    background-color: #f9f9f9;
}

.jobentry-user-register-input:focus {
    outline: none;
    border-color: #2a5298;
    box-shadow: 0 0 0 2px rgba(42, 82, 152, 0.2);
    background-color: #fff;
}

.jobentry-user-register-select {
    width: 100%;
    padding: 14px 15px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 15px;
    transition: all 0.3s;
    box-sizing: border-box;
    background-color: #f9f9f9;
    appearance: none;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 15px center;
    background-size: 16px;
}

.jobentry-user-register-select:focus {
    outline: none;
    border-color: #2a5298;
    box-shadow: 0 0 0 2px rgba(42, 82, 152, 0.2);
    background-color: #fff;
}

.jobentry-user-register-textarea {
    width: 100%;
    padding: 14px 15px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 15px;
    transition: all 0.3s;
    box-sizing: border-box;
    background-color: #f9f9f9;
    resize: vertical;
    min-height: 100px;
    font-family: inherit;
}

.jobentry-user-register-textarea:focus {
    outline: none;
    border-color: #2a5298;
    box-shadow: 0 0 0 2px rgba(42, 82, 152, 0.2);
    background-color: #fff;
}

.jobentry-user-register-file {
    width: 100%;
    padding: 12px 15px;
    border: 1px dashed #ddd;
    border-radius: 6px;
    font-size: 15px;
    transition: all 0.3s;
    box-sizing: border-box;
    background-color: #f9f9f9;
    cursor: pointer;
}

.jobentry-user-register-file:hover {
    border-color: #2a5298;
    background-color: #f0f5ff;
}

.jobentry-user-register-radio-group {
    display: flex;
    gap: 20px;
    margin-top: 8px;
}

.jobentry-user-register-radio-label {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    font-weight: normal;
}

.jobentry-user-register-checkbox-group {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 10px;
    margin-top: 8px;
    max-height: 200px;
    overflow-y: auto;
    padding: 10px;
    border: 1px solid #eee;
    border-radius: 6px;
    background-color: #f9f9f9;
}

.jobentry-user-register-checkbox-label {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    font-weight: normal;
    padding: 5px;
}

.jobentry-user-register-checkbox-label:hover {
    background-color: #f0f5ff;
    border-radius: 4px;
}

.jobentry-user-register-btn-group {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 30px;
    
}

.jobentry-user-register-btn {
    padding: 14px 40px;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    min-width: 150px;
    
}

.jobentry-user-register-btn-primary {
   background: linear-gradient(to right, #0d6efd, #0d6efd);
    color: white;
    box-shadow: 0 4px 10px rgba(42, 82, 152, 0.2);
}

.jobentry-user-register-btn-primary:hover {
    background: linear-gradient(to right, #2a5298, #1e3c72);
    box-shadow: 0 6px 15px rgba(42, 82, 152, 0.3);
    transform: translateY(-2px);
}

.jobentry-user-register-btn-secondary {
    background-color: #f1f1f1;
    color: #555;
}

.jobentry-user-register-btn-secondary:hover {
    background-color: #e5e5e5;
    transform: translateY(-2px);
}

.jobentry-user-register-footer {
    text-align: center;
    padding: 20px;
    color: #777;
    font-size: 14px;
    background-color: #f9f9f9;
    border-top: 1px solid #eee;
}

.jobentry-user-register-footer a {
    color: #2a5298;
    text-decoration: none;
    font-weight: 500;
}

.jobentry-user-register-footer a:hover {
    text-decoration: underline;
}

.jobentry-user-register-skill-box {
    padding: 15px;
    border: 1px solid #eee;
    border-radius: 6px;
    background-color: #f9f9f9;
    min-height: 50px;
    margin-top: 8px;
}

@media (max-width: 768px) {
    .jobentry-user-register-container {
        margin: 15px;
        width: auto;
    }
    
    .jobentry-user-register-form {
        padding: 20px;
    }
    
    .jobentry-user-register-col {
        min-width: 100%;
    }
    
    .jobentry-user-register-checkbox-group {
        grid-template-columns: 1fr;
    }
    
    .jobentry-user-register-btn-group {
        flex-direction: column;
    }
    
    .jobentry-user-register-btn {
        width: 100%;
    }
}
</style>
<script>
//Ajax to call skills
function loadTechSkills(catId){
    $.get(
        "../Assets/AjaxPages/AjaxTechnicalSkills.php",          
        {job_category_id : catId},
        function(data){
            $("#techBox").html(data);
        }
    );
}
</script>
</head>
<body class="jobentry-user-register-body"><!-- Registration -->
<div class="jobentry-user-register-container">
    <div class="jobentry-user-register-header">
        <h1 class="jobentry-user-register-title">JobC</h1>
        <p class="jobentry-user-register-subtitle">User Registration - Find The Perfect Job</p>
    </div>
    
    <form method="post" enctype="multipart/form-data" class="jobentry-user-register-form">
        <div class="jobentry-user-register-row">
            <div class="jobentry-user-register-col">
                <div class="jobentry-user-register-form-group">
                    <label for="txt_name" class="jobentry-user-register-label">Full Name</label>
                    <input type="text" name="txt_name" id="txt_name" class="jobentry-user-register-input" placeholder="Enter your full name" required>
                </div>
                
                <div class="jobentry-user-register-form-group">
                    <label class="jobentry-user-register-label">Gender</label>
                    <div class="jobentry-user-register-radio-group">
                        <label class="jobentry-user-register-radio-label">
                            <input type="radio" name="radio" value="male" required> Male
                        </label>
                        <label class="jobentry-user-register-radio-label">
                            <input type="radio" name="radio" value="female"> Female
                        </label>
                    </div>
                </div>
                
                <div class="jobentry-user-register-form-group">
                    <label for="txt_email" class="jobentry-user-register-label">Email</label>
                    <input type="email" name="txt_email" id="txt_email" class="jobentry-user-register-input" placeholder="Enter your email" required>
                </div>
                
                <div class="jobentry-user-register-form-group">
                    <label for="txt_contact" class="jobentry-user-register-label">Contact</label>
                    <input type="text" name="txt_contact" id="txt_contact" class="jobentry-user-register-input" placeholder="Enter contact number">
                </div>
            </div>


               
           

            
            <div class="jobentry-user-register-col">
                <div class="jobentry-user-register-form-group">
                    <label for="txt_pass" class="jobentry-user-register-label">Password</label>
                    <input type="password" name="txt_pass" id="txt_pass" class="jobentry-user-register-input" placeholder="Password must be 8 characters long" required minlenght="8">
                </div>
                
                <div class="jobentry-user-register-form-group">
                    <label for="txt_address" class="jobentry-user-register-label">Address</label>
                    <textarea name="txt_address" id="txt_address" class="jobentry-user-register-textarea" placeholder="Enter your address" rows="3"></textarea>
                </div>
                
                <div class="jobentry-user-register-form-group">
                    <label for="photo" class="jobentry-user-register-label">Profile Photo</label>
                    <input type="file" name="photo" id="photo" class="jobentry-user-register-file">
                </div>
                
                <div class="jobentry-user-register-form-group">
                    <label for="resume" class="jobentry-user-register-label">Resume</label>
                    <input type="file" name="resume" id="resume" class="jobentry-user-register-file">
                </div>
            </div>
        </div>

<!-- Languages --> 

         <div class="jobentry-user-register-form-group">
                    <label class="jobentry-user-register-label">Languages Known</label>
                    <div class="jobentry-user-register-checkbox-group">
                        <?php
                        $lang = $con->query("SELECT * FROM tbl_languages ORDER BY language_name");
                        while($l=$lang->fetch_assoc()){
                            echo '<label class="jobentry-user-register-checkbox-label">';
                            echo '<input type="checkbox" name="language[]" value="'.$l['languages_id'].'"> '.$l['language_name'];
                            echo '</label>';
                        }
                        ?>
                    </div>
                </div>



        
        
        <div class="jobentry-user-register-row">
            <div class="jobentry-user-register-col">
                <div class="jobentry-user-register-form-group">
                    <label for="sel_category" class="jobentry-user-register-label">Job Category</label>
                    <select name="sel_category" id="sel_category" class="jobentry-user-register-select" onchange="loadTechSkills(this.value)" required>
                        <option value="">-- Select Job Category --</option>
                        <?php
                        $cat = $con->query("SELECT * FROM tbl_job_category ORDER BY job_category_name");
                        while($c=$cat->fetch_assoc()){
                            echo '<option value="'.$c['job_category_id'].'">'.$c['job_category_name'].'</option>';
                        }
                        ?>
                    </select>
                </div>
                
                <div class="jobentry-user-register-form-group">
                    <label class="jobentry-user-register-label">Technical Skills</label>
                    <div id="techBox" class="jobentry-user-register-skill-box">
                        <i>Choose a job category first to see available technical skills</i>
                    </div>
                </div>
            </div>

            

            
            
            <div class="jobentry-user-register-col">
                <div class="jobentry-user-register-form-group">
                    <label class="jobentry-user-register-label">Soft Skills</label>
                    <div class="jobentry-user-register-checkbox-group">
                        <?php
                        $soft = $con->query("SELECT * FROM tbl_soft_skills ORDER BY soft_skill_name");
                        while($s=$soft->fetch_assoc()){
                            echo '<label class="jobentry-user-register-checkbox-label">';
                            echo '<input type="checkbox" name="soft_skill[]" value="'.$s['soft_skill_id'].'"> '.$s['soft_skill_name'];
                            echo '</label>';
                        }
                        ?>
                    </div>
                </div>

        <!-- qlaification -->
                 <div class="jobentry-user-register-form-group">
                    <label for="txt_email" class="jobentry-user-register-label">Qualification</label>
                    <input type="text" name="qual" id="txt_email" class="jobentry-user-register-input" placeholder="Enter your qualification" required>
                </div>
                
               
            </div>
        </div>
        
        <div class="jobentry-user-register-btn-group">
            <input type="submit" name="btn_submit" class="jobentry-user-register-btn jobentry-user-register-btn-primary" value="Register">
            <input type="reset" class="jobentry-user-register-btn jobentry-user-register-btn-secondary" value="Cancel">
        </div>
    </form>
    
    <div class="jobentry-user-register-footer">
        Already have an account? <a href="Login.php">Login here</a>
    </div>
</div>
</body>
</html>
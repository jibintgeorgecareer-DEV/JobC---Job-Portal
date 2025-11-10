<?php
include("../Assets/Connection/connection.php");
session_start();
include("Head.php");

//current user details
$sel = "SELECT  u.*,
                c.job_category_name,
                n.user_now
        FROM    tbl_user u
        LEFT JOIN tbl_job_category c ON c.job_category_id = u.user_job_category
        LEFT JOIN tbl_user_now     n ON n.user_now_id     = u.user_now_id
        WHERE   u.user_id = '" . $_SESSION['uid'] . "'";
$userRow = $con->query($sel)->fetch_assoc();

//already chosen skills
$techHave = array_column(
    $con->query("SELECT technical_skill_id FROM tbl_user_technical_skills WHERE user_id = '{$userRow['user_id']}'")->fetch_all(MYSQLI_ASSOC),
    'technical_skill_id'
);
$softHave = array_column(
    $con->query("SELECT soft_skill_id FROM tbl_user_soft_skills WHERE user_id = '{$userRow['user_id']}'")->fetch_all(MYSQLI_ASSOC),
    'soft_skill_id'
);
$langHave = array_column(
    $con->query("SELECT languages_id FROM tbl_user_languages WHERE user_id = '{$userRow['user_id']}'")->fetch_all(MYSQLI_ASSOC),
    'languages_id'
);

//tech skills
$allTech = $con->query("SELECT * FROM tbl_technical_skills ORDER BY job_category_id, technical_skill_name");
$skillsByCat = [];
while ($t = $allTech->fetch_assoc()) {
    $skillsByCat[$t['job_category_id']][] = $t;
}

//update user details
if (isset($_POST['btn_save'])) {

    $name  = $_POST['txt_name'];
    $gender = $_POST['sel_gender'];
    $email = $_POST['txt_email'];
    $contact = $_POST['txt_contact'];
    $address = $_POST['txt_address'];
    $qual    = $_POST['txt_qualification'];
    $cat     = $_POST['sel_category'];
    $status  = $_POST['sel_status'];
    $expe=$_POST['txt_experience'];

    //keep old values if not edited
    $photo  = $userRow['user_photo'];
    if (!empty($_FILES['filephoto']['name'])) {
        $photo = $_FILES['filephoto']['name'];
        move_uploaded_file($_FILES['filephoto']['tmp_name'], "../Assets/Files/UserPhoto/" . $photo);
    }
    
    $resume = $userRow['user_resume'];
    if (!empty($_FILES['fileresume']['name'])) {
        $resume = $_FILES['fileresume']['name'];
        move_uploaded_file($_FILES['fileresume']['tmp_name'], "../Assets/Files/UserResume/" . $resume);
    }
//------------Vedio Upload ---------------------------------------->
     
    $introduction_video = $userRow['user_introduction']; // Keep old vedio
    if (!empty($_FILES['filevideo']['name'])) {
        $video_name = $_FILES['filevideo']['name'];
        $video_tmp = $_FILES['filevideo']['tmp_name'];
        $video_size = $_FILES['filevideo']['size'];
        $video_error = $_FILES['filevideo']['error'];
        
        $video_ext = strtolower(pathinfo($video_name, PATHINFO_EXTENSION));
        $allowed_extensions = array('mp4', 'avi', 'mov', 'wmv', 'flv', 'mkv', 'webm');
        //check size < 50 MB
        if (in_array($video_ext, $allowed_extensions)) {
            $max_size = 50 * 1024 * 1024; 
            
            if ($video_size <= $max_size && $video_error === 0) {
                $introduction_video = time() . "_" . $video_name;
                $upload_path = "../Assets/Files/UserIntroduction/" . $introduction_video;
                
                if (!move_uploaded_file($video_tmp, $upload_path)) {
                    echo "<script>alert('Failed to upload video!');</script>";
                    $introduction_video = $userRow['user_introduction'];
                }
            } else {
                echo "<script>alert('Video file is too large! Maximum 50MB allowed.');</script>";
            }
        } else {
            echo "<script>alert('Invalid video format! Allowed: mp4, avi, mov, wmv, flv, mkv, webm');</script>";
        }
    }

    // Update table tbl_user 
    $upd = "UPDATE tbl_user
            SET user_name          = '$name',
                user_gender        = '$gender',
                user_email         = '$email',
                user_contact       = '$contact',
                user_address       = '$address',
                user_qualification = '$qual',
                user_job_category  = '$cat',
                user_now_id        = '$status',
                user_photo         = '$photo',
                user_resume        = '$resume',
                user_introduction  = '$introduction_video',
                user_experience    = '$expe'
            WHERE user_id = '{$userRow['user_id']}'";
            
    if ($con->query($upd)) {

        //delete old skills & insert new 
        $con->query("DELETE FROM tbl_user_technical_skills WHERE user_id = '{$userRow['user_id']}'");
        if (!empty($_POST['technical_skills'])) {
            foreach ($_POST['technical_skills'] as $tid)
                $con->query("INSERT INTO tbl_user_technical_skills(technical_skill_id,user_id) VALUES('$tid','{$userRow['user_id']}')");
        }

        $con->query("DELETE FROM tbl_user_soft_skills WHERE user_id = '{$userRow['user_id']}'");
        if (!empty($_POST['soft_skill'])) {
            foreach ($_POST['soft_skill'] as $sid)
                $con->query("INSERT INTO tbl_user_soft_skills(soft_skill_id,user_id) VALUES('$sid','{$userRow['user_id']}')");
        }

        $con->query("DELETE FROM tbl_user_languages WHERE user_id = '{$userRow['user_id']}'");
        if (!empty($_POST['language'])) {
            foreach ($_POST['language'] as $lid)
                $con->query("INSERT INTO tbl_user_languages(languages_id,user_id) VALUES('$lid','{$userRow['user_id']}')");
        }

        echo "<script>alert('Profile updated successfully!'); window.location='MyProfile.php';</script>";
        exit;
    } else {
        echo "<script>alert('Failed to update profile: " . $con->error . "');</script>";
    }
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<title>JobC – Edit User Profile</title>
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
<!-- some extra styles -->
<style>
  .skill-box {
    border: 1px solid #ced4da;
    border-radius: .375rem;
    padding: 10px 15px;
    max-height: 180px;
    overflow-y: auto;
    background: #f9f9f9;
}
.skill-box label {
    display: block;
    margin-bottom: 6px;
    cursor: pointer;
}
.job-post-body .form-group label i.fas {
    color: #0d6efd;
}
</style>


<script>
/* ----  JS tech skills  ---- */
var skillsByCat = <?= json_encode($skillsByCat) ?>;
var userTechHave = <?= json_encode($techHave) ?>;

/* ----  load tech skills  ---- */
function loadTechSkills(catId){
    var html = '';
    if(catId && skillsByCat[catId]){
        skillsByCat[catId].forEach(function(s){
            var checked = userTechHave.includes(parseInt(s.technical_skill_id)) ? 'checked' : '';
            html += '<label><input type="checkbox" name="technical_skills[]" value="'+s.technical_skill_id+'" '+checked+'> '+s.technical_skill_name+'</label>';
        });
    }
    $("#techBox").html(html);
}

$(document).ready(function(){
    loadTechSkills($('[name="sel_category"]').val());
});
</script>
</head>

<body>
<div class="container-xxl bg-white p-0">
    <div class="job-post-container">
        <div class="job-post-card">
            <div class="job-post-header">
                <h2><i class="fas fa-user-edit"></i><font color="white">&nbspEdit User Profile</font></h2>
                <p>Update your personal information & skills</p>
            </div>

            <form method="post" enctype="multipart/form-data">
                <div class="job-post-body">

                   <!-- fields -->
                    <div class="form-group">
                        <label><i class="fas fa-user"></i> Full Name</label>
                        <input type="text" name="txt_name" class="form-control" value="<?= htmlspecialchars($userRow['user_name']) ?>" >
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-venus-mars"></i> Gender</label>
                        <select name="sel_gender" class="form-control" required>
                            <option value="">-- Select --</option>
                            <option value="male" <?= $userRow['user_gender'] == 'male' ? 'selected' : '' ?>>Male</option>
                            <option value="female" <?= $userRow['user_gender'] == 'female' ? 'selected' : '' ?>>Female</option>
                            <option value="other" <?= $userRow['user_gender'] == 'other' ? 'selected' : '' ?>>Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" name="txt_email" class="form-control" value="<?= htmlspecialchars($userRow['user_email']) ?>" >
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-phone"></i> Contact</label>
                        <input type="text" name="txt_contact" class="form-control" value="<?= htmlspecialchars($userRow['user_contact']) ?>" pattern="\d{10}" maxlength="10" title="Enter a 10-digit phone number" >
                    </div>
<!-- address -->
                    <div class="form-group">
                        <label><i class="fas fa-map-marker-alt"></i> Address</label>
                        <textarea name="txt_address" class="form-control" rows="3" required><?= htmlspecialchars($userRow['user_address']) ?></textarea>
                    </div>

            <!--Work experience -->
             <div class="form-group">
                        <label><i class="fas fa-business-time text-primary me-2"></i> Experience</label>
                        <textarea name="txt_experience" class="form-control" rows="3" ><?= htmlspecialchars($userRow['user_experience']) ?></textarea>
                    </div>


                    <div class="form-group">
                        <label><i class="fas fa-graduation-cap"></i> Qualification</label>
                        <input type="text" name="txt_qualification" class="form-control" value="<?= htmlspecialchars($userRow['user_qualification']) ?>">
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-briefcase"></i> Job Category</label>
                        <select name="sel_category" class="form-control" onchange="loadTechSkills(this.value)" >
                            <option value="">-- Select --</option>
                            <?php
                            $catList = $con->query("SELECT * FROM tbl_job_category ORDER BY job_category_name");
                            while ($c = $catList->fetch_assoc()) {
                                $selected = ($c['job_category_id'] == $userRow['user_job_category']) ? 'selected' : '';
                                echo '<option value="'.$c['job_category_id'].'" '.$selected.'>'.$c['job_category_name'].'</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-user-check"></i> Current Status</label>
                        <select name="sel_status" class="form-control" >
                            <option value="">-- Select --</option>
                            <?php
                            $statList = $con->query("SELECT * FROM tbl_user_now");
                            while ($s = $statList->fetch_assoc()) {
                                $selected = ($s['user_now_id'] == $userRow['user_now_id']) ? 'selected' : '';
                                echo '<option value="'.$s['user_now_id'].'" '.$selected.'>'.$s['user_now'].'</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <!-- skills -->
                    <div class="form-group">
                        <label><i class="fas fa-tools"></i> Technical Skills</label>
                        <div id="techBox" class="skill-box">
                           
                        </div>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-comments"></i> Soft Skills</label>
                        <div class="skill-box">
                            <?php
                            $softQ = $con->query("SELECT * FROM tbl_soft_skills ORDER BY soft_skill_name");
                            while ($s = $softQ->fetch_assoc()) {
                                $checked = in_array($s['soft_skill_id'], $softHave) ? 'checked' : '';
                                echo '<label><input type="checkbox" name="soft_skill[]" value="'.$s['soft_skill_id'].'" '.$checked.'> '.$s['soft_skill_name'].'</label>';
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-language"></i> Languages</label>
                        <div class="skill-box">
                            <?php
                            $langQ = $con->query("SELECT * FROM tbl_languages ORDER BY language_name");
                            while ($l = $langQ->fetch_assoc()) {
                                $checked = in_array($l['languages_id'], $langHave) ? 'checked' : '';
                                echo '<label><input type="checkbox" name="language[]" value="'.$l['languages_id'].'" '.$checked.'> '.$l['language_name'].'</label>';
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Introduction vedio -->
                     

                    <div class="form-group">
                        <label><i class="fas fa-video"></i> Introduction Vedio(Max 50MB):</label>
                        <input type="file" name="filevideo" class="form-control" accept="video/*">
                        <?php if (!empty($userRow['user_introduction'])) echo '<small class="text-muted">Current: '.$userRow['user_introduction'].'</small>'; ?>
                       
                    </div>


                    <!-- profile pic & resume -->
                    <div class="form-group">
                        <label><i class="fas fa-image"></i> Profile Photo</label>
                        <input type="file" name="filephoto" class="form-control">
                        <?php if (!empty($userRow['user_photo'])) echo '<small class="text-muted">Current: '.$userRow['user_photo'].'</small>'; ?>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-file-alt"></i> Resume</label>
                        <input type="file" name="fileresume" class="form-control">
                        <?php if (!empty($userRow['user_resume'])) echo '<small class="text-muted">Current: '.$userRow['user_resume'].'</small>'; ?>
                    </div>

                </div>

                <div class="form-actions">
                    <button type="submit" name="btn_save" class="btn-submit">
                        <i class="fas fa-save"></i> Update Profile
                    </button>
                    <button type="reset" class="btn-reset">
                        <i class="fas fa-redo"></i> Reset
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include('Foot.php'); ?>
</body>
</html>
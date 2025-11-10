<?php
include("../Assets/Connection/connection.php");
session_start();
include("Head.php");

//current company data
$selprofile = "SELECT * FROM tbl_company WHERE company_id='" . $_SESSION['cid'] . "'";
$row = $con->query($selprofile);
$data = $row->fetch_assoc();

if(isset($_POST['btn_save']))
{
    $name = $_POST['txt_name'];
    $contact = $_POST['txt_contact'];
    $address = $_POST['txt_address'];
    $email = $_POST['txt_email'];
    $place = $_POST['sel_place'];
    $industry = $_POST['industry'];
    $type = $_POST['type'];
    $date = $_POST['txt_date'];

    //existing logo saved
    $logo = $data['company_logo'];
    if (!empty($_FILES["filelogo"]["name"])) {
        $logo = $_FILES["filelogo"]["name"];
        $temp = $_FILES["filelogo"]["tmp_name"];
        move_uploaded_file($temp, "../Assets/Files/CompanyDocs/" . $logo);
    }
    
    //existing proof saved
    $proof = $data['company_proof'];
    if (!empty($_FILES["fileproof"]["name"])) {
        $proof = $_FILES["fileproof"]["name"];
        $resume_temp = $_FILES["fileproof"]["tmp_name"];
        move_uploaded_file($resume_temp, "../Assets/Files/CompanyProof/" . $proof);
    }

    // existing vedio saved  
    $introduction_video = $data['company_introduction'];
    if (!empty($_FILES['filevideo']['name'])) {
        $video_name = $_FILES['filevideo']['name'];
        $video_tmp = $_FILES['filevideo']['tmp_name'];
        $video_size = $_FILES['filevideo']['size'];
        $video_error = $_FILES['filevideo']['error'];
        
        $video_ext = strtolower(pathinfo($video_name, PATHINFO_EXTENSION));
        $allowed_extensions = array('mp4', 'avi', 'mov', 'wmv', 'flv', 'mkv', 'webm');
        
        if (in_array($video_ext, $allowed_extensions)) {
            $max_size = 50 * 1024 * 1024; 
            
            if ($video_size <= $max_size && $video_error === 0) {
                $introduction_video = time() . "_" . $video_name;
                $upload_path = "../Assets/Files/CompanyIntroduction/" . $introduction_video;
                
                if (!move_uploaded_file($video_tmp, $upload_path)) {
                    echo "<script>alert('Failed to upload video!');</script>";
                    $introduction_video = $data['company_introduction'];
                }
            } else {
                echo "<script>alert('Video file is too large! Maximum 50MB allowed.');</script>";
            }
        } else {
            echo "<script>alert('Invalid video format! Allowed: mp4, avi, mov, wmv, flv, mkv, webm');</script>";
        }
    }

    // Update profile
    $update = "UPDATE tbl_company SET 
        company_name = '" . $name . "',
        company_email = '" . $email . "',
        company_contact = '" . $contact . "',
        company_address = '" . $address . "',
        place_id = '" . $place . "',
        company_date_join = '" . $date . "',
        company_industry = '" . $industry . "',
        company_type = '" . $type . "',
        company_logo = '" . $logo . "',
        company_proof = '" . $proof . "',
        company_introduction = '" . $introduction_video . "'
        WHERE company_id = '" . $_SESSION['cid'] . "'";
             
    if($con->query($update))
    {
?>
        <script>
        alert("Company Profile Updated");
        window.location="CompanyProfile.php";
        </script>
<?php
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<title>JobC - Edit Profile</title>
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

<script src="../Assets/Templates/Main/JQ/jQuery.js"></script>
</head>

<body>
    <div class="container-xxl bg-white p-0">
      

        <!-- Edit Profile Section -->
        <div class="job-post-container">
            <div class="job-post-card">
                <div class="job-post-header">
                 <h2>  <i class="fas fa-edit"></i><font color="white"> Edit Company Profile</font></h2>
                    <p>Update your company information</p>
                </div>

                <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
                    <div class="job-post-body">

                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-building"></i> Company Name</label>
                            <input type="text" name="txt_name" id="txt_name" class="form-control" placeholder="Enter company name" value="<?php echo $data['company_name']; ?>" required />
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" name="txt_email" id="txt_email" class="form-control" placeholder="Enter email address" value="<?php echo $data['company_email']; ?>" required />
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-phone"></i> Contact</label>
                            <input type="text" name="txt_contact" id="txt_contact" class="form-control" placeholder="Enter contact number" value="<?php echo $data['company_contact']; ?>" required />
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-map-marker-alt"></i> Address</label>
                            <textarea name="txt_address" id="txt_address" class="form-control" rows="4" placeholder="Enter company address" required><?php echo $data['company_address']; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-calendar"></i> Date Joined</label>
                            <input type="date" name="txt_date" id="txt_date" class="form-control" value="<?php echo $data['company_date_join']; ?>" required />
                        </div>


 <!-- Introduction vedio -->
                     

                    <div class="form-group">
                        <label><i class="fas fa-video"></i> Introduction Vedio(Max 50MB):</label>
                        <input type="file" name="filevideo" class="form-control" accept="video/*">
                        <?php if (!empty($data['company_introduction'])) echo '<small class="text-muted">Current: '.$data['company_introduction'].'</small>'; ?>
                       
                    </div>



                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-image"></i> Company Logo</label>
                            <input type="file" name="filelogo" id="filelogo" class="form-control"  />
                            <?php if(!empty($data['company_logo'])){ ?>
                                <small class="text-muted">Current: <?php echo $data['company_logo']; ?></small>
                            <?php } ?>
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-file-alt"></i> License Proof</label>
                            <input type="file" name="fileproof" id="fileproof" class="form-control" />
                            <?php if(!empty($data['company_proof'])){ ?>
                                <small class="text-muted">Current: <?php echo $data['company_proof']; ?></small>
                            <?php } ?>
                        </div>
<!-- dropdown industry-->
                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-industry"></i> Industry</label>
                            <select name="industry" id="industry" class="form-control" required>
                                <option value="">Select Industry</option>
                                <?php
                                $sql = "SELECT * FROM tbl_company_industry";
                                $result = $con->query($sql);
                                while($row = $result->fetch_assoc()) {
                                    $selected = ($row["industry_id"] == $data['company_industry']) ? 'selected' : '';
                                ?>
                                    <option value="<?php echo $row["industry_id"]; ?>" <?php echo $selected; ?>><?php echo $row["industry_name"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
<!-- dropdown Type-->
                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-briefcase"></i> Company Type</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="">Select Type</option>
                                <?php
                                $sql = "SELECT * FROM tbl_company_type";
                                $result = $con->query($sql);
                                while($row = $result->fetch_assoc()) {
                                    $selected = ($row["company_type_id"] == $data['company_type']) ? 'selected' : '';
                                ?>
                                    <option value="<?php echo $row["company_type_id"]; ?>" <?php echo $selected; ?>><?php echo $row["company_type_name"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
<!-- dropdown Address-->
                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-map"></i> State</label>
                            <select name="state" id="state" class="form-control" onChange="getDistrict(this.value)" >
                                <option value="">-- Select State --</option>
                                <?php
                                $sql = "SELECT * FROM tbl_state";
                                $result = $con->query($sql);
                                while($row = $result->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $row["state_id"]; ?>"><?php echo $row["state_name"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-map-signs"></i> District</label>
                            <select name="sel_district" id="sel_district" class="form-control" onChange="getPlace(this.value)" >
                                <option value="">-- Select District --</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-map-pin"></i> Place</label>
                            <select name="sel_place" id="sel_place" class="form-control" >
                                <option value="">-- Select Place --</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" name="btn_save" id="btn_save" class="btn-submit">
                            <i class="fas fa-save"></i> Update Profile
                        </button>
                        <button type="reset" name="btn_clear" id="btn_clear" class="btn-reset">
                            <i class="fas fa-redo"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function getDistrict(sid) {
            $.ajax({
                url:"../Assets/AjaxPages/AjaxDistrict.php?sid="+sid,
                success: function(html){
                    $("#sel_district").html(html);
                }
            });
        }

        function getPlace(did) {
            $.ajax({
                url:"../Assets/AjaxPages/AjaxPlace.php?did="+did,
                success: function(html){
                    $("#sel_place").html(html);
                }
            });
        }
    </script>
</body>
</html>
<?php include("Foot.php") ?>
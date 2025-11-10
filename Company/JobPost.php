<?php
include("../Assets/Connection/connection.php");
session_start();
include("Head.php");
//Upload Job post page for company
if(isset($_POST["btn_submit"])) {
    $title = $_POST["txt_title"];
    $content = $_POST["txt_content"];
    $date = $_POST["txt_date"];
    $experience = $_POST['txt_experience'];
    $location = $_POST['txt_location'];
    $vacancy = $_POST['txt_vacancy'];
    $deadline = $_POST['txt_deadline'];
    $company_id = $_SESSION['cid'];
    $job_type_id = $_POST['job_type'];
    $job_category_id = $_POST['job_category'];
    $additional_skill=$_POST['additional_skill'];
    $qualification=$_POST['qualification'];
    $salary=$_POST['salary'];

    $post = $_FILES["post"]["name"];
    $temp = $_FILES["post"]["tmp_name"];
    move_uploaded_file($temp,"../Assets/Files/JobPost/".$post);

    $stmt = $con->prepare("INSERT INTO tbl_job_poster (
        job_post_title, job_post_content, job_post_date,
        job_post_vacancy, job_post_experience,
        job_post_location, job_post_deadline,
        company_id, job_type_id, job_category_id, job_post_photo,additional_skill,job_post_qualification,job_post_salary
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,? ,?)");

    $stmt->bind_param("sssisssiiissss", 
        $title, $content, $date, $vacancy, $experience,
        $location, $deadline, $company_id, $job_type_id, $job_category_id, $post, $additional_skill , $qualification,$salary
    );

    if ($stmt->execute()) {
        $job_post_id = $stmt->insert_id;
//Tech skills,soft skills, Foreign key
        if(isset($_POST['technical_skills'])) {
            foreach($_POST['technical_skills'] as $tech_id) {
                $con->query("INSERT INTO tbl_job_technical_skills (technical_skill_id, job_post_id) VALUES ('$tech_id', '$job_post_id')");
            }
        }

        if(isset($_POST['soft_skills'])) {
            foreach($_POST['soft_skills'] as $soft_id) {
                $con->query("INSERT INTO tbl_job_soft_skills (soft_skill_id, job_post_id) VALUES ('$soft_id', '$job_post_id')");
            }
        }

        echo "<script>alert('Job Post Added Successfully'); window.location='JobPost.php';</script>";
    } else {
        echo "<script>alert('Error inserting job');</script>";
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<title>JobC - Post a Job</title>
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

<script src="../Assets/JQ/jQuery.js"></script>

<style>
  
</style>
</head>

<body>
    <div class="container-xxl bg-white p-0">
       

        <!-- Job Post Form -->
        <div class="job-post-container">
            <div class="job-post-card">
                <div class="job-post-header">
                    <h2><i class="fas fa-briefcase"></i><font color="white"> Create New Job Post</font></h2>
                    <p>Fill in the details below to post a new job opportunity</p>
                </div>

                <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
                    <div class="job-post-body">
                        
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-heading"></i> Job Title
                            </label>
                            <input type="text" name="txt_title" id="txt_title" class="form-control" placeholder="e.g., Senior Software Engineer" required />
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">
                                        <!-- Job type dropdown-->
                                        <i class="fas fa-briefcase"></i> Job Type
                                    </label>
                                    <select name="job_type" id="job_type" class="form-select" required>
                                        <option value="">-- Select Job Type --</option>
                                        <?php
                                        $sql = "SELECT * FROM tbl_job_type";
                                        $result = $con->query($sql);
                                        while($row = $result->fetch_assoc()) {
                                            echo "<option value='{$row['job_type_id']}'>{$row['job_type_name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">
                                         <!-- Job category dropdown-->
                                        <i class="fas fa-layer-group"></i> Job Category
                                    </label>
                                    <select name="job_category" id="job_category" class="form-select" required>
                                        <option value="">-- Select Job Category --</option>
                                        <?php
                                        $sql = "SELECT * FROM tbl_job_category";
                                        $result = $con->query($sql);
                                        while($row = $result->fetch_assoc()) {
                                            echo "<option value='{$row['job_category_id']}'>{$row['job_category_name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-star"></i> Experience Required
                                    </label>
                                    <input type="text" name="txt_experience" id="txt_experience" class="form-control" placeholder="e.g., 2-5 years" />
                                </div>
                            </div>

                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-star"></i> Qualification
                                    </label>
                                    <input type="text" name="qualification" id="qualification" class="form-control" placeholder="e.g., Degree or Education" />
                                </div>
                                    </div>

 <!-- Loc -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-map-marker-alt"></i> Location
                                    </label>
                                    <input type="text" name="txt_location" id="txt_location" class="form-control" placeholder="e.g., New York, NY" />
                                </div>
                            </div>
                        </div>

                         <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="far fa-money-bill-alt text-primary me-2"></i> Salary
                                    </label>
                                    <input type="text" name="salary" id="salary" class="form-control" placeholder="e.g., 12 LPA" />
                                </div>
                            </div>
                        </div>

                       

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-align-left"></i> Job Description
                            </label>
                            <textarea name="txt_content" id="txt_content" class="form-control" placeholder="Enter detailed job description..." required></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-users"></i> Number of Vacancies
                                    </label>
                                    <input type="number" name="txt_vacancy" id="txt_vacancy" class="form-control" min="1" value="1" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-calendar-plus"></i> Post Date
                                    </label>
                                    <input type="date" name="txt_date" id="txt_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-calendar-times"></i> Application Deadline
                                    </label>
                                    <input type="date" name="txt_deadline" id="txt_deadline" class="form-control" min="<?php echo date('Y-m-d'); ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-code"></i> Technical Skills
                            </label>
                            <div class="skills-container" id="techskills">
                                <div class="ajax-message">Select category to load related technical skills...</div>
                            </div>
                        </div>
 <!-- Job soft skills dropdown -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-lightbulb"></i> Soft Skills
                            </label>
                            <div class="skills-container">
                                <?php
                                $softSkillQuery = "SELECT * FROM tbl_soft_skills";
                                $softSkillRes = $con->query($softSkillQuery);
                                while ($soft = $softSkillRes->fetch_assoc()) {
                                    echo "<div class='skill-checkbox'>";
                                    echo "<input type='checkbox' name='soft_skills[]' id='soft_{$soft['soft_skill_id']}' value='{$soft['soft_skill_id']}'>";
                                    echo "<label for='soft_{$soft['soft_skill_id']}'>{$soft['soft_skill_name']}</label>";
                                    echo "</div>";
                                }
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-plus-circle"></i> Additional Skills
                            </label>
                            <input type="text" name="additional_skill" id="additional_skill" class="form-control" placeholder="Enter any additional skills required" />
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-file-upload"></i> Job Document
                            </label>
                            <div class="file-input-wrapper">
                                <label for="post" class="file-input-label">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span id="file-name">Choose file or drag here</span>
                                </label>
                                <input type="file" name="post" id="post" />
                            </div>
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" name="btn_submit" id="btn_submit" class="btn-submit">
                            <i class="fas fa-paper-plane"></i> Post
                        </button>
                        <button type="reset" name="btn_clear" id="btn_clear" class="btn-reset">
                            <i class="fas fa-redo"></i> Clear Form
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        //Load Technical Skills when job category changes
        $("#job_category").on("change", function() {
            var category_id = $(this).val();
            if (category_id !== "") {
                $.ajax({
                    url: "../Assets/AjaxPages/AjaxTechnicalSkills.php?job_category_id=" + category_id,
                    success: function(response) {
                        $("#techskills").html(response);
                    }
                });
            } else {
                $("#techskills").html("<div class='ajax-message'>Select category to load related technical skills...</div>");
            }
        });

        //File input
        $("#post").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            if (fileName) {
                $("#file-name").text(fileName);
            } else {
                $("#file-name").text("Choose file or drag here");
            }
        });
    </script>
</body>
</html>

<?php include("Foot.php"); ?>
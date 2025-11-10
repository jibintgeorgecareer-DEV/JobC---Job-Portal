<?php
include("../Assets/Connection/connection.php");
// To add technical skill
if(isset($_POST["btn_submit"])) {
    $name = $_POST["txt_name"];
    $job_category_id = $_POST["sel_category"];

    $insqry = "INSERT INTO tbl_technical_skills (technical_skill_name, job_category_id) 
               VALUES ('".$name."', '".$job_category_id."')";

    if($con->query($insqry)) {
        ?>
        <script>
            alert("Skill Inserted Successfully");
            window.location="TechnicalSkill.php";
        </script>
        <?php
    }
}

// Delete technical skill
if(isset($_GET["clrID"])) {
    $quer = "DELETE FROM tbl_technical_skills WHERE technical_skill_id='".$_GET["clrID"]."'";
    if($con->query($quer)) {
        ?>
        <script>
            alert("Skill Deleted");
            window.location="TechnicalSkill.php";
        </script>
        <?php
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Technical Skill - JobC</title>
<link href="../Assets/Templates/Main/img/JobC_logo.png" rel="icon">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.0.96/css/materialdesignicons.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="../Assets/Templates/Admin/Admin-Template/Styles/Dashboard.css">
<link rel="stylesheet" href="../Assets/Templates/Admin/Admin-Template/Styles/ButtonImage.css">
<link rel="stylesheet" href="../Assets/Templates/Admin/Admin-Template/Styles/FormsTextbox.css">
</head>

<body>
<p>
  <a href="AdminHome.php" class="link-with-icon">
    <i class="fas fa-home"></i> Dashboard
  </a>  
</p>

<center>
<form id="form1" name="form1" method="post" action="">
  <div class="form-container">
    <div class="form-header">
      <i class="fas fa-edit"></i> Add Technical Skills
    </div>

    <div class="form-body">
      <!--Skill Name -->
      <div class="form-group">
        <label for="txt_name2" class="form-label">Skill Name</label>
        <input type="text" name="txt_name" id="txt_name2" class="form-control" placeholder="Skill Name" required />
      </div>

      <!--Job Category -->
      <div class="form-group">
        <label for="sel_category" class="form-label">Job Category</label>
        <select name="sel_category" id="sel_category" class="form-control" required>
          <option value="">-- Select Job Category --</option>
          <?php
          $catQry = "SELECT * FROM tbl_job_category";
          $catRes = $con->query($catQry);
          while($cat = $catRes->fetch_assoc()) {
              echo "<option value='{$cat['job_category_id']}'>{$cat['job_category_name']}</option>";
          }
          ?>
        </select>
      </div>

      <!--Buttons -->
      <div class="form-actions">
        <button type="submit" name="btn_submit" id="btn_submit" class="btn-primary">
          <i class="fas fa-check"></i> Submit
        </button>
        <button type="reset" name="txt_cancel" id="txt_cancel" class="btn-secondary">
          <i class="fas fa-times"></i> Cancel
        </button>
      </div>
    </div>
  </div>

  <!--Skill List  -->
  <div class="table-container mt-4">
    <div class="table-header">
      <i class="mdi mdi-check-circle-outline"></i> Technical Skills List
    </div>

    <div class="table-responsive">
      <table border="0" height="150" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Skill Name</th>
            <th>Job Category</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $i = 0;
        $selqry = "SELECT s.*, c.job_category_name 
                   FROM tbl_technical_skills s 
                   INNER JOIN tbl_job_category c 
                   ON s.job_category_id = c.job_category_id";
        $rows = $con->query($selqry);
        while($data = $rows->fetch_assoc()) {
            $i++;
            ?>
            <tr>
              <td><?php echo $i ?></td>
              <td><?php echo $data['technical_skill_name'] ?></td>
              <td><?php echo $data['job_category_name'] ?></td>
              <td>
                <a href="TechnicalSkill.php?clrID=<?php echo $data['technical_skill_id']?>" class="btn btn-danger btn-sm">
                  <i class="fas fa-trash-alt"></i> Delete
                </a>
              </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>
</form>
</center>
</body>
</html>

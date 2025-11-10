<?php
include("../Assets/Connection/connection.php");
include("SessionValidation.php");
//profile

 $admin_photo = "";
    $admin_name = "";
    $admin_id_display = "";
    
    if(isset($_SESSION['aid'])) {
        $admin_id = $_SESSION['aid'];
        $query = "SELECT admin_photo FROM tbl_admin WHERE admin_id = '$admin_id'";
        $result = mysqli_query($con, $query);
     
        
        if($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $admin_photo = $row['admin_photo'];
        }
        
        if(isset($_SESSION['aname'])) 
            {
            $admin_name = $_SESSION['aname'];
            }
        $admin_id_display = $_SESSION['aid'];
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Job Type-JobC</title>
<link href="../Assets/Templates/Main/img/JobC_logo.png" rel="icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.0.96/css/materialdesignicons.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../Assets/Templates/Admin/Admin-Template/Styles/Dashboard.css">
    <link rel="stylesheet" href="../Assets/Templates/Admin/Admin-Template/Styles/ButtonImage.css">
	  <link rel="stylesheet" href="../Assets/Templates/Admin/Admin-Template/Styles/FormsTextbox.css">
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
      <i class="fas fa-edit"></i>Profile
    </div>
    <div class="form-body">
      <div class="form-group">
        <div class="admin-profile">
        <img src="../Assets/Files/AdminPhoto/<?php echo !empty($admin_photo) ? $admin_photo : 'default-avatar.png'; ?>" alt="Admin Profile">
            <h3><?php echo !empty($admin_name) ? $admin_name : 'Admin User'; ?></h3>
            <font color="black">ID: <?php echo !empty($admin_id_display) ? $admin_id_display : 'N/A'; ?></font>
                </div>
       <button type="button" class="btn btn-primary text-white" onclick="window.location.href='../Guest/LogOut.php'">
    LogOut
</button>
      </div>
    </div>
</div>
 </div>
 </div>
</form>
</center>
</body>
</html>

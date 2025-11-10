<?php
include("../Assets/Connection/connection.php");
if(isset($_POST["btn_submit"]))
{
	$name=$_POST["txt_name"];
	$email=$_POST["txt_email"];
	$pass=$_POST["txt_pass"];
	
	$photo = $_FILES["photo"]["name"];
    $temp = $_FILES["photo"]["tmp_name"];
    move_uploaded_file($temp,"../Assets/Files/AdminPhoto/".$photo);
//values to tbl_admin
	
$insqry="INSERT INTO tbl_admin(admin_name,admin_email,admin_password,admin_photo) values('".$name."','".$email."','".$pass."','".$photo."')";

	if($con->query($insqry))
	{
		?>
        <script>
						alert("INSERTED");
						window.location="AdminRegistration.php";
		</script>
<?php
	}
}



if(isset($_GET["delID"]))
{

$delQry="delete from tbl_admin where admin_id='".$_GET["delID"]."'";

	if($con->query($delQry))
	{
		?>
        <script>
						alert("Deleted");
						window.location="AdminRegistration.php";
		</script>
<?php
	}
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Registration-JobC</title>
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
  <!--Registration  -->
  <p> <a href="AdminHome.php" class="link-with-icon">
        <i class="fas fa-home"></i>
        Dashboard
        </a>  
</p>
<p> <a href="AdminList.php" class="link-with-icon">
        <i class="fas fa-tachometer-alt"></i>
        Admin List
        </a>  
<center>
  <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data" >
  <div class="form-container">
    <div class="form-header">
      <i class="fas fa-edit"></i>Admin Registration
    </div>
    <div class="form-body">
      <div class="form-group">
        <label align="left" for="txt_name2" class="form-label">Name</label>
      <input type="text" name="txt_name" id="txt_name2" class="form-control" placeholder="" required  /></td>
</div>
 
      <div class="form-group">
      <label align="left" for="txt_name2" class="form-label">Email</label>
      <input type="email" name="txt_email" id="txt_name2" class="form-control" placeholder="" required /></td>
</div>


   <div class="form-group">
   <label align="left" for="txt_name2" class="form-label">Password</label>
   <input type="password" name="txt_pass" id="txt_name2"  class="form-control" placeholder="" required /></td>
</div>  
      
    <div class="form-group">
   <label align="left" for="txt_name2" class="form-label">Profile</label>
    <input type="file" name="photo" id="txt_name2" class="form-control"/> 
</div>
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

<!--Admins -->

<div class="table-container">
<div class="table-header">
                   
<i class="mdi mdi-check-circle-outline"></i>Admin List
</div>
  <div class="table-responsive">
<table border="1" height="150" class="table">
   <tr>
         <td>SI NO</td>
         <td>Name</td>
         <td>Email</td>
         <td>Password</td>
         <td>Action</td> 
   </tr>
   <?php
   $i=0;
   $selqry="select * from tbl_admin";
   $rows=$con->query($selqry);
   while($data=$rows->fetch_assoc())
   {
	    $i++;
	?>
   
	<tr>
	    <td><?php echo $i ?></td>	  
        <td><?php echo $data['admin_name'] ?></td>	 
        <td><?php echo $data['admin_email'] ?></td>
        <td><?php echo $data['admin_password'] ?></td>	
        <td><a href="AdminRegistration.php? delID=<?php echo $data['admin_id']?>">Delete</a></td>
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
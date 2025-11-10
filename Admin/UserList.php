<?php
include("../Assets/Connection/connection.php");
//All users
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CompanyList - JobC</title>
    <link href="../Assets/Templates/Main/img/JobC_logo.png" rel="icon">
    <!-- Material Design Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.0.96/css/materialdesignicons.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../Assets/Templates/Admin/Admin-Template/Styles/Dashboard.css">
    <link rel="stylesheet" href="../Assets/Templates/Admin/Admin-Template/Styles/ButtonImage.css">
	<link rel="stylesheet" href="../Assets/Templates/Admin/Admin-Template/Styles/FormsTextbox.css">

</head>
<body>
<?php
 if(isset($_GET["acuid"])) { //ststus = 1 (Verified user)
        $quer = "UPDATE tbl_user SET user_status='1' WHERE user_id ='".$_GET["acuid"]."'";
        if($con->query($quer)) {
            echo "<script>
            alert('User Verified!'); 
            window.location='UserList.php';
                   </script>";
        }
    }

    if(isset($_GET["rejuid"])) {//ststus =  (Banned user)
        $quer = "UPDATE tbl_user SET user_status='2' WHERE user_id ='".$_GET["rejuid"]."'";
        if($con->query($quer)) {
            echo "<script>
            alert('User Banned!'); 
            window.location='UserList.php';
            </script>";
        }
    }

     if(isset($_GET["deid"])) {//ststus = 1 (Deleted user)
        $quer = "DELETE FROM tbl_user WHERE user_id ='".$_GET["deid"]."'";
        if($con->query($quer)) {
            echo "<script>
            alert('User Deleted From Databse!'); 
            window.location='UserList.php';
            </script>";
        }
    }
?>


<!-- Verified Users ------->
<br>
    <p> <a href="AdminHome.php" class="link-with-icon">
        <i class="fas fa-home"></i>
        Dashboard
        </a> <h2 align="center">USER VERIFICATIONS</h2>
       </p>
 
        <br><br>
            <div class="table-container">
                <div class="table-header">
                   
                    <i class="mdi mdi-check-circle-outline"></i> Verified Users
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
    <tr>
        <td>SINO</td>
         <td>Name</td>
         <td>Email</td>
         <td>Contact</td>
         <td>Address</td>
      	 <td>Gender</td>
         <td>Profile</td>
         <td>Action</td>
    </tr>
    </thead>
    <tbody>
    <?php
    $i=0;
    $selqry="select * from tbl_user where user_status='1'";
    $rows=$con->query($selqry);
     if($rows->num_rows > 0) {
    while($data=$rows->fetch_assoc())
    {
	    $i++;
	?>
   
	<tr>
	    <td><?php echo $i ?></td>	  
        <td><?php echo $data['user_name'] ?></td>
        <td><?php echo $data['user_email'] ?></td>	
        <td><?php echo $data['user_contact'] ?></td>
        <td><?php echo $data['user_address'] ?></td>
        <td><?php echo $data['user_gender'] ?></td>

    <td><img src="../Assets/Files/UserPhoto//<?php echo $data['user_photo'] ?>" width="75" height="75" /></td>             
        <td>
        
       <a href="?rejuid=<?php echo $data['user_id']; ?>" class="action-btn btn-reject" 
                onclick="return confirm('Ban User?')">Ban</a>
        
        </td>
</tr>
   <?php 
   }}
        else
        {
        echo '<tr><td colspan="10" class="text-center">No Users</td></tr>';
        }
        ?>
</tbody>
</table>
</div>
</div>
<!--Rejected users----------------------------------------------- -->
        <br>
            <div class="table-container">
                <div class="table-header" style="background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);">
                    <i class="mdi mdi-close-circle-outline"></i> Banned Users
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
    <tr>
        <td>SINO</td>
         <td>Name</td>
         <td>Email</td>
         <td>Contact</td>
         <td>Address</td>
      	 <td>Gender</td>
         <td>Profile</td>
         <td>Action</td>
    </tr>
    </thead>
    <tbody>
    <?php
    $i=0;
    $selqry="select * from tbl_user where user_status='2'";
    $rows=$con->query($selqry);
     if($rows->num_rows > 0) {
    while($data=$rows->fetch_assoc())
    {
	    $i++;
	?>
   
	<tr>
	    <td><?php echo $i ?></td>	  
        <td><?php echo $data['user_name'] ?></td>
        <td><?php echo $data['user_email'] ?></td>	
        <td><?php echo $data['user_contact'] ?></td>
        <td><?php echo $data['user_address'] ?></td>
        <td><?php echo $data['user_gender'] ?></td>

    <td><img src="../Assets/Files/UserPhoto//<?php echo $data['user_photo'] ?>" width="75" height="75" /></td>             
        <td>
        
       <a href="?acuid=<?php echo $data['user_id']; ?>" class="action-btn btn-accept" 
                onclick="return confirm('Accept User?')">Accept</a>

        <a href="?deid=<?php echo $data['user_id']; ?>" class="action-btn btn-reject" 
                onclick="return confirm('Delete User From Databse?')">Delete</a>
        
        
        </td>
</tr>
   <?php 
        }}
        else
       {
        echo '<tr><td colspan="10" class="text-center">No Banned User Found</td></tr>';
        }
        ?>
</tbody>
</table>
</div>
</div>
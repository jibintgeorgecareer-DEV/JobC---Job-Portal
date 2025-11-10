<?php
//To adda District
include("../Assets/Connection/connection.php");
if(isset($_POST["btn_submit"]))
{
	$name=$_POST["txt_name"];
	$state = $_POST['State'];
	
//To tbl_district
$insqry="INSERT INTO tbl_district(district_name,state_id) values('".$name."','".$state."')";


	if($con->query($insqry))
	{
		?>
        <script>
						alert("INSERTED");
						window.location="District.php";
		</script>
<?php
	}
}
?>

<?php
//Delete values
		if(isset($_GET["clrID"]))
		{
		$quer="DELETE FROM tbl_district WHERE district_id='".$_GET["clrID"]."'";
		if($con->query($quer))
		{
		?>
        <script>
						alert("Deleted");
						window.location="District.php";
		</script>
<?php
	}}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>District-JobC</title>
<link href="../Assets/Templates/Main/img/JobC_logo.png" rel="icon">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.0.96/css/materialdesignicons.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <link rel="stylesheet" href="../Assets/Templates/Admin/Admin-Template/Styles/Dashboard.css">
    <link rel="stylesheet" href="../Assets/Templates/Admin/Admin-Template/Styles/ButtonImage.css">
	  <link rel="stylesheet" href="../Assets/Templates/Admin/Admin-Template/Styles/FormsTextbox.css">
    <link rel="stylesheet" href="../Assets/Templates/Admin/Admin-Template/Styles/Dropdown.css">

</head>

<body>
<!-- Edit place,state -->
  <p> <a href="AdminHome.php" class="link-with-icon">
        <i class="fas fa-home"></i>
        Dashboard
        </a>  
</p>

<p> <a href="State.php" class="link-with-icon">
        <i class="fas fa-edit"></i>
        Edit State
        </a>  
</p>

<p> <a href="place.php" class="link-with-icon">
        <i class="fas fa-edit"></i>
        Edit Place
        </a>  
</p>

     


<!-- form  -->


<center>
<form id="form1" name="form1" method="post" action="">
  <div class="form-container">
    <div class="form-header">
      <i class="fas fa-edit"></i> Add District
    </div>

<br>
    <label for="txt_name2" class="form-label" style="display:block; text-align:center;">Choose a State:</label>
  
   
	<select name="State" id="State" class="custom-dropdown">
    <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                     Select State  </option>
   				<?php
          //drpdown state values
                $sql = "SELECT * FROM tbl_state";
                $result = $con->query($sql);
                    while($row = $result->fetch_assoc()) 
                    {
                    ?>
 
        <option value="<?php echo $row["state_id"]; ?>"><?php echo $row["state_name"]; ?></option>
                    <?php
	                }
                    ?>
    </select>
    <div class="form-body">
      <div class="form-group">
        <label for="txt_name2" class="form-label">District</label>
        <input type="text" name="txt_name" id="txt_name2" class="form-control" placeholder="Name" required />
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
  









 <script src="../Assets/JQ/jQuery.js"></script> 

<script>
    function getDistrict(sid) 
    {

        $.ajax({
        url:"../Assets/AjaxPages/AjaxDistrict.php?sid="+sid,
        success: function(html){
            $("#sel_district").html(html);
        }
        });
    }
</script>

</center>
</form>
</body>
</html>

<html>
    <head>

</head>
    <body>
        <center>
            <div class="table-container">
<div class="table-header">
         <!-- all districts -->          
<i class="mdi mdi-check-circle-outline"></i> District List
</div>
  <div class="table-responsive">
<table border="1" height="150" class="table">
   <tr>
         <td>SINO</td>
         <td>Name</td>
         <td>Action</td>
         
   </tr>
   <?php
   $i=0;
   $selqry="select * from tbl_district";
   $rows=$con->query($selqry);
   while($data=$rows->fetch_assoc())
   {
	    $i++;
	?>
   
	<tr>
	    <td><?php echo $i ?></td>	  
        <td><?php echo $data['district_name'] ?></td>	 
        
        
        <td><a href="District.php?clrID=<?php echo $data['district_id']?>">Delete</a></td>
</tr>
   <?php
   }
   ?>
</tbody>
 </table>
 </div>
 </div>

</center>
</body>
</html>

  
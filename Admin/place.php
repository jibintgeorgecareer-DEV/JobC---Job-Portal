<?php
//To add Place.php
include("../Assets/Connection/connection.php");
if(isset($_POST["btn_submit"]))
{
	$name=$_POST["txt_name"];
	$pincode=$_POST["txt_pincode"];
	 $district=$_POST["sel_district"];
	
 $insqry="INSERT INTO tbl_place(place_name,place_pincode,district_id) values('".$name."','".$pincode."','".$district."')";

	if($con->query($insqry))
	{
		?>
        <script>
						alert("INSERTED");
						window.location="place.php";
		</script>
<?php
	}
}
?>



<?php
		if(isset($_GET["clrID"]))//Delete
		{
	$quer="DELETE FROM tbl_place WHERE place_id='".$_GET["clrID"]."'";
	if($con->query($quer))
	{
		?>
        <script>
						alert("Deleted");
						window.location="place.php";
		</script>
<?php
	}}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Place-JobC</title>
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
<!--To edit state,district  -->
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
<p> <a href="District.php" class="link-with-icon">
        <i class="fas fa-edit"></i>
        Edit District
        </a>  
</p>

<center>
<form id="form1" name="form1" method="post" action="">

<div class="form-container">
<div class="form-header">
<i class="fas fa-edit"></i> Add Place
</div>
<br>
    <label for="txt_name2" class="form-label" style="display:block; text-align:center;">Choose a State:</label>
<!--Dropdown State  -->   
				<select name="state" id="state" class="custom-dropdown" onChange="getDistrict(this.value)">
    			<option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            Select State  </option>
   				<?php
$sql = "SELECT * FROM tbl_state";
$result = $con->query($sql);
    while($row = $result->fetch_assoc()) {
 ?>
 <option value="<?php echo $row["state_id"]; ?>"><?php echo $row["state_name"]; ?></option>
  <?php
	}
    ?>
</select>
<br><br>
<!--Droedown District  -->
	<label for="txt_name2" class="form-label" style="display:block; text-align:center;">Choose a District:</label>
   
				<select name="sel_district" id="sel_district" class="custom-dropdown">
                <option value="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSelect District</option>
</select>
<br>   
      <div class="form-body">
      <div class="form-group">
        <label for="txt_name2" class="form-label">Place Name</label>
      <input type="text" name="txt_name" id="txt_name" class="form-control" placeholder="Name" required/>
      </div>
    <div class="form-body">
    <div class="form-group">
    <label for="txt_name2" class="form-label">Pincode</label>
    <input type="text" name="txt_pincode" id="txt_pincode" class="form-control" placeholder="Pincode" required/>
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
</div>
</form>
  








<div class="table-container">
<div class="table-header">
                   
<i class="mdi mdi-check-circle-outline"></i> Place List
</div>
  <div class="table-responsive">
<table border="1" height="" class="table">
   <tr>
         <td>SINO</td>
         <td>District</td>
         <td>Place</td>
         <td>Pincode</td>
         <td>Action</td>

         
   </tr>
   <?php
   $i=0;
   $selqry="select * from tbl_place p inner join tbl_district d on p.district_id=d.district_id";
   $rows=$con->query($selqry);
   while($data=$rows->fetch_assoc())
   {
	    $i++;
	?>
   
	<tr>
	    <td><?php echo $i ?></td>	  
        <td><?php echo $data['district_name'] ?></td>	 
        <td><?php echo $data['place_name'] ?></td>
        <td><?php echo $data['place_pincode'] ?></td>	 	 
        
        
        <td><a href="place.php?clrID=<?php echo $data['place_id']?>">Delete</a></td>
            
</tr>
   <?php
   }
   ?>
</table>
</tbody>
 </div>
 </div>
</center>
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
</body>
</html>

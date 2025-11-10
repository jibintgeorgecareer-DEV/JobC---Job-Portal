<?php
//To add languages
include("../Assets/Connection/connection.php");
if(isset($_POST["btn_submit"]))
{
	$name=$_POST["txt_name"];
	
	
 $insqry="INSERT INTO tbl_languages(language_name) values('".$name."')";

	if($con->query($insqry))
	{
		?>
        <script>
						alert("INSERTED");
						window.location="Languages.php";
		</script>
<?php
	}
}
?>



<?php
		if(isset($_GET["clrID"]))//Delte languages
		{
	$quer="DELETE FROM tbl_languages WHERE 	languages_id='".$_GET["clrID"]."'";
	if($con->query($quer))
	{
		?>
        <script>
						alert("Deleted");
						window.location="Languages.php";
		</script>
<?php
	}}

?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Languages-JobC</title>
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
      <i class="fas fa-edit"></i> Add Languages
    </div>
    <div class="form-body">
      <div class="form-group">
        <label for="txt_name2" class="form-label">Languages</label>
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
</form>
<form id="form1" name="form1" method="post" action="">
<div class="table-container">
<div class="table-header">
                <!-- Language lists-->   
<i class="mdi mdi-check-circle-outline"></i> Language List
</div>
  <div class="table-responsive">
<table border="1" height="150" class="table" width="200">
   <tr>
         <td>ID</td>
         <td>LANGUAGE</td>
         <td>ACTION</td>
        

         
   </tr>
   <?php
   $i=0;
   $selqry="select * from tbl_languages ";
   $rows=$con->query($selqry);
   while($data=$rows->fetch_assoc())
   {
	    $i++;
	?>
   
	<tr>
	  	  
        <td><?php echo $i ?></td>	 
        <td><?php echo $data['language_name'] ?></td>
     	 	 
        
        
        <td><a href="Languages.php? clrID=<?php echo $data['languages_id']?>">Delete</a></td>
</tr>
   <?php
   }
   ?>
  </form>
 </tbody>
 </table>
 </div>
 </div>

</center>
</body>
</html>
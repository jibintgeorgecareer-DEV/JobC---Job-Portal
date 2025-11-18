<?php
include("../Assets/Connection/connection.php");
//insert values		
if(isset($_POST['btn_submit']))
{
			$name=$_POST['txt_name'];
			$email=$_POST['txt_email'];
			$contact=$_POST['txt_contact'];
			$pass=$_POST['txt_password'];
			$address=$_POST['txt_address'];
			$place=$_POST['sel_place'];
            $industry=$_POST['industry'];
            $type=$_POST['type'];
           
			
			$logo = $_FILES["filelogo"]["name"];
    		$temp = $_FILES["filelogo"]["tmp_name"];
    		move_uploaded_file($temp,"../Assets/Files/CompanyDocs/".$logo);
	
			$proof = $_FILES["fileproof"]["name"];
    		$resume_temp = $_FILES["fileproof"]["tmp_name"];
    		move_uploaded_file($resume_temp,"../Assets/Files/CompanyProof/".$proof);
	
	
$sql="INSERT INTO tbl_company (company_name,company_email,company_contact,company_address,company_password,company_date_join,place_id,company_logo,company_proof,company_industry,company_type)VALUES 
('".$name."','".$email."','".$contact."','".$address."','".$pass."',curdate(),'".$place."','$logo','$proof','".$industry."','".$type."') ";

	if($con->query($sql))
	{
		?>
        <script>
						alert("COMPANY REGISTERED");
						window.location="Login.php";
					
		</script>
<?php
							header("location:Login.php");
	}
			else
			{
?>
 <script>
						alert("NOT INSRTED VALUES");
						//window.location="NewUser.php";
		</script>
<?php
			
	}}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>JobEntry | Company Registration</title>
<link href="../Assets/Templates/Main/img/JobC_logo.png" rel="icon">
<style>

.jobentry-register-body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #000000 0%, #000000 100%);
    margin: 0;
    padding: 0;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.jobentry-register-container {
    width: 100%;
    max-width: 900px;
    margin: 30px auto;
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
}

.jobentry-register-header {
    background: linear-gradient(to right, #1e3c72, #2a5298);
    color: white;
    padding: 25px 30px;
    text-align: center;
     background: linear-gradient(135deg, #0d6efd 0%, #0d6efd 100%);
}

.jobentry-register-title {
    font-size: 32px;
    font-weight: 700;
    margin: 0 0 10px 0;
    letter-spacing: 0.5px;
    
}

.jobentry-register-subtitle {
    font-size: 16px;
    margin: 0;
    opacity: 0.9;
    font-weight: 300;
}

.jobentry-register-form {
    padding: 30px 40px;
}

.jobentry-register-row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -15px;
}

.jobentry-register-col {
    flex: 1;
    min-width: 300px;
    padding: 0 15px;
    margin-bottom: 20px;
}

.jobentry-register-form-group {
    margin-bottom: 20px;
}

.jobentry-register-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #000000;
    font-size: 14px;
}

.jobentry-register-input {
    width: 100%;
    padding: 14px 15px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 15px;
    transition: all 0.3s;
    box-sizing: border-box;
    background-color: #f9f9f9;
}

.jobentry-register-input:focus {
    outline: none;
    border-color: #0d6efd;
    box-shadow: 0 0 0 2px #000000;
    background-color: #fff;
}

.jobentry-register-select {
    width: 100%;
    padding: 14px 15px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 15px;
    transition: all 0.3s;
    box-sizing: border-box;
    background-color: #f9f9f9;
    appearance: none;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 15px center;
    background-size: 16px;
}

.jobentry-register-select:focus {
    outline: none;
    border-color: #0d6efd;
    box-shadow: 0 0 0 2px #000000;
    background-color: #fff;
}

.jobentry-register-textarea {
    width: 100%;
    padding: 14px 15px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 15px;
    transition: all 0.3s;
    box-sizing: border-box;
    background-color: #f9f9f9;
    resize: vertical;
    min-height: 100px;
    font-family: inherit;
}

.jobentry-register-textarea:focus {
    outline: none;
    border-color: #0d6efd;
    box-shadow: 0 0 0 2px #0d6efd;
    background-color: #fff;
}

.jobentry-register-file {
    width: 100%;
    padding: 12px 15px;
    border: 1px dashed #ddd;
    border-radius: 6px;
    font-size: 15px;
    transition: all 0.3s;
    box-sizing: border-box;
    background-color: #f9f9f9;
    cursor: pointer;
}

.jobentry-register-file:hover {
    border-color: #2a5298;
    background-color: #f0f5ff;
}

.jobentry-register-btn-group {
    display: flex;
    justify-content: center;
    margin-top: 30px;
}

.jobentry-register-btn {
    padding: 14px 40px;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    background: linear-gradient(to right, #0d6efd, #0d6efd);
    color: white;
    box-shadow: 0 4px 10px rgba(42, 82, 152, 0.2);
}

.jobentry-register-btn:hover {
    background: linear-gradient(to right, #2a5298, #0d6efd);
    box-shadow: 0 6px 15px rgba(42, 82, 152, 0.3);
    transform: translateY(-2px);
}

.jobentry-register-footer {
    text-align: center;
    padding: 20px;
    color: #777;
    font-size: 14px;
    background-color: #f9f9f9;
    border-top: 1px solid #eee;
}

.jobentry-register-footer a {
    color: #2a5298;
    text-decoration: none;
    font-weight: 500;
}

.jobentry-register-footer a:hover {
    text-decoration: underline;
}


@media (max-width: 768px) {
    .jobentry-register-container {
        margin: 15px;
        width: auto;
    }
    
    .jobentry-register-form {
        padding: 20px;
    }
    
    .jobentry-register-col {
        min-width: 100%;
    }
}
</style>
</head>

<body class="jobentry-register-body">
<div class="jobentry-register-container">
    <div class="jobentry-register-header">
        <h1 class="jobentry-register-title">JobC</h1>
        <p class="jobentry-register-subtitle">Company Registration - Find The Perfect Talent</p>
    </div>
    
    <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data" class="jobentry-register-form">
        <div class="jobentry-register-row">
            <div class="jobentry-register-col">
                <div class="jobentry-register-form-group">
                    <label for="txt_name" class="jobentry-register-label">Company Name</label>
                    <input type="text" name="txt_name" id="txt_name" class="jobentry-register-input" placeholder="Enter company name" required />
                </div>
                
                <div class="jobentry-register-form-group">
                    <label for="txt_email" class="jobentry-register-label">Email</label>
                    <input type="email" name="txt_email" id="txt_email" class="jobentry-register-input" placeholder="Enter company email" required />
                </div>
                
                <div class="jobentry-register-form-group">
                    <label for="txt_contact" class="jobentry-register-label">Contact</label>
                    <input type="text" name="txt_contact" id="txt_contact" class="jobentry-register-input" placeholder="Enter contact number" required />
                </div>
                <!-- industry values -->
                <div class="jobentry-register-form-group">
                    <label for="industry" class="jobentry-register-label">Industry</label>
                    <select name="industry" id="industry" class="jobentry-register-select" required>
                        <option value="">Select Industry</option>
                        <?php
                        $sql = "SELECT * FROM tbl_company_industry";
                        $result = $con->query($sql);
                        while($row = $result->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $row["industry_id"] ?>"><?php echo $row["industry_name"]?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <!-- company tyeps-->
                <div class="jobentry-register-form-group">
                    <label for="type" class="jobentry-register-label">Company Type</label>
                    <select name="type" id="type" class="jobentry-register-select" required>
                        <option value="">Select Type</option>
                        <?php
                        $sql = "SELECT * FROM tbl_company_type";
                        $result = $con->query($sql);
                        while($row = $result->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $row["company_type_id"] ?>"><?php echo $row["company_type_name"]?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            
            <div class="jobentry-register-col">
                <div class="jobentry-register-form-group">
                    <label for="txt_address" class="jobentry-register-label">Address</label>
                    <textarea name="txt_address" id="txt_address" class="jobentry-register-textarea" placeholder="Enter company address" required></textarea>
                </div>
                <!-- to store address,-->
                <div class="jobentry-register-form-group">
                    <label for="state" class="jobentry-register-label">State</label>
                    <select name="state" id="state" class="jobentry-register-select" onChange="getDistrict(this.value)" required>
                        <option value="">-- Select State --</option>
                        <?php
                        $sql = "SELECT * FROM tbl_state";
                        $result = $con->query($sql);
                        while($row = $result->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $row["state_id"] ?>"><?php echo $row["state_name"]?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                
                <div class="jobentry-register-form-group">
                    <label for="sel_district" class="jobentry-register-label">District</label>
                    <select name="sel_district" id="sel_district" class="jobentry-register-select" onChange="getPlace(this.value)" required>
                        <option value="">-- Select District --</option>
                    </select>
                </div>
                
                <div class="jobentry-register-form-group">
                    <label for="sel_place" class="jobentry-register-label">Place</label>
                    <select name="sel_place" id="sel_place" class="jobentry-register-select" required>
                        <option value="">-- Select Place --</option>
                    </select>
                </div>
                
                <div class="jobentry-register-form-group">
                    <label for="txt_password" class="jobentry-register-label">Password</label>
                    <input type="password" name="txt_password" id="txt_password" class="jobentry-register-input" placeholder="Password must be 8 characters long" required minlength="8"/>
                </div>
            </div>
        </div>
        
        <div class="jobentry-register-row">
            <div class="jobentry-register-col">
                <div class="jobentry-register-form-group">
                    <label for="filelogo" class="jobentry-register-label">Company Logo</label>
                    <input type="file" name="filelogo" id="filelogo" class="jobentry-register-file" required />
                </div>
            </div>
            
            <div class="jobentry-register-col">
                <div class="jobentry-register-form-group">
                    <label for="fileproof" class="jobentry-register-label">Business License Proof</label>
                    <input type="file" name="fileproof" id="fileproof" class="jobentry-register-file" required />
                </div>
            </div>
        </div>
        
        <div class="jobentry-register-btn-group">
            <input type="submit" name="btn_submit" id="btn_submit" class="jobentry-register-btn" value="Register Company" />
        </div>
    </form>
    
    <div class="jobentry-register-footer">
        Already have an account? <a href="Login.php">Login here</a>
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

<script>
    function getPlace(did) 
    {
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
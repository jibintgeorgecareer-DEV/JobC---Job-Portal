<?php
include("../Assets/Connection/connection.php");
session_start();
include('Head.php'); 

if(isset($_POST['btn_submit']))  
{
    $title=$_POST['txt_title'];
    $content=$_POST['txt_content'];
    //upload complaint
    $in="INSERT INTO tbl_complaint(complaint_title,complaint_content,user_id,complaint_date) VALUES
     ('".$title."','".$content."','".$_SESSION['uid']."', UNIX_TIMESTAMP()) ";
     
     if($con->query($in))
     {
?>
        <script>
        alert("Complaint Submitted Successfully!");
        window.location="Complaint.php";
        </script>
<?php
     }
}

if(isset($_GET["delete"]))
{
    $quer="DELETE FROM tbl_complaint WHERE complaint_id='".$_GET["delete"]."'";
    if($con->query($quer))
    {
?>
        <script>
        alert("Complaint Deleted Successfully!");
        window.location="Complaint.php";
        </script>
<?php         
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<title>JobC - Complaints</title>
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
</head>

<body>
<center>
 <div class="job-post-container">
            <div class="job-post-card">
                <div class="job-post-header">
                    <h2><font color="white">Complaints</font></h2>
                    <p>Write Your Complaint</p>
                </div>

                <form id="form1" name="form1" method="post" action="">
                    <div class="job-post-body">

                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-key"></i> Title</label>
                            <input type="text" name="txt_title" id="txt_title" class="form-control" placeholder="Enter complaint title" required />
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-file-alt"></i> Content</label>
                            <textarea id="txt_content" name="txt_content" rows="5" class="form-control" placeholder="Type your complaint details..." required></textarea>
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" name="btn_submit" id="btn_submit" class="btn-submit"> <!-- Fixed: Changed name to btn_submit -->
                            <i class="fas fa-paper-plane"></i> Submit Complaint
                        </button>
                        <button type="reset" name="btn_clear" id="btn_clear" class="btn-reset">
                            <i class="fas fa-eraser"></i> Clear
                        </button>
                    </div>
                </form>
            </div>
        </div>
</center>

<!-- Display Existing Complaints -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="complaint-list">
                <h3 class="text-center mb-4">Your Previous Complaints</h3>
                <?php
                if(isset($_SESSION['uid'])) {
                    $selqry = "SELECT * FROM tbl_complaint WHERE user_id='".$_SESSION['uid']."' ORDER BY complaint_date DESC";
                    $result = $con->query($selqry);
                    
                    if($result->num_rows > 0) {
                        while($data = $result->fetch_assoc()) {
                ?>
                <div class="complaint-item" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 8px;">
                    <div class="complaint-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <h5 style="margin: 0;"><?php echo htmlspecialchars($data['complaint_title']); ?></h5>
                        <span style="color: #666; font-size: 0.9rem;">
                            <?php echo date('d-m-Y H:i', $data['complaint_date']); ?>
                        </span>
                    </div>
                    <div class="complaint-content" style="margin-top: 10px;">
                        <p style="margin: 0;"><?php echo htmlspecialchars($data['complaint_content']); ?></p>
                    </div>
                    <?php if(!empty($data['complaint_reply'])): ?>
                    <div class="complaint-reply" style="margin-top: 10px; padding: 10px; background: #f8f9fa; border-radius: 5px;">
                        <strong>Admin Reply:</strong>
                        <p style="margin: 5px 0 0 0;"><?php echo htmlspecialchars($data['complaint_reply']); ?></p>
                    </div>
                    <?php endif; ?>
                    <div class="complaint-actions" style="margin-top: 10px; text-align: right;">


                    <!-- delete complaints -->
                        <a href="?delete=<?php echo $data['complaint_id']; ?>" 
                           class="btn btn-danger btn-sm" 
                           onclick="return confirm('Are you sure you want to delete this complaint?')">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </div>
                </div>
                <?php
                        }
                    } else {
                        echo '<p class="text-center">No complaints submitted yet.</p>';
                    }
                } else {
                    echo '<p class="text-center">Please login to view your complaints.</p>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>
<?php include('Foot.php'); ?>
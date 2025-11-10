<?php
include("../Assets/Connection/connection.php");
session_start();
include("Head.php");
//The page applied candidate lists
//If company log in
if(!isset($_SESSION['cid'])){
    header('Location:Login.php');
    exit;
}
$companyId = (int)$_SESSION['cid'];

//Update status
if(isset($_POST['action']) && $_POST['action']=='changeStatus'){
    $applyId = (int)$_POST['applyId'];
    $newSts  = $_POST['newStatus'];
    $con->query("UPDATE tbl_apply SET apply_status='$newSts' WHERE apply_id=$applyId AND job_post_id IN 
                (SELECT job_post_id FROM tbl_job_poster WHERE company_id=$companyId)");
    echo "OK";
    exit;
}
//Mark resume  viewed
if(isset($_POST['action']) && $_POST['action']=='markViewed'){
    $applyId = (int)$_POST['apply_id'];
    $con->query("UPDATE tbl_apply SET hr_view = 1 WHERE apply_id=$applyId AND job_post_id IN 
                (SELECT job_post_id FROM tbl_job_poster WHERE company_id=$companyId)");
    echo "OK";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>JobC - Candidate Lists</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
body{
    margin:0;
    font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
    background:#f3f6fd;
}
.jb-container{
    max-width:1200px;
    margin:40px auto;
    background:#fff;
    border-radius:12px;
    box-shadow:0 8px 25px #0d6efd;
    overflow:hidden;
}
.jb-header{
    background: #0d6efd;
    color:#fff;
    padding:25px 35px;
    display:flex;
    align-items:center;
    justify-content:space-between;
}
.jb-header h2{margin:0;font-weight:600;}
.jb-back{
    background: #0d6efd;
    color:#fff;
    padding:8px 18px;
    border-radius:30px;
    text-decoration:none;
    font-size:14px;
    transition:.3s;
}
.jb-back:hover{background: #0d6efd;}

.jb-body{padding:30px 35px;}
.jb-table{width:100%;border-collapse:collapse;font-size:15px;}
.jb-table thead{
    background:#eef2f9;
    text-align:left;
}
.jb-table th,.jb-table td{padding:14px 10px;}
.jb-table tbody tr{border-bottom:1px solid  #0d6efd;}
.jb-table tbody tr:hover{background:#f8fafd;}

.st-badge{
    padding:5px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
    display:inline-block;
}
.st-Applied   {background:#e3f2fd;color:#1565c0;}
.st-Shortlisted{background:#e8f5e9;color:#2e7d32;}
.st-Rejected  {background:#ffebee;color:#c62828;}
.st-Hired     {background:#f3e5f5;color:#6a1b9a;}

.jb-action select{
    padding:6px 10px;
    border:1px solid #0d6efd;
    border-radius:4px;
    font-size:13px;
    cursor:pointer;
}
</style>
</head>
<body>

<div class="jb-container">
    <div class="jb-header">
        <h2><i class="fa-solid fa-briefcase"></i> &nbsp;<font color="white">Applications Received</font></h2>
        
    </div>

    <div class="jb-body">
        <table class="jb-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Candidate Name</th>
                    <th>Job Title</th>
                    <th>Applied On</th>
                    <th>Resume</th>
                    <th>Status</th>
                    <th>Change Status</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
            <?php
            //Fetch candidate details
            $qry = "
            SELECT a.apply_id, a.apply_date, a.apply_status, a.apply_file,a.user_id,
                   u.user_name, j.job_post_title
            FROM tbl_apply a
            JOIN tbl_user u ON u.user_id = a.user_id
            JOIN tbl_job_poster j ON j.job_post_id = a.job_post_id
            WHERE j.company_id = $companyId
            ORDER BY a.apply_date DESC";
            $res = $con->query($qry);
        
            if(!$res->num_rows){
                echo '<tr><td colspan="7" style="text-align:center;">No applications yet.</td></tr>';
            }
            $i=0;
            //Resume
            while($row = $res->fetch_assoc()){
                $i++;
                $badge = 'st-'.$row['apply_status'];
                $date  = date('d-M-Y',strtotime($row['apply_date']));
                $resume= $row['apply_file'] ? '../Assets/Files/UserResume/'.$row['apply_file'] : '#';
                $r=$row['user_id'];
            ?>
            <!-- Essential details -->
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['job_post_title']); ?></td>
                    <td><?php echo $date; ?></td>
                    <td>
    <!-- by clicking resume user can view HR viwed his profile or not -->
    <?php if($resume != '../Assets/Files/UserResume'){ ?>
       <a href="<?php echo $resume; ?>" 
          target="_blank" 
          title="View Resume"
          data-apply-id="<?php echo $row['apply_id']; ?>"
          class="resume-link">
           <i class="fa-solid fa-file-lines fa-lg"></i>
       </a>
    <?php } else { echo '--'; } ?>
</td>

<!-- Status of application -->

                    <td><span class="st-badge <?php echo $badge; ?>"><?php echo $row['apply_status']; ?></span></td>
                    <td class="jb-action">
                        
                        <select data-aid="<?php echo $row['apply_id']; ?>">
                            <option value="1"    <?php if($row['apply_status']=='1')    echo 'selected'; ?>>Applied</option>
                            <option value="2"<?php if($row['apply_status']=='2')echo 'selected'; ?>>Shortlisted</option>
                            <option value="3"   <?php if($row['apply_status']=='3')   echo 'selected'; ?>>Rejected</option>
                            <option value="4"      <?php if($row['apply_status']=='4')      echo 'selected'; ?>>Hired</option>
                        </select>
                    </td>
                   <td>
    <div class="d-flex mb-3">
        <a class="btn btn-primary" href="ViewCandidateProfile.php?id=<?php echo $row['user_id']; ?>">View Profile</a>
    </div>
</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$('[data-aid]').on('change', function(){
    const applyId = $(this).data('aid');
    const newStatus = $(this).val();
    const $row = $(this).closest('tr');
    $.post('', {action:'changeStatus', applyId:applyId, newStatus:newStatus}, function(res){
        if(res.trim()==='OK'){
            /* Update badge & text */
            $row.find('.st-badge')
                .removeClass()
                .addClass('st-badge st-'+newStatus)
                .text(newStatus);
        }else{
            alert('Change Candidate Apply Status?');
            location.reload();
        }
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get all resume links
    const resumeLinks = document.querySelectorAll('.resume-link');
    
    resumeLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const applyId = this.getAttribute('data-apply-id');
            
            // Send AJAX request to mark as viewed
            fetch('', { // Empty string means current page
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'action=markViewed&apply_id=' + applyId
            });
            
            // Let the link open normally in new tab
        });
    });
});
</script>
</body>
</html>
<?php include("Foot.php"); ?>
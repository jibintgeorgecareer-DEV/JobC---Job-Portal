<?php
include("../Assets/Connection/connection.php");
session_start();


//  delete action
if(isset($_GET['delid'])) {
    $delQry = "DELETE FROM tbl_job_report WHERE report_id = " . $_GET['delid'];
    if($con->query($delQry)) {
        ?>
        <script>
            alert("Report deleted successfully");
            window.location = "JobReports.php";
        </script>
        <?php
    }
}

//  reply action
if(isset($_POST['btn_reply'])) {
    $reportId = $_POST['report_id'];
    $replyContent = $_POST['reply_content'];
    
    $updateQry = "UPDATE tbl_job_report SET report_status = 1 WHERE report_id = " . $reportId;
    
    if($con->query($updateQry)) {
        ?>
        <script>
            alert("Reply sent successfully");
            window.location = "JobReports.php";
        </script>
        <?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints - JobC Admin</title>
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
   
</head>
<body>
    <div class="container-fluid">
        
        <p>
            <a href="AdminHome.php" class="link-with-icon">
                <i class="fas fa-home"></i>
                Dashboard
            </a> 
            <h2 align="center">JOB REPORTS</h2>
        </p>

        <!--  Reports Table -->
        <div class="table-container">
            <div class="table-header" style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);">
                <i class="mdi mdi-alert-circle-outline"></i> Pending Reports
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>SINO</th>
                            <th>Repoted User </th>
                            <th>Job Post ID</th>
                            <th>Company </th>
                            <th>Title</th>
                            <th>Report Content</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $selqry = "SELECT r.*, u.user_name, u.user_email, j.job_post_title, c.company_name 
                                  FROM tbl_job_report r 
                                  LEFT JOIN tbl_user u ON r.user_id = u.user_id 
                                  LEFT JOIN tbl_job_poster j ON r.job_post_id = j.job_post_id
                                  LEFT JOIN tbl_company c ON r.company_id = c.company_id
                                  WHERE r.report_status = 0
                                  ORDER BY r.report_id DESC";
                        $rows = $con->query($selqry);
                        
                        if($rows->num_rows > 0) {
                            while($data = $rows->fetch_assoc()) {
                                $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $data['user_name'] > 0 ? $data['user_name'] : 'N/A'; ?></td>
                            <td><?php echo $data['job_post_id'] > 0 ? $data['job_post_id'] : 'N/A'; ?></td>
                            <td><?php echo $data['company_name'] > 0 ? $data['company_name'] : 'N/A'; ?></td>
                            <td><?php echo htmlspecialchars($data['report_title']); ?></td>
                            <td>
                                <span title="<?php echo htmlspecialchars($data['report_content']); ?>">
                                    <?php echo strlen($data['report_content']) > 30 ? 
                                        substr($data['report_content'], 0, 30) . '...' : 
                                        $data['report_content']; ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-warning">Pending</span>
                            </td>
                            <td>
                                
                                
                                <!-- Delete Button -->
                                <a href="?delid=<?php echo $data['report_id']; ?>" 
                                   class="action-btn btn-reject" 
                                   onclick="return confirm('Delete this report?')">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                        <?php
                            }
                        } else {
                            echo '<tr><td colspan="8" class="text-center">No pending reports found</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        
    <!--  Report Details -->
    <div id="reportModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Report Details</h5>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <form method="post">
                <input type="hidden" name="report_id" id="modal_report_id">
                
                <label class="form-label">Reported By:</label>
                <p id="modal_user_name" style="padding: 10px; background: #f8f9fa; border-radius: 5px;"></p>
                
                <label class="form-label">Job Title:</label>
                <p id="modal_job_title" style="padding: 10px; background: #f8f9fa; border-radius: 5px;"></p>
                
                <label class="form-label">Company:</label>
                <p id="modal_company_name" style="padding: 10px; background: #f8f9fa; border-radius: 5px;"></p>
                
                <label class="form-label">Report Content:</label>
                <p id="modal_report_content" style="padding: 10px; background: #f8f9fa; border-radius: 5px;"></p>
                
                <label class="form-label">Admin Reply:</label>
                <textarea name="reply_content" class="form-control" rows="4" placeholder="Enter your response here..."></textarea>
                
                <div class="modal-footer">
                    <button type="button" class="action-btn btn-reject" onclick="closeModal()">Close</button>
                    <button type="submit" name="btn_reply" class="action-btn btn-accept">Mark as Resolved</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(reportId, userName, reportContent, jobTitle, companyName) {
            document.getElementById('modal_report_id').value = reportId;
            document.getElementById('modal_user_name').innerText = userName;
            document.getElementById('modal_job_title').innerText = jobTitle;
            document.getElementById('modal_company_name').innerText = companyName;
            document.getElementById('modal_report_content').innerText = reportContent;
            document.getElementById('reportModal').style.display = 'block';
        }
        
        function closeModal() {
            document.getElementById('reportModal').style.display = 'none';
        }
        
        window.onclick = function(event) {
            var modal = document.getElementById('reportModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>
</html>

<?php

?>
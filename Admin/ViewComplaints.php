<?php
include("../Assets/Connection/connection.php");
session_start();
//to view complaints
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
<body>

<?php
// Handle reply submission
if(isset($_POST["btn_reply"])) {
    $complaint_id = $_POST["complaint_id"];
    $reply = $_POST["complaint_reply"];
    
    $update_query = "UPDATE tbl_complaint SET complaint_reply = '$reply', complaint_status = 'Replied' WHERE complaint_id = '$complaint_id'";
    if($con->query($update_query)) {
        echo "<script>
        alert('Reply sent successfully!'); 
        window.location='Complaints.php';
        </script>";
    } else {
        echo "<script>
        alert('Failed to send reply!'); 
        window.location='Complaints.php';
        </script>";
    }
}

// Handle delete complaint
if(isset($_GET["delid"])) {
    $del_query = "DELETE FROM tbl_complaint WHERE complaint_id = '".$_GET["delid"]."'";
    if($con->query($del_query)) {
        echo "<script>
        alert('Complaint deleted successfully!'); 
        window.location='Complaints.php';
        </script>";
    }
}
?>

<div class="container-fluid">
    <!-- Header -->
    <p>
        <a href="AdminHome.php" class="link-with-icon">
            <i class="fas fa-home"></i>
            Dashboard
        </a> 
        <h2 align="center">USER COMPLAINTS</h2>
    </p>

    <!-- Pending Complaints Table -->
    <div class="table-container">
        <div class="table-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <i class="mdi mdi-alert-circle-outline"></i> Pending Complaints
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Title</th>
                        <th>Complaint</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $selqry = "SELECT c.*, u.user_name, u.user_email 
                              FROM tbl_complaint c 
                              INNER JOIN tbl_user u ON c.user_id = u.user_id 
                              WHERE c.complaint_status != 'Replied' OR c.complaint_status = ''
                              ORDER BY c.complaint_date DESC";
                    $rows = $con->query($selqry);
                    
                    if($rows->num_rows > 0) {
                        while($data = $rows->fetch_assoc()) {
                            $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo htmlspecialchars($data['user_name']); ?></td>
                        <td><?php echo htmlspecialchars($data['user_email']); ?></td>
                        <td><?php echo htmlspecialchars($data['complaint_title']); ?></td>
                        <td>
                            <span title="<?php echo htmlspecialchars($data['complaint_content']); ?>">
                                <?php echo strlen($data['complaint_content']) > 30 ? 
                                    substr($data['complaint_content'], 0, 30) . '...' : 
                                    $data['complaint_content']; ?>
                            </span>
                        </td>
                        <td><?php echo date('d-m-Y', $data['complaint_date']); ?></td>
                        <td>
                            <span class="badge bg-warning">Pending</span>
                        </td>
                        <td>
                            <!-- Reply Button -->
                            <button type="button" class="action-btn btn-accept" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#replyModal"
                                    data-complaintid="<?php echo $data['complaint_id']; ?>"
                                    data-complaintuser="<?php echo htmlspecialchars($data['user_name']); ?>"
                                    data-complaintcontent="<?php echo htmlspecialchars($data['complaint_content']); ?>">
                                <i class="fas fa-reply"></i> Reply
                            </button>
                            
                            <!-- Delete Button -->
                            <a href="?delid=<?php echo $data['complaint_id']; ?>" 
                               class="action-btn btn-reject" 
                               onclick="return confirm('Delete this complaint?')">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="8" class="text-center">No pending complaints found</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Replied Complaints Table -->
    <div class="table-container">
        <div class="table-header" style="background: linear-gradient(135deg, #dc3545 0%, #ffc107 100%);">
            <i class="mdi mdi-check-circle-outline"></i> Replied Complaints
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Title</th>
                        <th>Complaint</th>
                        <th>Reply</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $j = 0;
                    $selqry_replied = "SELECT c.*, u.user_name, u.user_email 
                                      FROM tbl_complaint c 
                                      INNER JOIN tbl_user u ON c.user_id = u.user_id 
                                      WHERE c.complaint_status = 'Replied' 
                                      ORDER BY c.complaint_date DESC";
                    $rows_replied = $con->query($selqry_replied);
                    
                    if($rows_replied->num_rows > 0) {
                        while($data = $rows_replied->fetch_assoc()) {
                            $j++;
                    ?>
                    <tr>
                        <td><?php echo $j; ?></td>
                        <td><?php echo htmlspecialchars($data['user_name']); ?></td>
                        <td><?php echo htmlspecialchars($data['user_email']); ?></td>
                        <td><?php echo htmlspecialchars($data['complaint_title']); ?></td>
                        <td>
                            <span title="<?php echo htmlspecialchars($data['complaint_content']); ?>">
                                <?php echo strlen($data['complaint_content']) > 30 ? 
                                    substr($data['complaint_content'], 0, 30) . '...' : 
                                    $data['complaint_content']; ?>
                            </span>
                        </td>
                        <td>
                            <span title="<?php echo htmlspecialchars($data['complaint_reply']); ?>">
                                <?php echo strlen($data['complaint_reply']) > 30 ? 
                                    substr($data['complaint_reply'], 0, 30) . '...' : 
                                    $data['complaint_reply']; ?>
                            </span>
                        </td>
                        <td><?php echo date('d-m-Y', $data['complaint_date']); ?></td>
                        <td>
                            <span class="badge bg-success">Replied</span>
                        </td>
                        <td>
                            <!-- Edit Reply Button -->
                            <button type="button" class="action-btn btn-accept" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#replyModal"
                                    data-complaintid="<?php echo $data['complaint_id']; ?>"
                                    data-complaintuser="<?php echo htmlspecialchars($data['user_name']); ?>"
                                    data-complaintcontent="<?php echo htmlspecialchars($data['complaint_content']); ?>"
                                    data-complaintreply="<?php echo htmlspecialchars($data['complaint_reply']); ?>">
                                <i class="fas fa-edit"></i> Edit Reply
                            </button>
                            
                            <!-- Delete Button -->
                            <a href="?delid=<?php echo $data['complaint_id']; ?>" 
                               class="action-btn btn-reject" 
                               onclick="return confirm('Delete this complaint?')">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="9" class="text-center">No replied complaints found</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Reply -->
<div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="replyModalLabel">Reply to Complaint</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <input type="hidden" name="complaint_id" id="complaint_id">
                    
                    <div class="mb-3">
                        <label class="form-label">User:</label>
                        <input type="text" class="form-control" id="complaint_user" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Complaint:</label>
                        <textarea class="form-control" id="complaint_content" rows="3" readonly></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="complaint_reply" class="form-label">Your Reply:</label>
                        <textarea class="form-control" id="complaint_reply" name="complaint_reply" rows="4" 
                                  placeholder="Enter your reply here..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn_reply" class="btn btn-primary">Send Reply</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<script>
// JavaScript to populate modal with data
document.addEventListener('DOMContentLoaded', function() {
    var replyModal = document.getElementById('replyModal');
    replyModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        
        var complaintId = button.getAttribute('data-complaintid');
        var complaintUser = button.getAttribute('data-complaintuser');
        var complaintContent = button.getAttribute('data-complaintcontent');
        var complaintReply = button.getAttribute('data-complaintreply');
        
        var modalTitle = replyModal.querySelector('.modal-title');
        var complaintIdInput = replyModal.querySelector('#complaint_id');
        var complaintUserInput = replyModal.querySelector('#complaint_user');
        var complaintContentInput = replyModal.querySelector('#complaint_content');
        var complaintReplyInput = replyModal.querySelector('#complaint_reply');
        
        complaintIdInput.value = complaintId;
        complaintUserInput.value = complaintUser;
        complaintContentInput.value = complaintContent;
        complaintReplyInput.value = complaintReply || '';
        
        if(complaintReply) {
            modalTitle.textContent = 'Edit Reply';
        } else {
            modalTitle.textContent = 'Reply to Complaint';
        }
    });
});
</script>

</body>
</html>
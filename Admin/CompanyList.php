<?php
include("../Assets/Connection/connection.php");
session_start();
?>
<!-- To display all companies -->
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
//status = 1 : VERIFIED
 if(isset($_GET["acid"])) {
        $quer = "UPDATE tbl_company SET company_status='1' WHERE company_id ='".$_GET["acid"]."'";
        if($con->query($quer)) {
            echo "<script>
            alert('Company Accepted!'); 
            window.location='Companylist.php';
                   </script>";
        }
    }
//status=2 : REJECTED
    if(isset($_GET["rejid"])) {
        $quer = "UPDATE tbl_company SET company_status='2' WHERE company_id ='".$_GET["rejid"]."'";
        if($con->query($quer)) {
            echo "<script>
            alert('Company Rejected!'); 
            window.location='Companylist.php';
            </script>";
        }
    }
//status =2:DELETED
     if(isset($_GET["deid"])) {
        $quer = "DELETE FROM tbl_company WHERE company_id ='".$_GET["deid"]."'";
        if($con->query($quer)) {
            echo "<script>
            alert('Company Deleted From Database!'); 
            window.location='Companylist.php';
            </script>";
        }
    }
?>

  <!-- Accepted Companies Table -->
   
    <p> <a href="AdminHome.php" class="link-with-icon">
        <i class="fas fa-home"></i>
        Dashboard
        </a> <h2 align="center">COMPANY VERIFICATIONS</h2>
       </p>
 

     

       
        


    <br><br>
            <div class="table-container">
                <div class="table-header">
                   
                    <i class="mdi mdi-check-circle-outline"></i> Accepted Companies
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>SINO</th>
                                <th>Company Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Address</th>
                                <th>Date Joined</th>
                                <th>Location</th>
                                <th>Logo</th>
                                <th>Proof</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $selqry = "SELECT * FROM tbl_company c  
                            INNER JOIN tbl_place p ON c.place_id = p.place_id 
                            INNER JOIN tbl_district d ON d.district_id = p.district_id 
                            INNER JOIN tbl_state s ON s.state_id = d.state_id
                            WHERE c.company_status = '1'";
                            $rows = $con->query($selqry);
                            
                            if($rows->num_rows > 0) {
                                while($data = $rows->fetch_assoc()) {
                                    $i++;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>                            
                                <td><?php echo $data['company_name'] ?></td>
                                <td><?php echo $data['company_email'] ?></td>	
                                <td><?php echo $data['company_contact'] ?></td>
                                <td><?php echo $data['company_address'] . '...'; ?></td>
                                <td><?php echo $data['company_date_join'] ?></td>
                                <td>
                                    <small>
                                        <?php echo htmlspecialchars($data['place_name']); ?><br>
                                        <?php echo htmlspecialchars($data['district_name']); ?><br>
                                        <?php echo htmlspecialchars($data['state_name']); ?>
                                    </small>
                                </td>
                                <td>
                                     <img src="../Assets/Files/CompanyDocs/<?php echo $data['company_logo']; ?>" 
                                         alt="Logo" class="company-logo">
                                </td>
                                <td>
                                        <a href="../Assets/Files/CompanyProof/<?php echo $data['company_proof']; ?>" target="_blank"> 
                                        <img src="../Assets/Files/CompanyProof/<?php echo $data['company_proof']; ?>"
                                        alt="Proof" class="company-logo"> 
                                       
                                    </a>
                                </td>
                                <td>
                                    <a href="?rejid=<?php echo $data['company_id']; ?>" class="action-btn btn-reject" 
                                       onclick="return confirm('Reject this company?')">Reject</a>
                                </td>
                            </tr>
                            <?php
                                }
                            } else {
                                echo '<tr><td colspan="10" class="text-center">No accepted companies found</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

  <!-- Rejected Companies Table -->
            <div class="table-container">
                <div class="table-header" style="background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);">
                    <i class="mdi mdi-close-circle-outline"></i> Rejected Companies
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Company Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Address</th>
                                <th>Date Joined</th>
                                <th>Location</th>
                                <th>Logo</th>
                                <th>Proof</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $selqry =" SELECT * FROM tbl_company c 
                            INNER JOIN tbl_place p ON c.place_id = p.place_id 
                            INNER JOIN tbl_district d ON d.district_id = p.district_id 
                            INNER JOIN tbl_state s ON s.state_id = d.state_id 
                            WHERE c.company_status = '2' ";
                            $rows = $con->query($selqry);
                            
                            if($rows->num_rows > 0) {
                                while($data = $rows->fetch_assoc()) {
                                    $i++;
                            ?>
                            <tr>
                                 <td><?php echo $i; ?></td>                            
                                <td><?php echo $data['company_name'] ?></td>
                                <td><?php echo $data['company_email'] ?></td>	
                                <td><?php echo $data['company_contact'] ?></td>
                                <td><?php echo $data['company_address'] . '...'; ?></td>
                                <td><?php echo $data['company_date_join'] ?></td>
                                <td>
                                    <small>
                                        <?php echo htmlspecialchars($data['place_name']); ?><br>
                                        <?php echo htmlspecialchars($data['district_name']); ?><br>
                                        <?php echo htmlspecialchars($data['state_name']); ?>
                                    </small>
                                </td>
                                <td>
                                    <img src="../Assets/Files/CompanyDocs/<?php echo $data['company_logo']; ?>" 
                                         alt="Logo" class="company-logo">
                                   
                                </td>
                                <td>
                                     <a href="../Assets/Files/CompanyProof/<?php echo $data['company_proof']; ?>" target="_blank"> 
                                        <img src="../Assets/Files/CompanyProof/<?php echo $data['company_proof']; ?>"
                                        alt="Proof" class="company-logo"> 
                                    </a>
                                </td>
                                <td>
                                    <a href="?acid=<?php echo $data['company_id']; ?>" class="action-btn btn-accept" 
                                       onclick="return confirm('Accept this company?')">Accept</a>
                                
                                    <a href="?deid=<?php echo $data['company_id']; ?>" class="action-btn btn-reject" 
                                       onclick="return confirm('Delete From Database?')">Delete</a>
                                </td>
                            </tr>
                            <?php
                                }
                            } else {
                                echo '<tr><td colspan="10" class="text-center">No rejected companies found</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
include("../Assets/Connection/connection.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Job Portal</title>
    <link href="../Assets/Templates/Main/img/JobC_logo.png" rel="icon">
    <!-- Material Design Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.0.96/css/materialdesignicons.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../Assets/Templates/Admin/Admin-Template/Styles/Dashboard.css">
    <link rel="stylesheet" href="../Assets/Templates/Admin/Template/Styles/ButtonImage.css">


   
</head>
<body>
    <?php
    
    $admin_photo = "";
    $admin_name = "";
    $admin_id_display = "";
//Admin details from tbl_admin
    if(isset($_SESSION['aid'])) {
        $admin_id = $_SESSION['aid'];
        $query = "SELECT admin_photo FROM tbl_admin WHERE admin_id = '$admin_id'";
        $result = mysqli_query($con, $query);
     
        
        if($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $admin_photo = $row['admin_photo'];
        }
        
        if(isset($_SESSION['aname'])) 
            {
            $admin_name = $_SESSION['aname'];
            }
        $admin_id_display = $_SESSION['aid'];
    }

    //Handle Company Status
    if(isset($_GET["acid"])) {
        $quer = "UPDATE tbl_company SET company_status='1' WHERE company_id ='".$_GET["acid"]."'";
        if($con->query($quer)) {
            echo "<script>
            alert('Company Accepted Successfully!'); 
            window.location='AdminHome.php';
                   </script>";
        }
    }

    if(isset($_GET["rejid"])) {
        $quer = "UPDATE tbl_company SET company_status='2' WHERE company_id ='".$_GET["rejid"]."'";
        if($con->query($quer)) {
            echo "<script>alert('Company Rejected Successfully!'); window.location='AdminHome.php';</script>";
        }
    }
    ?>
<?php
//Handle User Status
     if(isset($_GET["auid"])) {
        $quer = "UPDATE tbl_user SET user_status='1' WHERE user_id ='".$_GET["auid"]."'";
        if($con->query($quer)) {
            echo "<script>
            alert('User Verified'); 
            window.location='AdminHome.php';
                   </script>";
        }
    }

    if(isset($_GET["rejuid"])) {
        $quer = "UPDATE tbl_user SET user_status='2' WHERE user_id ='".$_GET["rejuid"]."'";
        if($con->query($quer)) {
            echo "<script>alert('User Rejected'); window.location='AdminHome.php';</script>";
        }
    }
    ?>




    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Admin Profile  -->
        <div class="admin-profile">
        <img src="../Assets/Files/AdminPhoto/<?php echo !empty($admin_photo) ? $admin_photo : 'default-avatar.png'; ?>" alt="Admin Profile">
            <h3><?php echo !empty($admin_name) ? $admin_name : 'Admin User'; ?></h3>
            <small>ID: <?php echo !empty($admin_id_display) ? $admin_id_display : 'N/A'; ?></small>
                </div>

        <!-- Navigation Menu -->
        <ul class="nav-menu">
            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="AdminProfile.php"> 
                    <i class="mdi mdi-account-circle" style="margin-right: 10px;"></i>
                    <span class="menu-title">Profile</span>
                </a>
            </li>


            <!-- Complaints Section -->
            <li class="nav-item">
                <a class="nav-link" href="ViewComplaints.php"> 
                    <i class="mdi mdi-comment-alert-outline" style="margin-right: 10px;"></i>
                    <span class="menu-title">Complaints</span>
                </a>
            </li>

             <!--Job Reports -->
            <li class="nav-item">
                <a class="nav-link" href="JobReports.php"> 
                    <i class="mdi mdi-flag-outline" style="margin-right: 10px;"></i>
                    <span class="menu-title">Job Reports</span>
                </a>
            </li>





            <!-- Company Type Selection -->
            <li class="nav-item">
                <a class="nav-link" href="Companytype.php"> 
                    <i class="fas fa-building" style="margin-right: 10px;"></i>
                    <span class="menu-title">Company Type</span>
                </a>
            </li>

             <!-- Company Industry Selection -->
             <li class="nav-item">
                <a class="nav-link" href="CompanyIndustry.php"> 
                    <i class="fas fa-industry" style="margin-right: 10px;"></i>
                    <span class="menu-title">Company Industry</span>
                </a>
            </li>

            <!-- Job Category Selection -->
            <li class="nav-item">
                <a class="nav-link" href="Jobcategory.php">
                    <i class="mdi mdi-contacts menu-icon"></i>
                    <span class="menu-title">Job Category</span>
                </a>
            </li>

            <!-- Job Type Selection -->
            <li class="nav-item">
                <a class="nav-link" href="JobType.php">
                    <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                    <span class="menu-title">Job Type</span>
                </a>
            </li>

            <!-- Technical Skills -->
            <li class="nav-item">
                <a class="nav-link" href="TechnicalSkill.php">
                    <i class="mdi mdi-chart-bar menu-icon"></i>
                    <span class="menu-title">Technical Skills</span>
                </a>
            </li>

            <!-- Soft Skills -->
            <li class="nav-item">
                <a class="nav-link" href="SoftSkill.php">
                    <i class="mdi mdi-table-large menu-icon"></i>
                    <span class="menu-title">Soft Skills</span>
                </a>
            </li>

            <!-- Location -->
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="toggleSubmenu('location-submenu', this)">
                    <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                    <span class="menu-title">Location</span>
                    <i class="mdi mdi-chevron-down menu-arrow"></i>
                </a>
                <ul class="sub-menu" id="location-submenu">
                    <li class="nav-item">
                        <a class="nav-link" href="State.php">State</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="District.php">District</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="place.php">Place</a>
                    </li>
                </ul>
            </li>

            <!-- Languages -->
            <li class="nav-item">
                <a class="nav-link" href="Languages.php">
                    <i class="fas fa-language" style="margin-right: 10px;"></i>
                    <span class="menu-title">Languages</span>
                </a>
            </li>

            


            
            <!-- Job Listings -->
            <li class="nav-item">
                <a class="nav-link" href="JobListing.php">
                    <i class="mdi mdi-clipboard-list-outline" style="margin-right: 10px;"></i>
                    <span class="menu-title">Job Lists</span>
                </a>
            </li>

            <!-- Admin Registration -->
            <li class="nav-item">
                <a class="nav-link" href="AdminRegistration.php">
                    <i class="mdi mdi-account-plus menu-icon"></i>
                    <span class="menu-title">Admin Registration</span>
                </a>
            </li>
        </ul>
    </div>

     

     
    <!-- Main Content -->
    <div class="main-content">
        <!-- Header with Search Bar -->
        <div class="header">
            <div class="search-container">
                <i class="mdi mdi-magnify search-icon"></i>
                <input type="text" class="search-box" placeholder="Search companies, jobs, categories..." id="searchInput">
            </div>
        </div>

        <!-- Company Verificatio Area --------------------------------------------------------------->
        
         
        <div class="content-area">
            <h3 align="center" >COMPANY VERIFICATION </h3>
            <!-- Pending Companies Table -->
            <div class="table-container">
                <div class="table-header">
                    <i class="mdi mdi-clock-outline"></i> Pending Company Registrations
                </div>
                <div class="table-responsive">
                    <table class="table" >
                          

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
                                      WHERE c.company_status = '0'";
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
                                <td><?php echo $data['company_address'] ?></td>
                                <td><?php echo $data['company_date_join'] ?></td>
                                <td>
                                    <small>
                                       <?php echo htmlspecialchars($data['place_name']); ?><br>
                                       <?php echo  htmlspecialchars($data['district_name']); ?><br>
                                       <?php echo  htmlspecialchars($data['state_name']); ?>
                                    </small>
                                </td>
                                <td>
                                    <!--Logo & proof  -->
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
    <div class="action-buttons">
        <a href="?acid=<?php echo $data['company_id']; ?>" class="action-btn btn-accept" 
           onclick="return confirm('Verify Company?')">Accept</a>
        <a href="?rejid=<?php echo $data['company_id']; ?>" class="action-btn btn-reject" 
           onclick="return confirm('Reject Company?')">Reject</a>
    </div>
</td>
                            </tr>
                            <?php
                                }
                            } else {
                                echo '<tr><td colspan="10" class="text-center">No New Companies</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
 <p>
<a href="CompanyList.php" class="link-with-icon">
        <i class="fas fa-cog"></i>
        Edit Company List
        </a>        
</p>
  
<!-- USER VERIFICATION--------------------------------------------------------------------------- -->

  <div class="content-area">
            <h3 align="center" >USER VERIFICATION </h3>
            <div class="table-container">
                <div class="table-header">
                    <i class="mdi mdi-clock-outline"></i> New Users
                </div>
                <div class="table-responsive">
                    <table class="table" >
                          

                        <thead>
                            <tr>
                                <th>SINO</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Address</th>
                                <th>GENDER</th>
                                <th>PROFILE</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                    
     <?php
                            $i = 0;
                           $selqry="select * from tbl_user where user_status='0'";
                            $rows = $con->query($selqry);
                            
                            if($rows->num_rows > 0) {
                                while($data = $rows->fetch_assoc()) {
                                    $i++;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                               
                                <td><?php echo $data['user_name'] ?></td>	
                                <td><?php echo $data['user_email'] ?></td>
                                <td><?php echo $data['user_contact'] ?></td>
                                <td><?php echo $data['user_address'] ?></td>
                                <td><?php echo $data['user_gender'] ?></td> 
                                <td>
                                    <img src="../Assets/Files/UserPhoto/<?php echo $data['user_photo']; ?>" 
                                         alt="Logo" class="company-logo">
                                </td>
                               
                                <td>
                                    <a href="?auid=<?php echo $data['user_id']; ?>" class="action-btn btn-accept" 
                                       onclick="return confirm('Verify User?')">Accept</a>&nbsp
                                    <a href="?rejuid=<?php echo $data['user_id']; ?>" class="action-btn btn-reject" 
                                       onclick="return confirm('Reject User?')">Reject</a>&nbsp
                                   <br>
                                   
                                </td>
                            </tr>
                            <?php
                                }
                            } else {
                                echo '<tr><td colspan="10" class="text-center">No New Users</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
<p>
<a href=" UserList.php" class="link-with-icon">
        <i class="fas fa-cog"></i>
        Edit User List
        </a>        
</p>
 



    <!-- Bootstrap JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle submenu function
        function toggleSubmenu(submenuId, element) {
            event.preventDefault();
            const submenu = document.getElementById(submenuId);
            const arrow = element.querySelector('.menu-arrow');
            
            if (submenu.classList.contains('show')) {
                submenu.classList.remove('show');
                arrow.style.transform = 'rotate(0deg)';
            } else {
                submenu.classList.add('show');
                arrow.style.transform = 'rotate(180deg)';
            }
        }

        
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const tables = document.querySelectorAll('.table tbody');
            
            tables.forEach(table => {
                const rows = table.querySelectorAll('tr');
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });

        
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function() {
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });

      
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
        }
    </script>
</body>
</html>
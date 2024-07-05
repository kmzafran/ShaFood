<!DOCTYPE html>
<html lang="en">
<?php include '../Config/database.php'
?>
<?php

// Check if the staff ID is provided in the query string
if (isset($_GET['id'])) {
    $staffId = $_GET['id'];

    // Prepare the SQL statement to fetch staff details
    $sql = "SELECT * FROM STAFF WHERE STAFF_ID = :staffId";
    $stmt = oci_parse($dbconn, $sql);
    oci_bind_by_name($stmt, ":staffId", $staffId);

    // Execute the statement
    $result = oci_execute($stmt, OCI_DEFAULT);

    if ($result) {
        // Fetch the staff details
        $row = oci_fetch_assoc($stmt);

        // Populate the form fields with the fetched data
        $staffId = $row['STAFF_ID'];
        $staffName = $row['STAFFNAME'];
        $staffAddress = $row['STAFFADDRESS'];
        $staffPhone = $row['STAFFPNUM'];
        $staffGender = $row['STAFFGENDER'];
        $staffType = $row['STAFF_TYPE'];
        $staffUsername = $row['STAFFUNAME'];
    } else {
        echo "Error fetching staff details: " . oci_error($stmt);
    }

    // Free the statement
    oci_free_statement($stmt);
}

if (isset($_POST['updateStaffId'])) {
    // Get the form data for updating staff
    $staffId = $_POST["updateStaffId"];
    $staffName = $_POST["updateStaffName"];
    $staffAddress = $_POST["updateStaffAddress"];
    $staffPhone = $_POST["updateStaffPhone"];
    $staffGender = $_POST["updateStaffGender"];
    $staffType = $_POST["updateStaffType"];
    $staffUsername = $_POST["updateStaffUsername"];


    // Prepare the SQL statement
    $sql = "UPDATE STAFF SET STAFFNAME = :staffName, STAFFADDRESS = :staffAddress, STAFFPNUM = :staffPhone, STAFFGENDER = :staffGender, STAFF_TYPE = :staffType,STAFFUNAME = :staffUsername WHERE STAFF_ID = :staffId";
    $stmt = oci_parse($dbconn, $sql);

    // Bind the parameters
    oci_bind_by_name($stmt, ":staffId", $staffId);
    oci_bind_by_name($stmt, ":staffName", $staffName);
    oci_bind_by_name($stmt, ":staffAddress", $staffAddress);
    oci_bind_by_name($stmt, ":staffPhone", $staffPhone);
    oci_bind_by_name($stmt, ":staffGender", $staffGender);
    oci_bind_by_name($stmt, ":staffType", $staffType);
    oci_bind_by_name($stmt, ":staffUsername", $staffUsername);

    // Execute the statement
    $result = oci_execute($stmt, OCI_DEFAULT);

    if ($result) {

        oci_commit($dbconn);
        echo "<script>alert('Staff update successfully!');</script>";
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "Error updating staff: " . oci_error($stmt);
    }

    // Free the statement
    oci_free_statement($stmt);
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Staff</title>
    <!-- Bootstrap core CSS-->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.3/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="adminpage.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="adminpage.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Listings</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="staffList.php">Staff</a>
                        <a class="collapse-item" href="menupage.php">Menu</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Reports</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="dailycharts.php">Daily</a>
                        <a class="collapse-item" href="monthlycharts.php">Monthly</a>
                        <a class="collapse-item" href="annuallycharts.php">Annually</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-person-circle"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Update Staff</h1>
                    <p class="mb-4">Use the form below to update the staff details.</p>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Update Staff</h6>
                        </div>
                        <div class="card-body">
                            <form action="staffUpdateForm.php" method="post">
                                <input type="hidden" id="updateStaffId" name="updateStaffId" value="<?php echo $staffId; ?>">
                                <div class="mb-3">
                                    <label for="updateStaffName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="updateStaffName" name="updateStaffName" value="<?php echo $staffName; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="updateStaffAddress" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="updateStaffAddress" name="updateStaffAddress" value="<?php echo $staffAddress; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="updateStaffPhone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="updateStaffPhone" name="updateStaffPhone" value="<?php echo $staffPhone; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="updateStaffGender" class="form-label">Gender</label>
                                    <select class="form-control" id="updateStaffGender" name="updateStaffGender" required>
                                        <option value="">Select Gender</option>
                                        <option value="Male" <?php echo ($staffGender == 'Male') ? 'selected' : ''; ?>>Male</option>
                                        <option value="Female" <?php echo ($staffGender == 'Female') ? 'selected' : ''; ?>>Female</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="updateStaffType" class="form-label">Staff Type</label>
                                    <select class="form-control" id="updateStaffType" name="updateStaffType" required>
                                        <option value="">Select Staff Type</option>
                                        <option value="Assistant Manager" <?php echo ($staffType == 'Assistant Manager') ? 'selected' : ''; ?>>Assistant Manager</option>
                                        <option value="Worker" <?php echo ($staffType == 'Worker') ? 'selected' : ''; ?>>Worker</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="updateStaffUsername" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="updateStaffUsername" name="updateStaffUsername" value="<?php echo $staffUsername; ?>" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->


    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="adminloginpage.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.3/js/sb-admin-2.min.js"></script>
</body>

</html>
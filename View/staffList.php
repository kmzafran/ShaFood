<!DOCTYPE html>
<html lang="en">
<?php include '../Config/database.php' ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['addStaffName'])) {
        // Get the form data for adding staff
        $staffName = $_POST["addStaffName"];
        $staffAddress = $_POST["addStaffAddress"];
        $staffPhone = $_POST["addStaffPhone"];
        $staffGender = $_POST["addStaffGender"];
        $staffUsername = $_POST["addStaffUsername"];

        // Prepare the SQL statement
        $sql = "INSERT INTO STAFF(STAFF_ID, STAFFNAME, STAFFADDRESS, STAFFPNUM, STAFFGENDER, SUPERVISOR_ID, STAFF_TYPE, STAFFUNAME, STAFFPASS) VALUES (STAFF_SEQ.NEXTVAL, :staffName, :staffAddress, :staffPhone, :staffGender, '1', :staffUsername, 'qwert')";
        $stmt = oci_parse($dbconn, $sql);

        // Bind the parameters
        oci_bind_by_name($stmt, ":staffName", $staffName);
        oci_bind_by_name($stmt, ":staffAddress", $staffAddress);
        oci_bind_by_name($stmt, ":staffPhone", $staffPhone);
        oci_bind_by_name($stmt, ":staffGender", $staffGender);
        oci_bind_by_name($stmt, ":staffUsername", $staffUsername);

        // Execute the statement
        $result = oci_execute($stmt, OCI_DEFAULT);

        if ($result) {
            oci_commit($dbconn);
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "Error adding staff: " . oci_error($stmt);
        }

        // Free the statement
        oci_free_statement($stmt);
    } elseif (isset($_POST['updateStaffId'])) {
        // Get the form data for updating staff
        $staffId = $_POST["updateStaffId"];
        $staffName = $_POST["updateStaffName"];
        $staffAddress = $_POST["updateStaffAddress"];
        $staffPhone = $_POST["updateStaffPhone"];
        $staffGender = $_POST["updateStaffGender"];
        $staffUsername = $_POST["updateStaffUsername"];

        // Prepare the SQL statement
        $sql = "UPDATE STAFF SET STAFFNAME = :staffName, STAFFADDRESS = :staffAddress, STAFFPNUM = :staffPhone, STAFFGENDER = :staffGender, STAFFUNAME = :staffUsername WHERE STAFF_ID = :staffId";
        $stmt = oci_parse($dbconn, $sql);

        // Bind the parameters
        oci_bind_by_name($stmt, ":staffId", $staffId);
        oci_bind_by_name($stmt, ":staffName", $staffName);
        oci_bind_by_name($stmt, ":staffAddress", $staffAddress);
        oci_bind_by_name($stmt, ":staffPhone", $staffPhone);
        oci_bind_by_name($stmt, ":staffGender", $staffGender);
        oci_bind_by_name($stmt, ":staffUsername", $staffUsername);

        // Execute the statement
        $result = oci_execute($stmt, OCI_DEFAULT);

        if ($result) {
            oci_commit($dbconn);
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "Error updating staff: " . oci_error($stmt);
        }

        // Free the statement
        oci_free_statement($stmt);
    } elseif (isset($_POST['deleteStaffId'])) {
        // Get the form data for deleting staff
        $staffId = $_POST["deleteStaffId"];

        // Prepare the SQL statement
        $sql = "DELETE FROM STAFF WHERE STAFF_ID = :staffId";
        $stmt = oci_parse($dbconn, $sql);

        // Bind the parameters
        oci_bind_by_name($stmt, ":staffId", $staffId);

        // Execute the statement
        $result = oci_execute($stmt, OCI_DEFAULT);

        if ($result) {
            oci_commit($dbconn);
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "Error deleting staff: " . oci_error($stmt);
        }

        // Free the statement
        oci_free_statement($stmt);
    }
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
                        <a class="collapse-item" href="tables.php">Staff</a>
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
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1><strong>STAFF LIST</strong></h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"></h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-6 mb-4">
                                            <table class="table table-hover table-bordered">
                                                <a href="staffAddForm.php" class="btn btn-primary">Add Staff</a>
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Staff ID</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Address</th>
                                                        <th scope="col">Phone Number</th>
                                                        <th scope="col">Gender</th>
                                                        <th scope="col">Staff Type</th>
                                                        <th scope="col">Staff Username</th>
                                                        <th scope="col">Staff Password</th>
                                                        <th scope="col">Supervisor ID</th>
                                                        <th scope="col">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql = "SELECT STAFF_ID, STAFFNAME, STAFFADDRESS, STAFFPNUM, STAFFGENDER, STAFF_TYPE, STAFFUNAME, STAFFPASS, SUPERVISOR_ID FROM STAFF";
                                                    $stid = oci_parse($dbconn, $sql);
                                                    oci_execute($stid);

                                                    while ($row = oci_fetch_assoc($stid)) {
                                                        echo "<tr>";
                                                        echo "<th scope='row'>" . htmlspecialchars($row["STAFF_ID"], ENT_QUOTES, 'UTF-8') . "</th>";
                                                        echo "<td>" . htmlspecialchars($row["STAFFNAME"], ENT_QUOTES, 'UTF-8') . "</td>";
                                                        echo "<td>" . htmlspecialchars($row["STAFFADDRESS"], ENT_QUOTES, 'UTF-8') . "</td>";
                                                        echo "<td>" . htmlspecialchars($row["STAFFPNUM"], ENT_QUOTES, 'UTF-8') . "</td>";
                                                        echo "<td>" . htmlspecialchars($row["STAFFGENDER"], ENT_QUOTES, 'UTF-8') . "</td>";
                                                        echo "<td>" . htmlspecialchars($row["STAFF_TYPE"], ENT_QUOTES, 'UTF-8') . "</td>";
                                                        echo "<td>" . htmlspecialchars($row["STAFFUNAME"], ENT_QUOTES, 'UTF-8') . "</td>";
                                                        echo "<td>" . htmlspecialchars($row["STAFFPASS"], ENT_QUOTES, 'UTF-8') . "</td>";
                                                        echo "<td>" . htmlspecialchars($row["SUPERVISOR_ID"], ENT_QUOTES, 'UTF-8') . "</td>";
                                                        echo "<td class='text-center'>";
                                                        echo "<a href='staffUpdateForm.php?id=" . $row["STAFF_ID"] . "' class='btn btn-success btn-update rounded-pill'>Update</a>";
                                                        echo "<button class='btn btn-danger btn-delete rounded-pill' data-id='" . $row["STAFF_ID"] . "' data-bs-toggle='modal' data-bs-target='#deleteModal'>Delete</button>";
                                                        echo "</td>";
                                                        echo "</tr>";
                                                    }

                                                    if (oci_num_rows($stid) == 0) {
                                                        echo "<tr><td colspan='8'>No staff found</td></tr>";
                                                    }

                                                    oci_free_statement($stid);
                                                    CloseConn($dbconn);
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- Update Modal -->
                                        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="updateModalLabel">Update Staff Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="updateForm" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                            <input type="hidden" id="updateStaffId" name="updateStaffId">
                                                            <div class="mb-3">
                                                                <label for="updateStaffName" class="form-label">Name</label>
                                                                <input type="text" class="form-control" id="updateStaffName" name="updateStaffName" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="updateStaffAddress" class="form-label">Address</label>
                                                                <input type="text" class="form-control" id="updateStaffAddress" name="updateStaffAddress" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="updateStaffPhone" class="form-label">Phone Number</label>
                                                                <input type="text" class="form-control" id="updateStaffPhone" name="updateStaffPhone" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="updateStaffGender" class="form-label">Gender</label>
                                                                <select class="form-control" id="updateStaffGender" name="updateStaffGender" required>
                                                                    <option value="">Select Gender</option>
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="updateStaffUsername" class="form-label">Username</label>
                                                                <input type="text" class="form-control" id="updateStaffUsername" name="updateStaffUsername" required>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Delete Staff</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete this staff member?</p>
                                                        <form id="deleteForm" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                            <input type="hidden" id="deleteStaffId" name="deleteStaffId">
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            document.querySelectorAll('.btn-add').forEach(button => {
                                                button.addEventListener('click', function() {
                                                    const staffId = this.getAttribute('data-id');
                                                    document.getElementById('addStaffId').value = staffId;
                                                });
                                            });

                                            document.querySelectorAll('.btn-update').forEach(button => {
                                                button.addEventListener('click', function() {
                                                    const staffId = this.getAttribute('data-id');
                                                    document.getElementById('updateStaffId').value = staffId;
                                                });
                                            });

                                            document.querySelectorAll('.btn-delete').forEach(button => {
                                                button.addEventListener('click', function() {
                                                    const staffId = this.getAttribute('data-id');
                                                    document.getElementById('deleteStaffId').value = staffId;
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
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

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

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
    <!-- Include Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
</body>

</html>
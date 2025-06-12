<?php 
    include '../config.php'; 
    include '../../dbconnect.php';
    // Ensure $pdo is defined
    if (!isset($pdo)) {
        die('Database connection not established.');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>IT_Blog</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include '../sidebar.php';?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include '../navbar.php';?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="container mt-5">
                        <h3 class="text-center mb-4">Student <strong>Details</strong></h3>
                        <table id="studentTable" class="table table-bordered table-striped">
                            <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $dsn = $pdo->query("SELECT * FROM students ORDER BY id DESC");
                                    $students = $dsn->fetchAll(PDO::FETCH_ASSOC);
                                    // print_r($students);
                                    $i=1;
                                    foreach ($students as $student):
                                ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= htmlspecialchars($student['name']) ?></td>
                                <td><?= htmlspecialchars($student['gender']) ?></td>
                                <td><?= htmlspecialchars($student['address']) ?></td>
                                <td><?= htmlspecialchars($student['created_at']) ?></td>
                                <td>
                                    <a href="" class="text-primary me-2" data-bs-toggle="modal" data-bs-target="#viewModal<?= $student['id'] ?>"><i class="fas fa-eye"></i></a>
                                    <a href="" class="text-warning me-2" data-bs-toggle="modal" data-bs-target="#editModal<?= $student['id'] ?>"><i class="fas fa-edit"></i></a>
                                    <a href="" class="text-danger me-2" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $student['id'] ?>"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            <!-- View Modal -->
                            <div class="modal fade" id="viewModal<?= $student['id'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title">Student Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                    <p><strong>Name:</strong> <?= htmlspecialchars($student['name']) ?></p>
                                    <p><strong>Gender:</strong> <?= htmlspecialchars($student['gender']) ?></p>
                                    <p><strong>Address:</strong> <?= htmlspecialchars($student['address']) ?></p>
                                    <p><strong>Registered At:</strong> <?= htmlspecialchars($student['created_at']) ?></p>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal<?= $student['id'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="container mt-5">
                                        <!-- <div class="card shadow"> -->
                                            <div class="modal-header bg-primary text-white">
                                            <form action="#" method="POST">
                                                <input type="hidden" name="id" value="<?= $student['id'] ?>">
                                                <div class="mb-3">
                                                <label for="name" class="form-label">Full Name</label>
                                                <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($student['name']) ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                <label for="name" class="form-label">Full Name</label>
                                                <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($student['name']) ?>" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Gender</label><br>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" name="gender" id="male<?= $student['id'] ?>" value="Male" class="form-check-input" <?= ($student['gender'] === 'Male') ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="male<?= $student['id'] ?>">Male</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" name="gender" id="female<?= $student['id'] ?>" value="Female" class="form-check-input" <?= ($student['gender'] === 'Female') ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="female<?= $student['id'] ?>">Female</label>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="address" class="form-label">Address</label>
                                                    <textarea name="address" id="address" rows="3" class="form-control"><?= htmlspecialchars($student['address']) ?></textarea>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </form>
                                            </div>
                                        </div>
                                    </div>     
                                </div>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal<?= $student['id'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">x</button>
                                    </div>
                                    <div class="modal-body">
                                    Are you sure you want to delete <strong><?= htmlspecialchars($student['name']) ?></strong>?
                                    </div>
                                    <div class="modal-footer">
                                    <a href="delete.php?id=<?= $student['id'] ?>" class="btn btn-danger">Yes, Delete</a>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                                <?php endforeach; ?>
                            </tbody>
                        </table>                        
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include '../footer.php';?>               
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap popover JavaScript-->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- another script -->
    <script>
    $(document).ready(function () {
        $('#studentTable').DataTable({
            "dom": 'tp', // Only show the table (no length, filter, info, pagination)
            // If you want pagination but not the other controls, use: "dom": 'tp'
        });
    });
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- ✅ jQuery (MUST be first) -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- ✅ DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- ✅ Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- ✅ Your script that calls $('#studentTable').DataTable() -->
    <script>
    $(document).ready(function () {
        $('#studentTable').DataTable({
            // your options here
        });
    });
    </script>

</body>

</html>
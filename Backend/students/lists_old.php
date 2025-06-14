<?php
    include '../config.php'; 
    include '../../dbconnect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Sanitize and validate input
        $id      = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $name    = isset($_POST['Name']) ? trim($_POST['Name']) : '';
        $gender  = isset($_POST['gender']) ? trim($_POST['gender']) : '';
        $address = isset($_POST['address']) ? trim($_POST['address']) : '';

        if ($id === 0 || empty($name) || empty($gender) || empty($address)) {
            die('All fields are required.');
        }

        try {
            $stmt = $pdo->prepare("UPDATE students SET name = :name, gender = :gender, address = :address WHERE id = :id");
            $stmt->execute([
                'name'    => htmlspecialchars($name),
                'gender'  => htmlspecialchars($gender),
                'address' => htmlspecialchars($address),
                'id'      => $id
            ]);
            echo 'success'; // For AJAX success
        } catch (PDOException $e) {
            http_response_code(500);
            echo 'Database error: ' . $e->getMessage();
        }
    } else {
        http_response_code(405); // Method Not Allowed
        echo 'Invalid request method.';
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
                                <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title">Student Details</h5>
                                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
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
                            <div class="modal fade" id="editModal<?= $student['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $student['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- wider modal -->
                                    <div class="modal-content shadow-lg rounded-4 border-0">
                                    
                                    <div class="modal-header bg-warning text-dark rounded-top-4">
                                        <h5 class="modal-title fw-bold" id="editModalLabel<?= $student['id'] ?>">Edit Student</h5>
                                        <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>

                                    <form method="post" class="edit-student-form">
                                        <div class="modal-body p-4">
                                        <input type="hidden" name="id" value="<?= $student['id'] ?>">

                                        <div class="row g-3">
                                            <!-- Name -->
                                            <div class="col-md-12">
                                            <label for="name<?= $student['id'] ?>" class="form-label fw-semibold">Name</label>
                                            <input type="text" class="form-control rounded-pill px-4" id="name<?= $student['id'] ?>" name="Name" value="<?= htmlspecialchars($student['name']) ?>" required>
                                            </div>

                                            <!-- Gender -->
                                            <div class="col-md-12">
                                            <label class="form-label fw-semibold">Gender</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="male<?= $student['id'] ?>" value="Male" required <?= $student['gender'] === 'Male' ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="male<?= $student['id'] ?>">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="female<?= $student['id'] ?>" value="Female" <?= $student['gender'] === 'Female' ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="female<?= $student['id'] ?>">Female</label>
                                            </div>
                                            </div>

                                            <!-- Address -->
                                            <div class="col-md-12">
                                            <label for="address<?= $student['id'] ?>" class="form-label fw-semibold">Address</label>
                                            <textarea class="form-control rounded-3" id="address<?= $student['id'] ?>" name="address" rows="3" required><?= htmlspecialchars($student['address']) ?></textarea>
                                            </div>
                                        </div>
                                        </div>

                                        <div class="modal-footer bg-light rounded-bottom-4 py-3 px-4">
                                        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary rounded-pill px-4">Update</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>


                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal<?= $student['id'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $student['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="deleteModalLabel<?= $student['id'] ?>">Delete Confirmation</h5>
                                        <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete <strong><?= htmlspecialchars($student['name']) ?></strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="delete.php" method="POST">
                                        <input type="hidden" name="id" value="<?= $student['id'] ?>">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                        </form>
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

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#studentTable').DataTable({
                "order": [[0, "asc"]], // Order by the first column (ID)
                "pageLength": 10 // Show 10 entries per page
            });
        });
    </script>

    <!-- modal fade -->
    <script>
        $(document).ready(function() {
            $('.modal').on('shown.bs.modal', function () {
                $(this).find('input:first').focus();
            });
        });
    </script>

    <!-- <script>
        $(document).ready(function() {
            $('.edit-student-form').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var formData = form.serialize();

                $.ajax({
                    type: 'POST',
                    url: '', // same page
                    data: formData,
                    success: function(response) {
                        if (response.trim() === 'success') {
                            alert('Student updated successfully!');
                            location.reload(); // Optional: or update row via JS
                        } else {
                            alert('Failed: ' + response);
                        }
                    },
                    error: function() {
                        alert('An error occurred while updating.');
                    }
                });
            });
        });
    </script> -->

    <!-- bootstrap modal script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



</body>

</html>
<?php
// Database connection
    include 'config.php'; 
    $conn = mysqli_connect("localhost", "root", "", "itblog_db");

// ADD Task
if (isset($_POST['add'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    if (!empty($name)) {
        mysqli_query($conn, "INSERT INTO tasks (name) VALUES ('$name')");
    }
    header("Location: todo.php");
    exit();
}

// DELETE Task
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    mysqli_query($conn, "DELETE FROM tasks WHERE id = $id");
    header("Location: todo.php");
    exit();
}

// TOGGLE Status
if (isset($_GET['toggle'])) {
    $id = (int)$_GET['toggle'];
    $result = mysqli_query($conn, "SELECT status FROM tasks WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
    $new_status = ($row['status'] === 'done') ? 'pending' : 'done';
    mysqli_query($conn, "UPDATE tasks SET status = '$new_status' WHERE id = $id");
    header("Location: todo.php");
    exit();
}

// UPDATE Task
if (isset($_POST['update'])) {
    $id = (int)$_POST['id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    mysqli_query($conn, "UPDATE tasks SET name = '$name' WHERE id = $id");
    header("Location: todo.php");
    exit();
}

// Get all tasks
$tasks = mysqli_query($conn, "SELECT * FROM tasks ORDER BY id DESC");
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
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'sidebar.php';?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'navbar.php';?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="container mt-5">
                        <h2 class="h3 mb-4 text-gray-800">To-Do Lists</h2>

                        <!-- Add Task -->
                        <form method="POST" class="d-flex gap-2 mb-4">
                            <input type="text" name="name" class="form-control" placeholder="Enter task name" required>
                            <button type="submit" name="add" class="btn btn-primary">Add</button>
                        </form>

                        <!-- Task List -->
                        <ul class="list-group">
                            <?php while ($row = mysqli_fetch_assoc($tasks)): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <?php if (isset($_GET['edit']) && $_GET['edit'] == $row['id']): ?>
                                            <!-- Edit Form -->
                                            <form method="POST" class="d-flex">
                                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                <input type="text" name="name" class="form-control me-2" value="<?= htmlspecialchars($row['name']) ?>" required>
                                                <button type="submit" name="update" class="btn btn-success btn-sm me-2">Save</button>
                                                <a href="todo.php" class="btn btn-secondary btn-sm">Cancel</a>
                                            </form>
                                        <?php else: ?>
                                            <span style="<?= $row['status'] === 'done' ? 'text-decoration: line-through;' : '' ?>">
                                                <?= htmlspecialchars($row['name']) ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!isset($_GET['edit']) || $_GET['edit'] != $row['id']): ?>
                                        <div>
                                            <a href="?toggle=<?= $row['id'] ?>" class="btn btn-sm btn-outline-<?= $row['status'] === 'done' ? 'warning' : 'success' ?>">
                                                <?= $row['status'] === 'done' ? 'Undo' : 'Done' ?>
                                            </a>
                                            <a href="?edit=<?= $row['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                            <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this task?')">Delete</a>
                                        </div>
                                    <?php endif; ?>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include 'footer.php';?>               
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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
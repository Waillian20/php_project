<?php 
    include '../config.php'; 
    include '../../dbconnect.php';
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

    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
                    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="">official DataTables documentation</a>.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $dsn = $pdo->query("SELECT posts.*,users.name AS author_name, categories.name AS categories_name FROM posts LEFT JOIN users ON posts.author_id = users.id LEFT JOIN categories ON posts.category_id = categories.id ORDER BY id DESC");
                                            $posts = $dsn->fetchAll(PDO::FETCH_ASSOC);
                                            // print_r($posts);
                                            $i=1;
                                            foreach ($posts as $post):
                                        ?>
                                        <tr class="text-gray-800">
                                            <td class="align-middle"><?= $i++ ?></td>
                                            <td class="align-middle"><?= htmlspecialchars($post['title']) ?></td>
                                            <td class="align-middle"><?= htmlspecialchars($post['author_name']) ?></td>
                                            <td class="align-middle"><?= htmlspecialchars($post['categories_name']) ?></td>
                                            <td class="align-middle">
                                                <?= htmlspecialchars($post['status']) ?>
                                                <p><?= htmlspecialchars($post['created_at']) ?></p>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a href="" class="text-primary me-2" data-bs-toggle="modal" data-bs-target="#viewModal<?= $post['id'] ?>"><i class="fas fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        <!-- View Modal -->
                                        <div class="modal fade" id="viewModal<?= $post['id'] ?>" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered container">
                                                <!-- <div class="card-body border bg-white p-4"> -->
                                                    <div class="col-12">
                                                        <article>
                                                        <div class="card border-0">
                                                            <div class="card-body border bg-white p-4">
                                                                <div class="entry-header mb-3">
                                                                    <ul class="entry-meta list-unstyled d-flex mb-2">
                                                                        <li>
                                                                            <p class="link-primary text-decoration-none" href="#!"><?= htmlspecialchars($post['status']) ?></p>
                                                                        </li>
                                                                    </ul>
                                                                    <h2 class="card-title entry-title h4 mb-0">
                                                                        <a class="link-dark text-decoration-none" href="#!"><?= htmlspecialchars($post['title']) ?></a>
                                                                    </h2>
                                                                </div>
                                                                <p class="card-text entry-summary text-secondary">
                                                                    <?= htmlspecialchars($post['content']) ?>
                                                                </p>
                                                            </div>
                                                            <div class="card-footer border border-top-0 bg-white p-4">
                                                                <ul class="entry-meta list-unstyled d-flex align-items-center m-0">
                                                                    <li>
                                                                        <a class="fs-7 link-secondary text-decoration-none d-flex align-items-center" href="#!">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                                                                                <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857z"/>
                                                                                <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                                                                            </svg>
                                                                            <span class="ms-2 fs-7"><?= htmlspecialchars($post['created_at']) ?></span>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <span class="px-3">&bull;</span>
                                                                    </li>
                                                                    <li>
                                                                        <a class="link-secondary text-decoration-none d-flex align-items-center" href="#!">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard-fill pe-4" viewBox="0 0 16 16">
                                                                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm9 1.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4a.5.5 0 0 0-.5.5M9 8a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4A.5.5 0 0 0 9 8m1 2.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5m-1 2C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 0 2 13h6.96q.04-.245.04-.5M7 6a2 2 0 1 0-4 0 2 2 0 0 0 4 0"/>
                                                                            </svg>
                                                                            <span class="ms-2 fs-7"><?= htmlspecialchars($post['author_name']) ?></span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        </article>
                                                    </div>
                                                <!-- </div> -->
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

    <!-- modal fade -->
    <script>
        $(document).ready(function() {
            $('.modal').on('shown.bs.modal', function () {
                $(this).find('input:first').focus();
            });
        });
    </script>

    <!-- bootstrap modal script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
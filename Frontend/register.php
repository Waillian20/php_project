<?php 
  include '../dbconnect.php';
  session_start();
  $errors = [];
  if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $confirmPassword = htmlspecialchars($_POST['confirm_password']);
    // echo $name .','. $email .','. $password .','. $confirmPassword;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute([
      'email' => $email
    ]);
    $user = $stmt->fetch(); // boolean - false
    // var_dump($user);
    if($password != $confirmPassword) { // password not match
      $errors['password'] = 'Password not match';
      // header('Location: register.php');
      // var_dump($errors);
      // exit();
    } else if ($user) { // email exist
      $errors['email'] = 'Email already exist';
      // header('Location: register.php');
      // var_dump($errors);
      // exit();
    } else { // email not exist
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      // echo $hashedPassword;
      $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
      $stmt->execute([
        'name' => $name,
        'email' => $email,
        'password' => $hashedPassword
      ]);
      header('Location: login.php');
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Blog Home - Start Bootstrap Template</title>
        <!-- Favicon-->
        <!-- <link rel="icon" type="image/x-icon" href="assets/favicon.ico" /> -->
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <!-- Custom fonts for this template-->
        <link href="../Backend/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="../Backend/css/sb-admin-2.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <!-- Responsive navbar-->
        <?php include 'navbar.php';?>

        <!-- Page content-->
        <div class="container">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-5 d-none d-lg-block bg-register-image">
                            <img src="https://imgs.search.brave.com/zgINnEBlktx6r08vwYovRRzRRIaDlbCQ8pUlg10iC34/rs:fit:500:0:0:0/g:ce/aHR0cHM6Ly9jZG5p/Lmljb25zY291dC5j/b20vaWxsdXN0cmF0/aW9uL3ByZW1pdW0v/dGh1bWIvcHJvZmls/ZS1sb2dpbi1pbGx1/c3RyYXRpb24tZG93/bmxvYWQtaW4tc3Zn/LXBuZy1naWYtZmls/ZS1mb3JtYXRzLS1h/Y2NvdW50LXNpZ24t/dXNlci1taXNjZWxs/YW5lb3VzLXBhY2st/aWxsdXN0cmF0aW9u/cy01MjEwMzM5LnBu/Zz9mPXdlYnA" alt="Login Image" class="img-fluid my-5">
                        </div>
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                </div>
                                <form class="user" Method="POST" action="#">
                                    <div class="form-group">
                                        <input type="name" name="name" class="form-control form-control-user" id="exampleInputName"
                                            placeholder="Username" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail"
                                            placeholder="Email Address" required>
                                        <div class="text-danger">
                                            <?php if (isset($errors['email'])) { echo $errors['email']; } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" name="confirm_password" class="form-control form-control-user"
                                                id="exampleRepeatPassword" placeholder="Confirm Password" required>
                                            <?php if (isset($errors['password'])) { echo $errors['password']; } ?>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" name="role" class="form-control form-control-user"
                                                id="exampleInputRole" value="author" required hidden>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Register Account
                                    </button>
                                    <hr>
                                    <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                        <i class="fab fa-google fa-fw"></i> Register with Google
                                    </a>
                                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                        <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                    </a> -->
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="#">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="#">Already have an account? Login!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
           
        </div>
        <!-- Footer-->
        <?php include 'footer.php';?>
        <!-- Bootstrap core JS-->
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> -->
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- Bootstrap core JavaScript-->
        <script src="../Backend/vendor/jquery/jquery.min.js"></script>
        <script src="../Backend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="../Backend/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="../Backend/js/sb-admin-2.min.js"></script>
    </body>
</html>

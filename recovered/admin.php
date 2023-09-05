<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS  link-->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/media.css">
    <title>SiliconByte</title>
</head>

<body>
    <!-- header start-->
    <header>
        <?php
        session_start();
        ?>
        <div class="container">
<!-- nav start-->
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
          <!--logo-->
          <a class="navbar-brand logoa" href="index.php">
            <img src="images/logo.png" class="img-fluid logo" alt="siliconbyte">
          </a>
          <!-- hambarger btn-->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav_c"
            aria-controls="nav_c" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <!--nav items-->

          <div class="collapse navbar-collapse menu" id="nav_c">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active-link" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="articles.php">Articles</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="catagories.php">Catagories</a>
              </li>
              <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if ($_SESSION['role'] == "writer"): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="post.php">Post</a>
                        </li>
                    <?php else: ?>
                        <?php if ($_SESSION['role'] == "admin"): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="admin.php">Admin</a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signout.php">Sign Out</a>
                    </li>

                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="signup_page.php">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signin_page.php">Sign In</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

            <?php

            if (isset($_SESSION['error'])) {
                $error = $_SESSION['error'];

                echo '<div class="error"><h5>' . $error . '</h5></div>';

                unset($_SESSION['error']);
            } else if (isset($_SESSION['success'])) {
                $success = $_SESSION['success'];

                echo '<div class="success">
        <h5>' . $success . '</h5>
      </div>';

                unset($_SESSION['success']);
            }

            ?>
            <!-- nav end-->
        </div>
    </header>
    <!-- header end-->

    <!-- footer start-->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12">
                    <address class="f_1">
                        <p>HALOVIETNAM LTD <br> 66, Dang Van ngu, Dong Da <br> Hanoi, Vietnam</p>

                        <p>contact@halovietnam.com</p>
                        <p>+844 35149182</p>
                    </address>

                </div>
                <div class="col-lg col-md col-6">
                    <div class="f_2">
                        <ul class="list-unstyled">
                            <li> <a href="#">Examples</a></li>
                            <li> <a href="#">Shop </a></li>
                            <li> <a href="#">License </a></li>
                        </ul>
                    </div>

                </div>

                <div class="col-lg col-md col-6">

                    <div class="f_2">
                        <ul class="list-unstyled">
                            <li> <a href="#">Contact</a></li>
                            <li> <a href="#"> About</a></li>
                            <li> <a href="#"> Privacy</a></li>
                            <li> <a href="#"> Terms </a></li>
                        </ul>
                    </div>

                </div>
                <div class="col-lg col-md col-6">

                    <div class="f_2">
                        <ul class="list-unstyled">
                            <li> <a href="#"> Download </a></li>
                            <li> <a href="#">Support </a></li>
                            <li> <a href="#"> Documents </a></li>
                        </ul>
                    </div>

                </div>
                <div class="col-lg col-md col-6">

                    <div class="f_2">
                        <ul class="list-unstyled">
                            <li> <a href="#"> Media </a></li>
                            <li> <a href="#"> Blog </a></li>
                            <li> <a href="#"> Forums </a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </footer>
    <!-- footer end-->

    <!--  Bootstrap JS link -->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/c204687a77.js" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>

</body>

</html>
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

<body style="background-color: #d6d6d6;">
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

    <!-- contact start-->
    <section class="custom-form" id="custom-form">
        <div class="container">
            <!-- 1st row-->
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="c_title text-center">
                        <h1 class="c_h1">Sign Up for SiliconByte</h1>
                        <p class="c_p ash">Enter Your Details</p>
                    </div>
                </div>
            </div>
            <!-- 2nd row-->
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="c_form">
                        <form method="POST" action="signup.php" enctype="multipart/form-data">

                            <div class="row g-3 justify-content-center">
                                <div class="col-lg-8 col-md-8 d-flex justify-content-center align-items-center">
                                    <input type="file" id="profile-photo-input" name="profile_photo" accept="image/*"
                                        required>
                                    <label for="profile-photo-input" class="profile-photo-label">
                                        <div class="profile-photo-preview">
                                            <img id="profile-photo-preview" class="rounded-circle"
                                                src="#" />
                                        </div>
                                    </label>
                                </div>

                                <div class="col-lg-8 col-md-8">
                                    <input type="name" class="form-control c_email" placeholder="Enter Your Full Name"
                                        name="fullname" required>
                                </div>
                                <div class="col-lg-8 col-md-8">
                                    <input type="username" class="form-control c_email"
                                        placeholder="Enter Your Username" name="username" required>
                                </div>
                                <div class="col-lg-8 col-md-8">
                                    <input type="email" class="form-control c_email" placeholder="Enter Your Email"
                                        name="email" required>
                                </div>
                                <div class="col-lg-8 col-md-8">
                                    <input type="password" class="form-control c_email"
                                        placeholder="Enter Your Password" name="password" required>
                                </div>
                                <div class="col-lg-8 col-md-8">
                                    <input type="password" class="form-control c_email"
                                        placeholder="Confirm Your Password" name="confirm_password" required>
                                </div>
                                <div class="col-lg-8 col-md-8">
                                    Already Have An Account? <a href="#" class="small-button-link">
                                        Sign In
                                    </a>
                                </div>
                            </div>
                            <div class="row g-3 justify-content-center" style="margin-top: 20px;">
                                <button type="submit" class="btn button-link" name="signupBtn">Sign Up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact end-->

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
    <script>
        // JavaScript to display selected profile photo
        document.getElementById('profile-photo-input').addEventListener('change', function () {
            var preview = document.getElementById('profile-photo-preview');
            var file = this.files[0];
            var reader = new FileReader();

            reader.onload = function () {
                preview.style.backgroundImage = 'url(' + reader.result + ')';
                preview.style.backgroundSize = 'cover';
                preview.style.display = 'block';
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        });
    </script>


</body>

</html>
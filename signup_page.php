<?php
session_start();
?>
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
    <title>সিলিকনবাইট</title>
</head>

<body>
    <!-- header start-->
    <header>
        <div class="container">
            <!-- nav start-->
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <!--logo-->
                    <a class="navbar-brand" href="index.php">
                        <img src="images/stock/logo.png" class="img-fluid logo" alt="সিলিকনবাইট">
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
                                <a class="nav-link" href="index.php">হোম</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="articles.php">সব খবর</a>
                            </li>
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <?php if ($_SESSION['role'] == "writer"): ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="post_page.php">লিখুন</a>
                                    </li>
                                <?php endif; ?>
                                <?php if ($_SESSION['role'] == "admin"): ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="admin.php">ব্যাবস্থাপনা</a>
                                    </li>
                                <?php endif; ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="profile.php">প্রোফাইল</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="signout.php">সাইনআউট</a>
                                </li>
                            <?php else: ?>
                                <li class="nav-item">
                                    <a class="nav-link active-link" href="signup_page.php">সাইনআপ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="signin_page.php">সাইনইন</a>
                                </li>
                            <?php endif; ?>

                        </ul>

                    </div>
                </div>
            </nav>

            <!-- nav end-->
        </div>
    </header>
    <!-- header end-->
    <!-- Error message display -->
    <section class="message">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <?php
                    if (!empty($_GET['error'])) {
                        $errorMessage = urldecode($_GET['error']);
                        echo '<div class="alert alert-danger text-center" role="alert">' . $errorMessage . '</div>';
                    }
                    if (!empty($_GET['success'])) {
                        $successMessage = urldecode($_GET['success']);
                        echo '<div class="alert alert-success text-center" role="alert">' . $successMessage . '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Error message display end -->


    <!-- contact start-->
    <section class="custom-form-section" id="signin">
        <div class="container">
            <!-- 1st row-->
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="c_title text-center">
                        <h1 class="c_h1 yellow form-title">সাইন আপ করুন</h1>
                        <p class="c_p ash">আপনার তথ্য দিন</p>
                    </div>
                </div>
            </div>
            <!-- 2nd row-->
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="c_form">
                        <form method="POST" action="signup.php" enctype="multipart/form-data">
                            <div class="row g-3 justify-content-center">
                                <!-- Image Preview -->
                                <div class="col-lg-8 col-md-8 d-flex justify-content-center align-items-center">
                                    <label for="profile-picture" class="form-label"></label>
                                    <input type="file" class="form-control" id="profile-picture" name="profile-picture"
                                        accept="image/*" style="display: none;" onchange="previewImage(this);">
                                    <!-- Wrap the image and apply circular cropping within a div -->
                                    <div id="image-preview-wrapper">
                                        <!-- Wrap the image preview within a label element to make it clickable -->
                                        <label for="profile-picture" id="image-preview-label">
                                            <img id="image-preview" src="#" alt="আপনার ফটো প্রিভিউ">
                                            <span id="upload-text">প্রোফাইল ছবির জন্য<br>এখানে ক্লিক করুন</span>
                                        </label>
                                    </div>
                                </div>
                                <!-- Image Preview -->

                                <div class="col-lg-8 col-md-8">
                                    <input type="name" class="form-control c_email" placeholder="আপনার পুরো নাম লিখুন"
                                        name="name" required>
                                </div>
                                <div class="col-lg-8 col-md-8">
                                    <input type="username" class="form-control c_email"
                                        placeholder="আপনার ইউজারনেম লিখুন" name="username" required>
                                </div>
                                <div class="col-lg-8 col-md-8">
                                    <input type="email" class="form-control c_email"
                                        placeholder="আপনার ইমেইল ঠিকানাটি লিখুন" name="email" required>
                                </div>
                                <div class="col-lg-8 col-md-8">
                                    <input type="password" class="form-control c_email"
                                        placeholder="আপনার পাসওয়ার্ড লিখুন" name="password" required>
                                </div>
                                <div class="col-lg-8 col-md-8">
                                    <input type="password" class="form-control c_email"
                                        placeholder="পাসওয়ার্ডটি পুনরায় লিখুন" name="confirm-password" required>
                                </div>

                            </div>
                            <div class="col-lg-2 col-md-2 container-fluid">
                                <button type="submit" class="btn c_button" style="margin-top: 5rem;">সাইন আপ</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact end-->

    <?php

    // Include the footer file
    include_once('footer.php');

    ?>

    <!-- Scroll to The Top -->
    <div class="scroll-to-top" id="scrollButton" onclick="scrollToTop()">
        ^
    </div>


    <!--  Bootstrap JS link -->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/c204687a77.js" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
    <script>
        function previewImage(input) {
            var imagePreview = document.getElementById('image-preview');
            var uploadText = document.getElementById('upload-text');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                    uploadText.style.display = 'none';
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                imagePreview.style.display = 'none';
                uploadText.style.display = 'block';
            }
        }
    </script>
</body>

</html>
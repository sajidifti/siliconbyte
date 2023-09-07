<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or display a message
    $error = "পাতাটি দেখতে আগে সাইনইন করুন।";
    header("Location: signin_page.php?error=" . urlencode($error));
    exit();
}

// Include your database connection file
include('db-connection.php');

// Fetch user information based on the user_id from the session
$user_id = $_SESSION['user_id'];
$sql = "SELECT fullname, username, email, profile_photo FROM Users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // User found, fetch and display their information
    $row = $result->fetch_assoc();
    $fullname = $row['fullname'];
    $username = $row['username'];
    $email = $row['email'];
    $profile_photo = $row['profile_photo'];
} else {
    // User not found, handle the error
    echo "User not found.";
}

// Close the database connection
$stmt->close();
$conn->close();
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
                                    <a class="nav-link" href="signup_page.php">সাইনআপ</a>
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
    <section class="articles">
        <div class="container">
            <!-- 1st row-->
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="c_title text-center">
                        <h1 class="c_h1 yellow form-title">ক্যাটাগরি</h1>
                        <p class="c_p ash">ক্যাটাগরি সংক্রান্ত সকল খবর পড়ুন</p>
                    </div>
                </div>
            </div>
            <!-- 2nd row-->
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <!-- কার্ড শুরু -->
                <div class="col">
                    <a href="readarticle.php" class="card-link">
                        <!-- Replace "details-page.html" with the actual URL of your details page -->
                        <div class="card h-100 my-card">
                            <img src="images/stock/demo.jpg" class="card-img-top" alt="Palm Springs Road" />
                            <div class="card-body">
                                <h5 class="card-title">স্যামসাং গ্যালাক্সি মুঠোফোনের পরবর্তী সংযোজন</h5>
                                <p class="card-text">
                                    দক্ষিণ কোয়িয়ার প্রযুক্তি জায়ান্ট স্যামসাং, ফোন লঞ্চ করেছে। যার নাম এস২৪। এটি তাদের
                                    ২০২৪ সালের জন্য
                                    ফ্ল্যাগশিপ। বলা হচ্ছে
                                    এখন পর্যন্ত সবচেয়ে শক্তিশালী ফোন এটি।
                                </p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">৫/৯/২০২৩ ১২ঃ৩০ এ প্রকাশিত</small>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- কার্ড শেষ -->
            </div>
            <div class="col-lg-2 col-md-2 container-fluid">
                <a type="submit" class="btn c_button more-button" style="margin-top: 5rem;" href="password_page.php">আরো
                    দেখুন</a>
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
                        <p>সিলিকনবাইট<br>আফতাবনগর<br>ঢাকা, বাংলাদেশ</p>
                        <p>contact@siliconbyte.com</p>
                        <p>+88 01700000000</p>
                    </address>

                </div>
                <div class="col-lg col-md col-6">
                    <div class="f_2">
                        <ul class="list-unstyled">
                            <li> <a href="#">খবর</a></li>
                            <li> <a href="#">ধরণ</a></li>
                            <li> <a href="#">প্রোফাইল</a></li>
                        </ul>
                    </div>

                </div>

                <div class="col-lg col-md col-6">

                    <div class="f_2">
                        <ul class="list-unstyled">
                            <li> <a href="#">যোগাযোগ</a></li>
                            <li> <a href="#">সম্পর্কে</a></li>
                            <li> <a href="#">প্রাইভেসি</a></li>
                            <li> <a href="#">শর্তাবলী</a></li>
                        </ul>
                    </div>

                </div>
                <div class="col-lg col-md col-6">

                    <div class="f_2">
                        <ul class="list-unstyled">
                            <li> <a href="#">ডাউনলোড</a></li>
                            <li> <a href="#">সাহায্য</a></li>
                            <li> <a href="#">নথিপত্র</a></li>
                        </ul>
                    </div>

                </div>
                <div class="col-lg col-md col-6">

                    <div class="f_2">
                        <ul class="list-unstyled">
                            <li> <a href="#">মিডিয়া</a></li>
                            <li> <a href="#">ব্লগ</a></li>
                            <li> <a href="#">ফোরাম</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </footer>
    <!-- footer end-->

    <!-- Scroll to The Top -->
    <div class="scroll-to-top" id="scrollButton" onclick="scrollToTop()">
        ^
    </div>


    <!--  Bootstrap JS link -->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/c204687a77.js" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>

</html>
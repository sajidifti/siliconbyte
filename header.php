<?php

include_once('pagename.php');

if (isset($page)) {

    if ($page == 'home') {
        $home = 'active-link';
    } else if ($page == 'articles') {
        $articles = 'active-link';
    } else if ($page == 'profile') {
        $profile = 'active-link';
    } else if ($page == 'post') {
        $post = 'active-link';
    } else if ($page == 'admin') {
        $admin = 'active-link';
    } else if ($page == 'signin') {
        $signin = 'active-link';
    } else if ($page == 'signout') {
        $signout = 'active-link';
    } else if ($page == 'signup') {
        $signup = 'active-link';
    }
     
}else{
    $page = '';
}

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

  <!-- Favicon -->
  <link rel="icon" href="images/stock/fav.png" type="image/png">
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
                <a class="navbar-brand" href="/">
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
                            <a class="nav-link <?php echo $home; ?>" href="/">হোম</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $articles; ?>" href="articles.php">সব খবর</a>
                        </li>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <?php if ($_SESSION['role'] == "writer"): ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo $post; ?>" href="post_page.php">লিখুন</a>
                                </li>
                            <?php endif; ?>
                            <?php if ($_SESSION['role'] == "admin"): ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo $admin; ?>" href="admin.php">ব্যাবস্থাপনা</a>
                                </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $profile; ?>" href="profile.php">প্রোফাইল</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $signout; ?>" href="signout.php">সাইনআউট</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $signup; ?>" href="signup_page.php">সাইনআপ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $signin; ?>" href="signin_page.php">সাইনইন</a>
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
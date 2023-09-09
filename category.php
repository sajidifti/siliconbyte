<?php
session_start();


if (isset($_GET['category'])) {
    $categoryBangla = $_GET['category'];
} else {
    // Redirect to the login page or display a message
    $error = "ভুল লিংক।";
    header("Location: index.php?error=" . urlencode($error));
    exit();
}

if ($categoryBangla == "smartphone") {
    $categoryBangla = "মুঠোফোন";
} else if ($categoryBangla == "pc") {
    $categoryBangla = "কম্পিউটার";
} else if ($categoryBangla == "gaming") {
    $categoryBangla = "ভিডিও গেম";
} else if ($categoryBangla == "tutorial") {
    $categoryBangla = "টিউটোরিয়াল";
} else if ($categoryBangla == "software") {
    $categoryBangla = "সফটওয়্যার";
} else if ($categoryBangla == "programing") {
    $categoryBangla = "প্রোগ্রামিং";
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
                        <h1 class="c_h1 yellow form-title">
                            <?php

                            echo $categoryBangla;

                            ?>
                        </h1>
                        <p class="c_p ash">
                            <?php

                            echo $categoryBangla;

                            ?> সংক্রান্ত সকল খবর পড়ুন
                        </p>
                    </div>
                </div>
            </div>
            <!-- 2nd row-->
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php
                // Include the database connection file
                include 'db-connection.php';

                // Check if the category_id is provided in the URL
                if (isset($_GET['category'])) {
                    $category = $_GET['category'];

                    // Query to retrieve articles of the specified category
                    $sql = "SELECT * FROM Articles WHERE category = ? ORDER BY DATETIME DESC"; // Adjust the ORDER BY clause as needed
                    if ($stmt = $conn->prepare($sql)) {
                        $stmt->bind_param("s", $category);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        // Check if there are articles in the specified category
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                // Extract data from the current row
                                $article_id = $row['article_id'];
                                $title = $row['title'];
                                $content = $row['content'];
                                $article_photo = $row['article_photo'];
                                $datetime = $row['DATETIME'];

                                // Format the datetime
                                $formatted_datetime = date("j/n/Y H:i", strtotime($datetime)); // Adjust the date format as needed
                
                                // Limit the content to 300 characters
                                if (mb_strlen($content, 'UTF-8') > 200) {
                                    $limited_content = mb_substr($content, 0, 200, 'UTF-8');
                                    $limited_content .= '...'; // Add ellipsis if content is truncated
                                } else {
                                    $limited_content = $content;
                                }

                                // HTML for the card
                                echo '<div class="col">';
                                echo '<a href="readarticle.php?article_id=' . $article_id . '" class="card-link">'; // Replace "details-page.php" with the actual URL of your details page
                                echo '<div class="card h-100 my-card">';
                                echo '<img src="' . $article_photo . '" class="card-img-top" alt="' . $title . '" />';
                                echo '<div class="card-body">';
                                echo '<h5 class="card-title">' . $title . '</h5>';
                                echo '<p class="card-text">' . $limited_content . '</p>';
                                echo '</div>';
                                echo '<div class="card-footer">';
                                echo '<small class="text-muted">' . $formatted_datetime . ' এ প্রকাশিত</small>';
                                echo '</div>';
                                echo '</div>';
                                echo '</a>';
                                echo '</div>';
                            }
                        } else {
                            // Handle the case where there are no articles in the specified category
                            echo 'No articles found in this category.';
                        }

                        // Close the prepared statement
                        $stmt->close();
                    } else {
                        // Handle the case where the SQL query couldn't be prepared
                        echo 'Error preparing SQL query.';
                    }
                } else {
                    // Handle the case where the category_id is not provided in the URL
                    echo 'Category ID not provided in the URL.';
                }

                // Close the database connection
                $conn->close();
                ?>

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
</body>

</html>
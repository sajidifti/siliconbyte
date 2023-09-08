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
    <!-- category start-->
    <section id="catagories" class="catagories" style="padding-top: 0; padding-bottom: 10px;">
        <div class="container">
            <!-- 2nd row -->
            <div class="row">
                <!-- single item start-->
                <div class="col-lg-4 col-sm-6 single_item">
                    <a href="#smartphone"> <!-- Add your link within the href attribute -->
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="a_icon text-center">
                                    <img class="icon-image" src="images/stock/smartphone-call.png"
                                        alt="Smartphone Icon">
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="a_text">
                                    <h2>মুঠোফোন</h2>
                                    <p>মুঠোফোন সংক্রান্ত সব খবর পড়ুন</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- single item end-->
                <!-- single item start-->
                <div class="col-lg-4 col-sm-6 single_item">
                    <a href="#pc"> <!-- Add your link within the href attribute -->
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="a_icon text-center">
                                    <img class="icon-image" src="images/stock/laptop.png" alt="Smartphone Icon">
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="a_text">
                                    <h2>কম্পিউটার</h2>
                                    <p>কম্পিউটার সংক্রান্ত সব খবর পড়ুন</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- single item end-->
                <!-- single item start-->
                <div class="col-lg-4 col-sm-6 single_item">
                    <a href="#game"> <!-- Add your link within the href attribute -->
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="a_icon text-center">
                                    <img class="icon-image" src="images/stock/console.png" alt="Smartphone Icon">
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="a_text">
                                    <h2>ভিডিও গেম</h2>
                                    <p>ভিডিও গেম সংক্রান্ত সব খবর পড়ুন</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- single item end-->
                <!-- single item start-->
                <div class="col-lg-4 col-sm-6 single_item">
                    <a href="#tutorial"> <!-- Add your link within the href attribute -->
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="a_icon text-center">
                                    <img class="icon-image" src="images/stock/video-lesson.png" alt="Smartphone Icon">
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="a_text">
                                    <h2>টিউটোরিয়াল</h2>
                                    <p>আমাদের টিউটোরিয়াল গুলো পড়ুন</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- single item end-->
                <!-- single item start-->
                <div class="col-lg-4 col-sm-6 single_item">
                    <a href="#software"> <!-- Add your link within the href attribute -->
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="a_icon text-center">
                                    <img class="icon-image" src="images/stock/it-systems.png" alt="Smartphone Icon">
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="a_text">
                                    <h2>সফটওয়্যার</h2>
                                    <p>সফটওয়্যার সংক্রান্ত সব খবর পড়ুন</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- single item end-->
                <!-- single item start-->
                <div class="col-lg-4 col-sm-6 single_item">
                    <a href="#programing"> <!-- Add your link within the href attribute -->
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="a_icon text-center">
                                    <img class="icon-image" src="images/stock/code.png" alt="Smartphone Icon">
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="a_text">
                                    <h2>প্রোগ্রামিং</h2>
                                    <p>প্রোগ্রামিং সংক্রান্ত সব খবর পড়ুন</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- single item end-->

            </div>
        </div>
    </section>
    <!-- category end-->

    <!-- Articles start -->

    <section class="articles">
        <div class="container">
            <!-- Vertical Card Start -->
            <div style="margin-top: 20px;" id="smartphone">
                <h2><a href="category.php?category=smartphone" class="latest-link">মুঠোফোন <span
                            style="font-size: 120%;">&gt;</span></a></h2>
            </div>

            <div class="row row-cols-1 row-cols-md-4 g-4 verticle-card-row">
                <?php
                include('db-connection.php'); // Include the database connection file
                
                // Define the category you want to query
                $category = 'smartphone';

                // Query the database
                $query = "SELECT article_id, title, SUBSTRING(content, 1, 100) AS truncated_content, DATETIME, article_photo
          FROM Articles
          WHERE category = ?
          LIMIT 2";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $category);
                $stmt->execute();
                $result = $stmt->get_result();

                // Loop through the results and create cards
                while ($row = $result->fetch_assoc()) {
                    // Extract data from the row
                    $articleId = $row['article_id'];
                    $title = $row['title'];
                    $truncatedContent = $row['truncated_content'];
                    $datePublished = $row['DATETIME'];
                    $imageSrc = $row['article_photo'];

                    // Output the card HTML with dynamic data
                    echo '<!-- Single Card Start -->
    <div class="col-md-6 verticle-card-col">
        <a href="details-page.html?article_id=' . $articleId . '" class="card-link">
            <div class="card mb-3 verticle-card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="' . $imageSrc . '" class="img-fluid rounded-start" alt="..."
                            style="object-fit: cover; width: 100%; height: 100%;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">' . $title . '</h5>
                            <p class="card-text">' . $truncatedContent . '</p>
                            <p class="card-text"><small class="text-muted">' . $datePublished . '</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <!-- Single Card End -->';
                }

                // Close the database connection
                $stmt->close();
                $conn->close();
                ?>

            </div>
            <!-- Vertical Card End -->
            <!-- Horizontal Card -->
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php
                // Include the database connection file
                include 'db-connection.php';

                // Define the category you want to query
                $category = "smartphone";

                // Calculate the offset for pagination
                $limit = 4;
                $offset = 2;
                $offset_value = $offset * $limit;

                // Query to retrieve articles from the specified category with pagination
                $sql = "SELECT * FROM Articles WHERE category = ? ORDER BY DATETIME DESC LIMIT ?, ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sii", $category, $offset_value, $limit);
                $stmt->execute();
                $result = $stmt->get_result();

                // Check if there are articles
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
                
                        // Limit the content to 200 characters
                        if (mb_strlen($content, 'UTF-8') > 200) {
                            $limited_content = mb_substr($content, 0, 200, 'UTF-8');
                            $limited_content .= '...'; // Add ellipsis if content is truncated
                        } else {
                            $limited_content = $content;
                        }

                        // HTML for the card
                        echo '<div class="col">';
                        echo '<a href="readarticle.php?article_id=' . $article_id . '" class="card-link">';
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
                }

                // Close the database connection
                $stmt->close();
                $conn->close();
                ?>

            </div>

        </div>

        <!-- Second category pc -->
        <div class="container">
            <!-- Vertical Card Start -->
            <div style="margin-top: 20px;" id="pc">
                <h2><a href="category.php?category=pc" class="latest-link">কম্পিউটার <span
                            style="font-size: 120%;">&gt;</span></a></h2>
            </div>

            <div class="row row-cols-1 row-cols-md-4 g-4 verticle-card-row">
                <?php
                include('db-connection.php'); // Include the database connection file
                
                // Define the category you want to query
                $category = 'pc';

                // Query the database
                $query = "SELECT article_id, title, SUBSTRING(content, 1, 100) AS truncated_content, DATETIME, article_photo
          FROM Articles
          WHERE category = ?
          LIMIT 2";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $category);
                $stmt->execute();
                $result = $stmt->get_result();

                // Loop through the results and create cards
                while ($row = $result->fetch_assoc()) {
                    // Extract data from the row
                    $articleId = $row['article_id'];
                    $title = $row['title'];
                    $truncatedContent = $row['truncated_content'];
                    $datePublished = $row['DATETIME'];
                    $imageSrc = $row['article_photo'];

                    // Output the card HTML with dynamic data
                    echo '<!-- Single Card Start -->
    <div class="col-md-6 verticle-card-col">
        <a href="details-page.html?article_id=' . $articleId . '" class="card-link">
            <div class="card mb-3 verticle-card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="' . $imageSrc . '" class="img-fluid rounded-start" alt="..."
                            style="object-fit: cover; width: 100%; height: 100%;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">' . $title . '</h5>
                            <p class="card-text">' . $truncatedContent . '</p>
                            <p class="card-text"><small class="text-muted">' . $datePublished . '</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <!-- Single Card End -->';
                }

                // Close the database connection
                $stmt->close();
                $conn->close();
                ?>

            </div>
            <!-- Vertical Card End -->
            <!-- Horizontal Card -->
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php
                // Include the database connection file
                include 'db-connection.php';

                // Define the category you want to query
                $category = "pc";

                // Calculate the offset for pagination
                $limit = 4;
                $offset = 2;
                $offset_value = $offset * $limit;

                // Query to retrieve articles from the specified category with pagination
                $sql = "SELECT * FROM Articles WHERE category = ? ORDER BY DATETIME DESC LIMIT ?, ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sii", $category, $offset_value, $limit);
                $stmt->execute();
                $result = $stmt->get_result();

                // Check if there are articles
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
                
                        // Limit the content to 200 characters
                        if (mb_strlen($content, 'UTF-8') > 200) {
                            $limited_content = mb_substr($content, 0, 200, 'UTF-8');
                            $limited_content .= '...'; // Add ellipsis if content is truncated
                        } else {
                            $limited_content = $content;
                        }

                        // HTML for the card
                        echo '<div class="col">';
                        echo '<a href="readarticle.php?article_id=' . $article_id . '" class="card-link">';
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
                }

                // Close the database connection
                $stmt->close();
                $conn->close();
                ?>

            </div>

        </div>
        <div class="container">
            <!-- Vertical Card Start -->
            <div style="margin-top: 20px;" id="gaming">
                <h2><a href="category.php?category=gaming" class="latest-link">ভিডিও গেম <span
                            style="font-size: 120%;">&gt;</span></a></h2>
            </div>

            <div class="row row-cols-1 row-cols-md-4 g-4 verticle-card-row">
                <?php
                include('db-connection.php'); // Include the database connection file
                
                // Define the category you want to query
                $category = 'gaming';

                // Query the database
                $query = "SELECT article_id, title, SUBSTRING(content, 1, 100) AS truncated_content, DATETIME, article_photo
          FROM Articles
          WHERE category = ?
          LIMIT 2";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $category);
                $stmt->execute();
                $result = $stmt->get_result();

                // Loop through the results and create cards
                while ($row = $result->fetch_assoc()) {
                    // Extract data from the row
                    $articleId = $row['article_id'];
                    $title = $row['title'];
                    $truncatedContent = $row['truncated_content'];
                    $datePublished = $row['DATETIME'];
                    $imageSrc = $row['article_photo'];

                    // Output the card HTML with dynamic data
                    echo '<!-- Single Card Start -->
    <div class="col-md-6 verticle-card-col">
        <a href="details-page.html?article_id=' . $articleId . '" class="card-link">
            <div class="card mb-3 verticle-card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="' . $imageSrc . '" class="img-fluid rounded-start" alt="..."
                            style="object-fit: cover; width: 100%; height: 100%;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">' . $title . '</h5>
                            <p class="card-text">' . $truncatedContent . '</p>
                            <p class="card-text"><small class="text-muted">' . $datePublished . '</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <!-- Single Card End -->';
                }

                // Close the database connection
                $stmt->close();
                $conn->close();
                ?>

            </div>
            <!-- Vertical Card End -->
            <!-- Horizontal Card -->
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php
                // Include the database connection file
                include 'db-connection.php';

                // Define the category you want to query
                $category = "gaming";

                // Calculate the offset for pagination
                $limit = 4;
                $offset = 2;
                $offset_value = $offset * $limit;

                // Query to retrieve articles from the specified category with pagination
                $sql = "SELECT * FROM Articles WHERE category = ? ORDER BY DATETIME DESC LIMIT ?, ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sii", $category, $offset_value, $limit);
                $stmt->execute();
                $result = $stmt->get_result();

                // Check if there are articles
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
                
                        // Limit the content to 200 characters
                        if (mb_strlen($content, 'UTF-8') > 200) {
                            $limited_content = mb_substr($content, 0, 200, 'UTF-8');
                            $limited_content .= '...'; // Add ellipsis if content is truncated
                        } else {
                            $limited_content = $content;
                        }

                        // HTML for the card
                        echo '<div class="col">';
                        echo '<a href="readarticle.php?article_id=' . $article_id . '" class="card-link">';
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
                }

                // Close the database connection
                $stmt->close();
                $conn->close();
                ?>

            </div>

        </div>
        <div class="container">
            <!-- Vertical Card Start -->
            <div style="margin-top: 20px;" id="tutorial">
                <h2><a href="category.php?category=tutorial" class="latest-link">টিউটোরিয়াল <span
                            style="font-size: 120%;">&gt;</span></a></h2>
            </div>

            <div class="row row-cols-1 row-cols-md-4 g-4 verticle-card-row">
                <?php
                include('db-connection.php'); // Include the database connection file
                
                // Define the category you want to query
                $category = 'tutorial';

                // Query the database
                $query = "SELECT article_id, title, SUBSTRING(content, 1, 100) AS truncated_content, DATETIME, article_photo
          FROM Articles
          WHERE category = ?
          LIMIT 2";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $category);
                $stmt->execute();
                $result = $stmt->get_result();

                // Loop through the results and create cards
                while ($row = $result->fetch_assoc()) {
                    // Extract data from the row
                    $articleId = $row['article_id'];
                    $title = $row['title'];
                    $truncatedContent = $row['truncated_content'];
                    $datePublished = $row['DATETIME'];
                    $imageSrc = $row['article_photo'];

                    // Output the card HTML with dynamic data
                    echo '<!-- Single Card Start -->
    <div class="col-md-6 verticle-card-col">
        <a href="details-page.html?article_id=' . $articleId . '" class="card-link">
            <div class="card mb-3 verticle-card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="' . $imageSrc . '" class="img-fluid rounded-start" alt="..."
                            style="object-fit: cover; width: 100%; height: 100%;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">' . $title . '</h5>
                            <p class="card-text">' . $truncatedContent . '</p>
                            <p class="card-text"><small class="text-muted">' . $datePublished . '</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <!-- Single Card End -->';
                }

                // Close the database connection
                $stmt->close();
                $conn->close();
                ?>

            </div>
            <!-- Vertical Card End -->
            <!-- Horizontal Card -->
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php
                // Include the database connection file
                include 'db-connection.php';

                // Define the category you want to query
                $category = "tutorial";

                // Calculate the offset for pagination
                $limit = 4;
                $offset = 2;
                $offset_value = $offset * $limit;

                // Query to retrieve articles from the specified category with pagination
                $sql = "SELECT * FROM Articles WHERE category = ? ORDER BY DATETIME DESC LIMIT ?, ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sii", $category, $offset_value, $limit);
                $stmt->execute();
                $result = $stmt->get_result();

                // Check if there are articles
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
                
                        // Limit the content to 200 characters
                        if (mb_strlen($content, 'UTF-8') > 200) {
                            $limited_content = mb_substr($content, 0, 200, 'UTF-8');
                            $limited_content .= '...'; // Add ellipsis if content is truncated
                        } else {
                            $limited_content = $content;
                        }

                        // HTML for the card
                        echo '<div class="col">';
                        echo '<a href="readarticle.php?article_id=' . $article_id . '" class="card-link">';
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
                }

                // Close the database connection
                $stmt->close();
                $conn->close();
                ?>

            </div>

        </div>
        <div class="container">
            <!-- Vertical Card Start -->
            <div style="margin-top: 20px;" id="software">
                <h2><a href="category.php?category=software" class="latest-link">সফটওয়্যার <span
                            style="font-size: 120%;">&gt;</span></a></h2>
            </div>

            <div class="row row-cols-1 row-cols-md-4 g-4 verticle-card-row">
                <?php
                include('db-connection.php'); // Include the database connection file
                
                // Define the category you want to query
                $category = 'software';

                // Query the database
                $query = "SELECT article_id, title, SUBSTRING(content, 1, 100) AS truncated_content, DATETIME, article_photo
          FROM Articles
          WHERE category = ?
          LIMIT 2";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $category);
                $stmt->execute();
                $result = $stmt->get_result();

                // Loop through the results and create cards
                while ($row = $result->fetch_assoc()) {
                    // Extract data from the row
                    $articleId = $row['article_id'];
                    $title = $row['title'];
                    $truncatedContent = $row['truncated_content'];
                    $datePublished = $row['DATETIME'];
                    $imageSrc = $row['article_photo'];

                    // Output the card HTML with dynamic data
                    echo '<!-- Single Card Start -->
    <div class="col-md-6 verticle-card-col">
        <a href="details-page.html?article_id=' . $articleId . '" class="card-link">
            <div class="card mb-3 verticle-card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="' . $imageSrc . '" class="img-fluid rounded-start" alt="..."
                            style="object-fit: cover; width: 100%; height: 100%;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">' . $title . '</h5>
                            <p class="card-text">' . $truncatedContent . '</p>
                            <p class="card-text"><small class="text-muted">' . $datePublished . '</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <!-- Single Card End -->';
                }

                // Close the database connection
                $stmt->close();
                $conn->close();
                ?>

            </div>
            <!-- Vertical Card End -->
            <!-- Horizontal Card -->
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php
                // Include the database connection file
                include 'db-connection.php';

                // Define the category you want to query
                $category = "software";

                // Calculate the offset for pagination
                $limit = 4;
                $offset = 2;
                $offset_value = $offset * $limit;

                // Query to retrieve articles from the specified category with pagination
                $sql = "SELECT * FROM Articles WHERE category = ? ORDER BY DATETIME DESC LIMIT ?, ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sii", $category, $offset_value, $limit);
                $stmt->execute();
                $result = $stmt->get_result();

                // Check if there are articles
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
                
                        // Limit the content to 200 characters
                        if (mb_strlen($content, 'UTF-8') > 200) {
                            $limited_content = mb_substr($content, 0, 200, 'UTF-8');
                            $limited_content .= '...'; // Add ellipsis if content is truncated
                        } else {
                            $limited_content = $content;
                        }

                        // HTML for the card
                        echo '<div class="col">';
                        echo '<a href="readarticle.php?article_id=' . $article_id . '" class="card-link">';
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
                }

                // Close the database connection
                $stmt->close();
                $conn->close();
                ?>

            </div>
        </div>
        <div class="container">
            <!-- Vertical Card Start -->
            <div style="margin-top: 20px;" id="programing">
                <h2><a href="category.php?category=programing" class="latest-link">প্রোগ্রামিং <span
                            style="font-size: 120%;">&gt;</span></a></h2>
            </div>

            <div class="row row-cols-1 row-cols-md-4 g-4 verticle-card-row">
                <?php
                include('db-connection.php'); // Include the database connection file
                
                // Define the category you want to query
                $category = 'programing';

                // Query the database
                $query = "SELECT article_id, title, SUBSTRING(content, 1, 100) AS truncated_content, DATETIME, article_photo
          FROM Articles
          WHERE category = ?
          LIMIT 2";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $category);
                $stmt->execute();
                $result = $stmt->get_result();

                // Loop through the results and create cards
                while ($row = $result->fetch_assoc()) {
                    // Extract data from the row
                    $articleId = $row['article_id'];
                    $title = $row['title'];
                    $truncatedContent = $row['truncated_content'];
                    $datePublished = $row['DATETIME'];
                    $imageSrc = $row['article_photo'];

                    // Output the card HTML with dynamic data
                    echo '<!-- Single Card Start -->
    <div class="col-md-6 verticle-card-col">
        <a href="details-page.html?article_id=' . $articleId . '" class="card-link">
            <div class="card mb-3 verticle-card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="' . $imageSrc . '" class="img-fluid rounded-start" alt="..."
                            style="object-fit: cover; width: 100%; height: 100%;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">' . $title . '</h5>
                            <p class="card-text">' . $truncatedContent . '</p>
                            <p class="card-text"><small class="text-muted">' . $datePublished . '</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <!-- Single Card End -->';
                }

                // Close the database connection
                $stmt->close();
                $conn->close();
                ?>

            </div>
            <!-- Vertical Card End -->
            <!-- Horizontal Card -->
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php
                // Include the database connection file
                include 'db-connection.php';

                // Define the category you want to query
                $category = "programing";

                // Calculate the offset for pagination
                $limit = 4;
                $offset = 2;
                $offset_value = $offset * $limit;

                // Query to retrieve articles from the specified category with pagination
                $sql = "SELECT * FROM Articles WHERE category = ? ORDER BY DATETIME DESC LIMIT ?, ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sii", $category, $offset_value, $limit);
                $stmt->execute();
                $result = $stmt->get_result();

                // Check if there are articles
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
                
                        // Limit the content to 200 characters
                        if (mb_strlen($content, 'UTF-8') > 200) {
                            $limited_content = mb_substr($content, 0, 200, 'UTF-8');
                            $limited_content .= '...'; // Add ellipsis if content is truncated
                        } else {
                            $limited_content = $content;
                        }

                        // HTML for the card
                        echo '<div class="col">';
                        echo '<a href="readarticle.php?article_id=' . $article_id . '" class="card-link">';
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
                }

                // Close the database connection
                $stmt->close();
                $conn->close();
                ?>

            </div>
        </div>
    </section>

    <!-- Articles end -->

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
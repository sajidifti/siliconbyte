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

    <section class="articles">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8">
                    <!-- Main Article Section -->
                    <article>
                        <?php
                        // Include the database connection file
                        include 'db-connection.php';

                        // Check if article_id is provided in the URL
                        if (isset($_GET['article_id'])) {
                            $article_id = $_GET['article_id'];

                            // Query to retrieve the article by article_id
                            $sql = "SELECT * FROM Articles WHERE article_id = ?";
                            if ($stmt = $conn->prepare($sql)) {
                                $stmt->bind_param("i", $article_id);
                                if ($stmt->execute()) {
                                    $result = $stmt->get_result();

                                    // Check if the article exists
                                    if ($result->num_rows === 1) {
                                        $row = $result->fetch_assoc();
                                        $title = $row['title'];
                                        $summary = $row['summary'];
                                        $content = $row['content'];
                                        $article_photo = $row['article_photo'];
                                        $datetime = $row['DATETIME'];
                                        $user_id = $row['user_id'];

                                        // Format the datetime
                                        $formatted_datetime = date("j/n/Y H:i", strtotime($datetime)); // Adjust the date format as needed
                        
                                        // Query to retrieve the author's name from the users table
                                        $author_query = "SELECT fullname FROM users WHERE user_id = ?";
                                        if ($stmt_author = $conn->prepare($author_query)) {
                                            $stmt_author->bind_param("i", $user_id);
                                            if ($stmt_author->execute()) {
                                                $author_result = $stmt_author->get_result();
                                                $author_row = $author_result->fetch_assoc();
                                                $author = $author_row['fullname'];

                                                // Display the article details
                                                echo '<h1 class="article-title">' . $title . '</h1>';
                                                echo '<p class="lead">' . $summary . '</p>';
                                                echo '<p class="article-published"><small class="text-muted">' . $formatted_datetime . ' এ প্রকাশিত</small></p>';
                                                echo '<p class="article-published"><small class="text-muted">লিখেছেন ' . $author . '</small></p>';
                                                echo '<img src="' . $article_photo . '" alt="Article Photo" class="img-fluid mb-3 article-photo">';
                                                echo '<p class="article-body">' . $content . '</p>';
                                            } else {
                                                echo 'Error retrieving author information.';
                                            }
                                            $stmt_author->close();
                                        } else {
                                            echo 'Error preparing author query.';
                                        }
                                    } else {
                                        echo 'Article not found.';
                                    }
                                } else {
                                    echo 'Error executing query.';
                                }
                            } else {
                                echo 'Error preparing query.';
                            }

                            // Close the database connection
                            $stmt->close();
                            $conn->close();
                        } else {
                            echo 'Invalid article ID.';
                        }
                        ?>
                    </article>
                </div>
                <div class="col-md-4">
                    <!-- Related Articles Section -->
                    <div class="mb-4">
                        <h2 class="related-articles">Related Articles</h2>
                    </div>

                    <!-- Single Card Start -->
                    <div class="col verticle-card-col">
                        <a href="details-page.html" class="card-link">
                            <!-- Replace "details-page.html" with the actual URL of your details page -->
                            <div class="card mb-3 verticle-card">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="images/stock/demo.jpg" class="img-fluid rounded-start" alt="..."
                                            style="object-fit: cover; width: 100%; height: 100%;">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">স্যামসাং গ্যালাক্সি মুঠোফোনের পরবর্তী সংযোজন</h5>
                                            <p class="card-text">text</p>
                                            <p class="card-text"><small class="text-muted">৫/৯/২০২৩ ১২ঃ৩০ এ
                                                    প্রকাশিত</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- Single Card End -->

                    <!-- Single Card Start -->
                    <div class="col verticle-card-col">
                        <a href="details-page.html" class="card-link">
                            <!-- Replace "details-page.html" with the actual URL of your details page -->
                            <div class="card mb-3 verticle-card">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="images/stock/demo.jpg" class="img-fluid rounded-start" alt="..."
                                            style="object-fit: cover; width: 100%; height: 100%;">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">স্যামসাং গ্যালাক্সি মুঠোফোনের পরবর্তী সংযোজন</h5>
                                            <p class="card-text">text</p>
                                            <p class="card-text"><small class="text-muted">৫/৯/২০২৩ ১২ঃ৩০ এ
                                                    প্রকাশিত</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- Single Card End -->
                    <!-- Add more related articles as needed -->
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="tags category">
                        <?php
                        // Include the database connection file
                        include 'db-connection.php';

                        // Check if article_id is provided in the URL
                        if (isset($_GET['article_id'])) {
                            $article_id = $_GET['article_id'];

                            // Query to increment the views count of the article
                            $increment_views_query = "UPDATE Articles SET views = views + 1 WHERE article_id = ?";
                            if ($stmt_increment_views = $conn->prepare($increment_views_query)) {
                                $stmt_increment_views->bind_param("i", $article_id);
                                if ($stmt_increment_views->execute()) {
                                    // Views count incremented successfully
                                    // You can display a success message if needed
                                } else {
                                    echo 'Error incrementing views count.';
                                }
                                $stmt_increment_views->close();
                            } else {
                                echo 'Error preparing increment views query.';
                            }
                            // Query to retrieve the category of the article
                            $category_query = "SELECT category FROM Articles WHERE article_id = ?";
                            if ($stmt_category = $conn->prepare($category_query)) {
                                $stmt_category->bind_param("i", $article_id);
                                if ($stmt_category->execute()) {
                                    $category_result = $stmt_category->get_result();
                                    $category_row = $category_result->fetch_assoc();
                                    $category = $category_row['category'];

                                    // Display the category
                                    echo '<a href="#">' . $category . '</a>';
                                } else {
                                    echo 'Error retrieving category information.';
                                }
                                $stmt_category->close();
                            } else {
                                echo 'Error preparing category query.';
                            }

                            // Query to retrieve the tags associated with the article
                            $tags_query = "SELECT T.tag_name FROM Tags AS T
                                INNER JOIN Article_Tags AS AT ON T.tag_id = AT.tag_id
                                WHERE AT.article_id = ?";
                            if ($stmt_tags = $conn->prepare($tags_query)) {
                                $stmt_tags->bind_param("i", $article_id);
                                if ($stmt_tags->execute()) {
                                    $tags_result = $stmt_tags->get_result();

                                    // Display the tags
                                    echo '<div class="col">';
                                    echo '<div class="tags">';
                                    while ($tag_row = $tags_result->fetch_assoc()) {
                                        $tag_name = $tag_row['tag_name'];
                                        echo '<a href="#">' . $tag_name . '</a>';
                                    }
                                    echo '</div>';
                                    echo '</div>';
                                } else {
                                    echo 'Error retrieving tags information.';
                                }
                                $stmt_tags->close();
                            } else {
                                echo 'Error preparing tags query.';
                            }
                        } else {
                            echo 'Invalid article ID.';
                        }

                        // Close the database connection
                        $conn->close();
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </section>

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
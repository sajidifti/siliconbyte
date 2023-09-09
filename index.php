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
  <!-- slider start-->
  <section id="slider" class="slider">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <!-- carousel start-->

          <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <!-- indicators-->
            <ol class="carousel-indicators c_ind">
              <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
              <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
              <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
            </ol>
            <!-- inner -->
            <div class="carousel-inner">
              <!-- items start-->
              <div class="carousel-inner">
                <?php
                // Include the database connection file
                include 'db-connection.php';

                // Query the latest 3 articles
                $latest_articles_query = "
        SELECT article_id, title, summary, content, article_photo
        FROM Articles
        ORDER BY DATETIME DESC
        LIMIT 3
    ";

                $result = $conn->query($latest_articles_query);

                if ($result) {
                  $count = 0;

                  while ($row = $result->fetch_assoc()) {
                    $article_id = $row['article_id'];
                    $title = $row['title'];
                    $summary = $row['summary'];
                    $content = mb_substr($row['content'], 0, 200, 'UTF-8'); // Limit content to 200 characters
                    $article_photo = $row['article_photo'];

                    // Determine whether the item is active or not
                    $active_class = ($count == 0) ? 'active' : '';

                    echo "<div class='carousel-item slider-item $active_class'>";
                    echo "<div class='row align-items-center'>";
                    echo "<div class='col-lg-5 col-md-7'>";
                    echo "<div class='s_content'>";
                    echo "<h1>$title</h1>";
                    echo "<h3>$summary</h3>";
                    echo "<p>$content</p>";
                    echo "<div class='col-lg-3 col-md-3'>";
                    echo "<a type='submit' class='btn c_button more-button' style='margin-top: 5rem;' href='readarticle.php?article_id=$article_id'>আরো পড়ুন</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='offset-lg-2 col-lg-5 col-md-5 d-md-block d-none'>";
                    echo "<div class='s_img text-center'>";
                    echo "<img src='$article_photo' class='img-fluid' alt='article_image'>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";

                    $count++;
                  }
                } else {
                  // Handle database error here
                  echo "Error: ";
                }

                // Close the database connection (if not handled in db-connection.php)
                $conn->close();
                ?>
              </div>
              <!-- items end-->


            </div>
          </div>
          <!-- carousel end-->
        </div>
      </div>
    </div>

  </section>

  <!-- slider end-->

  <!-- Articles start -->

  <section class="articles">
    <div class="container">
      <div class="row row-cols-1 row-cols-md-4 g-4">
        <?php
        // Include the database connection file
        include 'db-connection.php';

        if (isset($_SESSION['user_id'])) {
          // Assuming you have a session variable for user_id
          $user_id = $_SESSION['user_id'];

          $sql = "
                SELECT DISTINCT A.article_id, A.title, A.summary, A.content, A.article_photo, A.DATETIME
FROM Articles A
INNER JOIN User_Category_Read_Count U ON A.category = U.category
WHERE U.user_id = ?
ORDER BY U.read_count DESC, RAND()
LIMIT 12

            ";

          if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $user_id); // Assuming user_id is an integer
            $stmt->execute();
            $result = $stmt->get_result();
          } else {
            // Handle the prepared statement error here
            echo "Error: " . $conn->error;
          }
        } else {
          // Query to retrieve all articles
          $sql = "SELECT *
                    FROM (
                        SELECT *
                        FROM Articles
                        ORDER BY DATETIME DESC
                        LIMIT 12
                    ) AS subquery
                    ORDER BY views DESC";

          $result = $conn->query($sql);
        }

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
            echo '<a href="readarticle.php?article_id=' . $article_id . '" class="card-link">'; // Replace with your actual URL
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
          // Handle the case where there are no articles
          echo 'No articles found.';
        }

        // Close the database connection
        $conn->close();
        ?>



      </div>

      <!-- Vertical Card Start -->
      <div style="margin-top: 20px;">
        <h2><a href="#" class="latest-link">সর্বশেষ <span style="font-size: 120%;">&gt;</span></a></h2>
      </div>
      <div class="row row-cols-1 row-cols-md-4 g-4 verticle-card-row">
        <?php
        include('db-connection.php'); // Include the database connection file
        
        // Define the category you want to query
        $category = 'smartphone';

        // Query the database
        $query = "SELECT article_id, title, SUBSTRING(content, 1, 100) AS truncated_content, DATETIME, article_photo
          FROM Articles
          ORDER BY DATETIME DESC
          LIMIT 4 OFFSET 3";

        $stmt = $conn->prepare($query);
        // $stmt->bind_param("s", $category);
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
        <a href="readarticle.php?article_id=' . $articleId . '" class="card-link">
            <div class="card mb-3 verticle-card h-100">
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

      <!-- Others -->
      <div style="margin-top: 20px;">
        <h2><a href="#" class="latest-link">অন্যান্য <span style="font-size: 120%;">&gt;</span></a></h2>
      </div>
      <div class="row row-cols-1 row-cols-md-4 g-4">
        <?php
        // Include the database connection file
        include 'db-connection.php';

        if (isset($_SESSION['user_id'])) {
          // Assuming you have a session variable for user_id
          $user_id = $_SESSION['user_id'];

          $sql = "
                SELECT DISTINCT A.article_id, A.title, A.summary, A.content, A.article_photo, A.DATETIME
FROM Articles A
INNER JOIN Article_Tags AT ON A.article_id = AT.article_id
INNER JOIN Tags T ON AT.tag_id = T.tag_id
INNER JOIN User_Tag_Read_Count U ON AT.tag_id = U.tag_id
WHERE U.user_id = ?
ORDER BY U.read_count DESC, RAND()
LIMIT 8

            ";

          if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $user_id); // Assuming user_id is an integer
            $stmt->execute();
            $result = $stmt->get_result();
          } else {
            // Handle the prepared statement error here
            echo "Error: ";
          }
        } else {
          // Query to retrieve all articles
          $sql = "SELECT *
                    FROM (
                        SELECT *
                        FROM Articles
                        ORDER BY DATETIME DESC
                        LIMIT 8
                    ) AS subquery
                    ORDER BY views ASC";

          $result = $conn->query($sql);
        }

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
            echo '<a href="readarticle.php?article_id=' . $article_id . '" class="card-link">'; // Replace with your actual URL
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
          // Handle the case where there are no articles
          echo 'No articles found.';
        }

        // Close the database connection
        $conn->close();
        ?>
      </div>
      <div class="col-lg-2 col-md-2 container-fluid">
        <a type="submit" class="btn c_button more-button" style="margin-top: 5rem;" href="articles.php">আরো
          দেখুন</a>
      </div>


    </div>
  </section>

  <!-- Articles end -->

  <!-- category start-->
  <section id="catagories" class="catagories">
    <div class="container">
      <!-- 1st row-->
      <div class="row justify-content-center" style="margin-bottom: 50px;">
        <div class="col-lg-9">
          <div class="c_title text-center">
            <h1 class="c_h1"><a href="#">সব ধরণের প্রযুক্তির খবর</a></h1>
            <p class="c_p">সব ধরণের প্রযুক্তির খবর পড়ুন সিলিকনবাইটে<br>প্রযুক্তি জগতের সর্বশেষ খবরে চোখ রাখুন</p>
          </div>
        </div>
      </div>

      <!-- 2nd row -->
      <div class="row">
        <!-- single item start-->
        <div class="col-lg-4 col-sm-6 single_item">
          <a href="category.php?category=smartphone"> <!-- Add your link within the href attribute -->
            <div class="row">
              <div class="col-lg-3">
                <div class="a_icon text-center">
                  <img class="icon-image" src="images/stock/smartphone-call.png" alt="Smartphone Icon">
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
          <a href="category.php?category=pc"> <!-- Add your link within the href attribute -->
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
          <a href="category.php?category=gaming"> <!-- Add your link within the href attribute -->
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
          <a href="category.php?category=tutorial"> <!-- Add your link within the href attribute -->
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
          <a href="category.php?category=software"> <!-- Add your link within the href attribute -->
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
          <a href="category.php?category=programing"> <!-- Add your link within the href attribute -->
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
  <!-- contact start-->
  <section class="contact" id="contact">
    <div class="container">
      <!-- 1st row-->
      <div class="row justify-content-center">
        <div class="col-lg-9">
          <div class="c_title text-center">
            <h1 class="c_h1 yellow">আমাদের সাথে যোগাযোগ করুন</h1>
            <p class="c_p ash">আপনার ইমেইল ঠিকানাটি দিন। আমরা আপনার সাথে যোগাযোগ করব।</p>
          </div>
        </div>
      </div>
      <!-- 2nd row-->
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="c_form">
            <form action="#">

              <div class="row g-3 justify-content-center">
                <div class="col-lg-8 col-md-8">
                  <input type="email" class="form-control c_email" placeholder="আপনার ইমেইল ঠিকানাটি লিখুন">
                </div>

                <div class="col-lg-2 col-md-2">
                  <button type="submit" class="btn c_button">জমা দিন</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- 3rd row-->
      <div class="row justify-content-center">
        <div class="col-lg-4">
          <div class="s_media text-center">
            <ul class="list-inline">
              <li class="list-inline-item"> <a href="#"> <i class="fab fa-facebook-square"></i> </a></li>
              <li class="list-inline-item"> <a href="#"> <i class="fab fa-twitter-square"></i> </a></li>
              <li class="list-inline-item"> <a href="#"> <i class="fab fa-google-plus-square"></i> </a></li>
              <li class="list-inline-item"> <a href="#"> <i class="fab fa-pinterest-square"></i> </a></li>
            </ul>
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
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

              <div class="carousel-item active">
                <div class="row align-items-center">
                  <!-- s_content-->
                  <div class="col-lg-5 col-md-7">
                    <div class="s_content">
                      <h1>স্যামসাং গ্যালাক্সি মুঠোফোনের পরবর্তী সংযোজন</h1>
                      <h3>জনপ্রিয় গ্যালাক্সি সিরিজের নতুন ফোন বাজারে আনল স্যামসাং</h3>
                      <p>দক্ষিণ কোয়িয়ার প্রযুক্তি জায়ান্ট স্যামসাং, ফোন লঞ্চ করেছে। যার নাম এস২৪। এটি তাদের ২০২৪ সালের
                        জন্য ফ্ল্যাগশিপ। বলা হচ্ছে এখন পর্যন্ত সবচেয়ে শক্তিশালী ফোন এটি।</p>
                      <div class="col-lg-3 col-md-3">
                        <button type="submit" class="btn c_button">আরো পডুন</button>
                      </div>
                    </div>

                  </div>
                  <!-- s_img-->
                  <div class="offset-lg-2 col-lg-5 col-md-5 d-md-block d-none">
                    <div class="s_img text-center">
                      <img src="images/stock/demo.jpg" class="img-fluid" alt="tinyone">
                    </div>
                  </div>
                </div>
              </div>
              <!-- items end-->
              <!-- items start-->

              <div class="carousel-item">
                <div class="row align-items-center">
                  <!-- s_content-->
                  <div class="col-lg-5 col-md-7">
                    <div class="s_content">
                      <h1>স্যামসাং গ্যালাক্সি মুঠোফোনের পরবর্তী সংযোজন</h1>
                      <h3>জনপ্রিয় গ্যালাক্সি সিরিজের নতুন ফোন বাজারে আনল স্যামসাং</h3>
                      <p>দক্ষিণ কোয়িয়ার প্রযুক্তি জায়ান্ট স্যামসাং, ফোন লঞ্চ করেছে। যার নাম এস২৪। এটি তাদের ২০২৪ সালের
                        জন্য ফ্ল্যাগশিপ। বলা হচ্ছে এখন পর্যন্ত সবচেয়ে শক্তিশালী ফোন এটি।</p>
                      <div class="col-lg-3 col-md-3">
                        <button type="submit" class="btn c_button">আরো পডুন</button>
                      </div>
                    </div>

                  </div>
                  <!-- s_img-->
                  <div class="offset-lg-2 col-lg-5 col-md-5 d-md-block d-none">
                    <div class="s_img text-center">
                      <img src="images/stock/demo.jpg" class="img-fluid" alt="tinyone">
                    </div>
                  </div>
                </div>
              </div>
              <!-- items end-->
              <!-- items start-->

              <div class="carousel-item">
                <div class="row align-items-center">
                  <!-- s_content-->
                  <div class="col-lg-5 col-md-7">
                    <div class="s_content">
                      <h1>স্যামসাং গ্যালাক্সি মুঠোফোনের পরবর্তী সংযোজন</h1>
                      <h3>জনপ্রিয় গ্যালাক্সি সিরিজের নতুন ফোন বাজারে আনল স্যামসাং</h3>
                      <p>দক্ষিণ কোয়িয়ার প্রযুক্তি জায়ান্ট স্যামসাং, ফোন লঞ্চ করেছে। যার নাম এস২৪। এটি তাদের ২০২৪ সালের
                        জন্য ফ্ল্যাগশিপ। বলা হচ্ছে এখন পর্যন্ত সবচেয়ে শক্তিশালী ফোন এটি।</p>
                      <div class="col-lg-3 col-md-3">
                        <button type="submit" class="btn c_button">আরো পডুন</button>
                      </div>
                    </div>

                  </div>
                  <!-- s_img-->
                  <div class="offset-lg-2 col-lg-5 col-md-5 d-md-block d-none">
                    <div class="s_img text-center">
                      <img src="images/stock/demo.jpg" class="img-fluid" alt="tinyone">
                    </div>
                  </div>
                </div>
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
        <!-- কার্ড শুরু -->
        <div class="col">
          <div class="card h-100 my-card">
            <img src="images/stock/demo.jpg" class="card-img-top" alt="Palm Springs Road" />
            <div class="card-body">
              <h5 class="card-title">স্যামসাং গ্যালাক্সি মুঠোফোনের পরবর্তী সংযোজন</h5>
              <p class="card-text">
                দক্ষিণ কোয়িয়ার প্রযুক্তি জায়ান্ট স্যামসাং, ফোন লঞ্চ করেছে। যার নাম এস২৪। এটি তাদের ২০২৪ সালের জন্য
                ফ্ল্যাগশিপ। বলা হচ্ছে
                এখন পর্যন্ত সবচেয়ে শক্তিশালী ফোন এটি।
              </p>
            </div>
            <div class="card-footer">
              <small class="text-muted">৫/৯/২০২৩ ১২ঃ৩০ এ প্রকাশিত</small>
            </div>
          </div>
        </div>
        <!-- কার্ড শেষ -->
        <!-- কার্ড শুরু -->
        <div class="col">
          <div class="card h-100 my-card">
            <img src="images/stock/demo.jpg" class="card-img-top" alt="Palm Springs Road" />
            <div class="card-body">
              <h5 class="card-title">স্যামসাং গ্যালাক্সি মুঠোফোনের পরবর্তী সংযোজন</h5>
              <p class="card-text">
                দক্ষিণ কোয়িয়ার প্রযুক্তি জায়ান্ট স্যামসাং, ফোন লঞ্চ করেছে। যার নাম এস২৪। এটি তাদের ২০২৪ সালের জন্য
                ফ্ল্যাগশিপ। বলা হচ্ছে
                এখন পর্যন্ত সবচেয়ে শক্তিশালী ফোন এটি।
              </p>
            </div>
            <div class="card-footer">
              <small class="text-muted">৫/৯/২০২৩ ১২ঃ৩০ এ প্রকাশিত</small>
            </div>
          </div>
        </div>
        <!-- কার্ড শেষ -->
        <!-- কার্ড শুরু -->
        <div class="col">
          <div class="card h-100 my-card">
            <img src="images/stock/demo.jpg" class="card-img-top" alt="Palm Springs Road" />
            <div class="card-body">
              <h5 class="card-title">স্যামসাং গ্যালাক্সি মুঠোফোনের পরবর্তী সংযোজন</h5>
              <p class="card-text">
                দক্ষিণ কোয়িয়ার প্রযুক্তি জায়ান্ট স্যামসাং, ফোন লঞ্চ করেছে। যার নাম এস২৪। এটি তাদের ২০২৪ সালের জন্য
                ফ্ল্যাগশিপ। বলা হচ্ছে
                এখন পর্যন্ত সবচেয়ে শক্তিশালী ফোন এটি।
              </p>
            </div>
            <div class="card-footer">
              <small class="text-muted">৫/৯/২০২৩ ১২ঃ৩০ এ প্রকাশিত</small>
            </div>
          </div>
        </div>
        <!-- কার্ড শেষ -->
        <!-- কার্ড শুরু -->
        <div class="col">
          <div class="card h-100 my-card">
            <img src="images/stock/demo.jpg" class="card-img-top" alt="Palm Springs Road" />
            <div class="card-body">
              <h5 class="card-title">স্যামসাং গ্যালাক্সি মুঠোফোনের পরবর্তী সংযোজন</h5>
              <p class="card-text">
                দক্ষিণ কোয়িয়ার প্রযুক্তি জায়ান্ট স্যামসাং, ফোন লঞ্চ করেছে। যার নাম এস২৪। এটি তাদের ২০২৪ সালের জন্য
                ফ্ল্যাগশিপ। বলা হচ্ছে
                এখন পর্যন্ত সবচেয়ে শক্তিশালী ফোন এটি।
              </p>
            </div>
            <div class="card-footer">
              <small class="text-muted">৫/৯/২০২৩ ১২ঃ৩০ এ প্রকাশিত</small>
            </div>
          </div>
        </div>
        <!-- কার্ড শেষ -->
        <!-- কার্ড শুরু -->
        <div class="col">
          <div class="card h-100 my-card">
            <img src="images/stock/demo.jpg" class="card-img-top" alt="Palm Springs Road" />
            <div class="card-body">
              <h5 class="card-title">স্যামসাং গ্যালাক্সি মুঠোফোনের পরবর্তী সংযোজন</h5>
              <p class="card-text">
                দক্ষিণ কোয়িয়ার প্রযুক্তি জায়ান্ট স্যামসাং, ফোন লঞ্চ করেছে। যার নাম এস২৪। এটি তাদের ২০২৪ সালের জন্য
                ফ্ল্যাগশিপ। বলা হচ্ছে
                এখন পর্যন্ত সবচেয়ে শক্তিশালী ফোন এটি।
              </p>
            </div>
            <div class="card-footer">
              <small class="text-muted">৫/৯/২০২৩ ১২ঃ৩০ এ প্রকাশিত</small>
            </div>
          </div>
        </div>
        <!-- কার্ড শেষ -->
        <!-- কার্ড শুরু -->
        <div class="col">
          <div class="card h-100 my-card">
            <img src="images/stock/demo.jpg" class="card-img-top" alt="Palm Springs Road" />
            <div class="card-body">
              <h5 class="card-title">স্যামসাং গ্যালাক্সি মুঠোফোনের পরবর্তী সংযোজন</h5>
              <p class="card-text">
                দক্ষিণ কোয়িয়ার প্রযুক্তি জায়ান্ট স্যামসাং, ফোন লঞ্চ করেছে। যার নাম এস২৪। এটি তাদের ২০২৪ সালের জন্য
                ফ্ল্যাগশিপ। বলা হচ্ছে
                এখন পর্যন্ত সবচেয়ে শক্তিশালী ফোন এটি।
              </p>
            </div>
            <div class="card-footer">
              <small class="text-muted">৫/৯/২০২৩ ১২ঃ৩০ এ প্রকাশিত</small>
            </div>
          </div>
        </div>
        <!-- কার্ড শেষ -->
        <!-- কার্ড শুরু -->
        <div class="col">
          <div class="card h-100 my-card">
            <img src="images/stock/demo.jpg" class="card-img-top" alt="Palm Springs Road" />
            <div class="card-body">
              <h5 class="card-title">স্যামসাং গ্যালাক্সি মুঠোফোনের পরবর্তী সংযোজন</h5>
              <p class="card-text">
                দক্ষিণ কোয়িয়ার প্রযুক্তি জায়ান্ট স্যামসাং, ফোন লঞ্চ করেছে। যার নাম এস২৪। এটি তাদের ২০২৪ সালের জন্য
                ফ্ল্যাগশিপ। বলা হচ্ছে
                এখন পর্যন্ত সবচেয়ে শক্তিশালী ফোন এটি।
              </p>
            </div>
            <div class="card-footer">
              <small class="text-muted">৫/৯/২০২৩ ১২ঃ৩০ এ প্রকাশিত</small>
            </div>
          </div>
        </div>
        <!-- কার্ড শেষ -->
        <!-- কার্ড শুরু -->
        <div class="col">
          <div class="card h-100 my-card">
            <img src="images/stock/demo.jpg" class="card-img-top" alt="Palm Springs Road" />
            <div class="card-body">
              <h5 class="card-title">স্যামসাং গ্যালাক্সি মুঠোফোনের পরবর্তী সংযোজন</h5>
              <p class="card-text">
                দক্ষিণ কোয়িয়ার প্রযুক্তি জায়ান্ট স্যামসাং, ফোন লঞ্চ করেছে। যার নাম এস২৪। এটি তাদের ২০২৪ সালের জন্য
                ফ্ল্যাগশিপ। বলা হচ্ছে
                এখন পর্যন্ত সবচেয়ে শক্তিশালী ফোন এটি।
              </p>
            </div>
            <div class="card-footer">
              <small class="text-muted">৫/৯/২০২৩ ১২ঃ৩০ এ প্রকাশিত</small>
            </div>
          </div>
        </div>
        <!-- কার্ড শেষ -->
      </div>
      <!-- Vertical Card Start -->
      <div style="margin-top: 20px;">
        <h2><a href="#" class="latest-link">সর্বশেষ <span style="font-size: 120%;">&gt;</span></a></h2>
      </div>
      <div class="row row-cols-1 row-cols-md-4 g-4 verticle-card-row">
        <!-- Single Card Start -->
        <div class="col-md-6 verticle-card-col">
          <div class="card mb-3 verticle-card">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="images/stock/demo.jpg" class="img-fluid rounded-start" alt="..."
                  style="object-fit: cover; width: 100%; height: 100%;">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">স্যামসাং গ্যালাক্সি মুঠোফোনের পরবর্তী সংযোজন</h5>
                  <p class="card-text">দক্ষিণ কোয়িয়ার প্রযুক্তি জায়ান্ট স্যামসাং, ফোন লঞ্চ করেছে। যার নাম এস২৪। এটি
                    তাদের ২০২৪ সালের জন্য
                    ফ্ল্যাগশিপ। বলা হচ্ছে
                    এখন পর্যন্ত সবচেয়ে শক্তিশালী ফোন এটি।</p>
                  <p class="card-text"><small class="text-muted">৫/৯/২০২৩ ১২ঃ৩০ এ প্রকাশিত</small></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Single Card End -->
        <!-- Single Card Start -->
        <div class="col-md-6 verticle-card-col">
          <div class="card mb-3 verticle-card">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="images/stock/demo.jpg" class="img-fluid rounded-start" alt="..."
                  style="object-fit: cover; width: 100%; height: 100%;">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">স্যামসাং গ্যালাক্সি মুঠোফোনের পরবর্তী সংযোজন</h5>
                  <p class="card-text">দক্ষিণ কোয়িয়ার প্রযুক্তি জায়ান্ট স্যামসাং, ফোন লঞ্চ করেছে। যার নাম এস২৪। এটি
                    তাদের ২০২৪ সালের জন্য
                    ফ্ল্যাগশিপ। বলা হচ্ছে
                    এখন পর্যন্ত সবচেয়ে শক্তিশালী ফোন এটি।</p>
                  <p class="card-text"><small class="text-muted">৫/৯/২০২৩ ১২ঃ৩০ এ প্রকাশিত</small></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Single Card End -->
      </div>
      <!-- Vertical Card End -->
      <div style="margin-top: 20px;">
        <h2><a href="#" class="latest-link">অন্যান্য <span style="font-size: 120%;">&gt;</span></a></h2>
      </div>
      <div class="row row-cols-1 row-cols-md-4 g-4">
        <!-- কার্ড শুরু -->
        <div class="col">
          <div class="card h-100 my-card">
            <img src="images/stock/demo.jpg" class="card-img-top" alt="Palm Springs Road" />
            <div class="card-body">
              <h5 class="card-title">স্যামসাং গ্যালাক্সি মুঠোফোনের পরবর্তী সংযোজন</h5>
              <p class="card-text">
                দক্ষিণ কোয়িয়ার প্রযুক্তি জায়ান্ট স্যামসাং, ফোন লঞ্চ করেছে। যার নাম এস২৪। এটি তাদের ২০২৪ সালের জন্য
                ফ্ল্যাগশিপ। বলা হচ্ছে
                এখন পর্যন্ত সবচেয়ে শক্তিশালী ফোন এটি।
              </p>
            </div>
            <div class="card-footer">
              <small class="text-muted">৫/৯/২০২৩ ১২ঃ৩০ এ প্রকাশিত</small>
            </div>
          </div>
        </div>
        <!-- কার্ড শেষ -->
        <!-- কার্ড শুরু -->
        <div class="col">
          <div class="card h-100 my-card">
            <img src="images/stock/demo.jpg" class="card-img-top" alt="Palm Springs Road" />
            <div class="card-body">
              <h5 class="card-title">স্যামসাং গ্যালাক্সি মুঠোফোনের পরবর্তী সংযোজন</h5>
              <p class="card-text">
                দক্ষিণ কোয়িয়ার প্রযুক্তি জায়ান্ট স্যামসাং, ফোন লঞ্চ করেছে। যার নাম এস২৪। এটি তাদের ২০২৪ সালের জন্য
                ফ্ল্যাগশিপ। বলা হচ্ছে
                এখন পর্যন্ত সবচেয়ে শক্তিশালী ফোন এটি।
              </p>
            </div>
            <div class="card-footer">
              <small class="text-muted">৫/৯/২০২৩ ১২ঃ৩০ এ প্রকাশিত</small>
            </div>
          </div>
        </div>
        <!-- কার্ড শেষ -->
        <!-- কার্ড শুরু -->
        <div class="col">
          <div class="card h-100 my-card">
            <img src="images/stock/demo.jpg" class="card-img-top" alt="Palm Springs Road" />
            <div class="card-body">
              <h5 class="card-title">স্যামসাং গ্যালাক্সি মুঠোফোনের পরবর্তী সংযোজন</h5>
              <p class="card-text">
                দক্ষিণ কোয়িয়ার প্রযুক্তি জায়ান্ট স্যামসাং, ফোন লঞ্চ করেছে। যার নাম এস২৪। এটি তাদের ২০২৪ সালের জন্য
                ফ্ল্যাগশিপ। বলা হচ্ছে
                এখন পর্যন্ত সবচেয়ে শক্তিশালী ফোন এটি।
              </p>
            </div>
            <div class="card-footer">
              <small class="text-muted">৫/৯/২০২৩ ১২ঃ৩০ এ প্রকাশিত</small>
            </div>
          </div>
        </div>
        <!-- কার্ড শেষ -->
        <!-- কার্ড শুরু -->
        <div class="col">
          <div class="card h-100 my-card">
            <img src="images/stock/demo.jpg" class="card-img-top" alt="Palm Springs Road" />
            <div class="card-body">
              <h5 class="card-title">স্যামসাং গ্যালাক্সি মুঠোফোনের পরবর্তী সংযোজন</h5>
              <p class="card-text">
                দক্ষিণ কোয়িয়ার প্রযুক্তি জায়ান্ট স্যামসাং, ফোন লঞ্চ করেছে। যার নাম এস২৪। এটি তাদের ২০২৪ সালের জন্য
                ফ্ল্যাগশিপ। বলা হচ্ছে
                এখন পর্যন্ত সবচেয়ে শক্তিশালী ফোন এটি।
              </p>
            </div>
            <div class="card-footer">
              <small class="text-muted">৫/৯/২০২৩ ১২ঃ৩০ এ প্রকাশিত</small>
            </div>
          </div>
        </div>
        <!-- কার্ড শেষ -->
        <!-- কার্ড শুরু -->
        <div class="col">
          <div class="card h-100 my-card">
            <img src="images/stock/demo.jpg" class="card-img-top" alt="Palm Springs Road" />
            <div class="card-body">
              <h5 class="card-title">স্যামসাং গ্যালাক্সি মুঠোফোনের পরবর্তী সংযোজন</h5>
              <p class="card-text">
                দক্ষিণ কোয়িয়ার প্রযুক্তি জায়ান্ট স্যামসাং, ফোন লঞ্চ করেছে। যার নাম এস২৪। এটি তাদের ২০২৪ সালের জন্য
                ফ্ল্যাগশিপ। বলা হচ্ছে
                এখন পর্যন্ত সবচেয়ে শক্তিশালী ফোন এটি।
              </p>
            </div>
            <div class="card-footer">
              <small class="text-muted">৫/৯/২০২৩ ১২ঃ৩০ এ প্রকাশিত</small>
            </div>
          </div>
        </div>
        <!-- কার্ড শেষ -->
        <!-- কার্ড শুরু -->
        <div class="col">
          <div class="card h-100 my-card">
            <img src="images/stock/demo.jpg" class="card-img-top" alt="Palm Springs Road" />
            <div class="card-body">
              <h5 class="card-title">স্যামসাং গ্যালাক্সি মুঠোফোনের পরবর্তী সংযোজন</h5>
              <p class="card-text">
                দক্ষিণ কোয়িয়ার প্রযুক্তি জায়ান্ট স্যামসাং, ফোন লঞ্চ করেছে। যার নাম এস২৪। এটি তাদের ২০২৪ সালের জন্য
                ফ্ল্যাগশিপ। বলা হচ্ছে
                এখন পর্যন্ত সবচেয়ে শক্তিশালী ফোন এটি।
              </p>
            </div>
            <div class="card-footer">
              <small class="text-muted">৫/৯/২০২৩ ১২ঃ৩০ এ প্রকাশিত</small>
            </div>
          </div>
        </div>
        <!-- কার্ড শেষ -->
        <!-- কার্ড শুরু -->
        <div class="col">
          <div class="card h-100 my-card">
            <img src="images/stock/demo.jpg" class="card-img-top" alt="Palm Springs Road" />
            <div class="card-body">
              <h5 class="card-title">স্যামসাং গ্যালাক্সি মুঠোফোনের পরবর্তী সংযোজন</h5>
              <p class="card-text">
                দক্ষিণ কোয়িয়ার প্রযুক্তি জায়ান্ট স্যামসাং, ফোন লঞ্চ করেছে। যার নাম এস২৪। এটি তাদের ২০২৪ সালের জন্য
                ফ্ল্যাগশিপ। বলা হচ্ছে
                এখন পর্যন্ত সবচেয়ে শক্তিশালী ফোন এটি।
              </p>
            </div>
            <div class="card-footer">
              <small class="text-muted">৫/৯/২০২৩ ১২ঃ৩০ এ প্রকাশিত</small>
            </div>
          </div>
        </div>
        <!-- কার্ড শেষ -->
        <!-- কার্ড শুরু -->
        <div class="col">
          <div class="card h-100 my-card">
            <img src="images/stock/demo.jpg" class="card-img-top" alt="Palm Springs Road" />
            <div class="card-body">
              <h5 class="card-title">স্যামসাং গ্যালাক্সি মুঠোফোনের পরবর্তী সংযোজন</h5>
              <p class="card-text">
                দক্ষিণ কোয়িয়ার প্রযুক্তি জায়ান্ট স্যামসাং, ফোন লঞ্চ করেছে। যার নাম এস২৪। এটি তাদের ২০২৪ সালের জন্য
                ফ্ল্যাগশিপ। বলা হচ্ছে
                এখন পর্যন্ত সবচেয়ে শক্তিশালী ফোন এটি।
              </p>
            </div>
            <div class="card-footer">
              <small class="text-muted">৫/৯/২০২৩ ১২ঃ৩০ এ প্রকাশিত</small>
            </div>
          </div>
        </div>
        <!-- কার্ড শেষ -->
      </div>
      <div class="col-lg-2 col-md-2 container-fluid">
        <button type="submit" class="btn c_button" style="margin-top: 5rem;">আরো দেখুন</button>
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
          <a href="your-link-here"> <!-- Add your link within the href attribute -->
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
          <a href="your-link-here"> <!-- Add your link within the href attribute -->
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
          <a href="your-link-here"> <!-- Add your link within the href attribute -->
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
          <a href="your-link-here"> <!-- Add your link within the href attribute -->
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
          <a href="your-link-here"> <!-- Add your link within the href attribute -->
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
          <a href="your-link-here"> <!-- Add your link within the href attribute -->
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
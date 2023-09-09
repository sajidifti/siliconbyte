<?php

session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or display a message
    $error = "পাতাটি দেখতে আগে সাইনইন করুন।";
    header("Location: signin_page.php?error=" . urlencode($error));
    exit();
}

if (isset($_SESSION['role'])) {

    if ($_SESSION['role'] != "admin") {
        // Redirect to the login page or display a message
        $error = "পাতাটি শুধুমাত্র ব্যবস্থাপকদের জন্য বরাদ্দ।";
        header("Location: index.php?error=" . urlencode($error));
        exit();
    }

}
// Include the database connection file
include 'db-connection.php'; // Replace with the actual path to your database connection file

// Initialize variables to store data
$analyticsData = array();
$visitsData = array();
$contactsData = array(); // Added a new array for contacts data

// Query to retrieve data from the Analytics table
$analyticsQuery = "SELECT id, event_type, event_description, event_datetime FROM Analytics ORDER BY event_datetime DESC LIMIT 10";

// Execute the query
$analyticsResult = $conn->query($analyticsQuery);

// Check if the query was successful
if ($analyticsResult) {
    // Fetch data from the Analytics table and store it in the $analyticsData array
    while ($row = $analyticsResult->fetch_assoc()) {
        $analyticsData[] = $row;
    }
} else {
    // Handle any database query errors for the Analytics table
    echo "Error: ";
}

// Query to retrieve data from the Visits table
$visitsQuery = "SELECT id, ip_address, visit_datetime FROM Visits ORDER BY visit_datetime DESC LIMIT 10";

// Execute the query
$visitsResult = $conn->query($visitsQuery);

// Check if the query was successful
if ($visitsResult) {
    // Fetch data from the Visits table and store it in the $visitsData array
    while ($row = $visitsResult->fetch_assoc()) {
        $visitsData[] = $row;
    }
} else {
    // Handle any database query errors for the Visits table
    echo "Error: ";
}

// Query to retrieve data from the Contacts table (corrected variable names)
$contactsQuery = "SELECT contact_id, email FROM Contacts ORDER BY contact_id DESC LIMIT 10";

// Execute the query
$contactsResult = $conn->query($contactsQuery);

// Check if the query was successful
if ($contactsResult) {
    // Fetch data from the Contacts table and store it in the $contactsData array
    while ($row = $contactsResult->fetch_assoc()) {
        $contactsData[] = $row;
    }
} else {
    // Handle any database query errors for the Contacts table
    echo "Error: ";
}

// Close the database connection
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
                                        <a class="nav-link active-link" href="admin.php">ব্যাবস্থাপনা</a>
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

    <section class="admin">
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="c_title text-center">
                        <h1 class="c_h1 yellow form-title">ব্যাবস্থাপনা পাতা</h1>
                        <p class="c_p ash">সব তথ্য দেখুন</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="c_title text-center">
                        <strong class="c_p ash">পরিসংখ্যান</strong>
                    </div>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>আইডি</th>
                            <th>ঘটনা</th>
                            <th>বর্ণনা</th>
                            <th>তারিখ ও সময়</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Loop through and display data from the Analytics table
                        foreach ($analyticsData as $row) {
                            echo '<tr>';
                            echo '<td>' . $row['id'] . '</td>';
                            echo '<td>' . $row['event_type'] . '</td>';
                            echo '<td>' . $row['event_description'] . '</td>';
                            echo '<td>' . $row['event_datetime'] . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="row justify-content-center" style="margin-top: 50px;">
                <div class="col-lg-9">
                    <div class="c_title text-center">
                        <strong class="c_p ash">ভিজিটের তথ্য</strong>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>আইডি</th>
                            <th>আইপি এড্রেস</th>
                            <th>তারিখ ও সময়</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Loop through and display data from the Visits table
                        foreach ($visitsData as $row) {
                            echo '<tr>';
                            echo '<td>' . $row['id'] . '</td>';
                            echo '<td>' . $row['ip_address'] . '</td>';
                            echo '<td>' . $row['visit_datetime'] . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>


            <div class="row justify-content-center" style="margin-top: 50px;">
                <div class="col-lg-9">
                    <div class="c_title text-center">
                        <strong class="c_p ash">যোগাযোগ তথ্য</strong>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>আইডি</th>
                            <th>ইমেইল ঠিকানা</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Loop through and display data from the Visits table
                        foreach ($contactsData as $row) {
                            echo '<tr>';
                            echo '<td>' . $row['contact_id'] . '</td>';
                            echo '<td>' . $row['email'] . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
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
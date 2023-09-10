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

<!-- Header -->
<?php
include_once('pagename.php');
$page = 'admin';

include_once('header.php');

include_once('message.php');

?>

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

<?php

// Include the footer file
include_once('footer.php');

?>

</body>

</html>
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

    if ($_SESSION['role'] != "writer") {
        // Redirect to the login page or display a message
        $error = "পাতাটি শুধুমাত্র লেখকদের জন্য বরাদ্দ।";
        header("Location: index.php?error=" . urlencode($error));
        exit();
    }

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
<!-- Header -->
<?php
include_once('pagename.php');
$page = 'post';

include_once('header.php');

include_once('message.php');

?>

<section class="post">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="c_title text-center">
                    <h1 class="c_h1 yellow form-title">প্রতিবেদন লিখুন</h1>
                    <p class="c_p ash">শিরোনাম, সারাংশ, বর্ণনা, ও ছবি দিয়ে খবর প্রকাশ করুন</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="c_form">
                    <form action="post.php" method="POST" enctype="multipart/form-data">
                        <div class="row g-3 justify-content-center">
                            <!-- Article Title -->
                            <div class="col-lg-9 col-md-9">
                                <input type="text" class="form-control" id="title" name="title" required
                                    placeholder="শিরোনাম">
                            </div>

                            <!-- Article Summary -->
                            <div class="col-lg-9 col-md-9">
                                <textarea class="form-control" id="summary" name="summary" maxlength="50" required
                                    placeholder="সারাংশ (৫০ অক্ষরের মধ্যে)"></textarea>
                            </div>

                            <!-- Article Content -->
                            <div class="col-lg-9 col-md-9">
                                <textarea class="form-control" id="content" name="content" rows="5" required
                                    placeholder="বর্ণনা"></textarea>
                            </div>

                            <!-- Article Photo -->
                            <div class="col-lg-9 col-md-9">
                                <input type="file" class="form-control" id="photo" name="photo" accept="image/*"
                                    required placeholder="ছবি">
                            </div>

                            <!-- Article Category -->
                            <div class="col-lg-9 col-md-9">
                                <label for="category" class="form-label">বিভাগ</label>
                                <select class="form-select" id="category" name="category" required>
                                    <option value="smartphone">Smartphone</option>
                                    <option value="pc">PC</option>
                                    <option value="software">Software</option>
                                    <option value="tutorial">Tutorial</option>
                                    <option value="programing">Programing</option>
                                    <option value="gaming">Gaming</option>
                                </select>
                            </div>

                            <!-- Tags -->
                            <!-- Tags -->
                            <div class="col-lg-9 col-md-9">
                                <div class="d-flex justify-content-center text-center">

                                    <?php
                                    // Include the database connection file
                                    include 'db-connection.php';

                                    // Retrieve tags from the Tags table
                                    $sql = "SELECT * FROM Tags";
                                    $result = $conn->query($sql);

                                    // Create five tag select fields
                                    for ($i = 1; $i <= 5; $i++) {
                                        echo '<div class="me-3 d-inline-block">'; // Add the d-inline-block class here
                                        echo '<label for="tags' . $i . '" class="form-label">ট্যাগ ' . $i . '</label>';
                                        echo '<select class="form-select" id="tags' . $i . '" name="tag' . $i . '">'; // Note the name="tag1", "tag2", etc.
                                    
                                        // Populate the select list with options
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row['tag_id'] . '">' . $row['tag_name'] . '</option>';
                                        }

                                        echo '</select>';
                                        echo '</div>';

                                        // Reset the result pointer to the beginning for the next select list
                                        $result->data_seek(0);
                                    }

                                    // Close the database connection
                                    $conn->close();
                                    ?>

                                </div>
                            </div>


                            <!-- End tag -->





                        </div>
                        <!-- Submit Button -->
                        <div class="col-lg-2 col-md-2 container-fluid">
                            <button type="submit" class="btn c_button" style="margin-top: 5rem;">প্রকাশ
                                করুন</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php

// Include the footer file
include_once('footer.php');

?>

</body>

</html>
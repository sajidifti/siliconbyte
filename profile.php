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
<!-- Header -->
<?php
include_once('pagename.php');
$page = 'profile';

include_once('header.php');

include_once('message.php');

?>

<!-- contact start-->
<section class="custom-form-section" id="signin">
    <div class="container">
        <!-- 1st row-->
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="c_title text-center">
                    <h1 class="c_h1 yellow form-title">প্রোফাইল</h1>
                    <p class="c_p ash">আপনার তথ্য দেখুন এবং পরিবর্তন করুন</p>
                </div>
            </div>
        </div>
        <!-- 2nd row-->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="c_form">
                    <form method="POST" action="updateprofile.php" enctype="multipart/form-data">
                        <div class="row g-3 justify-content-center">
                            <!-- Image Preview -->
                            <div class="col-lg-8 col-md-8 d-flex justify-content-center align-items-center">
                                <label for="profile-picture" class="form-label"></label>
                                <input type="file" class="form-control" id="profile-picture" name="profile-picture"
                                    accept="image/*" style="display: none;" onchange="previewImage(this);">
                                <!-- Wrap the image and apply circular cropping within a div -->
                                <div id="image-preview-wrapper">
                                    <!-- Wrap the image preview within a label element to make it clickable -->
                                    <label for="profile-picture" id="image-preview-label">
                                        <img id="image-preview" src="#" alt="আপনার ফটো প্রিভিউ">
                                        <span id="upload-text">প্রোফাইল ছবির জন্য<br>এখানে ক্লিক করুন</span>
                                    </label>
                                </div>
                            </div>
                            <!-- Image Preview -->
                            <div class="col-lg-8 col-md-8">
                                <input type="name" class="form-control c_email" placeholder="আপনার পুরো নাম লিখুন"
                                    name="name" required value="<?php echo $fullname; ?>">
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <input type="username" class="form-control c_email" placeholder="আপনার ইউজারনেম লিখুন"
                                    name="username" required value="<?php echo $username; ?>">
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <input type="email" class="form-control c_email"
                                    placeholder="আপনার ইমেইল ঠিকানাটি লিখুন" name="email" required
                                    value="<?php echo $email; ?>">
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7 container-fluid">
                            <div class="button-container">
                                <a type="submit" class="btn c_button alt-button" style="margin-top: 5rem;"
                                    href="password_page.php">পাসওয়ার্ড
                                    পরিবর্তন</a>
                                <?php if ($_SESSION['role'] == "writer"): ?>
                                    <a type="submit" class="btn c_button alt-button" style="margin-top: 5rem;"
                                        href="allpost.php">আপনার সব লেখা</a>
                                <?php endif; ?>
                                <button type="submit" class="btn c_button" style="margin-top: 5rem;">তথ্য
                                    সংরক্ষণ</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- contact end-->

<?php

// Include the footer file
include_once('footer.php');

?>


<script>
    window.addEventListener('load', function () {
        var profilePhotoUrl = "<?php echo $profile_photo; ?>";
        var imagePreview = document.getElementById('image-preview');
        var uploadText = document.getElementById('upload-text');
        imagePreview.src = profilePhotoUrl;
        imagePreview.style.display = 'block';
        uploadText.style.display = 'none';
    });
    function previewImage(input) {
        var imagePreview = document.getElementById('image-preview');
        var uploadText = document.getElementById('upload-text');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
                uploadText.style.display = 'none';
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            imagePreview.style.display = 'none';
            uploadText.style.display = 'block';
        }
    }
</script>

</body>

</html>
<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or display a message
    $error = "পাতাটি দেখতে আগে সাইনইন করুন।";
    header("Location: signin_page.php?error=" . urlencode($error));
    exit();
}
?>
<!-- Header -->
<?php

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
                    <h1 class="c_h1 yellow form-title">সাইন আপ করুন</h1>
                    <p class="c_p ash">আপনার তথ্য দিন</p>
                </div>
            </div>
        </div>
        <!-- 2nd row-->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="c_form">
                    <form method="POST" action="password.php" enctype="multipart/form-data">
                        <div class="row g-3 justify-content-center">
                            <div class="col-lg-8 col-md-8">
                                <input type="password" class="form-control c_email"
                                    placeholder="আপনার বর্তমান পাসওয়ার্ড লিখুন" name="old-password" required>
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <input type="password" class="form-control c_email" placeholder="নতুন পাসওয়ার্ড লিখুন"
                                    name="new-password" required>
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <input type="password" class="form-control c_email"
                                    placeholder="পাসওয়ার্ডটি পুনরায় লিখুন" name="confirm-password" required>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 container-fluid">
                            <button type="submit" class="btn c_button" style="margin-top: 5rem; width: 100%;">পরিবর্তন
                                এবং সাইনআউট</button>
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


</body>

</html>
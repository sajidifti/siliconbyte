<?php
session_start();
?>
<!-- Header -->
<?php
include_once('pagename.php');
$page = 'signup';

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
                    <form method="POST" action="signup.php" enctype="multipart/form-data">
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
                                    name="name" required>
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <input type="username" class="form-control c_email" placeholder="আপনার ইউজারনেম লিখুন"
                                    name="username" required>
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <input type="email" class="form-control c_email"
                                    placeholder="আপনার ইমেইল ঠিকানাটি লিখুন" name="email" required>
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <input type="password" class="form-control c_email" placeholder="আপনার পাসওয়ার্ড লিখুন"
                                    name="password" required>
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <input type="password" class="form-control c_email"
                                    placeholder="পাসওয়ার্ডটি পুনরায় লিখুন" name="confirm-password" required>
                            </div>

                        </div>
                        <div class="col-lg-2 col-md-2 container-fluid">
                            <button type="submit" class="btn c_button" style="margin-top: 5rem;">সাইন আপ</button>
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


<!--  Bootstrap JS link -->
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/c204687a77.js" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
<script>
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
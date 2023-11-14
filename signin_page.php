<?php
session_start();
?>
<!-- Header -->
<?php
include_once('pagename.php');
$page = 'signin';

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
                        <h1 class="c_h1 yellow form-title">সাইন ইন করুন</h1>
                        <p class="c_p ash">আপনার ইউজারনেম এবং পাসওয়ার্ড দিন</p>
                    </div>
                </div>
            </div>
            <!-- 2nd row-->
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="c_form">
                        <form method="POST" action="signin.php" enctype="multipart/form-data">
                            <div class="row g-3 justify-content-center">
                                <div class="col-lg-8 col-md-8">
                                    <input type="username" class="form-control c_email"
                                        placeholder="আপনার ইউজারনেম লিখুন" name="username" required>
                                </div>
                                <div class="col-lg-8 col-md-8">
                                    <input type="password" class="form-control c_email"
                                        placeholder="আপনার পাসওয়ার্ড লিখুন" name="password" required>
                                </div>
                                <div class="col-lg-8 col-md-8">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                            name="remember">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">আমাকে মনে
                                            রাখুন</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 container-fluid">
                                <button type="submit" class="btn c_button" style="margin-top: 5rem;">সাইন ইন</button>
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

</body>

</html>
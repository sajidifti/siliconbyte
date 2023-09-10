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
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

    <section class="articles">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8">
                    <!-- Main Article Section -->
                    <article>
                        <h1>Title of the Article</h1>
                        <p class="lead">Summary of the article goes here.</p>
                        <img src="images/stock/demo.jpg" alt="Article Photo" class="img-fluid mb-3">
                        <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt
                            debitis voluptas unde minima nobis omnis quisquam molestiae. Possimus rem alias, aspernatur
                            non eaque, accusantium corporis velit sapiente, incidunt deserunt debitis ipsam veniam
                            explicabo. Amet accusantium consequuntur quibusdam dolore nostrum rerum ratione iure aliquam
                            maxime porro atque voluptate perferendis, sunt quasi. Non, earum sunt qui quidem dolores
                            ullam. Numquam aperiam odit facilis ipsa eos error ratione necessitatibus ea ducimus sequi
                            molestias explicabo magni, rerum nam distinctio vel quos vero nisi nesciunt iure deserunt
                            nulla perspiciatis cum. Voluptatibus, adipisci! Voluptas tempora dignissimos et nemo dolore
                            alias minus quasi odit vel culpa, maxime maiores, non quas nihil officia quod, modi ut.
                            Molestias sit illum eius. Minus nihil dolorum, eum iusto, ratione vel modi aspernatur, rem
                            dolores architecto tempore magni explicabo reprehenderit. Mollitia dignissimos odio, illo
                            adipisci nostrum possimus eos animi! Odio iste dolores et fugit nam soluta recusandae nobis
                            molestiae ipsam optio suscipit nostrum ullam culpa nulla, cum natus, quidem vel fuga magni
                            perspiciatis quibusdam. Doloribus, tempora dolores officia, culpa veniam consequuntur ipsum
                            odit hic iusto ullam voluptates reprehenderit tempore animi recusandae veritatis temporibus
                            deleniti dolorum deserunt quos. Suscipit, incidunt quidem porro quia molestiae facere
                            similique ea! Impedit, dicta tenetur architecto sapiente voluptatibus mollitia placeat minus
                            nostrum, molestiae iure numquam corporis temporibus suscipit iusto, nulla laboriosam eaque.
                            Saepe perferendis recusandae quia explicabo quod sapiente maiores iste obcaecati corrupti
                            non vitae, cupiditate quos rem magni dignissimos ab placeat excepturi aspernatur cumque est
                            sunt expedita autem fuga ea! Facilis, doloribus nulla hic suscipit omnis culpa libero iste
                            dolor odit dolore nesciunt perspiciatis esse id minima pariatur nisi quisquam aperiam
                            tempore accusantium quam quod. Exercitationem adipisci nesciunt laudantium cum itaque rerum
                            sit porro. Veritatis eius consectetur harum molestias magnam eveniet nesciunt consequatur
                            dolorem porro eligendi voluptatem eos illo sapiente minima labore tenetur necessitatibus
                            minus deserunt autem amet quam, perferendis beatae. Necessitatibus delectus, id, suscipit
                            molestias nesciunt culpa, adipisci nobis numquam aspernatur tempora eius tempore quibusdam
                            eligendi reprehenderit natus quaerat sunt sapiente repellat! Magnam laudantium cumque et
                            tenetur quos sint quisquam quo enim, voluptatum, ipsam pariatur numquam esse quibusdam
                            ducimus impedit ullam rem, facilis maiores natus? Architecto iusto eveniet consectetur
                            similique nulla delectus laudantium quasi tenetur dolorum velit molestias minus dolorem
                            assumenda provident dolor, ad alias vitae voluptas. Neque labore quo vel explicabo nulla
                            amet voluptatibus beatae corrupti non aut esse sint quidem, impedit voluptatem! Repellendus
                            tenetur nostrum explicabo facilis qui suscipit, error dolores voluptatum vel placeat?
                            Quidem, aperiam minima quos asperiores repellat obcaecati eos consectetur blanditiis
                            accusantium perferendis doloribus accusamus voluptatem eius id quae dolore aliquam
                            reprehenderit, similique exercitationem distinctio voluptate quibusdam assumenda ipsum? Quod
                            reiciendis tenetur, dolores distinctio vero ipsum nemo voluptatem quidem ut velit facilis
                            voluptatum doloremque accusamus inventore voluptate id asperiores sint consequatur tempora,
                            ad commodi eum. Doloribus ipsa dolor, beatae excepturi cumque molestiae commodi eius dicta
                            neque? Praesentium consequatur ullam cum, ipsa dolorum quaerat officiis, natus hic et porro
                            perferendis consequuntur itaque eius explicabo quibusdam. Porro consectetur sed nesciunt,
                            amet quam quasi autem molestiae non nam velit. Harum recusandae architecto hic, officiis
                            dolorum dolore. Dicta cum omnis iusto? Natus inventore nihil veritatis iusto earum
                            voluptatibus, rerum, ipsum consectetur quae qui consequuntur aliquam totam distinctio. Ea
                            enim quia beatae voluptas incidunt delectus nemo dolores! Facilis voluptatem perferendis
                            labore atque? Alias magnam cumque tenetur dolorem vero officia possimus obcaecati ex ipsum
                            animi laboriosam nam officiis quis mollitia repellendus suscipit sit soluta veritatis,
                            labore nihil, perferendis aliquid? Fugit, pariatur facere autem dolor, quia debitis
                            corrupti, ut minima molestias deleniti id eos corporis nam porro quas minus voluptatibus
                            officia assumenda. Voluptatibus dignissimos iusto vel rerum incidunt unde facilis
                            praesentium corporis facere quidem corrupti aliquam ut eveniet iure ipsam, consectetur
                            consequatur at et? Dolor sint molestiae dolorum error mollitia aliquid nemo praesentium quas
                            ut. Ab tempora nemo explicabo perferendis nisi repudiandae laboriosam beatae nulla vero
                            veritatis, totam rerum saepe iure accusamus odit maiores sunt officia voluptas eius
                            inventore! Eligendi quos necessitatibus deleniti rem? Molestias nostrum ducimus nam tempora
                            iusto? Dolorum, molestiae ipsum odit error officia assumenda harum iusto dolor laudantium
                            non soluta eveniet? Nulla dolore id nobis accusamus consequatur natus deserunt, atque
                            voluptatem nihil porro modi eaque corporis quas rem culpa quos delectus dolorum libero eius
                            quaerat temporibus laborum accusantium, veniam sapiente. Incidunt, repellendus officiis.
                            Nostrum hic error earum aperiam, distinctio eum ad reiciendis ullam fuga. Deleniti quidem
                            reprehenderit ut dicta aut iusto laudantium doloribus omnis pariatur veritatis optio
                            sapiente autem, eius esse, totam accusantium voluptatem! Quidem quis tenetur quae asperiores
                            vero fuga quo totam at nemo! Expedita minima iusto minus quam necessitatibus non provident
                            laboriosam, aperiam veritatis totam distinctio, nisi mollitia ipsa quasi molestiae id, omnis
                            qui ipsam unde aliquam illum! Asperiores, unde numquam, repellat itaque beatae inventore
                            tempora quasi, ipsum similique quisquam id perferendis neque nulla veniam necessitatibus
                            dolorum? Dicta, autem. Ullam ea molestiae nisi autem porro? Architecto, repudiandae
                            repellendus animi, aspernatur explicabo, earum eligendi perspiciatis quos harum molestias
                            tempore minus! Eum neque esse quod est eos tempora modi cumque ipsam ducimus id? Similique
                            porro nam esse blanditiis? Iure iste, esse fugit voluptate neque exercitationem inventore
                            non harum. Vero est culpa nam, impedit, animi laboriosam expedita repellendus ut quam quidem
                            labore possimus quaerat distinctio. Ut nam doloribus recusandae deserunt architecto, quas
                            illum magnam praesentium dicta possimus impedit, sint labore tempore illo corrupti quod
                            fugiat enim modi culpa similique? Alias inventore aperiam ipsum et itaque, autem error
                            velit? Debitis dolore animi vitae velit alias aperiam eos possimus inventore, iusto
                            consequuntur repellat sed architecto dolorem assumenda nostrum omnis esse provident nemo
                            quia doloribus! Mollitia sint at molestias eveniet esse! Eveniet unde nemo voluptatem
                            quaerat repellat mollitia, distinctio magni fuga. Incidunt ratione nobis velit inventore
                            omnis laudantium ducimus cumque accusamus ipsam assumenda porro unde sequi accusantium a
                            dolore alias iste at totam qui recusandae sit possimus, voluptatibus fugit adipisci. Eius
                            architecto non natus hic eum! Voluptatum, explicabo deserunt itaque corrupti nesciunt
                            similique iste ea dolorum ipsa impedit error animi molestias temporibus et optio omnis odio?
                            Inventore, ullam magnam vel quaerat quae vitae officia facilis modi dolorum id laboriosam
                            aliquam nostrum ut possimus minus accusamus? Aliquam natus delectus est.</p>
                    </article>
                </div>
                <div class="col-md-4">
                    <!-- Related Articles Section -->
                    <div class="mb-4">
                        <h2>Related Articles</h2>
                    </div>

                    <!-- Single Card Start -->
                    <div class="col verticle-card-col">
                        <a href="details-page.html" class="card-link">
                            <!-- Replace "details-page.html" with the actual URL of your details page -->
                            <div class="card mb-3 verticle-card">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="images/stock/demo.jpg" class="img-fluid rounded-start" alt="..."
                                            style="object-fit: cover; width: 100%; height: 100%;">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">স্যামসাং গ্যালাক্সি মুঠোফোনের পরবর্তী সংযোজন</h5>
                                            <p class="card-text">text</p>
                                            <p class="card-text"><small class="text-muted">৫/৯/২০২৩ ১২ঃ৩০ এ
                                                    প্রকাশিত</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- Single Card End -->

                    <!-- Single Card Start -->
                    <div class="col verticle-card-col">
                        <a href="details-page.html" class="card-link">
                            <!-- Replace "details-page.html" with the actual URL of your details page -->
                            <div class="card mb-3 verticle-card">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="images/stock/demo.jpg" class="img-fluid rounded-start" alt="..."
                                            style="object-fit: cover; width: 100%; height: 100%;">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">স্যামসাং গ্যালাক্সি মুঠোফোনের পরবর্তী সংযোজন</h5>
                                            <p class="card-text">text</p>
                                            <p class="card-text"><small class="text-muted">৫/৯/২০২৩ ১২ঃ৩০ এ
                                                    প্রকাশিত</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- Single Card End -->
                    <!-- Add more related articles as needed -->
                </div>
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
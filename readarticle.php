<?php
session_start();

if (!isset($_GET['article_id']) || empty($_GET['article_id'])) {
    // Redirect to the login page or display a message
    $error = "ভুল লিংক।";
    header("Location: articles.php?error=" . urlencode($error));
    exit();
}
?>
<!-- Header -->
<?php

include_once('header.php');

include_once('message.php');

?>

    <section class="articles">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8">
                    <!-- Main Article Section -->
                    <article>
                        <?php
                        // Include the database connection file
                        include 'db-connection.php';

                        // Check if article_id is provided in the URL
                        if (isset($_GET['article_id'])) {
                            $article_id = $_GET['article_id'];

                            // Query to retrieve the article by article_id
                            $sql = "SELECT * FROM articles WHERE article_id = ?";
                            if ($stmt = $conn->prepare($sql)) {
                                $stmt->bind_param("i", $article_id);
                                if ($stmt->execute()) {
                                    $result = $stmt->get_result();

                                    // Check if the article exists
                                    if ($result->num_rows === 1) {
                                        $row = $result->fetch_assoc();
                                        $title = $row['title'];
                                        $summary = $row['summary'];
                                        $content = $row['content'];
                                        $article_photo = $row['article_photo'];
                                        $datetime = $row['DATETIME'];
                                        $user_id = $row['user_id'];

                                        // Format the datetime
                                        $formatted_datetime = date("j/n/Y H:i", strtotime($datetime)); // Adjust the date format as needed
                        
                                        // Query to retrieve the author's name from the users table
                                        $author_query = "SELECT fullname FROM users WHERE user_id = ?";
                                        if ($stmt_author = $conn->prepare($author_query)) {
                                            $stmt_author->bind_param("i", $user_id);
                                            if ($stmt_author->execute()) {
                                                $author_result = $stmt_author->get_result();
                                                $author_row = $author_result->fetch_assoc();
                                                $author = $author_row['fullname'];

                                                // Display the article details
                                                echo '<h1 class="article-title">' . $title . '</h1>';
                                                echo '<p class="lead">' . $summary . '</p>';
                                                echo '<p class="article-published"><small class="text-muted">' . $formatted_datetime . ' এ প্রকাশিত</small></p>';
                                                echo '<p class="article-published"><small class="text-muted">লিখেছেন ' . $author . '</small></p>';
                                                echo '<img src="' . $article_photo . '" alt="Article Photo" class="img-fluid mb-3 article-photo">';
                                                echo '<p class="article-body">' . $content . '</p>';
                                            } else {
                                                $error = "লেখকের তথ্য পেতে ত্রুটি।";
                                                header("Location: articles.php?error=" . urlencode($error));
                                                exit();
                                            }
                                            $stmt_author->close();
                                        } else {
                                            $error = "লেখক কুয়েরিতে ত্রুটি।";
                                            header("Location: articles.php?error=" . urlencode($error));
                                            exit();
                                        }
                                    } else {
                                        $error = "খবরটি পাওয়া যায়নি।";
                                        header("Location: articles.php?error=" . urlencode($error));
                                        exit();
                                    }
                                } else {
                                    $error = "কুয়েরি করতে ত্রুটি।";
                                    header("Location: articles.php?error=" . urlencode($error));
                                    exit();
                                }
                            } else {
                                $error = "কুয়েরিতে ত্রুটি।";
                                header("Location: articles.php?error=" . urlencode($error));
                                exit();
                            }

                            // Close the database connection
                            $stmt->close();

                            // Start Increase User Category and Tag Read Count
                        

                            // Check if the user is logged in and has a valid session
                            if (isset($_SESSION['user_id'])) {
                                // Get the user_id from the session
                                $user_id = $_SESSION['user_id'];

                                // Check if article_id is provided in the URL
                                if (isset($_GET['article_id'])) {
                                    $article_id = $_GET['article_id'];

                                    // Query to get the category of the article
                                    $get_category_query = "SELECT category FROM articles WHERE article_id = ?";
                                    if ($stmt_get_category = $conn->prepare($get_category_query)) {
                                        $stmt_get_category->bind_param("i", $article_id);
                                        $stmt_get_category->execute();
                                        $stmt_get_category->bind_result($category);
                                        $stmt_get_category->fetch();
                                        $stmt_get_category->close(); // Close this statement
                        
                                        if (!empty($category)) {
                                            // Increment the read count for the category in User_Category_Read_Count table
                                            $increment_category_read_query = "INSERT INTO user_category_read_count (user_id, category, read_count) 
                    VALUES (?, ?, 1) 
                    ON DUPLICATE KEY UPDATE read_count = read_count + 1";
                                            if ($stmt_increment_category_read = $conn->prepare($increment_category_read_query)) {
                                                $stmt_increment_category_read->bind_param("is", $user_id, $category);
                                                $stmt_increment_category_read->execute();
                                                $stmt_increment_category_read->close(); // Close this statement
                                            }
                                        }
                                    }
                                }
                            }

                            // Close the database connection here (if necessary)
                            $conn->close();



                            // End Increase User Category and Tag Read Count
                        } else {
                            $error = "ভুল আর্টিকেল আইডি।";
                            header("Location: articles.php?error=" . urlencode($error));
                            exit();
                        }
                        ?>
                    </article>
                </div>
                <div class="col-md-4">
                    <!-- Related Articles Section -->
                    <div class="mb-4">
                        <h2 class="related-articles">সম্পর্কিত আরো খবর</h2>
                    </div>

                    <?php
                    // Include the database connection file
                    include 'db-connection.php';

                    // Assuming you have the current article's ID
                    $current_article_id = $_GET['article_id']; // Replace with your method of retrieving the current article's ID
                    
                    // Query related articles based on categories or tags (modify the query as needed)
                    $sql = "
            SELECT DISTINCT A.article_id, A.title, A.summary, A.article_photo, A.DATETIME
            FROM articles A
            INNER JOIN article_tags AT ON A.article_id = AT.article_id
            INNER JOIN tags T ON AT.tag_id = T.tag_id
            WHERE AT.article_id != ? -- Exclude the current article
            AND (T.tag_name IN (
                SELECT T.tag_name
                FROM article_tags AT
                INNER JOIN tags T ON AT.tag_id = T.tag_id
                WHERE AT.article_id = ?
            ) OR A.category IN (
                SELECT A.category
                FROM articles A
                WHERE A.article_id = ?
            ))
            ORDER BY RAND()
            LIMIT 4
        ";

                    if ($stmt = $conn->prepare($sql)) {
                        $stmt->bind_param("iii", $current_article_id, $current_article_id, $current_article_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($row = $result->fetch_assoc()) {
                            // Extract data from the current row
                            $related_article_id = $row['article_id'];
                            $related_article_title = $row['title'];
                            $related_article_summary = $row['summary'];
                            $related_article_photo = $row['article_photo'];
                            $related_article_datetime = $row['DATETIME'];

                            // Format the datetime
                            $formatted_datetime = date("j/n/Y H:i", strtotime($related_article_datetime)); // Adjust the date format as needed
                    
                            // HTML for the related article card
                            echo '<div class="col verticle-card-col">';
                            echo '<a href="readarticle.php?article_id=' . $related_article_id . '" class="card-link">'; // Replace with your actual URL
                            echo '<div class="card mb-3 h-100 verticle-card">';
                            echo '<div class="row g-0">';
                            echo '<div class="col-md-4">';
                            echo '<img src="' . $related_article_photo . '" class="img-fluid rounded-start" alt="' . $related_article_title . '" style="object-fit: cover; width: 100%; height: 100%;">'; // Use the article_photo column as the image source
                            echo '</div>';
                            echo '<div class="col-md-8">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">' . $related_article_title . '</h5>';
                            echo '<p class="card-text">' . $related_article_summary . '</p>';
                            echo '<p class="card-text"><small class="text-muted">' . $formatted_datetime . ' এ প্রকাশিত</small></p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</a>';
                            echo '</div>';
                        }
                    } else {
                        // Handle the prepared statement error here
                        echo "Error: ";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>

                    <!-- Add more related articles as needed -->
                </div>
            </div>


            <!-- Show category and tags -->
            <div class="row">
                <div class="col">
                    <div class="tags category">
                        <?php
                        // Include the database connection file
                        include 'db-connection.php';

                        // Check if article_id is provided in the URL
                        if (isset($_GET['article_id'])) {
                            $article_id = $_GET['article_id'];

                            // Query to increment the views count of the article
                            $increment_views_query = "UPDATE articles SET views = views + 1 WHERE article_id = ?";
                            if ($stmt_increment_views = $conn->prepare($increment_views_query)) {
                                $stmt_increment_views->bind_param("i", $article_id);
                                if ($stmt_increment_views->execute()) {
                                    // Views count incremented successfully
                                    // You can display a success message if needed
                                } else {
                                    $error = "ভিউ বাড়াতে ত্রুটি।";
                                    header("Location: articles.php?error=" . urlencode($error));
                                    exit();
                                }
                                $stmt_increment_views->close();
                            } else {
                                $error = "ভিউ বাড়ানোর কুয়েরিতে ত্রুটি।";
                                header("Location: articles.php?error=" . urlencode($error));
                                exit();
                            }
                            // Query to retrieve the category of the article
                            $category_query = "SELECT category FROM articles WHERE article_id = ?";
                            if ($stmt_category = $conn->prepare($category_query)) {
                                $stmt_category->bind_param("i", $article_id);
                                if ($stmt_category->execute()) {
                                    $category_result = $stmt_category->get_result();
                                    $category_row = $category_result->fetch_assoc();
                                    if ($category_row > 0) {
                                        $category = $category_row['category'];
                                        // Display the category
                                        echo '<a href="category.php?category=' . $category . '">' . $category . '</a>';
                                        
                                    }
                                    
                                } else {
                                    $error = "বিভাগ তথ্য পেতে ত্রুটি।";
                                    header("Location: articles.php?error=" . urlencode($error));
                                    exit();
                                }
                                $stmt_category->close();
                            } else {
                                $error = "বিভাগ কুয়েরি করতে ত্রুটি।";
                                header("Location: articles.php?error=" . urlencode($error));
                                exit();
                            }

                            // Query to retrieve the tags associated with the article
                            $tags_query = "SELECT T.tag_name FROM tags AS T
                                INNER JOIN article_tags AS AT ON T.tag_id = AT.tag_id
                                WHERE AT.article_id = ?";
                            if ($stmt_tags = $conn->prepare($tags_query)) {
                                $stmt_tags->bind_param("i", $article_id);
                                if ($stmt_tags->execute()) {
                                    $tags_result = $stmt_tags->get_result();

                                    // Display the tags
                                    echo '<div class="col">';
                                    echo '<div class="tags">';
                                    while ($tag_row = $tags_result->fetch_assoc()) {
                                        $tag_name = $tag_row['tag_name'];
                                        echo '<a href="tag.php?tag=' . $tag_name . '">' . $tag_name . '</a>';
                                    }
                                    echo '</div>';
                                    echo '</div>';
                                } else {
                                    $error = "ট্যাগ এর তথ্য পেতে ত্রুটি।";
                                    header("Location: articles.php?error=" . urlencode($error));
                                    exit();
                                }
                                $stmt_tags->close();
                            } else {
                                $error = "এরর।";
                                header("Location: articles.php?error=" . urlencode($error));
                                exit();
                            }
                        } else {
                            $error = "ভুল লিংক।";
                            header("Location: articles.php?error=" . urlencode($error));
                            exit();
                        }

                        // Close the database connection
                        $conn->close();
                        ?>
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

<?php
// Include the database connection file
include 'db-connection.php';

// Check if the user is logged in and has a valid session
if (isset($_SESSION['user_id'])) {
    // Get the user_id from the session
    $user_id = $_SESSION['user_id'];

    // Check if article_id is provided in the URL
    if (isset($_GET['article_id'])) {
        $article_id = $_GET['article_id'];

        // Query to get the tags associated with the article
        $get_tags_query = "SELECT tag_id FROM article_tags WHERE article_id = ?";
        if ($stmt_get_tags = $conn->prepare($get_tags_query)) {
            $stmt_get_tags->bind_param("i", $article_id);

            if ($stmt_get_tags->execute()) {

                // $stmt_get_tags->bind_result($tag_id);
                $get_tag_ids_result = $stmt_get_tags->get_result();
            }

            // Increment the read count for each tag in User_Tag_Read_Count table
            $increment_tag_read_query = "INSERT INTO user_tag_read_count (user_id, tag_id, read_count) 
                VALUES (?, ?, 1) 
                ON DUPLICATE KEY UPDATE read_count = read_count + 1";

            if ($stmt_increment_tag_read = $conn->prepare($increment_tag_read_query)) {

                while ($tag_row = $get_tag_ids_result->fetch_assoc()) {
                    $tag_id_r = $tag_row['tag_id'];
                    $stmt_increment_tag_read->bind_param("ii", $user_id, $tag_id_r);
                    $stmt_increment_tag_read->execute();
                }

                // Close the $stmt_increment_tag_read statement after the loop
                $stmt_increment_tag_read->close();
            }

            // Close the $stmt_get_tags statement
            $stmt_get_tags->close();
        }
    }
}

// Close the database connection here (if necessary)
$conn->close();
?>
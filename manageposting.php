<?php
include("classes/autoloadclass.php");

$staffEdit = new StaffFunction();
$imageUtil = new Image(); 
$get_user = new User();

$login = new StaffFunction();
$user_data = $login->check_login($_SESSION['ekomuniti_staffID']);
$USER = $user_data;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $profile = new Profile();
    $profile_data = $profile->get_profile($_GET['id']);
    if (is_array($profile_data)) {
        $user_data = $profile_data[0];
    }
}

// Set the number of posts per page
$limit = 10;

// Get the current page or set default to 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) {
    $page = 1;
}

// Get the search query or set default to an empty string
$search_query = isset($_GET['search']) ? $_GET['search'] : '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete'])) {
        $staffEdit->delete_post($_POST['postID']);
        // Redirect to avoid resubmission
        header("Location: manageposting.php?page=$page&search=" . urlencode($search_query));
        exit;
    }
}

// Calculate offset for pagination
$offset = ($page - 1) * $limit;

// Get total post count based on the search query
$total_posts = $staffEdit->get_search_count($search_query);
$total_pages = ceil($total_posts / $limit);

// Fetch the posts for the current page based on the search query
$posts = $staffEdit->search_posts($search_query, $page, $limit);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Komuniti | Manage Posts</title>
    <style>
        body {
            font-family: Tahoma, sans-serif;
            background-color: #F1F1F1;
            margin: 0;
            padding: 0;
            background-image: url('ekomunitiEdit.png');
            background-size: cover;
            background-blend-mode: overlay;
            background-color: rgba(255, 255, 255, 0.5);
        }
        #top-bar {
            height: 80px;
            background-color: #ffde59;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        #top-bar h1 {
            margin: 0;
            font-size: 24px;
        }
        .button {
            background-color: #45a049;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 16px;
            margin: 0 10px;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }
        .button:hover {
            background-color: #3e8e41;
        }
        #logout {
            background-color: #ff4b4b;
        }
        #logout:hover {
            background-color: #d43f3f;
        }
        .container {
            margin: 40px auto;
            width: 90%;
            max-width: 1200px;
            background-color: rgba(255, 255, 255, 0.1); /* 30% transparency */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        #post_area {
            flex: 2.5;
            background-color: #004aad; /* 30% transparency */
            padding: 30px;
            border-radius: 10px;
        }
        #post_bar {
            background-color: white; /* 30% transparency */
            padding: 20px;
            border-radius: 10px;
            background-image: url('ekomunitiEdit.png');
            background-size: cover;
            background-attachment: fixed; /* Keeps the background fixed */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        #post {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #CCC;
            background-blend-mode: overlay;
            background-color: rgba(255, 255, 255, 0.8); /* 30% transparency */
        }
        .action-buttons button {
            padding: 8px 16px;
            margin-right: 8px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .action-buttons .arrow {
            background-color: #4CAF50;
            color: white;
        }
        .action-buttons .arrow:hover {
            background-color: #45a049;
        }
        .action-buttons .delete {
            background-color: #f44336;
            color: white;
        }
        .action-buttons .delete:hover {
            background-color: #d32f2f;
        }
        .pagination {
            text-align: center;
            margin-top: 20px;
        }
        .pagination a {
            color: #405d9b;
            text-decoration: none;
            padding: 8px 16px;
            border: 1px solid #ddd;
            margin: 0 4px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        .pagination a:hover {
            background-color: #ddd;
        }
        .pagination .active {
            background-color: #405d9b;
            color: white;
        }
        .search-bar {
            text-align: center;
            margin-bottom: 20px;
        }
        .search-bar input[type="text"] {
            padding: 8px;
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .search-bar button {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: #45a049;
            color: white;
        }
        .search-bar button:hover {
            background-color: #3e8e41;
        }
   </style>
</head>
<body>
<div id="top-bar">
    <h1><a href="staff_homepage.php">Admin e-Komuniti</a></h1>
    <div>
        <a href="staffEdit.php" class="button">Mengurus Pengguna</a>
        <a href="manageposting.php" class="button">Mengurus Posting</a>
        <a href="stafflogout.php" id="logout" class="button">Log Out</a>
    </div>
</div>
<div class="container">
    <div class="search-bar">
        <form method="get" action="">
            <input type="text" name="search" placeholder="Search by userID, nickname, email, postID, or content" value="<?= htmlspecialchars($search_query) ?>">
            <button type="submit">Search</button>
        </form>
    </div>
    <div id="post_area">
        <div id="post_bar">
            <?php 
            if (is_array($posts) && count($posts) > 0): 
                foreach ($posts as $ROW): 
                    // Fetch user details for the post
                    $ROW_USER = $get_user->get_user($ROW['userID']);
                    if ($ROW_USER):
                        ?>
                        <div id="post">
                            <div>
                                <?php
                                $image = "images/male_user.jpg";
                                if ($ROW_USER['gender'] == "Perempuan") {
                                    $image = "images/female_user.jpg";
                                }
                                if (file_exists($ROW_USER['profile_image'])) {
                                    $image = $imageUtil->get_thumb_profile($ROW_USER['profile_image']);
                                }
                                ?>
                                <img src="<?php echo $image ?>" style="width: 75px; margin-right: 10px; border-radius: 50%;">
                            </div>
                            <div>
                                <div style="font-weight: bold;color: #405d9b;"><?php echo htmlspecialchars($ROW_USER['nickname']) ?></div>
                                <span><?php echo htmlspecialchars($ROW['post']) ?></span>
                                <br><br>
                                <?php
                                if (file_exists($ROW['pimage'])) {
                                    $post_image = $imageUtil->get_thumb_post($ROW['pimage']);
                                    echo "<img src='$post_image' style='width:80%;' />";
                                }
                                ?>
                                <br><br>
                                <div class="action-buttons">
                                    <button class="arrow" data-post-id="<?= $ROW['postID'] ?>">&#x25BC;</button>
                                    <form method="post" style="display:inline;" onsubmit="return confirmDelete();">
                                        <input type="hidden" name="postID" value="<?= $ROW['postID'] ?>">
                                        <button type="submit" name="delete" class="delete">Delete</button>
                                    </form>
                                    <a href="mailto:<?= htmlspecialchars($ROW_USER['email']) ?>?subject=Warning: Post Deleted&body=Dear <?= htmlspecialchars($ROW_USER['nickname']) ?>,%0D%0A%0D%0AYour post with ID <?= htmlspecialchars($ROW['postID']) ?> has been deleted due to policy violations. We hope you will be more aware about the content you posted. Below is the list you might have violated:%0D%0A%0D%0A
                                        1. Harassment or hate speech%0D%0A
                                        2. Inappropriate content%0D%0A
                                        3. False information%0D%0A
                                        4. Spam or advertising%0D%0A
                                        5. Copyright infringement%0D%0A%0D%0A
                                    Regards,%0D%0Ae-Komuniti Admin" class="button">Send Warning Email</a>
                                </div>
                            </div>
                        </div>
                        <div class="expandable" id="expand-<?= $ROW['postID'] ?>" style="display:none;">
                            <p><strong>Post ID:</strong> <?= htmlspecialchars($ROW['postID']) ?></p>
                            <p><strong>User ID:</strong> <?= htmlspecialchars($ROW['userID']) ?></p>
                            <p><strong>Nickname:</strong> <?= htmlspecialchars($ROW_USER['nickname']) ?></p>
                            <p><strong>Email:</strong> <?= htmlspecialchars($ROW_USER['email']) ?></p>
                            <p><strong>Date:</strong> <?= htmlspecialchars($ROW['date']) ?></p>
                        </div>
                    <?php else: ?>
                        <p>User details not found for post ID <?= htmlspecialchars($ROW['postID']) ?>.</p>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No posts found.</p>
            <?php endif; ?>
        </div>
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?search=<?= urlencode($search_query) ?>&page=<?= $page - 1 ?>">&laquo; Previous</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?search=<?= urlencode($search_query) ?>&page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
            <?php endfor; ?>
            <?php if ($page < $total_pages): ?>
                <a href="?search=<?= urlencode($search_query) ?>&page=<?= $page + 1 ?>">Next &raquo;</a>
            <?php endif; ?>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const arrows = document.querySelectorAll('.arrow');
        arrows.forEach(arrow => {
            arrow.addEventListener('click', function() {
                const postId = this.getAttribute('data-post-id');
                const expandable = document.getElementById('expand-' + postId);
                if (expandable.style.display === 'none') {
                    expandable.style.display = 'block';
                    this.innerHTML = '&#x25B2;';  // Up arrow
                } else {
                    expandable.style.display = 'none';
                    this.innerHTML = '&#x25BC;';  // Down arrow
                }
            });
        });
    });

    function confirmDelete() {
        return confirm("Are you sure you want to delete this post?");
    }
</script>
</body>
</html>
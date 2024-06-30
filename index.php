<?php

include("classes/autoloadclass.php");

$login = new Login();
$user_data = $login->check_login($_SESSION['ekomuniti_userID']);
$USER = $user_data;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $profile = new Profile();
    $profile_data = $profile->get_profile($_GET['id']);
    if (is_array($profile_data)) {
        $user_data = $profile_data[0];
    }
}

// Define necessary variables
$myuserid = $_SESSION['ekomuniti_userID'];
$follower_ids_str = 'NULL'; // Initialize as 'NULL' to handle no followers case

// Posting starts here
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $post = new Post();
    $id = $_SESSION['ekomuniti_userID'];
    $result = $post->create_post($id, $_POST, $_FILES);

    if ($result === true) {
        // Redirect to the same page to prevent form resubmission
        header("Location: index.php");
        exit;
    } elseif ($result === false) {
        echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
        echo "An error occurred while creating the post. Please try again later.";
        echo "</div>";
    } else {
        echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
        echo "The following errors occurred:<br><br>";
        echo $result;
        echo "</div>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>e-Komuniti | Fasiliti</title>
    <style type="text/css">
        body {
            font-family: Tahoma, sans-serif;
            background-color: #F1F1F1;
            margin: 0;
            padding: 0;
            background: url('backgroundmain.gif') center center fixed;
            background-size: cover;
            background-blend-mode: overlay;
            background-color: rgba(255, 255, 255, 0.5);
        }
        #search_box {
            width: 400px;
            height: 20px;
            border-radius: 5px;
            border: none;
            padding: 4px;
            font-size: 14px;
        }
        #green_bar {
            height: 50px;
            background-color: #FFDBD2;
            color: black;
            padding-top: 10px;
        }
        #menu {
            background-color: white;
            text-align: center;
            padding: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background-blend-mode: overlay;
            background-color: rgba(255, 255, 255, 0.8);
        }
        #menu_buttons {
            display: inline-block;
            padding: 10px;
            text-decoration: none;
            color: black;
            border-radius: 5px;
            margin: 5px;
            transition: background-color 0.3s;
            background-color: white;
        }
        #menu_buttons:hover {
            background-color: #E7E1DF;
            color: black;
        }
        #main_content {
            display: flex;
            justify-content: center;
            padding: 20px;
        }
        #friends_bar {
            flex: 1;
            background-color: white;
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            margin-right: 20px;
            background-blend-mode: overlay;
            background-color: rgba(255, 255, 255, 0.0);
        }
        #post_area {
            flex: 2.5;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            background-blend-mode: overlay;
            background-color: rgba(255, 255, 255, 0.1);
        }
        textarea {
            width: 100%;
            height: 60px;
            border: 1px solid #CCC;
            border-radius: 10px;
            padding: 10px;
            font-size: 14px;
            resize: none;
            transition: border-color 0.3s;
        }
        textarea:focus {
            border-color: #405d9b;
        }
        #post_button {
            float: right;
            background-color: #53A6FE;
            color: white;
            padding: 10px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        #post_button:hover {
            background-color: #007bff;
        }
        #post_bar {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        #post {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #CCC;
            background-blend-mode: overlay;
            background-color: rgba(255, 255, 255, 0.0);
        }
        #friend_image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 4px solid #aaa;
            display: block;
            margin: 0 auto;
        }
        #friend_name {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin-top: 10px;
            color: #405d9b;
        }
    </style>
</head>
<body>

    <?php include("header.php"); ?>

    <div id="menu">
        <a href="index.php" id="menu_buttons">Ruang Komuniti</a>
        <a href="suggestFriend.php" id="menu_buttons">Cadangan Rakan</a>
        <a href="fasiliti.php?section=fasiliti&id=<?php echo $user_data['userID']; ?>" id="menu_buttons">Fasiliti</a>
        <a href="profile.php" id="menu_buttons">Profil</a>
    </div>
    <div id="main_content">
        <div style="min-height: 400px; flex: 1;">
            <div id="friends_bar">
                <?php
                    $image = "images/male_user.jpg";
                    if($user_data['gender'] == "Perempuan") {
                        $image = "images/female_user.jpg";
                    }
                    if(file_exists($user_data['profile_image'])) {
                        $image = $image_class->get_thumb_profile($user_data['profile_image']);
                    }
                ?>
                <img id="profile_pic" src="<?php echo $image ?>" style="width: 150px; height: 150px; border-radius: 50%; border: 4px solid #aaa; display: block; margin: 0 auto;">
                <a href="profile.php" style="text-decoration: none;">
                    <?php echo $user_data['nickname'] ?>
                </a>
            </div>
        </div>
        <div id="post_area">
            <div>
                <form method="post" enctype="multipart/form-data">
                    <textarea name="post" placeholder="Tulis Info Terbaru"></textarea>
                    <input type="file" name="file">
                    <input id="post_button" type="submit" value="Post">
                    <br>
                </form>
            </div>
            <div id="post_bar">
                <?php
                    $page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $page_number = ($page_number < 1) ? 1 : $page_number;
                    $limit = 10;
                    $offset = ($page_number - 1) * $limit;

                    $DB = new Database();
                    $user_class = new User();
                    $image_class = new Image();
                    $followers = $user_class->get_following($_SESSION['ekomuniti_userID'], "user");

                    if ($followers && is_array($followers)) {
                        $follower_ids = array_column($followers, "userID");
                        if (!empty($follower_ids)) {
                            $follower_ids_str = implode(",", $follower_ids);
                        }
                    }

                    $myuserid = $_SESSION['ekomuniti_userID'];
                    $sql = "SELECT * FROM posts WHERE parent = 0 and (userID = '$myuserid' OR userID IN ($follower_ids_str)) ORDER BY id DESC LIMIT $limit OFFSET $offset";
                    $posts = $DB->read($sql);

                    if ($posts && is_array($posts)) {
                        foreach ($posts as $ROW) {
                            $ROW_USER = $user_class->get_user($ROW['userID']);
                            include("post.php");
                        }
                    } else {
                        echo "No posts found.";
                    }

                    // Calculate total pages
                    $sql_total_posts = "SELECT COUNT(*) AS total FROM posts WHERE parent = 0 and (userID = '$myuserid' OR userID IN ($follower_ids_str))";
                    $result_total_posts = $DB->read($sql_total_posts);
                    if (is_array($result_total_posts)) {
                        $total_posts = $result_total_posts[0]['total'];
                        $total_pages = ceil($total_posts / $limit);

                        // Pagination buttons
                        echo "<div style='text-align: center; margin-top: 20px;'>";
                        if ($page_number > 1) {
                            echo "<a href='index.php?page=" . ($page_number - 1) . "' style='margin-right: 10px;'>Previous</a>";
                        }
                        if ($page_number < $total_pages) {
                            echo "<a href='index.php?page=" . ($page_number + 1) . "'>Next</a>";
                        }
                        echo "</div>";
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>

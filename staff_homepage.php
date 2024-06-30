<?php
include("classes/autoloadclass.php");

$staffEdit = new StaffFunction();
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

// Fetch top 3 most active users based on post count, excluding specific userID
$DB = new Database();
$sql = "SELECT users.*, COUNT(posts.postID) as post_count 
        FROM users 
        LEFT JOIN posts ON users.userID = posts.userID 
        WHERE users.userID <> '440057739240' 
        GROUP BY users.userID 
        ORDER BY post_count DESC 
        LIMIT 3";
$top_users = $DB->read($sql);

// If the excluded userID is in the top 3, fetch the next user (4th most active)
if (count($top_users) < 3) {
    $sql = "SELECT users.*, COUNT(posts.postID) as post_count 
            FROM users 
            LEFT JOIN posts ON users.userID = posts.userID 
            WHERE users.userID <> '440057739240' 
            GROUP BY users.userID 
            ORDER BY post_count DESC 
            LIMIT 3, 1";
    $additional_user = $DB->read($sql);
    if (!empty($additional_user)) {
        $top_users[] = $additional_user[0];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Komuniti | Admin Home</title>
   <?php include("staff_homepage.css")?>
</head>
<body>
    <div id="top-bar">
        <h1>Admin e-Komuniti</h1>
        <div>
            <a href="staffEdit.php" class="button">Mengurus Pengguna</a>
            <a href="manageposting.php" class="button">Mengurus Posting</a>
            <a href="stafflogout.php" id="logout" class="button">Log Out</a>
        </div>
    </div>
    <div id="welcome-container">
        <img src="ekomuniti.png" alt="e-Komuniti Logo">
        <h2>Selamat Bertugas Admin !</h2>
    </div>

    <!-- Top 3 Users Section -->
    <div id="top-users-section">
        <div style="text-align:center;"><h2>3 Pengguna Teratas Semasa</h2></div><br><br>
        <div id="top-users">
            <?php if (count($top_users) > 1): ?>
                <div class="user_card silver">
                    <img src="<?php echo $top_users[1]['profile_image']; ?>" alt="Profile Picture">
                    <div><?php echo $top_users[1]['nickname']; ?></div>
                    <p>Posts: <?php echo $top_users[1]['post_count']; ?></p>
                </div>
            <?php endif; ?>
            <?php if (count($top_users) > 0): ?>
                <div class="user_card gold">
                    <img src="<?php echo $top_users[0]['profile_image']; ?>" alt="Profile Picture">
                    <div><?php echo $top_users[0]['nickname']; ?></div>
                    <p>Posts: <?php echo $top_users[0]['post_count']; ?></p>
                </div>
            <?php endif; ?>
            <?php if (count($top_users) > 2): ?>
                <div class="user_card bronze">
                    <img src="<?php echo $top_users[2]['profile_image']; ?>" alt="Profile Picture">
                    <div><?php echo $top_users[2]['nickname']; ?></div>
                    <p>Posts: <?php echo $top_users[2]['post_count']; ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Statistics Section -->
    <?php include("statistic.php"); ?>

    <div class="contact-container">
        <div class="contact-info">
            <img src="ekomuniti.png" alt="City Central Hotel Logo">
           
        </div>
        <div class="contact-links">
            <a href="login.php"><h2>Buat Pengumuman</h2></a>
        </div>

</body>
</html>
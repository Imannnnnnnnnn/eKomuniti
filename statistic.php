<?php

// Retrieve total number of users
$user = new User();
$total_users = $user->get_total_users();

// Retrieve total number of posts
$post = new Post();
$total_posts = $post->get_total_posts();
?>

<div id="statistics-section">
    <div class="statistics-container">
        <div class="statistics-item">
            <a href="staffEdit.php" style="text-decoration: none;"><h2>Total Users</h2></a>
            <p><?php echo $total_users; ?></p>
        </div>
        <div class="statistics-item">
            <a href="staffEdit.php" style="text-decoration: none;"><h2>Total Posts</h2></a>
            <p><?php echo $total_posts; ?></p>
        </div>
    </div>
</div>
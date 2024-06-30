<?php


// Retrieve total number of users
$user = new User();
$total_users = $User->get_user();

// Retrieve total number of posts
$post = new Post();
$total_posts = $post->get_posts();

?>

<div id="additional_section" style="background-color: white; padding: 20px; margin-top: 20px;">
    <h2>Total Users and Posts</h2>
    <div>
        <p>Total Users: <?php echo $total_users; ?></p>
        <p>Total Posts: <?php echo $total_posts; ?></p>
    </div>
</div>

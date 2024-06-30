    <div style="min-height: 400px; width: 100%; background-color: white; text-align: center;">
    	<div style="padding: 20px;"> 
<?php

$image_class = new Image();
$post_class = new Post();
$user_class = new User();


$followers = $post_class->get_likes($user_data['userID'], "user");

if (is_array($followers) && !empty($followers)) {
    foreach ($followers as $follower) {
        $FRIEND_ROW = $user_class->get_user($follower['userID']);
        if ($FRIEND_ROW) {
            include("user.php");
        } else {
            echo "";
        }
    }
} else {
    echo "No followers were found";
}
?>

	</div>
</div>

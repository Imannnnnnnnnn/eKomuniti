    <div style="min-height: 400px; width: 100%; background-color: white; text-align: center;">
    	<div style="padding: 20px;"> 
<?php
    $DB = new Database();
    $sql = "SELECT pimage, postID FROM posts WHERE has_image = 1 && userid={$user_data['userID']} ORDER BY id DESC LIMIT 30";
    $images = $DB->read($sql);
    $image_class = new Image();

    if (is_array($images)) {
        foreach ($images as $image_row) {

            echo "<a href ='single_post.php?id=$image_row[postID]'>";

            echo "<img src='". $image_class->get_thumb_post($image_row['pimage']) ."' style='width:230px; margin: 10px;' />";
            echo "<a/>";
        }
    } else {
        echo "No images were found";
    }
?>
	</div>
</div>

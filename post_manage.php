<div id="post">
    <div>
        <?php
        $image = "images/male_user.jpg";
        if ($ROW_USER['gender'] == "Perempuan") {
            $image = "images/female_user.jpg";
        }
        if (file_exists($ROW_USER['profile_image'])) {
            $image = $image_class->get_thumb_profile($ROW_USER['profile_image']);
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
            $post_image = $image_class->get_thumb_post($ROW['pimage']);
            echo "<img src='$post_image' style='width:80%;' />";
        }
        ?>
        <br><br>
    </div>
</div>

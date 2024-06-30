<!DOCTYPE html>
<html>
<head>
    <title>e-Komuniti | Profil</title>
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
            background-image: url();
        }

         #green_bar {
            height: 50px;
            background-color: #FFDBD2;
            color: black;
            padding-top: 10px;
        }


        #menu_buttons {
            width: 100px;
            display: inline-block;
            margin: 2px;

        }

        #friend_image {
            width: 75px;
            float: left;
            margin: 8px;
        }

        #friends_bar {
            background-color: white;
            min-height: 400px;
            margin-top: 20px;
            color: #aaa;
            padding: 8px;
        }
    </style>
</head>
<body>

    <div id="friend">
    <?php 
        $image = "images/male_user.jpg";
        if($FRIEND_ROW['gender'] == "Perempuan") {
            $image = "images/female_user.jpg";
        }

        if(file_exists($FRIEND_ROW['profile_image']))

            {

                $image = $image_class -> get_thumb_profile($FRIEND_ROW['profile_image']);

            }

    ?>

    <a href="profile.php?id=<?php echo $FRIEND_ROW['userID']; ?>">
    <img  style="border-radius: 20%;" id="friend_image" src="<?php echo $image ?>"alt="Profile Picture">
<br><?php echo $FRIEND_ROW['nickname'] ?>
    </a>
</div>
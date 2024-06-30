<?php

    include("classes/autoloadclass.php");


        $login = new Login();
        $user_data = $login->check_login($_SESSION['ekomuniti_userID']);

        $USER = $user_data;
        
        if(isset($_GET['id']) && is_numeric($_GET['id']))
            {
                 $profile = new Profile();
                        $profile_data = $profile->get_profile($_GET['id']);
                        

                        if(is_array($profile_data))
                        {
                            $user_data = $profile_data[0];

                        }


            }
            

             //posting starts here
       if ($_SERVER['REQUEST_METHOD'] == "POST") {

                $post = new Post();
                $id = $_SESSION['ekomuniti_userID'];
                $result = $post->create_post($id, $_POST,$_FILES);

                if ($result === true) {
                    // Redirect to the same page to prevent form resubmission
                    header("Location: profile.php");
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
    


        $Post = new Post();
        $ROW = false;

        $ERROR = "";

        if(isset($_GET['id']))
            {
                $ROW = $Post->get_one_post($_GET['id']);
           
            }else
            {

                 $ERROR = "No post was found!";
                 

            }



          

?>

<!DOCTYPE html>
<html>
<head>
    <title>e-Komuniti | Komen Pos</title>
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

        #friend_image {
            width: 100px;
            height: 100px;
            text-align: center;
            border-radius: none;
        }

        textarea {
            width: 50px; 
            padding: 10px; 
            transition: all 0.3s ease; 
            border: 1px solid #ccc; 
        }

        /* Hover effect */
        textarea:hover {
            background-color: #e0e0e0; 
            border: 1px solid #444; 
            width: 70px; 
        }

        #post_button {
            padding: 10px 20px; 
            background-color: #8892bf; 
            color: white; 
            border: none; 
            cursor: pointer; 
            transition: background-color 0.3s; 
        }

        #post_button:hover {
            background-color: #45a049; 
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

        #post_area {
            min-height: 400px;
            flex: 2.5;
            padding: 20px;
            padding-right: 0px;
        }

        #post_button {
            float: right;
            background-color: #405d9b;
            border: none;
            color: white;
            padding: 4px;
            font-size: 14px;
            border-radius: 2px;
            width: 50px;
        }

        #post_bar {
            margin-top: 20px;
            background-color: white;
            padding: 10px;
            border-radius: 5px;
        }

        #post {
            padding: 4px;
            font-size: 13px;
            display: flex;
            margin-bottom: 20px;
        }
        
    </style>
</head>
<body style="font-family: tahoma; background-color: #dod8e4;">

    <?php 

        include("header.php");

    ?>

    <!-- Cover Area -->
    <div style="width: 800px; margin: auto; min-height: 400px;">
        <div id="menu">
            <a href="index.php" id="menu_buttons">Ruang Komuniti</a>
            <a href="suggestFriend.php" id="menu_buttons">Cadangan Rakan</a>
            <a href="fasiliti.php?section=fasiliti&id=<?php echo $user_data['userID']; ?>" id="menu_buttons">Fasiliti</a>
            <a href="profile.php" id="menu_buttons">Profil</a>
        </div>
        <!-- Below Cover Area -->

        <!-- Post Area -->
        <div style="min-height: 400px; flex:2.5; padding: 20px; padding-right: 0px;">
            <div style="border:solid thin #aaa; padding: 10px; background-color: white; ">
                <?php
                    $User = new User();
                    $image_class = new Image();

                    if (is_array($ROW)) {
                        $user = new User();
                        $ROW_USER = $user->get_user($ROW['userID']);
                        include("post.php");
                    }
                ?>

                <br style="clear: both;">

                <div style="border:none #aaa; padding: 10px; background-color: white;">
                    <form method="post" enctype="multipart/form-data">
                        <textarea style="border: none; height: 70px; width: 650px;" name="post" placeholder="Tulis komen"></textarea>
                        <input type="hidden" name="parent" value="<?php echo $ROW['postID']; ?>">
                        <input id="post_button" type="submit" value="Post"<?>
                        <br>
                    </form>
                </div>

                <div style="text-align: left;">
                    <?php
                        $comments = $Post->get_comments($ROW['postID']);

                        if (is_array($comments)) {
                            foreach ($comments as $COMMENT) {
                                $ROW_USER = $user->get_user($COMMENT['userID']);
                                include("comment.php");
                            }
                        }

                        
                    ?>

                  
                </div>
            </div>
        </div>
    </div>
</body>
</html>


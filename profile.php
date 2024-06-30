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

            include ("change_image.php");
            
            if(isset($_POST['nickname'])){

                $settings_class=new Settings();
                $settings_class->save_settings($_POST,$_SESSION['ekomuniti_userID']);

            }else{

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
}

//collect posts
        $post = new Post();
        $id = $user_data['userID'];

        $posts = $post->get_posts($id);


//collect friends

    $user = new User();
    $id = $_SESSION['ekomuniti_userID'];

    $friends = $user->get_following($user_data['userID'],"user");


    $image_class = new Image();

?>
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
        }

         #green_bar {
            height: 50px;
            background-color: #FFDBD2;
            color: black;
            padding-top: 10px;
        }


        #textbox {
            width: 500px;
            height: 20px;
            border-radius: 5px;
            border: none;
            padding: 4px;
            font-size: 14px;
            border:solid thin grey;
            margin: 10px;
            background-blend-mode: overlay; 
            background-color: rgba(255, 255, 255, 0.5);


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
            background-blend-mode: overlay; 
            background-color: rgba(255, 255, 255, 0.5);
        }

        #friend {
            clear: both;
            font-size: 12px;
            font-weight: bold;
            color: #405d9b;
        }

        #friend_name {
            font-size: 18px;
            font-weight: bold;
        }
        

        #main_content {
            display: flex;


        }

        #post_area {
            min-height: 400px;
            flex: 2.5;
            padding: 20px;
            padding-right: 0px;
            border-radius: 20%;
 

        }

        textarea {
            width: 100%;
            height: 60px;
            border: none;
            font-size: 14px;
            resize: none; /* Prevent resizing */
        }

        #post_button{

            float: right;
            background-color: #405d9b ;
            border:none;
            color: white;
            padding: 4px;
            font-size: 14px;
            border-radius: 2px;
            width: 50px;
            min-width: 50px;
            cursor: pointer;
        }

        #post_bar{

            margin-top: 20px;
            background-color: white;
            padding: 10px;

        }

        #post{

            padding: 4px;
            font-size: 13px;
            display: flex;
            margin-bottom: 20px;
        }

              #change_button {
            float: right;
            background-color: #405d9b;
            color: white;
            padding: 10px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #post_button:hover {
            background-color: #5a6a9c;
        }

             #post {
            display: flex;
            padding: 10px;
            margin-bottom: 10px;
            border-bottom: 1px solid #CCC;
        }

          .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 200vh;
        }

         .picture_area {
            background-color: white;
            border: solid thin #aaa;
            padding: 100px;
            max-width: 600px;
            margin: auto;
            text-align: center;
            border-radius: 10px;

        }


        }
    </style>
</head>
<body>
    
    <?php 

        include("header.php");

    ?>
    <!--Change profile image-->
    <div id= "change_profile_image" style="display:none; position: absolute; width: 100%; height: 100%; background-color: #000000aa;">
                    <!--Post Area-->
           <div class="container">
                <div class="picture_area">

                    <form method ="post" action = " profile.php?change=profile" enctype="multipart/form-data">
                        <input type="file" name="file"><br>
                        <h5> Press ESC to exit </h5>
                        <input id="change_button"type="submit" value="Change">
                        <br>
                    <?php


                      
                                
                                  echo "<img src='$user_data[profile_image]' style ='max-width:500px;' >";
                    ?>    
                </div>
                    </form>

            </div>
    </div>


        <!--Change cover image-->
    <div id= "change_cover_image" style="display:none; position: absolute; width: 100%; height: 100%; background-color: #000000aa;">
                    <!--Post Area-->
           <div class="container">
                <div class="picture_area">

                    <form method ="post" action = " profile.php?change=cover" enctype="multipart/form-data">
                        <input type="file" name="file"><br>

                        <input id="change_button"type="submit" value="Change">
                        <br>
                    <?php



                                echo "<img src='$user_data[cover_image]' style ='max-width:500px;' >";

                    ?>    
                </div>
                    </form>

            </div>
    </div>


    <!--Cover Area-->
    <div style="width: 800px; margin: auto; min-height: 400px;">
        <div style="background-color: rgba(255, 255, 255, 0.5); text-align: center; color: black;">

            <?php
                    $image="images/cover_image.jpg";

                    if(file_exists($user_data['cover_image']))
                        {
                            $image = $image_class -> get_thumb_cover($user_data['cover_image']);

                        }


                ?>
            <img src="<?php echo $image ?>" style="width: 100%;">
            <?php
                $mylikes=$user_data['likes'];

              
            ?>
            </a>
             <span style=" font-size: 12px;">

                <?php
                    $image="images/male_user.jpg";

                    if($user_data ['gender'] == "Perempuan")
                        {
                           $image = "images/female_user.jpg";

                        }

                    if(file_exists($user_data['profile_image']))
                        {
                            $image = $image_class -> get_thumb_profile($user_data['profile_image']);

                        }


                ?>
                <img id="profile_pic" src="<?php echo $image ?>" style="width: 150px; height: 150px; border-radius: 50%; border: 4px solid #aaa; display: block; margin: 0 auto;">
<br>


               <a onclick ="show_change_profile_image(event)" style="text-decoration: none; color: #f0f ;"href="change_profile_image.php?change=profile">Tukar Gambar Profil</a> |

               <a  onclick ="show_change_cover_image(event)" style="text-decoration: none; color: #f0f ;"href="change_profile_image.php?change=cover">Tukar Gambar Latar Belakang </a>


            </span>

             <br>
            
             <div style="font-size: 20px; color: black;">
                 <a style ="text-decoration: none; "href="profile.php?id=<?php echo $user_data['userID'] ?>">
                <?php echo $user_data['nickname']; ?>
                    
                </a>
                 <?php
                $mylikes="";

                if($user_data['likes']>0)
                    {

                        $mylikes="(". $user_data['likes'] . "Followers)";
                    }

            ?>   
            <br><a href="like.php?type=user&id=<?php echo $user_data['userID']?>">
            <input id="post_button"type="submit" value="Follow <?php echo $mylikes?>" style="margin-right: 10px; background-color: #9b409a; width: auto; margin-right: 10px;"></a>
           </div>
            <br> 
            
            <br><a href="index.php"><div id="menu_buttons">Ruang Komuniti</div></a>
              <a href="suggestFriend.php" id="menu_buttons" style="text-decoration: none;">Cadangan Rakan</a>
            <a href="fasiliti.php?section=fasiliti&id=<?php echo $user_data['userID'] ?>"><div id="menu_buttons">Fasiliti</div></a>
            <a href="profile.php?section=followers&id=<?php echo $user_data['userID'] ?>"><div id="menu_buttons">Pengikut</div></a>
            <a href="profile.php?section=photos&id=<?php echo $user_data['userID'] ?>"><div id="menu_buttons">Gambar</div></a>
            <?php

            if($user_data['userID'] == $_SESSION['ekomuniti_userID']){
            echo '<a href="profile.php?section=settings&id='.$user_data['userID'].'" ?><div id="menu_buttons">Profil</div></a>';
                }
            ?>

        </div>
        <!--Below Cover Area-->

        <?php

            $section ="default";
            if(isset($_GET['section'])){
                $section=$_GET['section'];

            }
            if($section=="default"){

                    include("profile_content_default.php");

                }elseif($section=="followers"){

                    include("profile_content_followers.php");

                }elseif($section=="photos"){

                    include("profile_content_photos.php");

                }elseif($section=="following"){

                    include("profile_content_following.php");

                }elseif($section=="settings"){

                    include("profile_content_settings.php");
                }
        ?>

    </div>

</body>
</html>
<script type="text/javascript">
    
    function show_change_profile_image(event){

            event.preventDefault();
            var profile_image = document.getElementById("change_profile_image");
            profile_image.style.display = "block";

                }
    function hide_change_profile_image(event){


            var profile_image = document.getElementById("change_profile_image");
            profile_image.style.display = "none";

                }

    function show_change_cover_image(event){

            event.preventDefault();
            var cover_image = document.getElementById("change_cover_image");
            cover_image.style.display = "block";

                }
    function hide_change_cover_image(event){


            var cover_image = document.getElementById("change_cover_image");
            cover_image.style.display = "none";

                }

                window.onkeydown = function(key){
                    
                    if(key.keyCode == 27);{

                        hide_change_profile_image();
                        hide_change_cover_image();
                    }


                }
</script>
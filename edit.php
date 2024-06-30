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
       
        

        $Post = new Post();

        $ERROR = "";
        if(isset($_GET['id']))
            {

            
            $ROW=$Post->get_one_post($_GET['id']);

            if(!$ROW)
                 {

                    $ERROR = "No such Post was found";
                 }else 
                 {

                    if($ROW['userID'] != $_SESSION['ekomuniti_userID'])
                        {

                            $ERROR = "Akses ditolak! Anda tidak boleh memadam fail ini!";



                        } 

                 }
            }else
            {

                 $ERROR = "No such Post was found";
                 

            }
            if(isset($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "edit.php"))
                {

                    $_SESSION['return_to'] = $_SERVER['HTTP_REFERER'];
                }

            //if something was posted

            if($_SERVER['REQUEST_METHOD'] == "POST")
                {
                    $Post->edit_post($_POST, $_FILES);

                   header("Location: ".$_SESSION['return_to']);

                    die;
                }

?>

<!DOCTYPE html>
<html>
<head>
    <title>e-Komuniti | Padam</title>
    <style type="text/css">
        body {
            font-family: Tahoma, sans-serif;
            background-color: #F1F1F1;
            margin: 0;
            padding: 0;
            background-image: url('background.png'); /* Add the background image */
            background-size: cover; /* Ensure the image covers the entire background */
            background-blend-mode: overlay; /* Blend mode to overlay the semi-transparent color */
            background-color: rgba(255, 255, 255, 0.5); /* White color with 50% opacity */
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
            width: 130px;
            height: 130px;
            border-radius: 50%; /* Make it a circle */
            margin: auto;
            display: block;
            margin-bottom: 5px;
        }

        #friends_bar {
           
            min-height: 400px;
            margin-top: 20px;
            color: #405d9b;
            padding: 8px;
            text-align: center;
            font-size: 20px;
            border-radius: 5px;
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


        }

        textarea {
            width: 100%;
            height: 60px;
            border: none;
            font-family: tahoma;
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
        }

        #post_bar{

        	margin-top: 20px;
        	background-color: white;
        	padding: 10px;
        	border-radius: 5px;

        }

        #post{

        	padding: 4px;
        	font-size: 13px;
        	display: flex;
        	margin-bottom: 20px;

        }

        
    </style>
</head>
<body>

    <?php 

        include("header.php");

    ?>

    <!--Cover Area-->
    <div style="width: 800px; margin: auto; min-height: 400px;">
        <div style="background-color: white; text-align: center; color: black;">
           
            <div id="menu_buttons">Ruang Komuniti</div>
            <div id="menu_buttons">Info Admin</div>
            <div id="menu_buttons">Fasiliti</div>
            <div id="menu_buttons">Profil</div>
        </div>
        <!--Below Cover Area-->
        <div id="main_content">


            <!--Post Area-->
            <div id="post_area">
                <div style="border:solid thin #aaa; padding: 10px; background-color: white;">

                   <form method = "post" enctype="multipart/form-data">


                        <?php 

                         if($ERROR !="")
                            {

                                echo $ERROR;

                            }else
                          {
                            echo "Adakah anda mahu ubahsuai pos ini?<br><br>";

                            echo '<textarea name="post"placeholder="Tulis Info Terbaru">'.$ROW['post'].'</textarea>
                                    <input type="file" name = "file"> ';


                            echo "<input type='hidden' name='postID' value='" . $ROW['postID'] . "'>";
                            echo "<input id='post_button' type='submit' value='Ubahsuai'>";

                            if(file_exists($ROW['pimage']))
                                 {
                                    $image_class = new Image();
                                    $post_image = $image_class->get_thumb_post($ROW['pimage']);
                                    echo "<br><br><div style='text-align: center;'><img src = '$post_image' style='width:50%;'/></div>";
                                 }

                        }

  
                           
                         ?>

                        <br>
                    
                    </form>
              

                </div>


            </div>
        </div>
    </div>

</body>
</html>



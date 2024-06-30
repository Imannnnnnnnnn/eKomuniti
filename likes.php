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
        $likes = false;
        $ERROR = "";

        if(isset($_GET['id']) && isset($_GET['type']))
            {
                $likes = $Post->get_likes($_GET['id'],$_GET['type']);
           
            }else
            {

                 $ERROR = "No Likes Yet";
                 

            }

          

?>

<!DOCTYPE html>
<html>
<head>
    <title>e-Komuniti | Senarai Suka Pos</title>
    <style type="text/css">
         body {
            font-family: Tahoma, sans-serif;
            background-color: #F1F1F1;
            margin: 0;
            padding: 0;
            background: url('backgroundmain.gif') center center fixed;
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
           width: 100px;
            height: 100px;
            text-align: center;
            border-radius: none;
        }

        
    </style>
</head>
<body style="font-family: tahoma; background-color: #dod8e4;">

    <?php 

        include("header.php");

    ?>

    <!--Cover Area-->
    <div style="width: 800px; margin: auto; min-height: 400px;">
        <div style="background-color: white; text-align: center; color: black;">
           
             <a href="index.php?section=fasiliti&id=<?php echo $user_data['userID'] ?>"><div id="menu_buttons">Ruang Komuniti</div></a>
             <a href="suggestFriend.php" id="menu_buttons">Cadangan Rakan</a>
            <a href="fasiliti.php?section=followers&id=<?php echo $user_data['userID'] ?>"><div id="menu_buttons">Fasiliti</div></a>
            <a href="profile.php?section=photos&id=<?php echo $user_data['userID'] ?>"><div id="menu_buttons">Profil</div></a>
        </div>
        <!--Below Cover Area-->

        <div style="display: flex;">
    </div>


            <!--Post Area-->
            <div style="min-height: 400px; flex:2.5; padding: 20px; padding-right: 0px;">
                <div style="border:solid thin #aaa; padding: 20px; background-color: white;">


              <?php

                $User = new User();
                $image_class = new Image();

                if(is_array($likes))
                    {

                        foreach ($likes as $row) {
                            // code...
                            $FRIEND_ROW=$User->get_user($row['userID']);
                            include("user.php");
                        }
                    }


              ?>

              <br style="clear: both";>
                </div>


            </div>
        </div>
    

</body>
</html>



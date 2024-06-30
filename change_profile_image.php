<?php

session_start();
//unset($_SESSION['ekomuniti_userID']);

include("classes/connect.php");
include("classes/loginclass.php");
include("classes/userclass.php");
include("classes/postclass.php");
include("classes/imageclass.php");


$login = new Login();
$user_data = $login->check_login($_SESSION['ekomuniti_userID']);

//posting start here
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if(isset($_FILES['file']['name']) && $_FILES['file']['name'] !="") {
        if($_FILES['file']['type'] === "image/jpeg") {
            $allowed_size = (1024 * 1024) * 3; // 3MB
            if($_FILES['file']['size'] < $allowed_size) {


                //everything is fine
                $folder = "uploads/" . $user_data['userID'] . "/";


                //create folder
                if(!file_exists($folder))
                    {
                            
                        mkdir($folder, 0777, true);
                    }

                $image = new Image();

                $filename = $folder . $image->generate_file_name(15) . ".jpg";

                move_uploaded_file($_FILES['file']['tmp_name'], $filename);

              
                 $change= "profile";

                    // check for mode
                    if(isset($_GET['change']))
                        {
                            //check for mode
                            $change = $_GET['change'];

                        }
                

                 if($change == "cover")
                        {
                            if(file_exists($user_data['cover_image']))
                                {
                                    unlink($user_data['cover_image']);
                                }

                            $image-> resized_image($filename,$filename,1500,1500);

                        }else{

                            if(file_exists($user_data['profile_image']))
                                {
                                    unlink($user_data['profile_image']);
                                }

                            $image-> resized_image($filename,$filename,1500,1500);
                        }


                if (file_exists($filename)) 
                {
                    $userID = $user_data['userID'];



                    if($change == "cover")
                        {
                            $query = "UPDATE users SET cover_image = '$filename' WHERE userID = '$userID' LIMIT 1";
                            $_POST['is_cover_image'] = 1;

                        }else
                         {
                           
                            $query = "UPDATE users SET profile_image = '$filename' WHERE userID = '$userID' LIMIT 1";
                              $_POST['is_profile_image'] = 1;
                        }
  
                    
                    $DB = new Database();
                    $DB->save($query);


                   //create a post 
                    $post = new Post();

                    $post->create_post($userID, $_POST,$filename);

                        

                    header("Location: profile.php");
                    exit;
                }
            } else {
                echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
                echo "The following errors occurred:<br><br>";
                echo "Only images of size 3Mb or lower";
                echo "</div>";
            }
        } else {
            echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
            echo "The following errors occurred:<br><br>";
            echo "Only JPEG images are allowed";
            echo "</div>";
        }
    } else {
        echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
        echo "The following errors occurred:<br><br>";
        echo "Please add a valid image";
        echo "</div>";
    }
}

?>



<!DOCTYPE html>
<html>
<head>
    <title>e-Komuniti | Tukar Gambar Profil</title>
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

         form {
            display: flex;
            flex-direction: column;
            align-items: center;

        }

        input[type="file"] {
            margin-bottom: 20px;
        }


      #post_button {
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

         .post-area {
            background-color: white;
            border: solid thin #aaa;
            padding: 100px;
            width: 400px;
            text-align: center;
            border-radius: 10px;

        }



        
    </style>
</head>
<body > <br>

    <?php 

        include("header.php");

    ?>

            <!--Post Area-->
           <div class="container">
                <div class="post-area">

                    <form method ="post" enctype="multipart/form-data">
                        <input type="file" name="file"><br>

                        <input id="post_button"type="submit" value="Change">
                        <br>
                    <?php


                        //check for mode
                        if(isset($_GET['change']) && $_GET['change'] == "cover")
                            {
                                
                                $change = "cover";
                                echo "<img src='$user_data[cover_image]' style ='max-width:500px;' >";
                            }else
                            {
                                
                                  echo "<img src='$user_data[profile_image]' style ='max-width:500px;' >";

                            }

                        

                    ?>    
                </div>
                    </form>

            </div>

               
        </div>
    </div>

</body>
</html>

<?php

if (isset($_GET['change']) && ($_GET['change'] == "profile" || $_GET['change'] == "cover")){  


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
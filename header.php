<!--top bar-->


 <?php
   
   $corner_image = "images/male_user.jpg";
   if(isset($USER)){

        if(file_exists($USER['profile_image']))
    {

         $image_class = new Image();
         $corner_image = $image_class -> get_thumb_profile($USER['profile_image']);
    }else{

        if($USER['gender']== "Perempuan")
            {
                $corner_image = "images/female_user.jpg";
            } 
    } 
    }

?>


    <div id="green_bar">
        <form method ="get" action="search.php">
        <div style="width: 900px; margin: auto; font-size: 30px;">

                <a href="index.php" style="color: white; text-decoration: none;">e-Komuniti </a>


                &nbsp &nbsp <input type="text" id="search_box" name='find' placeholder="Search for people">

                
                <a href="profile.php">
                <img src="<?php echo $corner_image ?>"style="width: 45px; float: right; border-radius: 50%;"></a>

                <a href="logout.php">
                 <span style="font-size: 15px; float: right;margin:10px; color: black; text-decoration:underline" >Logout</span>
            </a>
            </div>
            
        </form>
    </div>
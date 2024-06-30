        <div id="main_content">
            <!--Friend Area-->
                <div style="min-height: 400px; flex: 1;">

                <div id="friends_bar">
                    Followings<br>
                    
                 <?php


                        if($friends)
                            {


                                foreach ($friends as $friend) {
                                    // code...

                                    $FRIEND_ROW = $user->get_user($friend['userID']);

                                    include("user.php");
                                }
                            }
                        

                    ?>

                    
                </div>
            </div>

            <!--Post Area-->
            <div id="post_area">
                <div style="border:solid thin #aaa; padding: 20px; background-color: white;">
                    <form method="post" enctype = "multipart/form-data">

                        <textarea name="post"placeholder="Tulis Info Terbaru"></textarea>
                        <input type="file" name = "file">
                        <input id="post_button"type="submit" value="Post">
                        <br>
                    </form>

                </div>


               <!--posts-->
               <div id="post_bar">


                    <?php


                        if($posts)
                            {


                                foreach ($posts as $ROW) {
                                    // code...

                                    $user = new User();
                                    $ROW_USER = $user->get_user($ROW['userID']);

                                    include("post.php");
                                }
                            }
                        

                    //get url
                    $pg = pagination_link();
            
            ?>

               <a href="<?=$pg['next_page'] ?>">
                <input id="post_button" type="button" value="Halaman Seterusnya >" style="float: right; width: 165px;">
            </a>

            <a href="<?=$pg['prev_page'] ?>">
                <input id="post_button" type="button" value="< Halaman Sebelumnya" style="float: left; width: 165px;">
            </a>


               </div>


            </div>
        </div>
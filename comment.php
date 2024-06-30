               	<div id="post">
               		
               		<div>
               			<?php 

               				$image = "images/male_user.jpg";
               				if($ROW_USER['gender']=="Perempuan")

               					{

               						$image = "images/female_user.jpg";

               					}

               					if(file_exists($ROW_USER['profile_image']))

               					{

               						$image = $image_class -> get_thumb_profile($ROW_USER['profile_image']);

               					}

               					



               			?>
               			<img src="<?php echo $image ?>" style ="width: 75px; margin-right: 4px; border-radius: 50%;">

               			
               		</div>
               		<div style="width: 100%">
               			<div style="font-weight: bold; color: #405d9b; width: 100%;">
               				<?php 

               				echo "<a href='profile.php?id=$COMMENT[userID]'>";
               				echo  htmlspecialchars($ROW_USER['nickname']);
               				echo "</a>";


               				if($COMMENT['is_profile_image'])
               					{

               						$pronoun="his";
               						if($ROW_USER['gender']== "Perempuan")
               							{

               								$pronoun="her";
               							}
									echo "<span style='font-weight:normal; color:#aaa;'> Updated $pronoun Profile Image</span>";

               					}


               				if($COMMENT['is_cover_image'])
               					{

               						$pronoun="his";
               						if($ROW_USER['gender']== "Perempuan")
               							{

               								$pronoun="her";
               							}
									echo "<span style='font-weight:normal; color:#aaa;'> Updated $pronoun Cover Image</span>";

               					}


               					?>
               			</div>

               				<?php echo htmlspecialchars($COMMENT['post'])?>

               				<br><br>
               				<?php 

               				if(file_exists($COMMENT['pimage']))
               					 {

               					 	$post_image = $image_class->get_thumb_post($COMMENT['pimage']);
               					 	echo "<img src = '$post_image' style='width:70%;'/>";
               					 } 
               			

               				?>
               			

               			<?php

               				$likes = "";

               				$likes = ($COMMENT['likes'] > 0) ? "(" .$COMMENT['likes']. ")" : "" ;


               			?>
               			
               			<a href="like.php?type=post&id=<?php echo $COMMENT['postID'] ?>">Like<?php echo $likes ?></a>  .  
               			

               			<span style="color: #999; font-size:10px;">

               			<?php echo $COMMENT['date']; ?>

               			</span>

               			<span style="color: #999; float:right;">

               				<?php

               					$post= new Post();

               					if($post->i_own_post($COMMENT['postID'], $_SESSION['ekomuniti_userID']))
               						{
		               					echo"

			               				<a href='edit.php?id= $COMMENT[postID] '>

			               				Ubahsuai

			               				</a>.

			               				<a href='delete.php?id= $COMMENT[postID] '>
			 
			               				Padam

			               				</a>";
									} 

									
               				?>


               			</span>

               			<?php

               			if(isset($_SESSION['ekomuniti_userID']))
               				{

	               			$DB = new Database();
	               			$i_liked = false;

	               			$sql = "SELECT likes FROM likes WHERE type ='post' AND contentid = '$COMMENT[postID]' LIMIT 1";
	        				$result = $DB->read($sql);
	        
	        				if(is_array($result)) 
	        					{

		            				$likes = json_decode($result[0]['likes'], true);
		            				$user_ids = array_column($likes, "userID");

		            				if(in_array($_SESSION['ekomuniti_userID'], $user_ids))
		            				$i_liked = true; 
		            				{

		            				}
	            				}

							}

               				if($COMMENT['likes']>0)
								{
									echo "<br/>";
									echo "<a href ='likes.php?type=post&id=$COMMENT[postID]'>";
									if($COMMENT['likes']==1)
										{

									
										if ($i_liked) 
											{
												echo "<div style = 'text-align: left;'> You liked this post </div>";
											}else
												{
												echo "<div style = 'text-align: left;'> 1 person liked this post </div>";
												}
												
										}else
										 	{

										 	if($i_liked)
										 		{
										 			$text = "others";
										 			if($COMMENT['likes']-1 == 1)
										 				{
										 					$text = "other";
										 				}
										 			echo "<div style='text-align: left;'>You and " . ($COMMENT['likes'] - 1) . " " . $text . " person liked this post</div>";

										 		}else
										 		{
													echo "<div style = 'text-align: left;'>". $COMMENT['likes'].
											 		" people liked this post </div>";
										 		}	
										 		

										 		
										 	}
										 	echo "</a>";
									
								}
               			?>


               		</div>

               	</div>

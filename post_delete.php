               	<div id="post">
               		
               		<div>
               			<?php 

               				$image = "images/male_user.jpg";
               				if($ROW_USER['gender'] == "Perempuan") 
               					{
    							$image = "images/female_user.jpg";
								}

							if(file_exists($ROW_USER['profile_image'])) 
								{
							    // Create an instance of the Image class
							    $image_class = new Image();
							    
							    // Get the thumbnail profile image
							    $image = $image_class->get_thumb_profile($ROW_USER['profile_image']);
							}


?>

               			<img src="<?php echo $image ?>" style ="width: 75px; margin-right: 4px; border-radius: 50%;">

               			
               		</div>
               		<div style="width: 100%">
               			<div style="font-weight: bold; color: #405d9b; width: 100%;">
               				<?php 
               				

               				echo  htmlspecialchars($ROW_USER['nickname']);


               				if($ROW['is_profile_image'])
               					{

               						$pronoun="his";
               						if($ROW_USER['gender']== "Perempuan")
               							{

               								$pronoun="her";
               							}
									echo "<span style='font-weight:normal; color:#aaa;'> Updated $pronoun Profile Image</span>";

               					}


               				if($ROW['is_cover_image'])
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

               				<?php echo htmlspecialchars($ROW['post'])?>

               				<br><br>
               				<?php 

               				if(file_exists($ROW['pimage']))
               					 {

               					 	$post_image = $image_class->get_thumb_post($ROW['pimage']);
               					 	echo "<img src = '$post_image' style='width:70%;'/>";
               					 } 
               			

               				?>



               		</div>

               	</div>

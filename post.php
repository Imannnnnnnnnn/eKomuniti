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

               				echo "<a href='profile.php?id=$ROW[userID]'>";
               				echo  htmlspecialchars($ROW_USER['nickname']);
               				echo "</a>";


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
               			<br><br>

               			<?php

               				$likes = "";

               				$likes = ($ROW['likes'] > 0) ? "(" .$ROW['likes']. ")" : "" ;


               			?>
               			
               			<a onclick href="like.php?type=post&id=<?php echo $ROW['postID'] ?>">Like<?php echo $likes ?></a>  .  

               			<?php

               				$comments = "";

               				if($ROW['comments']>0){
               					$comments="(" . $ROW['comments'] . ")";
               				}

               			?>
               			<a href="single_post.php?id=<?php echo $ROW['postID'] ?>">Comment</a>  .  

               			<span style="color: #999;">


               				<?php echo Time::get_time($ROW['date']) ?>

               			</span>

               			<span style="color: #999; float:right;">

               				<?php

               					$post= new Post();

               					if($post->i_own_post($ROW['postID'], $_SESSION['ekomuniti_userID']))
               						{
		               					echo"

			               				<a href='edit.php?id= $ROW[postID] '>

			               				Ubahsuai

			               				</a>.

			               				<a href='delete.php?id= $ROW[postID] '>
			 
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

	               			$sql = "SELECT likes FROM likes WHERE type ='post' AND contentid = '$ROW[postID]' LIMIT 1";
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

               				if($ROW['likes']>0)
								{
									
									echo "<a id='info_$ROW[postID]'href ='likes.php?type=post&id=$ROW[postID]'>";
									echo "<br/>";
									if($ROW['likes']==1)
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
										 			if($ROW['likes']-1 == 1)
										 				{
										 					$text = "other";
										 				}
										 			echo "<div style='text-align: left;'>You and " . ($ROW['likes'] - 1) . " " . $text . " person liked this post</div>";

										 		}else
										 		{
													echo "<div style = 'text-align: left;'>". $ROW['likes'].
											 		" people liked this post </div>";
										 		}	
										 		

										 		
										 	}
										 	echo "</a>";
									
								}
								// {}
               			?>


               		</div>

               	</div>

<script type="text/javascript">
	function ajax_data(data, element){
		var ajax = new XMLHttpRequest();

		ajax.addEventListener('readystatechange', function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				response(ajax.responseText, element);
			}
		});

		data = JSON.stringify(data);

		ajax.open("POST", "ajax.php", true);
		ajax.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
		ajax.send(data);
	}

	function response(result, element){
		if(result != ""){

			var obj = JSON.parse(result);
			if(typeof obj.action != 'undefined') { 

				if(obj.action == 'like_post'){

					var likes = "";
					likes = (parseInt(obj.likes) > 0) ? "Like(" + obj.likes + ")" : "Like";
					element.innerHTML = likes; 

					var info_element = document.getElementById(obj.id);
					info_element.innerHTML = obj.info;
				}
			}
		}
	}

	function like_post(e){
		
		var link = e.target.href;
		var data = {};
		data.link = link;
		data.action = "like_post";
		ajax_data(data, e.target);
	}

	document.addEventListener('DOMContentLoaded', function() {
		var likeButtons = document.querySelectorAll('.like-button'); 
		likeButtons.forEach(function(button) {
			button.addEventListener('click', like_post);
		});
	});
</script>


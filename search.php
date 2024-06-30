<?php
include("classes/autoloadclass.php");

$login = new Login();
$user_data = $login->check_login($_SESSION['ekomuniti_userID']);

if (isset($_GET['find'])) {
    $find = addslashes($_GET['find']);
    $sql = "SELECT * from users where nickname like '%$find%' limit 20";
    $DB = new Database();
    $results = $DB->read($sql);
}

$User = new User();
$id = $_SESSION['ekomuniti_userID'];

$friends = $User->get_friends($id);

$image_class = new Image();
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
            background-size: cover; 
            background-blend-mode: overlay; 
            background-color: rgba(255, 255, 255, 0.5); 
        }

        #green_bar {
            height: 60px;
            background-color: #FFDBD2;
            color: black;
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

        #menu {
            background-color: white;
            text-align: center;
            padding: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background-blend-mode: overlay;
            background-color: rgba(255, 255, 255, 0.6);
        }

        #menu_buttons {
            display: inline-block;
            padding: 10px;
            text-decoration: none;
            color: black;
            border-radius: 5px;
            margin: 5px;
            transition: background-color 0.3s;
        }

        #menu_buttons:hover {
            background-color: #E0E0E0;
        }

        #main_content {
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        #friends_bar {
            flex: 1;
            background-color: white;
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            margin-right: 10px;
        }

        #post_area {
            flex: 2.5;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
        }

        textarea {
            width: 100%;
            height: 60px;
            border: 1px solid #CCC;
            border-radius: 5px;
            padding: 10px;
            font-size: 14px;
            resize: none;
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

        #post_bar {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #CCC;
            margin-top: 20px;
        }

        #post {
            display: flex;
            padding: 10px;
            margin-bottom: 10px;
            border-bottom: 1px solid #CCC;
        }

        #friend_image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-right: 20px;
        }

        #friend_name {
            font-size: 18px;
            font-weight: bold;
        }

        #grid_container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            padding: 20px;
        }

        .user_card {
            background-color: white;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .user_card:hover {
            transform: translateY(-10px);
        }

        .user_card img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .view_profile_button {
            padding: 10px 20px;
            background-color: #405d9b;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .view_profile_button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <?php include("header.php"); ?>

    <div style="width: 1200px; margin: auto; min-height: 400px;">
        <div id="menu">
            <a href="index.php" id="menu_buttons">Ruang Komuniti</a>
            <a href="suggestFriend.php" id="menu_buttons">Cadangan Rakan</a>
            <a href="fasiliti.php?section=fasiliti&id=<?php echo $user_data['userID']; ?>" id="menu_buttons">Fasiliti</a>
            <a href="profile.php" id="menu_buttons">Profil</a>
        </div>

        <div style="display: flex;">
            <div style="min-height: 400px; flex: 2.5; padding: 20px; padding-right: 0px;">
                
                    <?php
                    echo "Showing result : " ;
                    if (is_array($results)) {
                        echo '<div id="grid_container">';
                        foreach ($results as $row) {
                            $FRIEND_ROW = $User->get_user($row['userID']);
                            $image = "images/male_user.jpg";
                            if ($FRIEND_ROW['gender'] == "Perempuan") {
                                $image = "images/female_user.jpg";
                            }
                            if (file_exists($FRIEND_ROW['profile_image'])) {
                                $image = $image_class->get_thumb_profile($FRIEND_ROW['profile_image']);

                            }
                            ?>
                            <div class="user_card">
                                <img src="<?php echo $image ?>" alt="Profile Picture">
                                <div><?php echo $FRIEND_ROW['nickname'] ?></div>
                                <a href="profile.php?id=<?php echo $FRIEND_ROW['userID']; ?>">
                                    <button class="view_profile_button">View Profile</button>
                                </a>
                            </div>
                            <?php
                        }
                        echo '</div>';
                    } else {
                        echo "No results were found";
                    }
                    ?>
                    <br style="clear: both;">
                
            </div>
        </div>
    </div>

</body>
</html>

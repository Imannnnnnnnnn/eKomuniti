<?php
include("classes/autoloadclass.php");

$login = new Login();
$user_data = $login->check_login($_SESSION['ekomuniti_userID']);
$USER = $user_data;

// Fetch all users except the logged-in user
$User = new User();
$results = $User->get_friends($user_data['userID']);

$image_class = new Image();

$adminUserID = 440057739240; // Admin userID
$adminUser = $User->get_user($adminUserID);
?>

<!DOCTYPE html>
<html>
<head>
    <title>e-Komuniti | Suggest Friend</title>
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
            background-color: rgba(255, 255, 255, 0.8);
        }

        #menu_buttons {
            display: inline-block;
            padding: 10px;
            text-decoration: none;
            color: black;
            border-radius: 5px;
            margin: 5px;
            transition: background-color 0.3s;
            background-color: white;
        }
        #menu_buttons:hover {
            background-color: #E7E1DF;
            color: black;
        }

        #admin_container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .admin_card {
            background-color: gold;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            transition: transform 0.3s;
        }

        .admin_card:hover {
            transform: translateY(-10px);
        }

        .admin_card img {
            width: 200px;
            height: 200px;
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
    </style>
</head>
<body style="font-family: tahoma; background-color: #dod8e4;">

    <?php include("header.php"); ?>

    <div style="width: 1200px; margin: auto; min-height: 400px;">
        <div id="menu">
            <a href="index.php" id="menu_buttons">Ruang Komuniti</a>
            <a href="suggestFriend.php" id="menu_buttons">Cadangan Rakan</a>
            <a href="fasiliti.php?section=fasiliti&id=<?php echo $user_data['userID']; ?>" id="menu_buttons">Fasiliti</a>
            <a href="profile.php?section=settings&id=<?php echo $user_data['userID']; ?>" id="menu_buttons">Profil</a>
        </div>
        
        <!-- Admin User Card -->
        <div id="admin_container">
            <div class="admin_card">
                <?php
                $adminImage = "images/male_user.jpg";
                if ($adminUser['gender'] == "Perempuan") {
                    $adminImage = "images/female_user.jpg";
                }

                if (file_exists($adminUser['profile_image'])) {
                    $adminImage = $image_class->get_thumb_profile($adminUser['profile_image']);
                }
                ?>
                <img src="<?php echo $adminImage ?>" alt="Profile Picture">
                <div><?php echo $adminUser['nickname'] ?></div>
                <a href="profile.php?id=<?php echo $adminUser['userID']; ?>">
                    <button class="view_profile_button">View Profile</button>
                </a>
            </div>
        </div>

        <!-- Regular User Cards -->
        <div id="grid_container">
            <?php
                if (is_array($results)) {
                    foreach ($results as $row) {
                        // Skip the admin user to avoid duplication
                        if ($row['userID'] == $adminUserID) {
                            continue;
                        }

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
                } else {
                    echo "No results were found";
                }
            ?>
        </div>
    </div>

</body>
</html>

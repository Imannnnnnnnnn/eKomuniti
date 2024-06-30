<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Settings</title>
<style>
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
            background-image: url();
        }

         #green_bar {
            height: 50px;
            background-color: #FFDBD2;
            color: black;
            padding-top: 10px;
        }

    .container {

        justify-content: center;
        align-items: center;
        height: 50vh;
    }
    .form-container {
        
        padding: 20px;
        max-width: 780px;
        min-height: 1000px;
        border-radius: 8px;
       
    }
    .form-container input[type="text"],
    .form-container input[type="password"],
    .form-container select {
        width: calc(100% - 40px);
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    .form-container input[type="submit"] {
        width: 95%;
        padding: 10px;
        background-color: #53A6FE;
        color: #ffffff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    .form-container input[type="submit"]:hover {
        background-color: #007bff;
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

</style>
</head>
<body>
<div class="container">
    <div class="form-container">
        <form method="post" enctype="multipart/form-data">
            <?php
            $settings_class = new Settings();
            $settings = $settings_class->get_settings($_SESSION['ekomuniti_userID']);
            if (is_array($settings)) {
                ?>
                <input type="text" name="name" value="<?= htmlspecialchars($settings['name']) ?>" placeholder="Name" style="height:30px">
                <input type="text" name="nickname" value="<?= htmlspecialchars($settings['nickname']) ?>" placeholder="Nickname" style="height:30px">
                <select name="gender" style="height:40px" disabled>
                    <option value="">Select Gender</option>
                    <option value="Male" <?= ($settings['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= ($settings['gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
                </select>
                <input type="text" name="email" value="<?= htmlspecialchars($settings['email']) ?>" placeholder="Email" style="height:30px">
                <input type="text" name="houseNum" value="<?= htmlspecialchars($settings['houseNum']) ?>" placeholder="House Number" style="height:30px">
                <input type='password' name='pass' value="<?= htmlspecialchars($settings['pass']) ?>" placeholder="Password" style="height:30px">
                <input type='password' name='password2' value="<?= htmlspecialchars($settings['pass']) ?>" placeholder="Confirm Password" style="height:30px">
                <br><br>
                <input type="submit" value="Save">
                <?php
            }
            ?>
        </form>
    </div>
</div>
</body>
</html>


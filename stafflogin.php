<?php
session_start();

    include("classes/connect.php");
    include("classes/staff_functionclass.php");



    $username="";
    $password="";


    if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $login=new StaffFunction();
    $result =  $login->evaluate($_POST);

   if ($result != "") {
    echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
    echo "The following errors occurred<br><br>";
    echo $result;
    echo "</div>";

} else 

{
    header("Location: staff_homepage.php"); 
    die;
}

    $username =$_POST['username']; 
    $password = $_POST['pass']; 
}

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Komuniti | Staff Log Masuk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('login.gif') center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        #bar {
            height: 80px;
            background-color: rgba(255, 255, 255, 0.7);
            color: black;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #logo {
            font-size: 36px;
        }

        #signup {
            background-color: #42b72a;
            width: 120px;
            text-align: center;
            padding: 10px;
            border-radius: 4px;
            text-decoration: none;
            color: white;
            transition: background-color 0.3s ease;
        }

        #signup:hover {
            background-color: #2f871e;
        }

        #login {
            background-color: rgba(255, 255, 255, 0.8);
            width: 400px;
            margin: 50px auto;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
        }

        #login input[type="text"],
        #login input[type="password"] {
            height: 40px;
            width: 80%;
            border-radius: 4px;
            border: solid 1px #ccc;
            padding: 10px;
            font-size: 16px;
            margin-bottom: 20px;
        }

        #button {
            height: 40px;
            width: 80%;
            border-radius: 4px;
            font-weight: bold;
            border: none;
            background-color: #C7F2B8;
            color: black;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #button:hover {
            background-color: #a8dd99;
        }

        #user-login {
            margin-top: 20px;
            font-size: 14px;
        }

        #user-login a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        #user-login a:hover {
            color: #666;
        }
    </style>
</head>
<body>
    <div id="bar">
        <div id="logo">e-Komuniti (STAFF)</div>
      
    </div>

    <div id="login">
        <form method="post">
            <h2>Log Masuk e-Komuniti (Staff)</h2>
            <input name="username" value="<?php echo $username ?>" type="text" id="text" placeholder="Staff ID"><br>
            <input name="pass" value="<?php echo $password ?>" type="password" id="text" placeholder="Kata Laluan"><br>
            <input type="submit" id="button" value="Log in"><br>
        </form>

        <div id="user-login">
            <a href="login.php">Log in as user</a>
        </div>
    </div>
</body>
</html>

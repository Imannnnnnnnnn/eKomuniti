<?php
include("classes/connect.php");
include("classes/signupclass.php");

$name = "";
$gender = "";
$email = "";
$houseNum = "";
$nickname = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $signup = new Signup();
    $result = $signup->evaluate($_POST);

    if ($result === "Berjaya Mendaftar!") {
        echo "<script type='text/javascript'>
                alert('Berjaya Mendaftar!');
                window.location.href = 'login.php';
              </script>";
        exit;
    } else {
        echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
        echo "The following errors occurred<br><br>";
        echo $result;
        echo "</div>";

        // Restore form input values
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $houseNum = $_POST['houseNum'];
        $nickname = $_POST['nickname'];
    }
}
?>

<html>
<head>
    <title>e-Komuniti | Daftar Pengguna</title>
    <style>
        #bar {
            height: 100px;
            background-color: #C7F2B8;
            color: black;
            padding: 4px;
        }

        #signup {
            background-color: #42b72a;
            width: 70px;
            text-align: center;
            padding: 4px;
            border-radius: 4px;
            float: right;
        }

        #login {
            background-color: white;
            width: 800px;
            margin: auto;
            margin-top: 20px;
            padding: 10px;
            text-align: center;
            padding-top: 50px;
            font-weight: bold;
        }

        #text {
            height: 40px;
            width: 300px;
            border-radius: 4px;
            border: solid 1px #ccc;
            padding: 4px;
            font-size: 14px;
        }

        #button {
            height: 40px;
            width: 300px;
            border-radius: 4px;
            font-weight: bold;
            border: none;
            background-color: #C7F2B8;
            color: black;
        }
    </style>
</head>
<body style="font-family: Tahoma; background-color: #e9ebee;">
    <div id="bar">
        <div style="font-size: 40px;">e-Komuniti</div>
        <a href="login.php">
            <div id="signup">Log Masuk</div>
        </a>
    </div>

    <div id="login">
        Daftar Pengguna Baru e-Komuniti<br><br><br>
        <form method="post" action="">
            <input value="<?php echo $name; ?>" name="name" type="text" id="text" placeholder="Nama"><br><br>
            <input value="<?php echo $nickname; ?>" name="nickname" type="text" id="text" placeholder="Nama Panggilan"><br><br>
            <span style="font-weight: normal">Jantina:</span><br>
            <select id="text" name="gender">
                <option><?php echo $gender; ?></option>
                <option>Lelaki</option>
                <option>Perempuan</option>        
            </select><br><br>
            <input value="<?php echo $email; ?>" name="email" type="text" id="text" placeholder="Email"><br><br>
            <input value="<?php echo $houseNum; ?>" name="houseNum" type="text" id="text" placeholder="Nombor Rumah (Contoh: B0425)"><br><br>
            <input name="pass" type="password" id="text" placeholder="Kata Laluan"><br><br>
            <input name="pass2" type="password" id="text" placeholder="Tulis Semula Kata Laluan"><br><br>
            <input type="submit" id="button" value="Daftar Pengguna Baru">
            <br><br><br>
        </form>
    </div>
</body>
</html>

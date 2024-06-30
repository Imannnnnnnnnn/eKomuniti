<?php
include("classes/autoloadclass.php");

$login = new Login();
$user_data = $login->check_login($_SESSION['ekomuniti_userID']);
$USER = $user_data;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $profile = new Profile();
    $profile_data = $profile->get_profile($_GET['id']);
    if (is_array($profile_data)) {
        $user_data = $profile_data[0];
    }
}

// Posting starts here
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $post = new Post();
    $id = $_SESSION['ekomuniti_userID'];
    $result = $post->create_post($id, $_POST, $_FILES);
    if ($result === true) {
        // Redirect to the same page to prevent form resubmission
        header("Location: index.php");
        exit;
    } elseif ($result === false) {
        echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
        echo "An error occurred while creating the post. Please try again later.";
        echo "</div>";
    } else {
        echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
        echo "The following errors occurred:<br><br>";
        echo $result;
        echo "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>e-Komuniti | Fasiliti</title>
    <?php include("fasiliti.css"); ?>
</head>
<body>
    <?php include("header.php"); ?>
    <div id="menu">
        <a href="index.php" id="menu_buttons">Ruang Komuniti</a>
        <a href="suggestFriend.php?section=fasiliti&id=<?php echo $user_data['userID']; ?>" id="menu_buttons">Cadangan Rakan</a>
        <a href="fasiliti.php?section=fasiliti&id=<?php echo $user_data['userID']; ?>" id="menu_buttons">Fasiliti</a>
        <a href="profile.php?section=settings&id=<?php echo $user_data['userID']; ?>" id="menu_buttons">Profil</a>
    </div>
    <br>
    <div id="main_content">
        <img src="fasilitiCP.jpg" id="responsive_image">
    </div>
    <div id="main_content">
        <div class="slider-container">
            <div class="slider-content reverse">
                <div class="slider">
                    <div class="slides" id="slider1">
    <img src="SP\sp1.jpg" alt="Picture 1">
<img src="SP\sp2.jpg" alt="Picture 2">
<img src="SP\sp3.jpg" alt="Picture 3">
<img src="SP\sp4.jpg" alt="Picture 4">
<img src="SP\sp5.jpg" alt="Picture 5">
<img src="SP\sp6.jpg" alt="Picture 6">
<img src="SP\sp7.jpg" alt="Picture 7">
<img src="SP\sp8.jpg" alt="Picture 8">
<img src="SP\sp9.jpg" alt="Picture 9">
<img src="SP\sp10.jpg" alt="Picture 10">
<img src="SP\sp11.jpg" alt="Picture 11">
<img src="SP\sp12.jpg" alt="Picture 12">
<img src="SP\sp13.jpg" alt="Picture 13">
<img src="SP\sp14.jpg" alt="Picture 14">
<img src="SP\sp15.jpg" alt="Picture 15">
<img src="SP\sp16.jpg" alt="Picture 16">
<img src="SP\sp17.jpg" alt="Picture 17">
<img src="SP\sp18.jpg" alt="Picture 18">
<img src="SP\sp19.jpg" alt="Picture 19">
<img src="SP\sp20.jpg" alt="Picture 20">
<img src="SP\sp21.jpg" alt="Picture 21">
<img src="SP\sp22.jpg" alt="Picture 22">
<img src="SP\sp23.jpg" alt="Picture 23">
<img src="SP\sp24.jpg" alt="Picture 24">
<img src="SP\sp25.jpg" alt="Picture 25">
<img src="SP\sp26.jpg" alt="Picture 26">
<img src="SP\sp27.jpg" alt="Picture 27">
<img src="SP\sp28.jpg" alt="Picture 28">
<img src="SP\sp29.jpg" alt="Picture 29">
<img src="SP\sp30.jpg" alt="Picture 30">
<img src="SP\sp31.jpg" alt="Picture 31">
<img src="SP\sp32.jpg" alt="Picture 32">
<img src="SP\sp33.jpg" alt="Picture 33">
<img src="SP\sp34.jpg" alt="Picture 34">
<img src="SP\sp35.jpg" alt="Picture 35">
<img src="SP\sp36.jpg" alt="Picture 36">
<img src="SP\sp37.jpg" alt="Picture 37">
<img src="SP\sp38.jpg" alt="Picture 38">
<img src="SP\sp39.jpg" alt="Picture 39">
<img src="SP\sp40.jpg" alt="Picture 40">
<img src="SP\sp41.jpg" alt="Picture 41">
<img src="SP\sp42.jpg" alt="Picture 42">
<img src="SP\sp43.jpg" alt="Picture 43">
<img src="SP\sp44.jpg" alt="Picture 44">
<img src="SP\sp45.jpg" alt="Picture 45">
<img src="SP\sp46.jpg" alt="Picture 46">
<img src="SP\sp47.jpg" alt="Picture 47">
<img src="SP\sp48.jpg" alt="Picture 48">
<img src="SP\sp49.jpg" alt="Picture 49">
<img src="SP\sp50.jpg" alt="Picture 50">
<img src="SP\sp51.jpg" alt="Picture 51">
<img src="SP\sp52.jpg" alt="Picture 52">
<img src="SP\sp53.jpg" alt="Picture 53">
<img src="SP\sp54.jpg" alt="Picture 54">
<img src="SP\sp55.jpg" alt="Picture 55">
<img src="SP\sp56.jpg" alt="Picture 56">
<img src="SP\sp57.jpg" alt="Picture 57">
<img src="SP\sp58.jpg" alt="Picture 58">
<img src="SP\sp59.jpg" alt="Picture 59">
<img src="SP\sp60.jpg" alt="Picture 60">
</div>

                    <input type="range" min="0" max="60" value="0" class="slider-range" id="slider1-range">
                </div>
                <div class="text-area" style="background-image: url('sp.png'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                        <h1>Swimming Pool</h1>
                        <br>
                        <h3>Waktu Beroperasi</h3>
                        <h4>8.00 pagi - 10.00 malam (Setiap Hari)</h4>
                        <h3>Kolam Dewasa</h3>
                        <h4>Kedalaman: 150 CM</h4>
                        <h3>Kolam Kanak-kanak</h3>
                        <h4>Kedalaman: 100 CM</h4>
                        <br>
                        <h4>Fasiliti</h4>
                        <ul>
                            <li>Tempat duduk yang selesa</li>
                            <li>Pakai pakaian swimsuit atau fabrik polyster</li>
                        </ul>
                        <br>
                    </div>

            </div>
        </div>





        <div class="slider-container">
            <div class="slider-content">
                <div class="slider">
                   <div class="slides" id="slider2">
    <img src="C\c1.jpg" alt="Picture 1">
    <img src="C\c2.jpg" alt="Picture 2">
    <img src="C\c3.jpg" alt="Picture 3">
    <img src="C\c4.jpg" alt="Picture 4">
    <img src="C\c5.jpg" alt="Picture 5">
    <img src="C\c6.jpg" alt="Picture 6">
    <img src="C\c7.jpg" alt="Picture 7">
    <img src="C\c8.jpg" alt="Picture 8">
    <img src="C\c9.jpg" alt="Picture 9">
    <img src="C\c10.jpg" alt="Picture 10">
    <img src="C\c11.jpg" alt="Picture 11">
    <img src="C\c12.jpg" alt="Picture 12">
    <img src="C\c13.jpg" alt="Picture 13">
    <img src="C\c14.jpg" alt="Picture 14">
    <img src="C\c15.jpg" alt="Picture 15">
    <img src="C\c16.jpg" alt="Picture 16">
    <img src="C\c17.jpg" alt="Picture 17">
    <img src="C\c18.jpg" alt="Picture 18">
    <img src="C\c19.jpg" alt="Picture 19">
    <img src="C\c20.jpg" alt="Picture 20">
    <img src="C\c21.jpg" alt="Picture 21">
    <img src="C\c22.jpg" alt="Picture 22">
    <img src="C\c23.jpg" alt="Picture 23">
    <img src="C\c24.jpg" alt="Picture 24">
    <img src="C\c25.jpg" alt="Picture 25">
    <img src="C\c26.jpg" alt="Picture 26">
    <img src="C\c27.jpg" alt="Picture 27">
    <img src="C\c28.jpg" alt="Picture 28">
    <img src="C\c29.jpg" alt="Picture 29">
    <img src="C\c30.jpg" alt="Picture 30">
    <img src="C\c31.jpg" alt="Picture 31">
    <img src="C\c32.jpg" alt="Picture 32">
    <img src="C\c33.jpg" alt="Picture 33">
    <img src="C\c34.jpg" alt="Picture 34">
    <img src="C\c35.jpg" alt="Picture 35">
    <img src="C\c36.jpg" alt="Picture 36">
    <img src="C\c37.jpg" alt="Picture 37">
    <img src="C\c38.jpg" alt="Picture 38">
</div>

                    <input type="range" min="0" max="38" value="0" class="slider-range" id="slider2-range">
                </div>
               <div class="text-area" style="background-image: url('cafe.png'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <h1>Cafe Dean's Kitchen</h1>
    <br>
    <h3>Waktu Beroperasi</h3>
    <h4>1.00 petang - 11.00 malam(Jumaat - Ahad)</h4>
    <h4>12.00 tengah hari - 10.00 malam (Isnin - Khamis)</h4>
    <h3>Jenis Perkhidmatan</h3>
    <h4>Makan di tempat (Tempat Terhad)</h4>
    <h3>Penghantaran ke rumah</h3>
    <h4>Bawa pulang</h4>
    <br>
    <h4>Fasiliti</h4>
    <ul>
        <a href="https://easyeat.ai/r/deans/2"><li>Layari laman web untuk membuat pesanan Bawa pulang</li></a>
        <li>Caj penghantaran ke rumah akan dikenakan</li>
        <p>Phone: <a href="https://wa.link/r8wrfn">+60 11-6116 5516</a></p>
    </ul>
    </ul>
    <br>
</div>

</div>
            </div>





        <div class="slider-container">
            <div class="slider-content reverse">
                <div class="slider">
                    <div class="slides" id="slider3">
    <img src="fasiliti\tp1.jpg" alt="Picture 1">
    <img src="fasiliti\tp2.jpg" alt="Picture 2">
    <img src="fasiliti\tp3.jpg" alt="Picture 3">
    <img src="fasiliti\tp4.jpg" alt="Picture 4">
    <img src="fasiliti\tp5.jpg" alt="Picture 5">
    <img src="fasiliti\tp6.jpg" alt="Picture 6">
    <img src="fasiliti\tp7.jpg" alt="Picture 7">
    <img src="fasiliti\tp8.jpg" alt="Picture 8">
    <img src="fasiliti\tp9.jpg" alt="Picture 9">
    <img src="fasiliti\tp10.jpg" alt="Picture 10">
    <img src="fasiliti\tp11.jpg" alt="Picture 11">
    <img src="fasiliti\tp12.jpg" alt="Picture 12">
    <img src="fasiliti\tp13.jpg" alt="Picture 13">
    <img src="fasiliti\tp14.jpg" alt="Picture 14">
    <img src="fasiliti\tp15.jpg" alt="Picture 15">
    <img src="fasiliti\tp16.jpg" alt="Picture 16">
    <img src="fasiliti\tp17.jpg" alt="Picture 17">
    <img src="fasiliti\tp18.jpg" alt="Picture 18">
    <img src="fasiliti\tp19.jpg" alt="Picture 19">
    <img src="fasiliti\tp20.jpg" alt="Picture 20">
    <img src="fasiliti\tp21.jpg" alt="Picture 21">
    <img src="fasiliti\tp22.jpg" alt="Picture 22">
    <img src="fasiliti\tp23.jpg" alt="Picture 23">
    <img src="fasiliti\tp24.jpg" alt="Picture 24">
    <img src="fasiliti\tp25.jpg" alt="Picture 25">
    <img src="fasiliti\tp26.jpg" alt="Picture 26">
    <img src="fasiliti\tp27.jpg" alt="Picture 27">
    <img src="fasiliti\tp28.jpg" alt="Picture 28">
    <img src="fasiliti\tp29.jpg" alt="Picture 29">
    <img src="fasiliti\tp30.jpg" alt="Picture 30">
    <img src="fasiliti\tp31.jpg" alt="Picture 31">
    <img src="fasiliti\tp32.jpg" alt="Picture 32">
    <img src="fasiliti\tp33.jpg" alt="Picture 33">
    <img src="fasiliti\tp34.jpg" alt="Picture 34">
    <img src="fasiliti\tp35.jpg" alt="Picture 35">
    <img src="fasiliti\tp36.jpg" alt="Picture 36">
    <img src="fasiliti\tp37.jpg" alt="Picture 37">
    <img src="fasiliti\tp38.jpg" alt="Picture 38">
    <img src="fasiliti\tp39.jpg" alt="Picture 39">
    <img src="fasiliti\tp40.jpg" alt="Picture 40">
    <img src="fasiliti\tp41.jpg" alt="Picture 41">
    <img src="fasiliti\tp42.jpg" alt="Picture 42">
    <img src="fasiliti\tp43.jpg" alt="Picture 43">
    <img src="fasiliti\tp44.jpg" alt="Picture 44">
    <img src="fasiliti\tp45.jpg" alt="Picture 45">
    <img src="fasiliti\tp46.jpg" alt="Picture 46">
    <img src="fasiliti\tp47.jpg" alt="Picture 47">
    <img src="fasiliti\tp48.jpg" alt="Picture 48">
    <img src="fasiliti\tp49.jpg" alt="Picture 49">
    <img src="fasiliti\tp50.jpg" alt="Picture 50">
    <img src="fasiliti\tp51.jpg" alt="Picture 51">
</div>

                    <input type="range" min="0" max="51" value="0" class="slider-range" id="slider3-range">
                </div>
               <div class="text-area" style="background-image: url('tp.png'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                        <h1>Taman Permainan</h1>
                        <br>
                        <h3>Waktu Beroperasi</h3>
                        <h4>8.00 pagi - 11.00 malam</h4>
                        <br>
                        <h4>Fasiliti</h4>
                        <ul>
                            <li>Terdapat 5 Gazebo disediakan</li>
                            <li>Taman permainan kanak-kanak</li>
                            <li>Kemudahan "Outdoor Fitness Equiptment</li>
                         <p>Phone: <a href="https://wa.link/r8wrfn">+60 11-6116 5516</a></p>
                     </ul>
                     </ul>
                    <br>
                </div>

                </div>
                </div>
                    




    <div class="slider-container">
            <div class="slider-content">
                <div class="slider">
                   <div class="slides" id="slider4">
                        <img src="DK\dk1.jpg" alt="Picture 2">
                        <img src="DK\dk3.jpg" alt="Picture 3">
                        <img src="DK\dk2.jpg" alt="Picture 2">
                        <img src="DK\dk3.jpg" alt="Picture 3">
                        <img src="DK\dk4.jpg" alt="Picture 4">
                        <img src="DK\dk5.jpg" alt="Picture 5">
                        <img src="DK\dk6.jpg" alt="Picture 6">
                        <img src="DK\dk7.jpg" alt="Picture 7">
                        <img src="DK\dk8.jpg" alt="Picture 8">
                        <img src="DK\dk9.jpg" alt="Picture 9">
                        <img src="DK\dk10.jpg" alt="Picture 10">
                        <img src="DK\dk11.jpg" alt="Picture 11">
                        <img src="DK\dk12.jpg" alt="Picture 12">
                        <img src="DK\dk13.jpg" alt="Picture 13">
                        <img src="DK\dk14.jpg" alt="Picture 14">
                        <img src="DK\dk15.jpg" alt="Picture 15">
                        <img src="DK\dk16.jpg" alt="Picture 16">
                        <img src="DK\dk17.jpg" alt="Picture 17">
                        <img src="DK\dk18.jpg" alt="Picture 18">
                        <img src="DK\dk19.jpg" alt="Picture 19">
                        <img src="DK\dk20.jpg" alt="Picture 20">
                        <img src="DK\dk21.jpg" alt="Picture 21">
                        <img src="DK\dk22.jpg" alt="Picture 22">
                        <img src="DK\dk23.jpg" alt="Picture 23">
                        <img src="DK\dk24.jpg" alt="Picture 24">
                        <img src="DK\dk25.jpg" alt="Picture 25">
                        <img src="DK\dk26.jpg" alt="Picture 26">
                        <img src="DK\dk27.jpg" alt="Picture 27">
                        <img src="DK\dk28.jpg" alt="Picture 28">
                        <img src="DK\dk29.jpg" alt="Picture 29">
                        <img src="DK\dk30.jpg" alt="Picture 30">
                        <img src="DK\dk31.jpg" alt="Picture 31">
                        <img src="Dk\dk32.jpg" alt="Picture 32">
                        <img src="Dk\dk33.jpg" alt="Picture 33">
                        <img src="Dk\dk34.jpg" alt="Picture 34">
                        <img src="Dk\dk35.jpg" alt="Picture 35">
                        <img src="Dk\dk36.jpg" alt="Picture 36">
                        <img src="Dk\dk37.jpg" alt="Picture 37">
                        <img src="Dk\dk38.jpg" alt="Picture 38">
                        <img src="Dk\dk39.jpg" alt="Picture 39">
                        <img src="Dk\dk40.jpg" alt="Picture 40">
                        <img src="Dk\dk41.jpg" alt="Picture 41">
                        <img src="Dk\dk42.jpg" alt="Picture 42">
                        <img src="Dk\dk43.jpg" alt="Picture 43">
                        <img src="Dk\dk44.jpg" alt="Picture 44">
                        <img src="Dk\dk45.jpg" alt="Picture 45">
                        <img src="Dk\dk46.jpg" alt="Picture 46">
                        <img src="Dk\dk47.jpg" alt="Picture 47">
                        <img src="Dk\dk48.jpg" alt="Picture 48">

                    </div>

                    <input type="range" min="0" max="48" value="0" class="slider-range" id="slider4-range">
                </div>
                <div class="text-area" style="background-image: url('dobik.png'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                        <h1>Jom Cuci DIY (Car Wash)</h1>
                        <br>
                        <h3>Waktu Beroperasi</h3>
                        <h4>24 Jam Setiap Hari</h4>
                        <h3>Jenis Perkhidmatan</h3>
                     
                        <h4>Fasiliti</h4>
                        <ul>
                            <li>Guna kad Jom Cuci untuk menggunakan servis ini</li>
                             <li>Kad ada dijual di Pejabat Pengurusan atau Zamrud Market</li>
                              <li>Servis termasuk :</li>
                              <ul>
                                <li>Shampoo Wax ✅</li>
                                <li>Sterilizer ✅</li>
                                <li>Blower ✅</li>
                                <li>Vacuum ✅</li>
                            </ul>
                            <li>RM25 = 25 kredit</li>
                         <p>Phone: <a href="https://wa.link/zs5l80">+60 11-3333 3876</a></p>
                     </ul>
                     </ul>
                    <br>
                </div>

                </div>
                </div>
                </div>




    <div class="contact-container">
        <div class="contact-info">
            <img src="ekomuniti.png" alt="City Central Hotel Logo">
            <p>Email: <a href="mailto:imnsh49@gmail.com">zamrud@gmail.com</a></p>
            <p>Phone: <a href="tel:+6017-2586585">+60132683216</a></p>
            <p>Address:  Jalan Zamrud Utama, 43500 Kajang, Selangor</p>
            <p><a href="https://www.google.com/maps/place/Residensi+Zamrud+Blok+C%26D/@2.9524756,101.7893331,17z/data=!3m1!4b1!4m6!3m5!1s0x31cdcbfed868e205:0xdb8929147b1c51ee!8m2!3d2.9524756!4d101.791908!16s%2Fg%2F11fx8bw_rl?entry=ttu" target="_blank">Check map</a></p>
        </div>
        <div class="contact-links">
            <h3>Useful Links</h3>
            <p><a href="#">Home</a></p>
            <p><a href="#">Contact</a></p>
        </div>
 
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function setupSlider(sliderId, rangeId) {
                const slider = document.getElementById(sliderId);
                const range = document.getElementById(rangeId);
                const images = slider.querySelectorAll("img");
                const imageCount = images.length;

                range.addEventListener("input", function() {
                    const index = range.value;
                    const offset = -index * 100; // Assuming each image takes 100% of the slider width
                    images.forEach(img => {
                        img.style.transform = `translateX(${offset}%)`;
                    });
                });
            }

            setupSlider("slider1", "slider1-range");
            setupSlider("slider2", "slider2-range");
            setupSlider("slider3", "slider3-range");
            setupSlider("slider4", "slider4-range");
        });
    </script>
</body>
</html>

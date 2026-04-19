<?php

include '../koneksi.php';

$searchPopup = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST['tipe'])){
            echo "<script> </script>";
            exit;
        }

        $role = "pembeli";
        $tipe = $_POST['tipe'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $alamat = $_POST['alamat'];
        $telepon = $_POST['telepon'];
        $email = $_POST['email'];

        $kirim = "INSERT INTO users(username, password, role, tipe, no_telepon, email, alamat) 
                VALUES('$username','$password','$role','$tipe','$telepon','$email','$alamat')";
        
       if($db_ekantin->query($kirim)){
        $id_user = $db_ekantin->insert_id;

        $db_ekantin->query("INSERT INTO pembeli(id_users, nama, no_telepon, email, alamat)
                            VALUES('$id_user','$username','$telepon','$email','$alamat')");

        $searchPopup = "
            <div class='popupBackground'>
                <div class='kotakTengah'>
                    <img src='../img/centang1.png' class='gambarCentang'>
                    <p class='kalimatBawah'>User berhasil ditambahkan!</p>
                    <div class='kotakTombol'>
                        <a href='tambahUser.php'><button class='tombolAktif'>Kembali</button></a>
                    </div>
                </div>
            </div>";
    }
    
    }

if(isset($_POST['filter_penjual'])){
    $query = "SELECT * FROM users WHERE role='penjual'";
} elseif(isset($_POST['filter_pembeli'])){
    $query = "SELECT * FROM users WHERE role='pembeli'";
} else {
    $query = "SELECT * FROM users";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styleTambah.css">
</head>
<body>

<?php echo $searchPopup; ?>

    <div class="containerUtama">

        <div class="containerKotak">
            <div class="kotakLogo">
                <img src="../img/Rectangle2.png">
            </div>

            <div class="kotakMenu">
                <div class="barisMenu">
                    <a href="dashboard.php">
                    <div class="menu">
                        <p>Home</p>
                    </div>
                    </a>

                    <a href="kelolaUser.php">
                    <div class="menu" id="menu_aktif">
                        <p>Kelola User</p>
                    </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="containerDash">
            
            <a href="kelolaUser.php" class="tombolTambah">
                <img src="../img/back.png">
            </a>

            <div class="containerSearch">

                <div class="containerCari">
                    <img src="../img/tambahUSER.png">
                </div>

                <div class="displayAkun">
                    <a href="adminAccount.php">
                        <div class="profilAkun">
                            <div class="fotoAkun">
                            <img src="../img/logoAkun.png">
                        </div>
                        <div class="namaAkun">
                            <p class="namanya">oda dink</p>
                            <p class="rolenya">super admin</p>
                        </div>
                        </div>
                    </a>
                </div>

            </div>

            
            <div class="containerButton">
            </div>

            <div class="kotakList">
                <form method="POST">
                <div class="pemisah">
                    <b>USERNAME : </b>
                    <input type='text' name='username' class='kotakIsi' placeholder='Username'>
                </div>

                <div class="pemisah">
                    <b>PASSWORD : </b>
                    <input type='text' name='password' class='kotakIsi' placeholder='Password'>
                </div>

                <div class="pemisah">
                    <b>EMAIL : </b>
                    <input type='text' name='email' class='kotakIsi' placeholder='Email'>
                </div>

                <div class="pemisah">
                    <b>TELEPON : </b>
                    <input type='text' name='telepon' class='kotakIsi' placeholder='No Telepon'>
                </div>

                <div class="pemisah">
                    <b>ALAMAT : </b>
                    <input type='text' name='alamat' class='kotakIsi' placeholder='Alamat'>
                </div>

                <div class="pemisah">
                    <b>TIPE : </b>
                    <div class="kotakRadio">
                    <input type="radio" name="tipe" id="siswa" value="siswa">
                        <label for="siswa">Siswa</label>

                    <input type="radio" name="tipe" id="guru" value="guru">
                        <label for="guru">Guru</label>

                    <input type="radio" name="tipe" id="orang_luar" value="orang_luar">
                        <label for="orang_luar">Orang Luar</label>
                    </div>
                </div>

                <div class="pemisah">
                    <div class="submitTengah">
                        <input type="submit" class="tombolSubmit" value="Submit">
                    </div>
                </div>

            </form>
            </div>
        </div>


    </div>
</body>
</html>
<?php
session_start();
include '../koneksi.php';

if(!isset($_SESSION['id_users']) || $_SESSION['role'] != 'admin'){
    header("Location: gate.php");
    exit();
}

if(isset($_POST['logout'])){
    session_destroy();
    header("Location: gate.php");
    exit();
}

$notif = "";
if(isset($_POST['ganti_password'])){
    $id           = $_SESSION['id_users'];
    $passwordLama = $_POST['password_lama'];
    $passwordBaru = $_POST['password_baru'];
    $konfirmasi   = $_POST['konfirmasi'];

    $cek  = $db_ekantin->query("SELECT * FROM users WHERE id_users='$id'");
    $data = $cek->fetch_assoc();

    if($passwordLama != $data['password']){
        $notif = "<p class='notifGagal'>Password lama salah!</p>";
    } else if($passwordBaru != $konfirmasi){
        $notif = "<p class='notifGagal'>Konfirmasi password tidak cocok!</p>";
    } else {
        $db_ekantin->query("UPDATE users SET password='$passwordBaru' WHERE id_users='$id'");
        $notif = "<p class='notifBerhasil'>Password berhasil diubah!</p>";
    }
}

$id     = $_SESSION['id_users'];
$result = $db_ekantin->query("SELECT * FROM users WHERE id_users='$id'");
$data   = $result->fetch_assoc();

$username = $data['username'];
$email    = $data['email'];
$telepon  = $data['no_telepon'];  
$role     = $data['role'];
$status   = $data['status'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styleAccount.css">
</head>
<body>
    
    <div class="containerUtama">

        <div class="containerKotak">
            <div class="kotakLogo">
                <img src="../img/Rectangle2.png">
            </div>
            <div class="kotakMenu">
                <div class="barisMenu">
                    <a href="dashboard.php">
                    <div class="menu" id="menu_aktif">
                        <p>Home</p>
                    </div>
                    </a>

                    <a href="kelolaUser.php">
                    <div class="menu">
                        <p>Kelola User</p>
                    </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="kotakProfil">

            <a href="dashboard.php" class="tombolTambah">
                <img src="../img/back.png">
            </a>

            <div class="containerProfile">
                <div class="fotoProfil"></div>
                <form method="POST">
                    <button type="submit" name="logout" class="kotakNama"><p>Logout</p></button>
                </form>
            </div>

            <div class="informasiProfile">
                <img src="../img/PROFIL-ADMIN.png">

                <div class="informasiClass1">
                    <div class="informasiClass2">
                        <p>Nama : </p>
                        <div class="informasiClass3"><?php echo $username; ?></div>
                    </div>
                    <div class="informasiClass2">
                        <p>Email : </p>
                        <div class="informasiClass3"><?php echo $email; ?></div>
                    </div>
                    <div class="informasiClass2">
                        <p>No Telepon : </p>
                        <div class="informasiClass3"><?php echo $telepon; ?></div> 
                    </div>
                    <div class="informasiClass2">
                        <p>Role : </p>
                        <div class="informasiClass3"><?php echo $role; ?></div>
                    </div>
                    <div class="informasiClass2">
                        <p>Status : </p>
                        <div class="informasiClass3"><?php echo $status; ?></div>
                    </div>
                </div>

                <div class="kotakGantiPassword">
                    <p class="judulGanti">Ganti Password</p>
                    <?php echo $notif; ?>
                    <form method="POST">
                        <input type="password" name="password_lama" placeholder="Password Lama" class="inputPassword">
                        <input type="password" name="password_baru" placeholder="Password Baru" class="inputPassword">
                        <input type="password" name="konfirmasi" placeholder="Konfirmasi Password Baru" class="inputPassword">
                        <input type="submit" name="ganti_password" value="Simpan" class="tombolSimpan">
                    </form>
                </div>

            </div>
        </div>

    </div>
</body>
</html>
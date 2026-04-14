<?php
include '../koneksi.php';

$popup = "";

if(isset($_POST['id_aktif'])){
    $id = $_POST['id_aktif'];
    $cek = $db_ekantin->query("SELECT * FROM users WHERE id_users='$id'");
    if($cek->num_rows > 0){
        $data = $cek->fetch_assoc();
        $username = $data['username'];
        $status = $data['status'];
        if($status == 'aktif'){
            $htmlStatus = "Akun $username sudah aktif!";
            $htmlGambar = "../img/silang1.png";
        } else {
            $db_ekantin->query("UPDATE users SET status='Aktif' WHERE id_users='$id'");
            $htmlStatus = "Akun $username berhasil diaktifkan!";
            $htmlGambar = "../img/centang1.png";
        }
        $popup = "
        <div class='popupBackground'>
        <div class='kotakTengah'>
            <img src='$htmlGambar' class='gambarCentang'>
            <p class='kalimatBawah'>$htmlStatus</p>
            <div class='kotakTombol'>
                <a href='kelolaUser.php'><button class='tombolAktif'>Kembali</button></a>
            </div>
        </div>
        </div>";
    }
}

if(isset($_POST['id_nonaktif'])){
    $id = $_POST['id_nonaktif'];
    $cek = $db_ekantin->query("SELECT * FROM users WHERE id_users='$id'");
    if($cek->num_rows > 0){
        $data = $cek->fetch_assoc();
        $username = $data['username'];
        $status = $data['status'];
        if($status == 'nonaktif'){
            $htmlStatus = "Akun $username sudah tidak aktif!";
            $htmlGambar = "../img/silang1.png";
        } else {
            $db_ekantin->query("UPDATE users SET status='Nonaktif' WHERE id_users='$id'");
            $htmlStatus = "Akun $username berhasil dinonaktifkan!";
            $htmlGambar = "../img/centang1.png";
        }
        $popup = "
        <div class='popupBackground'>
        <div class='kotakTengah'>
            <img src='$htmlGambar' class='gambarCentang'>
            <p class='kalimatBawah'>$htmlStatus</p>
            <div class='kotakTombol'>
                <a href='kelolaUser.php'><button class='tombolAktif'>Kembali</button></a>
            </div>
        </div>
        </div>";
    }
}

$searchPopup = "";
if(isset($_POST['id_user']) && $_POST['id_user'] != ''){
    $id = $_POST['id_user'];
    $result_search = $db_ekantin->query("SELECT * FROM users WHERE id_users='$id'");
    if($result_search->num_rows > 0){
        $data = $result_search->fetch_assoc();
        $username = $data['username'];
        $role     = $data['role'];
        $tipe     = $data['tipe'];
        $htmlNamaToko = "";
        if($role == "penjual"){
            $hasil = $db_ekantin->query("SELECT nama_toko FROM penjual WHERE id_users='$id'");
            $nama  = $hasil->fetch_assoc();
            $nama_toko = $nama['nama_toko'];
            $htmlNamaToko = "<p><span>Nama Toko</span> : $nama_toko</p>";
        }
        $searchPopup = "
        <div class='popupBackground'>
            <div class='kotakTengah'>
                <a class='tombolClose' href='kelolaUser.php'>
                    <img src='../img/silang1.png'>
                </a>
                <p class='judulKotak'>UBAH STATUS USER</p>
                <div class='infoUser'>
                    <p><span>NAMA</span> : $username</p>
                    <p><span>ROLE</span> : $role</p>
                    <p><span>TIPE</span> : $tipe</p>
                    $htmlNamaToko
                </div>
                <div class='kotakTombol'>
                    <form method='POST'>
                        <button type='submit' name='id_aktif' value='$id' class='tombolAktif'>Aktifkan</button>
                    </form>
                    <form method='POST'>
                        <button type='submit' name='id_nonaktif' value='$id' class='tombolNonaktif'>Nonaktifkan</button>
                    </form>
                </div>
            </div>
        </div>";
    } else {
        $searchPopup = "
        <div class='popupBackground'>
        <div class='kotakTengah'>
            <img src='img/silang1.png' class='gambarCentang'>
            <p class='kalimatBawah'>ID tidak ditemukan!</p>
            <div class='kotakTombol'>
                <a href='kelolaUser.php'><button class='tombolAktif'>Kembali</button></a>
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
    <link rel="stylesheet" href="css/styleKelola.css">
</head>
<body>
    
    <?php echo $popup; ?>
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
                    <div class="menu" id="menu_aktif">>
                        <p>Kelola User</p>
                    </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="containerDash">

            <div class="containerSearch">

            <form method="POST">
                <div class="containerCari">
                    <div class="kotakSearch">
                        <img src="../img/search.png">
                        <input type="number" name="id_user" placeholder="Search id">
                    </div>
                    <button type="submit" name="cari_user" class="tombolSearch">Search id</button>
                </div>
            </form>

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
                <form method="POST">
                <div class="jarakTombol">
                    <div class="tombolPembeli">
                        <button type="submit" name="filter_pembeli">Pembeli</button>
                    </div>
                    <div class="tombolPenjual">
                        <button type="submit" name="filter_penjual">Penjual</button>
                    </div>
                    <div class="tombolSemua">
                        <button type="submit" name="filter_semua">Semua</button>
                    </div>
                </div>
                </form>
            </div>

            <div class="invisible">
                <div class="kotakAtribut">
                    <div class="containerBawah">
                        <p class="kol-ID">ID</p>
                        <p class="kol-user">Username</p>
                        <p class="kol-tipe">Tipe</p>
                        <p class="kol-role">Role</p>
                        <p class="kol-telepon">No-Telepon</p>
                        <p class="kol-email">Email</p>
                        <p class="kol-status">Status</p>
                    </div>
                </div>
            </div>

            <div class="kotakList">

            <?php
            $result = $db_ekantin->query($query);
            if($result && $result->num_rows > 0){
                while($data = $result->fetch_assoc()){
                    $id      = $data['id_users'];
                    $username= $data['username'];
                    $role    = $data['role'];
                    $tipe    = $data['tipe'];
                    $telepon = $data['no_telepon'];
                    $email   = $data['email'];
                    $status  = $data['status'];
                    echo "
                    <div class='kotakAnggota'>
                    <div class='containerBawah'>
                        <p class='col-ID'>$id</p>
                        <p class='col-user'>$username</p>
                        <p class='col-tipe'>$tipe</p>
                        <p class='col-role'>$role</p>
                        <p class='col-telepon'>$telepon</p>
                        <p class='col-email'>$email</p>
                        <p class='col-status'>$status</p>
                    </div>
                </div>";
                }
            } else {
                echo "<p style='padding:20px;color:gray;'>Tidak ada data.</p>";
            }
            ?>
            </div>
        </div>


    </div>
</body>
</html>
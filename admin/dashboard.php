<?php
include '../koneksi.php';

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
    <link rel="stylesheet" href="css/styleDashboard.css">
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

                    <a href="dashboard.php">
                    <div class="menu">
                        <p>Home</p>
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
                        <input type="number" name="name_id" placeholder="Search id">
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
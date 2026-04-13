<?php
session_start();
include 'koneksi.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $cek = $db_ekantin->query($sql);

    if($cek->num_rows > 0){
        $data = $cek->fetch_assoc();

        if($password == $data['password']){

            $status = $data['status'];
            if($status == "aktif"){

                $_SESSION['id_users'] = $data['id_users'];
                $_SESSION['username'] = $data['username'];
                $_SESSION['role']     = $data['role'];
                $_SESSION['tipe']     = $data['tipe'];

                if($data['role'] == 'admin'){
                    $_SESSION['username'] = $data['username'];
                    header("Location: admin/dashboard.php");
                    exit;

                } else if($data['role'] == 'penjual'){
                    $cekPenjual = $db_ekantin->query("SELECT * FROM penjual WHERE id_users='{$data['id_users']}'");
                    $penjual    = $cekPenjual->fetch_assoc();
                    $_SESSION['kode_penjual'] = $penjual['kode_penjual'];
                    $_SESSION['nama_toko']    = $penjual['nama_toko'];
                    $_SESSION['nama_pemilik'] = $penjual['nama_pemilik'];

                    header("Location: penjual/dashboard.php");
                    exit;

                } else if($data['role'] == 'pembeli'){
                    $cekPembeli = $db_ekantin->query("SELECT * FROM pembeli WHERE id_users='{$data['id_users']}'");
                    $pembeli    = $cekPembeli->fetch_assoc();
                    $_SESSION['nama_pembeli'] = $pembeli['nama_pembeli'];

                    header("Location: pembeli/menu.php");
                    exit;
                }

            } else {
                echo "<script>
                    alert('Akun tidak aktif!');
                    window.location='index.php';
                </script>";
                exit;
            }

        } else {
            echo "<script>
                alert('Password salah!');
                window.location='index.php';
            </script>";
            exit;
        }

    } else {
        echo "<script>
            alert('Username tidak ditemukan!');
            window.location='login.php';
        </script>";
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styleLogin.css">
</head>
<body>
    
    <div class="kotakLogin">

        <div class="kotakAtas">
        </div>

        <div class="tengah">
             <img src="img/Rectangle2.png" class="logo">
            <img src="img/welcome.png" class="tulisan">
        </div>
           
            <form method="POST">
            <div class="containerInput">
                <div class="kotakInput">
                    <img src="img/Person.png">
                    <input type="text" name="username">
                </div>

                <div class="kotakInput">
                    <img src="img/Key.png">
                    <input type="password" name="password">
                </div>
            </div>

                <div class="kotakSubmit">
                    <input type="submit" name="simpan" value="LOGIN">
                </div>

            </form>

        <div class="lupaSandi">
            <a href="lupaSandi.php">Lupa Sandi?</a>
        </div>

    </div>
</body>
</html>
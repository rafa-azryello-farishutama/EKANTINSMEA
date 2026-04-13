<?php
session_start();
include '../koneksi.php';

if(!isset($_SESSION['id_users']) || $_SESSION['role'] != 'admin'){
    header("Location: ../index.php");
    exit();
}

if(isset($_POST['logout'])){
    session_destroy();
    header("Location: ../index.php");
    exit();
}

$id     = $_SESSION['id_users'];
$result = $db_ekantin->query("SELECT * FROM users WHERE id_users='$id'");
$data   = $result->fetch_assoc();

$username = $data['username'];
$email    = $data['email'];
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
                    <div class="menu">

                    </div>
                </div>
            </div>
        </div>

        <div class="kotakProfil">
            <div class="containerProfile">
                <div class="fotoProfil">

                </div>

                <form method="POST">
                    <button type="submit" name="logout" class="kotakNama"><p>Logout</p></button>
                </form>
            </div>

            <div class="informasiProfile">
                <img src="../img/PROFIL-ADMIN.png">

                <div class="informasiClass1">
                    <div class="informasiClass2">
                        <p>Nama : </p>
                        <div class="informasiClass3">
                            <?php echo $username; ?>
                        </div>
                    </div>

                    <div class="informasiClass2">
                        <p>Email : </p>
                        <div class="informasiClass3">
                            <?php echo $email; ?>
                        </div>
                    </div>

                    <div class="informasiClass2">
                        <p>No Telepon : </p>
                        <div class="informasiClass3">
                            <?php echo $role?>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>

    </div>
</body>
</html>
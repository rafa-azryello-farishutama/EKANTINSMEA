
<?php 
session_start();
include '../koneksi.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $db_ekantin->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql  = "SELECT * FROM users WHERE username='$username' AND role='admin'";
    $cek  = $db_ekantin->query($sql);

    if($cek->num_rows > 0){
        $data = $cek->fetch_assoc();

        if($password == $data['password']){
            if($data['status'] == 'aktif'){
                $_SESSION['id_users'] = $data['id_users'];
                $_SESSION['username'] = $data['username'];
                $_SESSION['role']     = $data['role'];
                header("Location: dashboard.php");
                exit;
            } else {
                echo "<script>alert('Akun tidak aktif!');window.location='login.php';</script>";
            }
        } else {
            echo "<script>alert('Password salah!');window.location='login.php';</script>";
        }
    } else {
        echo "<script>alert('Akun admin tidak ditemukan!');window.location='login.php';</script>";
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/styleLogin.css">
</head>
<body>
    
    <div class="kotakLogin">

        <div class="kotakAtas">
        </div>

        <div class="tengah">
             <img src="../img/Rectangle2.png" class="logo">
            <img src="../img/welcome.png" class="tulisan">
        </div>
           
            <form method="POST">
            <div class="containerInput">
                <div class="kotakInput">
                    <img src="../img/Person.png">
                    <input type="text" name="username">
                </div>

                <div class="kotakInput">
                    <img src="../img/Key.png">
                    <input type="password" name="password">
                </div>
            </div>

                <div class="kotakSubmit">
                    <input type="submit" name="simpan" value="LOGIN ADMIN">
                </div>
            </form>

    </div>
</body>
</html>


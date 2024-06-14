<?php
include ("../inc/inc_koneksi.php");
session_start();

$username = "";
$password_baru = "";
$konfirmasi_password = "";
$err = "";
$sukses = "";

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password_baru = $_POST['password_baru'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    if ($username == '' || $password_baru == '' || $konfirmasi_password == '') {
        $err = "Silahkan lengkapi semua data";
    } elseif ($password_baru != $konfirmasi_password) {
        $err = "Password baru dan konfirmasi password tidak sama";
    } elseif (strlen($password_baru) < 6) {
        $err = "Password minimal 6 karakter";
    } else {
        $password_baru = md5($password_baru);
        $sql1 = "SELECT * FROM admin WHERE username = '$username'";
        $q1 = mysqli_query($koneksi, $sql1);

        if (mysqli_num_rows($q1) < 1) {
            $err = "Username tidak ditemukan";
        } else {
            $sql2 = "UPDATE admin SET password='$password_baru' WHERE username='$username'";
            mysqli_query($koneksi, $sql2);
            $sukses = "Password berhasil direset. Silahkan login dengan password baru anda.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        crossorigin="anonymous">
    <title>Lupa Password</title>

    <link rel="stylesheet" href="../style/login.css">
</head>

<body>
    <div class="div-logo">
        <a href="../index.php" class="travel-logo">To<span>Travel</span>.</a>
    </div>
    <div class="login-wrapper">
        <form action="" method="POST" class="box-form">
            <h1 class="title-login">Lupa Password</h1>
            <?php
            if ($err) {
                echo "<div class='alert alert-danger'>$err</div>";
            }
            if ($sukses) {
                echo "<div class='alert alert-success'>$sukses</div>";
            }
            ?>
            <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control input-text" id="username" name="username" value="<?php echo $username ?>"
                required>
            </div>
            <div class="form-group">
                <label for="password_baru">Password Baru</label>
                <input type="password" class="form-control input-text" id="password_baru" name="password_baru" required>
            </div>
            <div class="form-group">
                <label for="konfirmasi_password">Konfirmasi Password Baru</label>
                <input type="password" class="form-control input-text" id="konfirmasi_password" name="konfirmasi_password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-reset" name="submit">Reset Password</button>
            <a href="login.php" class="btn btn-secondary">Login</a>
        </form>
    </div>
</body>

</html>
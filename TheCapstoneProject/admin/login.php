<?php
session_start();
if (isset($_SESSION['admin_username']) != '') {
    header("location:index.php");
    exit();
}
include ("../inc/inc_koneksi.php");

$username = "";
$password = "";
$err = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == '' or $password == '') {
        $err = "Silahkan lengkapi semua data";
    } else {
        $sql1 = "SELECT * FROM admin WHERE username = '$username'";
        $q1 = mysqli_query($koneksi, $sql1);
        $r1 = mysqli_fetch_array($q1);
        $n1 = mysqli_num_rows($q1);

        if ($n1 < 1) {
            $err = "Username tidak ditemukan";
        } elseif ($r1['password'] != md5($password)) {
            $err = "Password yang anda masukkan tidak sesuai";
        } else {
            $_SESSION['admin_username'] = $username;
            header("Location: index.php");
            exit();
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
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Login Admin</title>

    <link rel="stylesheet" href="../style/login.css">
</head>
<body>
    <div class="div-logo">
        <a href="../index.php" class="travel-logo">To<span>Travel</span>.</a>
    </div>
    <div class="login-wrapper">
        <form action="" method="POST" class="box-form">
            <h1 class="title-login">Login Admin ToTravel</h1>
            <?php if ($err) { ?>
                <div class="alert alert-danger">
                    <?php echo $err ?>
                </div>
            <?php } ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control input-text" id="username" name="username" placeholder="Masukkan Username"
                    value="<?php echo $username ?>" />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control input-text" id="password" name="password" placeholder="Masukkan Password" />
            </div>
            <button type="submit" class="btn btn-primary btn-login" name="login">Login</button>
            <a href="forgot_password.php" class="btn btn-secondary">Lupa Password</a>
        </form>
    </div>
</body>

</html>
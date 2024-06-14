<?php include ("header.php") ?>

<h1>Dashboard Admin</h1>
<p>
    Selamat datang <b><?php echo isset($_SESSION['admin_username']) ? $_SESSION['admin_username'] : 'Admin'; ?></b> di
    halaman admin ToTravel
</p>

<?php include ("footer.php") ?>
<?php
  // Include file koneksi
  include ("inc/inc_koneksi.php");
  $id = $_GET['id'];

  // Jika form disubmit
  if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $nilai = $_POST['nilai'];
    $deskripsi = $_POST['deskripsi'];

    // Validasi data yang dikirim dari formulir
    if ($nilai == '' || $nama == '' || $deskripsi == '') {
        $error = "Silahkan masukkan semua data yang diperlukan";
    } else {
        // Siapkan statement untuk memasukkan atau memperbarui data
        $sql = "INSERT INTO ulasan (ditinjau, nama, nilai, deskripsi) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($koneksi, $sql);
        if ($stmt === false) {
            $error = "Error: " . mysqli_error($koneksi);
        } else {
            mysqli_stmt_bind_param($stmt, "ssss", $id, $nama, $nilai, $deskripsi);
            if (mysqli_stmt_execute($stmt)) {
                header("Location:ulasan.php?id=$id");
            } else {
                $error = "Gagal memasukkan data: " . mysqli_error($koneksi);
            }
        }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
    rel="stylesheet"
  />
  <link
    href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
    rel="stylesheet"
  />
  <link
    href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
    rel="stylesheet"
  />
  <link rel="stylesheet" href="./style/ulasan.css">

  <script src="https://unpkg.com/feather-icons"></script>

  <title>Cari Destinasi | Pulau Jawa</title>
</head>
<body>
  <header class="header">
    <div class="header_title">
      <a href="#" class="navbar-logo">To<span>Travel</span>.</a>
    </div>
    <button id="menu" class="header__menu">☰</button>
    <nav id="drawer" class="nav-list">
      <ul>
        <li class="nav_item"><a href="home.php">Beranda</a></li>
        <li class="nav_item"><a href="home.php#favorite">Rekomendasi</a></li>
        <li class="nav_item"><a href="caritempat.php">Cari Destinasi</a></li>
        <li class="nav_item"><a href="home.php#about">Tentang Kami</a></li>
      </ul>
    </nav>
  </header>

  <main class="content">
    <section class="input_section">
        <h2>Input Ulasan <?php echo $id; ?></h2>
        <form id="input" method="post" enctype="multipart/form-data">
            <div class="input">
                <label for="nama">Nama</label>
                <input name="nama" id="nama" type="text" minlength="3" aria-describedby="titleValidation" required>
            </div>
            <div class="input">
                <label for="nilai">Rating</label>
                <input name="nilai" id="nilai" type="number" min="1" max="10" aria-describedby="titleValidation" required>
            </div>
            <div class="input">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" type="text" minlength="10" aria-describedby="bodyValidation" required></textarea>
            </div>
            <button name="simpan" id="reviewSubmit" type="submit">Submit</button>
        </form>
    </section>

    <section class="review_section">
      <h2>Ulasan</h2>

      <div id="card_review" class="review_list">
        <?php
          // Include file koneksi
          include ("inc/inc_koneksi.php");
          $id = $_GET['id'];
        
          // Query untuk mengambil data dari tabel jawa
          $sql1 = "SELECT * FROM ulasan WHERE ditinjau = '$id'";
          $q1 = mysqli_query($koneksi, $sql1);

          // Loop untuk menampilkan data
          if ($q1 && mysqli_num_rows($q1) > 0) {
              while ($r1 = mysqli_fetch_assoc($q1)) {
                  $nama = $r1['nama'];
                  $nilai = $r1['nilai'];
                  $deskripsi = $r1['deskripsi'];
                  ?>
                    <article class="review_item">
                      <h3><?php echo $nama; ?></h4>
                      <p><?php echo $nilai; ?>⭐</p>
                      <p><?php echo $deskripsi; ?></p>
                    </article>
                  <?php
              }
          } else {
              echo "Belum ada ulasan.";
          }
        ?>
      </div>
    </section>
  </main>

  <footer>
    <div class="footer-content">
      <div class="footer-copyright">
        <p tabindex="0">Copyright &copy; 2024 <a href="">To<span>Travel</span>.</a> All right reserved.</p>
      </div>
      <div class="footer-contact">
        <div class="social-media">
          <a href="#"><i class='bx bx-envelope'></i></a>
          <a href="#"><i class="bx bxl-whatsapp"></i></a>
          <a href="#"><i class="bx bxl-instagram"></i></a>
        </div>
      </div>
    </div>
  </footer>
  <script src="./script/index.js"></script>
</body>
</html>
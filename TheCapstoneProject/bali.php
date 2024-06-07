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
  <link rel="stylesheet" href="./style/pulau.css">

  <script src="https://unpkg.com/feather-icons"></script>

  <title>Cari Destinasi | Pulau Bali</title>
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
   <div class="card">

    <?php
      // Include file koneksi
      include ("inc/inc_koneksi.php");

      // Query untuk mengambil data dari tabel jawa
      $sql1 = "SELECT * FROM bali ORDER BY id DESC";
      $q1 = mysqli_query($koneksi, $sql1);

      // Loop untuk menampilkan data
      if ($q1 && mysqli_num_rows($q1) > 0) {
          while ($r1 = mysqli_fetch_assoc($q1)) {
              $id = $r1['id'];
              $foto1 = $r1['foto1'];
              ?>
                <div>
                  <a href="detail_bali.php?id=<?php echo $id; ?>">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($foto1); ?>" alt="Image <?php echo $id; ?>"/>
                    </a>
                  <div class="image-text">
                    <h1>
                      <?php echo htmlspecialchars($r1['namawisata']); ?>
                    </h1>
                  </div>
                </div>
              <?php
          }
      } else {
          echo "Data tidak ditemukan.";
      }
      ?>
    </div>
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
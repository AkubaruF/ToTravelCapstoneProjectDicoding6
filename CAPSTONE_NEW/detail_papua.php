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
  <link rel="stylesheet" href="./style/detail.css">

  <script src="https://unpkg.com/feather-icons"></script>

  <title>Destinasi Pulau Papua</title>
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
        <li class="nav_item"><a href="home.php#favorite">Favorite</a></li>
        <li class="nav_item"><a href="home.php#about">Tentang Kami</a></li>
      </ul>
    </nav>
  </header>

  <main class="content">

    <?php
      // Include file koneksi
      include ("inc/inc_koneksi.php");

      // Ambil id dari parameter URL
      if (isset($_GET['id'])) {
          $id = $_GET['id'];

          // Query untuk mengambil data dari tabel isi berdasarkan id
          $sql1 = "SELECT * FROM papua WHERE id = '$id'";
          $q1 = mysqli_query($koneksi, $sql1);

          // Periksa apakah query berhasil dan data ditemukan
          if ($q1 && mysqli_num_rows($q1) > 0) {
              $r1 = mysqli_fetch_assoc($q1);
              $nama_wisata = $r1['namawisata'];
              $alamat_wisata = $r1['alamatwisata'];
              $deskripsi_wisata = $r1['deskripsiwisata'];
              $nama_kuliner = $r1['namakuliner'];
              $alamat_kuliner = $r1['alamatkuliner'];
              $deskripsi_kuliner = $r1['deskripsikuliner'];
              $foto1 = $r1['foto1'];
              $foto2 = $r1['foto2'];
              $foto3 = $r1['foto3'];
              $foto4 = $r1['foto4'];
              $foto5 = $r1['foto5'];
              $foto6 = $r1['foto6'];
              ?>

              <!-- <h2>Destinasi</h2> -->
              <div class="catalog">
                <h1 tabindex="0" class="catalog_label">Destinasi Wisata</h1>
                <div class="post_detail">
                  <h2 tabindex="0" class="destinasi-info_name"><?php echo htmlspecialchars($nama_wisata); ?></h2>
                  <div class="destinasi-img">
                    <?php if ($foto1) { ?>
                      <img class="item_img" src="data:image/jpeg;base64,<?php echo base64_encode($foto1); ?>" alt="Foto 1">
                    <?php } ?>
                    <?php if ($foto2) { ?>
                      <img class="item_img" src="data:image/jpeg;base64,<?php echo base64_encode($foto2); ?>" alt="Foto 2">
                    <?php } ?>
                    <?php if ($foto3) { ?>
                      <img class="item_img" src="data:image/jpeg;base64,<?php echo base64_encode($foto3); ?>" alt="Foto 3">
                    <?php } ?>
                  </div>
                  <div class="destinasi-info">
                    <p tabindex="0" class="destinasi-info_description"><?php echo htmlspecialchars($deskripsi_wisata); ?></p>
                    <p tabindex="0" class="destinasi-info_address">Alamat : <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($alamat_wisata); ?>"
                        target="_blank"><?php echo htmlspecialchars($alamat_wisata); ?></a></p>
                  </div>
                </div>
              </div>

            <div class="catalog2">
              <h1 tabindex="0" class="catalog_label">Rekomendasi Kuliner Terdekat</h1>
              <div class="post_detail">
                <h2 tabindex="0" class="destinasi-info_name"><?php echo htmlspecialchars($nama_kuliner); ?></h2>
                <div class="destinasi-img">
                  <?php if ($foto4) { ?>
                      <img class="item_img" src="data:image/jpeg;base64,<?php echo base64_encode($foto4); ?>" alt="Foto 4">
                  <?php } ?>
                  <?php if ($foto5) { ?>
                      <img class="item_img" src="data:image/jpeg;base64,<?php echo base64_encode($foto5); ?>" alt="Foto 5">
                  <?php } ?>
                  <?php if ($foto6) { ?>
                      <img class="item_img" src="data:image/jpeg;base64,<?php echo base64_encode($foto6); ?>" alt="Foto 6">
                  <?php } ?>
                </div>
                <div class="destinasi-info">
                  <p tabindex="0" class="destinasi-info_description"><?php echo htmlspecialchars($deskripsi_kuliner); ?></p>
                  <p tabindex="0" class="destinasi-info_address">Alamat : <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($alamat_kuliner); ?>"
                                            target="_blank"><?php echo htmlspecialchars($alamat_kuliner); ?></a></p>
                </div>
              </div>
            </div>

              <?php
          } else {
              echo "Data tidak ditemukan.";
          }
      } else {
          echo "ID tidak diberikan.";
      }
    ?>

    
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
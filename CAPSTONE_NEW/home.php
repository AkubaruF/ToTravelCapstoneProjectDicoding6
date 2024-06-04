<?php
$koneksi = mysqli_connect("localhost", "root", "", "capstonedb");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$sql = "SELECT id, namawisata, namakuliner, foto1 FROM favorite";
$result = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet"/>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="./style/home.css">
  
  <script src="https://unpkg.com/feather-icons"></script>

  <title>ToTravel</title>
</head>
<body>
  <header class="header">
    <div class="header_title">
      <a href="#" class="navbar-logo">To<span>Travel</span>.</a>
    </div>
    <button id="menu" class="header__menu">☰</button>
    <nav id="drawer" class="nav-list">
      <ul>
        <li class="nav_item"><a href="#home">Beranda</a></li>
        <li class="nav_item"><a href="#favorite">Favorite</a></li>
        <li class="nav_item"><a href="#about">Tentang Kami</a></li>
      </ul>
    </nav>
  </header>

  <div tabindex="0" class="hero" id="home">
    <div class="hero_inner">
      <h1 tabindex="0" class="hero_title">Temukan Tempat Wisata Dan Kuliner Favorite Mu</h1>
      <p tabindex="0" class="hero_tagline">Wisata yang memukau dan kuliner yang menggugah selera menunggu untuk dieksplorasi, 
        temukan favoritmu dan nikmati setiap momen!</p>
      <a href="caritempat.php" class="hero_btncari">Cari Destinasi >></a>
    </div>
  </div>

  <main tabindex="0" id="favorite">
    <div class="catalog">
      <h1 tabindex="0" class="catalog_label">Destinasi Favorite</h1>
      <div class="card">
        <?php
          if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                  $foto = base64_encode($row['foto1']);
                  echo '<div>';
                  echo '<a href="detail_favorite.php?id=' . $row['id'] . '">';
                  echo '<img src="data:image/jpeg;base64,' . $foto . '" alt="Image" />';
                  echo '</a>';
                  echo '<div class="image-text">' . htmlspecialchars($row['namawisata']) . '</div>';
                  echo '</div>';
              }
          } else {
              echo "Tidak ada data.";
          }
          ?>
      </div>
    </div>
  </main>

  <div tabindex="0" class="explore" id="explore">
    <div class="explore-content">
      <h1 tabindex="0" class="explore_title">Pesona Alam Indonesia</h1>
      <p tabindex="0" class="explore_tagline">Temukan Keindahan alam yang tak terduga dan jelajahi pesona alam Indonesia</p>
      <a href="#" class="explore_btn">Selengkapnya...</a>
    </div>
  </div>

  <div class="about" id="about">
    <h1 tabindex="0" class="about_label">Tentang Kami</h1>
    <div class="about-content">
      <div class="about-logo">
        <a href="#" class="travel-logo">To<span>Travel</span>.</a>
      </div>
      <div class="about-des">
        <p><span class="span1">To<span class="span2">Travel</span>.</span> merupakan website yang berisi informasi tentang destinasi wisata dan kuliner di Indonesia. 
        <span class="span1">To<span class="span2">Travel</span>.</span> bertujuan untuk mengatasi kurangnya aksesibilitas informasi 
        tentang destinasi wisata dan kuliner Indonesia yang menghambat pengembangan industri pariwisata dan kuliner. Melalui website ini, 
        diharapkan dapat memfasilitasi aksesibilitas informasi yang lebih luas tentang destinasi wisata dan kuliner Indonesia.
        </p>
      </div>
    </div>

    <div class="about-team">
      <h1 class="team-title">Tim Kami</h1>
      <div class="team-profil">
        <div class="profil1">
            <img class="profil-tim_img" src="./asset/profil-tim.jpg" alt="">
            <p>Farhan</p>
            <p>Front-End</p>
        </div>
        <div class="profil1">
            <img class="profil-tim_img" src="./asset/profil-tim.jpg" alt="">
            <p>Afifah Indah Arini</p>
            <p>Front-End</p>
        </div>
        <div class="profil1">
            <img class="profil-tim_img" src="./asset/profil-tim.jpg" alt="">
            <p>Akbar</p>
            <p>Back-End</p>
        </div>
      </div>
    </div>
  </div>

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
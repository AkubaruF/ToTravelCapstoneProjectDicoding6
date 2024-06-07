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
  <link rel="stylesheet" href="./style/caritempat.css">

  <script src="https://unpkg.com/feather-icons"></script>

  <title>Cari Destinasi</title>
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
        <li class="nav_item"><a href="home.php#about">Tentang Kami</a></li>
      </ul>
    </nav>
  </header>

  <main class="search">
    <section class="content">
      <a href="sumatera.php" class="cta">Pulau Sumatera</a>
      <a href="jawa.php" class="cta">Pulau Jawa</a>
      <a href="bali.php" class="cta">Pulau Bali</a>
      <a href="sulawesi.php" class="cta">Pulau Sulawesi</a>
      <a href="papua.php" class="cta">Pulau Papua</a>
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
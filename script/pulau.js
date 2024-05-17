const navbarNav = document.querySelector(".navbar-nav");
const hamburger = document.querySelector("#hamburger-menu");
hamburger.addEventListener("click", () => {
  navbarNav.classList.toggle("active");
});

document.addEventListener("click", (e) => {
  const isHamburgerClicked = hamburger.contains(e.target);
  const isNavbarNavClicked = navbarNav.contains(e.target);

  if (!isHamburgerClicked && !isNavbarNavClicked) {
    navbarNav.classList.remove("active");
  }
});

document.addEventListener("DOMContentLoaded", function () {
  // Mengambil elemen dropdown dan dropdown list
  const dropdownText = document.querySelector(".dropdown-text");
  const dropdownList = document.querySelector(".dropdown-list");

  // Menambahkan event listener pada dropdown text
  dropdownText.addEventListener("click", function () {
    // Toggle class 'show' pada dropdown list
    dropdownList.classList.toggle("show");
  });

  // Menangani penyembunyian dropdown saat pengguna mengklik di luar dropdown
  document.addEventListener("click", function (event) {
    if (
      !dropdownText.contains(event.target) &&
      !dropdownList.contains(event.target)
    ) {
      // Jika target event bukan bagian dari dropdown atau dropdown text, sembunyikan dropdown
      dropdownList.classList.remove("show");
    }
  });
});

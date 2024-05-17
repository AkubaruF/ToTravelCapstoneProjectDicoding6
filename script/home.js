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

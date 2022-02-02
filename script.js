let navMenu = document.querySelector(".nav-menu")
let navLink = document.querySelector('.nav-link')
let hamburger = document.querySelector('.hamburger')

hamburger.addEventListener("click", function mobileMenu(){
    hamburger.classList.toggle("active");
    navMenu.classList.toggle("active");
})

navLink.forEach(n=>n.addEventListener("click", function closeMenu() {
    hamburger.classList.remove("active")
    navMenu.classList.remove('active')
}))
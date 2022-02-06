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

function btnprint(){
            window.frames["print_frame"].document.body.innerHTML =   
            document.getElementById("table1").innerHTML;
            window.frames["print_frame"].window.focus();
            window.frames["print_frame"].window.print();
        } 
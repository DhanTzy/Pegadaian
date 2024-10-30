const menuIcon = document.getElementById('menu-icon');
const menuList = document.getElementById('menu-list');
const closeBar = document.getElementById('closebar')

menuIcon.addEventListener("click", () => {
    menuList.classList.toggle("hidden");
    // alert("Anda telah mengklik menu icon");
});

closeBar.addEventListener("click", () => {
    menuList.classList.toggle("hidden");
    // alert("Anda telah mengklik menu icon");
});

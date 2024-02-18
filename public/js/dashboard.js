let btn = document.getElementById("btn-menu-toggle");

if(btn) {
    btn.addEventListener("click", () => {
        let menu = document.getElementById("main-sidenav");
        let mainContent = document.getElementById("main-content");
        let mainHeader = document.getElementById("dashboard-header");
    
        menu.classList.toggle("sidenav-collapse");
        mainContent.classList.toggle("content-collapse");
        mainHeader.classList.toggle("content-collapse");
    })
    
}
// HizAuto Shared Navigation
// Include this script on every page after the navbar HTML

(function(){
    // Auth guard - redirect to login if not logged in
    // Comment out below if you don't want auth enforcement
    if(!sessionStorage.getItem("hizauto_logged_in")){
        // Only enforce on non-login pages
        if(!window.location.pathname.endsWith("login.html")){
            window.location.href = "login.html";
        }
    }

    // Highlight active nav link
    const links = document.querySelectorAll(".nav-links a");
    const current = window.location.pathname.split("/").pop();
    links.forEach(link => {
        const href = link.getAttribute("href");
        if(href === current){
            link.classList.add("active");
        }
    });
})();

function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    if (window.innerWidth <= 768) {
        sidebar.classList.toggle("active");
    } else {
        sidebar.classList.toggle("collapsed");
    }
}
window.addEventListener("resize", function () {
    const sidebar = document.getElementById("sidebar");
    if (window.innerWidth > 768) {
        sidebar.classList.remove("active");
    } else {
        sidebar.classList.remove("collapsed");
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const preloader = document.getElementById("preloader");
    const mainContent = document.getElementById("main-content");

    document.querySelectorAll("a[data-preloader]").forEach((link) => {
        link.addEventListener("click", function (event) {
            event.preventDefault();

            mainContent.classList.add("hide");

            setTimeout(() => {
                preloader.style.display = "flex";

                setTimeout(() => {
                    window.location.href = link.href;
                }, 700);
            }, 700);
        });
    });

    window.addEventListener("load", function () {
        preloader.style.display = "none";
        mainContent.classList.add("show");
    });
});

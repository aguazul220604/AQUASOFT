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

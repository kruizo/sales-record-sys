document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("spinner").classList.toggle("hidden");
    const sidebarLinks = document.querySelectorAll(".sidebar-link");
    loadContent("dashboard");
    sidebarLinks.forEach((link) => {
        link.addEventListener("click", function (event) {
            event.preventDefault();
            sidebarLinks.forEach(function (innerLink) {
                innerLink.classList.remove("active");
            });
            link.classList.add("active");
            const section = this.dataset.section;
            loadContent(section);
        });
    });
});

function loadContent(section) {
    fetch(`${section}`)
        .then((response) => response.text())
        .then((html) => {
            document.getElementById("main-content").innerHTML = html;
        })
        .catch((error) => console.error("Error loading content:", error));
}

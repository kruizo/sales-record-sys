document.addEventListener("DOMContentLoaded", function () {
    console.log("asd");
    const sidebarLinks = document.querySelectorAll(".sidebar-link");
    const currentUrl = window.location.href;
    sidebarLinks.forEach((link) => {
        if (link.href === currentUrl) {
            link.classList.add("active");
        }
        link.addEventListener("click", function (event) {
            sidebarLinks.forEach(function (innerLink) {
                innerLink.classList.remove("active");
            });
            return true;
        });
    });

    var searchInput = document.querySelector("#table-search");

    searchInput.addEventListener("input", function (event) {
        var searchTerm = searchInput.value.trim().toLowerCase();
        var rows = document.querySelectorAll("tbody tr");
        rows.forEach(function (row) {
            var textContent = row.textContent.toLowerCase();
            if (textContent.includes(searchTerm)) {
                row.style.display = ""; // Show the row
            } else {
                row.style.display = "none"; // Hide the row
            }
        });
    });
});

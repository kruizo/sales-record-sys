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

    const checkboxAll = document.getElementById('checkbox-all-search');
    const checkboxes = document.querySelectorAll('.checkbox');

    checkboxAll.addEventListener('change', function() {
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = checkboxAll.checked;
        });
    });

    // const filterCheckboxes = document.querySelectorAll('.category-checkbox');

    // filterCheckboxes.forEach(checkbox => {
    //     checkbox.addEventListener('change', function () {
    //         const selectedCategories = [...document.querySelectorAll('.category-checkbox:checked')].map(checkbox => checkbox.value);
            
    //         const rows = document.querySelectorAll('#dataTable tbody tr');

    //         rows.forEach(row => {
    //             let shouldShow = true;

    //             selectedCategories.forEach(category => {
    //                 if (!row.classList.contains(category)) {
    //                     shouldShow = false;
    //                 }
    //             });

    //             if (shouldShow) {
    //                 row.style.display = '';
    //             } else {
    //                 row.style.display = 'none';
    //             }
    //         });
    //     });
    // });


    const rowRange = document.getElementById('minmax-range');
    const maxRow = document.getElementById('maxrow');

    rowRange.addEventListener('input', function() {
        maxRow.textContent = rowRange.value;
    });


    var searchInput = document.querySelector("#table-search");

    searchInput.addEventListener("input", function (event) {
        var searchTerm = searchInput.value.trim().toLowerCase();
        var rows = document.querySelectorAll("tbody tr");
        rows.forEach(function (row) {
            var textContent = row.textContent.toLowerCase();
            if (textContent.includes(searchTerm)) {
                row.style.display = ""; 
            } else {
                row.style.display = "none";
            }
        });
    });
});

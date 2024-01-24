document.addEventListener("DOMContentLoaded", function() {
    var navbar = document.getElementById("navbar");

    window.addEventListener("scroll", function() {
        var scrollPercentage = (window.scrollY / (document.body.scrollHeight - window.innerHeight)) * 100;

        var gradientColor = "linear-gradient(to bottom, rgba(3, 7, 18, 0.95) " + scrollPercentage * 10 + "%, transparent)";
        navbar.style.background = gradientColor;
    });

    $('.nav-link').on('click', function() {
        // Remove the active class from all links
        $('.nav-link').removeClass('bg-blue-700');
        
        // Add the active class to the clicked link
        $(this).addClass('bg-blue-700');
    });
});
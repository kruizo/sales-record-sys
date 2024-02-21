document.addEventListener("DOMContentLoaded", function () {
    var navbar = document.getElementById("navbar");
    if (window.scrollY > 0) {
        navbar.style.background = "rgba(3, 7, 18, 0.70)";
    }

    window.addEventListener("scroll", function () {
        var scrollPercentage =
            (window.scrollY /
                (document.body.scrollHeight - window.innerHeight)) *
            100;

        var gradientColor =
            "linear-gradient(to bottom, rgba(3, 7,18, 0.70) " +
            scrollPercentage * 10 +
            "%, transparent)";
        navbar.style.background = gradientColor;
    });
});

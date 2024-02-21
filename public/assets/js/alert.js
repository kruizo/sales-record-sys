setTimeout(function () {
    var toasts = document.querySelectorAll("#toast-simple");
    toasts.forEach(function (toast) {
        toast.style.display = "none";
    });
}, 3000);

setTimeout(function () {
    var toasts = document.querySelectorAll("#toast-simple");
    toasts.forEach(function (toast) {
        toast.remove();
    });
    var success = document.querySelectorAll("#success-modal");
    success.forEach(function (success) {
        success.remove();
    });
}, 3000);

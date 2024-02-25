setTimeout(function () {
    var toasts = document.querySelectorAll("#toast-simple");
    toasts.forEach(function (toast) {
        toast.remove();
    });
}, 3000);

setTimeout(function () {
    var success = document.querySelectorAll("#success-modal");
    success.forEach(function (success) {
        success.remove();
    });
}, 1000);

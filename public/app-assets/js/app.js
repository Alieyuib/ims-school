$(document).ready(function () {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });
    $("#loginBtn").on("click", function (e) {
        e.preventDefault();
        var formData = {
            title: $("#username").val(),
            description: $("#password").val(),
        };
        if (formData["title"] == "" && formData["description" == ""]) {
            Toast.fire({
                icon: "error",
                title: "Username/Password fields require",
            });
        } else {
            Toast.fire({
                icon: "success",
                title: "Signed in successfully",
            });
        }
    });
});

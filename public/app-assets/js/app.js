$(document).ready(function () {
    $("#loginBtn").on("click", function (e) {
        e.preventDefault();
        var formData = {
            title: $("#username").val(),
            description: $("#password").val(),
        };
        Swal.fire({
            title: "Button Pressed!",
            text: "Text Body",
            icon: "success",
            confirmButtonText: "Cool",
        });
    });
});

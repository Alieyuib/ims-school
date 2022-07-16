$(document).ready(function () {
    const Toast = Swal.mixin({
        toast: true,
        position: "top",
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
        if ($("#username").val() == "" && $("#password").val() == "") {
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
    $("#forget-password-link").on("click", function (e) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        e.preventDefault();
        var formData = {
            username: $("#username").val(),
            password: $("#password").val(),
        };
        $.ajax({
            type: "POST",
            url: "{{ url('/add-user') }}",
            data: formData,
            dataType: "json",
            success: function (data) {
                console.log(data);
            },
            error: function (data) {
                console.log(data);
            },
        });
    });
    $('#result-table').dataTable({
        paging: false,
        ordering: false,
        info: false,
        searching: false
      })
});

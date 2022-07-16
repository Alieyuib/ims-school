function showError(field, message) {
    if (!message) {
        $("#" + field)
            .addClass("is-vald")
            .removeClass("is-invalid")
            .siblings(".invalid-feedback")
            .text("");
    } else {
        $("#" + field)
            .addClass("is-invalid")
            .removeClass("is-valid")
            .siblings(".invalid-feedback")
            .text(message);
    }
}

function removeValidClasses(form) {
    $(form).each(function () {
        $(form).find(":input").removeClass("is-valid is-invalid");
    });
}

function showMessage(type, message) {
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
    return Toast.fire({
        icon: type,
        title: message,
    });
}

// function showMessage(type, message) {
//     return `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
//   <strong>${message}</strong>
//   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
// </div>`;
// }

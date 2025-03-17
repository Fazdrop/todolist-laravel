document.addEventListener("DOMContentLoaded", function () {
    // ✅ Menyembunyikan error saat user mulai mengetik atau mendapatkan fokus
    document.querySelectorAll("input").forEach((input) => {
        input.addEventListener("input", function () {
            hideError(input.id + "Error");
        });

        input.addEventListener("focus", function () {
            hideError(input.id + "Error");
        });
    });
});

// ✅ Fungsi untuk menyembunyikan error secara eksplisit
function hideError(errorId) {
    let errorElement = document.getElementById(errorId);
    if (errorElement) {
        errorElement.style.display = "none";
    }
}

// ✅ Fungsi untuk toggle password visibility
function togglePassword(inputId, iconId) {
    let password = document.getElementById(inputId);
    let icon = document.getElementById(iconId);

    if (password.type === "password") {
        password.type = "text";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
    } else {
        password.type = "password";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
    }
}

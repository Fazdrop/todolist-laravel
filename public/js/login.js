function togglePassword(inputId, iconId) {
        var password = document.getElementById(inputId);
        var icon = document.getElementById(iconId);

        if (password.type === 'password') {
            password.type = 'text';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }else{
            password.type = 'password';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        }
}

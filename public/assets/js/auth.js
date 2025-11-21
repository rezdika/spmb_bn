// Password Toggle Function
function togglePassword(fieldId = 'password') {
    const passwordInput = document.getElementById(fieldId);
    let toggleIcon;
    
    if (fieldId === 'password') {
        toggleIcon = document.getElementById('toggleIcon') || document.getElementById('toggleIcon1');
    } else if (fieldId === 'password_confirmation') {
        toggleIcon = document.getElementById('toggleIcon2');
    }
    
    if (passwordInput && toggleIcon) {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
}

// Auto hide alerts after 5 seconds
setTimeout(function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        alert.style.transition = 'opacity 0.5s';
        alert.style.opacity = '0';
        setTimeout(function() {
            alert.remove();
        }, 500);
    });
}, 5000);

// Add interactive effects
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            if (this.parentElement.classList.contains('input-group')) {
                this.parentElement.style.transform = 'translateY(-2px)';
            }
        });
        input.addEventListener('blur', function() {
            if (this.parentElement.classList.contains('input-group')) {
                this.parentElement.style.transform = 'translateY(0)';
            }
        });
    });
});
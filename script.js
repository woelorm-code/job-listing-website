document.addEventListener('DOMContentLoaded', () => {
    const yearElement = document.getElementById('year');
    if (yearElement) {
        yearElement.textContent = new Date().getFullYear();
    }

    const menuToggle = document.querySelector('.menu-toggle');
    const mainNav = document.querySelector('.main-nav');

    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', () => {
            mainNav.classList.toggle('open');
        });
    }

    const signupForm = document.querySelector('form[action="signup.php"]');
    if (signupForm) {
        signupForm.addEventListener('submit', (event) => {
            const password = signupForm.querySelector('input[name="password"]');
            const confirmPassword = signupForm.querySelector('input[name="confirm_password"]');
            const fileCv = signupForm.querySelector('input[name="cv"]');
            const filePicture = signupForm.querySelector('input[name="profile_picture"]');

            if (password && confirmPassword && password.value !== confirmPassword.value) {
                event.preventDefault();
                alert('Passwords do not match. Please re-enter both password fields.');
                return;
            }

            if (fileCv && !fileCv.value) {
                event.preventDefault();
                alert('Please upload your CV.');
                return;
            }

            if (filePicture && !filePicture.value) {
                event.preventDefault();
                alert('Please upload your profile picture.');
                return;
            }
        });
    }
});

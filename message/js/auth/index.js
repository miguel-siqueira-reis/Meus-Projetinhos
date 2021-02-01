const login = document.querySelector('.login');
const register = document.querySelector('.register');
login.addEventListener('submit', (e) => {
    e.preventDefault();
    const url = "process/login.php";
    const formData = new FormData(login.querySelector('#login'));
    servicePost(url, formData);
})

register.addEventListener('submit', (e) => {
    e.preventDefault();
    const url = "process/registration.php";
    const formData = new FormData(register.querySelector('#register'));
    servicePost(url, formData);
})

function servicePost(url, formData) {
    fadeIn(false,'#loading');
    fetch(url, {
        method: "POST",
        body: formData
    }).then(response => {
        if (!response.ok) {
            console.log(response)
            Swal.fire({
                title: "Oops!",
                text: response.statusText,
                icon: 'error',
                confirmButtonText: "Try again"
            })
            return;
        }
        window.location.href = "/index.php";
    }).then(e => fadeIn('#loading', false));

}
let form = document.querySelector('.form');
let inputs = document.querySelectorAll("[required]");
form.addEventListener('submit', e => e.preventDefault());
inputs.forEach(input => {
    input.addEventListener('invalid', validateInput)
    input.addEventListener('blur', validateInput)
})

function validateInput(event) {
    event.preventDefault();
    field = event.target;
    const error = validateErrors(field);
    aboutError(error, field);
}

function validateErrors(field) {
    findError = false;

    for(let error in field.validity) {
        if (field.validity[error] && !field.validity.valid) {
            findError = 'Campo invalido';    
        }
    }

    if (field.value.length < 6 && field.value.length > 0 && field.classList.contains('pass')) {
        findError = 'A senha não pode ser menor que 6 e maior que 30 caracteres';
    }

    return findError;
}

function aboutError(error, field) {
    let spanError = field.parentNode.querySelector('.error');
    if (error) {
        spanError.innerHTML = error;
        spanError.classList.add('isValid');
    } else {
        spanError.innerHTML = '';
        spanError.classList.remove('isValid');
    }
}
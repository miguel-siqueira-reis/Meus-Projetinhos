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
            findError = error;    
        }
    }

    return findError;
}

function aboutError(error, field) {
    let spanError = field.parentNode.querySelector('.error');
    if (error) {
        spanError.innerHTML = 'Campo invalido!!';
        spanError.classList.add('isValid');
    } else {
        spanError.innerHTML = '';
        spanError.classList.remove('isValid');
    }
}
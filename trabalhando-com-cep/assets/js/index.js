import { CepController } from './CepController.js';

const button = document.querySelector('.form__btn');
const input = document.querySelector('.input-cep');
const buttonSubmit = document.querySelector('.btn-submit');
const cepController = new CepController(input, button, buttonSubmit);
input.addEventListener('keyup', cepController.mapValues.bind(cepController))
button.addEventListener('click', cepController.import.bind(cepController));
buttonSubmit.addEventListener('click', cepController.clickValid.bind(cepController));
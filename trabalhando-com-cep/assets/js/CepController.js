import { Service } from './Service.js';
import { Mensagem } from './Mensagem.js';

export class CepController {
    constructor(input, button , buttonSubmit) {
        this.service = new Service();
        this.main = document.querySelector('.container');
        this.inputCep = input;
        this.btn = button;
        this.mensagem = this.main.querySelector('#error')
        this.btnSubmit = buttonSubmit;
        this.inputCidade = this.main.querySelector('#input-cidade');
        this.inputEstado = this.main.querySelector("#input-estado");
        this.inputBairro = this.main.querySelector('#input-bairro');
        this.inputRua = this.main.querySelector('#input-rua');
        this.activeButton = false;
        this.activeButtonSubmit = false;
    }

    import(e) {
        e.preventDefault();
        if (!this.activeButton) return;
        const cep = this.inputCep.value.replace('-', '');
        this.service.get(cep)
        .then(this.showCep.bind(this));
    }

    mapValues(e) {
        const numCep = this.inputCep.value.replace(/\D/g, "").split('');
        if (numCep[7]) {
            this.activeButton = true;
            this.btn.classList.add('active');
        } else {
            this.activeButton = false;
            this.btn.classList.remove('active')
            this.btnSubmit.classList.remove('active')
        }
        if (numCep[7]) return;
        const maskCep = "     -   ".split('');
        const cursor = this.inputCep.selectionStart;
        numCep.forEach(value => {
            maskCep.splice(maskCep.indexOf(" "), 1, value);
        });

        if (this.inputCep.value.replace(/\s/g, '').replace('-', '').length >= 5) {
            this.inputCep.value = maskCep.join('');
    
            if(e.key != "ArrowLeft" && cursor == 5) {
                this.inputCep.setSelectionRange(cursor+1, cursor+1);
            } else {
                this.inputCep.setSelectionRange(cursor, cursor);
            }
        } else {
            this.inputCep.value = numCep.join('');
            this.inputCep.setSelectionRange(cursor, cursor);
        }
    }


    showCep(cep) {
        if(cep.city == undefined) {
            this.mensagem.innerHTML = cep.errors[0].message;
            return;
        }
        this.inputCidade.value = cep.city;
        this.inputEstado.value = cep.state;
        this.inputBairro.value = cep.neighborhood;
        this.inputRua.value = cep.street;
        this.mensagem.innerHTML = '';
        this.btnSubmit.classList.add('active');
    }

    clickValid(e) {
        if (!this.btnSubmit.classList.contains('active')) e.preventDefault();
    }
}
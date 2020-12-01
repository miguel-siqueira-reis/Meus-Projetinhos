import { ListTags } from './ListTags.js'
export class TagsController {
    constructor() {
        this.divTag = document.querySelector('.container-input');
        this.input = this.divTag.querySelector('.input-tag');
        this.listTags = new ListTags();
        this.ul = this.divTag.querySelector('.list-tags');
        this.init();
    }

    init() {
        this.input.addEventListener('keyup', this.listener.bind(this));
        const i = this.divTag.querySelectorAll('.close');

        if(i) {
            i.forEach(i => {
                i.addEventListener('click', this.removeTag.bind(this));
            })
        }

    }

    listener(e) {
        // console.log(e.key);
        switch (e.key) {
            case "Enter":
                this.addTag(e, "Enter");
                break;
            case ",":
                this.addTag(e, ",");
                break;
            case " ":
                this.addTag(e, " ");
                break;
        }
    }

    addTag(e, keySpecial) {
        const inputValue = e.target.value;
        const value = this.validaText(inputValue, keySpecial);
        this.listTags.add(value);
        this.showTags();
        this.clear();
    }

    validaText(value, keySpecial) {
        value = value.trim().replace(keySpecial, '');
        return value;
    }

    showTags() {
        if (!this.ul) {
            this.ul = document.createElement('ul');
            this.ul.classList.add('list-tags');
            this.divTag.prepend(this.ul);
        }
        this.ul.innerHTML = '';
        this.listTags.list.forEach(value => {
            if (!value) return;
            let i = document.createElement('i');
            i.setAttribute('data-value', value);
            i.classList.add('close');
            let li = document.createElement('li');
            li.innerHTML = value;
            li.appendChild(i);
            this.ul.appendChild(li);
        })
        this.init();
    }


    removeTag(e) {
        this.listTags.remove(e.target.dataset.value);
        this.showTags();
    }

    clear() {
        this.input.value='';
    }

}
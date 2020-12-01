export class ListTags {
    constructor() {
        this._listTags = [];
    }

    add(value) {
        this._listTags.push(value);
    }

    get list() {
        return this._listTags;
    }

    remove(value) {
        this._listTags.splice(this._listTags.indexOf(value), 1);
    }

}
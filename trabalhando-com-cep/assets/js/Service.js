import { Cep } from './Cep.js';
export class Service {

    get(Urlcep) {
        return fetch(`https://brasilapi.com.br/api/cep/v1/${Urlcep}`)
            .then(res => res.json())
            .then(cep => {
                if (cep.cep === undefined && cep.errors[0].message) {
                    return cep;
                }
                return new Cep(cep.cep, cep.state, cep.city, cep.neighborhood, cep.street)
            })
    }
}



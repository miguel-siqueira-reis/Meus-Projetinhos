export class Service {
    get(url, messageError) {
        return fetch(url).then(response => {
            if (!response.ok) {
                return messageError(response);
            }

            return response;
        }).catch(messageError)
    }

    post(url, formData, messageError) {
        return fetch(url, {
            method: "POST",
            body: formData
        }).then(response => {
            if (!response.ok) {
                return messageError(response);
            }

            return response;
        }).catch(messageError)
    }
}
import { Service } from '../helpers/Service.js';

export class Profile {
    constructor(id, profileContainer) {
        this._profileContainer = profileContainer;
        this.id = id;
        this.Service = new Service();
    }

    loadProfile() {
        const url = `process/profile.php?id=${this.id}`;
        this.Service.get(url, () => {
            Swal.fire({
                title: "Error!",
                text: response.statusText,
                icon: 'error',
                confirmButtonText: "Ok"
            })
        }).then(response => response.json()).then(data => {
            if (data.profileRegister == true) {
                const template = `
                    <form action='' method='post' id='upLoadPic'>
                        <input type='file' accept='.jpg, .jpeg, .png' name='imgInp' id='imgInp' hidden>
                        <div class='pictureContainer'>
                            <img src='profilePics/${data.user_picture}' alt='image from user' id='userImg'>
                            <label for='imgInp'></label>
                        </div>
                    </form>
                    <p class='name'>${data.username}</p>
                    <p class='row'>Online ${data.user_online}</p>
                    <p class='row'>Membro desde ${data.user_creation}</p>
                    `;
                this._profileContainer.innerHTML = template;
                
                $('#imgInp').addEventListener('change',(e) => {
                    this._previewUpload(e.target);
                }, false)
            } else {
                const template = `
                    <div class='pictureContainer'>
                        <img src='profilePics/${data.user_picture}' alt='picture from user' id='userImg'>
                    </div>
                    <p class='name'>${data.username}</p>
                    <p class='row'>Online ${data.user_online}</p>
                    <p class='row'>Membro desde ${data.user_creation}</p>"
                `;
            }
        })
    }

    _previewUpload(input) {
        if(input.files && input.files[0]) {
            const reader = new FileReader();
            reader.addEventListener('load', (event) => {
                $('#userImg').src = event.target.result;
                const formData = new FormData($('#upLoadPic'))
                fetch('process/updateProfile.php', {
                    method: 'POST',
                    body: formData
                }).then(response => {
                    if (!response.ok) {
                        console.log(response)
                        Swal.fire({
                            title: 'image no change!',
                            text: response.statusText,
                            icon: 'error',
                            confirmButtonText: 'Try again'
                        })
                        return;
                    }
                })
            }, false)
            reader.readAsDataURL(input.files[0]);
        }
    }
}
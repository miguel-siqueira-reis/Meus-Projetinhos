import { Profile } from './Profile.js';

const profile = new Profile(0 ,$('#profile .container'))

readyDom(() => {
    setInterval(() => {
        loadInbox();
    }, 3000);
    profile.loadProfile();
    chat();
})
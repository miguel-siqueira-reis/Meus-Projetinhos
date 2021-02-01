var $ = document.querySelector.bind(document);

const readyDom = (ready) => { //index
    if (document.readyState != 'loading') return ready();
    document.addEventListener('DOMContentLoaded', ready);
    function _ready() {
        document.removeEventListener('DOMContentLoaded', ready)
        ready();
    }
}


function fadeIn(IdDisappear, IdAppreciate) {
    if (IdDisappear !== null && IdDisappear !== false) {
        const disappear = document.querySelector(IdDisappear);
        disappear.style.display = "none";
    }
    if (IdAppreciate !== null && IdAppreciate !== false) {
        const appreciate = document.querySelector(IdAppreciate);
        appreciate.style.display = "block";
    }
}

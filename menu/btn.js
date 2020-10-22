const btn_open = document.querySelector('.btn-open');
const btn_close = document.querySelector('.btn-close');
const menu = document.querySelector('.menu');

btn_open.addEventListener('click',function() {
	menu.classList.add('active')
	btn_open.classList.add('active')
	btn_close.classList.add('active')
})

btn_close.addEventListener('click',function() {
	menu.classList.remove('active')
	btn_open.classList.remove('active')
	btn_close.classList.remove('active')
})
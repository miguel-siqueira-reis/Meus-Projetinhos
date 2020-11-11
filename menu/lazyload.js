
const container = document.querySelector("div.container");
const header = document.querySelector(".cab");
const int = document.querySelector(".int");
const links = document.querySelectorAll('.link');
let load = false;
window.addEventListener("scroll", function(){

	//throttle
	if (load) return;
	load = true;
	setTimeout(function () { 
		load = false;
	}, 200);

	links.forEach(link => {
		if (int.getBoundingClientRect().bottom < 50) {
			header.classList.add("mudou_color");
			container.classList.add("mudou");
			link.classList.add("linkchange");
			return;
		}
		header.classList.remove("mudou_color");
		container.classList.remove("mudou");
		link.classList.remove("linkchange");
	})

})	
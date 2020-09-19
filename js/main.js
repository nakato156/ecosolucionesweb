
//   AOS.init();

let enlaces = document.querySelectorAll(".Menu")[0]
let menuI = true;

document.querySelectorAll(".hamb")[0].addEventListener("click", function(){
	if (menuI) {
		document.querySelectorAll(".hamb")[0].style.color ="#fff"
		menuI=false
	}else{
		document.querySelectorAll(".hamb")[0].style.color ="#000"
		menuI=true
	}
	enlaces.classList.toggle("menudos")
})

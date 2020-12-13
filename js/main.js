
//   AOS.init();

let enlaces = document.querySelectorAll(".cat")[0]
let menuI = true;
// let submenu = document.querySelector(".sub");
document.querySelectorAll(".hamb")[0].addEventListener("click", function(){
	if (menuI) {
		document.querySelectorAll(".hamb")[0].style.color ="#fff"
		menuI=false
	}else{
		document.querySelectorAll(".hamb")[0].style.color ="#000"
		menuI=true
	}
	// enlaces.style.height=screen.height**2+"px";
	enlaces.classList.toggle("menudos")
	// enlaces.classList.toggle("cat")
})
$(".sub").click(function(){
	$(this).children("ul").slideToggle();
});

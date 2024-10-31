function nbtech_woomenu_show(element) {
	element.classList.toggle("nbtech-woomenu-mobiletitle-active");
	var nbtech_woomenu = document.getElementById("nbtech-woomenu");
	if (nbtech_woomenu.className === "nbtech-woomenu") {
		nbtech_woomenu.className += " responsive";
	}else{
		nbtech_woomenu.className = "nbtech-woomenu";
		var submenus = document.getElementsByClassName('nbtech-woomenusub');
		for (var i = 0; i < submenus.length; i++) {
			submenus[i].style.display = "none";
		}
	}
}
function nbtech_woomenu_parent_click(element){
	var submenu = element.nextElementSibling;
	if (submenu.style.display === "grid") {
		submenu.style.display = "none";
	}else{
		submenu.style.display = "grid";
		}
}

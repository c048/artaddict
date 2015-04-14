window.onload = heightSetter; 
window.onresize = heightSetter;

function heightSetter() 
{ 
	pageHeight = getDocHeight() + "px";
	var cMainNav = document.getElementById('c_wrapper')
	cMainNav.style.height = pageHeight;
}

function getDocHeight() {
    var D = document;
    return Math.max(
        D.body.scrollHeight, D.documentElement.scrollHeight,
        D.body.offsetHeight, D.documentElement.offsetHeight,
        D.body.clientHeight, D.documentElement.clientHeight
    );
}
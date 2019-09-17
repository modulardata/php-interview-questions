window.addEventListener?window.addEventListener("load",so_init,false):window.attachEvent("onload",so_init);
window.addEventListener?window.addEventListener("load",so_init1,false):window.attachEvent("onload",so_init1);
window.addEventListener?window.addEventListener("load",so_init2,false):window.attachEvent("onload",so_init2);


var d=document, imgs = new Array(), zInterval = null, current=0, pause=false;
var zInterval1 = null, current1=0, pause1=false,imgs1 = new Array();
var zInterval2 = null, current2=0, pause2=false,imgs2 = new Array();
var zInterval3 = null, current3=0, pause3=false,imgs3 = new Array();

function so_init() {
	if(!d.getElementById || !d.createElement)return;

	
	css = d.createElement("link");
	//css.setAttribute("href","xfade2.css");
	//css.setAttribute("rel","stylesheet");
	//css.setAttribute("type","text/css");
	d.getElementsByTagName("head")[0].appendChild(css);

	imgs = d.getElementById("imageContainer").getElementsByTagName("img");
	for(i=1;i<imgs.length;i++) imgs[i].xOpacity = 0;
	imgs[0].style.display = "block";
	imgs[0].xOpacity = .99;
	
	setTimeout(so_xfade,4000);
}
function so_init1() {
	if(!d.getElementById || !d.createElement)return;

	
	css = d.createElement("link");
	//css.setAttribute("href","xfade2.css");
	//css.setAttribute("rel","stylesheet");
	//css.setAttribute("type","text/css");
	d.getElementsByTagName("head")[0].appendChild(css);

	imgs1 = d.getElementById("imageContainerRight1").getElementsByTagName("img");
	for(i=1;i<imgs1.length;i++) imgs1[i].xOpacity = 0;
	imgs1[0].style.display = "block";
	imgs1[0].xOpacity = .99;
	
	setTimeout(so_xfade1,4000);
}
function so_init2() {
	if(!d.getElementById || !d.createElement)return;

	
	css = d.createElement("link");
	//css.setAttribute("href","xfade2.css");
	//css.setAttribute("rel","stylesheet");
	//css.setAttribute("type","text/css");
	d.getElementsByTagName("head")[0].appendChild(css);

	imgs2 = d.getElementById("imageContainerRight2").getElementsByTagName("img");
	for(i=1;i<imgs2.length;i++) imgs2[i].xOpacity = 0;
	imgs2[0].style.display = "block";
	imgs2[0].xOpacity = .99;
	
	setTimeout(so_xfade2,3000);
}
function so_init3() {
	if(!d.getElementById || !d.createElement)return;

	
	css = d.createElement("link");
	//css.setAttribute("href","xfade2.css");
	//css.setAttribute("rel","stylesheet");
	//css.setAttribute("type","text/css");
	d.getElementsByTagName("head")[0].appendChild(css);

	imgs3 = d.getElementById("imageContainerRight3").getElementsByTagName("img");
	for(i=1;i<imgs3.length;i++) imgs3[i].xOpacity = 0;
	imgs3[0].style.display = "block";
	imgs3[0].xOpacity = .99;
	
	setTimeout(so_xfade3,3000);
}
function so_xfade() {
	cOpacity = imgs[current].xOpacity;
	nIndex = imgs[current+1]?current+1:0;

	nOpacity = imgs[nIndex].xOpacity;
	
	cOpacity-=.05; 
	nOpacity+=.05;
	
	imgs[nIndex].style.display = "block";
	imgs[current].xOpacity = cOpacity;
	imgs[nIndex].xOpacity = nOpacity;
	
	setOpacity(imgs[current]); 
	setOpacity(imgs[nIndex]);
	
	if(cOpacity<=0) {
		imgs[current].style.display = "none";
		current = nIndex;
		setTimeout(so_xfade,4000);
	} else {
		setTimeout(so_xfade,50);
	}
	
	function setOpacity(obj) {
		if(obj.xOpacity>.99) {
			obj.xOpacity = .99;
			return;
		}
		obj.style.opacity = obj.xOpacity;
		obj.style.MozOpacity = obj.xOpacity;
		obj.style.filter = "alpha(opacity=" + (obj.xOpacity*100) + ")";
	}
	
}

function so_xfade1() 
{
	cOpacity1 = imgs1[current1].xOpacity;
	nIndex1 = imgs1[current1+1]?current1+1:0;

	nOpacity1 = imgs1[nIndex1].xOpacity;
	
	cOpacity1-=.05; 
	nOpacity1+=.05;
	
	imgs1[nIndex1].style.display = "block";
	imgs1[current1].xOpacity = cOpacity1;
	imgs1[nIndex1].xOpacity = nOpacity1;
	
	setOpacity(imgs1[current1]); 
	setOpacity(imgs1[nIndex1]);
	
	if(cOpacity1<=0) 
	{
		imgs1[current1].style.display = "none";
		current1 = nIndex1;
		setTimeout(so_xfade1,4000);
	} else {
		setTimeout(so_xfade1,50);
}
	
	function setOpacity(obj) {
		if(obj.xOpacity>.99) {
			obj.xOpacity = .99;
			return;
		}
		obj.style.opacity = obj.xOpacity;
		obj.style.MozOpacity = obj.xOpacity;
		obj.style.filter = "alpha(opacity=" + (obj.xOpacity*100) + ")";
	}
	
}

function so_xfade2() 
{
	cOpacity2 = imgs2[current2].xOpacity;
	nIndex2 = imgs2[current2+1]?current2+1:0;

	nOpacity2 = imgs2[nIndex2].xOpacity;
	
	cOpacity2-=.05; 
	nOpacity2+=.05;
	
	imgs2[nIndex2].style.display = "block";
	imgs2[current2].xOpacity = cOpacity2;
	imgs2[nIndex2].xOpacity = nOpacity2;
	
	setOpacity(imgs2[current2]); 
	setOpacity(imgs2[nIndex2]);
	
	if(cOpacity2<=0) 
	{
		imgs2[current2].style.display = "none";
		current2 = nIndex2;
		setTimeout(so_xfade2,4000);
	} else {
		setTimeout(so_xfade2,50);
}
	
	function setOpacity(obj) {
		if(obj.xOpacity>.99) {
			obj.xOpacity = .99;
			return;
		}
		obj.style.opacity = obj.xOpacity;
		obj.style.MozOpacity = obj.xOpacity;
		obj.style.filter = "alpha(opacity=" + (obj.xOpacity*100) + ")";
	}
	
}

function so_xfade3() 
{
	cOpacity3 = imgs3[current3].xOpacity;
	nIndex3 = imgs3[current3+1]?current2+1:0;

	nOpacity3 = imgs3[nIndex3].xOpacity;
	
	cOpacity3-=.05; 
	nOpacity3+=.05;
	
	imgs3[nIndex3].style.display = "block";
	imgs3[current3].xOpacity = cOpacity3;
	imgs3[nIndex3].xOpacity = nOpacity3;
	
	setOpacity(imgs3[current3]); 
	setOpacity(imgs3[nIndex3]);
	
	if(cOpacity3<=0) 
	{
		imgs3[current3].style.display = "none";
		current3 = nIndex3;
		setTimeout(so_xfade3,4000);
	} else {
		setTimeout(so_xfade3,50);
}
	
	function setOpacity(obj) {
		if(obj.xOpacity>.99) {
			obj.xOpacity = .99;
			return;
		}
		obj.style.opacity = obj.xOpacity;
		obj.style.MozOpacity = obj.xOpacity;
		obj.style.filter = "alpha(opacity=" + (obj.xOpacity*100) + ")";
	}
	
}
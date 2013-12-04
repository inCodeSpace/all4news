var step = 2000;
	//Начальное условие - скрыть элемент
var urlBox = document.getElementById("urlBox");
var myPanel = document.getElementById("panel");
var myPanTit = document.getElementById("panel_title");
myPanel.style.display = "none";
//----------2)Ф-ия Разворачивания панели-------------//
function expandPanel() { 
	if (myPanel.clientHeight < myPanel.originalHeight - step) {
		var h = myPanel.clientHeight + step;
		myPanel.style.height = h+"px";
		setTimeout("expandPanel()", 70);		
	} else {
		myPanel.style.height = "";
		var myPanTit = document.getElementById("panel_title");
		myPanTit.firstChild.nodeValue = "Свернуть";
	}
}
//----------3)Ф-ия Сворачивания панели-------------//
function collapsePanel() {
	if(myPanel.clientHeight >= step) {
		var h = myPanel.clientHeight - step;
		myPanel.style.height = h+"px";
		setTimeout("collapsePanel()", 70);
	}else {
		myPanel.style.display = "none";
		var myPanTit = document.getElementById("panel_title");
		myPanTit.firstChild.nodeValue = "Развернуть";
	}
}
//----------1)Ф-ия Начального запуска-------------//
function changePanel() {
	/* 1) Условие для свор/разв панели
	 В свойсте height пустая строка (что означает что панель полностью развернута),
	 либо display стоит знач. "none", тогда означает что она скрыта
	 [т.е. это условие для случая когда не идет сворач. и разворач.]
		*/
	if( !myPanel.style.height || (myPanel.style.display == "none") ) {
		if(myPanel.style.display == "none") {
			if( urlBox != null ) { //если он существует
				urlBox.style.display = "none"; //спрятать контент с URLs
			}
			myPanel.style.display = "block"; // или просто ="" (отобразим панель)			
			expandPanel(); //запустим ф-ию разворачивания панели
			myPanTit.firstChild.nodeValue = "Свернуть";
		} else {
			myPanel.originalHeight = myPanel.clientHeight;
			if( urlBox != null ) { //если он существует
				urlBox.style.display = "block"; //спрятать контент с URLs
			}
			collapsePanel();
		}
	}
}
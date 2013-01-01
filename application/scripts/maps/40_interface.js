function Interface(){
	this.map = MCore.map;

	var homeControlDiv = document.createElement('div');
	this.createMarkerPanel(homeControlDiv, this.map);

	homeControlDiv.index = 1;
	this.map.controls[google.maps.ControlPosition.TOP_RIGHT].push(homeControlDiv);


	controlDiv.style.padding = '5px';
	var controlUI = document.createElement('div');
	controlUI.style.cursor = 'pointer';
	controlUI.title = 'Kliknij aby dodać nowe miejsce';
	controlDiv.appendChild(controlUI);

	var controlText = document.createElement('div');
	controlText.className = "gbutton";

	controlText.innerHTML = '<b>Dodaj budynek</b>';
	controlUI.appendChild(controlText);
	var th = this;
	google.maps.event.addDomListener(controlUI, 'click', function(){
		th.buildier.newBuilding();
	});
}

Interface.prototype.initAdminPanel = function(){
	var admDiv = document.createElement('div');
	var addBtn = document.createElement('div');
	admDiv.appendChild(addBtn);
}

Interface.prototype.initFilterPanel = function(){

}

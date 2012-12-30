

function Builder(map){
	this.map = map;
	this.count = 0;
	this.buildings = loadBuildings(this);
	this.current = null;


}

Builder.prototype.newBuilding = function(){
	this.buildings[this.count++] = new Building(this);
	//	alert("nowy budynek");
}

Builder.prototype.addPoint = function(x,y){
	if(this.current != null){
		this.current.pushPoint(x,y);
		//	alert("nowy punkt");
	}
}



function Builder(map){
	this.map = map;
	this.count = 0;
	loadBuildings(this);
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
Builder.prototype.loadBuildings = function(){
	var b = [];
	$.getJSON("http://localhost/index.php/locations/loadBuildings/",function(data){
		$.each(data , function(key, val){
			var nb = new Building(this,val.id);
			$.each(val.points,function(k,v){
				//				alert(v.latitude +" "+v.longitude);
				nb.pushPoint(v.latitude,v.longitude);
			});
			b.push(nb);
		});
	});
	this.buildings = b;
	return b;
}

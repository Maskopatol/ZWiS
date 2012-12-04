
var Mapka = {
	map: null,
	poly: [],
	userPoint: null,
	i:-1,
	x:0,
	y:0,
	initialize: function(){
		this.userPoint = new google.maps.LatLng(this.x,this.y);
		var mapOptions = {
			zoom: 15,
			center: this.userPoint,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		this.map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
		
		var marker = new google.maps.Marker({
			position: this.userPoint,
			map: this.map,
			title: 'title'
		});
		google.maps.event.addListener(this.map, 'click', this.addLatLng);

	},
	addLatLng: function addLatLng(event) {
		if(this.i < 0){
			this.newPoly();
		}
		var path = this.poly[this.i].getPath();
		if(path == null){
			var p = [event.latLng];
			this.poly[this.i].setPath(p);
			
		}else{
			path.push(event.latLng);
			if(path.length == 4){
				this.newPoly();
			}
		}
	},
	newPoly: function newPoly(){
		this.i++;
		this.poly[this.i] = new google.maps.Polygon({
			paths: [],
			strokeColor: '#FF0000',
			strokeOpacity: 0.8,
			strokeWeight: 2,
			fillColor: '#FF0000',
			fillOpacity: 0.35
		});
		
		this.poly[i].setMap(this.map);
	}
	
};
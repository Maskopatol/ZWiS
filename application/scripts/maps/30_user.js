
function loadUsers(url ){
	var users = [];
	$.getJSON(url,function(data){
		$.each(data , function(key, val){
			users.push(new User(val['locations'][0],val['name'] ));
		});
	});
	return users;
}



function User(data,name){
	this.map = Mcore.map;
	this.data = data;
	this.name = name;
	//alert(this.data.latitude+" "+this.data.longitude);
	this.infowindow = null;
	this.url = "http://localhost/index.php/locations/user_info/"+this.data.id_user;
	this.marker = new google.maps.Marker({
		position: new google.maps.LatLng(this.data.latitude,this.data.longitude),//this.userPoint,
										 map: this.map,
									  title: this.name
	});
	var th = this;
	google.maps.event.addListener(this.marker, 'click', function(){
		if(th.infowindow == null){
			$.ajax({
				url: th.url,
		  success: function(d){
			  th.infowindow = new google.maps.InfoWindow({content: d});
			  th.infowindow.open(th.map,th.marker);
		  }
			});
		}else{
			th.infowindow.open(th.map,th.marker);
		}
	});
}

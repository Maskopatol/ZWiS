function User(base , userdata){
	this.base = base;
	this.map = base.map;
	this.userdata = userdata;
	this.point = new google.maps.LatLng(this.userdata.latitude,this.userdata.longitude)

	var th = this;
	this.marker = new google.maps.Marker({
		position: th.point,
		map: th.map,
		title: th.userdata.name+" "+th.userdata.surname
	//	icon: this.image()
	});

}

User.prototype.image = function(){
	var img = document.createElement("canvas");
	var ctx = null;

	var frame = new Image();
	frame.onload = function(){
		img.width = frame.width;
		img.height = frame.height;
		ctx = img.getContext("2d");
		ctx.drawImage(frame, 0, 0);
	}
	frame.src = this.base.settings.userFrameUrl;

	var photo = new Image();
	photo.onload = function(){
		ctx.drawImage(photo, 4, 4);
	}
	photo.src = this.userdata.photo;

	var dataURL = img.toDataURL("image/png");

	return dataURL;
}

function Interface(base){
	this.base = base;
	this.ac = 0;
	this.canvas = null;
	this.init();
}

Interface.prototype.init = function(){
	var c = $("#"+this.base.settings.mapDivId);
	var filters_button = $("<input class='b-right' id='map_filters_button' type='button' value='Filtry' />");
	var admin_button = $("<input class='b-right' id='map_admin_button' type='button' value='Admin' />");
	var search_button = $("<input type='button' value='szukaj' />");

	$("<div id='map_top'></div>")
	.append("<label for='map_search'>Szukaj:</label>")
	.append("<input id='search_form' type='text' name='map_search' />")
	.append(search_button)
	.append(filters_button)
	.append(admin_button)
	.appendTo(c);
	//append("<input type='text'>")
	var canvas = $("<div id='map_canvas' />").appendTo(c);
	this.canvas = canvas[0];
	var m = $("<div id='map_menu'></div>")
	.appendTo(c);
	$("<div id='map_filters_menu' class='map_menus'>")
	.append("Filtry:<br />")
	.append("<input type='checkbox' checked='checked' name='buildings'><label for='builgings'>Budynki</label><br />")
	.append("<input type='checkbox' checked='checked' name='lecturers'><label for='lecturers'>Wykładowcy</label><br />")
	.append("<input type='checkbox' checked='checked' name='students'><label for='students'>Studenci</label><br />")
	.appendTo(m);

	var add_button = $("<input type='button' value='Dodaj budynek' />");

	$("<div id='map_admin_menu' class='map_menus'>")
	.append("Admin:<br />")
	.append(add_button)
	.appendTo(m);



	var th = this;
	$('.map_menus').hide();
	//$('#map_filters_menu').hide();

	admin_button.click(function(){
		if(th.ac != 2){
			th.showAdmin();
		}else{
			th.hideMenu();
		}
	});
	filters_button.click(function(){
		if(th.ac != 1){
			th.showFilters();
		}else{
			th.hideMenu();
		}
	});

	search_button.click(function(){
		th.find($("#search_form").val());
	});

	add_button.click(function(){
		th.base.newBuilding();
	});

	$("#map_filters_menu input[type='checkbox']").change(function(){
	//	alert($(this).attr('name') + " "+ $(this).is(':checked'));
		th.base.setVisible($(this).attr('name') , $(this).is(':checked'));
	});
}

Interface.prototype.showAdmin = function(){
	if(this.ac == 1){
		$('#map_filters_menu').fadeOut(500,function(){
			$('#map_admin_menu').fadeIn(500);
		});
	}else if(this.ac == 0){
		$("#map_canvas").animate({width:'80%'},1000,function(){
			$('#map_admin_menu').fadeIn(500);
		});
	}
	this.ac = 2;
}

Interface.prototype.showFilters = function(){
	if(this.ac == 2){
		$('#map_admin_menu').fadeOut(500,function(){
			$('#map_filters_menu').fadeIn(500);
		});
	}else if(this.ac == 0){
		$("#map_canvas").animate({width:'80%'},1000,function(){
			$('#map_filters_menu').fadeIn(500);
		});
	}
	this.ac = 1;
}

Interface.prototype.hideMenu = function(){
	$(".map_menus").hide();
	$("#map_canvas").animate({width:'100%'},1000);
	this.ac = 0;
}

Interface.prototype.find = function(string){
	alert("szukam: "+string);
}

/*
* Initialise the Google Map in the footer
*/
function initialize() {
	var mapOptions = {
		center: new google.maps.LatLng(60.170421,24.938149), 
		zoom: 15,
		panControl: false,
		zoomControl: false,
		mapTypeControl: false,
		scaleControl: false,
		scrollwheel: false,
		streetViewControl: false,
		overviewMapControl: false,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	
	//styling the map
	var styleOptions = {
		name: "Dummy Style"
	};

	var MAP_STYLE = [
		{
			"stylers": [
				{ "saturation": -100 },
				{ "visibility": "on" },
				{ "lightness": 40 }
			]
		}
	]
	
	var map = new google.maps.Map(document.getElementById("footer-map"), mapOptions);
	var mapType = new google.maps.StyledMapType(MAP_STYLE, styleOptions);
	map.mapTypes.set("Dummy Style", mapType);
	map.setMapTypeId("Dummy Style");
	
	var center;
	function calculateCenter() {
		center = map.getCenter();
	}
	google.maps.event.addDomListener(map, 'idle', function() {
		calculateCenter();
	});
	google.maps.event.addDomListener(window, 'resize', function() {
		map.setCenter(center);
	});
	
	var image = 'img/icon-map-marker.png';
  	var myLatLng = new google.maps.LatLng(60.16992,24.938707);
	var customMarker = new google.maps.Marker({
	  position: myLatLng,
	  map: map,
	  icon: image
	});
}

var style = 'blue';

$(document).ready(function(){
	/*
	* Set initial style
	* REMOVE WHEN YOU HAVE PICKED YOUR STYLE
	*/ 
	if(QueryString.style != undefined){
		style = QueryString.style;	
		if(style.match(/orange/)){
			style = 'orange';
		}
		if(style.match(/blue/)){
			style = 'blue';
		}
		if(style.match(/green/)){
			style = 'green';
		}
		if(style.match(/bw/)){
			style = 'bw';
		}
	}
	$('body').addClass(style);
	// END OF CODE TO REMOVE
	
	/*
	* Style changer 	
	* REMOVE WHEN YOU HAVE PICKED YOUR STYLE
	*/ 
	$('.st').click(function(){
		var newStyle = $(this).attr('id').split('-')[1];
		$('body').removeClass('bw orange green blue').addClass(newStyle);
		style = newStyle;
		return false;
	});
	// END OF CODE TO REMOVE	
	
	/*
	* Add style param to all links
	* REMOVE WHEN YOU HAVE PICKED YOUR STYLE
	*/ 	
	$('a').click(function(){
		if(!$(this).hasClass('accordion-toggle')){
			var curHref = $(this).prop('href');
			var newHref = curHref.split('?')[0]+'?style='+style;
			$(this).prop('href', newHref);
		}
	});
	// END OF CODE TO REMOVE
	
});

//FitVids
$(function($){ $('.mediaVideo').fitVids(); });


/*
*  Style switcher utility code
*  REMOVE WHEN YOU HAVE PICKED YOUR STYLE
*/
var QueryString = function () {
	var query_string = {};
	var query = window.location.search.substring(1);
	var vars = query.split("&");
	for (var i=0;i<vars.length;i++) {
		var pair = vars[i].split("=");
		// If first entry with this name
		if (typeof query_string[pair[0]] === "undefined") {
			query_string[pair[0]] = pair[1];
		// If second entry with this name
		} else if (typeof query_string[pair[0]] === "string") {
			var arr = [ query_string[pair[0]], pair[1] ];
			query_string[pair[0]] = arr;
		// If third or later entry with this name
		} else {
			query_string[pair[0]].push(pair[1]);
		}
	} 
	return query_string;
} ();
// END OF CODE TO REMOVE
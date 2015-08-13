$(document).ready(function(){

	$("#1").click(function(){
		
		$('#bikeInfo').fadeToggle('fast');
	});

	$("#2").click(function(){
		
		$('#socialMedia').fadeToggle('fast');
	});

	$("#3").click(function(){
		
		$('#issueReporting').fadeToggle('fast');
	});

	$('tr.header')
		.click(function(){
			$(this).siblings('.child-'+this.id).toggle('fast');
		});
	$('tr[class^=child-]').hide().children('tr');
});

/* var myCenter=new google.maps.LatLng(59.858698,17.646150);

function initialize()
{
var mapProp = {
  center:myCenter,
  zoom:15,
  mapTypeId:google.maps.MapTypeId.HYBRID,
  panControl:false,

 
  mapTypeControlOptions: {position: google.maps.ControlPosition.TOP_CENTER},
  zoomControlOptions: {position: google.maps.ControlPosition.RIGHT_CENTER}


  }; 

var map=new google.maps.Map(document.getElementById("map_container"),mapProp);


var marker=new google.maps.Marker({
  position:myCenter,
  });

marker.setMap(map);



var infowindow = new google.maps.InfoWindow({
  content:"Uppsala"
  });

google.maps.event.addListener(marker, 'click', function() {
  infowindow.open(map,marker);
  });
}

google.maps.event.addDomListener(window, 'load', initialize);
});	
*/











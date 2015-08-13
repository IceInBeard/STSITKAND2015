$(document).ready(function(){




	$("#tabcontent").find("[id^='tab']").hide(0);
	$("#tabs li:first a").attr("id","active");
	$(" #tabhem").fadeIn();
	$("#tabcontent").find("[id='tabhem']").fadeIn(0);
	

	$('#tabs a').click(function(e){
		e.preventDefault();
		if($(this).closest("li a").attr("id") == "active"){
			return;
		}
		else{
			$("#tabcontent").find("[id^='tab']").hide(0);
			$("#tabs li a").attr("id","");
			$(this).attr("id","active");
			$('#'+ $(this).attr('name')).fadeIn(900);
		}
	});

});

/*$(document).ready(function() {
  $.simpleWeather({
    location: 'Uppsala, Sweden',
    woeid: '',
    unit: 'c',
    success: function(weather) {
      html = '<h2><i class="icon-'+weather.code+'"></i> '+weather.temp+'&deg;'+weather.units.temp+'</h2>';
      html += '<ul><li>'+weather.city+', '+weather.region+'</li>';
      html += '<li class="currently">'+weather.currently+'</li>';
      html += '<li>'+weather.wind.direction+' '+weather.wind.speed+' '+weather.units.speed+'</li></ul>';
  
      $("#weather").html(html);
    },
    error: function(error) {
      $("#weather").html('<p>'+error+'</p>');
    }
  });
});*/
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

			if($(this).attr('name')=="tabissue"){
				allowDrop=true;

				}
			else{
				allowDrop=false;
				deleteOverlays();
				}
		}
	});

});


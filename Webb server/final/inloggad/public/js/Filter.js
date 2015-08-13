$(document).ready(
	function(){
		$("#leftSideCategory").click(function() {
			$("#rightSideCategory").fadeToggle();
			$("#rightSideOther").hide();
			$("#rightSideStatus").hide();
			//$("#rightSideDate").hide();
			//$("#rightSideComment").hide();
		});


		$("#leftSideStatus").click(function() {
			$("#rightSideStatus").fadeToggle();
			$("#rightSideCategory").hide();
			$("#rightSideOther").hide();
			//$("#rightSideDate").hide();
			//$("#rightSideComment").hide();
			

		});
		$("#leftSideOther").click(function() {
			$("#rightSideOther").fadeToggle();
			$("#rightSideCategory").hide();
			$("#rightSideStatus").hide();
			//$("#rightSideDate").hide();
			//$("#rightSideComment").hide();
		});
		//$("#leftSideDate").click(function() {
			//$("#rightSideDate").fadeToggle();
			//$("#rightSideCategory").hide();
			//$("#rightSideStatus").hide();
			//$("#rightSideOther").hide();
			//$("#rightSideComment").hide();
		//});

		//$("#leftSideComment").click(function() {
			//$("#rightSideComment").fadeToggle();
			//$("#rightSideCategory").hide();
			//$("#rightSideStatus").hide();
			//$("#rightSideOther").hide();
			//$("#rightSideDate").hide();

		//});

	$('.leftSide').on('click','.leftSideColor',function () {
    $('.leftSideColor').removeClass('selected');
    $(this).addClass('selected')
});
	});

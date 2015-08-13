$(document).ready(
	function(){
		$("#leftSideCategory").click(function() {
			$("#rightSideCategory").fadeToggle();
			$("#rightSideDescription").hide();
			$("#rightSideStatus").hide();
			$("#rightSideDate").hide();
			$("#rightSideComment").hide();
		});


		$("#leftSideStatus").click(function() {
			$("#rightSideStatus").fadeToggle();
			$("#rightSideCategory").hide();
			$("#rightSideDescription").hide();
			$("#rightSideDate").hide();
			$("#rightSideComment").hide();
			// $(this).css('background-color','yellow');
   //         	$(this).css('background-color', '');

		});
		$("#leftSideDescription").click(function() {
			$("#rightSideDescription").fadeToggle();
			$("#rightSideCategory").hide();
			$("#rightSideStatus").hide();
			$("#rightSideDate").hide();
			$("#rightSideComment").hide();
		});
		$("#leftSideDate").click(function() {
			$("#rightSideDate").fadeToggle();
			$("#rightSideCategory").hide();
			$("#rightSideStatus").hide();
			$("#rightSideDescription").hide();
			$("#rightSideComment").hide();
		});

		$("#leftSideComment").click(function() {
			$("#rightSideComment").fadeToggle();
			$("#rightSideCategory").hide();
			$("#rightSideStatus").hide();
			$("#rightSideDescription").hide();
			$("#rightSideDate").hide();

		});
	});
var activeWidgets=[];


function addwidget(wID){
	var subwidgetArea = document.getElementById('subwidget-container');
	

	if(activeWidgets.length < 3){ // Kollar om det finns mindre än 3 widgets öppna
		if($.inArray(wID, activeWidgets) < 0){ // Kollar om widget redan öppen
			$.getScript('js/subwidgets.js', function(){


				subwidgetArea.innerHTML += '<div id="'+ wID +'" class="widget" style="display:none;"><div class="widgethead">'+ subwidget[wID][0] + '<a class="widgetclose" href="#" onclick="removeWidget(\''+wID+'\')">X</a></div>'+ subwidget[wID][1] + '</div>';

				var fadeId = '#' + wID;

				$(fadeId).fadeIn("slow");
				

			   activeWidgets.push(wID);
			});
		}else{
			alert("Denna widget finns redan upplagd");
		}
		

	} else {
		alert("För många subwidget");
	}
}

function removeWidget(wID){
	var subwidgetArea = document.getElementById('subwidget-container');
	
	if($.inArray(wID, activeWidgets) > -1){ // Kollar om widgeten finns ute

		var fadeId = '#' + wID;

		$(fadeId).animate({
            'width': 0,
            'opacity': 0
        	}, 750, function() {
            $(this).remove();
        });

		//document.getElementById(wID).remove();
		var index = activeWidgets.indexOf(wID);
		
		if (index > -1) {
    		activeWidgets.splice(index, 1);
		}


	}

}
var tr, td;

var loaded = false;
var issuesCategories = [];
function loadIssues(){
    
    if (loaded != true){
        $.ajax({
            type: "GET",
            url: "http://stsitkand.student.it.uu.se/issuereporting/IssueReportingMongo.php",
            dataType: "json",
            success: function (data) {
                createMarkerArray(data, markers);
                createInfoWindow2();

                //gå igenom alla markers jämför med issuescategories och se om den redan finns där. annars lägg till den. så att alla categorier läggs till--------------------------kalles morgon
                for (var i = 0; i < markers.length; i++) {
                    if(markers[i].group == "Issues"){
                        var foundCategory = false;
                        for (var j = 0; j < issuesCategories.length; j++) {
                            if(markers[i].category == issuesCategories[j]){
                                foundCategory = true;
                            }
                        }
                        if(foundCategory != true){
                            issuesCategories.push(markers[i].category);
                        }
                    }
                }
               
                markersToMap2(issuesCategories);
              //   console.log("markers (i issues.js");
             //   console.log(markers);
               //  console.log("issuesCategories");
             //   console.log(issuesCategories);
                for (var i = 0; i < issuesCategories.length; i++) {
                    
                    hideCategory(issuesCategories[i]);
               }
               //showCategory(issuesCategories[3]);
            }
        });
        loaded = true;
    }
}
var show = "All";
function sortByStatus(status){
	 createInfoWindow2();
	if(show != status){
		show = status;
		if (status == "Slutförd") {
			for (var i = 0; i < issuesCategories.length; i++) {
				hideCategory(issuesCategories[i]);
            }	
			markersToMap2(issuesCategories);
			hideStatus("Inrapporterad");
			hideStatus("Under Behandling");
		}
		if (status == "Under Behandling") {
			for (var i = 0; i < issuesCategories.length; i++) {
				hideCategory(issuesCategories[i]);
            }
			markersToMap2(issuesCategories);
			hideStatus("Inrapporterad");
			hideStatus("Slutförd");
		}
		if (status == "Inrapporterad") {
			for (var i = 0; i < issuesCategories.length; i++) {
          		hideCategory(issuesCategories[i]);
            }
			markersToMap2(issuesCategories);
			hideStatus("Under Behandling");
			hideStatus("Slutförd");
		}
		
	}else{
		show= "All";
		for (var i = 0; i < issuesCategories.length; i++) {
            hideCategory(issuesCategories[i]);
		}
		markersToMap2(issuesCategories);
	}
	
	//table.fnMultiFilter("table.column(5)":"Fixad", "table.column(5)": "Under Behandling");
}
function hideStatus(status) {

            for (i = 0; i < markers.length; i++) {
                if (markers[i].status == status) {
                    markers[i].marker.setMap(null);
                }
            }
        
}
function markersToMap2(category) {
        for (var i = 0; i < markers.length; i++) {
        for (var j = 0; j < category.length; j++) {
        if (markers[i].category == category[j]) {
                markers[i].postion = new google.maps.LatLng(markers[i].latitude, markers[i].longitude);

                var infowindow = new google.maps.InfoWindow({
                    content: markers[i].contenString
                });
        

                if(markers[i].category=="verkstad" || markers[i].category=="pump" || markers[i].category=="parking"){
        var icon2 = 'http://stsitkand.student.it.uu.se/sprint2/img/mapicons/'+markers[i].category + ".svg"; //För att en marker ska få rätt ikon efter kategori måste bildfilen heta sin kategori och vara i svg-format.    

        }else if (markers[i].status == "Slutförd"){
            
            
            
            var icon2 = 'http://stsitkand.student.it.uu.se/sprint3/img/icons/green/'+markers[i].category + "GREEN.svg"; //För att en marker ska få rätt ikon efter kategori måste bildfilen heta sin kategori och vara i png-format.
        }
        else if (markers[i].status == "Inrapporterad"){
              
            
            var icon2 = 'http://stsitkand.student.it.uu.se/sprint3/img/icons/red/'+markers[i].category + "RED.svg"; //För att en marker ska få rätt ikon efter kategori måste bildfilen heta sin kategori och vara i png-format.
        }
        else {
            
            
            var icon2 = 'http://stsitkand.student.it.uu.se/sprint3/img/icons/yellow/'+markers[i].category + "YELLOW.svg"; //För att en marker ska få rätt ikon efter kategori måste bildfilen heta sin kategori och vara i png-format.
        }

        var icon = new google.maps.MarkerImage(
    icon2,
    null, /* size is determined at runtime */
    null, /* origin is 0,0 */
    null, /* anchor is bottom center of the scaled image */
    new google.maps.Size(30, 30)
);  
               

                var newMarker = new google.maps.Marker({
                    position: markers[i].postion,
                    map: map,
                    icon: icon,
                    title: markers[i].contenString,
                    animation: google.maps.Animation.DROP,
                    optimized: false,
                    flat: true
                });
              //  console.log("New Marker Created. Icon sen Marker:");
              //  console.log(icon);
              //  console.log(markers[i]);

        
                google.maps.event.addListener(newMarker, 'click', function () {
                    infowindow.setContent(this.title);
                    infowindow.open(map, this);

                });
                markers[i].marker = newMarker; // markers.marker kommer åt googlemaps-markern som objekt, tex markers[index].marker.setMap(null)
                markers[i].infowindow = infowindow;
            }

     }}
    
  }
//-------------------------------------------------------------------------------------------------------------------------------------------------------kalles morgon
function updateMarkerArray(categories){
    for (var i = 0; i < markers.length; i++) {
        for (var j = 0; j < categories.length; j++) {
            if (markers[i].category == categories[j]) {
                hideCategory(categories[j]); //ta bort den från karta-värdel
                markers.splice(i, 1); //ta bort den markern från arrayen


            }
        }
    }
	
    clearTable();
	
$.ajax({
            type: "GET",
            url: "http://stsitkand.student.it.uu.se/issuereporting/IssueReportingMongo.php",
            dataType: "json",
            success: function (data) {
console.log("updatemarker");        
console.log(data);
                createMarkerArray(data, markers);
                createInfoWindow2();

                //gå igenom alla markers jämför med issuescategories och se om den redan finns där. annars lägg till den. så att alla categorier läggs till--------------------------kalles morgon
                for (var i = 0; i < markers.length; i++) {
                    if(markers[i].group == "Issues"){
                        var foundCategory = false;
                        for (var j = 0; j < issuesCategories.length; j++) {
                            if(markers[i].category == issuesCategories[j]){
                                foundCategory = true;
                            }
                        }
                        if(foundCategory != true){
                            issuesCategories.push(markers[i].category);
                        }
                    }
                }


                markersToMap2(issuesCategories);
                showList();

            }
        });

}







//-------------------------------------------------visa ett issue på kartan och dölj alla andra, visa även endast den i listan

function showIssue(index){
    for (var i = 0; i < markers.length; i++) {
        for (var j = 0; j < issuesCategories.length; j++) {
            if (markers[i].category == issuesCategories[j]) {
                hideCategory(issuesCategories[j]); //ta bort den från karta-värdel
             

            }
        }
    }
    clearTable();
    for (var i = 0; i < markers.length; i++) {
        if(markers[i].id == index){
            markers[i].marker.setMap(map);
            var newmarkers = [markers[i]];
           
            $('#issueList').show('fast');
            printIssueList(newmarkers, "Fålhagen", "Address", "Category")
        }
    }

}


//-----------FUNKTION FÖR ATT PLACERA UT MARKER MANUELLT---------------

//Initierar dropmarkerfunc


function initMapDrop(){

  
 google.maps.event.addListener(map, 'click', function(event) {
if(allowDrop){
 placeMarker(event.latLng);
getAddress(event.latLng.lat(),event.latLng.lng(), function(){
document.getElementById("Geotag").value = addresstext;
document.getElementById("Geotag").style.backgroundColor = "#FFFFFF";	


});

 document.getElementById("droppedLat").value = event.latLng.lat();
 document.getElementById("droppedLng").value = event.latLng.lng();
}
 });


}



 function placeMarker(location) {
 // first remove all markers if there are any
 deleteOverlays();

 var marker = new google.maps.Marker({
 position: location,
 map: map,
 draggable :true
 });

droppedMarkers.push(marker);

 google.maps.event.addListener(marker, 'drag', function(event) {
	getAddress(event.latLng.lat(),event.latLng.lng(), function(){
document.getElementById("Geotag").value = addresstext;	});
	
 document.getElementById("droppedLat").value = event.latLng.lat();
 document.getElementById("droppedLng").value = event.latLng.lng();

 })

 }

 function deleteOverlays() {
 if (droppedMarkers) { console.log("Kollar deleteOverlays: " + droppedMarkers);
 for (i in droppedMarkers) {
 droppedMarkers[i].setMap(null);
 }
 droppedMarkers.length = 0;
 }
 }


var addresstext= "";
//gör om long lat till en riktigt adress
function getAddress(latitude, longitude, callback){
	
            var lat = latitude;
            var lng = longitude;
            var latlng = new google.maps.LatLng(lat, lng);
            var geocoder = geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[1]) {
						//alert(results[1].formatted_address);
						addresstext = String(results[1].formatted_address);
						console.log(addresstext);
						//console.log(typeof addresstext);
				callback();
                       
                    }
			
                }
            });
}
      ////  return addresstext; }


//Rapportera knapp

function attachTextListener(input, func) {
  if (window.addEventListener) {
    input.addEventListener('input', func, false);
  } else
    input.attachEvent('onpropertychange', function() {
      func.call(input);
    });
}

//var myInput = document.getElementById("Geotag");
//console.log(myInput);
//attachTextListener(myInput, function() {
  // Check and manipulate this.value here
  //this.style.backgroundColor = "#FFFFFF";
//});

function setColorWhite(){
	document.getElementById("issueCategory").style.backgroundColor = "#FFFFFF";
	
}
function submitNewIssue(){
	var adressInput = document.getElementById("Geotag");
	var adressText = adressInput.value;
	var beskrivningInput = document.getElementById("widgetDescription");
	var beskrivningText = beskrivningInput.value;
	var formCompleted = true;
	var selectbox = document.getElementById("issueCategory");
 	var category= selectbox.options[selectbox.selectedIndex].value;	
	if(selectbox.selectedIndex == 0){
		selectbox.style.backgroundColor = "#FDD3D3";
		
		formCompleted = false;
	}
	if(adressText == ""){
		adressInput.style.backgroundColor = "#FDD3D3";

		adressInput.style.color = "#000000";
		formCompleted = false;
	}
	if(beskrivningText == ""){
		beskrivningInput.style.backgroundColor = "#FDD3D3";

		formCompleted = false;
	}
	if(formCompleted){
		adressInput.style.backgroundColor = "#FFFFFF";
		beskrivningInput.style.backgroundColor = "#FFFFFF";
		document.getElementById("issueCategory").style.backgroundColor = "#FFFFFF";
		//här kör man funktionen som nu ligger på onklick på knappen "Skicka"
		createReport();
	}

  attachTextListener(adressInput, function() {
  // Check and manipulate this.value here
  this.style.backgroundColor = "#FFFFFF";
});
  attachTextListener(beskrivningInput, function() {
  // Check and manipulate this.value here
  this.style.backgroundColor = "#FFFFFF";
});
}

function createReport(){
	console.log("nytt issue rapporterat");
    var formData = new FormData(document.getElementById("reportForm"));
console.log(formData);
    reportReady();
    $.ajax({
        url: "http://stsitkand.student.it.uu.se/final/db/createReport.php",  //Server script to process data
        type: 'POST',
        xhr: function() {  // Custom XMLHttpRequest
            var myXhr = $.ajaxSettings.xhr();
            if(myXhr.upload){ // Check if upload property exists
                myXhr.upload.addEventListener('progress',progressHandlingFunction, false); // For handling the progress of the upload

            }
            return myXhr;
        },
        //Ajax events
        //beforeSend: beforeSendHandler,
        //success: completeHandler,
        //error: errorHandler,
        // Form data
        data: formData,
        //Options to tell jQuery not to process data or worry about content-type.
        cache: false,
        contentType: false,
        processData: false
	
    });
}

function progressHandlingFunction(e){
    if(e.lengthComputable){
        $('progress').attr({value:e.loaded,max:e.total});
    }
}

function reportReady(){
	hideContainer();
}

function hideContainer(){	
	document.getElementById("widget2").style.display = "none";
	document.getElementById("widget3").style.display = "";
	}
function showContainer(){
	document.getElementById("widget2").style.display = "";
document.getElementById("widget3").style.display = "none";
	}

function createInfoWindow2() {

    for (var i = 0; i < markers.length; i++) {


if(markers[i].statusComment === undefined){
	markers[i].statusComment = "";

}


if (markers[i].statusComment == "") {
markers[i].statusComment = "Denna felanmälan har ännu ingen kommentar.";
}

        markers[i].contenString = '<div id="contentIssue" style="color:black; padding: 10px 10px 0px; height: 100%; width: 188px";font-family: arial>' +
        '<p style = "color:black; font-family: arial; font-weight:bold; display:inline">  Kategori: </p><p style = "color:black; font-family: arial; margin: 2px">' + markers[i].category  + '</p><div id="bodyContent">' +
        '<p style = "color:black; font-family: arial; font-weight:bold; display:inline"> Beskrivning: </p><br>' +'<textarea readonly rows="2" overflow="auto" id="muniDescriptionText" style="max-height: 33px; resize: none; font-size: 13px; font-family: arial">' + markers[i].description +'</textarea> <br>'+ '<p style = "color:black; font-family: arial; font-weight:bold; display:inline"> Kommunens kommentar: </p><br>' +' <textarea readonly rows="2" overflow="auto" id="muniCommentText" style="resize: none; font-size: 13px; max-height: 34px; font-family: arial">' + markers[i].statusComment + '</textarea><br><br><img id="thumbnail" onerror="picNotFound()" style="width: 150px; position: relative;margin-left: auto;margin-right: auto;left: 0;right: 0;height:100px;"src="' + markers[i].picture + '"> </p>' +
        '</div>' +
        '</div>';
    }
}

function picNotFound(){
	console.log("picNotFound");
	document.getElementById("thumbnail").src = "https://9to5mac.files.wordpress.com/2013/06/camera.png";
}






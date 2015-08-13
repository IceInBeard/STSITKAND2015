
var markers = [];
var map;

//-------------------SIDAN LADDAS OCH SKAPAR EN MAP -----------------------------

function onloading() {
    // KARTAN LADDAS IN
    var mapCenter = new google.maps.LatLng(59.858056, 17.644722);
    var mapOptions = {
        center: mapCenter,
        zoom: 12,
        scrollwheel: false,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.LARGE,
            position: google.maps.ControlPosition.RIGHT_CENTER
        }
    };
    map = new google.maps.Map(document.getElementById('map-container'),
        mapOptions);

//-------------HÄMTAR JSON OBJEKT--------------------------------------------------------------

    $.ajax({
        type: "GET",
        url: "http://stsitkand.student.it.uu.se/issuereporting/IssueReportingMongo.php",
        dataType: "json",
        success: function (data) {
            createMarkerArray(data, markers);
            createInfoWindow();
            markersToMap();

        }
    });



});
}
//--------------------- SKAPAR MARKERSARRAYEN FRÅN DATABASEN FÖR BICYCLE ----------------------------------------

function createMarkerArrayBicycle(markerData,markersTemp, category) {
    for (var i = 0; i < markerData.length; i++) {
        var currentMarker = [];
        currentMarker.latitude = markerData[i].latitude;
        currentMarker.longitude = markerData[i].longitude;
        currentMarker.description = markerData[i].description;
        currentMarker.category = category;
        currentMarker.timeOpen = markerData[i].timeOpen;
	currentMarker.phoneNumber = markerData[i].phoneNumber;
	currentMarker.address = markerData[i].address;
	currentMarker.website = markerData[i].website;
	currentMarker.email = markerData[i].email;
	currentMarker.picture = "test";
	currentMarker.title = markerData[i].name;
        markersTemp.push(currentMarker); // Detta lägger in markern som objekt i array kallad markers som kan kommas åt överallt
    }
}


//--------------------- SKAPAR MARKERSARRAYEN FRÅN DATABASEN ----------------------------------------

function createMarkerArray(markerData,markersTemp) {
    for (var i = 0; i < markerData.length; i++) {
        var currentMarker = [];
        currentMarker.latitude = markerData[i].Latitude;
        currentMarker.longitude = markerData[i].Longitude;
        currentMarker.description = markerData[i].Description;
        currentMarker.category = markerData[i].Category;
        currentMarker.picture = markerData[i].Picture;
        currentMarker.title = markerData[i].title;
        markersTemp.push(currentMarker); // Detta lägger in markern som objekt i array kallad markers som kan kommas åt överallt
    }
}


//------------------------SKAPAR INFOWINDOW-------------------------------------------------
function createInfoWindow() {
    for (var i = 0; i < markers.length; i++) {
        markers[i].contenString = '<div id="content">' +
        '<h1 >' + markers[i].category + '</h1>' +
        '<div id="bodyContent">' +
        '<p>' + markers[i].description + '<br><br><img id="thumbnail" src="' + markers[i].picture + '"> </p>' +
        '</div>' +
        '</div>';
    }
}

//------------------------SKAPAR INFOWINDOW FÖR CYKEL-------------------------------------------------
function createInfoWindowBicycle() {
    for (var i = 0; i < markers.length; i++) {
        markers[i].contenString = '<div id="content">' +
        '<h1 >' + markers[i].title + '</h1>' +
        '<div id="bodyContent">' +
        '<p>' + markers[i].phoneNumber + '<br><br><img id="thumbnail" src="' + markers[i].address + markers[i].website +'"> </p>' +
        '</div>' +
        '</div>';
    }
}

//------------------------SÄTTER UT MARKERS FRÅN ARRAYEN TILL KARTAN-----------------------------
function markersToMap() {
        for (var i = 0; i < markers.length; i++) {
                markers[i].postion = new google.maps.LatLng(markers[i].latitude, markers[i].longitude);

                var infowindow = new google.maps.InfoWindow({
                    content: markers[i].contenString
                });

                var icon = markers[i].category + ".png"; //För att en marker ska få rätt ikon efter kategori måste bildfilen heta sin kategori och vara i png-format.
                var newMarker = new google.maps.Marker({
                    position: markers[i].postion,
                    map: map,
                    icon: icon,
                    title: markers[i].contenString,
                    animation: google.maps.Animation.DROP
                });

                markers[i].marker = newMarker; // markers.marker kommer åt googlemaps-markern som objekt, tex markers[index].marker.setMap(null)

                google.maps.event.addListener(newMarker, 'click', function () {
                    infowindow.setContent(this.title);
                    infowindow.open(map, this);

                });
            }

    }



//-------------------------- ÖVRIGA FUNKTIONER--------------------------------------

        function hideCategory(category) {
            for (i = 0; i < markers.length; i++) {
                if (markers[i].category == category) {
                    markers[i].marker.setMap(null);
                }
            }
        }

        function showCategory(category) {
            for (i = 0; i < markers.length; i++) {
                if (markers[i].category == category) {
                    markers[i].marker.setMap(map);
                }
            }
        }

        function switchCheckbox(checkBox) {
            if (checkBox.checked) {
                showCategory(checkBox.value);
            }
            else {
                hideCategory(checkBox.value);
            }
        }



//-----------FUNKTION FÖR ATT PLACERA UT MARKER MANUELLT---------------
/*  var markersArray = [];
 google.maps.event.addListener(map, 'click', function(event) {
 placeMarker(event.latLng);
 document.getElementById("latFld").value = event.latLng.lat();
 document.getElementById("lngFld").value = event.latLng.lng();

 });



 function placeMarker(location) {
 // first remove all markers if there are any
 deleteOverlays();

 var marker = new google.maps.Marker({
 position: location,
 map: map,
 draggable :true
 });

 markersArray.push(marker);
 google.maps.event.addListener(marker, 'drag', function(event) {

 document.getElementById("latFld").value = event.latLng.lat();
 document.getElementById("lngFld").value = event.latLng.lng()

 })

 }

 function deleteOverlays() {
 if (markersArray) {
 for (i in markersArray) {
 markersArray[i].setMap(null);
 }
 markersArray.length = 0;
 }
 }

*/

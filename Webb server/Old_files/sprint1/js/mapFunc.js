var markers = [];
var map;
var hej = "hej";
var tweets = [];


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
    map = new google.maps.Map(document.getElementById('map'),
        mapOptions);

    loadBicycles();
    loadIssues();
    loadBicyclesNodes();



}//Onloading end





//------------------- DROP-DOWN MAP CONTROLL -----------------------------



( function( $ ) {
$( document ).ready(function() {
// Cache the elements we'll need
var menu = $('#cssmenu');
var menuList = menu.find('ul:first');
var listItems = menu.find('li').not('#responsive-tab');

});
} )( jQuery );









//--------------------- SKAPAR MARKERSARRAYEN FRÅN DATABASEN FÖR BICYCLE ----------------------------------------
function createMarkerArrayBicycle(markerData, markersTemp, category) {   
for (var i = 0; i < markerData.length; i++) {
	var currentMarker = [];
        if(category=="parking"){
	
            currentMarker.latitude = markerData[i].json_geometry.coordinates[1];
            currentMarker.longitude = markerData[i].json_geometry.coordinates[0];
            currentMarker.amount = markerData[i].PLATSER;
            currentMarker.category = category;
            currentMarker.address = markerData[i].GATA_OMR\u00c5DE;
        }else if(category=="nodes"){
	    currentMarker.latitude = markerData[i].latitude;
            currentMarker.longitude = markerData[i].longitude;
            currentMarker.title = markerData[i].name;
            currentMarker.category = category;
}
        else{
  
            currentMarker.latitude = markerData[i].latitude;
            currentMarker.longitude = markerData[i].longitude;
            currentMarker.description = markerData[i].description;
            currentMarker.category = category;
            currentMarker.timeOpen = markerData[i].timeOpen;
            currentMarker.phoneNumber = markerData[i].phoneNumber;
            currentMarker.address = markerData[i].address;
            currentMarker.website = markerData[i].website;
            currentMarker.email = markerData[i].email;
            currentMarker.title = markerData[i].name;
        }
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
	currentMarker.group = markerData[i].Group;
//currentMarker.id = markerData[i]._id;
	currentMarker.status = markerData[i].Status_muni;
		//console.log(currentMarker);
	var idtemp = markerData[i]._id;
	currentMarker.id = idtemp.$id;
	
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
	if(markers[i].category=="parking"){
	markers[i].contenString = '<div id="content">' +
        '<h1 >' + markers[i].address + '</h1>' +
        '<div id="bodyContent">' +
        '<p>'+'Antal platser: ' + markers[i].amount + '<br> </p>' +
        '</div>' +
        '</div>';

}else if(markers[i].category=="verkstad"){
	var openToday = checkOpenTime(markers[i]);
        markers[i].contenString = '<div id="content">' +
        '<h1 >' + markers[i].title + '</h1>' +
        '<div id="bodyContent">' +
        '<p>' +'Tel: '+ markers[i].phoneNumber + '<br> </p>' +
	'Öppet Idag: '+ openToday+
        '</div>' +
        '</div>';
    }else{
	 markers[i].contenString = '<div id="content">' +
        '<h1 >' + markers[i].title + '</h1>' +'</div>';
}
}
}

//------------------------KOLLAR ÖPPETTIDER IDAG, DETTA ANVÄNDS I INFOWINDOW BICYCLE------
function checkOpenTime(shop){
    var date = new Date();
    var day = date.getDay();
	
if(day==1){
var open = shop.timeOpen.monday
}else if(day==2){
var open = shop.timeOpen.tuesday
}else if(day==3){
var open = shop.timeOpen.wednesday
}else if(day==4){
var open = shop.timeOpen.thursday
}else if(day==5){
var open = shop.timeOpen.friday
}else if(day==6){
var open = shop.timeOpen.saturday
}else if(day==7){
var open = shop.timeOpen.sunday
}
 
    return open;
}

//------------------------SÄTTER UT MARKERS FRÅN ARRAYEN TILL KARTAN-----------------------------
function markersToMap(category) {
        for (var i = 0; i < markers.length; i++) {
		for (var j = 0; j < category.length; j++) {
		if (markers[i].category == category[j]) {
                markers[i].postion = new google.maps.LatLng(markers[i].latitude, markers[i].longitude);

                var infowindow = new google.maps.InfoWindow({
                    content: markers[i].contenString
                });

                var icon = "img/mapicons/" + markers[i].category + ".png"; //För att en marker ska få rätt ikon efter kategori måste bildfilen heta sin kategori och vara i png-format.
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

     }} 
  }


//---------------------------Twitter Funktioner------------------------------------

//--------------------- SKAPAR TWEETMARKERSARRAYEN FRÅN DATABASEN ----------------------------------------

function createTweetArray(markerData, markersTemp) {
    for (var i = 0; i < markerData.length; i++) {
        var currentMarker = [];
        currentMarker.latitude = markerData[i].Latitude;
        currentMarker.longitude = markerData[i].Longitude;
        currentMarker.description = markerData[i].Description;
        currentMarker.picture = markerData[i].Picture;
        currentMarker.title = markerData[i].title;
        currentMarker.user = markerData[i].user;
        currentMarker.text = markerData[i].Text;
        currentMarker.date = markerData[i].date;
        markersTemp.push(currentMarker);

    }
}
//------------------------SÄTTER UT TWEETMARKERS FRÅN ARRAYEN TILL KARTAN-----------------------------
function tweetsToMap() {
    for (var i = 0; i < tweets.length; i++) {
        tweets[i].postion = new google.maps.LatLng(tweets[i].latitude, tweets[i].longitude);

        var infowindow = new google.maps.InfoWindow({
            content: tweets[i].contenString
        });

        //var icon = tweets[i].icon;
        var newMarker = new google.maps.Marker({
            position: new google.maps.LatLng(tweets[i].latitude, tweets[i].longitude),
            map: map,
            icon: "img/mapicons/twittersmall.png",
            title: tweets[i].contenString,
            animation: google.maps.Animation.DROP
        });
        //console.log("skapat en marker");

        tweets[i].marker = newMarker; // markers.marker kommer åt googlemaps-markern som objekt, tex markers[index].marker.setMap(null)

        google.maps.event.addListener(newMarker, 'click', function () {
            infowindow.setContent(this.title);
            infowindow.open(map, this);

        });
    }

}
//-----------------------------------TWEETINFOWINDOW--------------------------
function createTweetInfoWindow() {
    for (var i = 0; i < tweets.length; i++) {
        tweets[i].contenString = '<div id="content">' +
                '<h1 >' + tweets[i].text + '</h1>' +
                '<div id="bodyContent">' +
                '<p>' + tweets[i].description + ' av ' + tweets[i].user + ' vid ' + tweets[i].date + '</p>' +
                '</div>' +
                '</div>';
    }
}

//------------------------------------TA BORT TWEETS FRÅN KARTA--------------------------
function removeMarkerFromMap(marker) {
    marker.setMap(null);
}

function clearAllTweets() {
    for (var i = 0; i < tweets.length; i++) {
        removeMarkerFromMap(tweets[i].marker);
    }
    tweets = [];
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

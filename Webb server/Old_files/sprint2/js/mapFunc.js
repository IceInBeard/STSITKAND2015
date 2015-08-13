var markers = [];
var circles = [];
var map;
var hej = "hej";
var tweets = [];
var heatmapData = [];
var heatmap;
var tweetMarkers = [];
var tweetInfowindow;

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
    heatmap = new google.maps.visualization.HeatmapLayer();
    loadBicycles();
    loadIssues();
    loadBicyclesNodes();
    loadNodesData();



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




//--------------------------LÄGGER TILL DATA ÖVER NODER I MARKERSARRAY------------//
function createMarkerArrayNodesData(markerData, category){
	
	for(var k =0; k< markers.length; k++){
	if(markers[k].title==category){
		markers[k].data=markerData;
	//alert(markers[k].data["2014-11-15"]);
}
	}
	
	

}




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
		currentMarker.email = markerData[i].Email;
		currentMarker.company = markerData[i].Comp_resp;
	currentMarker.group = markerData[i].Group;
	var timestamp = markerData[i].Timestamp;
        var timestamparray = timestamp.split(" ");
        var datum = timestamparray[0];
        currentMarker.datum = datum;
        currentMarker.statusComment = markerData[i].Comment_muni;
//currentMarker.id = markerData[i]._id;
	currentMarker.status = markerData[i].Status_muni;
	//	console.log(currentMarker);
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
		

               /* var icon = {
                url:"img/mapicons/" + markers[i].category + ".svg", //För att en marker ska få rätt ikon efter kategori måste bildfilen heta sin kategori och vara i png-format.
                size: new google.maps.Size(40, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(30, 30)};
                */

                    var icon = {
                url:"img/mapicons/" + markers[i].category + ".svg", //För att en marker ska få rätt ikon efter kategori måste bildfilen heta sin kategori och vara i png-format.
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)};


                var newMarker = new google.maps.Marker({
                    position: markers[i].postion,
                    map: map,
                    icon: icon,
                    title: markers[i].contenString,
                    animation: google.maps.Animation.DROP,
                    optimized: false
                });


		
                google.maps.event.addListener(newMarker, 'click', function () {
                    infowindow.setContent(this.title);
                    infowindow.open(map, this);

                });
                markers[i].marker = newMarker; // markers.marker kommer åt googlemaps-markern som objekt, tex markers[index].marker.setMap(null)
markers[i].infowindow = infowindow;
            }

     }}
	
  }


//---------------------------Twitter Funktioner------------------------------------

//--------------------- SKAPAR TWEETMARKERSARRAYEN FRÅN DATABASEN ----------------------------------------

function createTweetArray(inData, tempArray) {
    for (var i = 0; i < inData.length; i++) {
        var currentMarker = [];
        currentMarker.latitude = inData[i].Latitude;
        currentMarker.longitude = inData[i].Longitude;
        currentMarker.user = inData[i].user;
        currentMarker.text = inData[i].Text;
        currentMarker.date = new Date(inData[i].jsdate);    
        tempArray.push(currentMarker);

    }
}
//-------------------- SKAPAR HEATMAPARRAY FRÅN DATABASEN ----------------------
function createHeatmapArray() {
    for (var i = 0; i < tweets.length; i++) {

        //console.log(tweets[i].Latitude);
        var LatLng = new google.maps.LatLng(tweets[i].latitude, tweets[i].longitude);
        heatmapData.push(LatLng);
    }
}
//--------------------- SÄTTER PÅ HEATMAP VISUALIZATION ----------------

function setHeatMap() {
    heatmap = new google.maps.visualization.HeatmapLayer({
  data: heatmapData,
  radius: 35,
    gradient: [
        'rgba(171, 211, 231,0)',
        'rgb( 158, 205, 245)',
        'rgb( 130, 194, 243)',
        'rgb(106, 182, 240)',
        'rgb(85, 172, 238)',
        'rgb(62, 162, 234)',
        'rgb(39, 151, 231)',
        'rgb(24, 139, 220)',
        'rgb(22, 124, 197)'






       ]

});
    
}
//--------------------------SKAPAR EN TWEET MARKER---------------------------
function createOneMarker(index){
           
        var newMarker = new google.maps.Marker({
            position: new google.maps.LatLng(tweets[index].latitude, tweets[index].longitude),
            map: null,
            icon: "img/mapicons/twittersmall.png",
            title: tweets[index].contenString,
            animation: null //google.maps.Animation.BOUNCE
        });
        tweetMarkers.push(newMarker);
        google.maps.event.addListener(newMarker, 'click', function () {
            tweetInfowindow.setContent(this.title);
            tweetInfowindow.open(map, this);
        });

}
//------------------------SÄTTER UT TWEETMARKERS FRÅN ARRAYEN TILL KARTAN-----------------------------
function createTweetMarkerArray() {
    tweetInfowindow = new google.maps.InfoWindow();
    for (var i = 0; i < tweets.length; i++) {
        createOneMarker(i);
    }
}
//-----------------------------------TWEETINFOWINDOW--------------------------
function createTweetInfoWindow() {
    for (var i = 0; i < tweets.length; i++) {
        tweets[i].contenString = '<div id="content">' +
                '<h1 >' + tweets[i].text + '</h1>' +
                '<div id="bodyContent">' +
                '<p>' + 'Tweet ' + ' av ' + tweets[i].user + ' vid ' + tweets[i].date + '</p>' +
                '</div>' +
                '</div>';
    }
}

//------------------------------------TA BORT/VISAR TWEETS FRÅN KARTA--------------------------
function showMarkers(){
    for (var i = 0; i < tweetMarkers.length; i++) {
        tweetMarkers[i].setMap(map);
    }
}
function hideMarkers(){
    for (var i = 0; i < tweetMarkers.length; i++) {
        tweetMarkers[i].setMap(null);
    }
}


function hideHeatmap() {
    heatmap.setMap(null);
}
function showHeatmap() {
    heatmap.setMap(map);
}






//-----------------CIRKLAR FÖR CYKELNODER----------------------//  
function circleToMap(){
	
    for (var i = 0; i < markers.length; i++) {
	
	if (markers[i].category == "nodes") {
    markers[i].postion = new google.maps.LatLng(markers[i].latitude, markers[i].longitude);
	
	var today = "2014-11-15";
	//var today = new Date();
	//yyyymmdd =today.toISOString().substring(0, 10);

	
	var amount = markers[i].data[today];
	//var amount = 3000;	
	var p = amount/50;
	if(p>100){p=100;}
	var color = numberToColorHsl(p);
	

    var circleOptions = {
      strokeColor: color,
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: color,
      fillOpacity: 0.35,
      map: map,
      id: i,
      center: markers[i].postion,
      radius: Math.sqrt(amount) * 3
    };
    // Add the circle with radius and color depending on the amount of bikes to the map.	
    circle = new google.maps.Circle(circleOptions);
   
    circles[circles.length] = circle;
 var infowindow = new google.maps.InfoWindow({
                   
                });

    google.maps.event.addListener(circle, 'click', (function(circle, i) {
        return function() {
            infowindow.setContent('<div id="content">' +
        '<p >' + markers[i].title + '</p><p>Cyklister idag: '+markers[i].data[today] +'</p></div>');
            infowindow.setPosition(circle.getCenter());
            infowindow.open(map);
        }
      })(circle, i));
}

}}



//--------------ÄNDRA FÄRG FÅR RÖD TILL GRÖN BEROENDE PÅ ETT TAL MELLAN 0-100---------//
function hslToRgb(h, s, l){
    var r, g, b;

    if(s == 0){
        r = g = b = l; // achromatic
    }else{
        function hue2rgb(p, q, t){
            if(t < 0) t += 1;
            if(t > 1) t -= 1;
            if(t < 1/6) return p + (q - p) * 6 * t;
            if(t < 1/2) return q;
            if(t < 2/3) return p + (q - p) * (2/3 - t) * 6;
            return p;
        }

        var q = l < 0.5 ? l * (1 + s) : l + s - l * s;
        var p = 2 * l - q;
        r = hue2rgb(p, q, h + 1/3);
        g = hue2rgb(p, q, h);
        b = hue2rgb(p, q, h - 1/3);
    }

    return [Math.floor(r * 255), Math.floor(g * 255), Math.floor(b * 255)];
}

// convert a number to a color using hsl
function numberToColorHsl(i) {
    // as the function expects a value between 0 and 1, and red = 0° and green = 120°
    // we convert the input to the appropriate hue value
    var hue = i * 1.2 / 360;
    // we convert hsl to rgb (saturation 100%, lightness 50%)
    var rgb = hslToRgb(hue, 1, .5);
    // we format to css value and return
    return 'rgb(' + rgb[0] + ',' + rgb[1] + ',' + rgb[2] + ')'; 
}

//-------------HÖGSTA ANTAL CYKLISTER PÅ EN DAG, CYKELNODER---------------------------//
function maxBicycles(input){
var min = Infinity; 
var max = -Infinity; 
var x;
for( x in input) {
    if( input[x] < min) min = input[x];
    if( input[x] > max) max = input[x];
}
alert(max);
}




//-------------------------- ÖVRIGA FUNKTIONER-------------------------------------	


        function hideCategory(category) {
	if(category=="nodes"){
	 for (i = 0; i < circles.length; i++){
	circles[i].setMap(null);}
}else{
            for (i = 0; i < markers.length; i++) {
                if (markers[i].category == category) {
                    markers[i].marker.setMap(null);
                }
            }
        }}

        function showCategory(category) {
	if(category=="nodes"){
	 for (i = 0; i < circles.length; i++){
	circles[i].setMap(map);}
}

else{
            for (i = 0; i < markers.length; i++) {
                if (markers[i].category == category) {
                    markers[i].marker.setMap(map);
                }
            }
        }}

        function switchCheckbox(checkBox) {

            if (checkBox.checked) {
                showCategory(checkBox.value);
            }
            else {
                hideCategory(checkBox.value);
            }
        }

        function clearMap(checkbox) {
            

                for (i = 0; i < checkbox.length;i++){
                    checkbox[i].checked=false;

                }

               for (j = 0; j< checkbox.length;j++){
                hideCategory(checkbox[j].value);
                }

                setBicycleRoad("roads");
                cleanMap();
                


        }

	
function openInfoWindow(title){
 	for(var i = 0; i < markers.length; i++){

 		 if(markers[i].title == title){
		//console.log('inne i openinfowindow');
		//google.map.event.trigger(markers[i].marker, 'click');
		//markers[i].infowindow.open(map, markers[i].marker);
		map.panTo(markers[i].postion);

  }
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

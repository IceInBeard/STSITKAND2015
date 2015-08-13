    var tweets = [];
    var heatmapData = [];
    var map;
    var heatmap;
    var tweetMarkers = [];
    var tweetInfowindow;// = new google.maps.InfoWindow(
            //content: tweets[index].contenString
        //); 
$(document).ready(function () {
    heatmap = new google.maps.visualization.HeatmapLayer();
    createMap();
    
            
         


});



//----------------------------Skapa en karta -------------------------------------------------------
function createMap()
{
    var myCenter = new google.maps.LatLng(59.858698, 17.646150);
    var mapProp = {
        center: myCenter,
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.HYBRID,
        panControl: false,
        mapTypeControlOptions: {position: google.maps.ControlPosition.TOP_CENTER},
        zoomControlOptions: {position: google.maps.ControlPosition.RIGHT_CENTER}


    };
    map = new google.maps.Map(document.getElementById("map_container"), mapProp);

}

//--------------------- SKAPAR MARKERSARRAYEN FRÅN DATABASEN ----------------------------------------

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
        'rgba(192, 222, 237,0)',
        'rgb(29, 202, 255)', 
            'rgb(0, 172, 237)',
            'rgb( 0, 132, 180)'
       ]
});
    //heatmap.setMap(map);
}

//------------------------SÄTTER UT MARKERS FRÅN ARRAYEN TILL KARTAN-----------------------------
function createTweetMarkerArray() {
    tweetInfowindow = new google.maps.InfoWindow();
    for (var i = 0; i < tweets.length; i++) {
        createOneMarker(i);
    }
}

//------------------------SKAPA EN MARKER-----------------------------------------------
function createOneMarker(index){
           
        var newMarker = new google.maps.Marker({
            position: new google.maps.LatLng(tweets[index].latitude, tweets[index].longitude),
            map: null,
            icon: "twittersmall.png",
            title: tweets[index].contenString,
            animation: null //google.maps.Animation.BOUNCE
        });
        tweetMarkers.push(newMarker);
        google.maps.event.addListener(newMarker, 'click', function () {
            tweetInfowindow.setContent(this.title);
            tweetInfowindow.open(map, this);
        });

}

//------------------------SKAPAR INFOWINDOW-------------------------------------------------
function createInfoWindow() {
    for (var i = 0; i < tweets.length; i++) {
        tweets[i].contenString = '<div id="content">' +
                '<h1 >' + tweets[i].text + '</h1>' +
                '<div id="bodyContent">' +
                '<p>' + 'Tweet ' + ' av ' + tweets[i].user + ' vid ' + tweets[i].date + '</p>' +
                '</div>' +
                '</div>';
    }
}


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



function convertToDate(dateString) {

}


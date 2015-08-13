var week=["0", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
var map;
var pumpMarker=[];
var verkstadMarker=[];
var parkeringMarker=[];


var vegetationMarker=[];
var belaggningMarker=[];
var renhallningIssueMarker=[];

function onloading(){
    initialize();

    var sortedIssues = [];

    sortedIssues = sortIssues(issues);

  

    createMarkerArray(pump, pumpMarker,'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png' );
    createMarkerArray(verkstad, verkstadMarker, 'http://maps.google.com/mapfiles/ms/icons/purple-dot.png');
    createMarkerArray(cykelparkering, parkeringMarker, 'http://maps.google.com/mapfiles/ms/icons/green-dot.png');

    createIssueMarkerArray(sortedIssues[0], redIssueMarker);
   

    var date = new Date();
    var day = date.getDay();
    var today = week[day];

}

var myCenter=new google.maps.LatLng(59.858698, 17.646150);

function initialize()
{

var mapProp = {
  center:myCenter,
  zoom:15,
  mapTypeId:google.maps.MapTypeId.HYBRID,
  panControl:false,

 
  mapTypeControlOptions: {position: google.maps.ControlPosition.TOP_CENTER},
  zoomControlOptions: {position: google.maps.ControlPosition.RIGHT_CENTER}


  }; 
     map=new google.maps.Map(document.getElementById("map_container"),mapProp);

}


google.maps.event.addDomListener(window, 'load', initialize);

function sortIssues(data){
    var redIssues = [];
    var yellowIssues = [];
    var greenIssues = [];


    for (var i = 0; i < data.length; i++) {
        if(data[i].status == "red"){
            redIssues.push(data[i]);
        }else if(data[i].status == "yellow"){
            yellowIssues.push(data[i]);
        }else if(data[i].status == "green"){
            yellowIssues.push(data[i]);
        }else{
            alert(data[i]);
        }
    }

 return [redIssues , yellowIssues, greenIssues];

}


function createMarkerArray(data, list, markerColor) {

    for (var i = 0; i < data.length; i++) {

        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(data[i].latitude, data[i].longitude),
            icon: markerColor

        });

            var infowindow = new google.maps.InfoWindow({

            });
        var date = new Date();
        var day = date.getDay();
        var today = week[day];
        var desc = today +': '+ data[1].timeOpen.friday;

        google.maps.event.addListener(marker, 'click', (function (marker, i) {
            return function () {

                infowindow.setContent('<header><b>'+data[i].name+'</b></header></br><p><b>Info: </b>'+data[i].description+
                '</p></br><p><b>Telefon: </b> '+data[i].phoneNumber+ '</p></br><p>Öppet '+desc+'</p>');
                infowindow.open(map, marker);
            }
        })(marker, i));

        list.push(marker);
    }
}

function createIssueMarkerArray(data, list, markerColor) {
    var markerColor;
    var redMarker = 'http://maps.google.com/mapfiles/ms/icons/red-dot.png';
    var yellowMarker = 'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png';
    var greenMarker = 'http://maps.google.com/mapfiles/ms/icons/green-dot.png';


    for (var i = 0; i < data.length; i++) {

        if(data[i].status == "red"){
            markerColor = redMarker;
        }else if(data[i].status == "yellow"){
            markerColor = yellowMarker;
        }else if(data[i].status == "green"){
            markerColor = greenMarker;
        }

        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(data[i].latitude, data[i].longitude),
            icon: markerColor

        });

            var infowindow = new google.maps.InfoWindow({

            });
        
        google.maps.event.addListener(marker, 'click', (function (marker, i) {
            return function () {

                infowindow.setContent('<header><b>'+data[i].issuetype+'</b></header></br><p><b>Info: </b>'+data[i].description+
                '</p></br><p><b>Status: </b> '+data[i].status+ '</p></br><p>Tillagd: '+data[i].date+'</p>');
                infowindow.open(map, marker);
            }
        })(marker, i));

        list.push(marker);
    }
}



function addMarker(markerList){
    for (var i = 0; i < markerList.length; i++){
        markerList[i].setMap(map);
    }
}

function removeMarker(markerList){
    for(var i=0; i<markerList.length; i++){
        markerList[i].setMap(null);
    }
}


function checkPump(){
    if( document.getElementById("checkPumps").checked==true){
        addMarker(pumpMarker);
    }else{
        removeMarker(pumpMarker);
    }
}

function checkVerkstad(){
    if( document.getElementById("checkVerkstad").checked==true){
        addMarker(verkstadMarker);
    }else{
        removeMarker(verkstadMarker);
    }
}

function checkParkering(){
    if( document.getElementById("checkParkering").checked==true){
        addMarker(parkeringMarker);
    }else{
        removeMarker(parkeringMarker);
    }
}

function checkBelaggning(){
    if( document.getElementById("checkPumps").checked==true){
        addMarker(pumpMarker);
    }else{
        removeMarker(pumpMarker);
    }
}
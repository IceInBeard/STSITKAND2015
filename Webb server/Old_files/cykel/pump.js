/**
 * Created by arvidhogberg on 15-04-08.
 */
//@@ -0,0 +1,1001 @@



var week=["monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"];
var map;
var pumpMarker=[];
var verkstadMarker=[];
var parkingMarker=[];
var jsonPump = [];
var jsonShop = [];

function onloading(){

$.ajax({
    type: "GET",
    url: "mongodb.php",
    dataType: "json", // Set the data type so jQuery can parseit for you
    success: function (data) {
	//saveJson(data);
console.log(data["parking"][1]["json_geometry"]["coordinates"][1]);
alert(data["parking"][2].GATA_OMR\u00c5DE);
	createMarkerArray(data["verkstad"]["verkstad"], verkstadMarker, 'http://maps.google.com/mapfiles/ms/icons/purple-dot.png');
        //createMarkerArray(data["pump"]["pump"], pumpMarker,'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png' )
        createMarkerArray(data["parking"], pumpMarker,'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png' )
	//var holder = data["verkstad"]["verkstad"];
	//jsonShop=holder;
	
       

}
});

    console.log(jsonShop[0]);
    initialize();

    //createMarkerArray(phpData, pumpMarker,'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png' );
    //createMarkerArray(verkstad, verkstadMarker, 'http://maps.google.com/mapfiles/ms/icons/purple-dot.png');

    var date = new Date();
    var day = date.getDay();
    var today = week[day];

};

var myCenter=new google.maps.LatLng(59.858698, 17.646150);

function initialize()
{ 
    var mapProp = {
        center:myCenter,
        zoom:12,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };
     map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
}

google.maps.event.addDomListener(window, 'load', initialize);

function saveJson(data) {
    console.log("savejson");
    jsonPump = data["pump"]["pump"];
    jsonShop = data["verkstad"]["verkstad"];
}

function createMarkerArray(data, list, markerColor) {
    for (var i = 0; i < data.length; i++) {
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(data[i].latitude, data[i].longitude),
            icon: markerColor

        });

            var infowindow = new google.maps.InfoWindow({

            });
 

        google.maps.event.addListener(marker, 'click', (function (marker, i) {
            return function () {

                infowindow.setContent('<header><b>'+data[i].name+'</b></header>');
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
	console.log("checkpump")
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

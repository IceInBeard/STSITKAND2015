var dataSet = [];
var bicycleCategories = ["verkstad", "pump", "parking"];
var verkstadArray = [];
//Layers for bike-functionalities
var bikeLayer = new google.maps.BicyclingLayer();
var trafficLayer = new google.maps.TrafficLayer();

var loadedBicycles = false;
var loadedNodes = false;
var loadedNodesData = "false";
//--------------------LOAD BICYCLE, PARKING, PUMPS, SHOPS---------------//
function loadBicycles(){
if(loadedBicycles==false){
$.ajax({
    type: "GET",
    url: "http://stsitkand.student.it.uu.se/final/db/mongodb.php",
    dataType: "json", // Set the data type so jQuery can parse it for you
    success: function (data) {
	
	createMarkerArrayBicycle(data["verkstad"], markers, "verkstad");
	createMarkerArrayBicycle(data["pump"], markers, "pump");
	createMarkerArrayBicycle(data["parking"], markers, "parking");

	
        createInfoWindowBicycle();
        markersToMap(["verkstad", "pump", "parking"]);
        for (var i = 0; i < bicycleCategories.length; i++) {

                    hideCategory(bicycleCategories[i]);
                }

	createBicycleTable();
	loadedBicycles=true;     
}

});
}}

//------------------------LOAD BICYCLE NODES----------------------//
function loadBicyclesNodes(){
if(loadedNodes==false){
$.ajax({
    type: "GET",
    url: "http://stsitkand.student.it.uu.se/final/db/nodes.php",
    dataType: "json", // Set the data type so jQuery can parse it for you
    success: function (data) {
	
	createMarkerArrayBicycle(data["nodes"], markers, "nodes");
        
	loadedNodes=true;     
}

});
}}

//------------------------LOAD NODEDATA AMOUNT BICYCLES----------------------//
function loadNodesData(){
if(loadedNodesData=="false"){
$.ajax({
    type: "GET",
    url: "http://stsitkand.student.it.uu.se/final/db/nodes_data.php",
    dataType: "json", // Set the data type so jQuery can parse it for you
    success: function (data) {

	createMarkerArrayNodesData(data[0],  "Daghammarsköldsväg 31"); //daghammar
	createMarkerArrayNodesData(data[1],  "Hamnspången"); //hamspangen
	createMarkerArrayNodesData(data[2], "Resecentrum"); //resecentrum
	
	circleToMap();
	hideCategory("nodes");
	
	loadedNodesData="true";  

}

});
}}

//---------FÖR ATT RULLGARDIN SKA FUNGERA EFTER createTable()--------------//
function tableFunction(){

$('.header').click(function(){
		for(var i=0; i<verkstadArray.length; i++){
		if(i != this.id){
	    $('tr[class^=child-'+i).hide().children();}}
            $(this).siblings('.child-'+this.id).toggle('fast');
	openInfoWindow(verkstadArray[this.id].title);
	
        });
    $('tr[class^=child-]').hide().children('tr'); 


}
//------RULLGARDIN FÖR CYKELMODUL--------------------------//
$(document).ready(function(){

    $('.header').click(function(){
            $(this).siblings('.child-'+this.id).toggle('fast');
	    
	
        });
    $('tr[class^=child-]').hide().children('tr');
	 
});

//--------------SKAPA TABLE FÖR CYKELWIDGET------------------//
function createBicycleTable(){

var output='<table id="ServiceChopsTable"><tbody>'; 
    for(var i=0; i<markers.length; i++){   //create a array with only verkstad
	if(markers[i].category=="verkstad"){ 
    verkstadArray.push(markers[i]);}
    }
    verkstadArray = sortByKey(verkstadArray, "title"); //sort the verkstadArray by title
    for(var i=0; i<verkstadArray.length; i++){
    output+= '<tr class="header" id="'+i+'" > <td colspan="1">' + verkstadArray[i].title + '</td></tr>'
    +'<tr class="child-'+i+'"><td><div id="section"><div id="contact">'+verkstadArray[i].address+'<br>'+verkstadArray[i].phoneNumber+'<br>'+verkstadArray[i].email+'<br></div><div id="openingHours">Öppettider:<br>Måndag: '+verkstadArray[i].timeOpen.monday+'<br>Tisdag: '+verkstadArray[i].timeOpen.tuesday+'<br>Onsdag: '+verkstadArray[i].timeOpen.wednesday+'<br>Torsdag: '+verkstadArray[i].timeOpen.thursday+'<br>Fredag: '+verkstadArray[i].timeOpen.friday+'<br>Lördag: '+verkstadArray[i].timeOpen.saturday+'<br>Söndag: '+verkstadArray[i].timeOpen.sunday+'</div><br></div><div id="description"><br>' + verkstadArray[i].description +'<br>'+'</div></td></tr>'

    }
output+='</tbody></table>';
document.getElementById("ServiceShopTable").innerHTML=output;//output to the div "table"
tableFunction();
}

//------------SORT JSON BY KEY------------------------------//
function sortByKey(array, key) {
    return array.sort(function(a, b) {
        var x = a[key]; var y = b[key];
        return ((x < y) ? -1 : ((x > y) ? 1 : 0));
    });
}


//visa och dölj cykelvägar. 
function setBicycleLayers(checkBox) {			
		if (checkBox.checked) {
			if (checkBox.value=="roads") {
				bikeLayer.setMap(map);				
			}
			else {
				trafficLayer.setMap(map);
			}
		
		}
		else {
			if (checkBox.value=="roads") {
				bikeLayer.setMap(null);				
			}
			else {
				trafficLayer.setMap(null);
			}
		}

	}



function loadInfoWindow(id) {
	document.getElementById(id).style.display = ("block");
	console.log("loadInfoWindow");
}





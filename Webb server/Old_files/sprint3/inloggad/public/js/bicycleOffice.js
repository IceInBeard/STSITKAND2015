var issuesCategories = [];
var dataSet = [];
var dataOutput = [];
var categoryList=["verkstad","pump","parking","nodes"]

var loaded = "false";
var loadedNodes = "false";
var loadedNodesData = "false";
//--------------------LOAD BICYCLE, PARKING, PUMPS, SHOPS---------------//
function loadBicycles(){
if(loaded=="false"){
$.ajax({
    type: "GET",
    url: "http://stsitkand.student.it.uu.se/sprint3/db/mongodb.php",
    dataType: "json", // Set the data type so jQuery can parse it for you
    success: function (data) {
	//console.log(data["parking"][0].json_geometry.coordinates[1]);
	//console.log(data["pump"][0]);
	createMarkerArrayBicycle(data["verkstad"], markers, "verkstad");
	createMarkerArrayBicycle(data["pump"], markers, "pump");
	createMarkerArrayBicycle(data["parking"], markers, "parking");

	
        createInfoWindowBicycle();
        markersToMap(["verkstad", "pump", "parking"]);
	hideCategory("pump");
	hideCategory("parking");
	//createTable();
	//tableFunction();
	//createDataSet();
	loadList("verkstad");
	document.getElementById("verkstad").style.display = "block";
	loaded="true";     
}

});
}}

//------------------------LOAD BICYCLE NODES----------------------//
function loadBicyclesNodes(){
if(loadedNodes=="false"){
$.ajax({
    type: "GET",
    url: "http://stsitkand.student.it.uu.se/sprint3/db/nodes.php",
    dataType: "json", // Set the data type so jQuery can parse it for you
    success: function (data) {
	
	createMarkerArrayBicycle(data["nodes"], markers, "nodes");

        createInfoWindowBicycle();
	
	
	//createDataSet();

	loadedNodes="true";     
}

});
}}


//------------------------LOAD NODEDATA AMOUNT BICYCLES----------------------//
function loadNodesData(){
if(loadedNodesData=="false"){
$.ajax({
    type: "GET",
    url: "http://stsitkand.student.it.uu.se/sprint3/db/nodes_data.php",
    dataType: "json", // Set the data type so jQuery can parse it for you
    success: function (data) {

	createMarkerArrayNodesData(data[0],  "Daghammarsköldsväg 31"); //daghammar
	createMarkerArrayNodesData(data[1],  "Hamnspången"); //hamspangen
	createMarkerArrayNodesData(data[2], "Resecentrum"); //resecentrum
	//alert("klar med nodes data");
	circleToMap();
	hideCategory("nodes");
	createDataSet();
	loadList("verkstad");
	
	loadedNodesData="true";  

}

});
}}

//--------------ONLOAD IN CYKELWIDGET.HTML--------------//
function loading(){
initMap();
loadBicycles();

loadBicyclesNodes();
loadNodesData();


    



}


//---------FÖR ATT RULLGARDIN SKA FUNGERA EFTER createTable()--------------//
function tableFunction(){
$('.header').click(function(){
            $(this).siblings('.child-'+this.id).toggle('fast');
        });
    $('tr[class^=child-]').hide().children('tr'); 

}
/*/------RULLGARDIN FÖR CYKELMODUL--------------------------//
$(document).ready(function(){

    $('.header').click(function(){
            $(this).siblings('.child-'+this.id).toggle('fast');
        });
    $('tr[class^=child-]').hide().children('tr'); 
});
*/

//--------------SKAPA TABELL FÖR CYKELWIDGET------------------//
function createTable(){
var verkstadArray = [];
var output='<table id="ServiceChopsTable"><tbody>'; 
	for(var i=0; i<markers.length; i++){   //create a array with only verkstad
	if(markers[i].category=="verkstad"){ 
	verkstadArray.push(markers[i]);}
	}
	verkstadArray = sortByKey(verkstadArray, "title"); //sort the verkstadArray by title
	for(var i=0; i<verkstadArray.length; i++){
	output+= '<tr class="header" id="'+i+'"> <td colspan="1">' + verkstadArray[i].title + '</td></tr>'
	+'<tr class="child-'+i+'"><td><div id="section"><div id="contact">'+verkstadArray[i].address+'<br>'+verkstadArray[i].phoneNumber+'<br>'+verkstadArray[i].email+'</div><div id="openingHours">Öppettider:<br>Måndag: '+verkstadArray[i].timeOpen.monday+'<br>Tisdag: '+verkstadArray[i].timeOpen.tuesday+'<br>Onsdag: '+verkstadArray[i].timeOpen.wednesday+'</div><br></div><div id="description">Beskrivning:' + verkstadArray[i].description +'<br>'+'</div></td></tr>'

	}
output+='</tbody></table>'
document.getElementById("table").innerHTML=output;//output to the div "table"
}

//------------SORT JSON BY KEY------------------------------//
function sortByKey(array, key) {
    return array.sort(function(a, b) {
        var x = a[key]; var y = b[key];
        return ((x < y) ? -1 : ((x > y) ? 1 : 0));
    });
}


//--------------------DATASET--------------------------------
function createDataSet() {
	dataSet=[];
    //här sätts datan in från markers till dataSet som alltså är datan som hamnar i table.
    for(var i = 0; i < markers.length; i++){
	if(markers[i].category=="verkstad"){
var newTableRow = [markers[i].id,markers[i].category, markers[i].title, markers[i].address,markers[i].phoneNumber, markers[i].timeOpen, markers[i].email, markers[i].latitude+", "+ markers[i].longitude];
       
        dataSet.push(newTableRow);
        }else if(markers[i].category=="pump"){
	var newTableRow = [markers[i].id, markers[i].category, markers[i].title, markers[i].latitude+", <br>"+ markers[i].longitude];
       
        dataSet.push(newTableRow);
	}else if(markers[i].category=="parking"){
	var newTableRow = [markers[i].id, markers[i].category,  markers[i].address, markers[i].amount, markers[i].latitude+", <br>"+ markers[i].longitude];
       
        dataSet.push(newTableRow);
}else if(markers[i].category=="nodes"){
	var today = "2014-11-15";
	//var today = new Date();
	//yyyymmdd =today.toISOString().substring(0, 10);
	var newTableRow = [markers[i].id, markers[i].category, markers[i].title, markers[i].data[today], markers[i].latitude+", <br>"+ markers[i].longitude];
       
        dataSet.push(newTableRow);
	}
}
}

//----------function för att ladda lista i backoffice-------//
function loadList(category){
    

showCategory([category]);
var dataOutputs=[];
if(category=="verkstad"){
        var columns= [
	    { "title": "ID" },
            { "title": "Kategori" },
            { "title": "Namn" },
            { "title": "Adress" },
            { "title": "Telefon"},
            { "title": "Öppet"},
            { "title": "Email"},
	    { "title": "Koordinater"},
	   
];
	
}else if(category=="pump"){
            var columns= [
		{ "title": "ID" },
                {"title": "Kategori"},
                {"title": "Namn"},
                { "title": "Koordinater"},
		
            ]
}else if(category=="parking"){
            var columns= [
		{ "title": "ID" },
                {"title": "Kategori"},
                {"title": "Adress"},
		{"title": "Platser"},
                { "title": "Koordinater"},
		
            ]}else if(category=="nodes"){
            var columns= [
		{ "title": "ID" },
                {"title": "Kategori"},
		{"title": "Namn"},
		{"title": "Antal"},
                { "title": "Koordinater"},
		
            ]}
for(var i=0; i<dataSet.length; i++){
	if(dataSet[i][1]==category){
	dataOutputs.push(dataSet[i]);
}
}
	document.getElementById("detailedMarkerInfo").style.display = "none";

    $('#tablediv').html( '<table cellpadding="0" cellspacing="0" border="0" class="display" id="issue-table"></table>' );

    $('#issue-table').dataTable( {
	"pageLength" : 10,
        "data": dataOutputs,
        //"scrollY": "200px",              //om man vill ha scroll
        // "paging": false,                  //utan sidor
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "columns": columns,
	"columnDefs": [ {
         "targets": -1,
         "className": 'details-control',
			"defaultContent": "<img src='https://cdn0.iconfinder.com/data/icons/opensourceicons/32/edit.png' alt='Redigera' height='32' width='32'>"
            
        } ]
    } );
    //ta in datan från den skapade html till javascript igen så att man akn manipulera den
    var table = $('#issue-table').DataTable();
		//onclick på knappen 
	$('#issue-table').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
		//editRow(row);
	alert("Denna funktion är inte implementerad än");
} );

// Dölj ID columnen 
    var column = table.column(0);
    // Toggle the visibility
    column.visible( ! column.visible() );

// Dölj Kategori columnen 
    var columnK = table.column(1);
    // Toggle the visibility
    columnK.visible( ! columnK.visible() );
    

    //select och unselect på onclick
    $('#issue-table').on( 'click', 'tr', function () {
	console.log(this);
	var thisMarker = table.row(this).data();
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
		unZoom(thisMarker[1]);
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
		var thisID = (thisMarker[0]);
		zoomMarker(thisID);
	
        }
    } );
    /*/delet button
    $('#button').click( function () {
        table.row('.selected').remove().draw( false );
    } );

    //visa och dölj kategori baserat på nummret som länken har i html: data-column="0" osv är det som gäller.
    $('a.toggle-vis').on( 'click', function (e) {
        e.preventDefault();

        // Get the column API object
        var column = table.column( $(this).attr('data-column') );

        // Toggle the visibility
        column.visible( ! column.visible() );
    } );*/

}
function unZoom(category){
	initMap();
	if(category=="nodes"){
	circleToMap();}else{
	markersToMap([category]);}

	
}

function zoomMarker(index){
var zoomer;
var categoryTemp;
//IF-sats för nodes använd CircleToMap()
 	for(var i = 0; i < markers.length; i++){
	
 		 if(markers[i].id == index){
			categoryTemp=markers[i].category
		if(markers[i].category=="parking"){

		zoomer = 18;}
		else{ zoomer = 15;}

	var mapCenter = new google.maps.LatLng(markers[i].latitude, markers[i].longitude);
    var mapOptions = {
        center: mapCenter,
        zoom: zoomer,
        scrollwheel: false,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.LARGE,
            position: google.maps.ControlPosition.RIGHT_CENTER
        }
    };
    map = new google.maps.Map(document.getElementById('miniMap'),
        mapOptions);
	updateMarkerInfo(markers[i] , categoryTemp);
	document.getElementById("detailedMarkerInfo").style.display = "block";
           		
 			}
		}
	if(categoryTemp=="nodes"){
	circleToMap();}else{
	markersToMap([categoryTemp]);}}

//--------------------------------------WHAT'S IN INFOWINDOW?----------------------------//

function updateMarkerInfo(thisMarker , category){
		//console.log(thisMarker);
		if(category=="parking"){

			var upperInfo;
			var latling;
			var hoursOpen;

			upperInfo= '<p>Adress</p><input type="text" id="id_adress" value="'+ thisMarker.address +'"></input>';
		        upperInfo+='<p>ID</p><input type="text" id="id_mongo" value="'+thisMarker.id+'"></input>';
			upperInfo+='<p>Antal platser: <input type="text" id="id_amount" value="'+thisMarker.amount+'"></input></p><p></p>';
			latling = '<tr><td><strong>Latitud,</strong></td><td><strong>Longitud</strong></td></tr><tr><td><input type="text" size="3" id="id_latitude" value="'+thisMarker.latitude+'"></input>,</td><td><input type="text" size="3" id="id_longitude" value="'+thisMarker.longitude+'"></input></td></tr>';
			hoursOpen = '';

			document.getElementById("upperInfo").innerHTML = upperInfo;
			document.getElementById("latling").innerHTML = latling;
			document.getElementById("hoursOpen").innerHTML = hoursOpen;

			document.getElementById("update_bicycle").onclick =  function() { updateParking(thisMarker.id); };
			document.getElementById("remove_Bicycleoffice").onclick =  function() { removeChoice(thisMarker.id); };

		}else if(category=="verkstad"){
			var upperInfo;
			var latling;
			var hoursOpen;
			upperInfo= '<p>Namn</p><input type="text" id="id_name" value="'+ thisMarker.title +'"></input>';
		        upperInfo+='<p>ID</p><input type="text" id="id_mongo" value="'+thisMarker.id+'"></input>';
			upperInfo+= '<p>Adress</p><input type="text" id="id_adress" value="'+thisMarker.address+'"></input>';
			upperInfo+= '<p>Telefonnummer</p><input type="text" id="id_phoneNumber" value="'+thisMarker.phoneNumber+'"></input>';
			upperInfo+= '<p>Email</p><input type="text" id="id_email" value="'+thisMarker.email+'"></input>';
			upperInfo+= '<p>Hemsida</p><input type="text" id="id_website" value="'+thisMarker.website+'"></input>';
	
			latling= '<tr><td><strong>Latitud,</strong></td><td><strong>Longitud</strong></td></tr><tr><td><input type="text" size="3" id="id_latitude" value="'+thisMarker.latitude+'"></input>,</td><td><input type="text" size="3" id="id_longitude" value="'+thisMarker.longitude+'"></input></td></tr>';

			hoursOpen = '<tr><th><strong>Öppettider:</strong></th></tr><tr><td>Måndag</td><td><input type="text" size="3" id="id_openMonday" value="'+thisMarker.timeOpen.monday+'"></input></td></tr><tr><td>Tisdag</td><td><input type="text" size="3" id="id_openTuesday" value="'+thisMarker.timeOpen.tuesday+'"></input></td></tr><tr><td>Onsdag</td><td><input type="text" size="3" id="id_openWednesday" value="'+thisMarker.timeOpen.wednesday+'"></input></td></tr><tr><td>Torsdag</td><td><input type="text" size="3" id="id_openThursday" value="'+thisMarker.timeOpen.thursday+'"></input></td></tr><tr><td>Fredag</td><td><input type="text" size="3" id="id_openFriday" value="'+thisMarker.timeOpen.friday+'"></input></td></tr><tr><td>Lördag</td><td><input type="text" size="3" id="id_openSaturday" value="'+thisMarker.timeOpen.saturday+'"></input></td></tr><tr><td>Söndag</td><td><input type="text" size="3" id="id_openSunday" value="'+thisMarker.timeOpen.sunday+'"></input></td></tr>';

			document.getElementById("upperInfo").innerHTML = upperInfo;
			document.getElementById("latling").innerHTML = latling;
			document.getElementById("hoursOpen").innerHTML = hoursOpen;

			document.getElementById("update_bicycle").onclick =  function() { updateVerkstad(thisMarker.id); };
			document.getElementById("remove_Bicycleoffice").onclick =  function() { removeChoice(thisMarker.id); };
			


		}else if(category=="pump"){

			var upperInfo;
			var latling;
			var hoursOpen;

			upperInfo= '<p>Namn</p><input type="text" id="id_name" value="'+ thisMarker.title +'"></input>';
			upperInfo+='<p>ID</p><input type="text" id="id_mongo" value="'+thisMarker.id+'"></input>';
			latling = '<tr><td><strong>Latitud,</strong></td><td><strong>Longitud</strong></td></tr><tr><td><input type="text" size="3" id="id_latitude" value="'+thisMarker.latitude+'"></input>,</td><td><input type="text" size="3" id="id_longitude" value="'+thisMarker.longitude+'"></input></td></tr>';
			hoursOpen='';

			document.getElementById("upperInfo").innerHTML = upperInfo;
			document.getElementById("latling").innerHTML = latling;
			document.getElementById("hoursOpen").innerHTML = hoursOpen;
			document.getElementById("hoursOpen").innerHTML = hoursOpen;

			document.getElementById("update_bicycle").onclick =  function() { updatePump(thisMarker.id); };
			document.getElementById("remove_Bicycleoffice").onclick =  function() { removeChoice(thisMarker.id); };
			//document.getElementById("lowerInfo").innerHTML = ("<p>Status: Fungerar</p>");

		}else if(category=="nodes"){
			var today = "2014-11-15";
	//var today = new Date();
	//yyyymmdd =today.toISOString().substring(0, 10);
			document.getElementById("name").innerHTML = ("<p>"+thisMarker.title+"</p><p></p>");
			document.getElementById("lowerInfo").innerHTML = ("<p>Antal cyklister idag:</p><p>"+thisMarker.data[today]+"</p>");



		}
		//document.getElementById("description").innerHTML = ("<p>"+thisMarker.description+"</p>");
	
		
		
	}
//-----------------------------Update Server----------------------------
function updateVerkstad(){
	var id = document.getElementById("id_mongo").value;
	var name = document.getElementById("id_name").value;
	var address = document.getElementById("id_adress").value;
	var phoneNumber = document.getElementById("id_phoneNumber").value;      
     	var email = document.getElementById("id_email").value;
	var website = document.getElementById("id_website").value;
	var latitude = document.getElementById("id_latitude").value;
	var longitude = document.getElementById("id_longitude").value;
	var monday = document.getElementById("id_openMonday").value;
	var tuesday = document.getElementById("id_openTuesday").value;
	var wednesday = document.getElementById("id_openWednesday").value;
	var thursday = document.getElementById("id_openThursday").value;
	var friday = document.getElementById("id_openFriday").value;
	var saturday = document.getElementById("id_openSaturday").value;
	var sunday = document.getElementById("id_openSunday").value;

	console.log(phoneNumber);
    $.post("http://stsitkand.student.it.uu.se/sprint3/inloggad/public/database/updateBicycleMongodb.php", {
	id: id,
	name: name,
	address: address,
        phoneNumber: phoneNumber,
	email: email,
	website: website,
	latitude: latitude,
	longitude: longitude,
	monday: monday,
	tuesday: tuesday,
	wednesday: wednesday,
	thursday: thursday,
	friday: friday,
	saturday: saturday,
	sunday: sunday,

    action: "updateVerkstad"
      
    }, function(data) {
	console.log(data);
		//var dataObj = JSON.parse(data);
        //updateMarkerArray(dataObj, issuesCategories);
	console.log("UpdateVerkstad i slutet");
	updateOneMarker(id);
	createDataSet();
	loadList("verkstad");
    });
}

function updatePump(){
	var id = document.getElementById("id_mongo").value;
	var name = document.getElementById("id_name").value;
	var latitude = document.getElementById("id_latitude").value;
	var longitude = document.getElementById("id_longitude").value;

	console.log(id);

    $.post("http://stsitkand.student.it.uu.se/sprint3/inloggad/public/database/updateBicycleMongodb.php", {
	id:id,
	name: name,
	latitude: latitude,
	longitude: longitude,
	/*timeOpen.monday: timeOpen.monday,
	timeOpen.tuesday: timeOpen.tuesday,
	timeOpen.wednesday: timeOpen.wednesday,
	timeOpen.thursday: timeOpen.thursday,
	timeOpen.friday: timeOpen.friday,
	timeOpen.saturday: timeOpen.saturday,
	timeOpen.sunday: timeOpen.sunday*/
        action: "updatePump"
      
    }, function(data) {
	//console.log(data);
		//var dataObj = JSON.parse(data);
        //updateMarkerArray(dataObj, issuesCategories);
	console.log("UpdatePump i slutet");
	updateOneMarker(id);
	createDataSet();
	loadList("pump");
    });
}

function updateParking(){
	var id = document.getElementById("id_mongo").value;
	var address = document.getElementById("id_adress").value;
	var latitude = document.getElementById("id_latitude").value;
	var longitude = document.getElementById("id_longitude").value;
	var amount = document.getElementById("id_amount").value;

	console.log(id);
	console.log(address);
    $.post("http://stsitkand.student.it.uu.se/sprint3/inloggad/public/database/updateBicycleMongodb.php", {
	id: id,
	latitude: latitude,
	longitude: longitude,
	address: address,
	amount: amount,
        action: "updateParking"

    }, function(data) {
	//console.log(data);
		//var dataObj = JSON.parse(data);
        //updateMarkerArray(dataObj, issuesCategories);
	//console.log(action);
	updateOneMarker(id);
	createDataSet();
	loadList("parking");
    });
}
//----------------------------REMOVE FROM DATABASE-----------------------------------

function removeChoice(id){
	for (var i=0; i<markers.length; i++){
		if (markers[i].id==id) {
			if (markers[i].category=="pump") {
				console.log("inside pump remove");
				removePump();
			}
			else if (markers[i].category=="verkstad") {
				removeShop();
			}
			else {
				removeParking();
			}
		}
	}
	
}

function removeShop(){
	console.log("removeShopSucess");
	parent.$.fancybox.close();
	var index = document.getElementById("id_mongo").value;	 
	console.log(index);

    $.post("http://stsitkand.student.it.uu.se/sprint3/inloggad/public/database/removeBicycle.php", {
        id: index,
        action: "removeShop",
	}, function(data) {
		console.log("removesucess2"); 
		removeOneMarker(index);
		createDataSet();
		loadList("verkstad");
		document.getElementById("upperInfo").innerHTML = "";
		document.getElementById("latling").innerHTML = "";
		document.getElementById("hoursOpen").innerHTML = "";
	});
}

function removeParking(){
	console.log("removeParkingSucess");
	parent.$.fancybox.close();
	var index = document.getElementById("id_mongo").value;	 
	console.log(index);

    $.post("http://stsitkand.student.it.uu.se/sprint3/inloggad/public/database/removeBicycle.php", {
        id: index,
        action: "removeParking",
	}, function(data) {
		console.log("removesucess2"); 
		removeOneMarker(index);
		createDataSet();
		loadList("parking");
		document.getElementById("upperInfo").innerHTML = "";
		document.getElementById("latling").innerHTML = "";
		document.getElementById("hoursOpen").innerHTML = "";
	});
}

function removePump(){
	console.log("removePumpSucess");
	parent.$.fancybox.close();
	var index = document.getElementById("id_mongo").value;	 
	console.log(index);

    $.post("http://stsitkand.student.it.uu.se/sprint3/inloggad/public/database/removeBicycle.php", {
        id: index,
        action: "removePump",
	}, function(data) {
		console.log("removesucess2"); 
		removeOneMarker(index);
		createDataSet();
		loadList("pump");
		document.getElementById("upperInfo").innerHTML = "";
		document.getElementById("latling").innerHTML = "";
		document.getElementById("hoursOpen").innerHTML = "";
	});
}
//-------------UPDATE ONE MARKER---------------------------//
function updateOneMarker(index){
	for(var i = 0; i < markers.length; i++){
		if(markers[i].id == index){
			if(markers[i].category=="verkstad"){
				//console.log(document.getElementById("id_name").value);
				markers[i].id = document.getElementById("id_mongo").value;
				markers[i].title = document.getElementById("id_name").value;
				markers[i].address = document.getElementById("id_adress").value;
				markers[i].phoneNumber = document.getElementById("id_phoneNumber").value;    
			     	markers[i].email = document.getElementById("id_email").value;
				markers[i].website = document.getElementById("id_website").value;
				markers[i].latitude = document.getElementById("id_latitude").value;
				markers[i].longitude = document.getElementById("id_longitude").value;
	
			}else if(markers[i].category=="pump"){
				markers[i].id = document.getElementById("id_mongo").value;
				markers[i].title = document.getElementById("id_name").value;

				markers[i].latitude = document.getElementById("id_latitude").value;
				markers[i].longitude = document.getElementById("id_longitude").value;

			}else if(markers[i].category=="parking"){
				markers[i].id = document.getElementById("id_mongo").value;
				markers[i].address = document.getElementById("id_adress").value;
				markers[i].latitude = document.getElementById("id_latitude").value;
				markers[i].longitude = document.getElementById("id_longitude").value;
				markers[i].amount = document.getElementById("id_amount").value;

			}else {
			}
		}
	}
}
//----------REMOVE REMOVED OBJECT FROM ARRAY-------------//
function removeOneMarker(index){
	for(var i = 0; i < markers.length; i++){

		if(markers[i].id == index){
			markers.splice(i, 1);
			//thisMarker = markers[i];
		}
	}
}

//-----------------CREATE NEW SHOP/PUMP/PARKINGSPOT--------------------------//

function createShop(){
	var name = document.getElementById("newName-textbox").value;
	var address = document.getElementById("newAddress-textbox").value;
	var phoneNumber = document.getElementById("newPhoneNumber-textbox").value;      
 	var email = document.getElementById("newEmail-textbox").value;
	var website = document.getElementById("newWebsite-textbox").value;
	var latitude = document.getElementById("newLatitude-textbox").value;
	var longitude = document.getElementById("newLongitude-textbox").value;
	var description = document.getElementById("newDesc-textbox").value;
	var monday = document.getElementById("newMonday-textbox").value;
	var tuesday = document.getElementById("newTuesday-textbox").value;
	var wednesday = document.getElementById("newWednesday-textbox").value;
	var thursday = document.getElementById("newThursday-textbox").value;
	var friday = document.getElementById("newFriday-textbox").value;
	var saturday = document.getElementById("newSaturday-textbox").value;
	var sunday = document.getElementById("newSunday-textbox").value;

	console.log(phoneNumber);
    $.post("http://stsitkand.student.it.uu.se/sprint3/inloggad/public/database/createBicycleMongodb.php", {
	
	name: name,
	address: address,
    phoneNumber: phoneNumber,
	email: email,
	website: website,
	latitude: latitude,
	longitude: longitude,
	description: description,
	monday: monday,
	tuesday: tuesday,
	wednesday: wednesday,
	thursday: thursday,
	friday: friday,
	saturday: saturday,
	sunday: sunday,

        action: "createVerkstad"
      
    }, function(data) {
	console.log(data);
		//var dataObj = JSON.parse(data);
        //updateMarkerArray(dataObj, issuesCategories);
	console.log("CreateVerkstad i slutet");
	document.getElementById("newShop-div").innerHTML = "<p>Du har nu lagt till en ny verkstad.</p><a href='http://stsitkand.student.it.uu.se/sprint3/inloggad/public/cykel.php' target='_parent'><button>Klar</button></a>";
	//loadList("verkstad");
    });
}

function createPump(){
	var name = document.getElementById("newName-textboxPump").value;
	var latitude = document.getElementById("newLatitude-textboxPump").value;
	var longitude = document.getElementById("newLongitude-textboxPump").value;
	
    $.post("http://stsitkand.student.it.uu.se/sprint3/inloggad/public/database/createBicycleMongodb.php", {
	name: name,
	latitude: latitude,
	longitude: longitude,

    action: "createPump"
      
    }, function(data) {
	console.log(data);
		//var dataObj = JSON.parse(data);
        //updateMarkerArray(dataObj, issuesCategories);
	console.log("CreatePump i slutet");
	document.getElementById("newPump-div").innerHTML = "<p>Du har nu lagt till en ny pump.</p><a href='http://stsitkand.student.it.uu.se/sprint3/inloggad/public/cykel.php' target='_parent'><button>Klar</button></a>"; 
    });
	//Här läggs in vad som ska göras när vi tryckt på "Klar"
}

function createParking(){
	var address = document.getElementById("newAddress-textboxParking").value;
	var capacity = document.getElementById("newCapacity-textboxParking").value;
	var latitude = document.getElementById("newLatitude-textboxParking").value;
	var longitude = document.getElementById("newLongitude-textboxParking").value;
	
    $.post("http://stsitkand.student.it.uu.se/sprint3/inloggad/public/database/createBicycleMongodb.php", {
	address: address,
	capacity: capacity,
	latitude: latitude,
	longitude: longitude,

    action: "createParking"
      
    }, function(data) {
	console.log(data);
		//var dataObj = JSON.parse(data);
        //updateMarkerArray(dataObj, issuesCategories);
	console.log("CreateParking i slutet");
	document.getElementById("newParking-div").innerHTML = "<p>Du har nu lagt till en ny parkering.</p><a href='http://stsitkand.student.it.uu.se/sprint3/inloggad/public/cykel.php' target='_parent'><button>Klar</button></a>";
    });
}

function loadCreateWindow(category){
	document.getElementById(category).style.display = ("block");
	
}

//---------------BUTTON--------------//



function switchButton(button){
	/*var buttonID =String("button"+button.value);
	var titel = document.getElementById(buttonID).Titel;
	//alert(titel);
	if(titel == "Checked"){
		//alert("buttonchecked");
		document.getElementById(buttonID).Titel = "Unchecked";
		document.getElementById(buttonID).style.background= "#b0bed9";
		*/
	
	loadList(button.value);
	unZoom(button.value);
	if(button.value!="nodes"){
	document.getElementById(button.value).style.display = "block";
	}
	
	for(var i=0; i<categoryList.length; i++){
	
	if(categoryList[i]!=button.value){
		if(categoryList[i]!="nodes"){
		document.getElementById(categoryList[i]).style.display = "none";}
		
		hideCategory(categoryList[i]);}}
		
	/*}else{
		//alert("buttonUNchecked");
		document.getElementById(buttonID).Titel = "Checked";
		document.getElementById(buttonID).style.background= "#005389";
		showCategory(button.value);
	}*/
	
	
}

 function closeFancybox() {
	 $.fancybox.close();
 }
























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
    url: "http://stsitkand.student.it.uu.se/final/db/mongodb.php",
    dataType: "json", // Set the data type so jQuery can parse it for you
    success: function (data) {

	createMarkerArrayBicycle(data["verkstad"], markers, "verkstad");
	createMarkerArrayBicycle(data["pump"], markers, "pump");
	createMarkerArrayBicycle(data["parking"], markers, "parking");

	
        createInfoWindowBicycle();
        markersToMap(["verkstad", "pump", "parking"]);
	hideCategory("pump");
	hideCategory("parking");

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
    url: "http://stsitkand.student.it.uu.se/final/db/nodes.php",
    dataType: "json", // Set the data type so jQuery can parse it for you
    success: function (data) {
	
	createMarkerArrayBicycle(data["nodes"], markers, "nodes");

    createInfoWindowBicycle();


	loadedNodes="true";     
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
	createDataSet();
	loadList("verkstad");
	
	loadedNodesData="true";  

}

});
}}

//--------------ONLOADING--------------//
function loading(){
initMap();
loadBicycles();

loadBicyclesNodes();
loadNodesData();

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
	var todayDate = new Date();
	var today =todayDate.toISOString().substring(0, 10);

		if(typeof markers[i].data[today] != "undefined"){
		var amount = markers[i].data[today];
		markers[i].amount = amount;
		if(amount==0){amount=20;}

		}else if(typeof markers[i].data[today] == "undefined") { 
		//console.log("inne i else");
		today = "2014-11-15";
		var amount = markers[i].data[today];
		markers[i].amount = amount; }
	
	var newTableRow = [markers[i].id, markers[i].category, markers[i].title, markers[i].amount, markers[i].latitude+", <br>"+ markers[i].longitude];
       
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
			latling = '<tr><td><strong>Latitud,</strong></td><td><strong>Longitud</strong></td></tr><tr><td><input type="text" id="id_latitude" value="'+thisMarker.latitude+'"></input>,</td><td><input type="text" id="id_longitude" value="'+thisMarker.longitude+'"></input></td></tr>';
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
	
			latling= '<tr><td><strong>Latitud,</strong></td><td><strong>Longitud</strong></td></tr><tr><td><input type="text" id="id_latitude" value="'+thisMarker.latitude+'"></input>,</td><td><input type="text" id="id_longitude" value="'+thisMarker.longitude+'"></input></td></tr>';

			hoursOpen = '<tr><th><strong>Öppettider:</strong></th></tr><tr><td>Måndag</td><td><input type="text" size="5" id="id_openMonday" value="'+thisMarker.timeOpen.monday+'"></input></td></tr><tr><td>Tisdag</td><td><input type="text" size="5" id="id_openTuesday" value="'+thisMarker.timeOpen.tuesday+'"></input></td></tr><tr><td>Onsdag</td><td><input type="text" size="5" id="id_openWednesday" value="'+thisMarker.timeOpen.wednesday+'"></input></td></tr><tr><td>Torsdag</td><td><input type="text" size="5" id="id_openThursday" value="'+thisMarker.timeOpen.thursday+'"></input></td></tr><tr><td>Fredag</td><td><input type="text" size="5" id="id_openFriday" value="'+thisMarker.timeOpen.friday+'"></input></td></tr><tr><td>Lördag</td><td><input type="text" size="5" id="id_openSaturday" value="'+thisMarker.timeOpen.saturday+'"></input></td></tr><tr><td>Söndag</td><td><input type="text" size="5" id="id_openSunday" value="'+thisMarker.timeOpen.sunday+'"></input></td></tr>';

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
			latling = '<tr><td><strong>Latitud,</strong></td><td><strong>Longitud</strong></td></tr><tr><td><input type="text" id="id_latitude" value="'+thisMarker.latitude+'"></input>,</td><td><input type="text" id="id_longitude" value="'+thisMarker.longitude+'"></input></td></tr>';
			hoursOpen='';

			document.getElementById("upperInfo").innerHTML = upperInfo;
			document.getElementById("latling").innerHTML = latling;
			document.getElementById("hoursOpen").innerHTML = hoursOpen;
			

			document.getElementById("update_bicycle").onclick =  function() { updatePump(thisMarker.id); };
			document.getElementById("remove_Bicycleoffice").onclick =  function() { removeChoice(thisMarker.id); };
		

		}else if(category=="nodes"){
			var hoursOpen;
			hoursOpen='';
			document.getElementById("hoursOpen").innerHTML = hoursOpen;
			document.getElementById("name").innerHTML = ("<p>"+thisMarker.title+"</p><p></p>");
			document.getElementById("upperInfo").innerHTML = ("<p>Antal cyklister idag:</p><p>"+thisMarker.amount+"</p>");



		}
	
	
		
		
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
    $.post("http://stsitkand.student.it.uu.se/final/inloggad/public/database/updateBicycleMongodb.php", {
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
	alert("Ändringarna är sparade");
    });
}

function updatePump(){
	var id = document.getElementById("id_mongo").value;
	var name = document.getElementById("id_name").value;
	var latitude = document.getElementById("id_latitude").value;
	var longitude = document.getElementById("id_longitude").value;

	console.log(id);

    $.post("http://stsitkand.student.it.uu.se/final/inloggad/public/database/updateBicycleMongodb.php", {
	id:id,
	name: name,
	latitude: latitude,
	longitude: longitude,

        action: "updatePump"
      
    }, function(data) {

	console.log("UpdatePump i slutet");
	updateOneMarker(id);
	createDataSet();
	loadList("pump");
	alert("Ändringarna är sparade");
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
    $.post("http://stsitkand.student.it.uu.se/final/inloggad/public/database/updateBicycleMongodb.php", {
	id: id,
	latitude: latitude,
	longitude: longitude,
	address: address,
	amount: amount,
        action: "updateParking"

    }, function(data) {

	updateOneMarker(id);
	createDataSet();
	loadList("parking");
	alert("Ändringarna är sparade");
    });
}
//----------------------------REMOVE FROM DATABASE-----------------------------------

function removeChoice(id){
	for (var i=0; i<markers.length; i++){
		if (markers[i].id==id) {
			if (markers[i].category=="pump") {

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
	
	var index = document.getElementById("id_mongo").value;	 
	

    $.post("http://stsitkand.student.it.uu.se/final/inloggad/public/database/removeBicycle.php", {
        id: index,
        action: "removeShop",
	}, function(data) {
		
		removeOneMarker(index);

		
		createDataSet();
		loadList("verkstad");
		document.getElementById("upperInfo").innerHTML = "";
		document.getElementById("latling").innerHTML = "";
		document.getElementById("hoursOpen").innerHTML = "";
		document.getElementById("remove-div").innerHTML = "<p>Du har nu raderat en verkstad.</p><button onclick='closeFancybox()' >Klar</button>";
		
	});
}

function removeParking(){
	
	var index = document.getElementById("id_mongo").value;	 
	

    $.post("http://stsitkand.student.it.uu.se/final/inloggad/public/database/removeBicycle.php", {
        id: index,
        action: "removeParking",
	}, function(data) {
		
		removeOneMarker(index);
		createDataSet();
		loadList("parking");
		document.getElementById("upperInfo").innerHTML = "";
		document.getElementById("latling").innerHTML = "";
		document.getElementById("hoursOpen").innerHTML = "";
		document.getElementById("remove-div").innerHTML = "<p>Du har nu raderat en parkering.</p><button onclick='closeFancybox()'>Klar</button>";
		
	});
}

function removePump(){
	
	var index = document.getElementById("id_mongo").value;	 
	
    $.post("http://stsitkand.student.it.uu.se/final/inloggad/public/database/removeBicycle.php", {
        id: index,
        action: "removePump",
	}, function(data) {
		
		removeOneMarker(index);
		createDataSet();
		loadList("pump");
		document.getElementById("upperInfo").innerHTML = "";
		document.getElementById("latling").innerHTML = "";
		document.getElementById("hoursOpen").innerHTML = "";
		document.getElementById("remove-div").innerHTML = "<p>Du har nu raderat en pump.</p><button onclick='closeFancybox()'>Klar</button>";
		

	});
}
//-------------UPDATE ONE MARKER---------------------------//
function updateOneMarker(index){
	for(var i = 0; i < markers.length; i++){
		if(markers[i].id == index){
			if(markers[i].category=="verkstad"){
				
				markers[i].id = document.getElementById("id_mongo").value;
				markers[i].title = document.getElementById("id_name").value;
				markers[i].address = document.getElementById("id_adress").value;
				markers[i].phoneNumber = document.getElementById("id_phoneNumber").value;    
			     	markers[i].email = document.getElementById("id_email").value;
				markers[i].website = document.getElementById("id_website").value;
				markers[i].latitude = document.getElementById("id_latitude").value;
				markers[i].longitude = document.getElementById("id_longitude").value;

				markers[i].timeOpen.monday = document.getElementById("id_openMonday").value;
				markers[i].timeOpen.tuesday = document.getElementById("id_openTuesday").value;
				markers[i].timeOpen.wednesday= document.getElementById("id_openWednesday").value;
				markers[i].timeOpen.thursday = document.getElementById("id_openThursday").value;
				markers[i].timeOpen.friday = document.getElementById("id_openFriday").value;
				markers[i].timeOpen.saturday = document.getElementById("id_openSaturday").value;
				markers[i].timeOpen.sunday= document.getElementById("id_openSunday").value;
			

	
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
			markers[i].marker.setMap(null);
			markers.splice(i, 1);
			
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
    $.post("http://stsitkand.student.it.uu.se/final/inloggad/public/database/createBicycleMongodb.php", {
	
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

	document.getElementById("newShop-div").innerHTML = "<p>Du har nu lagt till en ny verkstad.</p><a href='http://stsitkand.student.it.uu.se/final/inloggad/public/cykel.php' target='_parent'><button>Klar</button></a>";
	

    });
}

function createPump(){
	var name = document.getElementById("newName-textboxPump").value;
	var latitude = document.getElementById("newLatitude-textboxPump").value;
	var longitude = document.getElementById("newLongitude-textboxPump").value;
	
    $.post("http://stsitkand.student.it.uu.se/final/inloggad/public/database/createBicycleMongodb.php", {
	name: name,
	latitude: latitude,
	longitude: longitude,

    action: "createPump"
      
    }, function(data) {

	document.getElementById("newPump-div").innerHTML = "<p>Du har nu lagt till en ny pump.</p><a href='http://stsitkand.student.it.uu.se/final/inloggad/public/cykel.php' target='_parent'><button>Klar</button></a>"; 
    });

}

function createParking(){
	var address = document.getElementById("newAddress-textboxParking").value;
	var capacity = document.getElementById("newCapacity-textboxParking").value;
	var latitude = document.getElementById("newLatitude-textboxParking").value;
	var longitude = document.getElementById("newLongitude-textboxParking").value;
	
    $.post("http://stsitkand.student.it.uu.se/final/inloggad/public/database/createBicycleMongodb.php", {
	address: address,
	capacity: capacity,
	latitude: latitude,
	longitude: longitude,

    action: "createParking"
      
    }, function(data) {

	document.getElementById("newParking-div").innerHTML = "<p>Du har nu lagt till en ny parkering.</p><a href='http://stsitkand.student.it.uu.se/final/inloggad/public/cykel.php' target='_parent'><button>Klar</button></a>";
    });
}

function loadCreateWindow(category){
	document.getElementById(category).style.display = ("block");
	
}

//---------------BUTTON--------------//
function switchButton(button){
	
	loadList(button.value);
	unZoom(button.value);
	 $('#button'+button.value).css('background-color','#fff' );
         $('#button'+button.value).css('color', '#1f548e' );
	 $('#button'+button.value).hover(function() {
   			 $(this).css("background-color", "#fff").css("color", "#1f548e").css("border", "3px solid #1f548e");
			}).mouseleave(function() {
   			  $(this).css("background", "#fff").css("color",'#1f548e' ).css("border", "3px solid #1f548e");
			});
	

	if(button.value!="nodes"){
	document.getElementById(button.value).style.display = "block";
	}
	
	for(var i=0; i<categoryList.length; i++){
	
	if(categoryList[i]!=button.value){
		$('#button'+categoryList[i]).css('background-color','#1f548e');
		$('#button'+categoryList[i]).css('color', '#fff' );
		$('#button'+categoryList[i]).hover(function() {
   			 $(this).css("background-color", "#fff").css("color", "#1f548e").css("border", "3px solid #1f548e");
			}).mouseleave(function() {
   			  $(this).css("background", "#1f548e").css("color",'#fff' ).css("border", "3px solid #1f548e");
			});
	
		if(categoryList[i]!="nodes"){
		document.getElementById(categoryList[i]).style.display = "none";}
		
		hideCategory(categoryList[i]);}}
		
	
	
}

 function closeFancybox() {
	 $.fancybox.close();
 }



function validInputShop(){
var inputValid = true;
if($("#newName-textbox").val()==""){
	
	inputValid = false;
    $('#newName-textbox').css('border-color','#FF0000');
}if($("#newLatitude-textbox").val()==""){
	inputValid = false;
    $('#newLatitude-textbox').css('border-color','#FF0000');
}if($("#newLongitude-textbox").val()==""){
	inputValid = false;
    $('#newLongitude-textbox').css('border-color','#FF0000');

}
if(inputValid==true){
	
	createShop();	}

}

function validInputPump(){
var inputValid = true;
if($("#newName-textboxPump").val()==""){
	
	inputValid = false;
    $('#newName-textboxPump').css('border-color','#FF0000');
}if($("#newLatitude-textboxPump").val()==""){
	inputValid = false;
    $('#newLatitude-textboxPump').css('border-color','#FF0000');
}if($("#newLongitude-textboxPump").val()==""){
	inputValid = false;
    $('#newLongitude-textboxPump').css('border-color','#FF0000');

}
if(inputValid==true){
	
	createPump();	}

}


function validInputParking(){
var inputValid = true;
if($("#newAddress-textboxParking").val()==""){
	inputValid = false;
    $('#newAddress-textboxParking').css('border-color','#FF0000');

}if($("#newCapacity-textboxParking").val()==""){
	inputValid = false;
    $('#newCapacity-textboxParking').css('border-color','#FF0000');

}if($("#newLatitude-textboxParking").val()==""){
	inputValid = false;
    $('#newLatitude-textboxParking').css('border-color','#FF0000');

}if($("#newLongitude-textboxParking").val()==""){
	inputValid = false;
    $('#newLongitude-textboxParking').css('border-color','#FF0000');

}
if(inputValid==true){
	
	createParking();	}

}


















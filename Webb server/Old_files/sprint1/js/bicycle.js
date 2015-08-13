var dataSet = [];
var bicycleCategories = ["verkstad", "pump", "parking"];


var loadedBicycles = false;
var loadedNodes = false;
//--------------------LOAD BICYCLE, PARKING, PUMPS, SHOPS---------------//
function loadBicycles(){
if(loadedBicycles==false){
$.ajax({
    type: "GET",
    url: "http://stsitkand.student.it.uu.se/cykel/mongodb.php",
    dataType: "json", // Set the data type so jQuery can parse it for you
    success: function (data) {
	//console.log(data["parking"][0].json_geometry.coordinates[1]);
	console.log(data["pump"][0]);
	createMarkerArrayBicycle(data["verkstad"]["verkstad"], markers, "verkstad");
	createMarkerArrayBicycle(data["pump"], markers, "pump");
	createMarkerArrayBicycle(data["parking"], markers, "parking");

	
        createInfoWindowBicycle();
        markersToMap(["verkstad", "pump", "parking"]);
        for (var i = 0; i < bicycleCategories.length; i++) {

                    hideCategory(bicycleCategories[i]);
                }

	
	//createTable();
	//tableFunction();
	//loadList();
	loadedBicycles=true;     
}

});
}}

//------------------------LOAD BICYCLE NODES----------------------//
function loadBicyclesNodes(){
if(loadedNodes==false){
$.ajax({
    type: "GET",
    url: "http://stsitkand.student.it.uu.se/cykel/nodes.php",
    dataType: "json", // Set the data type so jQuery can parse it for you
    success: function (data) {
	
	createMarkerArrayBicycle(data["nodes"], markers, "nodes");

        createInfoWindowBicycle();
        markersToMap(["nodes"]);
        hideCategory("nodes");

	loadedNodes=true;     
}

});
}}

//--------------ONLOAD IN CYKELWIDGET.HTML--------------//
/*initMap();
loadBicycles();
//loadBicyclesNodes();
}*/


//---------FÖR ATT RULLGARDIN SKA FUNGERA EFTER createTable()--------------//
function tableFunction(){
$('.header').click(function(){
            $(this).siblings('.child-'+this.id).toggle('fast');
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

//--------------SKAPA TABELL FÖR CYKELWIDGET------------------//
function createTable(){
console.log("hrej");
var verkstadArray = [];
var output='<table id="ServiceChopsTable"><tbody>'; 
    for(var i=0; i<markers.length; i++){   //create a array with only verkstad
    if(markers[i].category=="verkstad"){ 
    verkstadArray.push(markers[i]);}
    }
    verkstadArray = sortByKey(verkstadArray, "title"); //sort the verkstadArray by title
    for(var i=0; i<verkstadArray.length; i++){
    output+= '<tr class="header" id="'+i+'"> <td colspan="1">' + verkstadArray[i].title + '</td></tr>'
    +'<tr class="child-'+i+'"><td><div id="section"><div id="contact">'+verkstadArray[i].address+'<br>'+verkstadArray[i].phoneNumber+'<br>'+verkstadArray[i].email+'<br></div><div id="openingHours">Öppettider:<br>Måndag: '+verkstadArray[i].timeOpen.monday+'<br>Tisdag: '+verkstadArray[i].timeOpen.tuesday+'<br>Onsdag: '+verkstadArray[i].timeOpen.wednesday+'</div><br></div><div id="description">Beskrivning:<br>' + verkstadArray[i].description +'<br>'+'</div></td></tr>'

    }
output+='</tbody></table>'
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


//--------------------DATASET--------------------------------
function createDataSet() {

    //här sätts datan in från markers till dataSet som alltså är datan som hamnar i table.
    for(var i = 0; i < markers.length; i++){
  
	if(markers[i].category=="verkstad"){
var newTableRow = [markers[i].id,markers[i].category, markers[i].title, markers[i].address,markers[i].phoneNumber, markers[i].timeOpen, markers[i].email, markers[i].latitude+", "+ markers[i].longitude];
       
        dataSet.push(newTableRow);
        }else if(markers[i].category=="pump"){
	var newTableRow = [markers[i].id, markers[i].category, markers[i].title, markers[i].address, markers[i].timeOpen, markers[i].latitude+", "+ markers[i].longitude];
       
        dataSet.push(newTableRow);
	}else if(markers[i].category=="parking"){
	var newTableRow = [markers[i].id, markers[i].category, markers[i].title, markers[i].address, markers[i].amount, markers[i].latitude+", "+ markers[i].longitude];
       
        dataSet.push(newTableRow);
}
}
}
// Behöver kanske skicka in kategori i loadlist och createdataset för att göra olika tables, kör sedan loadlist med rätt kategori beroende på vilken button som används.
function loadList(){
    createDataSet();
    $('#tablediv').html( '<table cellpadding="0" cellspacing="0" border="0" class="display" id="issue-table"></table>' );
//(if category verkstad) gör för verkstad, pump, parkering
    $('#issue-table').dataTable( {
	"pageLength" : 20,
        "data": dataSet,
        //"scrollY": "200px",              //om man vill ha scroll
         "paging": false,                  //utan sidor
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "columns": [
	    { "title": "ID" },
            { "title": "Kategori" },
            { "title": "Namn" },
            { "title": "Adress" },
            { "title": "Telefon"},
            { "title": "Öppettider"},
            { "title": "Email"},
	    { "title": "Koordinater"},
	    
        ]
    } );
    //ta in datan från den skapade html till javascript igen så att man akn manipulera den
    var table = $('#issue-table').DataTable();

// Dölj ID columnen 
    var column = table.column(0);
    // Toggle the visibility
    column.visible( ! column.visible() );
    console.log("rad 0 med id dold");

    //select och unselect på onclick
    $('#issue-table').on( 'click', 'tr', function () {
	console.log(this);
	var thisMarker = table.row(this).data();
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');

        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
		var thisID = (thisMarker[0]);
		zoomMarker(thisID);
	
        }
    } );
    //delet button
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
    } );

}

/*
function zoomMarker(index){
 	for(var i = 0; i < markers.length; i++){

 		 if(markers[i].id == index){

	var mapCenter = new google.maps.LatLng(markers[i].latitude, markers[i].longitude);
    var mapOptions = {
        center: mapCenter,
        zoom: 15,
        scrollwheel: false,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.LARGE,
            position: google.maps.ControlPosition.RIGHT_CENTER
        }
    };
    map = new google.maps.Map(document.getElementById('miniMap'),
        mapOptions);
           		
 			}
		}
	markersToMap(["verkstad"]);}



*/






















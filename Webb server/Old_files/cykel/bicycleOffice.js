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
    url: "http://stsitkand.student.it.uu.se/cykel/mongodb.php",
    dataType: "json", // Set the data type so jQuery can parse it for you
    success: function (data) {
	//console.log(data["parking"][0].json_geometry.coordinates[1]);
	//console.log(data["pump"][0]);
	createMarkerArrayBicycle(data["verkstad"]["verkstad"], markers, "verkstad");
	createMarkerArrayBicycle(data["pump"], markers, "pump");
	createMarkerArrayBicycle(data["parking"], markers, "parking");

	
        createInfoWindowBicycle();
        markersToMap(["verkstad", "pump", "parking"]);
	
	//createTable();
	//tableFunction();
	//createDataSet();
	//loadList("verkstad");
	loaded="true";     
}

});
}}

//------------------------LOAD BICYCLE NODES----------------------//
function loadBicyclesNodes(){
if(loadedNodes=="false"){
$.ajax({
    type: "GET",
    url: "http://stsitkand.student.it.uu.se/cykel/nodes.php",
    dataType: "json", // Set the data type so jQuery can parse it for you
    success: function (data) {
	
	createMarkerArrayBicycle(data["nodes"], markers, "nodes");

        //createInfoWindowBicycle();
	//circleToMap();
        //markersToMap(["nodes"]);
	

	
	loadedNodes="true";     
}

});
}}

//------------------------LOAD NODEDATA AMOUNT BICYCLES----------------------//
function loadNodesData(){
if(loadedNodesData=="false"){
$.ajax({
    type: "GET",
    url: "http://stsitkand.student.it.uu.se/cykel/nodes_data.php",
    dataType: "json", // Set the data type so jQuery can parse it for you
    success: function (data) {

	createMarkerArrayNodesData(data[0],  "Daghammarsköldsväg 31"); //daghammar
	createMarkerArrayNodesData(data[1],  "Hamnspången"); //hamspangen
	createMarkerArrayNodesData(data[2], "Resecentrum"); //resecentrum
	
	circleToMap();
	createDataSet();
	loadList("verkstad");
	loadedNodesData="true";  

}

});
}}

function getNodeDataDate(date){
	$.post("http://stsitkand.student.it.uu.se/cykel/bicycleByDate.php",{
	postdata : "arvid"
	
},
function(data){
	console.log(data);	
},'json');}

//--------------ONLOAD IN CYKELWIDGET.HTML--------------//
function loading(){
initMap();
loadBicycles();

loadBicyclesNodes();

loadNodesData();
//getNodeDataDate("2014-11-15");
getNodeDataXml();
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

    //här sätts datan in från markers till dataSet som alltså är datan som hamnar i table.
    for(var i = 0; i < markers.length; i++){
	if(markers[i].category=="verkstad"){
var newTableRow = [markers[i].id,markers[i].category, markers[i].title, markers[i].address,markers[i].phoneNumber, markers[i].timeOpen, markers[i].email, markers[i].latitude+", "+ markers[i].longitude];
       
        dataSet.push(newTableRow);
        }else if(markers[i].category=="pump"){
	var newTableRow = [markers[i].id, markers[i].category, markers[i].title, markers[i].timeOpen, markers[i].latitude+", <br>"+ markers[i].longitude];
       
        dataSet.push(newTableRow);
	}else if(markers[i].category=="parking"){
	var newTableRow = [markers[i].id, markers[i].category,  markers[i].address, markers[i].amount, markers[i].latitude+", <br>"+ markers[i].longitude];
       
        dataSet.push(newTableRow);
}else if(markers[i].category=="nodes"){
	//var amount = 1000;

	
	var newTableRow = [markers[i].id, markers[i].category, markers[i].title, markers[i].latitude+", <br>"+ markers[i].longitude, markers[i].data["2014-11-15"]];
       
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
	    {"title": "Redigera"}
];
	
}else if(category=="pump"){
            var columns= [
		{ "title": "ID" },
                {"title": "Kategori"},
                {"title": "Namn"},
                { "title": "Öppettider"},
                { "title": "Koordinater"},
		{"title": "Redigera"}
            ]
}else if(category=="parking"){
            var columns= [
		{ "title": "ID" },
                {"title": "Kategori"},
                {"title": "Adress"},
		{"title": "Platser"},
                { "title": "Koordinater"},
		{"title": "Redigera"}
            ]}else if(category=="nodes"){
            var columns= [
		{ "title": "ID" },
                {"title": "Kategori"},
		{"title": "Namn"},
                { "title": "Koordinater"},
		{"title": "Antal"},
		{"title": "Redigera"}
            ]}
for(var i=0; i<dataSet.length; i++){
	if(dataSet[i][1]==category){
	dataOutputs.push(dataSet[i]);
}
}

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
           		
 			}
		}
	if(categoryTemp=="nodes"){
	circleToMap();}else{
	markersToMap([categoryTemp]);}}

function updateMarkerInfo(thisMarker , category){
		
		if(category=="parking"){
		document.getElementById("name").innerHTML = ("<p>"+thisMarker.address+"</p><p></p>");
		document.getElementById("open").innerHTML = ("<p>Antal platser: "+thisMarker.amount+"</p><p></p>");
		}else if(category=="verkstad"){
		var open;
		document.getElementById("name").innerHTML = ("<p>"+thisMarker.title+"</p><p></p>");
		open = '<p>Öppettider:</p>'+'<p>Måndag'+thisMarker.timeOpen.monday+'</p>';
		open+= '<p>Tidsdag'+thisMarker.timeOpen.tuesday+'</p>';
		open+= '<p>Onsdag'+thisMarker.timeOpen.wednesday+'</p>';
		open+= '<p>Torsdag'+thisMarker.timeOpen.thursday+'</p>';
		open+= '<p>Fredag'+thisMarker.timeOpen.friday+'</p>';
		open+= '<p>Lördag'+thisMarker.timeOpen.saturday+'</p>';
		open+= '<p>Söndag'+thisMarker.timeOpen.sunday+'</p>';
		document.getElementById("open").innerHTML = open;
		}else if(category=="pump"){
		document.getElementById("name").innerHTML = ("<p>"+thisMarker.title+"</p><p></p>");
		document.getElementById("open").innerHTML = ("<p>Status:Fungerar</p>");

}else if(category=="nodes"){
	var amount = 1000;
        var today = "2014-11-15"; //testdatum eftesom vi inte har data på dagensdatum

		document.getElementById("name").innerHTML = ("<p>"+thisMarker.title+"</p><p></p>");
		document.getElementById("open").innerHTML = ("<p>Antal cyklister idag:</p><p>"+thisMarker.data[today]+"</p>");

}
		//document.getElementById("description").innerHTML = ("<p>"+thisMarker.description+"</p>");
	
		
		
	}

//------------BUTTON--------------//

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
	
	for(var i=0; i<categoryList.length; i++){
	if(categoryList[i]!=button.value){
		hideCategory(categoryList[i]);}}
		
	/*}else{
		//alert("buttonUNchecked");
		document.getElementById(buttonID).Titel = "Checked";
		document.getElementById(buttonID).style.background= "#005389";
		showCategory(button.value);
	}*/
	
	
}
























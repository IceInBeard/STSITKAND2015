/**
 * Created by Erik on 2015-04-23.
 */
var tr, td;
var dataSet = [];
var loaded = false;
var issuesCategories = [];
var activeCategories = [];
var table;

function onloading(){
		//console.log("kalle");
		loadIssues();
		initMap();	
		//denna funktion behövs av nån anledning för att få knapparna att funka från första klicket
		//setButtonTitles();
		hideContainer();
		
		
		}
function loadIssues(){
    if (loaded != true){
        $.ajax({
            type: "GET",
            url: "http://stsitkand.student.it.uu.se/issuereporting/IssueReportingMongo.php",
            dataType: "json",
            success: function (data) {
                createMarkerArray(data, markers);
                createInfoWindow();

                //gå igenom alla markers jämför med issuescategories och se om den redan finns där. annars lägg till den. så att alla categorier läggs till--------------------------kalles morgon
                for (var i = 0; i < markers.length; i++) {
                    if(markers[i].group == "Issues"){
                        var foundCategory = false;
                        for (var j = 0; j < issuesCategories.length; j++) {
                            if(markers[i].category == issuesCategories[j]){
                                foundCategory = true;
                            }
                        }
                        if(foundCategory != true){
                            issuesCategories.push(markers[i].category);
                        }
                    }
                }
				activeCategories = issuesCategories;


                markersToMap(issuesCategories);
                loadList(issuesCategories);

            }
        });
        loaded = true;
    }
}

//-------------------------------------------------------------------------------------------------------------------------------------------------------kalles morgon
function updateMarkerArray(categories){
	
    for (var i = 0; i < markers.length; i++) {
        for (var j = 0; j < categories.length; j++) {
            if (markers[i].category == categories[j]) {
                hideCategory(categories[j]); //ta bort den från karta-värdel
                markers.splice(i, 1); //ta bort den markern från arrayen


            }
        }
    }
	
    

    $.ajax({
        type: "GET",
        url: "http://stsitkand.student.it.uu.se/issuereporting/IssueReportingMongo.php",
        dataType: "json",
        success: function (data) {
            console.log("updatemarker");
            console.log(data);
            createMarkerArray(data, markers);
            createInfoWindow();

            //gå igenom alla markers jämför med issuescategories och se om den redan finns där. annars lägg till den. så att alla categorier läggs till--------------------------kalles morgon
            for (var i = 0; i < markers.length; i++) {
                if(markers[i].group == "Issues"){
                    var foundCategory = false;
                    for (var j = 0; j < issuesCategories.length; j++) {
                        if(markers[i].category == issuesCategories[j]){
                            foundCategory = true;
                        }
                    }
                    if(foundCategory != true){
                        issuesCategories.push(markers[i].category);
                    }
                }
            }


            markersToMap(issuesCategories);
            loadList(issuesCategories);

        }
    });

}



function changeStatus(index, status){


    $.post("http://stsitkand.student.it.uu.se/issuereporting/UpdateMongoDB.php", {
        id: index,
        action: "changeStatus",
        status: status

    }, function(data) {
      //  console.log("changestatus");
       // console.log(data);
        updateMarkerArray     (issuesCategories);                                                                         //--------------------kalles morgon

    });

}

function changeStatusDescription(index, statusDesctiption){


    $.post("http://stsitkand.student.it.uu.se/issuereporting/UpdateMongoDB.php", {
        id: index,
        action: "UpdateStatusDescription",
        statusDesctiption: statusDesctiption

    }, function(data) {
        //console.log(data);
        updateMarkerArray(data, issuesCategories);                                                                         //--------------------kalles morgon

    });

}




//-------------------------------------------------visa ett issue på kartan och dölj alla andra, visa även endast den i listan

function showIssue(index){
    for (var i = 0; i < markers.length; i++) {
        for (var j = 0; j < issuesCategories.length; j++) {
            if (markers[i].category == issuesCategories[j]) {
                hideCategory(issuesCategories[j]); //ta bort den från karta-värdel


            }
        }
    }
    clearTable();
    for (var i = 0; i < markers.length; i++) {
        if(markers[i].id == index){
            markers[i].marker.setMap(map);
            var newmarkers = [markers[i]];

            $('#issueList').show('fast');
            printIssueList(newmarkers, "FÃ¥lhagen", "Address", "Category")
        }
    }

}



var addresstext= "";
//gör om long lat till en riktigt adress
function getAddress(latitude, longitude){
            var lat = latitude;
            var lng = longitude;
            var latlng = new google.maps.LatLng(lat, lng);
            var geocoder = geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[1]) {
						//alert(results[1].formatted_address);
						addresstext = String(results[1].formatted_address);
						console.log(addresstext);
                        //return addresstext;
                    }
                }
            });
        }



function createDataSet(categories) {
	dataSet = [];
	
	//console.log("createDataset");
    //här sätts datan in från markers till dataSet som alltså är datan som hamnar i table.
    for(var i = 0; i < markers.length; i++){
		for (var j = 0; j < categories.length; j++) {
			if (markers[i].category == categories[j]) {
				//console.log(dataSet);
				//getAddress(markers[i].latitude, markers[i].longitude);
				//console.log(addresstext);
				var newTableRow = [markers[i].id, markers[i].category, markers[i].description, "Adress", markers[i].datum,markers[i].status, markers[i].statusComment ];
			   
				dataSet.push(newTableRow);
			}
		}
    }
}
var table;
function loadList(categories){
    createDataSet(categories);
    $('#tablediv').html( '<table cellpadding="0" cellspacing="0" border="0" class="display" id="issue-table"></table>' );
    $('#issue-table').dataTable( {
	"pageLength" : 10,
        "data": dataSet,
		
        //"scrollY": "200px",              //om man vill ha scroll
         //"paging": false,                  //utan sidor
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "columns": [
		
			{ "title": "ID" },
            { "title": "Kategori" },
            { "title": "Beskrivning" },
            { "title": "Adress" },
            { "title": "Datum"},
            { "title": "Status"},
            { "title": "Kommentar"},
			{ "title": "Redigera" }
        ],
	 "columnDefs": [ {
         "targets": -1,
         "className": 'details-control',
	 "defaultContent": "<img src='https://cdn0.iconfinder.com/data/icons/opensourceicons/32/edit.png' alt='Redigera' height='32' width='32'>"
            
        } ]
    } );
    //ta in datan från den skapade html till javascript igen så att man akn manipulera den
    table = $('#issue-table').DataTable();
	//onclick på knappen 
	$('#issue-table').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
		editRow(row);
   
    } );
// Dölj ID columnen 
        var column = table.column(0);
        column.visible( ! column.visible() );
		column = table.column(3);
        column.visible( ! column.visible() );
	
	
    //select och unselect på onclick
    $('#issue-table').on( 'click', 'tr', function () {
	//console.log(this);
	var thisMarker = table.row(this).data();
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
			unZoom();
			hideContainer();
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
		var thisID = (thisMarker[0]);
		showContainer();
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
function editRow(thisRow){
	
	alert("Denna funktion är inte implementerad än");
	var thisMarker = table.row(thisRow).data();
	var thisID = (thisMarker[0]);
	changeStatus(thisID, "Fixad");
	/*for(var i = 0; i < markers.length; i++){

 		 if(markers[i].id == thisID){
			 
		 }
	}*/
	//table.fnUpdate( 'Example update', 1, 1 );
}
function unZoom(){
	initMap();
	markersToMap(issuesCategories);
	
}
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
			updateMarkerInfo(markers[i]);
			//alert("hej");
 			}
		}
	markersToMap(issuesCategories);
	}
	
	function updateMarkerInfo(thisMarker){
		document.getElementById("picture").innerHTML = ('<a id="single_image" href="'+thisMarker.picture+'"><img src="'+thisMarker.picture+'" height="80" width="120" alt=""/></a>');
		document.getElementById("description").innerHTML = ("<p>Beskrivning</p><p>"+thisMarker.description+"</p>");
		document.getElementById("ID").innerHTML = ("<p>ID</p><p>"+thisMarker.id+"</p>");
		document.getElementById("textbox").innerHTML = (thisMarker.statusComment);
	}
	function updateMarkerInfo2(index){
		//console.log(index);
		showContainer();
		for(var i = 0; i < markers.length; i++){
			if(markers[i].id == index){
			thisMarker = markers[i];
				document.getElementById("picture").innerHTML = ('<a id="single_image" href="'+thisMarker.picture+'"><img src="'+thisMarker.picture+'" height="80" width="120" alt=""/></a>');
				document.getElementById("description").innerHTML = ("<p>Beskrivning</p><p>"+thisMarker.description+"</p>");
				document.getElementById("ID").innerHTML = ("<p>ID</p><p>"+thisMarker.id+"</p>");
				document.getElementById("textbox").innerHTML = (thisMarker.statusComment);
			}
		}
	}
	 
	function hideContainer(){
		//alert("hej");
		document.getElementById("container").style.display = "none";
	}
function showContainer(){
		document.getElementById("container").style.display = "";
	}
	 

	
	function switchCheckbox2(checkBox) {
			 
			 var thisCategory = checkBox.value;
            if (checkBox.checked) {
				activeCategories.push(thisCategory);
                showCategory(thisCategory);
            }
            else { 
				for(var i = 0; i < activeCategories.length; i++){
					if(activeCategories[i] == thisCategory){
						activeCategories.splice(i, 1);
					}	
				}
                hideCategory(thisCategory);
            }
			loadList(activeCategories);
        }
	 
	   
	
	
	
	
	 
	  
	
	
	 
	
	
	
	
function setButtonTitles(){
	//kan och bör göras om till en for-loop som går igenom issuesCategories. knapparna bör även skapar i den så att man slipper ändra index.php om man byter nån katergori
	var buttonID =String("buttonVägar");
	document.getElementById(buttonID).Titel = "Checked";
	buttonID =String("buttonTrafik");
	document.getElementById(buttonID).Titel = "Checked";
	buttonID =String("buttonCykel");
	document.getElementById(buttonID).Titel = "Checked";
	buttonID =String("buttonÖvrigt");
	document.getElementById(buttonID).Titel = "Checked";
	buttonID =String("buttonRenhållning");
	document.getElementById(buttonID).Titel = "Checked";
	buttonID =String("buttonAllmänna platser");
	document.getElementById(buttonID).Titel = "Checked";
	buttonID =String("buttonKlotter");
	document.getElementById(buttonID).Titel = "Checked";
	buttonID =String("buttonOpinion");
	document.getElementById(buttonID).Titel = "Checked";
	buttonID =String("buttonVegetation");
	document.getElementById(buttonID).Titel = "Checked";
}
function switchButton(button){
	var buttonID =String("button"+button.value);
	var titel = document.getElementById(buttonID).Titel;
	//alert(titel);
	if(titel == "Checked"){
		//alert("buttonchecked");
		document.getElementById(buttonID).Titel = "Unchecked";
		document.getElementById(buttonID).style.background= "#b0bed9";
		
		hideCategory(button.value);
	}else{
		//alert("buttonUNchecked");
		document.getElementById(buttonID).Titel = "Checked";
		document.getElementById(buttonID).style.background= "#005389";
		showCategory(button.value);
	}
	
	
}





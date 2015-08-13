/**
 * Created by Erik on 2015-04-23.
 */
var tr, td;
var dataSet = [];
var loaded = false;
var issuesCategories = [];
var activeCategories = [];
var table;
var userId;
var thisUserId;   //platsen som den nuvarande användaren har i arrayen users. För enkel åtkomst och för att slippa loopa och leta efter matchande id osv
var users = [];

function onloading(){
		loadIssues();
		initMap();	
		hideContainer();
		getUserId();
		}
		
		//laddar in alla issues från databasen och startar igång att som är beroende av markerarrayen
function loadIssues(){
    if (loaded != true){
        $.ajax({
            type: "GET",
            url: "http://stsitkand.student.it.uu.se/issuereporting/IssueReportingMongo.php",
            dataType: "json",
            success: function (data) {
                createMarkerArray(data, markers);
                createInfoWindow();
           
                fillIssuesCategories();
				activeCategories = issuesCategories;
                markersToMap(issuesCategories);
                loadList(issuesCategories);
			
				activateUser();  
				
            }
        });
        loaded = true; 
    }
}
		
		
//--------------------------------------------------------------------------------------USER STUFF----------------------------------------------------------
// Ladda från mysql, hämta vår data från mongo. matacha	dessa, fyll listan och checkboxes samt kartan utifrån detta, allt sånt ligger här nedanför	
function getUserId(){
	//här ska user_id sättas från plattforgruppens kod.
	console.log("getUserId");
	userId = "21";
}

//hämtar in data om users		
function activateUser(){
	    $.post("http://stsitkand.student.it.uu.se/issuereporting/UpdateMongoDB.php", {
        action: "getComp", 
    }, function(data) {
		//console.log(data);
		var dataJson = JSON.parse(data);
		createUserArray(dataJson);
		//console.log(obj);
		//console.log(data[2].Name);
		activateSettings();
		loadList(activeCategories);
    });	
}
//som ceateMarkerArray men för users, så att alla users finns inlagrade och åtkomliga
function createUserArray(userData){
	//console.log(userData.length);
		 for (var i = 0; i < userData.length; i++) {
			var currentUser= [];
			currentUser.categories =  [];
			currentUser.categories.push(userData[i].Category);
		
			currentUser.name = userData[i].Name;   //behöver få rätt namn på dessa, forstätt på samma sätt med resten sen
			currentUser.area = userData[i].GeoArea;
			currentUser.userId = userData[i].CompanyId;
			if(userId == currentUser.userId){  	//tilldelar thisUserId den platsen som den inloggande användaren  får i arryen users 
				thisUserId = i; 
			}
			users.push(currentUser);
		 }
}
//aktiverar dom inställningar som ska gälla för den aktiva användaren
function activateSettings(){
	//console.log("activateSettings");
	activeCategories = [];
	for(var i = 0; i < issuesCategories.length; i++){
		hideCategory(issuesCategories[i]);
		updateCheckbox(issuesCategories[i], false);
	}
	//console.log(users[thisUserId].categories[0]);
	for (var i = 0; i < users[thisUserId].categories.length; i++){
		addActiveCategory(users[thisUserId].categories[i]);
	}
}

// fixar så att checkboxen är iklickade eller inte när dom updateras från annat håll
function updateCheckbox(thisCategory, checkedValue){
	var boxId = "";
	if (thisCategory == "Vägar"){ boxId="option"; }
	if (thisCategory == "Trafik"){ boxId="option2"; }
	if (thisCategory == "Cykel"){ boxId="option3"; }
	if (thisCategory == "Vegetation"){ boxId="option4"; }
	if (thisCategory == "Renhållning"){ boxId="option5"; }
	if (thisCategory == "Allmänna platser"){ boxId="option6"; }
	if (thisCategory == "Klotter"){ boxId="option7"; }
	if (thisCategory == "Opinion"){ boxId="option8"; }
	if (thisCategory == "Övrigt"){ boxId="option9"; }
	if (boxId != ""){
		document.getElementById(boxId).checked = checkedValue;
	}
	
}
//lägger till en kategori som aktiv
function addActiveCategory(thisCategory){
	activeCategories.push(thisCategory);
	showCategory(thisCategory);
	updateCheckbox(thisCategory, true);
}
//tar brot en kategori så att den inte visas på kartan osv
function removeActiveCategory(thisCategory){
	for(var i = 0; i < activeCategories.length; i++){
					if(activeCategories[i] == thisCategory){
						
						activeCategories.splice(i, 1);
					}	
				}
                hideCategory(thisCategory);
				updateCheckbox(thisCategory, false);
}
//---------------------------------------------------------------------------------------------------------------------SLUT på UserGREJR, typ------------------------------------------------------

function fillIssuesCategories(){
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
	
}
function removeCategories(categories){
	for (var i = 0; i < markers.length; i++) {
        for (var j = 0; j < categories.length; j++) {
            if (markers[i].category == categories[j]) {
				//console.log(categories[j]);
                hideCategory(categories[j]); //ta bort den från karta-värdel
                markers.splice(i, 1); //ta bort den markern från arrayen
            }
        }
    }
}
function updateMarkerArray(markerData, categories){
			removeCategories(activeCategories);
			fillIssuesCategories();
           // console.log("updatemarker");
           // console.log(data);
            createMarkerArray(markerData, markers);
            createInfoWindow();
            //gå igenom alla markers jämför med issuescategories och se om den redan finns där. annars lägg till den. så att alla categorier läggs till--------------------------
            markersToMap(activeCategories);
            loadList(activeCategories);
        }
    

function addCompany(value){
	//console.log("addCompany");
	if (value== "addCompany"){
		alert("här ska popupen komma istället");
	}
}




	//-------------------------------------------------------------------------------------------------------------------------INFO WINDOW Stuff-----------------------------------------------------------------------------------
	function updateMarkerInfo(thisMarker){
		document.getElementById("picture").innerHTML = ('<a id="single_image" href="'+thisMarker.picture+'"><img src="'+thisMarker.picture+'" height="80" width="120" alt=""/></a>');
		document.getElementById("description").innerHTML = ("<p>"+thisMarker.description+"</p>");
		document.getElementById("ID").innerHTML = ("<p>ID</p><p>"+thisMarker.id+"</p>");
		var companyString = "<option disabled selected>Välj Företag</option>";
		for (var i = 0; i < users.length; i++){
			if (users[i].name == thisMarker.company){
				companyString += "<option selected>"+users[i].name+"</option>";
			}else{
				companyString += "<option>"+users[i].name+"</option>";
			}
		}
		companyString += "<option value='addCompany'>--Lägg till nytt företag--</option>";
		document.getElementById("company").innerHTML = ("<p>Företag ansvarig</p><select id='companySelect' onchange='addCompany(this.value)'>"+companyString+"</select>");
		var statusString = "";
		if (thisMarker.status == "Fixad"){
			statusString += "<option selected>Fixad</option><option>Under Behandling</option><option>Inrapporterad</option>";
		}else if(thisMarker.status == "Ofixad"){
			statusString += "<option>Fixad</option><option selected>Under Behandling</option><option>Inrapporterad</option>";
		}else{
			statusString += "<option>Fixad</option><option>Under Behandling</option><option selected>Inrapporterad</option>";
		}
		document.getElementById("status").innerHTML = ("<p>Status</p><select id='statusSelect'>"+statusString+"</select>");
		document.getElementById("textbox").innerHTML = (thisMarker.statusComment);
		document.getElementById("updateTest").onclick =  function() { updateComment(thisMarker.id); };
	}
	
	function updateMarkerInfo2(index){            //byt namn på denna sen, den uppdaterar info från markerklik istället. Men körs från mapfunc så måste ändras där också
		showContainer();
		for(var i = 0; i < markers.length; i++){
			if(markers[i].id == index){
			var thisMarker = markers[i];
				updateMarkerInfo(thisMarker);
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
	 
	 
	 
	 
	 
	 //------------------------------------------------------------------------------Update server-----------------------------------------------------------------------------------------------------------------------
	 
function changeCompany(index, comp){
    $.post("http://stsitkand.student.it.uu.se/issuereporting/UpdateMongoDB.php", {
        id: index,
        action: "changeComp",
        comp: comp
	}, function(data) {
                                                                            
	});
}
function changeStatus(index, status){
    $.post("http://stsitkand.student.it.uu.se/issuereporting/UpdateMongoDB.php", {
        id: index,
        action: "changeStatus",
        status: status
	}, function(data) {
                                                                            
	});
}
function changeComment(index, comment){
    $.post("http://stsitkand.student.it.uu.se/issuereporting/UpdateMongoDB.php", {
        id: index,
        action: "changeComment",
        comment: comment
    }, function(data) {
		var dataObj = JSON.parse(data);
        updateMarkerArray(dataObj, issuesCategories);                                                                            //måste bestämmas vart denna ska ligga.                                                           
    });
}
function changeAll(){
	var index = document.getElementById("id-textbox").value;            // fylla i alla dessa när dom finns klara--------------------och där nee---------------
	var comment = document.getElementById("comment-textbox").value;
    $.post("http://stsitkand.student.it.uu.se/issuereporting/UpdateMongoDB.php", {
       /*  id: index,
        action: "changeAll",
        comment: comment,
		status: status,
		picture: picture,
		longitude: longitude,                                   
		latitude: latitude,
		timestamp: timestamp
		descrip: descrip,
		email: email,
		comp: comp */
    }, function(data) {
		var dataObj = JSON.parse(data);
        updateMarkerArray(dataObj, issuesCategories);                                                                   
    });
}
function updateComment(index){
	var commentText = document.getElementById("textbox").value;
	var selectbox = document.getElementById("companySelect");
	var chosenCompany = selectbox.options[selectbox.selectedIndex].value;
	selectbox = document.getElementById("statusSelect");
	var chosenStatus= selectbox.options[selectbox.selectedIndex].value;
	
	changeStatus(index, chosenStatus);
	changeComment(index, commentText);
	//changeCompany(index, chosenCompany);
	
}

	 
	 //-------------------------------------------------------------------------------------------------------lägg in värden till listan------------------------------------------------------------------------------------------------------
	 function createDataSet(categories) {
	dataSet = [];
	
	//console.log("createDataset");
    //här sätts datan in från markers till dataSet som alltså är datan som hamnar i table.
    for(var i = 0; i < markers.length; i++){
		for (var j = 0; j < categories.length; j++) {
			if (markers[i].category == categories[j]) {
			//	console.log(markers[i].status);
				if ( markers[i].status == "undefined"){
					//console.log(markers[i].description);
					markers[i].status = "Ofixad";
				}
				if ( markers[i].statusComment == "undefined"){
					markers[i].statusComment = "";
				}
				//console.log(dataSet);
				//getAddress(markers[i].latitude, markers[i].longitude);
				//console.log(addresstext);
				var newTableRow = [markers[i].id, markers[i].category, markers[i].description, "Adress", markers[i].datum,markers[i].status, markers[i].statusComment, markers[i].company ];
			   
				dataSet.push(newTableRow);
			}
		}
    }
}
	 var table; //--------------------------------------------------------------------------LISTGREJER-------------------------------------------------------------------------------------
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
			{ "title": "Företag" }
        ]
		/*,
	 "columnDefs": [ {
         "targets": -1,
         "className": 'details-control',
	 "defaultContent": "<img src='https://cdn0.iconfinder.com/data/icons/opensourceicons/32/edit.png' alt='Redigera' height='32' width='32'>"
            
        } ]*/
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
	 
	 
	 //--------------------------------------------------------------------------------------------------------------försök till att få adress att hämtas, funkade ibland---------------------------------------------------

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

	//------------------------------------------------------------------------------------------------zoom och unzooma en marker---------------------------------------------------

function unZoom(){
	initMap();
	markersToMap(activeCategories);
	
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

function switchCheckboxAll(checkBox) {
			 
	var thisCategory = checkBox.value;
            if (checkBox.checked) {
		activeCategories = issuesCategories;
		for(var i = 0; i < activeCategories.length; i++){
                showCategory(activeCategories[i]);
				updateCheckbox(activeCategories[i], true);
		}
            }
            else { 
		
		for(var i = 0; i < activeCategories.length; i++){
                hideCategory(activeCategories[i]);
				updateCheckbox(activeCategories[i], false);
		}
		activeCategories = [];
            }
			loadList(activeCategories);
        }
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	/*  function updateMarkerArray2(categories){
	
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
           // console.log(data);
            createMarkerArray(data, markers);
            createInfoWindow();
            //gå igenom alla markers jämför med issuescategories och se om den redan finns där. annars lägg till den. så att alla categorier läggs till--------------------------
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
} */
	 
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
	 
	   
	
		
/* function setButtonTitles(){
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
	
	
} */
//-------------------------------------------------visa ett issue på kartan och dölj alla andra, visa även endast den i listan

/* function showIssue(index){
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

} */






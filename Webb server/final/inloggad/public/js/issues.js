/**
 * Created by Erik on 2015-04-23.
 */
var tr, td;
var dataSet = [];
var loaded = false;
var issuesCategories = [];
var activeCategories = [];
var table;
var userId = 21;       //sätter dessa till värden så länge, så om usern inte fins i vår databs så händer ändå nått
var thisUserId = 0;   //platsen som den nuvarande användaren har i arrayen users. För enkel åtkomst och för att slippa loopa och leta efter matchande id osv
var users = [];

function onloading(){
		loadIssues();
		initMap();	
		hideContainer();
		$('#leftSideCategory').addClass('selected');

    

		
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
                //loadListIssues(issuesCategories);
				getUserId();
				
				
            }
        });
        loaded = true; 
    }
}
		
		
//--------------------------------------------------------------------------------------USER STUFF----------------------------------------------------------
// Ladda från mysql, hämta vår data från mongo. matacha	dessa, fyll listan och checkboxes samt kartan utifrån detta, allt sånt ligger här nedanför	
function getUserId(){
	$.post("http://stsitkand.student.it.uu.se/sprint2/inloggad/public/getSession.php", {
        
	}, function(data) {
        var dataObj = JSON.parse(data);
		userId = dataObj.user_id;
		console.log("userId");
		console.log(userId);
		activateUser();  
	});
	//här ska user_id sättas från plattforgruppens kod.
	//console.log("getUserId");
	//userId = "21";
}

//hämtar in data om users		
function activateUser(){
	    $.post("http://stsitkand.student.it.uu.se/sprint3/inloggad/public/database/UpdateMongoDB.php", {
        action: "getComp" 
    }, function(data) {
		//console.log(data);
		var dataJson = JSON.parse(data);
		createUserArray(dataJson);
		//console.log(obj);
		//console.log(data[2].Name);
		
		activateSettings();
		console.log("försöker ladda lista");
		console.log(activeCategories);
		//console.log("issuescategories:");
		//console.log(issuesCategories);
		//autoAssingIssues();
		loadListIssues(activeCategories);
		
		console.log("lista laddad"+activeCategories);
		
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
			var idtemp = userData[i]._id;
			currentUser.index = idtemp.$id; 
			currentUser.userId = userData[i].CompanyId;
			if(userId == currentUser.userId){  	//tilldelar thisUserId den platsen som den inloggande användaren  får i arryen users 
				thisUserId = i;
				console.log("thisUserId bytt till: "+thisUserId) 
			}
			users.push(currentUser);
		 }
}
function updateUserArray(data, thisMarker){
	console.log(data);
	var userId = 21;       //sätter dessa till värden så länge, så om usern inte fins i vår databs så händer ändå nått
	var thisUserId = 0;   //platsen som den nuvarande användaren har i arrayen users. För enkel åtkomst och för att slippa loopa och leta efter matchande id osv
	
	createUserArray(data);
	updateMarkerInfo(thisMarker);
}
//aktiverar dom inställningar som ska gälla för den aktiva användaren
function activateSettings(){
	console.log("activateSettings med uerId:"+userId);
	console.log("som ligger på postion "+thisUserId+" i userArrayen");
	
	activeCategories = [];
	for(var i = 0; i < issuesCategories.length; i++){
		hideCategory(issuesCategories[i]);
		updateCheckbox(issuesCategories[i], false);
	}
	//console.log(users[thisUserId].categories[0]);
	var userCategoriesText = users[thisUserId].categories+"";
	console.log("userCategoriesText "+userCategoriesText);
	var userCategoriesArray = userCategoriesText.split(",");
	for (var i = 0; i < userCategoriesArray.length; i++){
		//console.log("lägger till en kategori i taget: " +users[thisUserId].categories[i]));
		addActiveCategory(userCategoriesArray[i]);
	}
}
function findComany(thisCategory){
	for (var i = 0; i < users.length; i++) {
		if(users[i].category == thisCategory){
			return users[i];
			//console.log("findComany");
		}	
	}
	return ("NoCompany");
}
function autoAssingIssues(){
		//console.log("autoAssingIssues");
	 for (var i = 0; i < markers.length; i++) {
			var matchingCompany = findComany(markers[i].category);
		//	console.log("foundCompany"+ matchingCompany);
			var compExist = true;
			if (matchingCompany = "NoCompany"){
				compExist = false;
			}
			var noCompanyChosen = false;
			if(markers[i].company == "Välj företag"){
				noCompanyChosen = true;
			}else if(markers[i].company == ""){
				noCompanyChosen = true;
			}
			if(noCompanyChosen && compExist){
				markers[i].company = matchingCompany.name;
			}
	 }
}

// fixar så att checkboxen är iklickade eller inte när dom updateras från annat håll

//lägger till en kategori som aktiv
function addActiveCategory(thisCategory){
	//console.log("lägger till "+thisCategory+ " i ativecategories:");
	//console.log(activeCategories);
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
	console.log(markers);
	for (var i = 0; i < markers.length-1; i++) {
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
			//removeCategories(issuesCategories);
			markers = [];
			//fillIssuesCategories();
            //console.log("updatemarker");
           // console.log(data);
            createMarkerArray(markerData, markers);
            createInfoWindow();
            //gå igenom alla markers jämför med issuescategories och se om den redan finns där. annars lägg till den. så att alla categorier läggs till--------------------------
            markersToMap(issuesCategories);
			
            loadListIssues(activeCategories);
			console.log(activeCategories);
        }
    

function addCompany(value){
	//console.log("addCompany");
	if (value== "addCompany"){
		alert("här ska popupen komma istället");

loadNewCompany()

	}
}  




	//-------------------------------------------------------------------------------------------------------------------------INFO WINDOW Stuff-----------------------------------------------------------------------------------
	function updateMarkerInfo(thisMarker){
		if (thisMarker.picture == "") {
		document.getElementById("picture").innerHTML = ('<a class="fancybox" id="single_image" data-fancybox-group="gallery" href="https://9to5mac.files.wordpress.com/2013/06/camera.png"><img src="https://9to5mac.files.wordpress.com/2013/06/camera.png" height="80" width="120" alt=""/></a>');
		}

		else {
document.getElementById("picture").innerHTML = ('<a class="fancybox" id="single_image" data-fancybox-group="gallery" href="'+thisMarker.picture+'"><img id="boxPicture" src="'+thisMarker.picture+'" onerror="picNotFound()" height="80" width="120" /></a>');
		}
		
		document.getElementById("issue-description").innerHTML = (thisMarker.description);
		//document.getElementById("contact-name").innerHTML = (thisMarker.Name); 
		//document.getElementById("contact-email").innerHTML = (thisMarker.email);
		document.getElementById("ID").innerHTML = ("<p>ID</p><p>"+thisMarker.id+"</p>");


		var companyString = "<option disabled selected>Välj Företag</option>";

		for (var i = 0; i < users.length; i++){
			if (users[i].name == thisMarker.company){
				
				companyString += "<option selected>"+users[i].name+"</option>";
			}else{
				companyString += "<option>"+users[i].name+"</option>";
			}
		}
		//companyString += "<option value='addCompany'>--Lägg till nytt företag--</option>";
		document.getElementById("company").innerHTML = ("<p>Företag ansvarig</p><select id='companySelect' onchange='addCompany(this.value)'>"+companyString+"</select>");
		var statusString = "";
		if (thisMarker.status == "Slutförd"){
			statusString += "<option selected>Slutförd</option><option>Under Behandling</option><option>Inrapporterad</option>";
		}else if(thisMarker.status == "Under Behandling"){
			statusString += "<option>Slutförd</option><option selected>Under Behandling</option><option>Inrapporterad</option>";
		}else{
			statusString += "<option>Slutförd</option><option>Under Behandling</option><option selected>Inrapporterad</option>";
		}
		document.getElementById("status").innerHTML = ("<p>Status</p><select id='statusSelect'>"+statusString+"</select>");

		


		document.getElementById("comment-munitext").innerHTML = '<p class="muni-comment">Kommunens kommentar</p> <textarea id="textbox" class="textbox" placeholder="Skriv en kommentar till felanmalan">'+thisMarker.statusComment+'</textarea>';
		//document.getElementById("textbox").innerHTML = (thisMarker.statusComment);
		document.getElementById("updateTest").onclick =  function() { updateComment(thisMarker.id); };
		document.getElementById("editIconButton").onclick =  function() { loadEditAll(thisMarker); };
		document.getElementById("NewCompButton").onclick =  function() { loadNewCompany(thisMarker); };
	}
	


	function picNotFound(){
	console.log("picNotFound");
	document.getElementById("boxPicture").src = "https://9to5mac.files.wordpress.com/2013/06/camera.png";
 	}

	function updateMarkerInfo2(index){            //byt namn på denna sen, den uppdaterar info från markerklik istället. Men körs från mapfunc så måste ändras där också
		showContainer();
		for(var i = 0; i < markers.length; i++){
			if(markers[i].id == index){
			var thisMarker = markers[i];
				updateMarkerInfo(thisMarker);
				selectInList(thisMarker);
			}
		}
	}
	 function hideContainer(){
		
		document.getElementById("detailedMarkerInfo").style.display = "none";
	}
	function showContainer(){
		document.getElementById("detailedMarkerInfo").style.display = "";
	}
	 function selectInList(thisMarker){
	//console.log("Kalle");
	loadListIssues(activeCategories);
	//console.log(thisMarker);
	var thisRowId = 0;
	var i = 0;
	var rowData;
	while(i < table.data().length){
		rowData = table.row(i).cache();
		if(rowData[0] == thisMarker.id){
			thisRowId = i;
			//console.log("found markerId in table at "+ i);
		}
		//console.log(i);
		i++;
		
	}
	//thisRowId +=1;
	//console.log("thisRowId "+thisRowId);
	$('#issue-table tr:nth-child('+thisRowId+')').addClass('selected');
 
}
	 
	 
	 
	 
	 //------------------------------------------------------------------------------Update server-----------------------------------------------------------------------------------------------------------------------
	 
function changeCompany(index, comp){
    $.post("http://stsitkand.student.it.uu.se/sprint3/inloggad/public/database/UpdateMongoDB.php", {
        id: index,
        action: "changeComp",
        comp: comp
	}, function(data) {
                                                                            
	});
}
function changeStatus(index, status){
    $.post("http://stsitkand.student.it.uu.se/sprint3/inloggad/public/database/UpdateMongoDB.php", {
        id: index,
        action: "changeStatus",
        status: status
	}, function(data) {
        console.log();                                                             
	});
}

function changePriority(index, prio){
	var thisMarker;
    $.post("http://stsitkand.student.it.uu.se/final/inloggad/public/database/UpdateMongoDB.php", {
        id: index,
        action: "changePriority",
        priority: prio
	}, function() {
		console.log("H!");
		
        	for(var i = 0; i < markers.length; i++){
//console.log(markers[i].id + "  Markers id");
//console.log(index + "  index");
//console.log(i);
			if(markers[i].id == index){
console.log("hejsan2");
			thisMarker = markers[i];

			if(thisMarker.prio == "Ja"){
thisMarker.prio = "Nej";

			}else{
				thisMarker.prio = "Ja";

			}
			
			console.log("H");
			}
		} loadListIssues(activeCategories);
	//	selectInList(thisMarker);
                                                              
	});
}




function changeComment(index, comment){
    $.post("http://stsitkand.student.it.uu.se/sprint3/inloggad/public/database/UpdateMongoDB.php", {
        id: index,
        action: "changeComment",
        comment: comment
    }, function(data) {
		var dataObj = JSON.parse(data);
        updateMarkerArray(dataObj, issuesCategories);
        var thisMarker;
	for(var i = 0; i < markers.length; i++){
		if (markers[i].id == index) {
		thisMarker = markers[i];
		}
	}
	//selectInList(thisMarker);
	console.log("changeComment");
                                                                            //måste bestämmas vart denna ska ligga.                                                           
    });
}

function createCompany(){
parent.$.fancybox.close();
	console.log("createcompany");

	var name = document.getElementById("newname-textbox").value;            
	var userId = document.getElementById("newuserid-textbox").value;
	//var categories = document.getElementById("newcategories-textbox").value;
	var selectbox = document.getElementById("categoryDropdown2");
 	var category= selectbox.options[selectbox.selectedIndex].value;
	var compname = document.getElementById("newcompname-textbox").value;
	var phone = document.getElementById("newphone-textbox").value;
	var email = document.getElementById("newemail-textbox").value;
	var area = document.getElementById("newarea-textbox").value;
	var thisMarkerId = document.getElementById("thisMarkerId-textbox").value; 
	var thisMarker;
	for(var i = 0; i < markers.length; i++){
		if (markers[i].id == thisMarkerId) {
		thisMarker = markers[i];
		}
	}

	console.log("createcompany2");

    $.post("http://stsitkand.student.it.uu.se/sprint3/inloggad/public/database/companyMongo.php", {
         
        	action: "createCompany",
        	name: name,
		compname: compname,
		phone: phone,
		userId: userId,
		category: category,
		email: email,
		area: area 


    }, function(data) {

    		console.log("createcompanySuccsess");
		var dataObj = JSON.parse(data);
		var i = dataObj.length-1;
		//console.log(dataObj);
		dataObj = dataObj[i];
		
		var newUser = [];
		newUser.categories =  [];
		newUser.categories.push(dataObj.Category);
		newUser.name = dataObj.Name;   //behöver få rätt namn på dessa, forstätt på samma sätt med resten sen
		newUser.area = dataObj.GeoArea;
		newUser.userId = dataObj.CompanyId;
		var idtemp = dataObj._id;
			newUser.index = idtemp.$id; 
		users.push(newUser);
		
		updateMarkerInfo(thisMarker);
		//	selectInList(thisMarker);
        	//updateUserArray(dataObj, thisMarker); 
	console.log(dataObj);   
	console.log(users);                                                                 
    });
}

function removeIssue(){
	console.log("removeIssueSucess");
	parent.$.fancybox.close();
	var index = document.getElementById("id-textbox").value;	 
	console.log(index);

    $.post("http://stsitkand.student.it.uu.se/sprint3/inloggad/public/database/removeMongo.php", {
        id: index,
        action: "removeIssue",
	}, function(data) {
		console.log("removeIssuesucess2"); 
		var dataObj = JSON.parse(data);
		removeOneMarker(index, dataObj);
	});
}


function removeOneMarker(index, dataObj){
	var thisMarker;
	markers.splice(index, 1);
	console.log("removeOneMarker");
	console.log(markers);
	updateMarkerArray(dataObj, issuesCategories);
	unZoom(); 
	hideContainer();
	console.log("removeOneMarker2");
}

function changeAll(){
	parent.$.fancybox.close();
	console.log("chaneAll1");
	var index = document.getElementById("id-textbox").value;    //(thisMarker.id);           
	//var comment = document.getElementById("comment-textbox").value;
	var selectbox = document.getElementById("categoryDropdown");
 	var category= selectbox.options[selectbox.selectedIndex].value;
	//var category = document.getElementById("category-textbox").value;
	//var email = document.getElementById("email-textbox").value;
	//var name = document.getElementById("name-textbox").value;
	var descrip = document.getElementById("description-textbox").value;
	//var comp = document.getElementById("company-textbox").value;
	//var status = document.getElementById("status-textbox").value;
	console.log("category");
	console.log(category);
    $.post("http://stsitkand.student.it.uu.se/final/inloggad/public/database/UpdateMongoDB.php", {
        id: index,
        category: category,
        action: "changeAll",
       // comment: comment,
		//status: status,
		//category: category,
		//picture: picture,
		//longitude: longitude,                                   
		//latitude: latitude,
		//timestamp: timestamp,
		descrip: descrip
		//email: email,
		//name: name,
		//comp: comp 
    }, function(data) {
console.log("chaneAll3");
		var dataObj = JSON.parse(data);
//console.log(issuesCategories);
        updateMarkerArray(dataObj, issuesCategories);
	zoomMarker(index); 
	var thisMarker;
	for(var i = 0; i < markers.length; i++){
		if (markers[i].id == index) {
		thisMarker = markers[i];
		}
	}
//	selectInList(thisMarker);
		
		//console.log(data);
    });
}
function deleteCompany(){
		parent.$.fancybox.close();
	console.log("deleteCompany");
var selectbox = document.getElementById("companyDropdownDelete");
	var chosenCompany = selectbox.options[selectbox.selectedIndex].value; 
	console.log("tar bort: "+chosenCompany);

	var thisMarkerId = document.getElementById("thisMarkerId-textbox").value; 
	var thisMarker;
	for(var i = 0; i < markers.length; i++){
		if (markers[i].id == thisMarkerId) {
		thisMarker = markers[i];
		}
	}
	var index;
	var usersI;
	for (var i = 0; i <users.length; i++){
		if(users[i].name== chosenCompany){
			index= users[i].index;
			usersI = i;
		}
	}	 
	console.log(index);

    $.post("http://stsitkand.student.it.uu.se/final/inloggad/public/database/removeCompMongo.php", {
        id: index
	}, function(data) {
		console.log("deleteCompany success"); 
	//	var dataObj = JSON.parse(data);
		users.splice(usersI, 1); 
		console.log(users);
		updateMarkerInfo(thisMarker);
	});
}

function updateComment(index){
	
	var commentText = document.getElementById("textbox").value;
	var selectbox = document.getElementById("companySelect");
	var chosenCompany = selectbox.options[selectbox.selectedIndex].value;
	selectbox = document.getElementById("statusSelect");
	var chosenStatus= selectbox.options[selectbox.selectedIndex].value;
	
	changeStatus(index, chosenStatus);
	changeCompany(index, chosenCompany);
	changeComment(index, commentText);
	
}
function loadEditAll(thisMarker){
	document.getElementById("edit").style.display = ("block");
	//var thisId = 0;  // ska komma in i funktionen sen
	console.log("loadEditAll()");
	
	document.getElementById("id-textbox").value = (thisMarker.id);
	var companyString = "<option disabled>Välj Kategori</option>";

		for (var i = 0; i < issuesCategories.length; i++){
			if (issuesCategories[i] == thisMarker.category){
				companyString += "<option selected>"+issuesCategories[i]+"</option>";
				
			}else{
				companyString += "<option>"+issuesCategories[i]+"</option>";
			}
		}
		//companyString += "<option value='addCompany'>--Lägg till nytt företag--</option>";
		document.getElementById("categorySelect").innerHTML = ("<select id='categoryDropdown' >"+companyString+"</select>");
	document.getElementById("categorySelect2").innerHTML = ("<select id='categoryDropdown2' >"+companyString+"</select>");
	//document.getElementById("status-textbox").value = (thisMarker.status);
console.log("hej");
	//document.getElementById("category-textbox").value = (thisMarker.category);
	//document.getElementById("comment-textbox").value = (thisMarker.statusComment);
	//document.getElementById("name-textbox").value = (thisMarker.Name);
	//document.getElementById("email-textbox").value = (thisMarker.email);
	document.getElementById("description-textbox").value = (thisMarker.description);
	//document.getElementById("company-textbox").value = (thisMarker.company);
	
}
function iframeTest(){
	//alert("hej");
	//parent.$.fancybox.close();
	var idText = document.getElementById("id-textbox").value;
	
}
function loadFilter(){
	
	document.getElementById("filter").style.display = ("block");
	console.log("loadFilter");
}

function loadNewCompany(thisMarker){
	var companyString = "<option disabled selected>Välj Företag</option>";

		for (var i = 0; i < users.length; i++){
			companyString += "<option>"+users[i].name+"</option>";
		}
	document.getElementById("companyDropdown").innerHTML = ("<select id='companyDropdownDelete' type='text'>"+companyString+"</select>");
	document.getElementById("newCompany").style.display = ("block");
	document.getElementById("thisMarkerId-textbox").value = (thisMarker.id);
	console.log("loadFilter");

	var categoryString = "<option disabled>Välj Kategori</option>";

		for (var i = 0; i < issuesCategories.length; i++){
			if (issuesCategories[i] == thisMarker.category){
				categoryString += "<option selected>"+issuesCategories[i]+"</option>";
				
			}else{
				categoryString += "<option>"+issuesCategories[i]+"</option>";
			}
		}
		//categoryString += "<option value='addCompany'>--Lägg till nytt företag--</option>";
	document.getElementById("categorySelect2").innerHTML = ("<select id='categoryDropdown2' >"+categoryString+"</select>");
}


	 
	 //-------------------------------------------------------------------------------------------------------lägg in värden till listan------------------------------------------------------------------------------------------------------
	 function createDataSetIssue(categories) {
	dataSet = [];
	var columnTextLenght = 0;                                                                     //här väljer man hur många tecken som ska få synas av kommentaren och beskrivningen
	console.log("createDataSetIssue");
    //här sätts datan in från markers till dataSet som alltså är datan som hamnar i table.
    for(var i = 0; i < markers.length; i++){
		//console.log(i);
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
				
				
				var shortDesc = "";
				if (markers[i].description.length > columnTextLenght){
					//for(var k = 0; k < columnTextLenght-1; k++){
						//shortDesc += (""+markers[i].description[k]);
						shortDesc = "Ja";
					
					//shortDesc += " ...";
				}else {
					shortDesc = "Nej";
				}
				
				var shortComment = "";
				if (markers[i].statusComment.length > 0){
					//for(var k = 0; k < columnTextLenght-1; k++){
					//	shortComment = "Ja";
					//}
					shortComment = "Ja";
				}else {
					shortComment = "Nej ";
				}
/*
				var shortDesc = "";
				if (markers[i].Priority.length > columnTextLenght){
					//for(var k = 0; k < columnTextLenght-1; k++){
						//shortDesc += (""+markers[i].description[k]);
						shortDesc = "Ja";
					
					//shortDesc += " ...";
				}else {
					shortDesc = "Nej";
				}
				*/
				var newTableRow = [markers[i].id, markers[i].category, shortDesc, "Adress", markers[i].datum,markers[i].status, shortComment, markers[i].company, markers[i].prio ];
			   
				dataSet.push(newTableRow);
			}
		}
    }
}
	 var table; 


function switchCheckBoxNew(checkBox){

	// Get the column API object
        var column = table.column( checkBox.value );

        // Toggle the visibility
        column.visible( ! column.visible() );		
		


}
function showCompany(){
	var loggedinCompanyName = users[thisUserId].name;
	var ckeckboxAll = document.getElementById("Option10");
	ckeckboxAll.checked = false;

	 switchCheckboxAll(ckeckboxAll);
	loadListIssues(issuesCategories);

//	console.log("inloggad företags namn: "+loggedinCompanyName);
	table.column(7)
				.search(loggedinCompanyName)
				.draw();
	markersToMap(issuesCategories);
	activeCategories = issuesCategories.slice(0);
	for (i = 0; i < markers.length; i++) {
		console.log(markers[i].company);
                if (markers[i].company != loggedinCompanyName) {
                    markers[i].marker.setMap(null);
                }
            }

}
//--------------------------------------------------------------------------LISTGREJER-------------------------------------------------------------------------------------
function loadListIssues(categories){
	console.log("loadList");
    createDataSetIssue(categories);
    $('#tablediv').html( '<table cellpadding="0" cellspacing="0" border="0" class="display" id="issue-table"></table>' );
    $('#issue-table').dataTable( {
	"pageLength" : 15,
	  "dom": '<"nav">frtip',
        "data": dataSet,
        "order": [[4, "desc"]],
		
        //"scrollY": "200px",              //om man vill ha scroll
         //"paging": false,                  //utan sidor
        "lengthMenu": [[14, 25, 50, -1], [14, 25, 50, "All"]],
        "columns": [
		
	    { "title": "ID" },
            { "title": "Kategori" },
            { "title": "Beskrivning" },
            { "title": "Adress" },
            { "title": "Datum"},
            { "title": "Status"},
            { "title": "Kommentar"},
	    { "title": "Företag" },
	    { "title": "Prioritering" }
		
        ]
		,
	 "columnDefs": [ {
         "targets": -1,
         "className": 'details-control2'
	
            
        } ]
    } );
    //ta in datan från den skapade html till javascript igen så att man akn manipulera den
    table = $('#issue-table').DataTable();
	//onclick på knappen 
	$("div.nav").html('<button id="filterButton" onclick="loadFilter()" class="fancybox fancybox.inline" href="#filter"> Filtrera listan </button> <button style="position: absolute; left:150px; top:0px;"id="showComapnyButton" onclick="showCompany()"> Mina felrapporter </button> ');
	$('#issue-table').on('click', 'td.details-control2', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
		editRow(row);
   
    } );
	if(!document.getElementById("checkCategoryShow").checked){
		console.log("Visa inte Category i listan");
		var column = table.column(1);
        column.visible( ! column.visible() );
	}
	if(!document.getElementById("checkDateShow").checked){
		var column = table.column(4);
        column.visible( ! column.visible() );
	}
	if(!document.getElementById("checkStatusShow").checked){
		var column = table.column(5);
        column.visible( ! column.visible() );
	}
	if(!document.getElementById("checkCommentShow").checked){
		var column = table.column(6);
        column.visible( ! column.visible() );
	}
	if(!document.getElementById("checkCompanyShow").checked){
		var column = table.column(7);
        column.visible( ! column.visible() );
	}
	if(!document.getElementById("checkPriorityShow").checked){
		var column = table.column(8);
        column.visible( ! column.visible() );
	}
	/* document.getElementById("checkCategoryShow").checked = true;
	document.getElementById("checkDateShow").checked = true;
	document.getElementById("checkStatusShow").checked = true;
	document.getElementById("checkCommentShow").checked = true;
	document.getElementById("checkCompanyShow").checked = true;
	document.getElementById("checkPriorityShow").checked = true; */
	
// Dölj ID columnen 
        var column = table.column(2);
        column.visible( ! column.visible() );
		column = table.column(3);
        column.visible( ! column.visible() );

var column = table.column(0);
        column.visible( ! column.visible() );
;
	
	
	
	
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
	//thisRow.addClass('details-control2');
var rowData = thisRow.data();
	console.log(rowData);
	var thisID = rowData[0];
	var currentPrio = rowData[8];
	if(currentPrio=="Ja"){

		changePriority(thisID, "Nej");
	}else{
		changePriority(thisID, "Ja");
	}
//console.log(thisMarker + "   thisID");
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
	console.log("zoomar ut. Ska visa endast "+activeCategories);
	
}
function zoomMarker(index){
 	for(var i = 0; i < markers.length; i++){

 		 if(markers[i].id == index){

			var mapCenter = new google.maps.LatLng(markers[i].latitude, markers[i].longitude);
			var mapOptions = {
				center: mapCenter,
				zoom: 18,
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
	markersToMap(activeCategories);
	}

function switchCheckboxAll(checkBox) {
			 
	var thisCategory = checkBox.value;
		console.log("switchCheckboxAll har nu värde" + checkBox.checked);
            if (checkBox.checked) {
            //	console.log(issuesCategories);
		activeCategories = issuesCategories.slice(0);
		//console.log(activeCategories);
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
			loadListIssues(activeCategories);
        }
	 
	 
	  
	function switchCheckbox2(checkBox) {
		
		var thisCategory = checkBox.value;
		if(checkBox.checked == false){
		//	console.log("checkbox för kategori "+ thisCategory+"krysades ur");
			document.getElementById('Option10').checked = false;
		}
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
		
		loadListIssues(activeCategories);
        }
	 
	 
	 
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
	/*if (thisCategory == "Fixad"){ boxId="checkStatusFixed"; }
	if (thisCategory == "Under Behandling"){ boxId="checkStatusOngoing"; }
	if (thisCategory == "Inrapporterad"){ boxId="checkStatusUnfixed"; }*/
	//console.log("Sätt checkedValue " +checkedValue+ " för kategori "+thisCategory);
	//if(!checkedValue ){

	//	document.getElementById('Option10').checked = false;
	//}
	if (boxId != ""){
		document.getElementById(boxId).checked = checkedValue;
	}
	
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
	
	   
function sortByStatus(checkBox){
	
	if (checkBox.checked){
		if (checkBox.value == "Slutförd") {
			$("#checkStatusAll").prop("checked", false);
			$("#checkStatusUnfixed").prop("checked", false);		
			$("#checkStatusOngoing").prop("checked", false);
			table.column(5)
				.search(checkBox.value)
				.draw();
			for (var i = 0; i < activeCategories.length; i++) {
                    
                    		hideCategory(activeCategories[i]);
              		 }	
			markersToMap(activeCategories);
			hideStatus("Inrapporterad");
			hideStatus("Under Behandling");
		}
		if (checkBox.value == "Under Behandling") {
			$("#checkStatusAll").prop("checked", false);
			$("#checkStatusUnfixed").prop("checked", false);
			$("#checkStatusFixed").prop("checked", false);
			table.column(5)
				.search(checkBox.value)
				.draw();
			for (var i = 0; i < activeCategories.length; i++) {
                    
                    		hideCategory(activeCategories[i]);
              		 }
			markersToMap(activeCategories);
			hideStatus("Inrapporterad");
			hideStatus("Slutförd");
		}
		if (checkBox.value == "Inrapporterad") {
			$("#checkStatusAll").prop("checked", false);		
			$("#checkStatusFixed").prop("checked", false);
			$("#checkStatusOngoing").prop("checked", false);
			table.column(5)
				.search(checkBox.value)
				.draw();
			for (var i = 0; i < activeCategories.length; i++) {
                    
                    		hideCategory(activeCategories[i]);
              		 }
			markersToMap(activeCategories);
			hideStatus("Under Behandling");
			hideStatus("Slutförd");
		}
		if (checkBox.value == "Visa Alla") {
			$("#checkStatusUnfixed").prop("checked", false);		
			$("#checkStatusFixed").prop("checked", false);
			$("#checkStatusOngoing").prop("checked", false);
			table.column(5)
				.search("")
				.draw();
			for (var i = 0; i < activeCategories.length; i++) {
                    
                    		hideCategory(activeCategories[i]);
              		 }
			markersToMap(activeCategories);
		}
	}
	else {
		$("#checkStatusAll").prop("checked", true);
		table.column(5)
			.search("")
			.draw();
		for (var i = 0; i < activeCategories.length; i++) {
                    
                    		hideCategory(activeCategories[i]);
              		 }
			markersToMap(activeCategories);
	}
	
	//table.fnMultiFilter("table.column(5)":"Fixad", "table.column(5)": "Under Behandling");
}

function hideStatus(status) {

            for (i = 0; i < markers.length; i++) {
                if (markers[i].status == status) {
                    markers[i].marker.setMap(null);
                }
            }
        
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

//--------Jquery till filterrutan-----//

$(document).ready(
	function(){
		
	
$('.leftSide').on('click','.leftSideColor',function () {
    $('.leftSideColor').removeClass('selected');
    $(this).addClass('selected')
});

	});


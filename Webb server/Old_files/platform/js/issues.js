var tr, td;

var loaded = false;
var issuesCategories = [];
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


                markersToMap(issuesCategories);
                for (var i = 0; i < issuesCategories.length; i++) {
                    hideCategory(issuesCategories[i]);
                }
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
	
    clearTable();
	
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
                showList();

            }
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
            printIssueList(newmarkers, "Fålhagen", "Address", "Category")
        }
    }

}





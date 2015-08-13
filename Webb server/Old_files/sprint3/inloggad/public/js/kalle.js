function selectInList2(thisMarker){
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
function kalle2(row){
	//console.log("Kalle");
var rowData =  row.data();
var thisId = rowData[0];
	console.log("this index: " +thisId);

}
function removePicture(){
parent.$.fancybox.close();
var index = document.getElementById("id-textbox").value;
    $.post("http://stsitkand.student.it.uu.se/sprint3/inloggad/public/database/UpdateMongoDB.php", {
        id: index,
        action: "removePicture"
	}, function(data) {
//var dataObj = JSON.parse(data);
        console.log(index);  
var thisMarker;
	for(var i = 0; i < markers.length; i++){
		if (markers[i].id == index) {
		thisMarker = markers[i];
		thisMarker.picture="";
		}
	}
                   zoomMarker(index); 
                                        
	});

}

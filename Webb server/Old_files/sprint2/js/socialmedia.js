var minDate = new Date(2015, 4, 1);
var maxDate = new Date(2015, 4, 7);
var maxTweets = 2300;
var maxTweetsOnMap = 300;
var countparam = {
    mincount : 8,
    minlength : 5,
    ignore : stopWords,
    report : false
};
var ctx;
var graph;
$(document).ready(function(){

	$(".child-1").click(function(){
		
		$('#days').fadeToggle('fast');
	});

	$(".child-2").click(function(){
		
		$('#weeks').fadeToggle('fast');
	});

	$(".child-3").click(function(){
		
		$('#months').fadeToggle('fast');
	});

	$(".child-4").click(function(){
		
		$('#choose').fadeToggle('fast');
	});

    $('.header').click(function(){
            $(this).siblings('.child-'+this.id).toggle('fast');
        });
    $('tr[class^=child-]').hide().children('tr');

    $('#radioboxes input[name=cc]:radio').change(function(){
        if ($(this).val()==='heat') {
            hideMarkers();
            showHeatmap();
        }else if($(this).val()==='markers'){
            hideHeatmap();
            showMarkers();
        }
    });


    $(".datepicker").datepicker({
                dateFormat: 'yy-mm-dd'
            }).val('');

    $("#slider").dateRangeSlider({
        arrows:false,
        bounds: {
            min: minDate,
            max: maxDate
        },
        defaultValues:{
            min: minDate,
            max: maxDate
        },
        range:{
            min: {days: 1}
        },
        step:{
            days: 1
        }    
     });
    $("#slider").on("valuesChanging", function(e, data){
        hideMarkers();
        hideHeatmap();
        heatmapData = [];
        tweetMarkers = [];
        filterDate(data.values.min, data.values.max);
     });

 	  $("#tweetknapp").click(function(){
			hideSlider();
            cleanMap();
            if(!($("#js-searcWord").val()==="")&&!($("#tweetsuntil").val()==="")&&!($("#tweetsfrom").val()==="")){
				showSlider();
                setSliderBounds(new Date($("#tweetsfrom").val().toString()), new Date($("#tweetsuntil").val().toString()));
               wordAndDateSearch();
            }else if(!($("#js-searcWord").val()==="")) {
                wordOnlySearch();
            }else if(!($("#tweetsuntil").val()==="")&&!($("#tweetsfrom").val()==="")){
				showSlider();
                setSliderBounds(new Date($("#tweetsfrom").val().toString()), new Date($("#tweetsuntil").val().toString()));
                dateOnlySearch();
            }else{
                alert('ogiltig sökning!');
            }
        });
});
function wordOnlySearch(){    
    $.post("db/tweetSearch.php",{        
        searchWord : $("#js-searcWord").val().match(/\b[åäö]|[A-Za-z0-9_åäö@]+(-[A-Za-z0-9_åäö@]+)*|[åäö]\b/g)      
        },
        function(data){
                createTweetArray(data[0], tweets);
                createHeatmapArray();
                setHeatMap();
                createTweetInfoWindow();
                createTweetMarkerArray();
				paintMap();
                drawGraph(data[4]);				
            resultText($("#js-searcWord").val(),data[2],data[1]);
            $("#js-searcWord").val('');
            //reloadPlotly();
            stringToCloud(makeString(data[0],data[3]));
        },'json');
    
}
function dateOnlySearch(){    
    $.post("db/tweetdate.php",{
        from : $("#tweetsfrom").val(),
        until : $("#tweetsuntil").val()        
    },function(data){
            createTweetArray(data[0], tweets);
            createHeatmapArray();
            setHeatMap();
            createTweetInfoWindow();
            createTweetMarkerArray();
			paintMap();
            drawGraph(data[4]);
            resultText($("#js-searcWord").val(),data[2],data[1]);
            $("#js-searcWord").val('');
            $(".datepicker").val('');
            //reloadPlotly();
            stringToCloud(makeString(data[0],data[3]));
    },'json');
}

function wordAndDateSearch(){
    
    $.post("db/tweetdateandword.php",{
        searchWord : $("#js-searcWord").val().match(/\b[åäö]|[A-Za-z0-9_åäö@]+(-[A-Za-z0-9_åäö@]+)*|[åäö]\b/g),
        from : $("#tweetsfrom").val(),
        until : $("#tweetsuntil").val()
    },function(data){
            createTweetArray(data[0], tweets);
            createHeatmapArray();
            setHeatMap();
            createTweetInfoWindow();
            createTweetMarkerArray();
			paintMap();
            drawGraph(data[4]);
            resultText($("#js-searcWord").val(),data[2],data[1]);
            $("#js-searcWord").val('');
            $(".datepicker").val('');
            //reloadPlotly();
            stringToCloud(makeString(data[0],data[3]));
    },'json');
}



function resultText(searchText,result,total){
	$('#result').text(result);
	$('.statistic_1').text("Antal träffar:");
    //$("#tweetResult").text(result + '/' + total + " med sökordet: " + searchText);
}
function cleanMap(){
    hideHeatmap();
    hideMarkers();

    tweets=[];
    tweetMarkers = [];
    heatmapData = [];

    hideSlider();
}
function setSliderBounds(d1,d2){
    $('#slider').dateRangeSlider('bounds',d1,d2);
    $('#slider').dateRangeSlider('values',d1,d2);
}
function filterDate(minDate, maxDate){
    for (i = 0 ; i < tweets.length ; i++){
        if (tweets[i].date.getTime() >= minDate.getTime() && tweets[i].date.getTime() < maxDate.getTime()){
            var LatLng = new google.maps.LatLng(tweets[i].latitude, tweets[i].longitude);
            heatmapData.push(LatLng);
            createOneMarker(i);
        }
    }
setHeatMap();
paintMap();
}
function stringToCloud(rawString){
    var option = {};
    option.list = [];
	var firstList = [];
	var biggestWordsize = 42;
    //option.weightFactor = 0.3;
    option.wait = 100;
    var wordCounter = new WordCounter(countparam);
    wordCounter.count(rawString,function(result,logs){
        for (i = 0;i<result.length;i++){
            var temp = [result[i].word,result[i].count.toString()];
            firstList.push(temp);
        }
		optionListParser();
    });
	
	function optionListParser(){
		var finalList = [];	
		//-------------Ellens Kod ----------------
		if (firstList.length < 3) {
			console.log("liten");
		}else {
			for(i = 0;i<firstList.length; i++){
				finalList.push(firstList[i]);
			}
			option.list=finalList;
			console.log(finalList[0][1]);
			option.weightFactor = (biggestWordsize*1.0)/parseInt(finalList[0][1]);
			WordCloud($('#socialWordcloud')[0],option)
		}
		
			
		//----------------------------------------
		
		//option.weightFactor = ngt?,		
	}
}


function paintMap(){
    checkIfMarker();
    var radioval = $('input[name=cc]:checked','#radioboxes').val();
    if (radioval==='heat'){
        showHeatmap();
    }else if(radioval==='markers'){
        showMarkers();
    }    
}

function checkIfMarker(){
    console.log(tweetMarkers.length);
    if (tweetMarkers.length>maxTweetsOnMap){
        $('#c1').attr('disabled',true);
        $('#radioMark').text('Inaktiverad');
        $('#c2').prop('checked',true);
    }else {
        $('#c1').attr('disabled',false);
        $('#radioMark').text('Tweetpins');
    }
}

function makeString(dataArray1, dataArray2){
    var output = '';
    var upperBound = maxTweets-dataArray1.length;
    for (i = 0; i<dataArray1.length; i++){
        output += dataArray1[i].Text
    }
	console.log(dataArray2[0].Text);
    if(upperBound>0){
		if(upperBound>dataArray2.length){
			upperBound=dataArray2.length;
		}
    for (i = 0; i<upperBound; i++){
        output += dataArray2[i].Text
    }
    }
    return output.toLowerCase();
}
//--------------- RITAR GRAF --------------------------

function drawGraph(data) {
    var yArray = new Array;
    var xArray = [];

    for(var o in data) {
    yArray.push(data[o]);
    }

    xArray = Object.keys(data);

   var plotData = {
    labels: xArray,
    datasets: [
        {
            label: "Tweets over time",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: yArray
        },
        
    ]
};

if (typeof(graph) !== 'undefined') {
graph.destroy();
}

ctx = $("#plotCanvas").get(0).getContext("2d");

graph = new Chart(ctx).Bar(plotData, {
    labelsFilter: function(value,index){  
        return !((index)%2==0);
    },
    //pointDot: false,
    //pointHitDetectionRadius : 1,
    
  });  


}
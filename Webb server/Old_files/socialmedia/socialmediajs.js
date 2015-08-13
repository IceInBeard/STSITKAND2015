var minDate = new Date(2015, 4, 1);
var maxDate = new Date(2015, 4, 7);
var maxTweets = 700;
var countparam = {
    mincount : 8,
    minlength : 5,
    ignore : stopWords,
    report : false
};
var ctx;
var graph;

$(document).ready(function(){
    

    $("#js-showTweets").click(function(){
        showMarkers();
    });


    $("#js-destroyGraph").click(function(){
        graph.destroy();
    });

	$("#js-removeTweets").click(function(){
		hideMarkers();
	});
    $("#js-showHeat").click(function(){
        showHeatmap();
    });
    $("#js-hideHeat").click(function(){
        hideHeatmap();
    });
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
        

        //console.log("Something moved. min: " + data.values.min + " max: " + data.values.max);
        //console.log(data.values.min.toString());
        //console.log(data.values.max.toString());
     });

        $("#tweetSearchButton").click(function(){

            

            cleanMap();
            if(!($("#js-searcWord").val()==="")&&!($("#tweetsuntil").val()==="")&&!($("#tweetsfrom").val()==="")){
                setSliderBounds(new Date($("#tweetsfrom").val().toString()), new Date($("#tweetsuntil").val().toString()));
               wordAndDateSearch();
            }else if(!($("#js-searcWord").val()==="")) {
                wordOnlySearch();
            }else if(!($("#tweetsuntil").val()==="")&&!($("#tweetsfrom").val()==="")){
                setSliderBounds(new Date($("#tweetsfrom").val().toString()), new Date($("#tweetsuntil").val().toString()));
                //console.log(new Date($("#tweetsuntil").val().toString()));
                dateOnlySearch();
            }else{
                alert('ogiltig sökning!');
                //var msg = $('input[name=mapui]:checked','#mapuiform').val();
                //console.log(msg);
            }
        });
        $(".datepicker").datepicker({
                dateFormat: 'yy-mm-dd'
            }).val('');
        $('#mapuiform input[name=mapui]:radio').change(function(){
        if ($(this).val()==='heat') {
            hideMarkers();
            showHeatmap();
        }else if($(this).val()==='marker'){
            hideHeatmap();
            showMarkers();
        }
    });
            
});

function wordOnlySearch(){    
    $.post("tweetSearch.php",{        
        searchWord : $("#js-searcWord").val().match(/\b[åäö]|[A-Za-z0-9_åäö@]+(-[A-Za-z0-9_åäö@]+)*|[åäö]\b/g)       
        },
        function(data){
                createTweetArray(data[0], tweets);
                createHeatmapArray();
                setHeatMap();
                createInfoWindow();
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
    $.post("tweetdate.php",{
        from : $("#tweetsfrom").val(),
        until : $("#tweetsuntil").val()        
    },function(data){
            createTweetArray(data[0], tweets);
            createHeatmapArray();
            setHeatMap();
            createInfoWindow();
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
    
    $.post("tweetdateandword.php",{
        searchWord : $("#js-searcWord").val().match(/\b[åäö]|[A-Za-z0-9_åäö@]+(-[A-Za-z0-9_åäö@]+)*|[åäö]\b/g),
        from : $("#tweetsfrom").val(),
        until : $("#tweetsuntil").val()
    },function(data){
            createTweetArray(data[0], tweets);
            createHeatmapArray();
            setHeatMap();
            createInfoWindow();
            createTweetMarkerArray();
            paintMap();
            resultText($("#js-searcWord").val(),data[2],data[1]);
            $("#js-searcWord").val('');
            $(".datepicker").val('');
            //reloadPlotly();
            stringToCloud(makeString(data[0],data[3]));
    },'json');
}


function cleanMap(){
    hideHeatmap();
    hideMarkers();
    tweets=[];
    tweetMarkers = [];
    heatmapData = [];
}


function reloadPlotly(){
    $("#gustav").attr('src',$("#gustav").attr('src')+'');
}
function resultText(searchText,result,total){
    $("#tweetResult").text(result + '/' + total + " med sökordet: " + searchText);
}

function setSliderBounds(d1,d2){
    $('#slider').dateRangeSlider('bounds',d1,d2);
    $('#slider').dateRangeSlider('values',d1,d2);
}
//------------------ ÄNDRAD--------------------------
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
/*if ($('input[name=mapui]:checked','#mapuiform').val()==='heat'){
    showHeatmap();
}else if($('input[name=mapui]:checked','#mapuiform').val()==='marker'){
    showMarkers();
}*/
}
//----------------------------------------NYA FUNKTIONER------------------------------
function paintMap(){
    var radioval = $('input[name=mapui]:checked','#mapuiform').val();
    if (radioval==='heat'){
        showHeatmap();
    }else if(radioval==='marker'){
        showMarkers();
    }    
}
//---------------------------------------------------------------------------------
function stringToCloud(rawString){
    console.log('2');
    var option = {};
    option.list = [];
    option.weightFactor = 2;
    option.wait = 100;
    var wordCounter = new WordCounter(countparam);
    wordCounter.count(rawString,function(result,logs){
        for (i = 0;i<result.length;i++){
            var temp = [result[i].word,result[i].count.toString()];
            option.list.push(temp);
        }
        WordCloud($('#wordCloudCanvas')[0],option)
    });
}
//-------------------------ÄNDRAD-------------------------
function makeString(dataArray1, dataArray2){
    var output = '';
    var upperBound = maxTweets-dataArray1.length;
    for (i = 0; i<dataArray1.length; i++){
        output += dataArray1[i].Text
    }
    if(upperBound >dataArray2.length){
        upperBound=dataArray2.length;
    }
    if(upperBound>0){
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
graph = new Chart(ctx).Line(plotData, {
    labelsFilter: function(value,index){  
        return !((index)%2==0);
    },
    pointDot: false,
    pointHitDetectionRadius : 5,
    legendTemplate : '<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>'
  });  
}
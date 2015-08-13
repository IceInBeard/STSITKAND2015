

var minDate = new Date(2015, 4, 1);
var maxDate = new Date(2015, 4, 7);
var maxTweets = 2300;
var maxTweetsOnMap = 300;
var countparam = {
    mincount : 8
    ,
    minlength : 5,
    ignore : stopWords,
    report : false
};
var ctx;
var graph;
var loadingCC1;
var loadingCC2;

$(document).ready(function(){


    $('.areaViewBox').change(function(){
        toggleDisable(this.checked);
        toggleAreaView(this.checked);         
    });

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

    
    $('.gm-style-iw').css("background","#ff0000");

    $("#tweetsfrom").datepicker({
                dateFormat: 'yy-mm-dd',
                //defaultDate: new Date(),
                minDate: '2015-04-16',
                maxDate: '+0d',
				onClose: function(selectedDate){
					$('#tweetsuntil').datepicker("option","minDate",selectedDate);
				}
    });
	$("#tweetsuntil").datepicker({
        dateFormat: 'yy-mm-dd',
        //defaultDate:  new Date(),
        minDate: '2015-04-16',
        maxDate: '+0d',
		onClose: function(selectedDate){
					$('#tweetsfrom').datepicker("option","maxDate",selectedDate);
				}
    });


    var canvas1 = $('#socialWordcloud')[0];
    var ctx1 = canvas1.getContext('2d');
    ctx1.font = "19px Arial";
    ctx1.fillStyle = "#005389";
    ctx1.textAlign = "center";
    ctx1.fillText("Gör en sökning", canvas1.width/2, canvas1.height/2 +10);
    var canvas2 = $('#plotCanvas')[0];
    var ctx2 = canvas2.getContext('2d');
    ctx2.font = "19px Arial";
    ctx2.fillStyle = "#005389";
    ctx2.textAlign = "center";
    ctx2.fillText("Gör en sökning", canvas2.width/2, canvas2.height/2);

    /*ctx = $("#plotCanvas").get(0).getContext("2d");
    ctx.font="20px Georgia";
    ctx.fillText("Hello World!",50,50);
    */
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
            validSearch();
            clearWordCloud();
			hideSlider();
            cleanMap();
            if(!($("#js-searcWord").val()==="")&&!($("#tweetsuntil").val()==="")&&!($("#tweetsfrom").val()==="")){
				
                loadingAnimation();
                /*if(!($("#tweetsfrom").val()===$("#tweetsuntil").val())){
                    showSlider();
                    setSliderBounds(new Date($("#tweetsfrom").val().toString()), new Date($("#tweetsuntil").val().toString()));
                }*/
                wordAndDateSearch();
            }else if(!($("#js-searcWord").val()==="")&&($("#tweetsuntil").val()==="")&&($("#tweetsfrom").val()==="")){
                
                loadingAnimation();
                wordOnlySearch();
            }else if(!($("#tweetsuntil").val()==="")&&!($("#tweetsfrom").val()==="")){
				loadingAnimation();
                /*if(!($("#tweetsfrom").val()===$("#tweetsuntil").val())){
                    showSlider();
                    setSliderBounds(new Date($("#tweetsfrom").val().toString()), new Date($("#tweetsuntil").val().toString()));
                }*/
                dateOnlySearch();
            }else{
                errorSearch();
            }
        });
});

function areaSearch(areaName){
    clearWordCloud();
    hideSlider();
    cleanMap();
    loadingAnimation();
    $.post("db/areaSearch.php",{
        area : areaName
    },function(data){
        readyForShow();
        stringToCloud(makeString(data[0],[]));
        if (data[0].length!==0){
        drawGraph(data[1],false);
        }
    },'json');
    /*validSearch();
    clearWordCloud();
    hideSlider();
    cleanMap();
    loadingAnimation();
    //console.log(areaName);
    //console.log(decodeURIComponent(escape(areaName)));
    $.ajax({
        type: 'POST',
        data: {area:  "kuk"},
        url: "db/areaSearch.php",
        dataType: 'text',
        //contentType : 'application/x-www-form-urlencoded;charset=ISO-8859-15', 
        success: function(data){
            /*readyForShow();
            stringToCloud(makeString(data));
            console.log(data);
        }

    });*/
}
function wordOnlySearch(){    
    $.post("db/tweetSearch.php",{        
        searchWord : $("#js-searcWord").val().match(/\b[åäö]|[A-Za-z0-9_åäö@]+(-[A-Za-z0-9_åäö@]+)*|[åäö]\b/g)      
        },
        function(data){
                var isCoordTweets = (data[0].length!==0);
                createTweetArray(data[0], tweets);
                createHeatmapArray();
                setHeatMap();
                createTweetInfoWindow();
                createTweetMarkerArray();
				paintMap();
                readyForShow(); 
                drawGraph(data[4],isCoordTweets);			
                resultText($("#js-searcWord").val(),data[2],data[1]);
                stringToCloud(makeString(data[0],data[3]));
        },'json');
    
}

function dateOnlySearch(){    
    console.log("inne i funk");
    $.post("db/tweetdate.php",{
        from : $("#tweetsfrom").val(),
        until : $("#tweetsuntil").val()        
    },function(data){
            var isCoordTweets = (data[0].length!==0);
            console.log("callback");
            createTweetArray(data[0], tweets);
            createHeatmapArray();
            setHeatMap();
            createTweetInfoWindow();
            createTweetMarkerArray();
			paintMap();
            readyForShow(); 
            drawGraph(data[4],isCoordTweets);
            resultText($("#js-searcWord").val(),data[2],data[1]);
            stringToCloud(makeString(data[0],data[3]));
    },'json');
}

function wordAndDateSearch(){
    
    $.post("db/tweetdateandword.php",{
        searchWord : $("#js-searcWord").val().match(/\b[åäö]|[A-Za-z0-9_åäö@]+(-[A-Za-z0-9_åäö@]+)*|[åäö]\b/g),
        from : $("#tweetsfrom").val(),
        until : $("#tweetsuntil").val()
    },function(data){
            var isCoordTweets = (data[0].length!==0);
            createTweetArray(data[0], tweets);
            createHeatmapArray();
            setHeatMap();
            createTweetInfoWindow();
            createTweetMarkerArray();
			paintMap();
            readyForShow(); 
            drawGraph(data[4],isCoordTweets);
            resultText($("#js-searcWord").val(),data[2],data[1]);
            stringToCloud(makeString(data[0],data[3]));
    },'json');
}

function resultText(searchText,result,total){
    $('#number-of-hits').text("Antal träffar:");
	$('#result').text(result);
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
    d2.setDate(d2.getDate()+1);
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
    var wordCounter = new WordCounter(countparam);
    var option = {};
	var firstList = [];
	var biggestWordsize = 45;
    option.list = [];
    var minWordSize = 3;
    //option.minSize = 8;
    option.wait = 100;
    wordCounter.count(rawString,function(result,logs){
        if(result.length!==0){
            for (i = 0;i<result.length;i++){
                var temp = [result[i].word,result[i].count.toString()];
                firstList.push(temp);
            }
		  optionListParser();
        }else{
            var canvas = $('#socialWordcloud')[0];
            var ctx1 = canvas.getContext('2d');
            ctx1.font = "19px Arial";
            ctx1.fillStyle = "#005389";
            ctx1.textAlign = "center";
            ctx1.fillText("Sökningen gav för få ord", canvas.width/2, canvas.height/2);

        }
    });
	


function optionListParser(){
    var wordColor = function (){
     return 'rgb(' + 
        Math.floor(Math.random() * 150).toString(10) + ',' +
        Math.floor(140 + Math.random() * 82).toString(10) + ',' +
        Math.floor(250 + Math.random() * 5).toString(10) + ')'; 
    }
	var finalList = [];	
		for(var i = 0;i<firstList.length; i++){
            /*if(parseInt(firstList[i][1])*(biggestWordsize * 1.0)/parseInt(firstList[0][1])<minWordSize){
                console.log(firstList[i][1]);
                firstList[i][1]=minWordSize.toString();
            }*/
			finalList.push(firstList[i]);
			}

    option.list = finalList;
	option.weightFactor = (biggestWordsize * 1.0)/parseInt(finalList[0][1]);
    option.color = wordColor;
	WordCloud($('#socialWordcloud')[0], option);			
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

//---------------------------sortera data--------------------
function graphDataSort(xArray,yArray){
    while(bytintill(xArray)){        
    }
    function bytintill(){
        var bool = false;
        for(var i =0;i<xArray.length-1;i++){
            if(xArray[i]>xArray[i+1]){
                var temp1= xArray[i];
                xArray[i]=xArray[i+1];
                xArray[i+1]=temp1;
                var temp2= yArray[i];
                yArray[i]=yArray[i+1];
                yArray[i+1]=temp2;
                bool=true;
            }
        }
        return bool;
    }
}


//--------------- RITAR GRAF --------------------------

function drawGraph(data,wOnly) {
    var yArray = new Array;
    var xArray = new Array;
    for(var o in data) {
    yArray.push(data[o]);
    }    
    for(var k in data){
        xArray.push(k);
    }
    graphDataSort(xArray,yArray);
    if(wOnly&&(new Date(xArray[0])!== new Date(xArray[xArray.length-1]))){
        //console.log(new Date(xArray[xArray.length-1]));
        showSlider();
        setSliderBounds(new Date(xArray[0]),new Date(xArray[xArray.length-1]));
    }
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
    }    
  });  
}
//----------STÄDA UPP WC-----------------
function clearWordCloud(){
    var canvas = $('#socialWordcloud')[0];
    var context = canvas.getContext('2d');
    context.textAlign = "start";
    context.clearRect(0,0,canvas.width,canvas.height);
}


//---------------------------LOADING CIRCLE----------------
function loadingAnimation(){
    $('#plotCanvas').hide();
    $('#socialWordcloud').hide();
    loadingCC1 = new CanvasLoader('canvas-container-1');
    loadingCC2 = new CanvasLoader('canvas-container-2');
    loadingCC1.setColor('#64A8F2');
    loadingCC1.setShape('spiral');
    loadingCC1.setDiameter(60);
    loadingCC1.setDensity(33);
    loadingCC1.setRange(1.2);
    loadingCC2.setColor('#64A8F2');
    loadingCC2.setShape('spiral');
    loadingCC2.setDiameter(60);
    loadingCC2.setDensity(33);
    loadingCC2.setRange(1.2);
    loadingCC1.show();
    loadingCC2.show();
}


//-------------------------Show Canvases--------------
function readyForShow(){
    loadingCC1.kill();
    loadingCC2.kill();
    $('#plotCanvas').show();
    $('#socialWordcloud').show();
}

//-----------------------FEL I SÖKNINGEN-----------------------
function errorSearch(){
    if(($("#js-searcWord").val()==="")&&($("#tweetsuntil").val()==="")&&($("#tweetsfrom").val()==="")){
        $('#js-searcWord').css('border-color','red');
        $('#tweetsfrom').css('border-color','red');
        $('#tweetsuntil').css('border-color','red');
        $('.errorText').html('Fyll i fälten!').slideDown();
    }else if(!($("#tweetsuntil").val()==="")){
        $('#tweetsfrom').css('border-color','red');
        $('.errorText').html('Välj ett slutdatum').slideDown();
    }else if(!($("#tweetsfrom").val()==="")){
        $('#tweetsuntil').css('border-color','red');
        $('.errorText').html('Välj ett startdatum').slideDown();
    }

}
function validSearch(){
    $('.errorText').slideUp();
    $('#js-searcWord').css('border-color','#F1F1F0');
    $('#tweetsfrom').css('border-color','#F1F1F0');
    $('#tweetsuntil').css('border-color','#F1F1F0');
}
function toggleDisable(checked){
    $('#js-searcWord, .searchArea :input, #c1,#c2').each(function(){
        $(this).prop('disabled', checked);
    });
}
function toggleAreaView(checked){
    map.data.revertStyle();
    map.data.setStyle({visible: checked});
}
function createAreaLayer(){
    $.getJSON('js/GeJSONtest.json', function( data ) {
        console.log(data);
    map.data.addGeoJson(data);
    });
    var featureStyle = {
     fillColor: 'pink',
     strokeWeight: 1
    }
     map.data.setStyle(featureStyle);
     map.data.addListener('mouseover', function(event) {
        map.data.revertStyle();
        map.data.overrideStyle(event.feature,{fillColor : 'red'});
    });
    map.data.addListener('mouseout', function(event) {
        map.data.revertStyle();
    });
    map.data.addListener('click', function(e) {
        areaSearch(e.feature.getProperty('name'));
    });
    map.data.setStyle({visible: false});
}
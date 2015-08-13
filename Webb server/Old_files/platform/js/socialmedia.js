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


    $( ".datepicker" ).datepicker({
    	dateFormat: 'dd-mm-yy'
    });



 	  $("#tweetknapp").click(function(){
 	  		
           if(!($("#js-searcWord").val()==="")&&!($("#tweetsuntil").val()==="")&&!($("#tweetsfrom").val()==="")){
               tweetDateSearch();
            }else if(!($("#js-searcWord").val()==="")) {
                twitterSearch();
            }else if(!($("#tweetsuntil").val()==="")&&!($("#tweetsfrom").val()==="")){
                tweetsBetween();
            }else{
                getTwitterData();
            }
            
        });
});

function getTwitterData(){

	$.post("db/twitterdata.php",{},function(data){
            clearAllTweets();
            
                createTweetArray(data, tweets);
                createTweetInfoWindow();
                tweetsToMap();
            if ($("#tweetOnMap").is(":checked")){
                createTweetArray(data, tweets);
                createTweetInfoWindow();
                tweetsToMap();
                $("#tweetOnMap").attr('checked',false);
            }
            reloadPlotly();
		}

	,'json');

}

function twitterSearch(){
    
    $.post("db/tweetSearch.php",{
        
        searchWord : $("#js-searcWord").val()
        
        },
        function(data){
            clearAllTweets();
                createTweetArray(data[0], tweets);
                createTweetInfoWindow();
                tweetsToMap();         
            if ($("#tweetOnMap").is(":checked")){
                createTweetArray(data[0], tweets);
                createTweetInfoWindow();
                tweetsToMap();         
                $("#tweetOnMap").attr('checked',false);
            }
            resultText($("#js-searcWord").val(),data[2],data[1]);
            $(".datepicker").val('');
            $("#js-searcWord").val('');
            reloadPlotly();
        },'json');
    
}
function tweetsBetween(){
    
    $.post("db/tweetdate.php",{
        from : $("#tweetsfrom").val(),
        until : $("#tweetsuntil").val()        
    },function(data){
            clearAllTweets();
            console.log(data[0]);
            createTweetArray(data[0], tweets);
                createTweetInfoWindow();
                tweetsToMap();
            if ($("#tweetOnMap").is(":checked")){
                createTweetArray(data[0], tweets);
                createTweetInfoWindow();
                tweetsToMap();         
                $("#tweetOnMap").attr('checked',false);
            }
            resultText($("#js-searcWord").val(),data[2],data[1]);
            $(".datepicker").val('');
            $("#js-searcWord").val('');
            reloadPlotly();
    },'json');
}

function tweetDateSearch(){
    
    $.post("db/tweetdateandword.php",{
        searchWord : $("#js-searcWord").val(),
        from : $("#tweetsfrom").val(),
        until : $("#tweetsuntil").val()
    },function(data){
            clearAllTweets();
                createTweetArray(data[0], tweets);
                createTweetInfoWindow();
                tweetsToMap();
            if ($("#tweetOnMap").is(":checked")){
                createTweetArray(data[0], tweets);
                createTweetInfoWindow();
                tweetsToMap();
                $("#tweetOnMap").attr('checked',false);
            }
            resultText($("#js-searcWord").val(),data[2],data[1]);
            $(".datepicker").val('');
            $("#js-searcWord").val('');
            reloadPlotly();
    },'json');
}

function reloadPlotly(){
	if($('#gustav').length){
    $("#gustav").attr('src',$("#gustav").attr('src')+'');
}}

function resultText(searchText,result,total){
	$('#result').text(result + '/' + total);
	$('#searchword').text(searchText);
    //$("#tweetResult").text(result + '/' + total + " med sökordet: " + searchText);
}

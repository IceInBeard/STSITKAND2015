$(document).ready(function() {

	  var id = 'loadAnimation', fill = '#fff',
      size = 20, radius = 3, duration = 1000,
      maxOpacity = 0.6, minOpacity = 0.15;
  $('<svg id="'+id+'" width="'+(size*3.5)+'" height="'+size+'">' + 
   		'<rect width="'+size+'" height="'+size+'" x="0" y="0" rx="'+radius+'" ry="'+radius+'" fill="'+fill+'" fill-opacity="'+maxOpacity+'">' + 
   			'<animate attributeName="opacity" values="1;'+minOpacity+';1" dur="'+duration+'ms" repeatCount="indefinite"/>' + 
   		'</rect>' + 
    	'<rect width="'+size+'" height="'+size+'" x="'+(size*1.25)+'" y="0" rx="'+radius+'" ry="'+radius+'" fill="'+fill+'" fill-opacity="'+maxOpacity+'">' + 
    		'<animate attributeName="opacity" values="1;'+minOpacity+';1" dur="'+duration+'ms" begin="'+(duration/4)+'ms" repeatCount="indefinite"/>' + 
    	'</rect>' + 
    	'<rect width="'+size+'" height="'+size+'" x="'+(size*2.5)+'" y="0" rx="'+radius+'" ry="'+radius+'" fill="'+fill+'" fill-opacity="'+maxOpacity+'">' + 
    		'<animate attributeName="opacity" values="1;'+minOpacity+';1" dur="'+duration+'ms" begin="'+(duration/2)+'ms" repeatCount="indefinite"/>' + 
    	'</rect>' + 
   	'</svg>').appendTo('body');

 
    setTimeout(function(){
        $('body').addClass('loaded');
        $('h1').css('color','#222222');
	$('#loadAnimation').css('display','none');
    }, 5000);
 
});




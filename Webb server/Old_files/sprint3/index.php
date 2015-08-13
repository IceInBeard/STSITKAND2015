<?php
include 'header.php';

$serviceMessage = displayServiceMessage($mysqli);

?>
<script type="text/javascript"> 

$('html').bind('keypress', function(e)
{
   if(e.keyCode == 13)
   {
      return false;
   }
});



</script>


        




<div class='loadmessage'>Sidan laddar...</div>

<div id="loader-wrapper">
    <div id="loader">  </div>
 
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
 
</div>


<div id="container">
	<div id="content">
		<div id='message-container'>  <?php  echo $serviceMessage[0]; ?></div>
<?php if($serviceMessage[1] != 1) : ?>   
<div id='map-container'>      

	<div id='map-timeslider-container'><div id="slider"></div> </div>

	<div id='map'></div>


	

	<div id='tabmenu'>
		<ul id='tabs'>
			<li><a href="#" name="tabhem">Hem</a></li>
			<li><a href="#" name="tabsocial">Twitter</a></li>
			<li><a href="#" name="tabissue">Felrapportering</a></li>
			<li><a href="#"name="tabcykel" >Cykel</a></li>
			<button onclick='clearMap(checkPump)' id="clearButton">Rensa karta </button>



		</ul>


			


		<div id='tabcontent'>
			<div id="tabhem">
			<div id="welcome-leftcontainer"><img src="img/UppsalaSmartCityBlue.png" /> 
				<strong> Hej och välkommen till Uppsala Smart City! </strong>
				<p>
				På denna sida finner du informationsflöden inom olika sammanhang från staden representerat via en interaktiv karta. Idag finns möjligheten att:<br>
				<ul>
					<li>söka bland Uppsala-relaterade tweets för att se sociala trender </li>
					<li>se och göra felrapporteringar angående problem i staden </li>
					<li>se Uppsalas tillgängliga cykeltjänster samt aktuella och historiska cykeltrafikflöden från sensorer i staden </li>
				</ul>
</p>
<p><img style="float:left; margin-right: 5px;" src="img/androidmarket.png" />
Vill du göra felrapporteringar via din mobil? Ladda ner vår app <i>Felrapportering Uppsala</i>!
</p>

			</div>	
			<div id="middle-container">
				
				<!--<a class="twitter-timeline" href="https://twitter.com/hashtag/uppsala" data-widget-id="600286478925717504">#uppsala Tweets</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				-->
				<a class="twitter-timeline" data-chrome="nofooter" data-dnt="true" href="https://twitter.com/search?q=uppsala%20OR%20uppsalakommun%20OR%20uppsalauniversitet%20OR%20teknat%20OR%20uppsalaekonomerna%20OR%20juridiskaforeningen%20OR%20entrepreneursacademy%20OR%20valborg%20OR%20kvalborg%20OR%20forsr%C3%A4nningen%20OR%20domkyrka%20OR%20stocken%20OR%20snerikes%20OR%20vedala%20OR%20gotlands%20OR%20uppland%20OR%20upplands%20OR%20g%C3%A4strike-h%C3%A4lsinglands%20OR%20v%C3%A4stg%C3%B6tas%20OR%20uppsalatech%20OR%20konsertkongress%20OR%20fyris%C3%A5n%20OR%20fyris%20OR%20svandammshallarna%20OR%20studenternas%20OR%20sirius%20OR%20stadsskogen%20OR%20bl%C3%A5senhus%20OR%20rediviva%20-lund%20near%3A%22Uppsala%2C%20Sverige%22%20within%3A15mi" data-widget-id="601304187591389185">Tweets about uppsala OR uppsalakommun OR uppsalauniversitet OR teknat OR uppsalaekonomerna OR juridiskaforeningen OR entrepreneursacademy OR valborg OR kvalborg OR forsränningen OR domkyrka OR stocken OR snerikes OR vedala OR gotlands OR uppland OR upplands OR gästrike-hälsinglands OR västgötas OR uppsalatech OR konsertkongress OR fyrisån OR fyris OR svandammshallarna OR studenternas OR sirius OR stadsskogen OR blåsenhus OR rediviva -lund near:"Uppsala, Sverige" within:15mi</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</div>	
			<div id="right-container">
			<div id="weather-background"></div><div id="weather"></div>
			</div>
			<div id="right-container-down">
			<span class="amountToday" id="bikes">
			<?php include 'db/todaysBikes.php'; ?></span><p id="cyklister-idag">cyklister idag</p>
			
			<p id="cyklister-idag">Totalt </p><span class="amountToday" id="bikes">
			<?php include 'db/todaysIssues.php'; ?></span><p id="cyklister-idag">felrapporteringar</p>		
				
			
			<span class="amountToday" id="tweets">
			<?php include 'db/todaystweets.php'; ?>
			</span><p id="tweets-idag">antal tweets idag</p>
			</div>	
			</div>
			<div id="tabsocial"> 
			
					<?php include 'widgets/socialmainwidget.php'; ?>
				

			</div>
			<div id="tabissue"> 
				
				<?php include 'widgets/issuemainwidget.php'; ?>

			</div>
			<div id="tabcykel"> 

				<?php include 'widgets/cykelmainwidget.php'; ?> 

			</div>

		</div>

	</div>


</div>


<div id='widget-container'>


</div>

<div id='subwidget-container'>

</div>



    <?php  endif; ?>
			</div> <!-- container -->
		</div> <!-- content -->

		


<?php
include 'footer.php';
?>

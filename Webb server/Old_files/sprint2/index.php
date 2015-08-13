<?php
include 'header.php';
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


<div id="container">
	<div id="content">

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
			<div id="welcome-leftcontainer">Hej och välkommen till en smart plattform för staden Uppsala! Här hittar du massa fin information om bland annat vad som twittras i staden och sådant som underlättar cyklisters tillvaro. 
			Du har även möjlighet att se aktuella felanmälningar samt göra egna felanmälningar.</div>	
			<div id="middle-container"><p>Antal cyklister idag, Hamnspången:</br><span class="amountToday"><?php include 'db/todaysBikes.php'; ?></span></p>
<p>Antal tweets idag:</br><span class="amountToday"><?php include 'db/todaystweets.php'; ?></span></p>
</div>	
			<div id="right-container"><div id="weather"></div></div>	
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



    
			</div> <!-- container -->
		</div> <!-- content -->


<?php
include 'footer.php';
?>

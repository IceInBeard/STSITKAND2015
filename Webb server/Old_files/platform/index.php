<?php
include 'header.php';


$serviceMessage = displayServiceMessage($mysqli);

?>
<div id="container">
	<div id="content">

<div id='map-container'>  

<div id='message-container'>  <?php  echo $serviceMessage[0]; ?></div>

        <?php if($serviceMessage[1] != 1) : ?>   


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
			<div id="welcome-leftcontainer"> Hej och välkommen till en smart plattform för staden Uppsala! Här hittar du massa fin information om bland annat vad som twittras i staden och sådant som underlättar cyklisters tillvaro. 
			Du har även möjlighet att se aktuella felamnälningar samt göra egna felanmälningar. </div>	


			<div id="middle-container">Antal cyklister idag:</div>	
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


				<?php  endif; ?>
    
			</div> <!-- container -->
		</div> <!-- content -->


<?php
include 'footer.php';
?>

<?php
include 'header.php';

if (login_check($mysqli) == false) {
    header("Location: login.php");
}

?>
<div id="container-wide">
    <div id="content">
    	<div id="left-column">

		<div class="showW1">

			<div class='widget'>
					<!--<div class='widgethead'>
						<img src="https://cdn.serinus42.com/2736c696f21f302/uploads/c/300/a4e0b/twitter-logo_22.png" alt="Twitters logotyp"> Twitter </div>-->

<div class="socialmeidawidget">


	 <div class="top">

		<img id="twitterLogga" src="https://cdn.serinus42.com/2736c696f21f302/uploads/c/300/a4e0b/twitter-logo_22.png" alt="Twitters logotyp"> <p class="twitterText">Twitter</p>

	</div>



	<div class="left">


			<div = class="top_0" id="veck_0">
				<img id="twitterPin" src="http://icons.iconarchive.com/icons/icons-land/vista-map-markers/256/Map-Marker-Marker-Outside-Azure-icon.png">
				<p class="startText">Sök efter tweets på kartan</p>
				<p class="startVal">Välj mellan ett eller två val</p>
			</div>
			</br>
			<div = class="top_1" id="veck_1">
				<p class="searchText"><strong>Val 1</strong> - sök efter ett ord</p>


				<form method="get" id="search">
            		  <input type="text" class="search" placeholder="Sökord" 
            		  onblur="if(this.value == '') { this.value = 'Type and hit enter'; }" 
            		  onfocus="if(this.value == 'Type and hit enter') { this.value = ''; }" name="s"
            		  id='js-searcWord'>
              		<!--<button type="submit">Submit</button>-->
				</form>
			</div>	



			<div class="bottom_1" id="veck_2">
				<p class="searchText"><strong>Val 2</strong> - tidsfiltrera</p>

			    <div class="searchArea">	
				<label for="from" id="fran">Från</label>
				<input type="text" id="tweetsfrom" name="from" class="datepicker"><br>
				<label for="to" id="till">Till</label>
				<input type="text" id="tweetsuntil" name="to" class="datepicker">
 			    </div>		
 	 	
			</div>


		        					
		<!--<p class="searchText">Final step!</p>-->
		<!--
		<div class="bottom_3" id="veck_4">
				<div class="go">
		-->
			<div class="knappGo">
                                    <button class="go_knapp" id="tweetknapp">Sök</button>
			</div>
			<div class="heatPin">
				<form class="filter" id="radioboxes">
			    <div class="radioLeft">	
				<label for="c1">Tweetpins</label>
				<input type="radio" id="c1" name="cc" />
			    </div>
			    <div class="radioRight">
				<label for="c2">Heatmap</label> 				<input type="radio" id="c2" name="cc" />
			    </div>			
				</form>
			</div>
		<!--	
			</div>
			</div>
		</div>
		-->
	</div>


	<!--<h4 class="searchText">Final step!</h3>
        <button class="pure-button">Sök</button>
        <a href="#"><p class="go_knapp" id="tweetknapp"</p></a>-->
        
        
	<div class="rightSide">

			<p class="statistic_1">Statistik över din sökning:</p>
			<p class="statistic_2" id='result'></p>
			<p class="statistic_1">tweets med ditt sökord</p>
			<p class="statistic_3" id='searchword'></p>


	</div>


</div>

</div>
		</div>

	</div>

	<div id="right-column">
    			<div id="miniMap">miniMap</div>
		<div id="detailedMarkerInfo">	
    	
    		<div class="wordcloudRubrik"><p>Statistik över ord från Wordcloud</p></div>
        	<div id='open'><p></p><p></p></div>

  		</div>
	</div>


    </div> <!-- content -->
</div> <!-- container -->


<?php
include "footer.php";
?>

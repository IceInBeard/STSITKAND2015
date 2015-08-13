
	<div class='widget'>
					<div class='widgethead'>
						<img src="https://cdn.serinus42.com/2736c696f21f302/uploads/c/300/a4e0b/twitter-logo_22.png" alt="Twitters logotyp" class="twitterlogga"> Sök efter tweets 						<a class="fancybox fancybox.inline" onclick="loadInfoWindow('infowindow_sokning')" href="#infowindow_sokning"><img class="infoCloud" src="img/info.jpg"/></a></div>

<div class="socialmeidawidget">


	<!-- <div class="top">

		<img id="twitterLogga" src="https://cdn.serinus42.com/2736c696f21f302/uploads/c/300/a4e0b/twitter-logo_22.png" alt="Twitters logotyp">
		<h4>Search for words to find tweets!</h4>
	</div>
-->


	<div class="left">
			</br>
			<div = class="top_1" id="veck_1">
				<p class="searchText">Skriv in sökord</p>


				<form method="get" id="search">
            		  <input type="text" class="search" placeholder="Sökord" 
            		
            		  id='js-searcWord'>
              		<!--<button type="submit">Submit</button>-->
				</form>
			</div>	



			<div class="bottom_1" id="veck_2">
				<p class="searchText">Tidsfiltrera</p>

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
	<p class="kartrepresentation">Visa på karta som:</p>
			<div class="heatPin">
				<form class="filter" id="radioboxes">
			    <div class="radioLeft">	
				<label id='radioMark' for="c1">Tweetpins</label>
				<input type="radio" id="c1" name="cc" value='markers' />
			    </div>
			    <div class="radioRight">
				<label id='radioHeat' for="c2">Heatmap</label>
				<input type="radio" id="c2" name="cc" value='heat' checked/>
			    </div>			
				</form>
			</div>
		<!--	
			</div>
			</div>
		</div>
		-->
		<div class='areaView'>
			<label class='areaViewLabel'>  Stadsdelsvy</label>
			<input type='checkbox' class="areaViewBox">
		</div>
	</div>


	<!--<h4 class="searchText">Final step!</h3>
        <button class="pure-button">Sök</button>
        <a href="#"><p class="go_knapp" id="tweetknapp"</p></a>-->
        
        
	<div class="right">

			<p class="statistic_1" id="number-of-hits"></p>
			<p class="statistic_2" id='result'></p>
			<p class='errorText'></p>
			<!--<p class="statistic_1">Sökord:</p> 
			<p class="statistic_3" id='searchword'></p> -->




	</div>


</div>

</div>

<!--<div class="widget">
	<div class="widgethead"> 
		<img src='https://cdn.serinus42.com/2736c696f21f302/uploads/c/300/a4e0b/twitter-logo_22.png' alt='Twitters logotyp'> 
		Sentimentanalys
	</div>
	<iframe id='gustav2' width='320' height='270' frameborder='0' seamless='seamless' scrolling='no' src='https://plot.ly/~Gustafv/144?width=320&height=270' ></iframe> 
</div>-->



<div class="widget">
	<div class="widgethead"> 
		<img src='https://cdn.serinus42.com/2736c696f21f302/uploads/c/300/a4e0b/twitter-logo_22.png' alt='Twitters logotyp'class="twitterlogga"> 
		Graf över din sökning
			<a class="fancybox fancybox.inline" onclick="loadInfoWindow('infowindow_tidsgraf')" href="#infowindow_tidsgraf"><img class="infoCloud" src="img/info.jpg"/></a>
	</div>
	<div id='canvas-container-1'>
		<canvas id='plotCanvas' class='tweetPlot' height="250" width="295" ></canvas>
	<!--<iframe id='gustav' width='320' height='270' frameborder='0' seamless='seamless' scrolling='no' src='https://plot.ly/~Gustafv/25?width=320&height=270' ></iframe>
	-->
	</div>
</div>

<div id="infowindow_tidsgraf" class="info-window">
		<p id="header-infograf" style="font-size:17.5px">Information om tidsgraf</p>
			<p style="font-size:15px">Grafen nedan är en tidsrepresentation över hur antalet tweets hämtade från den angivna sökningen har förändrats med tiden. Den representerar såväl tweets som visas på kartan som de som inte gör det.</p>
</div>

<div class="widget">
	<div class="widgethead"> 
		<img src='https://cdn.serinus42.com/2736c696f21f302/uploads/c/300/a4e0b/twitter-logo_22.png' alt='Twitters logotyp' class="twitterlogga"> 
		Twitter Wordcloud
			<a class="fancybox fancybox.inline" onclick="loadInfoWindow('infowindow_wordcloud')" href="#infowindow_wordcloud"><img class="infoCloud" src="img/info.jpg"/></a>
	</div>
	<div id='canvas-container-2'>
		<canvas id="socialWordcloud" class='tweetWordcloud'> </canvas>
	</div>
</div>

<div id="infowindow_wordcloud" class="info-window">
		<p id="header-infoCloud" style="font-size:17.5px">Information om Wordcloud</p>
			<p style="font-size:15px">Ett Wordcloud är en visuell representation för hur populära och hur ofta vissa taggar används. Taggar är vanligtvis enskilda ord, och dess betydelse visas genom olika färger och storlekar. Wordcloud används alltså i detta fall för att snabbt och enkelt visa vilka ord som används oftast i olika tweets.</p>
</div>

<div id="infowindow_sokning" class="info-window">
		<p id="header-infoCloud" style="font-size:17.5px">Information om tweet-sökning</p>
			<p style="font-size:15px">I vänsterspalten kan en sökning efter tweets göras baserat på ett specifikt ord, ett tidsintervall eller båda. Resultatet av de tweets med geotaggar syns sedan på kartan. I högerspalten visas statistik över antalet tweets kopplat till sökningen.
</br></br>
<strong>Tweetpins</strong> innebär att varje tweet som kan visas på kartan kommer vara representerad av en nål(tweetpin).</br>  
<strong>Heatmap</strong> är en intensitetsrepresentation av antalet tweets i Uppsala. Där många tweets har gjorts kommer en starkare färg på kartan visas och vice versa.

</p>
</div>


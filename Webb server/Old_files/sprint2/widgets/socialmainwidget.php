
	<div class='widget'>
					<div class='widgethead'>
						<img src="https://cdn.serinus42.com/2736c696f21f302/uploads/c/300/a4e0b/twitter-logo_22.png" alt="Twitters logotyp"> Sök efter tweets </div>

<div class="socialmeidawidget">


	<!-- <div class="top">

		<img id="twitterLogga" src="https://cdn.serinus42.com/2736c696f21f302/uploads/c/300/a4e0b/twitter-logo_22.png" alt="Twitters logotyp">
		<h4>Search for words to find tweets!</h4>
	</div>
-->


	<div class="left">


			<div = class="top_0" id="veck_0">
				<!--<img id="twitterPin" src="http://icons.iconarchive.com/icons/icons-land/vista-map-markers/256/Map-Marker-Marker-Outside-Azure-icon.png">-->
				<!--<p class="startText">Sök efter tweets på kartan</p>-->
				<p class="startVal">Välj nedan mellan ett eller två val</p>
			</div>
			</br>
			<div = class="top_1" id="veck_1">
				<p class="searchText"><strong>Val 1</strong> - sök efter ett ord</p>


				<form method="get" id="search">
            		  <input type="text" class="search" placeholder="Sökord" 
            		
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
	</div>


	<!--<h4 class="searchText">Final step!</h3>
        <button class="pure-button">Sök</button>
        <a href="#"><p class="go_knapp" id="tweetknapp"</p></a>-->
        
        
	<div class="right">

			<p class="statistic_1"></p>
			<p class="statistic_2" id='result'></p>
			<!--<p class="statistic_1">tweets med ditt sökord</p>
			<p class="statistic_3" id='searchword'></p>-->


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
		<img src='https://cdn.serinus42.com/2736c696f21f302/uploads/c/300/a4e0b/twitter-logo_22.png' alt='Twitters logotyp'> 
		Graf över sökning
	</div>
	<canvas id='plotCanvas' class='tweetPlot'></canvas>
	<!--<iframe id='gustav' width='320' height='270' frameborder='0' seamless='seamless' scrolling='no' src='https://plot.ly/~Gustafv/25?width=320&height=270' ></iframe>
	-->
</div>

<div class="widget">
	<div class="widgethead"> 
		<img src='https://cdn.serinus42.com/2736c696f21f302/uploads/c/300/a4e0b/twitter-logo_22.png' alt='Twitters logotyp'> 
		Twitter Wordcloud
	</div>
	<canvas id="socialWordcloud" class='tweetWordcloud'> </canvas>
</div>


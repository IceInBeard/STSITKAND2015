<div class="socialmeidawidget">


	<!-- <div class="top">

		<img id="twitterLogga" src="https://cdn.serinus42.com/2736c696f21f302/uploads/c/300/a4e0b/twitter-logo_22.png" alt="Twitters logotyp">
		<h4>Search for words to find tweets!</h4>
	</div>
-->


	<div class="left">

		<div id="accordion">

			<h3 class="searchText">Steg 1 - sök efter ett ord</h3>


			<div = class="top_1" id="veck_1">

			</br>

				<form method="get" id="search">
            		  <input type="text" class="search" placeholder="Sökord" 
            		  onblur="if(this.value == '') { this.value = 'Type and hit enter'; }" 
            		  onfocus="if(this.value == 'Type and hit enter') { this.value = ''; }" name="s"
            		  id='js-searcWord'>
              		<!-- <button type="submit">Submit</button> -->
			</form>
			</div>	


			<h3 class="searchText">Steg 2 - filtrera din sökning</h3>
			<div class="bottom_1" id="veck_2">


				<label for="from" id="fran">Från</label>
				<input type="text" id="tweetsfrom" name="from" class="datepicker"><br>
				<label for="to" id="till">Till</label>
				<input type="text" id="tweetsuntil" name="to" class="datepicker">
 
 	 	
			</div>

			<h3 class="searchText">Steg 3 - visa på karta? </h3>
			<div class="bottom_2" id="veck_3">
		

				<div class = "boxes">
					<form class="filter" id="checkboxes">
					<input type="checkbox" id="tweetOnMap" name="cc" />
					<label for="c1" id="no">Ja</label><br> 
<!--					<input type="checkbox" id="checkBox" id="c2" name="c2" />
					<label for="c2" id="no">No</label><br />-->
					</form>
				</div>

			


			</div>

		        	<h3 class="searchText">Final step!</h3>
			<div class="bottom_3" id="veck_4">
				<div class="go">
                                    <button class="go_knapp" id="tweetknapp">Sök</button>

				</div>

			</div>

		</div>
	</div>


	<!--<h4 class="searchText">Final step!</h3>
        <button class="pure-button">Sök</button>
        <a href="#"><p class="go_knapp" id="tweetknapp"</p></a>-->
        
        
	<div class="right">

			<p class="statistic_1">Statistik över din sökning:</p>
			<p class="statistic_2" id='result'></p>
			<p class="statistic_1">tweets med ditt sökord</p>
			<p class="statistic_3" id='searchword'></p>


	</div>


</div>



	<div class='widget'>
		<div class='widgethead'>Cykelmarkörer</div>

	<div id="mainCykelWidget">

		<!-- <div class="top">
			<h4>Main Bicycle</h4>

		</div>
	-->

		<div id="BicycleCheckbox">

			<table id="BicycleTable">

				<tbody>

					<tr class="headers"> <td>Pumpar: <input type="checkbox" id="checkPump" value="pump" onclick="switchCheckbox(this)"><img src="img/mapicons/pump.svg"></td> </tr>
					<tr class="headers"> <td>Verkstäder: <input type="checkbox" id="checkPump" value="verkstad" onchange="switchCheckbox(this)"><img src="img/mapicons/verkstad.svg"></td></tr>
	                <tr class="headers"> <td>Parkeringar: <input type="checkbox" id="checkPump" value="parking" onchange="switchCheckbox(this)"><img src="img/mapicons/parking.svg"></td></tr>
					<tr class="headers"> <td>Cykelräknare:<input type="checkbox" id="checkPump" value="nodes" onchange="switchCheckbox(this)"><a class="fancybox fancybox.inline" onclick="loadInfoWindow()" href="#infowindow"><img class="info" src="img/info.jpg"/></a></td> </tr>
					<tr class="headers"> <td>Cykelvägar:<input type="checkbox" id="checkPump" value="roads" onchange="setBicycleRoad(this)"></td> </tr>
				</tbody>
			</table>
		</div>
		

	</div>
</div>


<!--
	<iframe id='maja' width='320' height='270' frameborder='0' seamless='seamless' scrolling='no' src='https://plot.ly/~MajaEngvall/134?width=320&height=270' ></iframe>

    
<div class='widget'>
	<div class='widgethead'>Cykelflöde Resecentrum </div>
	<iframe id='maja' width='320' height='270' frameborder='0' seamless='seamless' scrolling='no' src='https://plot.ly/~MajaEngvall/263?width=320&height=270' ></iframe>
</div>

<div class='widget'>
	<div class='widgethead'>Cykelflöde Hamnspången </div>
		<iframe id='maja' width='320' height='270' frameborder='0' seamless='seamless' scrolling='no' src='https://plot.ly/~MajaEngvall/243?width=320&height=270' ></iframe>
</div>

-->
<!--<div class='widget'>
		<div class='widgethead'>Cyklister i siffror</div>
<div class='cykelSubWidget'> 
            <div id='CyclistTodayAndLastWeek'> 
                <table id='AmountCyclistTable'> 
                    <tr class='header'> <td>Plats</td><td >Idag</td><td > Igår</td></tr> 
                    <tr class='text'> <td >Hamnspången</td> <td >2500</td><td >3233</td></tr> 
                    <tr class='text'> <td >Daghammarsköldsväg</td> <td >3332</td><td >1563</td></tr> 
                    <tr class='text'> <td >Rececentrum</td> <td >5411</td><td >3324</td></tr> 
                    <tr class='text'> <td >Totalt</td> <td >14235</td><td >9457</td></tr> 
                </table> 
            </div> 
        </div>
</div>
-->


<div class='widget'>
		<div class='widgethead'>Verkstadslista</div>
<div id='ServiceShopTable' class='cykelSubWidget'></div>
</div>


<div class='widget'>
		<div class='widgethead'>Cykelflöde<!--<img src="https://cdn3.iconfinder.com/data/icons/higher-education-icon-set/128/chart.png">--></div>

<ul id="Bicycle_graphs">
<li><input id="DHbutton" type="button" value="Dag Hammarsköld" frameborder='0' seamless='seamless' scrolling='no' href="https://plot.ly/~MajaEngvall/134?width=320&height=270" class='fancybox fancybox.iframe'/></li>
<li><input id="DHbutton" type="button" value="Resecentrum" frameborder='0' seamless='seamless' scrolling='no' href="https://plot.ly/~MajaEngvall/263?width=320&height=270" class='fancybox fancybox.iframe'/></li>
<li><input id="DHbutton" type="button" value="Hamnspången" frameborder='0' seamless='seamless' scrolling='no' href="https://plot.ly/~MajaEngvall/243?width=320&height=270" class='fancybox fancybox.iframe'/></li>
</ul>

</div>

<div id="infowindow" >
		<p id="header-info">Skala för cykelnoder</p>
		<img src="img/green_red_scale.jpg">
		<ul><li id="start-scale">Få</li><li id="end-scale">Många</li></ul>
		<p id="road-info">Förklaring av cykelleder</p>		
		<img src="img/info-road.jpg">

</div>

<!--
<div class='widget'>
		<div class='widgethead'><img=>Cykelmflöde</div>
<div class='cykelSubWidget'> 
            <div id='CyclistTodayAndLastWeek'> 
                <table id='AmountCyclistTable'> 
                    <tr class='header'> <td>Plats</td><td >Idag</td><td > Igår</td></tr> 
                    <tr class='text'> <td >Hamnspången</td> <td >2500</td><td >3233</td></tr> 
                    <tr class='text'> <td >Daghammarsköldsväg</td> <td >3332</td><td >1563</td></tr> 
                    <tr class='text'> <td >Rececentrum</td> <td >5411</td><td >3324</td></tr> 
                    <tr class='text'> <td >Totalt</td> <td >14235</td><td >9457</td></tr> 
                </table> 
            </div> 
        </div>
</div> -->

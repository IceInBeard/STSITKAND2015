
	<div class='widget'>
		<div class='widgethead'><img class="checkbox_icon" src="img/bike_checkbox.png">Cykelmarkörer<a class="fancybox fancybox.inline" onclick="loadInfoWindow('infowindow_checkbox')" href="#infowindow_checkbox"><img class="infoCloud" src="img/info.jpg"></a></div>

	<div id="mainCykelWidget">

		<div id="BicycleCheckbox">

			<table id="BicycleTable">

				<tbody>

					<tr class="headers"> <td><input type="checkbox" id="checkPump" value="pump" onclick="switchCheckbox(this)" name="pump"> <label for="pump" class="checkLabel"> Pumpar:</label> <img src="img/mapicons/pump.svg"></td> </tr>
					<tr class="headers"> <td><input type="checkbox" id="checkPump" value="verkstad" onchange="switchCheckbox(this)" name="verkstad"><label for="verkstad" class="checkLabel">Verkstäder:</label> <img src="img/mapicons/verkstad.svg"></td></tr>
	                <tr class="headers"> <td><input type="checkbox" id="checkPump" value="parking" onchange="switchCheckbox(this)" name="parking"><label for="parking" class="checkLabel">Parkeringar:</label> <img src="img/mapicons/parking.svg"></td></tr>
					<tr class="headers"> <td><input type="checkbox" id="checkPump" value="nodes" onchange="switchCheckbox(this)" name="nodes"><label for="nodes" class="checkLabel">Cykelräknare:</label><a class="fancybox fancybox.inline" onclick="loadInfoWindow('infowindow_nodes')" href="#infowindow_nodes"><img class="info" src="img/info.jpg"/></a></td> </tr>
					<tr class="headers"> <td><input type="checkbox" id="checkPump" value="roads" onchange="setBicycleLayers(this)" name="roads"><label for="roads" class="checkLabel">Cykelvägar:</label><a class="fancybox fancybox.inline" onclick="loadInfoWindow('infowindow_road')" href="#infowindow_road"><img class="info" src="img/info.jpg"/></a></td> </tr>
					<tr class="headers"> <td><input type="checkbox" id="checkPump" value="traffic" onchange="setBicycleLayers(this)" name="traffic"><label for="traffic" class="checkLabel">Trafikläge:</label><a class="fancybox fancybox.inline" onclick="loadInfoWindow('infowindow_traffic')" href="#infowindow_traffic"><img class="info" src="img/info.jpg"/></a></td> </tr>
				</tbody>
			</table>
		</div>
		

	</div>
</div>


<div class='widget'>
		<div class='widgethead'><img src="img/bike_shops.png">Verkstäder<a class="fancybox fancybox.inline" onclick="loadInfoWindow('infowindow_shop')" href="#infowindow_shop"><img class="infoCloud" src="img/info.jpg"></a></div>
<div id='ServiceShopTable' class='cykelSubWidget'></div>
</div>


<div class='widget'>
		<div class='widgethead'><img src="img/graph.png">Cykelflöde<a class="fancybox fancybox.inline" onclick="loadInfoWindow('infowindow_graph')" href="#infowindow_graph"><img class="infoCloud" src="img/info.jpg"></a></div>

<ul id="Bicycle_graphs">
<li><input id="DHbutton" type="button" value="Dag Hammarsköld" frameborder='0' seamless='seamless' scrolling='no' href="https://plot.ly/~MajaEngvall/134?width=320&height=270" class='fancybox fancybox.iframe'/></li>
<li><input id="DHbutton" type="button" value="Resecentrum" frameborder='0' seamless='seamless' scrolling='no' href="https://plot.ly/~MajaEngvall/263?width=320&height=270" class='fancybox fancybox.iframe'/></li>
<li><input id="DHbutton" type="button" value="Hamnspången" frameborder='0' seamless='seamless' scrolling='no' href="https://plot.ly/~MajaEngvall/243?width=320&height=270" class='fancybox fancybox.iframe'/></li>
</ul>

</div>

<div id="infowindow_nodes" class="info-window">
		<p id="header-info">Skala för cykelnoder</p>
		<img src="img/green_red_scale.jpg">
		<ul><li id="start-scale">0</li><li id="middle-scale">cyklar</li><li id="end-scale">5000</li></ul>
</div>

<div id="infowindow_road" class="info-window">
		<p id="road-info">Förklaring av cykelleder</p>		
		<img src="img/info-road.jpg">

</div>

<div id="infowindow_checkbox" class="info-window">
		<p id="header-infoCloud" style="font-size:17.5px">Information om Cykelmarkörer</p>
		<p>Kryssa i det område du vill ha information om. Informationen kommer sedan visa sig på kartan i olika former.</p>
</div>

<div id="infowindow_shop" class="info-window">
		<p id="header-infoCloud" style="font-size:17.5px">Information om Verkstäder</p>
		<p>Här finns öppettider och beskrivning tillgängligt för cykelverkstäder i centrala Uppsala. Genom att klicka på önskad verkstad markeras geografisk plats ut på kartan ovan. </p>
</div>

<div id="infowindow_graph" class="info-window">
		<p id="header-infoCloud" style="font-size:17.5px">Information om Cykelflöde</p>
		<p>Här kan ni ta del av antalet cyklister som passerat respektive punkt över tiden.Klicka på den cykelräknare du vill se statistik för. Grafen visar statistik över de tre senaste månaderna.</p>
</div>

<div id="infowindow_traffic" class="info-window">
		<p id="header-infoCloud" style="font-size:17.5px">Information om Trafikläge</p>
		<p>Trafiklagret visar trafikintensiteten på olika vägarna i Uppsala i realtid. Färgen går från grön till röd ju intensivare/långsammare trafiken är.</p>
</div>


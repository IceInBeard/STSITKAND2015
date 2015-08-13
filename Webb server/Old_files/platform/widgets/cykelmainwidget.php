
	<div class='widget'>
		<div class='widgethead'>Cykel</div>

	<div id="mainCykelWidget">

		<!-- <div class="top">
			<h4>Main Bicycle</h4>

		</div>
	-->

		<div id="BicycleCheckbox">

			<table id="BicycleTable">

				<tbody>

					<tr class="header"> <td>Cykelpumpar: <input type="checkbox" id="checkPump" value="pump" onclick="switchCheckbox(this)"><img src="img/mapicons/pump.png"></td> </tr>
					<tr class="header"> <td>Cykelverkstäder: <input type="checkbox" id="checkPump" value="verkstad" onchange="switchCheckbox(this)"><img src="img/mapicons/verkstad.png"></td></tr>
	                <tr class="header"> <td>Cykelparkering: <input type="checkbox" id="checkPump" value="parking" onchange="switchCheckbox(this)"><img src="img/mapicons/parking.png"></td></tr>
					<tr class="header"> <td>Cykelnoder:<input type="checkbox" id="checkPump" value="nodes" onchange="switchCheckbox(this)"><img src="img/mapicons/nodes.png"></td> </tr>
					<tr class="header"> <td>Cykelvägar:<input type="checkbox" id="checkPump" value="roads" onchange="setBicycleRoad(this)"></td> </tr>
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
<div id='ServiceShopTable' class='cykelSubWidget'><a href='#' onClick='createTable()'>Generera lista</a></div>
</div>


<div class='widget'>
		<div class='widgethead'>Cykelflöde</div>

<ul id="Bicycle_graphs">
<li><h3>Cykelflöde </h3><img src="https://cdn3.iconfinder.com/data/icons/higher-education-icon-set/128/chart.png"></li>
<li><a id='maja' frameborder='0' seamless='seamless' scrolling='no' href='https://plot.ly/~MajaEngvall/134?width=320&height=270' class='fancybox fancybox.iframe' href='#maja'>Cykelflöde DagHammarsköld</a></li>
<li><a id='maja' frameborder='0' seamless='seamless' scrolling='no' href='https://plot.ly/~MajaEngvall/263?width=320&height=270' class='fancybox fancybox.iframe' href='#maja'>Cykelflöde Resecentrum</a></li>
<li><a id='maja' frameborder='0' seamless='seamless' scrolling='no' href='https://plot.ly/~MajaEngvall/243?width=320&height=270' class='fancybox fancybox.iframe' href='#maja'>Cykelflöde Hamnspången</a></li>
</ul>
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

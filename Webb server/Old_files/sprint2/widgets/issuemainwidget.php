	<div class='widget'>
					<div class='widgethead'><img src="https://cdn3.iconfinder.com/data/icons/technology-internet-and-communication/100/technology_internet_communications3-512.png"> Felanmälningar </div>


	<div class="issueReportWidget">



	<!-- <div class="header"><img src="http://www.besttechcomputing.info/web-maintenance.png" class='pic'
			><h4>Issues</h4>
		</div>
	-->

		<div class="list">

			<ul>
				<li>
					<input id="checkPump" type="checkbox" onclick="switchCheckbox(this)" value="Vegitation" ></input>Vegetation
				</li>
				<li>
					<input id="checkPump" type="checkbox" onclick="switchCheckbox(this)" value="Graffiti" ></input>Graffiti
				</li>
			</li>
			<li>
				<input id="checkPump" type="checkbox" onclick="switchCheckbox(this)" value="Nedskräpning" ></input>Nedskräpning 
			</li>
		</li>
		<li>
			<input id="checkPump" type="checkbox" onclick="switchCheckbox(this)" value="Vägar" ></input>Vägar 
		</li>
	</li>
</ul>
<ul>
	<li>
		<input id="checkPump" type="checkbox" onclick="switchCheckbox(this)" value="Trafik" ></input>Trafik 
	</li>
	<li>
		<input id="checkPump" type="checkbox" onclick="switchCheckbox(this)" value="Cykel" ></input>Cykel 
	</li>
</li>
<li>
	 <input id="checkPump" type="checkbox" onclick="switchCheckbox(this)" value="Offentliga platser" ></input>Offentliga platser
</li>
<li>
	 <input id="checkPump" type="checkbox" onclick="switchCheckbox(this)" value="Övrigt" ></input>Övrigt
</li>
</li>
</ul>

	<div class="search"> 
		
		<form id="search-form">
			<div id="search">
				<input id="query" type="search" placeholder='Sök på felanmälningar' >
				<input id="searchbutton" type="submit">
			</div>
		</form>
	</div>

</div>


</div>
</div>



<div class="widgetLarge">
<div class="widgethead"><img src='https://cdn3.iconfinder.com/data/icons/technology-internet-and-communication/100/technology_internet_communications3-512.png'> Gör en felanmälning</div>

	<div class='IssueSubwidget'> 
	   
	    <div class='left'> 
	        <table> 
	            <tr><td>Har är felet: <input  type='text' name='Geotag' placeholder='Skriv in adress eller tryck pa kartan'><br></td></tr> 
	            <tr><td>Kategori: <select> 
	                    <option>Välj en kategori</option> 
	                    <option>Trafik</option> 
	                    <option>Graffiti</option> 
	                    <option>Soptunnor</option> 
	                    <option>Vägar</option> 
	                    <option>Cyklar</option> 
	                    <option>Offentlig plats</option>
	                    <option>Vegetation</option> 
	                    <option>Övrigt</option> 
	                </select></td></tr>        
	            <tr><td>Namn: <input  type='text' name='Namn' placeholder='For och efternamn'><br>(valfri)</td></tr> 
	            <tr><td>Aterkoppling: <input  type='text' name='Aterkoppling' placeholder='Mejl/Telefonnummer'><br>(valfri)</td></tr> 
	        </table> 
	    </div> 

		<div class='right'> 
			<table>
				<tr><td>Beskrivning: <textarea rows='3' placeholder='Beskriv felet'></textarea><br>(max 200 ord)</td></tr> 
				<tr><td>Bild: <textarea rows='3' placeholder='Ladda upp bild'></textarea><br></td></tr> 
			</table>
			
			<button class="sokKnapp">Rapportera</button>

	    </div>
	</div>
</div>

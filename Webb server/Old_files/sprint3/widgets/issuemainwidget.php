	<div class='widget'>
					<div class='widgethead'><img src="https://cdn3.iconfinder.com/data/icons/technology-internet-and-communication/100/technology_internet_communications3-512.png"> Felrapporteringar </div>


	<div class="issueReportWidget">



	<!-- <div class="header"><img src="http://www.besttechcomputing.info/web-maintenance.png" class='pic'
			><h4>Issues</h4>
		</div>
	-->

		<div class="list">

			<ul>
				<li>
					<input checked id="checkPump" type="checkbox" onclick="switchCheckbox(this)" value="Vegetation" name="Vegetation"></input>
					<label for="Vegetation" class="checkLabel"> Vegetation </label>
				</li>
				<li>
					<input checked id="checkPump" type="checkbox" onclick="switchCheckbox(this)" value="Klotter" name="Klotter"></input>
					<label for="Klotter" class="checkLabel">Klotter</label>
				</li>
			</li>
			<li>
				<input checked id="checkPump" type="checkbox" onclick="switchCheckbox(this)" value="Renhållning" name="Renhållning"></input>
				<label for="Renhållning" class="checkLabel">Renhållning </label>
			</li>
		</li>
		<li>
			<input checked id="checkPump" type="checkbox" onclick="switchCheckbox(this)" value="Vägar" name="Vägar"></input>
			<label for="Vägar" class="checkLabel">Vägar </label>
		</li>
	</li>
</ul>
<ul>
	<li>
		<input checked id="checkPump" type="checkbox" onclick="switchCheckbox(this)" value="Trafik" name="Trafik"></input>
		<label for="Trafik" class="checkLabel">Trafik </label>
	</li>
	<li>
		<input checked id="checkPump" type="checkbox" onclick="switchCheckbox(this)" value="Cykel" name="Cykel"></input>
		<label for="Cykel" class="checkLabel">Cykel </label>
	</li>
</li>
<li>
	 <input checked id="checkPump" type="checkbox" onclick="switchCheckbox(this)" value="Allmänna platser" name="Allmänna platser"></input>
	 <label for="Allmänna platser" class="checkLabel">Allmänna platser</label>
</li>
<li>
	 <input checked id="checkPump" type="checkbox" onclick="switchCheckbox(this)" value="Övrigt" name="Övrigt"></input>
	 <label for="Övrigt" class="checkLabel">Övrigt</label>
</li>
</li>
</ul>

	<div class="iconInfo" > 
		
		<div class="mainIcon" ><img class="greenIcon" src="http://stsitkand.student.it.uu.se/sprint3/img/icons/red/ÖvrigtRED.svg"><p> Inrapporterad </p></div>
	<div  class="mainIcon"><img class="greenIcon" src="http://stsitkand.student.it.uu.se/sprint3/img/icons/yellow/ÖvrigtYELLOW.svg"><p> Under behandling</p></div>

<div  class="mainIcon"><img class="greenIcon" src="http://stsitkand.student.it.uu.se/sprint3/img/icons/green/ÖvrigtGREEN.svg"><p> Slutförd</p></div>

</div>

</div>


</div>
</div>

<div class="widgetLarge" id="widget3" style="display:none;">
	<div class="widgethead"><img src='https://cdn3.iconfinder.com/data/icons/technology-internet-and-communication/100/technology_internet_communications3-512.png'> Tack!</div>
	<div class='IssueSubwidget'> 
	<p> Din felanmälan har nu blivit inskickad. </p>
	<button  type = "button" onclick="showContainer()" class="sokKnapp">Skapa ny</button></td></tr>
</div></div>

<div class="widgetLarge" id="widget2">
<div class="widgethead"><img src='https://cdn3.iconfinder.com/data/icons/technology-internet-and-communication/100/technology_internet_communications3-512.png'> Gör en felrapportering</div>

	<div class='IssueSubwidget'> 
	   
	    <div class='left'> 
	        <table id="submitReport"> 
	        <!-- <form action="phpincludes/issueUploadPictures.php" method="post" enctype="multipart/form-data"> -->
	        <form id="reportForm">
				<input type="hidden" id = "droppedLat" name="droppedLat">
					<input type="hidden" id = "droppedLng" name="droppedLng">
	            <tr><td><!-- Har är felet: --><input  type='text' id='Geotag' placeholder='Placera ut en markör på kartan'><br></td></tr> 
	            <tr><td><!-- Kategori: --><select id = "issueCategory" name="issueCategory"> 
	                    <option value = "">Välj en kategori</option> 
	                    <option value = "Trafik">Trafik</option> 
	                    <option value = "Klotter">Klotter</option> 
	                    <option value = "Renhållning">Renhållning</option> 
	                    <option value = "Vägar">Vägar</option> 
	                    <option  value = "Cykel">Cykel</option> 
	                    <option  value = "Allmänna platser">Allmänna platser</option>
	                    <option  value = "Vegetation" >Vegetation</option>
			    <option  value = "Övrigt">Övrigt</option>  

	                </select></td></tr>        
		  <tr><td><!--Beskrivning: --><textarea id ="widgetDescription" rows='3' placeholder='Beskriv felet (max 200 ord)' name="widgetDescription"></textarea></td></tr> 

		  <tr><td><input type="file" name="fileToUpload" id="fileToUpload"></td></tr>

		  <tr><td><button  type = "button" onclick="createReport()" class="sokKnapp">Rapportera</button></td></tr>
		  
		  </form>
		<progress></progress>	

	        </table> 
	    </div> 

		<div class='right'> 
			<table>
				
			</table>	

	    </div>
	</div>


</div>

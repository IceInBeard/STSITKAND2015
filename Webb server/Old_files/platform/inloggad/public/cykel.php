<?php
include 'header.php';

if (login_check($mysqli) == false) {
    header("Location: login.php");
}

?>
	<script type="text/javascript">
		$(document).ready(function () {
		    onloading();
		});
	</script>
<div id="container-wide">
    <div id="content">
    	<div id="left-column">

    		<div id="list">
   
				 <form id="checkboxMeny">
				    <ul>
				        <li>
				            <input checked onclick="switchCheckbox2(this)" id="option" type="checkbox" value="Vägar">
				            <label class="checkbox" for="option"> Vägar</label>
				            
				            <input checked onclick="switchCheckbox2(this)" id="option2" type="checkbox" value="Trafik" >
				            <label class="checkbox" for="option2"> Trafik</label>
				            
				            <input checked onclick="switchCheckbox2(this)" id="option3" type="checkbox" value="Cykel" >
				            <label class="checkbox" for="option3"> Cykel</label>
				            
				            <input checked onclick="switchCheckbox2(this)" id="option4" type="checkbox" value="Vegetation" >
				            <label class="checkbox" for="option4"> Vegetation</label>
					
							<input checked onclick="switchCheckbox2(this)" id="option5" type="checkbox" value="Renhållning" >
				            <label class="checkbox" for="option5"> Renhållning</label>

							<input checked onclick="switchCheckbox2(this)" id="option6" type="checkbox" value="Allmänna platser" >
				            <label class="checkbox" for="option6"> Allmänna platser</label>

							<input checked onclick="switchCheckbox2(this)" id="option7" type="checkbox" value="Klotter" >
				            <label class="checkbox" for="option7"> Klotter</label>

							<input checked onclick="switchCheckbox2(this)" id="option8" type="checkbox" value="Opinion" >
				            <label class="checkbox" for="option8"> Opinion</label>

							<input checked onclick="switchCheckbox2(this)" id="option9" type="checkbox" value="Övrigt" >
				            <label class="checkbox" for="option9"> Övrigt</label>

							<input checked onclick="switchCheckboxAll(this)" id="Option10" type="checkbox" value="Välj alla">
				            <label class="checkbox" for="Option10"> Välj alla</label>
					
				        </li>
				    </ul>
				</form>


					<div class="line-separator"></div>



				   <a class="toggle-vis" data-column="1"></a>
				   <a class="toggle-vis" data-column="2"></a>
				   <a class="toggle-vis" data-column="3"></a>

				   <div id="tablediv"></div>

				<!-- <button type="button" id="button">Delete</button> -->
				    <div id="test"></div>
				    <div class="widget" id="issueList">
				        <table class="infoLista"></table>
				    </div>
			</div>








    	</div>

    	<div id="right-column">
    		<div id="miniMap">miniMap</div>
    		<div id="detailedMarkerInfo">	   
<div id="info-container" class="info-container">
<div id='ID'><p>ID</p><p>5KS2094JNFDKSN2</p></div>

        

        <div class='description'><p class="beskrivning">Beskrivning</p><p class= 'issue-description-box' id = 'issue-description'>Mata in text från databas</p>
<div id="picture"><img  src="https://cdn3.iconfinder.com/data/icons/technology-internet-and-communication/100/		technology_internet_communications3-512.png" heigth='50' width='50' alt="Uppsala kommuns logotyp" ></div>

        </div>
     
        
<div class="contact-info">
   <div class="contact-name">
       <p class="kontaktperson"> Kontaktperson</p>
       <p> Emil Svensson </p>


   </div>
   <div class="contact">
      <p class="kontaktperson"> Email</p>
      <p> emil@svensson.se </p>
   </div>

</div>
     
        
     <div class="status-container">
   <div id='company'><p>Företag ansvarig</p>
          <select><option>Företag 1</option><option>Företag 2</option> <option>Företag 3</option>     </select>
      
        </div>

<div id='status'><p>Status</p>
           
            <select><option>Fixad</option><option>Under behandling</option> <option>Inrapporterad</option>     </select>
      
     
        </div>
</div>
        <div class='comment'><p class="muni-comment">Kommentar</p>
            <textarea class='textbox' placeholder="Skriv en kommentar till felanmalan"></textarea>
	<button class="updateTest" class="comment-button"> Update </button>
	</div>
      </div>
  </div>
    </div>




    </div> <!-- content -->
</div> <!-- container -->


<?php
include "footer.php";
?>

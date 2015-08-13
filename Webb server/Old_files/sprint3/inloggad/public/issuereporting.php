<?php
include 'header.php';

if (login_check($mysqli) == false) {
    header("Location: login.php");
}

?>
<script type="text/javascript" src="js/issues.js" ></script>
<script type="text/javascript" src="js/editBox.js"></script>
<script type="text/javascript" src="js/kalle.js"></script>
<script type="text/javascript" src="js/karl.js"></script>
<script type="text/javascript" src="js/erik.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
		    onloading();
		});
	</script>
<div id="container-wide">
    <div id="content">
    	<div id="left-column">

    		<div id="list">
<!--Här kommer companyrutan-->
<div id="newCompany" >
<h2> Skapa nytt företag</h2>
<table class="edit-table">
  <tr>
    <td>Företagsnamn:</td>
    <td><input id="newcompname-textbox" type="text" ></td>
  </tr>
  <tr>
    <td>Kontaktperson: </td>
    <td><input id="newname-textbox" type="text" ></td>
  </tr>
  <tr>
    <td>Email: </td>
    <td><input id="newemail-textbox" type="text" ></td>
  </tr>
  <tr>
    <td>Kategori:</td>
    <td><input id="newcategories-textbox" type="text" placeholder="Ex. Vägar, Cykel, Klotter" ></td>
  </tr>
  <tr>
    <td>Lokalisering: </td>
    <td><input id="newarea-textbox" type="text" ></td>
  </tr>
  <tr>
    <td>Organisation nr: </td>
    <td><input id="newuserid-textbox" type="text" ></td>
  </tr>
  <tr>
    <td>Telefon: </td>
    <td><input id="newphone-textbox" type="text" ></td>
  </tr>
 
<input id="thisMarkerId-textbox" type="text" style="display:none;">
 
</table>
  <div id="editBoxButton" >
  <button onclick="createCompany()">Klar</button>

  </div>
  


</div> 
<!--Här kommer filter rutan-->
<div id="filter" ><!--Här är hela den stora rutan-->
		<div class="leftSide"><!--Här är alla övergripande kategorier-->
			<ul>
				<li  class="leftSideColor" id="leftSideCategory"> Kategori</li>
				<li class="leftSideColor" id="leftSideStatus"> Status</li>
				<li class="leftSideColor" id="leftSideOther"> Visa</li>
				<!--<li class="leftSideColor" id="leftSideDate">Datum</li>
				<li class="leftSideColor" id="leftSideComment">Kommentar</li>-->
			</ul>
		</div> 
		<div class="rightSide"><!--Här är alla val man kan välja på varje kategori-->
			

				<ul id="rightSideCategory">
<li>
              <input  onclick="switchCheckboxAll(this)" id="Option10" type="checkbox" value="Välj alla">
                    <label class="checkbox" for="Option10"> Välj alla</label></li>
				       <li>
                    <input checked onclick="switchCheckbox2(this)" id="option" type="checkbox" value="Vägar">
                    <label class="checkbox" for="option"> Vägar</label></li>
                    <li>
                    <input checked onclick="switchCheckbox2(this)" id="option2" type="checkbox" value="Trafik" >
                    <label class="checkbox" for="option2"> Trafik</label></li>
                    <li>
                    <input checked onclick="switchCheckbox2(this)" id="option3" type="checkbox" value="Cykel" >
                    <label class="checkbox" for="option3"> Cykel</label></li>
                    <li>
                    <input checked onclick="switchCheckbox2(this)" id="option4" type="checkbox" value="Vegetation" >
                    <label class="checkbox" for="option4"> Vegetation</label></li>
          <li>
              <input checked onclick="switchCheckbox2(this)" id="option5" type="checkbox" value="Renhållning" >
                    <label class="checkbox" for="option5"> Renhållning</label></li>
<li>
              <input checked onclick="switchCheckbox2(this)" id="option6" type="checkbox" value="Allmänna platser" >
                    <label class="checkbox" for="option6"> Allmänna platser</label></li>
<li>
              <input checked onclick="switchCheckbox2(this)" id="option7" type="checkbox" value="Klotter" >
                    <label class="checkbox" for="option7"> Klotter</label></li>

<li>
              <input checked onclick="switchCheckbox2(this)" id="option9" type="checkbox" value="Övrigt" >
                    <label class="checkbox" for="option9"> Övrigt</label></li>

          </ul>
				        <ul id="rightSideStatus">
<li>  
	<input id="checkStatusAll" type="checkBox" onclick="sortByStatus(this)" value="Visa Alla" checked>
		<label class="checkbox" for="checkStatusAll"> Visa Alla</label></li>
<li>
	<input id="checkStatusFixed" type="checkBox" onclick="sortByStatus(this)" value="Slutförd" >
		<label class="checkbox" for="checkStatusFixed"> Slutförd</label></li>
<li>  
	<input id="checkStatusUnfixed" type="checkBox" onclick="sortByStatus(this)" value="Inrapporterad">
		<label class="checkbox" for="checkStatusUnfixed"> Inrapporterad</label></li>
<li>  
	<input id="checkStatusOngoing" type="checkBox" onclick="sortByStatus(this)" value="Under Behandling" >
		<label class="checkbox" for="checkStatusOngoing"> Under Behandling</label></li></ul>

				<ul id="rightSideOther">
<li>  
	<input id="checkCategoryShow" type="checkbox" onclick="switchCheckBoxNew(this)" 			value="1" checked > 
	<label class="checkBox" for="checkCategoryShow" > Kategori</label></li>
				
<li>  
	<input id="checkDateShow" type="checkbox" onclick="switchCheckBoxNew(this)" 			value="4" checked > 
	<label class="checkBox" for="checkDateShow" >Datum</label></li>
<li>  
	<input id="checkStatusShow" type="checkbox" onclick="switchCheckBoxNew(this)" 			value="5" checked > 
	<label class="checkBox" for="checkStatusShow" > Status</label></li>
<li>  
	<input id="checkCommentShow" type="checkbox" onclick="switchCheckBoxNew(this)" 			value="6" checked > 
	<label class="checkBox" for="checkCommentShow" > Kommentarer</label></li>
<li>  
	<input id="checkCompanyShow" type="checkbox" onclick="switchCheckBoxNew(this)" 			value="7" checked > 
	<label class="checkBox" for="checkCompanyShow" > Företag</label></li>
<li>  
	<input id="checkPriorityShow" type="checkbox" onclick="switchCheckBoxNew(this)" 			value="8" checked > 
	<label class="checkBox" for="checkPriorityShow" > Prioritering</label></li>
</ul>
</div>
</div>




<!--<button id="prio-button" onclick="prioFunc()"> Prio </button> -->


<!--Här kommer Editrutan -->
<div id="edit">
<h2> Redigera felrapportering</h2>
<table id="edit-table">

  <tr>
    <td>Id:</td>
    <td><input id="id-textbox" type="text" readonly></td>
  </tr>
 
  <tr>
    <td>Kategori:</td>
    <td><div id="category"></div></td>
  </tr>
 
  <tr id="editTr">
 
    <td id="description-text" valign="top">Beskrivning: </td>
    <td><textarea id="description-textbox" ></textarea></td>
  </tr>
  
</table>
  <div id="editBoxButton" >
  <button id= "removeIssueButton" onclick="removeIssue()"> Ta bort issue </button>
<button id= "removePictureButton" onclick="removePicture()"> Ta bort bild </button>
  <button id= "readyButton" = onclick="changeAll()">Klar</button>	
  </div>
</div>
 	
  


<div class="line-separator"></div>

   <a class="toggle-vis" data-column="1"></a>
   <a class="toggle-vis" data-column="2"></a>
   <a class="toggle-vis" data-column="3"></a>

   <div id="tablediv"></div>

</div>
    	</div>

<div id="right-column">
<div id="miniMap">miniMap</div>
<!-- <button id=biggerMap> Forstora karta </button> -->
<div id="detailedMarkerInfo">	   
<div id='infoboxHeader'><p>Information</p></div>

<hr class="border"> </hr> 

<div id='ID'>
<p>ID</p>
<p class="id_number">Id nummer</p>
</div>

<div> <INPUT TYPE="image" src="https://cdn0.iconfinder.com/data/icons/opensourceicons/32/edit.png" height='34' width='34' id="editIconButton" class='fancybox fancybox.inline' href='#edit' title=""> </div>


        <div class='description'><p class="beskrivning">Beskrivning</p>

<!--<button id="editButton" class='fancybox fancybox.inline' href='#edit'>Redigera</button>-->


        <p class= 'issue-description-box' id = 'issue-description'>Mata in text från databas</p>
	<div id="picture"><img  src="https://cdn3.iconfinder.com/data/icons/technology-internet-and-communication/100/		technology_internet_communications3-512.png" heigth='50' width='50' alt="">
	</div>
</div>
<div id="lower-info">     
        

        

   <div id='company'><p>Företag</p>
        <select><option>Företag 1</option><option>Företag 2</option> <option>Företag 3</option>     </select>
   </div> 

   <div id='status'><p>Status</p>         
   	<select><option>Slutförd</option><option>Under behandling</option> <option>Inrapporterad</option>     </select>
   </div>
	
      <div id = 'comment-munitext' class='comment'><p class="muni-comment">Kommunens ommentar</p>
            <textarea id="textbox" class='textbox' placeholder="Skriv en kommentar till felanmalan"></textarea>
	    </div>
<div id = 'comment-munitext'>
<div id = "buttonHolder">
	
	
<button id="updateTest" class="comment-button"> Uppdatera </button> 
<button id="NewCompButton" onclick="loadNewCompany()" class="fancybox fancybox.inline" href="#newCompany"> Skapa företag </button> 
</div>
      </div>



	   </div>
	</div>
</div>

    </div> <!-- content -->


</div> <!-- container -->


</body>
</html>



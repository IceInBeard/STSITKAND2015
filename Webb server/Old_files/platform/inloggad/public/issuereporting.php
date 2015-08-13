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
<!--Här kommer companyrutan--->
<div id="newCompany" >
<h2> Skapa nytt foretag</h2>
<table class="edit-table">
  <tr>
    <td>Namn:</td>
    <td><input id="newname-textbox" type="text" ></td>
  </tr>
  <tr>
    <td>ID: </td>
    <td><input id="newuserid-textbox" type="text" ></td>
  </tr>
  <tr>
    <td>Kategori:</td>
    <td><input id="newcategories-textbox" type="text" ></td>
  </tr>
  <tr>
    <td>Lokalisering: </td>
    <td><input id="newarea-textbox" type="text" ></td>
  </tr>
  <tr>
    <td>Email: </td>
    <td><input id="newemail-textbox" type="text" ></td>
  </tr>
 
 
</table>
  <div id="editBoxButton" >
  <button onclick="createCompany()">Klar</button>

  </div>
  


</div> 
<!---Här kommer filter rutan--->
<div id="filter" ><!--Här är hela den stora rutan-->
		<div class="leftSide"><!--Här är alla övergripande kategorier-->
			<ul>
				<li id="leftSideCategory">Kategori</li>
				<li id="leftSideStatus">Status</li>
				<li id="leftSideDescription">Beskrivning</li>
				<li id="leftSideDate">Datum</li>
				<li id="leftSideComment">Kommentar</li>
			</ul>
		</div> 
		<div class="rightSide"><!--Här är alla val man kan välja på varje kategori-->
			

				<ul id="rightSideCategory">
<li>
              <input checked onclick="switchCheckboxAll(this)" id="Option10" type="checkbox" value="Välj alla">
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
              <input checked onclick="switchCheckbox2(this)" id="option8" type="checkbox" value="Opinion" >
                    <label class="checkbox" for="option8"> Opinion</label></li>
<li>
              <input checked onclick="switchCheckbox2(this)" id="option9" type="checkbox" value="Övrigt" >
                    <label class="checkbox" for="option9"> Övrigt</label></li>

          </ul>
				        <ul id="rightSideStatus">
				<li><input id="checkStatusFixed" type="checkbox" onlick="switchCheckbox(this)" value="statusFixed" checked=""  ></input> Fixad</li>
				<li>  <input id="checkStatusUnfixed" type="checkbox" onlick="switchCheckbox(this)" value="statusUnfixed" checked=""></input> Ofixad</li>
				<li>  <input id="checkStatusOngoing" type="checkbox" onlick="switchCheckbox(this)" value="statusOngoing" checked=""></input> Påbörjad</li></ul>

				<ul id="rightSideDescription">
				<li>  <input id="checkDescriptionShow" type="checkbox" onlick="switchCheckbox(this)" value="checkDescriptionShow" checked=""></input> Visa beskrivning</li></ul>

				<ul id="rightSideDate">
				<li>  <input id="checkDateShow" type="checkbox" onlick="switchCheckbox(this)" value="checkDateShow" checked=""></input>Visa datum</li></ul>

				<ul id="rightSideComment">
				<li>  <input id="checkCommentShow" type="checkbox" onlick="switchCheckbox(this)" value="checkCommentShow" checked=""></input> Visa kommentarer</li></ul>
			</div>
		</div>


<button id="filterButton" onclick="loadFilter()" class="fancybox fancybox.inline" href="#filter"> Filtrera listan </button>


<!--Här kommer Editrutan--->
<div id="edit">
<h2> Redigera felrapportering</h2>
<table id="edit-table">
  <tr>
    <td>Id:</td>
    <td><input id="id-textbox" type="text" ></td>
  </tr>
  <tr>
    <td>Status: </td>
    <td><input id="status-textbox" type="text" ></td>
  </tr>
  <tr>
    <td>Kategori:</td>
    <td><input id="category-textbox" type="text" ></td>
  </tr>
  <tr>
    <td>Kommentar: </td>
    <td><input id="comment-textbox" type="text" ></td>
  </tr>
  <tr>
    <td>Email: </td>
    <td><input id="email-textbox" type="text" ></td>
  </tr>
  <tr>
    <td>Beskrivning: </td>
    <td><input id="description-textbox" type="text" ></td>
  </tr>
  <tr>
    <td>Företag: </td>
    <td><input id="company-textbox" type="text" ></td>
  </tr>
</table>
  <div id="editBoxButton" >
  <button onclick="changeAll()">Klar</button>
  <button onclick="removeIssue()"> Ta bort </button>
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
<div id="detailedMarkerInfo">	   

<div id='ID'>
<p>ID</p>
<p class="id_number">5KS2094JNFDKSN2</p>
</div>


        <div class='description'><p class="beskrivning">Beskrivning</p><p class= 'issue-description-box' id = 'issue-description'>Mata in text från databas</p>
	<div id="picture"><img  src="https://cdn3.iconfinder.com/data/icons/technology-internet-and-communication/100/		technology_internet_communications3-512.png" heigth='50' width='50' alt="Uppsala kommuns logotyp" >
	</div>
        </div>
<div id="lower-info">     
        
<div class="contact-info">
   <div class="contact-name">
       <p class="kontaktperson"> Kontaktperson</p>
       <p id="contact-name"> Emil Svensson </p>
   </div>

   <div class="contact">
      <p class="kontaktperson"> Email</p>
      <p id="contact-mail"> emil@svensson.se </p>
   </div>

</div>
    

<hr class="border"> </hr> 

        

   <div id='company'><p>Företag ansvarig</p>
        <select><option>Företag 1</option><option>Företag 2</option> <option>Företag 3</option>     </select>
   </div> 

   <div id='status'><p>Status</p>         
   	<select><option>Fixad</option><option>Under behandling</option> <option>Inrapporterad</option>     </select>
   </div>
	
      <div class='comment'><p class="muni-comment">Kommunens kommentar</p>
            <textarea id="textbox" class='textbox' placeholder="Skriv en kommentar till felanmalan"></textarea>
	<button id="updateTest" class="comment-button"> Updatera </button>
	<button id="editButton" class='fancybox fancybox.inline' href='#edit'>Redigera</button>
	<button id="NewCompButton" onclick="loadNewCompany()" class="fancybox fancybox.inline" href="#newCompany"> Nytt foretag </button>  
      </div>



	   </div>
	</div>
    </div> <!-- content -->
</div> <!-- container -->


<?php
include "footer.php";
?>



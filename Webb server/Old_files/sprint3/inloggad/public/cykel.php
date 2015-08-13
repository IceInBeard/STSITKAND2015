<?php
include 'header.php';

if (login_check($mysqli) == false) {
    header("Location: login.php");
}

?>
 <script type="text/javascript" src="js/bicycleOffice.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
		    loading();
		});
	</script>
<div id="container-wide">
    <div id="content">
    	<div id="left-column">

    		<div id="list">

   <div id="cykelknappmeny">
		<button onclick="switchButton(this)"  class="buttonChecked" id="buttonVerkstad" value="verkstad" data-column="0">Verkstad</button>
		<button onclick="switchButton(this)"  class="buttonChecked" id="buttonPump" value="pump" data-column="0">Pump</button>
		<button onclick="switchButton(this)"  class="buttonChecked" id="buttonParking" value="parking" data-column="0">Parkering</button>
		<button onclick="switchButton(this)"  class="buttonChecked" id="buttonNodes" value="nodes" data-column="0">Noder</button>
		<button id="verkstad" onclick="loadCreateWindow('newShop-div')" href="#newShop-div" class="fancybox fancybox.inline"> Skapa ny verkstad </button>
		<button id="pump" onclick="loadCreateWindow('newPump-div')" href="#newPump-div" class="fancybox fancybox.inline"> Skapa ny pump </button>
		<button id="parking" onclick="loadCreateWindow('newParking-div')" href="#newParking-div" class="fancybox fancybox.inline"> Skapa ny parkering </button>
	</div>

    <div id="tablediv" ></div>

   
    <div id="test"></div>
    <div class="widget" id="issueList">
        <table class="infoLista"></table>
    </div>
			</div>








    	</div>

<div id="right-column">
   	<div id="miniMap">miniMap</div>
	<div id="detailedMarkerInfo">	
  	  	<div class='bikeDescription'>
			<div id='name'></div>
			<div id='upperInfo'><p></p></div>
     			
		</div>
		<div class='bottomPart'>
			<div id='position'><p>
				<table id='latling'></table></p>
			</div>
			<div id='lowerInfo'><p>
				<table id="hoursOpen"></table>
			</p></div>
			<div id='buttonHolder'>
				<button id="update_bicycle" class="update-button"> Uppdatera </button>
				<button id="remove" href="#remove-div" class="fancybox fancybox.inline"> Radera </button>  
			</div>
		</div>
  	</div>
</div>
<!--<button id="NewCompButton" onclick="loadCreateWindow('newShop-div')" href="#newShop-div" class="fancybox fancybox.inline"> Skapa ny verkstad </button>-->
<div id="newShop-div" >
<h2> Skapa ny verkstad</h2>
<table class="edit-table">
  <tr>
    <td>Namn:</td>
    <td><input id="newName-textbox" type="text" ></td>
  </tr>
  <tr>
    <td>Latitud: </td>
    <td><input id="newLatitude-textbox" type="text" ></td>
  </tr>
  <tr>
    <td>Longitud: </td>
    <td><input id="newLongitude-textbox" type="text" ></td>
  </tr>
  <tr>
    <td>Beskrivning:</td>
    <td><input id="newDesc-textbox" type="text" ></td>
  </tr>
  <tr>
    <td>Telefonnumer: </td>
    <td><input id="newPhoneNumber-textbox" type="text" ></td>
  </tr>
  <tr>
    <td>Adress: </td>
    <td><input id="newAddress-textbox" type="text" ></td>
  </tr>
  <tr>
    <td>Hemsida: </td>
    <td><input id="newWebsite-textbox" type="text" ></td>
  </tr>
  <tr>
    <td>Email: </td>
    <td><input id="newEmail-textbox" type="text" ></td>
  </tr>
  <tr>
    <td>Måndag: </td>
    <td><input id="newMonday-textbox" type="text" ></td>
  </tr>
  <tr>
    <td>Tisdag: </td>
    <td><input id="newTuesday-textbox" type="text" ></td>
  </tr>
  <tr>
    <td>Onsdag: </td>
    <td><input id="newWednesday-textbox" type="text" ></td>
  </tr>
 <tr>
    <td>Torsdag: </td>
    <td><input id="newThursday-textbox" type="text" ></td>
  </tr>
  <tr>
    <td>Fredag: </td>
    <td><input id="newFriday-textbox" type="text" ></td>
  </tr>
  <tr>
    <td>Lördag: </td>
    <td><input id="newSaturday-textbox" type="text" ></td>
  </tr>
  <tr>
    <td>Söndag: </td>
    <td><input id="newSunday-textbox" type="text" ></td>
  </tr>
<input id="thisMarkerId-textbox" type="text" style="display:none;">
 
</table>

<div id="editBoxButton" >
  <button onclick="createShop()">Klar</button>

  </div>
</div>
 
<div id="newPump-div" >
<h2> Skapa ny Pump</h2>
<table class="edit-table">
  <tr>
    <td>Namn:</td>
    <td><input id="newName-textboxPump" type="text" required ></td>
  </tr>
  <tr>
    <td>Latitud: </td>
    <td><input id="newLatitude-textboxPump" type="text" ></td>
  </tr>
  <tr>
    <td>Longitud: </td>
    <td><input id="newLongitude-textboxPump" type="text" ></td>
  </tr>
  
<input id="thisMarkerId-textbox" type="text" style="display:none;">
 
</table>

<div id="editBoxButton" >
  <button onclick="createPump()">Klar</button>

  </div> 
  </div>

  <div id="newParking-div" >
<h2> Skapa ny Parkering</h2>
<table class="edit-table">
  <tr>
    <td>Adress: </td>
    <td><input id="newAddress-textboxParking" type="text" ></td>
  </tr>
  <tr>
    <td>Antal platser: </td>
    <td><input id="newCapacity-textboxParking" type="text" ></td>
  </tr>
  <tr>
    <td>Latitud: </td>
    <td><input id="newLatitude-textboxParking" type="text" ></td>
  </tr>
  <tr>
    <td>Longitud: </td>
    <td><input id="newLongitude-textboxParking" type="text" ></td>
  </tr>
  
<input id="thisMarkerId-textbox" type="text" style="display:none;">
 
</table>

<div id="editBoxButton" >
  <button onclick="createParking()">Klar</button>

  </div>
</div>  
  
<div id="remove-div">
	<p>Är du säker på att du vill radera?</p>
	<button id="remove_Bicycleoffice" >Radera</button><button onclick="closeFancybox()" >Avbryt</button>
</div>


    </div> <!-- content -->
</div> <!-- container -->


<?php 
include "footer.php";
?>

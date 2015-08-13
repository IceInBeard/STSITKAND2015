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
    	
    	<div id='name'><p>INFO</p></div>
        <div id='open'><p></p><p></p></div>

  	</div>
</div>




    </div> <!-- content -->
</div> <!-- container -->


<?php
include "footer.php";
?>

<html>
<head>
 



   <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMbQF_U346cDNgBehK5fHOVi9rby-Bak4">
    </script>

    <meta charset="UTF-8">

  
  <title>Uppsala Municipality</title>
   
 <script src="jquery-1.11.2.js"></script>
 <script src="anvsida_.js"></script>
 <script type="text/javascript" src="mapFunc.js"></script>
 <script type="text/javascript" src="issues.js"></script>
 <link rel="stylesheet" type="text/css" href="tablestyle.css">
 <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

 <script src="https://cdn.datatables.net/tabletools/2.2.4/js/dataTables.tableTools.min.js"></script>
 <script src="https://editor.datatables.net/media/js/dataTables.editor.min.js"></script>
 <script src="dataTables.js"></script> 
 <link rel="stylesheet" type="text/css" href="anvsida_.css">
    

</head>

<body onload="onloading()">

<div id="header-container">
  
  <header id="top">

        <img id="kommunLogga" src="https://www.uppsala.se/Content/Images/logo_neg.png" alt="Uppsala kommuns logotyp">

      
        <div id='topMenu' role='navigation'>
<!--       
     <div><a class='rubriker' href='index.php'>Hem</a></div>
	    <div><a class='rubriker' href='map.php'>Statestik</a></div>
            <div><a class='rubriker' href='map.php'>Kontakt</a></div>
-->
        </div>

    </header>
</div>

<div id="border-container">
    <div class="gulkant">
    </div>
</div>




<div id="map">   <div id="detailedMarkerInfo">
                <div id="container" class="container">

	   <div id='ID'><p>ID</p><p>5KS2094JNFDKSN2</p></div>
        

        <div class='description'><p>Beskrivning</p><p class= 'hej' id = 'description'>Mata in text från databas</p>
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
        <div id='comment'><p>Kommentar</p>
            <textarea id='textbox' placeholder="Skriv en kommentar till felanmalan"></textarea></div>
	<button id="updateTest"> Update </button>
      </div>
  
    </div>
    <div id="miniMap"> </div>
</div>




<div id="list">
   
 <form>
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

    <div id="tablediv" ></div>

<!-- <button type="button" id="button">Delete</button> -->
    <div id="test"></div>
    <div class="widget" id="issueList">
        <table class="infoLista"></table>
    </div>
</div>

</body>

</html>

11:49 2015-04-24

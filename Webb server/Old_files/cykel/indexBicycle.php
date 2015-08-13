
<html>
<head>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMbQF_U346cDNgBehK5fHOVi9rby-Bak4">
    </script>

    <meta charset="UTF-8">

    <title>Uppsala Municipality</title>
    <script src="jquery-1.11.2.js"></script>
    <script src="../issuereporting/anvsida_.js"></script>
   

    <script type="text/javascript" src="../issuereporting/mapFunc.js">
    </script>
    <script type="text/javascript" src="bicycleOffice.js">
    </script>
    <link rel="stylesheet" type="text/css" href="../issuereporting/tablestyle.css">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.6/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../issuereporting/anvsida_.css">
    

</head>

<body onload="loading()">

<div id="header-container">
    <header id="top">

        <img id="kommunLogga" src="https://www.uppsala.se/Content/Images/logo_neg.png" alt="Uppsala kommuns logotyp">

        <div id="topMenu" role="navigation">
            <div><a class="rubriker" onclick="showIssue('5530ce3aacc591acf375ffa2')">Home</a></div>
            <div><a class="rubriker" href="map.php">Map</a></div>
            <div><a class="rubriker" href="listview.php">List view</a></div>
            <div><a class="rubriker" href="statistcs.php">Statistics</a></div>
            <div><a class="rubriker" href="contact.php">Contact</a></div>
            <div><a class="rubriker" href="language.php">Language</a></div>
        </div>

        <form class="searchbar">
            <input type="text" class="searchbar knapp" value="Seach on Uppsala.se"/>
        </form>

    </header>
</div>

<div id="border-container">
    <div class="gulkant">
    </div>
</div>




<div id="map">   <div id="detailedMarkerInfo">
                <div class="container">
      
        <div id='name'><p>INFO</p></div>
        
        <div id='open'><p></p><p></p></div>
        
     
  
  
      </div>
  
    </div>
    <div id="miniMap"> </div>
</div>
    
</div>




<div id="list">
<button onclick="switchButton(this)"  class="buttonChecked" id="buttonVerkstad" value="verkstad" data-column="0">Verkstad</button>
 <button onclick="switchButton(this)"  class="buttonChecked" id="buttonPump" value="pump" data-column="0">Pump</button>
<button onclick="switchButton(this)"  class="buttonChecked" id="buttonParking" value="parking" data-column="0">Parkering</button>
<button onclick="switchButton(this)"  class="buttonChecked" id="buttonNodes" value="nodes" data-column="0">Noder</button>



    <div id="tablediv" ></div>

   
    <div id="test"></div>
    <div class="widget" id="issueList">
        <table class="infoLista"></table>
    </div>
</div>

</body>

</html>


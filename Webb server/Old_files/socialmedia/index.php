
<html>
<head>
<!--<script src="http://maps.googleapis.com/maps/api/js">
</script>-->
    <meta charset="UTF-8">

<title>Uppsala Municipality</title>	

<script src="jquery-1.11.2.min.js"></script>
<link href="jquery-ui.css" rel="stylesheet">
 <script src="jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
 <script src="jQRangeSlider-5.7.1/jQDateRangeSlider-min.js"></script>
<link href="jquery-ui.theme.css" rel="stylesheet">
<link href="jQRangeSlider-5.7.1/css/iThing-min.css" rel="stylesheet">
<link href="jquery-ui.structure.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="anvsida_.css">
<script type="text/javascript" src='wordcloud.js'></script>
<script type="text/javascript" src = 'wordcounter.js'></script>
<script type="text/javascript" src = 'stopwords.js'></script>
<script type="text/javascript" src="Chart.js-master/Chart.js"></script>
<script src="anvsida_.js"></script>
<script src="mickemap.js"></script>
<script src="socialmediajs.js"></script>
<script type="text/javascript"
  src="https://maps.googleapis.com/maps/api/js?libraries=visualization&sensor=true_or_false">
</script>


</head>
<body>
<div id="header-container">
    <header id="top">

        <img id="kommunLogga" src="https://www.uppsala.se/Content/Images/logo_neg.png" alt="Uppsala kommuns logotyp">

        <div id="topMenu" role="navigation">
            <div><a class="rubriker" href="anvsida_.html">Map</a></div>
            <div><a class="rubriker" href="IssueReport.html">Issues</a></div>
            <div><a class="rubriker" href="IssueReport.html">Contact</a></div>
            <div><a class="rubriker" href="IssueReport.html">Language</a></div>
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




<div id="map">

    <div id="checkContainer">
        <table id="checkTable">
            <thead>
                <tr>
                    <th width="100%"> Alternatives </th>
                </tr>
            </thead>

            <tbody>

                <a href="#"><tr class="header" id="1"> <td colspan="1">Areas</td> </tr></a>
                <a href="#"><tr class="child-1"> <td>Fålhagen</td> </tr></a>
                <a href="#"><tr class="child-1"> <td>Kåbo</td> </tr></a>
                <a href="#"><tr class="child-1"> <td>Stenhagen</td> </tr></a>
                <a href="#"><tr class="child-1"> <td>Svartbäcken</td> </tr></a>

                <tr class="header" id="2"> <td colspan="1">Issues</td> </tr>
                <tr class="child-2"> <td>Vegetation <input type="checkbox" id="checkBelaggning" onclick="checkPump()"></td> </tr>
                <tr class="child-2"> <td>Beläggning <input type="checkbox" id="checkBelaggning" onclick="checkPump()"></td> </tr>
                <tr class="child-2"> <td>Renhållning <input type="checkbox" id="checkRenhallning" onclick="checkPump()"></td> </tr>
                <tr class="child-2"> <td>Skyltning <input type="checkbox" id="checkSkyltning" onclick="checkPump()"></td> </tr>
                <tr class="child-2"> <td>Snöröjning <input type="checkbox" id="checkSnorojning" onclick="checkPump()"></td> </tr>
                <tr class="child-2"> <td>Målning <input type="checkbox" id="checkMalning" onclick="checkPump()"></td> </tr>
                <tr class="child-2"> <td>Övrigt <input type="checkbox" id="checkOvrigt" onclick="checkPump()"></td> </tr>

                <tr class="header" id="3"> <td colspan="1">Issue Reporting</td> </tr>
                <tr class="child-3"> <td>Ongoing issues</td> </tr>
                <tr class="child-3"> <td>Current events</td> </tr>
                <tr class="child-3"> <td>Points of interest</td> </tr>

                <tr class="header" id="4"> <td colspan="1">Cykel</td> </tr>
                <tr class="child-4"> <td>Cykelpumpar <input type="checkbox" id="checkPumps" onclick="checkPump()"></td> </tr>
                <tr class="child-4"> <td>Cykelverkstäder: <input type="checkbox" id="checkVerkstad" onchange="checkVerkstad()"></td> </tr>
                <tr class="child-4"> <td>Cykelparkering: <input type="checkbox" id="checkParkering" onchange="checkParkering()"></td> </tr>
                

            </tbody>
        </table>
    </div>
    <div id="map_container"> </div>
</div>


	

<div id="widgetsMain">
<div>
    <form id='mapuiform'>
    <input type='radio' name='mapui' value='heat' checked>Visa heatmap
    <br>
    <input type='radio' name='mapui' value = 'marker'>Visa markers
    </form>
<button id="js-showTweets">Visa Twitter på karta</button>
<button id="js-removeTweets">Ta bort Tweets från karta</button>
<button id="js-showHeat">Visa Heatmap</button>
<button id="js-hideHeat">Göm Heatmap</button>
<button id="js-destroyGraph">Destroy graph</button>
<div id="slider"></div>
<br>
<input id="js-searcWord" size="50">
<br>
<p>Från: <input id="tweetsfrom" class="datepicker" type="text"> Till: <input id="tweetsuntil" class="datepicker" type="text"></p>
<button id="tweetSearchButton">Sök efter tweets</button> <input type="checkbox" id="tweetOnMap"> Visa på karta?
<!--<div>
    <iframe id="gustav" width="640" height="480" frameborder="0" seamless="seamless" scrolling="no" src="https://plot.ly/~Gustafv/25?width=640&height=480" ></iframe> 
</div>-->
<canvas id='wordCloudCanvas' width='300' height = '300'></canvas>
<canvas id='plotCanvas' width='300' height = '300'></canvas>
<div>
    <label>Resultat: </label><p id="tweetResult"></p>
</div>
</div>
	<div class="widget" id="bikeInfo">
	</div>
	<div class="widget" id="socialMedia">
	</div>
	<div class="widget" id="issueReporting"> 
	</div>
</div>

<div id="footer">
        </div>
</div>
</div>

</body>

</html>

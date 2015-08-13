<?php
include 'header.php';
?>

<div id='map-container'>      
	<div id='map-controll-container'>    


	<div id='cssmenu'>             
		<ul>                           
			<li class='has-sub'><a href='#'><span>Felanmälan</span></a>                   
				<ul>
					<li><a href='#'onclick='addwidget("issue1")'><span>Gör en felamnälan</span></a></li>                     
					<li ><a href='#' onclick='addwidget("issue2")'><span>Subwidget 2</span></a></li>                      
					<li class='last'><a href='#' onclick='addwidget("issue3")'><span>Subwidget 3</span></a></li>
				</ul>                
			</li>                
			<li class='has-sub'><a href='#'><span>Cykel</span></a>                   
				<ul>
					<li><a href='#' onclick='addwidget("cykel1")'><span>Cykelflöde Dag H.s väg</span></a></li>                     
					<li><a href='#' onclick='addwidget("cykel2")'><span>Cykelflöde Resecentrum</span></a></li>                      
					<li><a href='#' onclick='addwidget("cykel3")'><span>Cykelflöde Hamnspången</span></a></li>  
					<li><a href='#' onclick='addwidget("cykel4")'><span>Cyklister i siffror</span></a></li>
					<li class='last'><a href='#' onclick='addwidget("cykel5")'><span>Verkstadslista</span></a></li>               
				</ul>
			</li> 
			<li class='has-sub last'><a href='#'><span>Sociala medier</span></a>                   
				<ul>
					<li><a href='#' onclick='addwidget("social1")'><span>Sentimentanalys</span></a></li>                     
					<li ><a href='#' onclick='addwidget("social2")'><span>Graf</span></a></li>                      
					<li class='last' onclick='addwidget("social3")'><a href='#'><span>Wordcloud</span></a></li>               
				</ul>
			</li>             
		</ul>         
	</div>  



	</div>
	<div id='map'></div>
	<div id='map-timeslider-container'> <form> Från : <input type='text'>  Till : <input type='text'></form></div>

</div>


<div id='widget-container'>
	<div class='widget'>
		<div class='widgethead'><img src="http://www.besttechcomputing.info/web-maintenance.png"> Felanmälningar </div>
		<?php include 'widgets/issuemainwidget.php'; ?>
	</div>
	
	<div class='widget'>
		<div class='widgethead'>Cykel</div>
		<?php include 'widgets/cykelmainwidget.php'; ?>
	</div>
	
	<div class='widget'>
		<div class='widgethead'><img src="https://cdn.serinus42.com/2736c696f21f302/uploads/c/300/a4e0b/twitter-logo_22.png" alt="Twitters logotyp"> Sociala medier </div>
		<?php include 'widgets/socialmainwidget.php'; ?>
	</div>
</div>

<div id='subwidget-container'>

</div>



    


<?php
//include 'footer.php';
?>
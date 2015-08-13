var subwidget = {
    
    issue1 : ["<img src='http://www.besttechcomputing.info/web-maintenance.png'> Gör en felanmälning","<div class='IssueSubwidget'> \
    <div class='bottom'> \
        <table> \
            <tr><td>Har är felet: <input  type='text' name='Geotag' placeholder='Skriv in adress eller tryck pa kartan'><br></td></tr> \
            <tr><td>Kategori: <select> \
                    <option>Välj en kategori</option> \
                    <option>Trafik</option> \
                    <option>Graffiti</option> \
                    <option>Soptunnor</option> \
                    <option>Vägar</option> \
                    <option>Cyklar</option> \
                    <option>Offentlig plats</option> \
                    <option>Vegetation</option> \
                    <option>Övrigt</option> \
                </select></td></tr> \
            <tr><td>Beskrivning: <textarea rows='3' placeholder='Beskriv felet'></textarea><br>(max 200 ord)</td></tr> \
            <tr><td>Namn: <input  type='text' name='Namn' placeholder='For och efternamn'><br>(valfri)</td></tr> \
            <tr><td>Aterkoppling: <input  type='text' name='Aterkoppling' placeholder='Mejl/Telefonnummer'><br>(valfri)</td></tr> \
        </table> \
        <button class='skicka'>KLAR</button> \
    </div> \
    </div>"],
    issue2 : ["<img src='http://www.besttechcomputing.info/web-maintenance.png'> Issue subwidget 2", "Issue subwidget 2"],
    issue3 : ["<img src='http://www.besttechcomputing.info/web-maintenance.png'> Issue subwidget 3", "Issue subwidget 3"],

    cykel1 : ["Cykelflöde Dag H.", "<iframe id='maja' width='320' height='270' frameborder='0' seamless='seamless' scrolling='no' src='https://plot.ly/~MajaEngvall/134?width=320&height=270' ></iframe>"],
    cykel2 : ["Cykelflöde Resecentrum", "<iframe id='maja' width='320' height='270' frameborder='0' seamless='seamless' scrolling='no' src='https://plot.ly/~MajaEngvall/263?width=320&height=270' ></iframe>"],
    cykel3 : ["Cykel Hamnspången", "<iframe id='maja' width='320' height='270' frameborder='0' seamless='seamless' scrolling='no' src='https://plot.ly/~MajaEngvall/243?width=320&height=270' ></iframe>"],
    cykel4 : ["Cyklister i siffror", "<div class='cykelSubWidget'> \
            <div id='CyclistTodayAndLastWeek'> \
                <table id='AmountCyclistTable'> \
                    <tr class='header'> <td>Plats</td><td >Idag</td><td > Igår</td></tr> \
                    <tr class='text'> <td >Hamnspången</td> <td >2500</td><td >3233</td></tr> \
                    <tr class='text'> <td >Daghammarsköldsväg</td> <td >3332</td><td >1563</td></tr> \
                    <tr class='text'> <td >Rececentrum</td> <td >5411</td><td >3324</td></tr> \
                    <tr class='text'> <td >Totalt</td> <td >14235</td><td >9457</td></tr> \
                </table> \
            </div> \
        </div>"],
cykel5 : ["Verkstadslista", "<div id='ServiceShopTable' class='cykelSubWidget'><a href='#' onClick='createTable()'>Generera lista</a></div>"],
social1 : ["<img src='https://cdn.serinus42.com/2736c696f21f302/uploads/c/300/a4e0b/twitter-logo_22.png' alt='Twitters logotyp'> Sentimentanalys", "<iframe id='gustav2' width='320' height='270' frameborder='0' seamless='seamless' scrolling='no' src='https://plot.ly/~Gustafv/144?width=320&height=270' ></iframe> "], 
social2 : ["<img src='https://cdn.serinus42.com/2736c696f21f302/uploads/c/300/a4e0b/twitter-logo_22.png' alt='Twitters logotyp'> Graf", "<iframe id='gustav' width='320' height='270' frameborder='0' seamless='seamless' scrolling='no' src='https://plot.ly/~Gustafv/25?width=320&height=270' ></iframe> "],
social3 : ["<img src='https://cdn.serinus42.com/2736c696f21f302/uploads/c/300/a4e0b/twitter-logo_22.png' alt='Twitters logotyp'> Social Wordcloud", "<div class='social3'><img src='https://www.whitehouse.gov/sites/default/files/other/sotu_wordle.png'></div>"]




};

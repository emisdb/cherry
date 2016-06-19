<style>
@font-face {
    font-family: Roman;
    src: local(Roman), url('../fonts/GOTHAMROUNDED-MEDIUM.OTF');
}
@font-face {
    font-family: Lt;
    src: local(Lt), url('../fonts/GOTHAMROUNDED-MEDIUM.OTF');
}
@font-face {
    font-family: Roman-Bold;
    src: local(Roman-Bold), url('../fonts/GOTHAMROUNDED-BOLD.OTF');
} 
.main{font-family: Roman; font-size:14px; width:800px; color:#525252;}
.header{ height:220px;}
.header img:nth-child(2){position: relative; top:-220px;}
li{list-style:none; margin-left:-30px;}
.body a{color:#333;}
.footer{ font-size:12px; color:#aaa; border-top:1px dashed #aaa; padding-bottom:30px;}
.footer b{color: #888;}
.footer a{color: #999;}
.footer li:nth-child(1){margin-left:-40px;}
.footer li{display:inline-block; margin-left:0px; margin-right:50px; vertical-align:text-top;}
</style>
<div class="main">
<div class="header">
<img src="../template/design-1/images/<?=$city_en;?>350.jpg" width="800">
<img src="../template/design-1/icons/danke.svg" width="100%" height="100">
</div>
<div class="body">
<h1>Vielen Dank für Ihre Tourbuchung bei Cherrytours Berlin</h1>
<h2>Folgenden Tourtermin haben wir verbindlich  für Sie reserviert:</h2>
<p><?=$date_tour;?>
<ul>
 <li>Tourbeginn: <?=$tour_starttime;?> Uhr  (bitte 5 Min. vor Tourbeginn am Treffpunkt einfinden)</li>
  <li>Tourende: <?=$tour_stoptime;?>Uhr</li>
  <li>Teilnehmer: <?=$tour_guest;?></li>
  <li>Ihre Tour: <?=$tour_name;?></li>
  <li>Toursprache: <?=$tour_lang;?></li>
  <li>Treffpunkt: <a href="<?=$tour_link;?>">Alter Markt, am Jan  von Werth Brunnen</a></li>
  <li>Ihr Guide: <?=$tour_guide_name;?></li>
  <li>Handynummer Guide: <?=$tour_guide_tel;?> (für  kurzfristige Anfragen z.B. Wetter oder Treffpunkt)</li>
</ul>
</p>
<p>
 Ihre übermittelten Buchungsdaten:
<ul>
 <li><?=$contact_name;?></li>
 <li><?=$contact_street;?></li>
 <li><?=$contact_city;?></li>
 <li><?=$contact_land;?></li>
 <li><?=$contact_tel;?></li>
 <li><?=$contact_email;?></li>
 </ul>
</p>
<h2>Hinweise zur Tour</h2>
<p>
  Bezahlung:
  <ul>
  <li>- Erfolgt vor Ort</li>
  </ul>
</p>
<p>Wir akzeptieren folgende Zahlungsmethoden:
<ul>
 <li> - Barzahlung in EUR</li>
 <li> - Kreditkarten (Visa, Master Card, American Express, JCB Cards, Union Pay)</li>
 <li> - bei uns erworbene Gutscheine</li>
</ul>
</p>
<p>Wetter:</p>
<p>
  Ist es auf Grund von Wetterprognosen absehbar, dass es zu Ihrem Tourtermin  regnen wird, setzen wir uns mit Ihnen kurzfristig in Verbindung. In diesem Fall  informieren wir Sie per E-Mail, SMS oder telefonisch falls die Tour abgesagt  werden muss.<br>
  Sollte sich entgegen der Wetterprognosen dennoch regnen, entscheidet der  Tourguide vor Ort ob die Tour stattfinden wird. Generell ist der Tourverlauf so  angelegt, dass man sich während der Fahrt bei kurzen Schauern unterstellen  kann.<br>
</p>
<p>Tourteilnehmer (Mindestanzahl):</p>
<p>
Sollten sich für Ihre gebuchte Tour weniger als 2 Teilnehmer anmelden, wird  diese Tour ca. 12 Stunden vor Tourbeginn via E-Mail und SMS abgesagt. Wir  bitten Sie dahingehend um Ihr Verständnis.<br>
</p>
<p>Freuen Sie sich auf eine erlebnisreiche Tour!</p>
<p>Es gelten die <a href="http://cherrytours.de">AGB</u> der Cherrytours GmbH.</p>
  
</div>
<div class="footer">
<p>  
  <b>Ihr Cherrytours Berlin Team</b>
  <ul>
  <li>
    Cherrytours GmbH<br>
    Mittelstraße 30<br>
    10117 Berlin<br>
    Deutschland
  </li>
  <li>
    Web: <a href="http://www.cherrytours">http://www.cherrytours</a><br>
    E-Mail: berlin@cherrytours.de<br>
    Tel.: +49 221 27260597
  </li>
  <li>
    Ust-ID Nr.: <br>
    Handelsregisternummer: HRB 169040<br>
    Registergericht: Charlottenburg<br>
    AFFILIATE: NONE 217.225.126.254
  </li>
 </ul>
</p>
</div>
</div>
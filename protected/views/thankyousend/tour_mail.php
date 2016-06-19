<div style="font-family: Open Sans, Verdana, Geneva, sans-serif; font-size:14px; color:#525252;">
<p><img src="http://<?=$_SERVER['HTTP_HOST'];?>/template/design-1/images/<?=$city_en;?>_mail350.jpg" width="100%"></p>
<h1><?= Yii::t('api', 'Vielen_Dank'); ?> <?=$city_name;?></h1>
<h2><?= Yii::t('api', 'Folgenden'); ?></h2>
<p>
<b><?=$tour_date;?></b>
<ul style="list-style:none; margin-left:0px; padding-left:10px;">
 <li><?= Yii::t('api', 'Tourbeginn'); ?><?=$tour_starttime;?> Uhr  (bitte 5 Min. vor Tourbeginn am Treffpunkt einfinden)</li>
  <li><?= Yii::t('api', 'Tourende'); ?> <?=$tour_stoptime;?></li>
  <li><?= Yii::t('api', 'Teilnehmer'); ?><?=$tour_guest;?></li>
  <li><?= Yii::t('api', 'Ihre_Tour: '); ?><?=$tour_name;?></li>
  <li><?= Yii::t('api', 'Toursprache'); ?><?=$tour_lang;?></li>
  <li><?= Yii::t('api', 'Treffpunkt'); ?> <?=$meetingpoint?></li>
  <li>Ihr Guide: <?=$tour_guide_name;?></li>
  <li> <?= Yii::t('api', 'Handynummer_Guide'); ?><?=$tour_guide_tel;?> <?= Yii::t('api', 'kurzfristige'); ?></li>
</ul>
</p>
<p><?= Yii::t('api', 'Buchungsdaten'); ?></p>
<p>
<ul style="list-style:none; margin-left:0px; padding-left:10px;">
 <li><?=$contact_name;?></li>
 <li><?=$contact_street;?></li>
 <li><?=$contact_city;?></li>
 <li><?=$contact_land;?></li>
 <li><?=$contact_tel;?></li>
 <li><?=$contact_email;?></li>
 </ul>
</p>
<h2><?= Yii::t('api', 'Hinweise'); ?></h2>
<p>
  <?= Yii::t('api', 'Bezahlung'); ?>
  <ul style="list-style:none; margin-left:0px; padding-left:10px;">
  <li><?= Yii::t('api', 'Erfolgt'); ?></li>
  </ul>
</p>
<p><?= Yii::t('api', 'akzeptieren'); ?>
<ul style="list-style:none; margin-left:0px; padding-left:10px;">
 <li> <?= Yii::t('api', 'Barzahlung'); ?></li>
 <li><?= Yii::t('api', 'Kreditkarten'); ?></li>
 <li><?= Yii::t('api', 'erworbene'); ?></li>
</ul>
</p>
<p><?= Yii::t('api', 'Wetter'); ?></p>
<p><?= Yii::t('api', 'Wetterprognosen'); ?></p>
<br>

<p><?= Yii::t('api', 'Mindestanzahl'); ?></p>
<p><?= Yii::t('api', 'Ihre_gebuchte'); ?></p>
<br>

<p><?= Yii::t('api', 'Freuen'); ?></p>
<p><?= Yii::t('api', 'Es_gelten'); ?> <a href="http://<?=$_SERVER['HTTP_HOST'];?>" style="color: #333;"><?= Yii::t('api', 'AGB_m'); ?></a> <?= Yii::t('api', 'der_Cherrytours'); ?></p>
 <p><?= Yii::t('api', 'Ihr_Cherrytours'); ?></p> 
</div>
<div style="font-size:12px; color:#aaa; border-top:1px dashed #aaa; padding-bottom:30px;">
<p>  
  
  <ul style="list-style:none; margin-left:0px; vertical-align:text-top; padding:0px;">
  <li style="float:left;">
    Cherrytours GmbH<br>
    Mittelstraße 30<br>
    10117 Berlin<br>
    Deutschland
  </li>
  <li style="float:left; margin-left:30px;">
    Web: <a href="http://<?=$_SERVER['HTTP_HOST'];?>" style="color: #999;"> http://www.cherrytours.de</a><br>
    E-Mail: berlin@cherrytours.de<br>
    Tel.: +49 221 27260597
  </li>
  <li style="float:left; margin-left:30px;">
    StNr: 1130/251/50018 <br>
    Handelsregisternummer: HRB 169040<br>
    Registergericht: Charlottenburg<br>
    AFFILIATE: NONE 217.225.126.254
  </li>
 </ul>
</p>
</div>
</div>
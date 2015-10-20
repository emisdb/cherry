<?php

/*FORMS*/
$forms = $_POST['name_forms'];
if($forms==1)$name_forms = 'KAUF';
if($forms==2)$name_forms = 'VERKAUF';
if($forms==3)$name_forms = 'VERMIETUNG';
if($forms==4)$name_forms = 'SERVICE REPARATUR';

/* Segway */
$segkauf = $_POST['segkauf'];
$segkauf_text = '';
if($segkauf==1)$segkauf_form = 'Segway PT i2 SE';
if($segkauf==2)$segkauf_form = 'Segway PT i2 SE mit';
if($segkauf==3)$segkauf_form = 'Segway PT x2 SE';

if($segkauf!='')$segkauf_text = "\nSegway: ".$segkauf_form;
/* All */
$andrede_form = $_POST['andrede'];
$name_form = $_POST['name'];
$email_form = $_POST['email'];
$tel_form = $_POST['tel'];
$ruckruf = $_POST['ruckruf'];
$betreef = $_POST['betreef'];
$nachricht = $_POST['nachricht'];
/* Town */
$town = $_POST['town'];
$town_text = '';
if($town!='')$town_text = "\nAnmietungsort: ".$town;
/* Seriennumme */
$seriennumme = $_POST['seriennumme'];
$seriennumme_text = '';
if($seriennumme!='')$seriennumme_text = "\nSeriennumme: ".$seriennumme;
/* Model */
$model = $_POST['model'];
$model_text = '';
if($model!='')$model_text = "\nModel: ".$model;
/* KM-Stand */
$stand = $_POST['stand'];
$stand_text = '';
if($stand!='')$stand_text = "\nKM-Stand: ".$stand;

$message = $segkauf_text."\nAndrede: ".$andrede_form."\nName: ".$name_form."\nEmail-Adresse:".$email_form."\nTelefon: ".$tel_form."\nTelefonischer Rückruf: ".$ruckruf.$town_text.$seriennumme_text.$model_text.$stand_text."\nBetreef: ".$betreef."\nNachricht: ".$nachricht;
/*$message = wordwrap($message, 70);*/

$to  = "info@seg-dealer.de, " ;
$to .= "fizinta@yandex.ru";
mail($to, $name_forms, $message);

echo "
<html>
  <head>
   <meta http-equiv='Refresh' content='0; URL=".$_SERVER['HTTP_REFERER']."/'>
  </head>
</html>";

/*
echo "
<html>
  <head>
   <meta http-equiv='Refresh' content='0; URL=".$_SERVER['HTTP_REFERER']."?send=true'>
  </head>
</html>";*/

?>

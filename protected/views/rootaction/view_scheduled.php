<?php
$this->breadcrumbs=array(
	'Delete all scheduled',
);
?>

<h1>DELETE ALL SCHEDULED!</h1>

<hr />	
Delete table scheduled!

<hr />
<div>Status scheduled</div>
Status of the tour can be:
<ul>
<li>
Belegt - which means another guide has taken this tour</li>
<li>frei! - which means this tour is free and available to be taken</li>
<li>Belegt, Deine Tour! - which means that this tour is reserved by you</li>
<li>Belegt, braucht aber einen Guide - which means there are people who booked for this tour, but there’s no guide.</li>

<ul>

<hr />	

<div class="create"><a href="<?php echo Yii::app()->createUrl('/rootaction/delete_scheduled'); ?>">DELETE ALL SCHEDULED</a></div>



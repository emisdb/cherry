<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Delete all users ',
);
?>

<h1>DELETE ALL USERS!</h1>

<hr />	
Delete all table for user: 
<ul>
<li>table - user;</li>
<li>table - contacts;</li>
<li>table - guidedata;</li>
<li>table - guide-language;</li>
<li>table - guide-town;</li>
<li>table - guide-tours.</li>
</ul>

<hr />	

<div class="create"><a href="<?php echo Yii::app()->createUrl('/rootaction/delete_users'); ?>">DELETE ALL USERS</a></div>


<?php
/* @var $this SegGuidesdataController */
/* @var $model SegGuidesdata */

$this->breadcrumbs=array(
    'Users'=>array('user/admin'),
	$update_user->username=>array('user/update/id/'.$update_user->id),
	//$model->idcontacts=>array('view','id'=>$model->idcontacts),
	'Update guide information',
);

?>

<h1>Update guide information -  <?php echo $update_user->username; ?></h1>

<div class="create"><a href="<?php echo Yii::app()->createUrl('/segGuidesCities/update',array('id_user'=>$id_user)); ?>">Update citie work</a></div>

<div class="create"><a href="<?php echo Yii::app()->createUrl('/segLanguagesGuides/update',array('id_user'=>$id_user)); ?>">Update language</a></div>

<div class="create"><a href="<?php echo Yii::app()->createUrl('/segGuidesTourroutes/update',array('id_user'=>$id_user)); ?>">Update categorya tour</a></div>

<div class="create">
	<? if ($istourroutes>0) { ?>
		<a href="<?php echo Yii::app()->createUrl('/segGuidesdata/cashinfo',array('id_user'=>$id_user)); ?>">Update cash info</a>
	<? } else { ?>
    	<div class="noactive_link" title="Fill based information on guide">Update cash info</div>
    <? }?>
</div>

<?php $this->renderPartial('_form', array('model'=>$model,'id_user'=>$id_user)); ?>
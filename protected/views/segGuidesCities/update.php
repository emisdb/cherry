<?php
/* @var $this SegGuidesCitiesController */
/* @var $model SegGuidesCities */

$this->breadcrumbs=array(
	'Users'=>array('user/admin'),
    $update_user->username=>array('user/update','id'=>$update_user->id),
    'Update guide information'=>array('segGuidesdata/update','id'=>$id_guide,'id_user'=>$update_user->id),
//	$model->idseg_guides_cities=>array('view','id'=>$model->idseg_guides_cities),
	'Update cities',
)


?>

<h1>Update information cities for user <?php echo  $update_user->username; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'id_guide'=>$id_guide,'update_user'=>$update_user)); ?>
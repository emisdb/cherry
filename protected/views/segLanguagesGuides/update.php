<?php
/* @var $this SegLanguagesGuidesController */
/* @var $model SegLanguagesGuides */

$this->breadcrumbs=array(
	'Users'=>array('user/admin'),
    $update_user->username=>array('user/update','id'=>$update_user->id),
    'Update guide information'=>array('segGuidesdata/update','id'=>$id_guide,'id_user'=>$update_user->id),
//	$model->idseg_guides_cities=>array('view','id'=>$model->idseg_guides_cities),
	'Update languages',
);

?>

<h1>Update languages for guide - <?php echo $update_user->username; ?></h1>
<div class="form">
    <form method="post">
    <?php $i=0;?>
    <?php foreach($languages_all as $languages_item) {?> 
        <?php $i++;$j=0;?>
        <?php foreach($languages as $languages_i){
            if($languages_i->languages_id == $languages_item->id_languages) {$j=1;}
        }?>
        <div class="row">
            <input name="languages<?php echo $i;?>" type="checkbox" value="<?php echo $languages_item->id_languages;?>" <?php if($j==1) echo 'checked';?> >
            <img src="<?php echo Yii::app()->request->baseUrl;?>/img/lan/<?php echo $languages_item->flagpic;?>" />
        </div>
        <?php $j=0;?>
    <?php }?>
	<div class="row buttons">
        <button class="btn btn-primary" type="submit"><?php echo 'Save'; ?></button>
        <button class="btn btn-primary cancel"><a href="<?php echo Yii::app()->request->baseUrl; ?>/segGuidesdata/update/id/<?php echo $id_guide;?>/id_user/<?php echo $update_user->id;?>"><?php echo 'Cancel'; ?></a></button>
    </div>
    
    </form>


</div>
<!--
<php $this->renderPartial('_form', array('model'=>$model,'languages_array'=>$languages_array)); ?>
-->
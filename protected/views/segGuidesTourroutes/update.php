<?php
/* @var $this SegGuidesTourroutesController */
/* @var $model SegGuidesTourroutes */

$this->breadcrumbs=array(
	'Users'=>array('user/admin'),
    $update_user->username=>array('user/update','id'=>$update_user->id),
    'Update guide information'=>array('segGuidesdata/update','id'=>$id_guide,'id_user'=>$update_user->id),
//	$model->idseg_guides_cities=>array('view','id'=>$model->idseg_guides_cities),
	'Update tourrouters',
);


?>

<h1>Update tourrouters for guide -  <?php echo $update_user->username; ?></h1>
<div class="form">
    <form method="post">
    <?php $i=0;?>
    <?php foreach($tours_all as $tours_item) {?> 
        <?php $i++;$j=0;?>
        <?php foreach($tours as $tours_i){
            if($tours_i->tourroutes_id == $tours_item->id_tour_categories) {$j=1;}
        }?>
        <div class="row">
            <input name="tours<?php echo $i;?>" type="checkbox" value="<?php echo $tours_item->id_tour_categories;?>" <?php if($j==1) echo 'checked';?> >
            <div><?php echo $tours_item->name;?></div><!--<img src="<php echo Yii::app()->request->baseUrl;?>/img/lan/<php echo $languages_item->flagpic;?>" />-->
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
<php $this->renderPartial('_form', array('model'=>$model)); ?>
-->
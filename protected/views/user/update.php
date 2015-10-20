<?php if($model->id != Yii::app()->user->id) {?>
<?php
$this->breadcrumbs=array(
    'Users'=>array('admin'),
	'Update user ',
);
?>
<?php }else{?>
<?php
$this->breadcrumbs=array(
    'Profile'=>array('profile'),
	'Update profile information',
);
?>
<?php }?>

<h1>Update user - <?php echo $model->username; ?> (<?php echo $model->role_ob->groupname; ?> )</h1>

<!--
<div class="create"><a href="<php echo Yii::app()->request->baseUrl; ?>/user/update_root_contact/id_user/<php echo $model->id;?>/id/<php echo $model->id_contact;?>">Update contact</a></div>
<php if($model->id_guide!=0){?><div class="create"><a href="<php echo Yii::app()->request->baseUrl; ?>/user/update_root_guide/id_user/<php echo $model->id;?>/id/<php echo $model->id_guide;?>">Update guide info</a></div><php }?>
-->

<?php if($model->id != Yii::app()->user->id) {?>
	<div class="create">
    	<a href="<?php echo Yii::app()->createUrl('/segContacts/update',array('id'=>$model->id_contact,'id_user'=>$model->id)); ?>">Update contact</a>
    </div>
	<?php if($model->id_guide!=0){?>
    	<div class="create">
        	<a href="<?php echo Yii::app()->createUrl('/segGuidesdata/update',array('id'=>$model->id_guide,'id_user'=>$model->id));?>">Update guide info</a>
        </div>
	<?php } ?>
<?php } ?>



<hr />	



<?php $this->renderPartial('_form', array('model'=>$model/*,'usergroups'=>$usergroups*/)); ?>
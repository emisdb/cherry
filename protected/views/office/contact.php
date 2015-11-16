<?php $this->renderPartial('_top', array('info'=>$info)); ?>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
<?php if($model->idcontacts != Yii::app()->user->id) {?>
<?php
$this->breadcrumbs=array(
    'Users'=>array('user/admin'),
	$update_user->username=>array('user/update/id/'.$update_user->id),
	//$model->idcontacts=>array('view','id'=>$model->idcontacts),
	'Update contact',
);
?>
<?php }else{?>
<?php
$this->breadcrumbs=array(
    'Profile'=>array('user/profile'),
	'Update profile contact',
);
?>
<?php }?>
<h1>Update contact - <?php echo $update_user->username; ?></h1>
       </section>

        <!-- Main content -->
        <section class="content">


<?php $this->renderPartial('_form_contact', array('model'=>$model,'id_user'=>$id_user)); ?>
		</section><!-- /.content -->
      </div><!-- /.content-wrapper -->

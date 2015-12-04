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
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seg-guidesdata-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>



	<?php echo $form->errorSummary($model); ?>


<?php $this->renderPartial('_form_contact', array('model'=>$model,'id_user'=>$id_user, 'form'=>$form)); ?>

<?php $this->renderPartial('_form_gd', array('model'=>$modelgd,'id_user'=>$id_user, 'form'=>$form)); ?>
	<div class="row buttons">
        <button class="btn btn-primary" type="submit"><?php echo 'Save'; ?></button>
 		<button class="btn btn-primary cancel"><?php echo CHtml::link("Cancel", array("admin")) ?></button>
    </div>


<?php $this->endWidget(); ?>

</div><!-- form -->		
		</section><!-- /.content -->
      </div><!-- /.content-wrapper -->

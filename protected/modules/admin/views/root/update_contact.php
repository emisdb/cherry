<?php 
 Yii::app()->clientScript->registerScriptFile('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js',CClientScript::POS_HEAD);
$this->renderPartial('_top', array('info'=>$info));
?>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
			<?php
$this->breadcrumbs=array(
    'Users'=>array('uadmin'),
	'User Profil anpaßen',
);

 $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=>$this->breadcrumbs,
        'homeLink'=>false,
        'tagName'=>'ul',
        'separator'=>'',
        'activeLinkTemplate'=>'<li><a href="{url}">{label}</a></li>',
        'inactiveLinkTemplate'=>'<li><span>{label}</span></li>',
        'htmlOptions'=>array ('class'=>'breadcrumb')
    ));
			
?>
<h1>Kontaktdaten aktualisieren für <?php echo $update_user->username; ?></h1>
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
	<div class="row buttons">
        <button class="btn btn-primary" type="submit"><?php echo 'Speichern'; ?></button>
 		<button class="btn btn-primary cancel"><?php echo CHtml::link("Abbrechen", array("admin")) ?></button>
    </div>


<?php $this->endWidget(); ?>
		</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
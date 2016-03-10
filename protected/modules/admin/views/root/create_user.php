<?php 
 Yii::app()->clientScript->registerScriptFile('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js',CClientScript::POS_HEAD);
$this->renderPartial('_top', array('info'=>$info));
?>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>Neuer Benutzer </h1>
     </section>

        <!-- Main content -->
        <section class="content">
            
<div class="form">

<?php

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
   // 'enableClientValidation' => true,
  //  'clientOptions' => array(
 //       'validateOnSubmit' => true,
 //       'validateOnChange' => true,
 //   ),
  //  'action'=>Yii::app()->createUrl($model->isNewRecord ? 'user/create' : 'user/update?id='.$model->id),
)); ?>

	<?php echo $form->errorSummary($model); ?>
 
<?php 

	$this->renderPartial('_form_user',
		array('model'=>$model,
			'form'=>$form,
				'usergroups'=>$usergroups,
		)); 

	$this->renderPartial('_form_contact_user',
		array('model'=>$modelc,
			'form'=>$form,
				'usergroups'=>$usergroups,
		)); ?>
	
	
	<div class="row buttons">
        <button class="btn btn-primary" type="submit">Speichern</button>
        <?php if($model->id != Yii::app()->user->id) {?>
            <button class="btn btn-primary cancel"><a href="<?php echo Yii::app()->request->baseUrl; ?>uadmin"><?php echo 'Abbrechen'; ?></a></button>
        <?php }else{?>
            <button class="btn btn-primary cancel"><a href="<?php echo Yii::app()->request->baseUrl; ?>profile"><?php echo 'Abbrechen'; ?></a></button>
        <?php }?>
    </div>
<?php $this->endWidget(); ?>

</div><!-- form -->
		</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
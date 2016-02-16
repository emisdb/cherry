 <?php
 Yii::app()->clientScript->registerScriptFile('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js',CClientScript::POS_HEAD);
 $this->renderPartial('_top', array('info'=>$info));
 ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
			<h1>Benutzerprofil - <?php echo $model->username; ?></h1>

			<div class="create"><a href="<?php echo Yii::app()->createUrl('office/user',array('id'=>$model->id)); ?>">Benutzerprofil aktualisieren</a></div>
			BENUTZPROFIL
       </section>

        <!-- Main content -->
        <section class="content">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'username',
		'profile',
	),
)); ?>

<hr />
<div class="create"><a href="<?php echo Yii::app()->createUrl('office/contact',array('id'=>$model->id)); ?>">Kontaktdaten aktualisieren</a></div>
KONTAKTINFORMATIONEN
<hr />

    <?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model->contact_ob,
	'attributes'=>array(
		'firstname',
		'surname',
        'phone',
        'email',
        'additional_address',
        'country',
        'city',
        'postalcode',
        'house',
        'street',
        'birthdate',
	),
)); ?>


<div style="padding:20px;"></div>
    </section><!-- /.content -->
      </div><!-- /.content-wrapper -->



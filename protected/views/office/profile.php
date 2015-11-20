 <?php $this->renderPartial('_top', array('info'=>$info)); ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
			<h1>Profile information user - <?php echo $model->username; ?></h1>

			<div class="create"><a href="<?php echo Yii::app()->createUrl('office/user',array('id'=>$model->id)); ?>">Update profile information</a></div>
			PROFILE INFORMATION
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
<div class="create"><a href="<?php echo Yii::app()->createUrl('office/contact',array('id'=>$model->id)); ?>">Update profile contact</a></div>
CONTACTS
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



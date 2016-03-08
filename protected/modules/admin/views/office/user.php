 <?php
 Yii::app()->clientScript->registerScriptFile('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js',CClientScript::POS_HEAD);
 $this->renderPartial('_top', array('info'=>$info));
 ?>
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

<?php
$this->breadcrumbs=array(
    'Benutzerprofil'=>array('profile'),
	'Benutzerprofil Aktualisieren',
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
<h1>Benutzerprofil aktualisieren -: <?php echo $model->username; ?> (<?php echo $model->role_ob->groupname; ?> )</h1>



<hr />	

       </section>

        <!-- Main content -->
        <section class="content">
<div class="form">
<?php
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
 )); ?>

	<?php echo $form->errorSummary($model); ?>
 
<?php 
	$this->renderPartial('_form_user',array('model'=>$model,'form'=>$form));
?>
	<div class="row buttons">
 		<div class="col-md-12">
	
       <button class="btn btn-primary" type="submit">Speichern</button>
        <?php if($model->id != Yii::app()->user->id) {?>
            <button class="btn btn-primary cancel"><a href="<?php echo Yii::app()->request->baseUrl; ?>admin"><?php echo 'Abbrechen'; ?></a></button>
        <?php }else{?>
            <button class="btn btn-primary cancel"><a href="<?php echo Yii::app()->request->baseUrl; ?>profile"><?php echo 'Abbrechen'; ?></a></button>
        <?php }?>
    </div>
   </div>
			<?php $this->endWidget(); ?>
   </div>
		</section><!-- /.content -->
      </div><!-- /.content-wrapper -->

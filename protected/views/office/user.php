<?php $this->renderPartial('_top', array('info'=>$info)); ?>
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

<h1>Update user - <?php echo $model->username; ?> (<?php echo $model->role_ob->groupname; ?> )</h1>

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

       </section>

        <!-- Main content -->
        <section class="content">

<?php
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
 )); ?>

	<?php echo $form->errorSummary($model); ?>
 
<?php $this->renderPartial('_form_user',
		array('model'=>$model,'form'=>$form)); ?>
	
	<div class="row buttons">
        <button class="btn btn-primary" type="submit">Speichern</button>
        <?php if($model->id != Yii::app()->user->id) {?>
            <button class="btn btn-primary cancel"><a href="<?php echo Yii::app()->request->baseUrl; ?>admin"><?php echo 'Abbrechen'; ?></a></button>
        <?php }else{?>
            <button class="btn btn-primary cancel"><a href="<?php echo Yii::app()->request->baseUrl; ?>profile"><?php echo 'Abbrechen'; ?></a></button>
        <?php }?>
    </div>
		</section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php 
$this->renderPartial('_top', array('info'=>$info)); ?>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
		<h1>Update guide information -  <?php echo $update_user->username; ?></h1>
     </section>

        <!-- Main content -->
        <section class="content">
            

<div class="create"><a href="<?php echo Yii::app()->createUrl('/segGuidesCities/update',array('id_user'=>$id_user)); ?>">Update citie work</a></div>

<div class="create"><a href="<?php echo Yii::app()->createUrl('/segLanguagesGuides/update',array('id_user'=>$id_user)); ?>">Update language</a></div>

<div class="create"><a href="<?php echo Yii::app()->createUrl('/segGuidesTourroutes/update',array('id_user'=>$id_user)); ?>">Update categorya tour</a></div>

<div class="create">
	<? if ($istourroutes>0) { ?>
		<a href="<?php echo Yii::app()->createUrl('/segGuidesdata/cashinfo',array('id_user'=>$id_user)); ?>">Update cash info</a>
	<? } else { ?>
    	<div class="noactive_link" title="Fill based information on guide">Update cash info</div>
    <? }?>
</div>

<?php $this->renderPartial('_form_gd', array('model'=>$model,'id_user'=>$id_user)); ?>
		</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
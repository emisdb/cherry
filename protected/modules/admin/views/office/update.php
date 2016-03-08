<?php
 Yii::app()->clientScript->registerScriptFile('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js',CClientScript::POS_HEAD);
 $this->renderPartial('_top', array('info'=>$info));
 ?>     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
<h1>Rabattgrund "<?php echo $model->name; ?> <?php echo $model->type; ?>"</h1>
     </section>

        <!-- Main content -->
        <section class="content">
<?php $this->renderPartial('_form_bonus', array('model'=>$model)); ?>
		</section><!-- /.content -->
      </div><!-- /.content-wrapper -->

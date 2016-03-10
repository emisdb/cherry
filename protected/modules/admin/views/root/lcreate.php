 <?php
 Yii::app()->clientScript->registerScriptFile('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js',CClientScript::POS_HEAD);
 $this->renderPartial('_top', array('info'=>$info));
 ?>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
<?php
/* @var $this LanguagesController */
/* @var $model Languages */

$this->breadcrumbs=array(
	'Languages'=>array('admin'),
	'New record languages',
);

?>
 <h1>New record Languages</h1> 
		</section>

        <!-- Main content -->
        <section class="content">



<?php $this->renderPartial('_form_lang', array('model'=>$model)); ?>

    </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
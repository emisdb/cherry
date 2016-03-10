 <?php
 Yii::app()->clientScript->registerScriptFile('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js',CClientScript::POS_HEAD);
 $this->renderPartial('_top', array('info'=>$info));
 ?>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
<?php
$this->breadcrumbs=array(
	'Discount'=>array('badmin'),
	'Update',
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

<h1>Discount "<?php echo $model->name; ?> <?php echo $model->type; ?>"</h1>
		</section>

        <!-- Main content -->
        <section class="content">


<?php $this->renderPartial('_form_bonus', array('model'=>$model)); ?>

    </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
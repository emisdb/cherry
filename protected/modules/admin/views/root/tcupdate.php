 <?php
 Yii::app()->clientScript->registerScriptFile('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js',CClientScript::POS_HEAD);
 $this->renderPartial('_top', array('info'=>$info));
 ?>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
			<?php
/* @var $this SegTourroutesController */
/* @var $model SegTourroutes */

$this->breadcrumbs=array(
	'All Tourroutes'=>array('tadmin'),
	'Update tourroute',
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

<h1>Update Tourroute <?php echo $model->name; ?></h1>
       </section>

        <!-- Main content -->
        <section class="content">
<?php $this->renderPartial('_tform', array('model'=>$model)); ?>

    </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
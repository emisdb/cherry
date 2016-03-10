 <?php
 Yii::app()->clientScript->registerScriptFile('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js',CClientScript::POS_HEAD);
 $this->renderPartial('_top', array('info'=>$info));
 ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
			<?php
/* @var $this SegTourroutesController */
/* @var $model SegTourroutes */

$this->breadcrumbs=array(
	'Tour categories',

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

<h1>Manage Tour Categories</h1>
<!--
<div class="create">
	<?php //   echo CHtml::link('Neuen Tour', array('tcreate')); ?>
</div>
-->
       </section>

        <!-- Main content -->
        <section class="content">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tour-categories-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_tour_categories',
		'name',
/*		array(
			'class'=>'CButtonColumn',
            'template'=>'{update}{delete}',
            'buttons' => array(
               'update' => array(
                    'url' => 'array("tupdate", "id" => $data->idseg_tourroutes)',
                    'label'=>'Update',
               ),
             ),		),
		*/
	),
)); ?>

    </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

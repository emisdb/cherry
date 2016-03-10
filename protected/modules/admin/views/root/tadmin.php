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
	'Tourroutes',
);

?>

<h1>Tourroutes</h1>

<div class="create">
	<?php   echo CHtml::link('Neuen Tour', array('tcreate')); ?>
</div>

       </section>

        <!-- Main content -->
        <section class="content">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'seg-tourroutes-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
	//	'idseg_tourroutes',
        array(
            'name'=>'city',
            'value'=>'$data->city->seg_cityname',
            'filter'=>CHtml::listData(SegCities::model()->findAll(), 'idseg_cities', 'seg_cityname'),
        ),
        array(
            'name'=>'tour_categories',
            'value'=>'$data->tour_categories->name',
            'filter'=>CHtml::listData(TourCategories::model()->findAll(), 'id_tour_categories', 'name'),
        ),
		'name',
        'base_price',
		'standard_duration',
	//	'maintext',
	//	'shorttext',
	//	'TNmin',
	//	'TNmax',
		/*
		'inDevelopment',
		'route_bigpic',
		'route_pic',
		'pic_icon',
		'pdf_path',
		'base_price',
		'standard_duration',
		'cityid',
		*/
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update}{delete}',
            'buttons' => array(
               'update' => array(
                    'url' => 'array("tupdate", "id" => $data->idseg_tourroutes)',
                    'label'=>'Update',
               ),
             ),		),
	),
)); ?>

    </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php $this->renderPartial('_top', array('info'=>$info)); ?>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
			<?php
/* @var $this LanguagesController */
/* @var $model Languages */

$this->breadcrumbs=array(
	//'Seg Cities'=>array('index'),
	'Cities',
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

<h1>Cities</h1>

<div class="create">
	<?php   echo CHtml::link('Neuen Stadt', array('ccreate')); ?>
</div>
      </section>

        <!-- Main content -->
        <section class="content">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'seg-cities-grid',
	'dataProvider'=>$model->search(),
//	'filter'=>$model,
	'columns'=>array(
	//	'idseg_cities',
		'seg_cityname',
		'shortname',
	//	'segway_amount',
		'mailInfo',
	//	'mailBuchungen',
		/*
		'mailBookings',
		'mailVoucher',
		'mailCancellation',
		'mailInfoDisplayName',
		'mailBuchungenDisplayName',
		'mailBookingsDisplayName',
		'mailVoucherDisplayName',
		'mailCancellationDisplayName',
		'webadress',*/
		'localPhone',
	/*	'localStreet',
		'localHouse',
		'localPLZ',
		'mailInfoAccount',
		'mailBuchungenAccount',
		'mailBookingsAccount',
		'mailVoucherAccount',
		'mailCancellationAccount',
		'mailInfoPW',
		'mailBuchungenPW',
		'mailBookingsPW',
		'mailVoucherPW',
		'mailCancellationPW',
		'webadress_en',
		'gmaps_lnk',
		'meetingpoint_description',
		'meetingpoint_description_en',
		'standart_toursize',
		'cashaccount_DTV',
		'tripadvisor_lnk',
		'facebook_lnk',
		'google_analytics_id',
		'google_conversions_id',
		'google_conversions_label',
		'google_analytics_id_booking_de',
		'google_conversions_id_booking_de',
		'google_conversions_label_booking_de',
		'google_analytics_id_booking_en',
		'google_conversions_id_booking_en',
		'google_conversions_label_booking_en',
		*/
			array(
			'class'=>'CButtonColumn',
            'template'=>'{update}{delete}',
            'buttons' => array(
               'update' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'array("cupdate", "id" => $data->idseg_cities)',
//                    'url' => 'Yii::app()->createUrl("/user/update/id/$data->id")',
                    'label'=>'Update',
               ),
               'delete' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'array("delete", "id" => $data->idseg_cities, "type"=>4)',
                    'label'=>'Delete',
               ),
            ),		),
	),
)); ?>
    </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

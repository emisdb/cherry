<?php
/* @var $this SegScheduledToursController */
/* @var $dataProvider CActiveDataProvider */
 ?>
<div class="row">
	<?php echo "Date".date('Y-m-d',strtotime($model->date)) ?>
	<?php  var_dump($model);?>
</div>

<div class="row">
	<div class="col-md-3">
    <?php       $this->renderPartial('_select', array('model'=>$model)) ;?>
	</div>
	<div class="col-md-9">
<?php

$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$model->search_f(),
	'itemView'=>'_view',
));
?>		
	</div>
</div>
	




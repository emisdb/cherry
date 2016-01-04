<?php
/* @var $this SegScheduledToursController */
/* @var $dataProvider CActiveDataProvider */
 ?>

<?php

$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$model->search_f(),
	'itemView'=>'_view',
)); ?>

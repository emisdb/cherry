<?php
/* @var $this SegScheduledToursController */
/* @var $dataProvider CActiveDataProvider */
 ?>
<div class="row">
	<?php echo "Date".date('Y-m-d',strtotime($model->date)) ?>
	<?php  
//					   $criteria=new CDbCriteria;
//			   $criteria->select='id';
//			   $criteria->condition='id_guide>0';
//			  $criteria->with=array('contact_ob'=>array('select'=>new CDbExpression( 'firstname, surname')));
//			  $gui=User::model()->with('contact_ob')->findAll($criteria);
//			  $arr=Array();
//			  foreach($gui as $val) $arr[$val['id']]=$val['contact_ob']['firstname']." ".$val['contact_ob']['surname'];
//			$guides=CHtml::listData ($gui,'id','contact_ob.fullname');
//			$guides=CHtml::listData (User::model()->findAll($criteria),'id', 'seg_contacts.firstname');
//			$guides=User::model()->findAll($criteria);
		$gui=new User('search_gn');
		var_dump(CHtml::listData($gui->search_gn(),'id','guidename'));
		?>
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
	




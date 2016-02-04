<?php $this->renderPartial('_top', array('info'=>$info)); ?>
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
<?php
/* @var $this SegScheduledToursController */
/* @var $model SegScheduledTours */

$this->breadcrumbs=array(
	'Show Tour',
);

?>
<?php  $date_format =  date('d.m.Y',$model->date_now);?>


<h1>
	Show Tour - <?php echo $model->idseg_scheduled_tours;?>
			- <?php echo $date_format;?>
			- <?php echo date( 'H:i', strtotime($model->starttime) );?> 
			- <?php if(isset($model->tourroute_ob)) echo $model->tourroute_ob->name;?>
			- <?php echo $model->city_id_all;?>
			- <?php if(isset($model->language_ob)) echo $model->language_ob->englishname;?>
			- <?php echo "".$model->current_subscribers."(".$model->TNmax_sched.")";?>
</h1>
       </section>

        <!-- Main content -->
        <section class="content">
			<div class="table-responsive" >
				<table	class="table table-bordered">
					<thead>
						<tr class="info">
							<th>
								Name
							</th>
							<th>
								Last Name
							</th>
							<th>
								N of guests
							</th>
							<th>
								Phone
							</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($model->guidestourinvoices as $value) {
							echo "<tr><td>".$value->contact->firstname."</td>";
							echo "<td>".$value->contact->surname."</td>";
							echo "<td>".$value->countCustomers."</td>";
							echo "<td>".  CHtml::link($value->contact->phone, "tel:".$value->contact->phone)."</td></tr>";
						}
						?>
					</tbody>
				</table>
			</div>


<!--<button class="btn btn-primary cancel" > <a href="<php echo Yii::app()->createUrl('segScheduledTours/weeks', array('date'=>$date_format));?>">Back</a></button>-->
<a href="<?php echo Yii::app()->request->baseUrl; ?>/guide/weeks/date/<?php echo $date_format;?>">
	<button class="btn btn-primary cancel" > Back</button></a>
 
	
     </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
  
<style>
	table.shorttable{ background:#eeeeee; border: groove medium; }
        table.shorttable>thead>tr>td {background:#777; color:#fff;font-weight: bold;font-size: 1.2em;}
        table.shorttable>tbody>tr>td {background:#9af; padding:2px; color:#fff;}
        table.shorttable>tbody>tr>td.daterow {background:#979797; padding:3px; color:#fff; font-size: 1.2em;}
</style> <?php $this->renderPartial('_top', array('info'=>$info)); ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
       <section class="content-header">

<h1>Week Schedule</h1>	
       </section>


        <!-- Main content -->
        <section class="content">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'date-form',
            'htmlOptions'=>array(
                'name'=>'date-form',
            ),
            'enableAjaxValidation'=>true,
        )); ?>	
		<div class="create" style="text-align: left;">Timetable for the city of 
		<?php
		echo $form->dropDownList($model,'city_id', CHtml::listData (SegCities::model()->findAll(), 'idseg_cities', 'seg_cityname'),array("style"=>"margin:0 5px;"));
//		echo CHtml::link("show","javascript:void(0);",array('onclick'=>'newtourist();','style'=>'background-color:##FFE495;'));
	echo $form->labelEx($model,'from_date',array('style'=>'margin-right:5px;')); 
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
  				  'name'=>'SegScheduledTours[from_date]',
				  'attribute'=>'from_date', // Model attribute filed which hold user input
				  'model'=>$model,            // Model name
					'language'=>'de',
					'options'=>array(
					  'showAnim'=>'fold',
					  'dateFormat'=>'yy-mm-dd',
						 ),
					'htmlOptions'=>array(
						'class'=>'form-control-date-filter',
 					),				
));
?>				

				<?php echo CHtml::submitButton('Suchen',array('class'=>'btn btn-primary cancel')); // submit button ?> 
			</div>
 <?php $this->endWidget(); ?>	
            <div class="panel panel-default">
                 <div class="panel-heading">
                     
                      <?php echo "The timetable for ".$model->from_date." - ".$model->to_date." in ".$model->cityname; ?>
                 </div>
                 <div class="panel-body">
                      <?php 
                        $arr=array();
                        $data=$model->search();
                        echo "Total scheduled tours:".$data->getTotalItemCount();
                        foreach ($data->getData() as $value) {
                        $arr[$value->guidename][]=array($value->date,$value->starttime,$value->original_starttime);
                         
                     }
                     ?>
                     <table class='table shorttable' >
                        <thead>
                    <tr>
                    <td>Zeitintervall</td>
                    <?php foreach($arr as $key => $value){ echo "<td>".$key."</td>";} ?>
                     </tr>
                        </thead>
                        <tbody>
                         <?php
                   $start_times_tour =SegStarttimes::model()->findAll(); 
                   $carr=count($arr);

                    $dt =date_create($model->from_date);
                    $interval=new DateInterval( "P1D" );

                    for($inx=0;$inx<7;$inx++){

                        $date_format=date_timestamp_get($dt);
                        $curdate=Yii::app()->dateFormatter->format('EEEE, dd-MMMM-yyyy',$date_format);	
                        date_add($dt,$interval);
                        echo "<tr><td class='daterow' colspan='".($carr+1)."'>".$curdate."</td></tr>";
                              foreach($start_times_tour as $item){
                               echo "<tr><td>".Yii::app()->dateFormatter->format('HH:mm',strtotime($item->timevalue))."</td>";
                               foreach($arr as $value){
                                   echo "<td>";
                                        foreach($value as $val){ 
                                            if((strtotime($val[0])==$date_format)&&($val[2]==$item->timevalue))
                                            {
                                                echo Yii::app()->dateFormatter->format('HH:mm',strtotime($val[1]));
                                                break;
                                            }
                                        }
                                  echo "</td>";
                               
                               }
                               echo "</tr>";
                                   
                              }

                    }      
                    ?>
                        </tbody>
                      </table>
                     </ol>
                </div>
               </div>


		</section><!-- /.content -->
      </div><!-- /.content-wrapper -->

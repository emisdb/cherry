<?php $this->renderPartial('_top', array('info'=>$info));

?>
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
		 <div class="modal modal-info fade" id="guideModal" role="dialog">
		   <div class="modal-dialog modal-md">
			 <div class="modal-content">
			   <div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal" aria-label="close">
					 <span aria-hidden="true">&times;</span></button>
				 <h4 class="modal-title">Zeige Tour</h4>
			   </div>
			   <div class="modal-body">
				 <div id="modal-data">This is the guide's info.</div>
			   </div>
			   <div class="modal-footer">
					<button  type="button" class="btn btn-outline pull-right btn-default" data-dismiss="modal">Close</button>
			   </div>
			 </div>
		   </div>
		 </div>
	  <section class="content-header">
		  <?php 
		  if($err)
		  {
			  echo '<div class="alert alert-danger">';
			  echo '<strong>Error!</strong> Tour on '.$err." is taken.";
			  echo '</div>';
		  }
		  
		  ?>
		<h1>Spontane Tourabrechnung für <?php echo $city->cities->seg_cityname ?> </h1>
			<ol class="breadcrumb">
				<li class="active">Spontane Tourabrechnung</li>
			</ol>	

       </section>
        <section class="content">

		<div class="row">	
			<div class="col-md-2">
                    <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                            'name'=>'publishDate',
 								'value'=>$date, 
							'language'=>'de',
                            // additional javascript options for the date picker plugin
                            'options'=>array(
                               'showAnim'=>'fold',
                                'dateFormat' => 'dd.mm.yy',
                                 'yearRange'=>'2015:2050',
                                 'minDate' => 0,//'01.06.2015',//0, 
                                 'defaultDate'=> time(),     
                                 //'maxDate' => '2099-12-31',  
//                                 'onSelect'=> 'js: function(date) {if(date != "") { 
//                                    window.location.href = "'.CHtml::encode($this->createUrl('guide/weeks'
//                                    )).'/date/"+date ;
//                                 } }',
                            ),
                            'htmlOptions'=>array(
                                 	'size' => '10',         // textField size
        							'maxlength' => '10', 
                            ),
                            'flat'=>false,
                        )); 
                    ?>
                    </div>


        <!-- Main content -->

	<div class="col-md-2">
<?php 
	$this->widget('ext.clockpick.EClockpick', array(
//         'model'            => $model,
         'name'        =>'timepick',
		 'value'=>'08:00',
         'options'          =>array(
     'starthour'=>8,
                'endhour'=>19,
                'event'=>'click',
                'showminutes'=>true,
                'minutedivisions'=>6,
                'military' =>true,
                'layout'=>'vertical',
                'hoursopacity'=>1,
                'minutesopacity'=>1,
				),
				'htmlOptions' => array('size'=>10,
					'maxlength'=>10, 
			 )
    ));
	?> 
	</div>
		<div class="col-md-8">
 <?php
 echo CHtml::link("Eintragen","#",array('onclick'=>'goclick()'));
?>		
						</div>
						</div>
   </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  <script type="text/javascript">
function goclick(){
	var ptime=jQuery("#timepick").val();
	var pdate=jQuery("#publishDate").val();
	var link= "<?php echo $this->createUrl('guide/take',array("spont"=>1)); ?>&time="+escape(ptime)+"&date="+escape(pdate);   
	window.location =link;
	return true;
	}
</script>
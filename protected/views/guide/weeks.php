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
		<h1>Zeitplan für <?php echo $city->cities->seg_cityname ?> </h1>
			<ol class="breadcrumb">
				<li class="active">Zeitplan</li>
			</ol>	
	                    <div style=" width:100px;">
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
                                 'onSelect'=> 'js: function(date) {if(date != "") { 
                                    window.location.href = "'.CHtml::encode($this->createUrl('guide/weeks'
                                    )).'/date/"+date ;
                                 } }',
                            ),
                            'htmlOptions'=>array(
                                 	'size' => '10',         // textField size
        							'maxlength' => '10', 
                            ),
                            'flat'=>false,
                        )); 
                    ?>
                    </div>

       </section>

        <!-- Main content -->
        <section class="content">
  <div class="panel-group" id="accordion">

<?php
						
//for ($index = 0; $index < 7; $index++) {
foreach($model as $item) {
		echo '<div class="panel panel-default">';
		echo '<div class="panel-heading"><h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$index.'">'.$item['label'].'</a>
        </h4></div>';
		echo '<div id="collapse'.$index.'" class="panel-collapse collapse';
		if($index==0) echo ' in';
		echo '">';
		echo '<div class="panel-body">';
		$this->renderPartial('_weeks', array('model'=>$item['day']));
		echo '</div>';
		echo "</div>\n";
		echo "</div>\n";
		$index++;
								}
								?> 
  </div> 

   </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

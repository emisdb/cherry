<?php $this->renderPartial('_top', array('info'=>$info)); ?>
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
		<!-- Modal -->
		 <div class="modal modal-info fade" id="guideModal" role="dialog">
		   <div class="modal-dialog modal-md">
			 <div class="modal-content">
			   <div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal" aria-label="close">
					 <span aria-hidden="true">&times;</span></button>
				 <h4 class="modal-title">Guides info</h4>
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

       <!-- Content Header (Page header) -->
        <section class="content-header">
			<h1>Current Subscriber</h1>
			<ol class="breadcrumb">
				<li>
					<?php echo Chtml::link('Scheduled Tours',array('guide/schedule')); ?>
				</li>
				<li class="active"> Current Subscriber
				</li>
			</ol>	
			<button id="changebt" type="button" class="btn btn-primary cancel" data-toggle="modal" data-target="#guideModal">Guide's info</button>

		</section>

        <!-- Main content -->
        <section class="content">


		<!-- param -->
			<div class="row">
			<div class="col-md-8">
			<div class="row create">
			<div class="col-md-4 create-left">

				<?php
				$i=0; 
				if (count($sched->bookings)>0) $id_c = $sched->bookings[0]->contact->idcontacts;
				else $id_c=0;
				 echo $sched->tourroute_ob['name']." "
						 .$sched['date']." "
						 .$sched['starttime'];
				 $element = 0; $k=0;$i=1;
				 ?>
			</div>
			<div class="col-md-4">
				<?php echo CHtml::link("New tourist","javascript:void(0);",array('onclick'=>'newtourist();')); ?>
			</div>	
		<div class="col-md-4">
		</div>
		</div>
		<div style="display:none;" id="count"><?php echo count($sched);?></div>
		<div style="display:none;" id="vat_nds"><?php echo $vat_nds;?></div>
		<div class="row">
		<div class="col-md-8">

		<div class="form">
	
		<?php 
//						 print_r(ResourceBundle::getLocales(''));
		?>
</div>
</div><!-- form -->
</div>	
     </section><!-- /.content -->
      </div><!-- /.content-wrapper -->



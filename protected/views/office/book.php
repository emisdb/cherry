<?php $this->renderPartial('_top', array('info'=>$info)); ?>
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
       <section class="content-header">
			<h1>Buchen das Tour</h1>
				<?php 		
/*				<div class="book-back t-text-tour">
	
				echo CHtml::link("Back",array('current','id_sched'=>$scheduled->idseg_scheduled_tours));
			
				</div>
*/				?>
			<ol class="breadcrumb">
				<li>
					<?php echo Chtml::link('Tourplan',array('schedule')); ?>
				</li>
				<li>
					<?php 
					echo CHtml::link("Rechnung #".$scheduled->idseg_scheduled_tours,array('current','id_sched'=>$scheduled->idseg_scheduled_tours));
					?>
				</li>
				<li class="active">Buchen das Tour	</li>
			</ol>	

		</section>
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'book-form-i',
			'enableAjaxValidation'=>false,
		)); ?>
		<?php
			if($form->errorSummary($contact)!=''){ 
			echo '<div class="book-guide" style="margin-bottom:20px;color:red;padding:20px;">'; 
			 echo $form->errorSummary($contact); 
			echo "</div>\n";
		 } 
		 ?>
		<div  class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
                      <label>Stadt</label>
                      <input type="text" class="form-control" value="<?php echo $scheduled->city_ob->seg_cityname; ?>" disabled="">
                    </div>					
				</div>
				<div class="col-md-4">
					<div class="form-group">
                      <label>Tour:</label>
						<?php if($scheduled->tourroute_id==null)
							{
							   $list = CHtml::listData($tours_guide, 'idseg_tourroutes','name');
							   echo '<div style="display:none;">';
							   foreach($tours_guide as $item){
									   echo '<div id="t'.$item->idseg_tourroutes.'">'.$item->base_price.'</div>';
									   echo '<div id="m'.$item->idseg_tourroutes.'">'.$item->TNmax.'</div>'; 
							   }
							   echo '</div>';
							   echo $form->dropDownList($contact,'tour',$list, array('id'=>'tour_area', 'class'=>'form-control select2',  'onChange'=>'clickTour(this.value)'));
							echo '<div style="display:none;" id="tour_set">0</div>';
					   }
					   else {
						   echo '<input type="text" class="form-control" value="'.$scheduled->tourroute_ob->name.'" disabled="">';
						  echo $form->hiddenField($contact,'tour',array('class'=>"form-control"));
						   echo '<div style="display:none;" id="tour_area">'.$scheduled->tourroute_id.'</div>';
						   echo '<div style="display:none;" id="tour_set">1</div>';
						 }
						 ?>
             
                    </div>					
				</div>
				<div class="col-md-4">
					<div class="t-evro-tour" style="width:110px;border-top: 1px dotted #a7a7a7;border-left:1px dotted #a7a7a7;border-right:1px dotted #a7a7a7;">
						<div id="price" style="display:none;"><?php echo (isset($tour)) ? $tour->base_price : $tours_guide[0]->base_price; ?></div>
						<div id="new_price" style="float:left;padding-left:20px;">
							<?php echo (isset($tour)) ? $tour->base_price : $tours_guide[0]->base_price;?>
						</div>    
						<div style="float:left;padding-left:10px;">
							<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/str2/evro.png" />
						</div>
						<div style="clear:both;"></div>
					</div>
					<div class="t-vat-tour" style="padding-bottom:10px;width:110px;border-bottom: 1px dotted #a7a7a7;border-left:1px dotted #a7a7a7;border-right:1px dotted #a7a7a7;">inkl. MwSt.</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
                      <label>Datum</label>
                      <input type="text" class="form-control" value="<?php echo date('d/m/Y',$scheduled->date_now); ?>" disabled="">
                    </div>					
				</div>
				<div class="col-md-4">
					<div class="form-group">
                      <label>Zeit</label>
                      <input type="text" class="form-control" value="<?php echo substr_replace($scheduled->starttime, 0, 4); ?>" disabled="">
                    </div>					
				</div>
				<div class="col-md-4">
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
                      <label>Sprache</label>
							<?php
							 if($scheduled->language_id==null)
								 {	
									 $list_l = CHtml::listData($languages_guide, 'id_languages', 'englishname');
									 echo $form->dropDownList($contact,'language',$list_l, array('class'=>'form-control select2'));
								 }
								 else 
								 {
								   echo '<input type="text" class="form-control" value="'.$scheduled->language_ob->englishname.'" disabled="">';
									echo $form->hiddenField($contact,'language');
								 }
							 ?>
					</div>					
				</div>
				<div class="col-md-4">
					<div class="form-group">
                                    <label>Gäste</label>
						<div style="display:none;" id="ntiket"><?php echo (isset($tour)) ? $tour->TNmax : "";?></div>
						<div style="display:none;" id="ncat"><?php echo  (isset($tour)) ? $tour->id_tour_categories : "";?></div>
						<div style="display:none;"><!-- param cat for all-->
						  <?php 
							  foreach($tours_guide as $item) { 
							  echo '<div id="cat'.$item->idseg_tourroutes.'">'.$item->id_tour_categories.'</div>';
							  echo '<div id="base_price'.$item->idseg_tourroutes,'">'.$item->base_price.'</div>';
						   } 
						   ?>
						</div>
						<div style="display:none;" id="now_tiket"></div> <!-- begin list tiket categories -->


						<?php
                                                echo $form->textField($contact,'tickets',array('class'=>"form-control", 'id'=>'tickets', 'value'=>'1','onChange'=>'clickTickets(this.value)'));
                                               /*
                                                for($i=1;$i<4;$i++)
						{ 
						  $list_k=array();
						  foreach($tours_guide as $item) { 
							  if($item->id_tour_categories == $i)
							  {
								  $primer = $item->TNmax - $scheduled->current_subscribers;
								  echo '<div style="display:none;" id="ntiket'.$item->idseg_tourroutes.'">'.$primer.'</div>';
								  for($pi=0;$pi<$primer;$pi++)
								  {  $list_k[$pi+1] = $pi+1; }
								  $pi=0;
							  }	 
							  }
							  echo $form->dropDownList($contact,'tickets'.$i ,$list_k,  array('style'=>'display:none;', 'id'=>'area'.$i, 'onChange'=>'clickTickets(this.value)', 'class'=>"form-control select2"));
						  } 
						   echo $form->hiddenField($contact,'cat_hidden', array('id'=>'cathidden','value'=>0)); 
*/						   ?>
						  </div>					
				</div>
				<div class="col-md-4">
				</div>
			</div>
		</div>
   	<div  class="container" >
		<div class="row" style="margin-top:30px;">
		<div class="book-contact-name col-md-12">
			Ihre Kontaktdaten
		</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
				  <label>Vorname</label>
				  <?php echo $form->textField($contact,'firstname',array('class'=>"form-control")); ?>
				</div>					
			</div>
			<div class="col-md-4">
				<div class="form-group">
				  <label>Nachname</label>
				  <?php echo $form->textField($contact,'lastname',array('class'=>"form-control")); ?>
				</div>					
			</div>
			<div class="col-md-4">
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
				  <label>Strasse, Hausnummer</label>
				  <?php echo $form->textField($contact,'street',array('class'=>"form-control")); ?>
				</div>					
			</div>
			<div class="col-md-4">
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
				  <label>Firma</label>
				  <?php echo $form->textField($contact,'additional_address',array('class'=>"form-control")); ?>
				</div>					
			</div>
			<div class="col-md-4">
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
				  <label>Postleitzahl</label>
				  <?php echo $form->textField($contact,'postalcode',array('class'=>"form-control")); ?>
				</div>					
			</div>
			<div class="col-md-5">
				<div class="form-group">
				  <label>Stadt</label>
				  <?php echo $form->textField($contact,'city',array('class'=>"form-control")); ?>
				</div>					
			</div>
			<div class="col-md-4">
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
				  <label>Land</label>
				  <?php echo $form->textField($contact,'country',array('class'=>"form-control")); ?>
				</div>					
			</div>
			<div class="col-md-4">
			</div>
		</div>
   		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
				  <label>Email</label>
				  <?php echo $form->textField($contact,'email',array('class'=>"form-control")); ?>
				</div>					
			</div>
			<div class="col-md-4">
			</div>
		</div>
  		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
				  <label>Handynummer</label>
				  <?php echo $form->textField($contact,'phone',array('class'=>"form-control")); ?>
				</div>					
			</div>
			<div class="col-md-4">
			</div>
		</div>


	<button class="but-book" type="submit"><?php echo 'Jetzt Buchen'; ?></button>
	<?php $this->endWidget(); ?>   
	</div>
	  </div>
 

<script type="text/javascript">
	window.onload = function () {
		var ncat = document.getElementById('ncat').innerHTML;
//		document.getElementById('area'+ncat).style.display="block";
		document.getElementById('now_tiket').innerHTML=ncat;
	
//		document.getElementById('cathidden').value = ncat;
  		var price_base = document.getElementById('new_price').innerHTML;
		var c = document.getElementById('tickets').value*price_base;
//		var c = document.getElementById('area'+ncat).value*price_base;
		document.getElementById('new_price').innerHTML=c;
  	}
	function clickTickets(id){
		var element=0;
                var settype = parseInt(document.getElementById('tour_set').innerHTML) ;
		if(settype==0)    element = document.getElementById('tour_area').value ;
		else element = document.getElementById('tour_area').innerHTML;
        var base_price = document.getElementById('base_price'+element).innerHTML;
        var new_price = base_price*id;
		document.getElementById('new_price').innerHTML=new_price;
	}
	function clickTour(id){
		//list tiket
//		var newcat = document.getElementById('cat'+parseInt(id)).innerHTML;
//		document.getElementById('area'+parseInt(newcat)).style.display="block";
//		var oldcat = document.getElementById('now_tiket').innerHTML;
//		document.getElementById('now_tiket').innerHTML=newcat;
//		document.getElementById('cathidden').value = newcat;
//		if(oldcat){
//			document.getElementById('area'+parseInt(oldcat)).style.display="none";
//		}
        var base_price = document.getElementById('base_price'+id).innerHTML;
//        var number_ticket = document.getElementById('area'+parseInt(newcat)).value;
       var number_ticket = document.getElementById('tickets').value;
		var new_price = base_price*number_ticket;
		document.getElementById('new_price').innerHTML=new_price;
 	}
</script> 
<?php $this->renderPartial('_top', array('info'=>$info)); ?>
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
       <section class="content-header">
			<h1>Book the tour</h1>
	
			<div class="book-back t-text-tour">
				<?php 
				echo CHtml::link("Back",array('current','id_sched'=>$scheduled->idseg_scheduled_tours));
				?>
			</div>
			<ol class="breadcrumb">
				<li>
					<?php echo Chtml::link('Scheduled Tours',array('guide/schedule')); ?>
				</li>
				<li>
					<?php 
					echo CHtml::link("Tour #".$scheduled->idseg_scheduled_tours,array('current','id_sched'=>$scheduled->idseg_scheduled_tours));
					?>
				</li>
				<li class="active"> Book the tour
				</li>
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
                      <label>City</label>
                      <input type="text" class="form-control" value="<?php echo $scheduled->city_ob->seg_cityname; ?>" disabled="">
                    </div>					
				</div>
				<div class="col-md-4">
					<div class="form-group">
                      <label>Tour</label>
						<?php if($scheduled->tourroute_id==null)
							{
							   $list = CHtml::listData($tours_guide, 'idseg_tourroutes','name');
							   echo '<div style="display:none;">';
							   foreach($tours_guide as $item){
									   echo '<div id="t'.$item->idseg_tourroutes.'">'.$item->base_price.'</div>';
									   echo '<div id="m'.$item->idseg_tourroutes.'">'.$item->TNmax.'</div>'; 
							   }
							   echo '</div>';
							   echo $form->dropDownList($contact,'tour',$list, array('id'=>'tour_area', 'options' => array($cat_item=>array('selected'=>true)), 'onChange'=>'clickTour(this.value)'));
					   }
					   else {
						   echo '<input type="text" class="form-control" value="'.$scheduled->tourroute_ob->name.'" disabled="">';
						 }
						 ?>
             
                    </div>					
				</div>
				<div class="col-md-4">
					<div class="t-evro-tour" style="width:95px;border-top: 1px dotted #a7a7a7;border-left:1px dotted #a7a7a7;border-right:1px dotted #a7a7a7;">
						<div id="price" style="display:none;"><?php echo $tour->base_price;?></div>
						<div id="new_price" style="float:left;padding-left:20px;">
							<?php echo $tour->base_price;?>
						</div>    
						<div style="float:left;padding-left:10px;">
							<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/str2/evro.png" />
						</div>
						<div style="clear:both;"></div>
					</div>
					<div class="t-vat-tour" style="padding-bottom:10px;width:95px;border-bottom: 1px dotted #a7a7a7;border-left:1px dotted #a7a7a7;border-right:1px dotted #a7a7a7;">Incl.VAT</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
                      <label>Date</label>
                      <input type="text" class="form-control" value="<?php echo date('d/m/Y',$scheduled->date_now); ?>" disabled="">
                    </div>					
				</div>
				<div class="col-md-4">
					<div class="form-group">
                      <label>Time</label>
                      <input type="text" class="form-control" value="<?php echo substr_replace($scheduled->starttime, 0, 4); ?>" disabled="">
                    </div>					
				</div>
				<div class="col-md-4">
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
                      <label>Language</label>
							<?php
							 if($scheduled->language_id==null)
								 {	
									 echo '<div class="book-select">';
									 $list_l = CHtml::listData($languages_guide, 'id_languages', 'englishname');
									 echo $form->dropDownList($contact,'language',$list_l);
									 echo '</div>';
								 }
								 else 
								 {
								   echo '<input type="text" class="form-control" value="'.$scheduled->language_ob->englishname.'" disabled="">';
								 }
							 ?>
					</div>					
				</div>
				<div class="col-md-4">
					<div class="form-group">
                      <label>Tickets</label>
 				  <div style="display:none;" id="ntiket"><?php echo $tour->TNmax;?></div>
                  <div style="display:none;" id="ncat"><?php echo $tour->id_tour_categories;?></div>
                  <div style="display:none;"><!-- param cat for all-->
                  	<?php 
						foreach($tours_guide as $item) { 
                    	echo '<div id="cat'.$item->idseg_tourroutes.'">'.$item->id_tour_categories.'</div>';
                        echo '<div id="base_price'.$item->idseg_tourroutes,'">'.$item->base_price.'</div>';
                     } 
					 ?>
                  </div>
                  <div style="display:none;" id="now_tiket"></div> <!-- begin list tiket categories -->
                  
                  
                  <?php for($i=1;$i<4;$i++)
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
					 ?>
                    </div>					
				</div>
				<div class="col-md-4">
				</div>
			</div>
		</div>
   	<div  class="container">

	<div class="book-contact">
		<div class="book-contact-name">
			Booking Form
		</div>
		<div class="book-form">
			<div class="book_form-item">
				<div class="book-f">First name</div>
				<div class="book-field"><?php echo $form->textField($contact,'firstname'); ?>
           <!-- <php echo $form->error($contact,'firstname'); ?>-->
            
            </div>
            
             <div style="clear: both;"></div>
        </div>
        <div class="book_form-item">
            <div class="book-f">Last name</div>
            <div class="book-field"><?php echo $form->textField($contact,'lastname'); ?></div>
             <div style="clear: both;"></div>
        </div>
        <div class="book_form-item">
            <div class="book-f">Address</div>
            <div class="book-field"><?php echo $form->textArea($contact,'address'); ?></div>
             <div style="clear: both;"></div>
        </div>
        <div class="book_form-item">
            <div class="book-f">City</div>
            <div class="book-field"><?php echo $form->textField($contact,'city'); ?></div>
             <div style="clear: both;"></div>
        </div>
        <div class="book_form-item">
            <div class="book-f">Country</div>
            <div class="book-field"><?php echo $form->textField($contact,'country'); ?></div>
             <div style="clear: both;"></div>
        </div>
        <div class="book_form-item">
            <div class="book-f">Phone</div>
            <div class="book-field"><?php echo $form->textField($contact,'phone'); ?></div>
             <div style="clear: both;"></div>
        </div>
        <div class="book_form-item">
            <div class="book-f">E-mail</div>
            <div class="book-field"><?php echo $form->textField($contact,'email'); ?></div>
             <div style="clear: both;"></div>
        </div>
    </div>
    <div style="clear: both;"></div>
</div>
<button class="but-book" type="submit"><?php echo 'BOOK'; ?></button>
<?php $this->endWidget(); ?>   
</div>
	  </div>
 

<script type="text/javascript">
	window.onload = function () {
		//list tiket
		var ncat = document.getElementById('ncat').innerHTML;
		//alert(ncat);
		document.getElementById('area'+ncat).style.display="block";
		document.getElementById('now_tiket').innerHTML=ncat;
	
		document.getElementById('cathidden').value = ncat;
			//alert(document.getElementById('cathidden').value);
		//price
  		var price_base = document.getElementById('new_price').innerHTML;
		var c = document.getElementById('area'+ncat).value*price_base;
		document.getElementById('new_price').innerHTML=c;
  	}
	function clickTickets(id){
        var element = document.getElementById('tour_area').value ;
		//  alert(element);
        var base_price = document.getElementById('base_price'+element).innerHTML;
		//alert(base_price);
		
        var new_price = base_price*id;
		document.getElementById('new_price').innerHTML=new_price;
	}
	function clickTour(id){
		//list tiket
		var newcat = document.getElementById('cat'+parseFloat(id)).innerHTML;
		document.getElementById('area'+parseFloat(newcat)).style.display="block";
		var oldcat = document.getElementById('now_tiket').innerHTML;
		document.getElementById('area'+parseFloat(oldcat)).style.display="none";
		document.getElementById('now_tiket').innerHTML=newcat;
		document.getElementById('cathidden').value = newcat;
		//price		
        var base_price = document.getElementById('base_price'+id).innerHTML;
        var number_ticket = document.getElementById('area'+parseFloat(newcat)).value;
		var new_price = base_price*number_ticket;
		document.getElementById('new_price').innerHTML=new_price;
 	}
</script> 
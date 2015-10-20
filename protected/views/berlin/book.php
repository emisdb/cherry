

<div class="book-back t-text-tour"><a href="<?php echo Yii::app()->request->baseUrl; ?>/berlin">< Back</a></div>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'book-form-i',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<?php if($form->errorSummary($contact)!=''){ ?>
<div class="book-guide" style="margin-bottom:20px;color:red;padding:20px;"> 
	<?php echo $form->errorSummary($contact); ?>
</div>
<?php } ?>
<div class="book-guide">
     
    <div class="book-foto">
        <div class="book-guide-foto"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/guide/<?php echo $scheduled->user_ob->guide_ob->lnk_to_picture;?>" style="height:100px; width:100px;"></div>
        <div class="book-guide-name t-guide-name"><? echo $scheduled->user_ob->contact_ob->firstname;?></div>
    </div>

    <div class="book-col1">
        <div class="book-input">
            <div class="book-f">City</div>
       	    <div class="book-cdt"><? echo $scheduled->city_ob->seg_cityname; ?></div>
            <?php echo $form->hiddenField($contact,'city_ex',array('value'=>$scheduled->city_ob->seg_cityname)); ?>
            <div style="clear: both;"></div>
        </div>
        <div class="book-input">
             <div class="book-f">Date</div>
       	    <div class="book-cdt"><? echo date('d/m/Y',$scheduled->date_now); ?></div>
            <?php echo $form->hiddenField($contact,'date_ex',array('value'=>$scheduled->date_now)); ?>
            <div style="clear: both;"></div>
        </div>
        <div class="book-input">
             <div class="book-f">Time</div>
              <? $time_format = substr_replace($scheduled->starttime, 0, 4);?>
       	    <div class="book-cdt"><? echo $time_format; ?></div>
            <?php echo $form->hiddenField($contact,'time_ex',array('value'=>$scheduled->starttime)); ?>
            <div style="clear: both;"></div>
        </div>
    </div>

    <div class="book-col2">
        <div class="book-input">
            <div class="book-f">Tour</div>
            
             
            
			 <? if($scheduled->tourroute_id==null){?>
                 <div class="book-select">
                  <?php $list = CHtml::listData($tours_guide, 'idseg_tourroutes','name'); ?>
                   <div style="display:none;">
                        <? foreach($tours_guide as $item){?>
                            <div id="t<? echo $item->idseg_tourroutes;?>"> <? echo $item->base_price;?></div>
                            <div id="m<? echo $item->idseg_tourroutes;?>"> <? echo $item->TNmax;?></div> 
                        
                        <? } ?>
                   </div>
                
                  
                  <?php echo $form->dropDownList($contact,'tour',$list, array('id'=>'tour_area', 'options' => array($cat_item=>array('selected'=>true)), 'onChange'=>'clickTour(this.value)')); ?>
                 </div>
             <? } else {?>
                <div class="book-cdt" ><? echo $scheduled->tourroute_ob->name; ?></div>
                <?php echo $form->hiddenField($contact,'tour',array('id'=>'tour_area','value'=>$scheduled->tourroute_ob->idseg_tourroutes)); ?>
             <? }?>
             
             <div style="clear: both;"></div>
        </div>
        <div class="book-input">
            <div class="book-f">Language</div>
            <? if($scheduled->language_id==null){?>	
                <div class="book-select">
                      <?php $list_l = CHtml::listData($languages_guide, 'id_languages', 'englishname'); ?>
                      <?php echo $form->dropDownList($contact,'language',$list_l); ?>
                </div>
            <? } else {?>
            	<div class="book-cdt"><? echo $scheduled->language_ob->englishname; ?></div>
                <?php echo $form->hiddenField($contact,'language',array('value'=>$scheduled->language_ob->id_languages)); ?>
            <? }?>
            <div style="clear: both;"></div>
        </div>
        <div class="book-input">
            <div class="book-f">Tickets</div>
       	    <div class="book-select">
                  <!--   < $primer = 5;
                    $list_k=array();?>
                    < for($pi=0;$pi<$primer+1;$pi++){ ?>
                        < $list_k[$pi+1] = $pi+1;?>
                    < } ?>
            
                  <php $list_k1 = array('1'=>1,'2'=>2,'3'=>3,'4'=>4,'5'=>5,'6'=>6,'7'=>7,'8'=>8,'9'=>9,'10'=>10); ?>
		          <php echo $form->dropDownList($contact,'tickets',$list_k, array('id'=>'area', 'onChange'=>'clickTickets(this.value)')); ?>
            
                  -->
				  <div style="display:none;" id="ntiket"><? echo $tour->TNmax;?></div>
                  <div style="display:none;" id="ncat"><? echo $tour->id_tour_categories;?></div>
                  <div style="display:none;"><!-- param cat for all-->
                  	<? foreach($tours_guide as $item) { ?>
                    	<div id="cat<? echo $item->idseg_tourroutes;?>"><? echo $item->id_tour_categories;?></div>
                        <div id="base_price<? echo $item->idseg_tourroutes;?>"><? echo $item->base_price;?></div>
                    <? } ?>
                  </div>
                  <div style="display:none;" id="now_tiket"></div> <!-- begin list tiket categories -->
                  
                  
                  <? for($i=1;$i<4;$i++){ ?>
					  <? $list_k=array();?>
					  <? foreach($tours_guide as $item) { ?>
							<? if($item->id_tour_categories == $i){ ?>
                                    <? $primer = $item->TNmax - $scheduled->current_subscribers; ?>
                                    <div style="display:none;" id="ntiket<? echo $item->idseg_tourroutes;?>">
                                         <? echo $primer;?>
                                    </div>
                                
                                    <? for($pi=0;$pi<$primer;$pi++){ ?>
                                         <? $list_k[$pi+1] = $pi+1;?>
                                    <? } ?>
                                    <? $pi=0;?>
                            <? } ?>	 
                      <? } ?>
                      <?php echo $form->dropDownList($contact,'tickets'.$i ,$list_k,  array('style'=>'display:none;', 'id'=>'area'.$i, 'onChange'=>'clickTickets(this.value)')); ?>
                     
                      <!-- $item->TNmax -->
                      
				  <? } ?>
                  <?php echo $form->hiddenField($contact,'cat_hidden', array('id'=>'cathidden','value'=>0)); ?>
                      
                  
                  
                 
            
            </div>
            <div style="clear: both;"></div>
        </div>
    </div>

    
    
        <div class="tour_price_guide">
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



    <div style="clear: both;"></div>
 
 
 
     
     
</div>



<div class="book-contact">
<div class="book-contact-name">
	Booking Form
</div>
    <div class="book-form">
        <div class="book_form-item">
            <div class="book-f">First name</div>
            <div class="book-field"><?php echo $form->textField($contact,'firstname',array('placeholder'=>'John')); ?>
           <!-- <php echo $form->error($contact,'firstname'); ?>-->
            
            </div>
            
             <div style="clear: both;"></div>
        </div>
        <div class="book_form-item">
            <div class="book-f">Last name</div>
            <div class="book-field"><?php echo $form->textField($contact,'lastname',array('placeholder'=>'Llvingstone')); ?></div>
             <div style="clear: both;"></div>
        </div>
        <div class="book_form-item">
            <div class="book-f">Address</div>
            <div class="book-field"><?php echo $form->textArea($contact,'address',array('placeholder'=>'Two East 55th Street, at Fifth Avenue; New York 10022; Unlted States')); ?></div>
             <div style="clear: both;"></div>
        </div>
    </div>
    <div class="book-form">
        <div class="book_form-item">
            <div class="book-f">City</div>
            <div class="book-field"><?php echo $form->textField($contact,'city',array('placeholder'=>'New York')); ?></div>
             <div style="clear: both;"></div>
        </div>
        <div class="book_form-item">
            <div class="book-f">Country</div>
            <div class="book-field"><?php echo $form->textField($contact,'country',array('placeholder'=>'Unlted States')); ?></div>
             <div style="clear: both;"></div>
        </div>
        <div class="book_form-item">
            <div class="book-f">Phone</div>
            <div class="book-field"><?php echo $form->textField($contact,'phone',array('placeholder'=>'(1)(___)___-___')); ?></div>
             <div style="clear: both;"></div>
        </div>
        <div class="book_form-item">
            <div class="book-f">E-mail</div>
            <div class="book-field"><?php echo $form->textField($contact,'email',array('placeholder'=>'johnllvingstone@gmail.com')); ?></div>
             <div style="clear: both;"></div>
        </div>
    </div>
    <div style="clear: both;"></div>
</div>
<button class="but-book" type="submit"><?php echo 'BOOK'; ?></button>

<?php $this->endWidget(); ?>    

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
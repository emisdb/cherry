<? 
	if($city_f!=null){$city_f_n = $city_f;}else{$city_f_n=$id_city;}
	if($date_f!=null){$date_f_n = $date_f;}else{$date_f_n=$date;}
	$time_n =$time_f;
	$id_language=$language_f;
	$id_guide=$guide_f;

?>

<div class="filtr">
      <div> 
      		<!--<img src ="<php echo Yii::app()->request->baseUrl; ?>/img/str2/left-menu.jpg" />-->
             <?php $this->widget('application.components.DopMenuFilter', array(
                        
							//city
							'city' =>$city_f_n,
							//date
							'date_n' => $date_f_n,
							//time
							'time_n' => $time_n,
							//language
							'language' => $id_language,
							//guide
							'guide' => $id_guide,
							
                            )); ?>
            
            
      </div>
</div>

<div class="box">
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#panel1"><div class="tour-vkladka">Classic</div></a></li>
      <li><a data-toggle="tab" href="#panel2"><div class="tour-vkladka">Historical</div></a></li>
      <li><a data-toggle="tab" href="#panel3"><div class="tour-vkladka">Special</div></a></li>
    </ul>

    <div class="tab-content">
        <?php foreach($tours as $tour){?> 
     
            <?php if($tour->id_tour_categories==1){?> 
                <div id="panel1" class="tab-pane fade in active">
                    <div class="tour-info">
                        <div class="tour_pic"><img src ="<?php echo Yii::app()->request->baseUrl; ?>/image/tours/<?php echo $tour->pic_icon; ?>" width="100px" height="100px"/></div>
                        <div class="tour_main">
                            <div class="t-name-tour"><?php echo $tour->name;?></div>
                            <div class="t-text-tour"><?php echo $tour->shorttext;?></div>
                        </div>
                        <div class="tour_price">
                            <div class="t-evro-tour" style="width:95px;border-top: 1px dotted #a7a7a7;border-left:1px dotted #a7a7a7;border-right:1px dotted #a7a7a7;">
                                <?php echo $tour->base_price;?>
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/str2/evro.png" />
                            </div>
                            <div class="t-vat-tour" style="padding-bottom:10px;width:95px;border-bottom: 1px dotted #a7a7a7;border-left:1px dotted #a7a7a7;border-right:1px dotted #a7a7a7;">Incl.VAT</div>
                            <div class="t-hrs-tour" style="padding:10px 0;width:95px;border-bottom: 1px dotted #a7a7a7;border-left:1px dotted #a7a7a7;border-right:1px dotted #a7a7a7;">
                            <!-- time conversion in minutes -->
							<? $hour = round($tour->standard_duration/60,2); ?>
							<? echo $hour;?> hrs.
                            
                            </div>
                         </div>
                        <div style="clear: both;"></div>
                    </div>

        
          
          		</div>
      		<?php }?>
            
            
            
      <?php }?>
    </div>
   <!-- <div class="but-more">SHOW MORE</div>-->
    
    
    
</div>
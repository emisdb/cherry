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
                    
                 
                    <? if(count($scheduled_array[0])>0){ ?>
                    <? $ic =0; ?>
                    <? foreach($scheduled_array[0] as $scheduled){?>
                        <? if(($scheduled->tourroute_id == $tour->idseg_tourroutes)or($scheduled->tourroute_id == NULL)){?>
                            
                            <div class="tour-item">
                                <div class="guide-foto"><img src="<? echo Yii::app()->request->baseUrl; ?>/image/guide/<? echo $scheduled->user_ob->guide_ob->lnk_to_picture;?>" width="100px" height="100px" style="height:100px; width:100px;" ></div>
                                <div class="guide-name t-guide-name">
                                    <div class="">
										<? echo $scheduled->user_ob->contact_ob->firstname;?>
                                        <? echo $scheduled->user_ob->contact_ob->surname;?>
                                    </div>
                                    <div class="">
                                    	<? if($scheduled->language_id==null) {?>
											<? foreach($scheduled->language_id_all as $lan_item) {?>
                                                <img src="<? echo Yii::app()->request->baseUrl; ?>/img/lan/<? echo $lan_item->flagpic;?>"/>
                                            <? }?>
                                        <? }else{?>
                                        	<img src="<? echo Yii::app()->request->baseUrl; ?>/img/lan/<? echo $scheduled->language_ob->flagpic;?>"/>
                                        <? }?>
                                    </div>
                                </div>
                                <div class="guide-date">
                                    <? $date_format = date('l, d F Y',$scheduled->date_now);?>
                                    <? $time_format = substr_replace($scheduled->starttime, 0, 4);?>
                                      
                                    <div class="t-text-tour"><? echo $date_format;?></div>
                                    <div class="t-name-tour">
                                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/str2/clock.png" />
                                        <? echo $time_format;?>
                                    </div>
                                </div>
                                <div class="guide-result">
                                    <!-- raschet -->
                                    <? $count_tochki = $tour->TNmax;?>
                                    <? if($scheduled->TNmax_sched==null){ $count_sched = 0;}else{$count_sched=$scheduled->TNmax_sched;}?>
                                    <!-- vivod -->
                                    <div style="float: left;margin-right: 20px;">
                                    <? $j=0;
                                    for ($i=0; $i<$count_tochki;$i++){
                                      if($j!=4){
										  	if($i<$count_sched){
                                            	echo '<div style="float:left;padding:5px 5px;"><div  style="border:5px solid #b7d5e3;border-radius:10px"><div id="circle"></div></div></div>';
											}else{
												echo '<div style="float:left;padding:5px 5px;"><div  style="border:5px solid #ffffff;border-radius:10px"><div id="circle"></div></div></div>';
											}
											$j++;
                                        }else{
                                                echo '<div style="clear:both;"></div>';
                                                $i = $i-1;
                                                $j=0;
                                        }
                                    }
                                    ?>
                                    </div>
                                    <div style="float: left;text-align:center;padding-top:5px;padding-right:10px;">
                                        <div class="t-guide-max">
                                        	<? echo $count_tochki-$count_sched;?>
                                        </div>
                                        <div class="t-guide-min">places left</div>
                                    </div>
                                    <div style="clear: both;"></div>
                                    
                                </div>
                                <a href="<? echo Yii::app()->createUrl('berlin/book', array('id'=>$scheduled->idseg_scheduled_tours,'cat'=>1));?>"><div class="guide-select">SELECT</div></a>
                               <div style="clear: both;"></div>
                           </div>
                        <? }?>
                <? }?>
                <? }?>
                </div>
            <?php }?>


         <?php if($tour->id_tour_categories==2){?> 
                <div id="panel2" class="tab-pane fade ">
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
                    
                 
                    <? if(count($scheduled_array[1])>0){ ?>
                    <? foreach($scheduled_array[1] as $scheduled){?>
                        <? if(($scheduled->tourroute_id == $tour->idseg_tourroutes)or($scheduled->tourroute_id == NULL)){?>
                            
                            <div class="tour-item">
                                <div class="guide-foto"><img src="<? echo Yii::app()->request->baseUrl; ?>/image/guide/<? echo $scheduled->user_ob->guide_ob->lnk_to_picture;?>" style="height: 100px; width:100px;"></div>
                                <div class="guide-name t-guide-name">
                                    <div class="">
										<? echo $scheduled->user_ob->contact_ob->firstname;?>
                                    	<? echo $scheduled->user_ob->contact_ob->surname;?>
                                    </div>
                                    <div class="">
                                    	<? if($scheduled->language_id==null) {?>
											<? foreach($scheduled->language_id_all as $lan_item) {?>
                                                <img src="<? echo Yii::app()->request->baseUrl; ?>/img/lan/<? echo $lan_item->flagpic;?>"/>
                                            <? }?>
                                        <? }else{?>
                                        	<img src="<? echo Yii::app()->request->baseUrl; ?>/img/lan/<? echo $scheduled->language_ob->flagpic;?>"/>
                                        <? }?>
                                    </div>
                                </div>
                                <div class="guide-date">
                                    <? $date_format = date('l, d F Y',$scheduled->date_now);?>
                                    <? $time_format = substr_replace($scheduled->starttime, 0, 4);?>
                                      
                                    <div class="t-text-tour"><? echo $date_format;?></div>
                                    <div class="t-name-tour">
                                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/str2/clock.png" />
                                        <? echo $time_format;?>
                                    </div>
                                </div>
                                <div class="guide-result">
                                    <!-- raschet -->
                                    <? $count_tochki = $tour->TNmax;?>
                                    <? if($scheduled->TNmax_sched==null){ $count_sched = 0;}else{$count_sched=$scheduled->TNmax_sched;}?>
                                    <!-- vivod -->
                                    <div style="float: left;margin-right: 20px;">
                                    <? $j=0;
                                    for ($i=0; $i<$count_tochki;$i++){
                                      if($j!=4){
										  	if($i<$count_sched){
                                            	echo '<div style="float:left;padding:5px 5px;"><div  style="border:5px solid #b7d5e3;border-radius:10px"><div id="circle"></div></div></div>';
											}else{
												echo '<div style="float:left;padding:5px 5px;"><div  style="border:5px solid #ffffff;border-radius:10px"><div id="circle"></div></div></div>';
											}
											$j++;
                                        }else{
                                                echo '<div style="clear:both;"></div>';
                                                $i = $i-1;
                                                $j=0;
                                        }
                                    }
                                    ?>
                                    </div>
                                    <div style="float: left;text-align:center;padding-top:5px;padding-right:10px;">
                                        <div class="t-guide-max">
                                        	<? echo $count_tochki-$count_sched;?>
                                        </div>
                                        <div class="t-guide-min">places left</div>
                                    </div>
                                    <div style="clear: both;"></div>
                                    
                                </div>
                                <a href="<? echo Yii::app()->createUrl('berlin/book', array('id'=>$scheduled->idseg_scheduled_tours,'cat'=>2));?>"><div class="guide-select">SELECT</div></a>
                               <div style="clear: both;"></div>
                           </div>
                        <? }?>
                <? }?>
                <? }?>
                </div>
            <?php }?>
            
            
            
                     <?php if($tour->id_tour_categories==3){?> 
                <div id="panel3" class="tab-pane fade ">
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
                    
                 
                    <? if(count($scheduled_array[2])>0){ ?>
                    <? foreach($scheduled_array[2] as $scheduled){?>
                    
                        <? if(($scheduled->tourroute_id == $tour->idseg_tourroutes)or($scheduled->tourroute_id == NULL)){?>
                            
                            <div class="tour-item">
                                <div class="guide-foto"><img src="<? echo Yii::app()->request->baseUrl; ?>/image/guide/<? echo $scheduled->user_ob->guide_ob->lnk_to_picture;?>" style="height: 100px; width:100px;" ></div>
                                <div class="guide-name t-guide-name">
                                    <div class="">
										<? echo $scheduled->user_ob->contact_ob->firstname;?>
                                    	<? echo $scheduled->user_ob->contact_ob->surname;?>
                                    </div>
                                    <div class="">
                                    	<? if($scheduled->language_id==null) {?>
											<? foreach($scheduled->language_id_all as $lan_item) {?>
                                                <img src="<? echo Yii::app()->request->baseUrl; ?>/img/lan/<? echo $lan_item->flagpic;?>"/>
                                            <? }?>
                                        <? }else{?>
                                        	<img src="<? echo Yii::app()->request->baseUrl; ?>/img/lan/<? echo $scheduled->language_ob->flagpic;?>"/>
                                        <? }?>
                                    </div>
                                </div>
                                <div class="guide-date">
                                    <? $date_format = date('l, d F Y',$scheduled->date_now);?>
                                    <? $time_format = substr_replace($scheduled->starttime, 0, 4);?>
                                      
                                    <div class="t-text-tour"><? echo $date_format;?></div>
                                    <div class="t-name-tour">
                                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/str2/clock.png" />
                                        <? echo $time_format;?>
                                    </div>
                                </div>
                                <div class="guide-result">
                                    <!-- raschet -->
                                    <? $count_tochki = $tour->TNmax;?>
                                    <? if($scheduled->TNmax_sched==null){ $count_sched = 0;}else{$count_sched=$scheduled->TNmax_sched;}?>
                                    <!-- vivod -->
                                    <div style="float: left;margin-right: 20px;">
                                    <? $j=0;
                                    for ($i=0; $i<$count_tochki;$i++){
                                      if($j!=4){
										  	if($i<$count_sched){
                                            	echo '<div style="float:left;padding:5px 5px;"><div  style="border:5px solid #b7d5e3;border-radius:10px"><div id="circle"></div></div></div>';
											}else{
												echo '<div style="float:left;padding:5px 5px;"><div  style="border:5px solid #ffffff;border-radius:10px"><div id="circle"></div></div></div>';
											}
											$j++;
                                        }else{
                                                echo '<div style="clear:both;"></div>';
                                                $i = $i-1;
                                                $j=0;
                                        }
                                    }
                                    ?>
                                    </div>
                                    <div style="float: left;text-align:center;padding-top:5px;padding-right:10px;">
                                        <div class="t-guide-max">
                                        	<? echo $count_tochki-$count_sched;?>
                                        </div>
                                        <div class="t-guide-min">places left</div>
                                    </div>
                                    <div style="clear: both;"></div>
                                    
                                </div>
                                <a href="<? echo Yii::app()->createUrl('berlin/book', array('id'=>$scheduled->idseg_scheduled_tours,'cat'=>3));?>"><div class="guide-select">SELECT</div></a>
                               <div style="clear: both;"></div>
                           </div>
                        <? }?>
                <? }?>
                <? }?>
                </div>
            <?php }?>
            
                  
            
           
          
          
          
          
          
          
          
      <?php }?>
    </div>
    <div class="but-more">SHOW MORE</div>
    
    
    
</div>
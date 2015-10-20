<div class="filtr">
      <div> <img src ="<?php echo Yii::app()->request->baseUrl; ?>/img/str2/left-menu.jpg" /></div>
</div>

<div class="box">
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#panel1"><div class="tour-vkladka">Classic</div></a></li>
      <li><a data-toggle="tab" href="#panel2"><div class="tour-vkladka">Historical</div></a></li>
      <li><a data-toggle="tab" href="#panel3"><div class="tour-vkladka">Spesial</div></a></li>
    </ul>

    <div class="tab-content">
        <?php foreach($tours as $tour){?> 
     
            <?php if($tour->id_tour_categories==1){?> 
                <div id="panel1" class="tab-pane fade in active">
                    <div class="tour-info">
                        <div class="tour_pic"><img src ="<?php echo Yii::app()->request->baseUrl; ?>/image/tours/<?php echo $tour->pic_icon; ?>" /></div>
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
                            <div class="t-hrs-tour" style="padding:10px 0;width:95px;border-bottom: 1px dotted #a7a7a7;border-left:1px dotted #a7a7a7;border-right:1px dotted #a7a7a7;"><!--<php echo $tour->base_price;?>-->1.5 hrs.</div>
                         </div>
                        <div style="clear: both;"></div>
                    </div>
                    
                 
                    
                    <? foreach($scheduled_array[0] as $scheduled){?>
                        <? if(($scheduled->tourroute_id == $tour->idseg_tourroutes)or($scheduled->tourroute_id == NULL)){?>
                            
                            <div class="tour-item">
                                <div class="guide-foto"><img src="<? echo Yii::app()->request->baseUrl; ?>/image/guide/<? echo $scheduled->user_ob->guide_ob->lnk_to_picture;?>"/></div>
                                <div class="guide-name t-guide-name">
                                    <div class=""><? echo $scheduled->user_ob->contact_ob->firstname;?></div>
                                    <div class="">
                                        <? foreach($scheduled->language_id_all as $lan_item) {?>
                                            <img src="<? echo Yii::app()->request->baseUrl; ?>/img/lan/<? echo $lan_item->flagpic;?>"/>
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
                                    
                                    <!-- vivod -->
                                    <div style="float: left;margin-right: 20px;">
                                    <? $j=0;
                                    for ($i=0; $i<$count_tochki;$i++){
                                      if($j!=4){
                                            echo '<div style="float:left;padding:5px 5px;"><div  style="border:5px solid #b7d5e3;border-radius:10px"><div id="circle"></div></div></div>';$j++;
                                            }else{
                                                echo '<div style="clear:both;"></div>';
                                                $i = $i-1;
                                                $j=0;
                                            }
                                    }
                                    ?>
                                    </div>
                                    <div style="float: left;text-align:center;padding-top:5px;padding-right:10px;">
                                        <div class="t-guide-max">7</div>
                                        <div class="t-guide-min">places left</div>
                                    </div>
                                    <div style="clear: both;"></div>
                                    
                                </div>
                                <a href="<? echo Yii::app()->createUrl('berlin/book', array('id'=>$scheduled->idseg_scheduled_tours,'cat'=>1));?>"><div class="guide-select">SELECT</div></a>
                               <div style="clear: both;"></div>
                           </div>
                        <? }?>
                <? }?>
                </div>
            <?php }?>

            
                  <?php if($tour->id_tour_categories==2){?> 
                <div id="panel2" class="tab-pane fade">
                    <div class="tour-info">
                        <div class="tour_pic"><img src ="<?php echo Yii::app()->request->baseUrl; ?>/image/tours/<?php echo $tour->pic_icon; ?>" /></div>
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
                            <div class="t-hrs-tour" style="padding:10px 0;width:95px;border-bottom: 1px dotted #a7a7a7;border-left:1px dotted #a7a7a7;border-right:1px dotted #a7a7a7;"><!--<php echo $tour->base_price;?>-->1.5 hrs.</div>
                         </div>
                        <div style="clear: both;"></div>
                    </div>
                    
                    <? foreach($scheduled_array[0] as $scheduled){?>
                        <? if(($scheduled->tourroute_id == $tour->idseg_tourroutes)or($scheduled->tourroute_id == NULL)){?>
                            <div class="tour-item">
                                <div class="guide-foto"><img src="<? echo Yii::app()->request->baseUrl; ?>/image/guide/<? echo $scheduled->user_ob->guide_ob->lnk_to_picture;?>"/></div>
                                <div class="guide-name t-guide-name">
                                    <div class=""><? echo $scheduled->user_ob->contact_ob->firstname;?></div>
                                    <div class="">
                                        <? foreach($scheduled->language_id_all as $lan_item) {?>
                                            <img src="<? echo Yii::app()->request->baseUrl; ?>/img/lan/<? echo $lan_item->flagpic;?>"/>
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
                                    
                                    <!-- vivod -->
                                    <div style="float: left;margin-right: 20px;">
                                    <? $j=0;
                                    for ($i=0; $i<$count_tochki;$i++){
                                      if($j!=4){
                                            echo '<div style="float:left;padding:5px 5px;"><div  style="border:5px solid #b7d5e3;border-radius:10px"><div id="circle"></div></div></div>';$j++;
                                            }else{
                                                echo '<div style="clear:both;"></div>';
                                                $i = $i-1;
                                                $j=0;
                                            }
                                    }
                                    ?>
                                    </div>
                                    <div style="float: left;text-align:center;padding-top:5px;padding-right:10px;">
                                        <div class="t-guide-max">7</div>
                                        <div class="t-guide-min">places left</div>
                                    </div>
                                    <div style="clear: both;"></div>
                                    
                                </div>
                                <a href=""><div class="guide-select">SELECT</div></a>
                               <div style="clear: both;"></div>
                           </div>
                        <? }?>
                <? }?>
                </div>
            <?php }?>
            
            
            
                  <?php if($tour->id_tour_categories==3){?> 
                <div id="panel3" class="tab-pane fade ">
                    <div class="tour-info">
                        <div class="tour_pic"><img src ="<?php echo Yii::app()->request->baseUrl; ?>/image/tours/<?php echo $tour->pic_icon; ?>" /></div>
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
                            <div class="t-hrs-tour" style="padding:10px 0;width:95px;border-bottom: 1px dotted #a7a7a7;border-left:1px dotted #a7a7a7;border-right:1px dotted #a7a7a7;"><!--<php echo $tour->base_price;?>-->1.5 hrs.</div>
                         </div>
                        <div style="clear: both;"></div>
                    </div>
                    
                    <? foreach($scheduled_array[0] as $scheduled){?>
                        <? if(($scheduled->tourroute_id == $tour->idseg_tourroutes)or($scheduled->tourroute_id == NULL)){?>
                            <div class="tour-item">
                                <div class="guide-foto"><img src="<? echo Yii::app()->request->baseUrl; ?>/image/guide/<? echo $scheduled->user_ob->guide_ob->lnk_to_picture;?>"/></div>
                                <div class="guide-name t-guide-name">
                                    <div class=""><? echo $scheduled->user_ob->contact_ob->firstname;?></div>
                                    <div class="">
                                        <? foreach($scheduled->language_id_all as $lan_item) {?>
                                            <img src="<? echo Yii::app()->request->baseUrl; ?>/img/lan/<? echo $lan_item->flagpic;?>"/>
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
                                    
                                    <!-- vivod -->
                                    <div style="float: left;margin-right: 20px;">
                                    <? $j=0;
                                    for ($i=0; $i<$count_tochki;$i++){
                                      if($j!=4){
                                            echo '<div style="float:left;padding:5px 5px;"><div  style="border:5px solid #b7d5e3;border-radius:10px"><div id="circle"></div></div></div>';$j++;
                                            }else{
                                                echo '<div style="clear:both;"></div>';
                                                $i = $i-1;
                                                $j=0;
                                            }
                                    }
                                    ?>
                                    </div>
                                    <div style="float: left;text-align:center;padding-top:5px;padding-right:10px;">
                                        <div class="t-guide-max">7</div>
                                        <div class="t-guide-min">places left</div>
                                    </div>
                                    <div style="clear: both;"></div>
                                    
                                </div>
                                <a href=""><div class="guide-select">SELECT</div></a>
                               <div style="clear: both;"></div>
                           </div>
                        <? }?>
                <? }?>
                </div>
            <?php }?>
            
            
           
          
          
          
          
          
          
          
      <?php }?>
    </div>
    <div class="but-more">SHOW MORE</div>
    
    
    
</div>
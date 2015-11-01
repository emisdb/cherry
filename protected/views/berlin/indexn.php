<?php 
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
                    
               		<div id="contentsearch_classic">
                    	<? if(count($scheduled_classic)>0){ ?>
                    	<? foreach($scheduled_classic as $scheduled){?>
                            <div class="tour-item">
                                <div class="guide-foto"><img src="<? echo Yii::app()->request->baseUrl; ?>/image/guide/<? echo $scheduled->user_ob->guide_ob->lnk_to_picture;?>" style="height:100px; width:100px;" ></div>
                                <div class="guide-name t-guide-name">
                                    <div class="">
										<? echo $scheduled->user_ob->contact_ob->firstname;?>
                                        <? echo $scheduled->user_ob->contact_ob->surname;?>
                                    </div>
                                    <div class="">
                                    	<? if($scheduled->language_id==null) {?>
											<? foreach($scheduled->language_all as $lan_item) {?>
                                                <img src="<? echo Yii::app()->request->baseUrl; ?>/img/lan/<? echo $lan_item->languages->flagpic;?>"/>
                                            <? }?>
                                        <? }else{?>
                                        	<img src="<? echo Yii::app()->request->baseUrl; ?>/img/lan/<? echo $scheduled->language_ob->flagpic;?>"/>
                                        <? }?>
                                    </div>
                                </div>
                                <div class="guide-date">
                                	<? $date_format_l = date('l',$scheduled->date_now);?>
                                    <? $date_format = date('d F Y',$scheduled->date_now);?>
                                    
                                    <? $time_format = substr_replace($scheduled->starttime, '', 5);?>
                                      
                                    <div class="t-text-tour">
										 <div style="color:#000000;font-size:14px;f">
										 	<? echo $date_format_l;?>
                                         </div>
                                         <div style="color:#000000;font-size:18px;font-weight:bold;">
										 	<? echo $date_format;?>
                                         </div>
                                    </div>
                                    <div class="t-name-tour">
                                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/str2/clock.png" />
                                        <? echo $time_format;?>
                                    </div>
                                </div>
                                <div class="guide-result">
                                    <!-- raschet -->
                                    <!--< $count_tochki = $tour->current_subscribers;?>-->
                                    <? $count_tochki = $scheduled->tour_i;?>
                                    <? if($scheduled->TNmax_sched==null){ $count_sched = 0;}else{$count_sched=$scheduled->current_subscribers;}?>
                                   
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
                                
                                <? if(($scheduled->TNmax_sched==null)or($scheduled->TNmax_sched != $scheduled->current_subscribers)) { ?>
                                	<a href="<? echo Yii::app()->createUrl('berlin/book', array('id'=>$scheduled->idseg_scheduled_tours,'cat'=>1));?>"><div class="guide-select">SELECT</div></a>
                                <? } else { ?>
                                	<div class="guidesna">SELECT</div>
                                <? } ?>
                               <div style="clear: both;"></div>
                           </div>
                        <? }?>
	            <? }?>
               		</div>
                    
                	<?php if ($pages_classic->itemCount > $pages_classic->pageSize): ?>
                        <div class="row" style="margin: 10px 0; padding:10px;">
                            <div class="span9" style="text-align:center;">
                                <p id="loading_classic" style="display:none"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/loader.gif" alt="" /></p>
                            </div>
                        </div>
                    
                        <div class="row" style="position:relative;top:0;width:197px;margin:0 auto;">
                            <div id="showMore_classic" class="but-more">SHOW MORE</div>
                        </div>
                     
                        <script type="text/javascript">
							/*<![CDATA[*/
							(function($)
							{
								// скрываем стандартный навигатор
							   // $('.paginator').hide();
					
								// запоминаем текущую страницу и их максимальное количество
								var page1 = parseInt('<?php echo (int)Yii::app()->request->getParam('page', 1); ?>');
								var pageCount1 = parseInt('<?php echo $pages_classic->pageCount; ?>');
					
								var loadingFlag1 = false;
					
								$('#showMore_classic').click(function()
								{
									// защита от повторных нажатий
									if (!loadingFlag1)
									{
										// выставляем блокировку
										loadingFlag1 = true;
					
										// отображаем анимацию загрузки
										$('#loading_classic').show();
					
										$.ajax({
											type: 'post',
											url: window.location.href,
											data: {
												// передаём номер нужной страницы методом POST
												'page': page1 + 1,
												'page_type': 1,
												'<?php echo Yii::app()->request->csrfTokenName; ?>': '<?php echo Yii::app()->request->csrfToken; ?>'
											},
											success: function(data)
											{
												// увеличиваем номер текущей страницы и снимаем блокировку
												page1++;
												loadingFlag1 = false;
					
												// прячем анимацию загрузки
												$('#loading_classic').hide();
					
												// вставляем полученные записи после имеющихся в наш блок
												$('#contentsearch_classic').append(data);
					
												// если достигли максимальной страницы, то прячем кнопку
												if (page1 >= pageCount1)
													$('#showMore_classic').hide();
											}
										});
									}
									return false;
								})
							})(jQuery);
							/*]]>*/
						</script>
                        
                    <?php endif; ?>
                    
            </div>
         <?php }?>
            
<!-- ************************************************************************************ -->

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
                    
                    <div id="contentsearch_historical">
                    	<? if(count($scheduled_historical)>0){ ?>
                    	<? foreach($scheduled_historical as $scheduled){?>
                            <div class="tour-item">
                                <div class="guide-foto"><img src="<? echo Yii::app()->request->baseUrl; ?>/image/guide/<? echo $scheduled->user_ob->guide_ob->lnk_to_picture;?>" style="height:100px; width:100px;" ></div>
                                <div class="guide-name t-guide-name">
                                    <div class="">
										<? echo $scheduled->user_ob->contact_ob->firstname;?>
                                    	<? echo $scheduled->user_ob->contact_ob->surname;?>
                                    </div>
                                    <div class="">
                                    	<? if($scheduled->language_id==null) {?>
											<? foreach($scheduled->language_all as $lan_item) {?>
                                                <img src="<? echo Yii::app()->request->baseUrl; ?>/img/lan/<? echo $lan_item->languages->flagpic;?>"/>
                                            <? }?>
                                        <? }else{?>
                                        	<img src="<? echo Yii::app()->request->baseUrl; ?>/img/lan/<? echo $scheduled->language_ob->flagpic;?>"/>
                                        <? }?>
                                    </div>
                                </div>
                                <div class="guide-date">
									<? $date_format_l = date('l',$scheduled->date_now);?>
                                    <? $date_format = date('d F Y',$scheduled->date_now);?>
                                    
                                    <? $time_format = substr_replace($scheduled->starttime, '', 5);?>
                                      
                                    <div class="t-text-tour">
										 <div style="color:#000000;font-size:14px;f">
										 	<? echo $date_format_l;?>
                                         </div>
                                         <div style="color:#000000;font-size:18px;font-weight:bold;">
										 	<? echo $date_format;?>
                                         </div>
                                    </div>
                                    <div class="t-name-tour">
                                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/str2/clock.png" />
                                        <? echo $time_format;?>
                                    </div>
                                </div>
                                <div class="guide-result">
                                    <!-- raschet -->
                                    <? $count_tochki = $tour->TNmax;?>
                                    <? if($scheduled->TNmax_sched==null){ $count_sched = 0;}else{$count_sched=$scheduled->current_subscribers;}?>
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
                                                               <? if(($scheduled->TNmax_sched==null)or($scheduled->TNmax_sched != $scheduled->current_subscribers)) { ?>
                                	<a href="<? echo Yii::app()->createUrl('berlin/book', array('id'=>$scheduled->idseg_scheduled_tours,'cat'=>2));?>"><div class="guide-select">SELECT</div></a>
                                <? } else { ?>
                                	<div class="guidesna">SELECT</div>
                                <? } ?>
                               <div style="clear: both;"></div>
                           </div>
                        <? }?>
                	<? }?>
              		</div> 
                    
                    <?php if ($pages_historical->itemCount > $pages_historical->pageSize): ?>
                        <div class="row" style="margin: 10px 0; padding:10px;">
                            <div class="span9" style="text-align:center;">
                                <p id="loading_historical" style="display:none"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/loader.gif" alt="" /></p>
                            </div>
                        </div>
                    
                        <div class="row" style="position:relative;top:0;width:197px;margin:0 auto;">
                            <div id="showMore_historical" class="but-more">SHOW MORE</div>
                        </div>
                    
                        <script type="text/javascript">
							/*<![CDATA[*/
							(function($)
							{
								// скрываем стандартный навигатор
							   // $('.paginator').hide();
					
								// запоминаем текущую страницу и их максимальное количество
								var page2 = parseInt('<?php echo (int)Yii::app()->request->getParam('page', 1); ?>');
								var pageCount2 = parseInt('<?php echo $pages_historical->pageCount; ?>');
					
								var loadingFlag2 = false;
					
								$('#showMore_historical').click(function()
								{
									// защита от повторных нажатий
									if (!loadingFlag2)
									{
										// выставляем блокировку
										loadingFlag2 = true;
					
										// отображаем анимацию загрузки
										$('#loading_historical').show();
					
										$.ajax({
											type: 'post',
											url: window.location.href,
											data: {
												// передаём номер нужной страницы методом POST
												'page': page2 + 1,
												'page_type': 2,
												'<?php echo Yii::app()->request->csrfTokenName; ?>': '<?php echo Yii::app()->request->csrfToken; ?>'
											},
											success: function(data)
											{
												// увеличиваем номер текущей страницы и снимаем блокировку
												page2++;
												loadingFlag2 = false;
					
												// прячем анимацию загрузки
												$('#loading_historical').hide();
					
												// вставляем полученные записи после имеющихся в наш блок
												$('#contentsearch_historical').append(data);
					
												// если достигли максимальной страницы, то прячем кнопку
												if (page2 >= pageCount2)
													$('#showMore_historical').hide();
											}
										});
									}
									return false;
								})
							})(jQuery);
							/*]]>*/
						</script>
                      
                    <?php endif; ?>
                   
                </div>
            <?php }?>
            
<!-- ************************************************************************************ -->
            
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
                    
           			<div id="contentsearch_special">
                    	<? if(count($scheduled_special)>0){ ?>
                    	<? foreach($scheduled_special as $scheduled){?>
                            <div class="tour-item">
                                <div class="guide-foto"><img src="<? echo Yii::app()->request->baseUrl; ?>/image/guide/<? echo $scheduled->user_ob->guide_ob->lnk_to_picture;?>" style="height:100px; width:100px;" ></div>
                                <div class="guide-name t-guide-name">
                                    <div class="">
										<? echo $scheduled->user_ob->contact_ob->firstname;?>
                                    	<? echo $scheduled->user_ob->contact_ob->surname;?>
                                    </div>
                                    <div class="">
                                    	<? if($scheduled->language_id==null) {?>
											<? foreach($scheduled->language_all as $lan_item) {?>
                                                <img src="<? echo Yii::app()->request->baseUrl; ?>/img/lan/<? echo $lan_item->languages->flagpic;?>"/>
                                            <? }?>
                                        <? }else{?>
                                        	<img src="<? echo Yii::app()->request->baseUrl; ?>/img/lan/<? echo $scheduled->language_ob->flagpic;?>"/>
                                        <? }?>
                                    </div>
                                </div>
                                <div class="guide-date">
                                    <? $date_format_l = date('l',$scheduled->date_now);?>
                                    <? $date_format = date('d F Y',$scheduled->date_now);?>
                                    
                                    <? $time_format = substr_replace($scheduled->starttime, '', 5);?>
                                      
                                    <div class="t-text-tour">
										 <div style="color:#000000;font-size:14px;f">
										 	<? echo $date_format_l;?>
                                         </div>
                                         <div style="color:#000000;font-size:18px;font-weight:bold;">
										 	<? echo $date_format;?>
                                         </div>
                                    </div>
                                    <div class="t-name-tour">
                                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/str2/clock.png" />
                                        <? echo $time_format;?>
                                    </div>

                                </div>
                                <div class="guide-result">
                                    <!-- raschet -->
                                    <? $count_tochki = $tour->TNmax;?>
                                    <? if($scheduled->TNmax_sched==null){ $count_sched = 0;}else{$count_sched=$scheduled->current_subscribers;}?>
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
                                <? if(($scheduled->TNmax_sched==null)or($scheduled->TNmax_sched != $scheduled->current_subscribers)) { ?>
                                	<a href="<? echo Yii::app()->createUrl('berlin/book', array('id'=>$scheduled->idseg_scheduled_tours,'cat'=>3));?>"><div class="guide-select">SELECT</div></a>
                                <? } else { ?>
                                	<div class="guidesna">SELECT</div>
                                <? } ?>
                               <div style="clear: both;"></div>
                           </div>
                        <? }?>
                	<? }?>
                    </div>

                    <?php if ($pages_special->itemCount > $pages_special->pageSize): ?>
                        <div class="row" style="margin: 10px 0; padding:10px;">
                            <div class="span9" style="text-align:center;">
                                <p id="loading_special" style="display:none"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/loader.gif" alt="" /></p>
                            </div>
                        </div>
                    
                        <div class="row" style="position:relative;top:0;width:197px;margin:0 auto;">
                            <div id="showMore_special" class="but-more">SHOW MORE</div>
                        </div>
           				<script type="text/javascript">
							/*<![CDATA[*/
							(function($)
							{
								// скрываем стандартный навигатор
							   // $('.paginator').hide();
					
								// запоминаем текущую страницу и их максимальное количество
								var page3 = parseInt('<?php echo (int)Yii::app()->request->getParam('page', 1); ?>');
								var pageCount3 = parseInt('<?php echo $pages_special->pageCount; ?>');
					
								var loadingFlag3 = false;
								
					
								$('#showMore_special').click(function()
								{
									// защита от повторных нажатий
									if (!loadingFlag3)
									{
										// выставляем блокировку
										loadingFlag3 = true;
					
										// отображаем анимацию загрузки
										$('#loading_special').show();
					
										$.ajax({
											type: 'post',
											url: window.location.href,
											data: {
												// передаём номер нужной страницы методом POST
												'page': page3 + 1,
												'page_type': 3,
												'<?php echo Yii::app()->request->csrfTokenName; ?>': '<?php echo Yii::app()->request->csrfToken; ?>'
											},
											success: function(data)
											{
												// увеличиваем номер текущей страницы и снимаем блокировку
												page3++;
												loadingFlag3 = false;
					
												// прячем анимацию загрузки
												$('#loading_special').hide();
					
												// вставляем полученные записи после имеющихся в наш блок
												$('#contentsearch_special').append(data);
					
												// если достигли максимальной страницы, то прячем кнопку
												if (page3 >= pageCount3)
													$('#showMore_special').hide();
											}
										});
									}
									return false;
								})
							})(jQuery);
							/*]]>*/
						</script>

                    <?php endif; ?>
                    </div>
                </div>
            <?php }?>
            
                  
            
           
          
          
          
          
          
          
          
      <?php }?>
    </div>


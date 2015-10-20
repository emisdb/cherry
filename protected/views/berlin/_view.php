<? if($_POST['page_type'] ==1) { ?>
	<? if(count($scheduled_classic)>0){ ?>
			<? foreach($scheduled_classic as $scheduled){?>
				<div class="tour-item">
					<div class="guide-foto"><img src="<? echo Yii::app()->request->baseUrl; ?>/image/guide/<? echo $scheduled->user_ob->guide_ob->lnk_to_picture;?>"/></div>
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
						
						<? $time_format = substr_replace($scheduled->starttime, 0, 4);?>
						  
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
						<!--< $count_tochki = $tour->TNmax;?>-->
						<? $count_tochki = $scheduled->tour_i;?>
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
<? } ?>

<? if($_POST['page_type'] ==2) { ?>
	<? if(count($scheduled_historical)>0){ ?>
			<? foreach($scheduled_historical as $scheduled){?>
				<div class="tour-item">
					<div class="guide-foto"><img src="<? echo Yii::app()->request->baseUrl; ?>/image/guide/<? echo $scheduled->user_ob->guide_ob->lnk_to_picture;?>"/></div>
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
						
						<? $time_format = substr_replace($scheduled->starttime, 0, 4);?>
						  
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
						<? $count_tochki = $scheduled->tour_i;?>
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
<? } ?>

<? if($_POST['page_type'] ==3) { ?>
	<? if(count($scheduled_special)>0){ ?>
			<? foreach($scheduled_special as $scheduled){?>
				<div class="tour-item">
					<div class="guide-foto"><img src="<? echo Yii::app()->request->baseUrl; ?>/image/guide/<? echo $scheduled->user_ob->guide_ob->lnk_to_picture;?>"/></div>
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
						
						<? $time_format = substr_replace($scheduled->starttime, 0, 4);?>
						  
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
						<? $count_tochki = $scheduled->tour_i;?>
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
<? } ?>
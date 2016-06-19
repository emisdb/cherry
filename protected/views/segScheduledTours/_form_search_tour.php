<?
$citys = SegCities::model()->findAll();
$last_search = Yii::app()->session->get('last_search');

if($last_search !='') $arr = json_decode($last_search);
$opt_city = '';
foreach($citys as $val){
	$sel='';
	if($model->city_ob->webadress_en == $val->webadress_en) $sel = 'selected';	
	$opt_city .= '<option value="'.$val->idseg_cities.'" data-city="'.$val->webadress_en.'" '.$sel.'>'.$val->seg_cityname.'</option>';
};
$times = SegStarttimes::model()->findAll();
$opt_time='';
foreach($times as $val){
	$tm = str_replace("00:00","00",$val->timevalue);
	$sel='';
	if(isset($_POST['SegScheduledTours']['starttime']) || !empty($arr->starttime)){
		if(!empty($arr->starttime) && $arr->starttime == $val->timevalue) $sel = 'selected';
		if(@$_POST['SegScheduledTours']['starttime'] == $val->timevalue) $sel = 'selected';
	}
	$opt_time .= '<option value="'.$val->timevalue.'" '.$sel.'>'.$tm.'</option>';
};
$lang = Languages::model()->findAll();
$opt_lang='';
foreach($lang as $val){
	$sel='';
	if(isset($_POST['SegScheduledTours']['language_id'])  || !empty($arr->language_id)){
		if(!empty($arr->language_id) && $arr->language_id == $val->id_languages) $sel = 'selected';
		if(isset($_POST['SegScheduledTours']['language_id'])){
			if($_POST['SegScheduledTours']['language_id'] == $val->id_languages) $sel = 'selected';
		}
	}
	$opt_lang .= '<option value="'.$val->id_languages.'" '.$sel.'>'.$val->germanname.'</option>';
};
$us = new User('search_gn');
$guide = $us->search_gn();
$opt_guide='';
foreach($guide as $val){
	$sel='';
	if(isset($_POST['SegScheduledTours']['guide1_id'])  || !empty($arr->guide1_id)){
		if(!empty($arr->guide1_id) && $arr->guide1_id == $val->id) $sel = 'selected';
		if($_POST['SegScheduledTours']['guide1_id'] == $val->id) $sel = 'selected';
	}
	$opt_guide .= '<option value="'.$val->id.'" '.$sel.'>'.$val->guidename.'</option>';
};
$dat = date("d.m.Y");
if(!empty($arr->date)) $dat = $arr->date;
if(isset($_POST['SegScheduledTours'])) $dat = $_POST['SegScheduledTours']['date']; 
?>
       <form id="search-form" action="" method="post">
        <div>
         <select id="pickcity" name="SegScheduledTours[city_id]" class="sends svg-arrow">
          <?=$opt_city;?>
         </select>
        </div>
        <div>
         <input type="text" id="pickdate" name="SegScheduledTours[date]" value="<?=$dat;?>" class="sends svg-date">
        </div>
        <div>
         <select id="picktime" name="SegScheduledTours[starttime]" class="sends svg-time">
          <option value=""><?= Yii::t('api', 'bt_time'); ?></option>
          <?=$opt_time;?>
         </select>
        </div>
        <div>
         <select id="picklang" name="SegScheduledTours[language_id]" class="sends svg-lang">
          <option value=""><?= Yii::t('api', 'Sprache'); ?></option>
          <?=$opt_lang;?>
         </select>
        </div>
        <div>
         <select id="pickguide" name="SegScheduledTours[guide1_id]" class="sends svg-guide">
          <option value="">Guide</option>
          <?=$opt_guide;?>
         </select>
        </div>
        <div class="pick-button">
         <button type="submit" class="btn btn-sucess bt-bordo" id="bt-search-form1"><?= Yii::t('api', 'bt_search'); ?></button>
        </div>
       </form>
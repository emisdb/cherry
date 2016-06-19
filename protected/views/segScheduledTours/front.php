<header class="big-img bg-1">
 <div class="layout">

  
  <div class="container">
   <div class="logotype">
    <a href="/"><img src="/template/design-1/icons/svg-export_cherrytours-symbol-white.svg" width="100%" height="80" alt="logotype"><strong>Cherrytours</strong></a>
   </div>
   <div id="title">
    <h1><?= Yii::t('api', 'index_top_h1'); ?></h1>
    <h2><?= Yii::t('api', 'index_top_h2'); ?></h2>
   </div>
   <?
     $citys = SegCities::model()->findAll();
	 $opt='';
	 foreach($citys as $val){
		 $opt .= '<option value="'.$val->idseg_cities.'" data-city="'.$val->webadress_en.'">'.$val->seg_cityname.'</option>';
	 };
   ?>
   <form action="" id="search-form-main" method="post" class="form-inline" >

    <select id="pickcity-main" name="SegScheduledTours[city_id]">
     <option value="0" data-city="0"><?=Yii::t('api', 'bt_city');?></option>
     <?=$opt;?>
    </select>
    <input  id="pickdate-main" name="SegScheduledTours[date]" type="text" value="<?=date("d.m.Y");?>" class="svg-date">
    <button type="submit" class="btn bt-bordo" id="index-submit" disabled="disabled"><?=Yii::t('api', 'bt_search');?></button>
 
   </form>
  </div>
 </div>
</header>
<section id="content">
 <div class="container">
  <div id="categories-title">
   <h3><?= Yii::t('api', 'name_city_index');?></h3>
  </div>
  <div id="categories">
   <div id="classic" class="cat-block col-sm-4">
    <a href="berlin#classic" class="img-city">
     <img src="/template/design-1/images/berlin1.jpg" alt="berlin1" class="img-responsive">
     <div class="inner-cat-title">
      <img src="/template/design-1/icons/svg-export_classic-white.svg" width="100%" height="150" alt="Classic Berlin">
      <i id="cat-berlin">Classic</br>Berlin</i>
     </div>
    </a>
   </div>
   <div id="historical" class="cat-block col-sm-4">
    <a href="munchen#classic" class="img-city">
     <img src="/template/design-1/images/munich1.jpg" alt="munich1" class="img-responsive">
     <div class="inner-cat-title">
      <img src="/template/design-1/icons/svg-export_classic-white.svg" width="100%" height="150"  alt="Classic München">
      <i id="cat-munchen">Classic</br>München</i>
     </div>
    </a>
   </div>
   <div id="special" class="cat-block col-sm-4">
    <a href="munchen#historical" id="goto-hamburg" class="img-city">
     <img src="/template/design-1/images/munich2.jpg" alt="munich2" class="img-responsive">
     <div class="inner-cat-title">
      <img src="/template/design-1/icons/svg-export_historical-white.svg"  width="100%" height="150"  alt="Historical München">
      <i id="cat-hamburg">Historical</br>München</i>
     </div>
    </a>
   </div>
  </div>
 </div>
</section>
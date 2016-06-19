<?
//var_dump($tour->city->seg_cityname);
$city_en = $model->city_ob->webadress_en;
$uhr = '';
if(Yii::app()->language == 'de') $uhr = ' Uhr';
$city_name = $model->city_ob->seg_cityname;
?>
<header class="page-book">
 <nav id="navbar-mobile" class="navbar">
  <div class="container header-cont">
   <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
     <span class="sr-only">Menu</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="/<?=$city_en;?>"><img alt="Brand" src="/template/design-1/icons/svg-export_cherrytours-symbol-pink.svg" width="50" height="44"><span><?=$city_name?></span></a>
   </div>
   <div id="navbar" class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
      <li class="active"><a href="/"><?= Yii::t('api','index_page'); ?></a></li>
      <li><a href="/<?= $city_en; ?>"><?= $city_name; ?></a></li>
    </ul>
   </div>
  </div>
 </nav>
 <div id="top-bar">
  <div class="container-fluid">
   <div id="back"><a href="/<?=$city_en;?>"><i class="fa fa-chevron-left"></i> <span><?= Yii::t('api','zuruck'); ?></span></a></div>
   <div id="top-title"><strong><?= Yii::t('api','tourbook'); ?></strong></div>
  </div>
 </div>
 <div class="container">
  <div class="logotype">
   <a href=""><img src="/template/design-1/icons/svg-export_cherrytours-symbol-white.svg" height="65" width="100%" alt="logotype-img">
    <strong>Cherrytours</strong>
   </a>
  </div>
  <div class="logotype-city"><?= $city_name; ?></div>
 </div>
</header>

<article class="container-fluid page-book" style="background-image:url(/template/design-1/images/main-<?=$city_en;?>.jpg)">
 <div class="container">
  <!-- booking form -->
  <div id="booking-form" class="thankyou">
   <form action="/<?=$city_en;?>/thankyousend" method="post" class="clearfix" id="form-thankyou">
    <input name="city_en" type="hidden" value="<?=$city_en;?>" />
    <input name="sid" type="hidden" value="<?=$sid;?>" />
    <input name="tid" type="hidden" value="<?=$tid;?>" />
    <input name="guest" type="hidden" value="<?=$guest;?>" />
    <input name="contact_name" type="hidden" value="<?=$post['SegContacts']['firstname'] . ' ' . $post['SegContacts']['surname'];?>" />
    <input name="contact_street" type="hidden" value="<?=$post['SegContacts']['additional_address'] . '<br>' . $post['SegContacts']['street']; ?>" />
    <input name="contact_city" type="hidden" value="<?=$post['SegContacts']['city']; ?>" />
    <input name="contact_land" type="hidden" value="<?=$post['SegContacts']['country']; ?>" />
    <input name="contact_tel" type="hidden" value="<?=$post['SegContacts']['phone']; ?>" />
    <input name="contact_email" type="hidden" value="<?=$post['SegContacts']['email']; ?>" />
    <!-- line-1 -->
    <div class="booking-form-head">
     <i class="step-number">1.</i> <strong><?= Yii::t('api','reserv_conf'); ?></strong>
    </div>
    
    <div class="col-xs-12" style="margin-bottom:20px;">
      <h4 style="color:#D9426A"><?= Yii::t('api','tour_reserv'); ?></h4>
      <p>
        <ul class="list_tab">
         <li><?=$post['SegScheduledTours']['current_subscribers']*1;?><?= Yii::t('api','freepl'); ?></li>
         <li><?=$tour->name . ' ' .$tour->city->seg_cityname ;?></li>
         <li><?=$this->dateEn($model->date); ?></li>
         <li><?=$this->timeShort($model->starttime) . $uhr; ?></li>
         <li>Guide: <?=$model->user_ob->guidename;?></li>
        </ul>
      </p>
      <h4 style="color:#D9426A"><?= Yii::t('api','Kontaktdaten'); ?></h4>
       <div class="col-sm-3 col-xs-12 row_adres">
        <div><?=$post['SegContacts']['firstname'] . ' ' . $post['SegContacts']['surname'];?></div>
        <div><?=$post['SegContacts']['additional_address'];?></div>
       </div>
       <div class="col-sm-3 col-xs-12 row_adres">
	    <div><?=$post['SegContacts']['street'];?></div>
        <div><?=$post['SegContacts']['postalcode'].' ' .$post['SegContacts']['city'].' ' .$post['SegContacts']['country'];?></div>
       </div>
       <div class="col-sm-3 col-xs-12 row_adres">
	    <div><?=$post['SegContacts']['email'];?></div>
        <div><?=$post['SegContacts']['phone'];?></div>
       </div>
    </div>
    <div class="clearfix"></div>
    <div>
     <center><img src="/template/design-1/icons/danke.svg" width="100%"></center>
    </div>
    <!-- /line-1 -->
    <div class="clearfix"></div>
    <!-- line-2 -->
    <div class="booking-form-head">
     <i class="step-number">2.</i> <strong><?= Yii::t('api','kont_inform'); ?></strong>
    </div>
    <div class="col-xs-12 blok_input_thankyou">
     <div class="col-sm-3 col-xs-6">
      <label>Name *</label>
      <input type="text" name="input_name" class="form-control sends" value="" data-send="0">
     </div>
     <div class="col-sm-3 col-xs-6">
      <label><?= Yii::t('api','cell_phone'); ?></label>
      <input type="hidden" name="input_phone"  value="" id="fh-1">
      <input type="text" name="phone" class="input_phone form-control sends" id="vh-1"  value="" data-send="0">
     </div>
     <div class="col-sm-6 col-xs-12">
       <label>E-Mail Adresse *</label><br>
       <input type="text" name="input_email" class="form-control sends" value="" data-send="0">
       <button type="button" class="btn bt-green bt_thankyou_plus"><i class="fa fa-plus"></i></button> 
       <button type="button" class="btn bt-green bt_thankyou_minus" disabled="disabled"><i class="fa fa-minus"></i></button>
     </div>
    </div>
    <!-- /line-2 -->
    <div class="clearfix"></div>
    <div class="col-xs-12" align="center"  style="margin-top:20px;">
     <button type="button" class="btn bt-green" id="bt_submit"><i class="fa fa-paper-plane"></i> <?= Yii::t('api','Tour_Info'); ?></button> 
    </div>              
   </form>
  </div>
  <!-- booking form -->
 </div>
</article>

<div class="clearfix"></div>

<!--phonecode-->
<link rel="stylesheet" href="/template/design-1/js/tel-input/build/css/intlTelInput.css?<?=date('dmYhis');?>">
<script src="/template/design-1/js/tel-input/build/js/intlTelInput.js"> </script>
<script>
function tel(x,y){
	$("#"+x).intlTelInput({
      // allowDropdown: false,
     autoHideDialCode: false,
     autoPlaceholder: false,
      //dropdownContainer: "body",
      // excludeCountries: ["us"],
      geoIpLookup: function(callback) {
        $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
           var countryCode = (resp && resp.country) ? resp.country : "de";
		   console.log(countryCode);
           callback(countryCode);
         });
       },
      initialCountry: "auto",
      nationalMode: false,
     // numberType: "MOBILE",
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      preferredCountries: ['de'],
      // separateDialCode: true,
      utilsScript: "/template/design-1/js/tel-input/build/js/utils.js"
    });
	////////
	$("#"+x).on('blur', function(){
		var tel = $(this).intlTelInput("getNumber");
		console.log(tel);
		$("#"+y).val(tel);
	}) 
}
function actTel(){
	$.each($("input.input_phone"),function(i,v){
		var idd = $(v).attr('id')
		idd = idd.split("-");
		var vh = 'vh-'+idd[1];
		var fh = 'fh-'+idd[1];
		tel(vh,fh);
	})
}

$(function(){
	//errorSubmit = 'Es muss korrekt in alle Felder ausfüllen';
	actTel();
    ///////
	//////
	$(".bt_thankyou_plus").on('click', function(){
		$("input.input_phone").intlTelInput("destroy")
		var $htm = $(this).parent().parent();
		$htm.clone(true).insertAfter($htm);
		//$(this).parent().parent().after(htm);
		$.each($(".input_phone"), function(i,v){
			 var n = i + 1;
			 $(v).attr('id','vh-'+n);
		})
		$.each($('input[name="input_phone[]"]'), function(i,v){
			 var n = i + 1;
			 $(v).attr('id','fh-'+n);
		})
		$.each($(".bt_thankyou_minus"), function(i,v){
			if(i!=0) $(v).removeAttr('disabled');
		})
		actTel();
	})
	///
	$(".bt_thankyou_minus").on('click', function(){
		$(this).parent().parent().remove();
	})
	////
	$("#bt_submit").on('click', function(){
		    var err = 1;
			var val = ''
			var te = 'no';
            $.each($(".sends"), function(i,v){
				//////check input
				$this = $(v);
				var name = $this.attr('name');
				val = $this.val();
				switch(name){
			       case 'input_name'  :  $this.parent().removeClass('has-success').addClass('has-error');
				                         err=1;
			                             if(val.length>3){ 
										    $this.parent().removeClass('has-error').addClass('has-success');
											te = val;
											err=0;
										 }
			       break;
			       case 'phone'       :  $this.parent().parent().removeClass('has-success').addClass('has-error');
				                         err=1;
			                             if(val.length>10){
											 $this.parent().parent().removeClass('has-error').addClass('has-success');
											 te = val;
											 err=0;
										 }
			       break;
			       case 'input_email' :  $this.parent().removeClass('has-success').addClass('has-error');
				                         err=1;
			                             if(/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,8}$/.test(val)){
										    $this.parent().removeClass('has-error').addClass('has-success');
											te = val;
											err=0;
										 }
			       break;
		        }
				////////////
				
			})
			console.log(err + ' ' +te);
			if(err==0){
				$.each($(".sends"), function(i,v){
					var name = $(v).attr('name');
					$(v).attr('name', name + '[]');
				})
			  $("#form-thankyou").submit();
			}
			else{
				
				alert('<?=YII::t("api","fields_required");?>')
			}
	})
})
</script>
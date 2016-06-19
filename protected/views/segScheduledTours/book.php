<?
//ini_set("display_errors",1);
//error_reporting(E_ALL);
if (!isset($model)) {
    $this->redirect(array('/' . $_REQUEST['cont']));
}
$city_en = $model->city_ob->webadress_en;
$city_name = $model->city_ob->seg_cityname;
$tnmax = $tour['TNmax'];
$ichel = '';
$sv = $model->current_subscribers;
if ($tnmax > 0) {
    $iibreak = round($tnmax / 2);
    for ($ii = 0; $ii < $tnmax; $ii++) {
        if ($ii == $iibreak) $ichel .= '<br>';
        if ($ii < $sv) $ichel .= '<i class="fa fa-user cblack"></i>';
        else $ichel .= '<i class="fa fa-user cgray"></i>';
    }
    if ($ii > 6) $ichel .= '</ul>';
    $rest = $tnmax;
    if ($sv > 0) $rest = $tnmax - $sv;
   $ichel .= '<br><strong>' . $rest . Yii::t('api', 'bt_freepl'); ' </strong>';
    $opt_guest = '';
    $n = 0;
    while ($n < $rest) {
        $n++;
        $opt_guest .= '<option value="' . $n . '">' . $n . '</option>';
    }
}
if (is_null($model->language_id)) {
    //$lang = Languages::model()->findAll();
    $lang = SegLanguagesGuides::model()->with('languages')->findAll('users_id=' . $model->guide1_id);
	$opt_lang ='';
    foreach ($lang as $val) {
        $sel = '';
        $opt_lang .= '<option value="' . $val->languages->id_languages . '" ' . $sel . '>' . $val->languages->germanname . '</option>';
    };
    $input_lang = '<select id="pick_lang" class="form-control" name="SegScheduledTours[language_id]">' . $opt_lang . '</select>';
} else {
    $input_lang = '<input type="text" id="pick_lang" disabled="true" class="form-control" value="' . $model->language_ob->germanname . '">';
}

?>
<header class="page-book">
    <nav id="navbar-mobile" class="navbar">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Menu</span><span class="icon-bar"></span><span class="icon-bar"></span><span
                        class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                 <img alt="Brand" src="/template/design-1/icons/svg-export_cherrytours-symbol-pink.svg" width="50" height="44">
                 <span><?= $city_name; ?></span>
                </a>
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
            <div id="back"><a href="/<?= $city_en; ?>"><i class="fa fa-chevron-left"></i> <span><?= Yii::t('api','zuruck'); ?></span></a></div>
            <div id="top-title"><strong><?= Yii::t('api', 'tourbook'); ?></strong></div>
        </div>
    </div>
    <div class="container">
       <div class="logotype">
        <a href="/">
         <img src="/template/design-1/icons/svg-export_cherrytours-symbol-white.svg" height="65" width="100%" >
         <strong>Cherrytours</strong>
        </a>
       </div>
       <div class="logotype-city"><?= $city_name; ?></div>
    </div>
</header>
<article class="container-fluid page-book" style="background-image:url(/template/design-1/images/main-<?= $city_en; ?>.jpg)">
    <div class="container">
        <!-- booking form -->
        <div id="booking-form">
            <form action="" method="post" class="clearfix" id="form-order">
                <input name="sid" id="sid" type="hidden" value="<?= $sid; ?>"/>
                <input name="tid" id="tid" type="hidden" value="<?= $tid; ?>"/>
                <div class="booking-form-head">
                    <i class="step-number">1.</i> <strong><?= Yii::t('api', 'Auswahl'); ?></strong>
                </div>
                <!-- line-1 -->
                <div class="col-md-3 col-xs-12 bform-line-1">
                    <div class="col-md-12 col-xs-6">
                        <img src="/image/guide/<?= $model->user_ob->guidepic; ?>"  width="80" class="img-circle profile-img">
                        <p style="padding-left:24px;"><span class="profile-name"><?= $model->user_ob->username; ?></span></p>
                    </div>
                    <div class="col-md-12 col-xs-6">
                        <?= $ichel; ?>
                    </div>
                </div>
                <div class="col-md-9 col-xs-12 bform-line-1">
                    <div class="col-xs-12">
                        <div class="col-xs-6">
                            <label><?= Yii::t('api', 'Stadt'); ?></label>
                            <input type="text" id="input_city" class="form-control" disabled="true"
                                   value="<?= $city_name; ?>">
                        </div>
                        <div class="col-xs-6">
                            <label>Tour</label>
                            <input type="text" id="input_tour" class="form-control" disabled="true"
                            <? //var_dump($tour); exit; ?>
                                   value="<?= $tour->name ?>">
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="col-sm-4 col-xs-6">
                            <label><?= Yii::t('api', 'Date'); ?></label>
                            <input type="text" id="input_date" class="form-control" disabled="true"
                                   value="<?= $this->dateEn($model->date); ?>">
                        </div>
                        <div class="col-sm-4 col-xs-6">
                            <label><?= Yii::t('api', 'Zeit'); ?></label>
                            <input type="text" id="input_time" class="form-control" disabled="true"
                                   value="<?= $this->timeShort($model->starttime); ?>">
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <label><?= Yii::t('api', 'Sprache'); ?></label>
                            <?= $input_lang; ?>
                        </div>
                    </div>
                </div>
                <!-- /line-1 -->
                <div class="clearfix"></div>
                <!-- line-2 -->
                <div class="booking-form-head">
                    <i class="step-number">2.</i> <strong><?= Yii::t('api', 'Kontaktdaten'); ?></strong>
                </div>
                <div class="line-3 clearfix" id="form-book">

                    <div class="col-md-12">
                        <p align="center" class="prim"><?= Yii::t('api', 'fields_required'); ?></p>
                        <div class="form-group col-sm-6"><label><?= Yii::t('api', 'firstname'); ?></label><input type="text"
                                                                                        class="form-control sends"
                                                                                        name="firstname" id="firstname">
                        </div>
                        <div class="form-group col-sm-6"><label><?= Yii::t('api', 'surname'); ?></label><input type="text"
                                                                                         class="form-control sends"
                                                                                         name="surname" id="surname">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group col-sm-6"><label><?= Yii::t('api', 'company'); ?></label><input type="text"
                                                                                    class="form-control sends"
                                                                                    name="additional_address"
                                                                                    id="additional_address"></div>
                        <div class="form-group col-sm-6"><label><?= Yii::t('api', 'street_house'); ?></label><input type="text"
                                                                                                 class="form-control sends"
                                                                                                 name="street"
                                                                                                 id="street"></div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group col-sm-6"><label><?= Yii::t('api', 'zip_code'); ?></label><input type="text"
                                                                                           class="form-control sends"
                                                                                           name="postalcode"
                                                                                           id="postalcode"></div>
                        <div class="form-group col-sm-6"><label><?= Yii::t('api', 'Stadt'); ?> *</label><input type="text"
                                                                                      class="form-control sends"
                                                                                      name="city" id="city"></div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group col-md-12"><label><?= Yii::t('api', 'country'); ?></label><input type="text"
                                                                                      class="form-control sends"
                                                                                      name="country" id="country"></div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group col-sm-6"><label>Email *</label><input type="text"
                                                                                      class="form-control sends"
                                                                                      name="email" id="email"></div>
                        <div class="form-group col-sm-6"><label><?= Yii::t('api', 'cell_phone'); ?></label><input name="phone" id="phone"
                                                                                            type="hidden" value=""
                                                                                            class="sends"><input
                                type="text" class="form-control" name="handynummer" id="handynummer"></div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group col-md-12 row_che">
                            <input type="checkbox" value="1" id="check_agb" name="check_agb">
                            <span><?= Yii::t('api', 'ich_stimme'); ?> <a href="javascript:;" id="open_agb"><?= Yii::t('api', 'terms'); ?></a> <?= Yii::t('api', 'zu'); ?></span>
                                    
                        </div>
                    </div>
                </div>
                <!--/line-2 -->
                <div class="clearfix"></div>
                <!--line-3-->
                <div class="booking-form-head">
                    <i class="step-number">3.</i> <strong><?= Yii::t('api', 'Book'); ?></strong>
                </div>
                <div class="col-sm-12 line-4">
                 <div class="col-md-3 col-xs-6">
                  <label><?= Yii::t('api', 'Guests'); ?></label>
                  <select id="pickperson" name="SegScheduledTours[current_subscribers]" class="svg-arrow">
                   <?= $opt_guest ?>
                  </select>
                 </div>
                 <div class="col-md-3 col-xs-6">
                  <label><?= Yii::t('api', 'price_per_person'); ?></label>
                  <p><strong><i class="fa fa-eur"></i> <span id="base-price"><?= number_format($tour->base_price, 2, '.', ' '); ?></span></strong></p>
                 </div>
                 <div class="col-md-3 col-sm-6 col-xs-12">
                  <label><?= Yii::t('api', 'Total_incl'); ?></label>
                  <p><strong><i class="fa fa-eur"></i> <span id="total-price"><?= number_format($tour->base_price, 2, '.', ' '); ?></span></strong></p>
                 </div>
                 <div class="col-md-3 col-sm-6 col-xs-12">
                  <button type="submit" class="btn btn-lg bt-green"><?= Yii::t('api', 'Book_now'); ?></button>
                 </div>
                </div>
                <!--/line-3-->
            </form>
        </div>
        <!-- booking form -->
    </div>
</article>

<div class="clearfix"></div>

<!-- modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal_agb">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-bordo">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">AGB der Cherrytours GmbH</h4>
            </div>
            <div class="modal-body">
                <p>test...Wir erheben, verarbeiten und nutzen Ihre Daten nur im Rahmen der gesetzlichen Bestimmungen.

                    Diese Datenschutzerklärung gilt ausschließlich für die Nutzung der von uns angebotenen Webseiten.
                    Sie gilt nicht für die Webseiten anderer Dienstanbieter, auf die wir lediglich durch einen Link
                    verweisen.

                    Bei der Nutzung unserer Webseiten bleiben Sie anonym, solange Sie uns nicht von sich aus freiwillig
                    personenbezogene Daten zur Verfügung stellen....</p>
            </div>
            <div class="modal-footer">
                <button class="btn bt-green" id="yes_agb">Einverstanden!</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--phonecode-->
<link rel="stylesheet" href="/template/design-1/js/tel-input/build/css/intlTelInput.css?<?= date('dmYhis'); ?>">
<script src="/template/design-1/js/tel-input/build/js/intlTelInput.js"></script>
<script src="/template/design-1/js/jquery.validate.min.js"></script>
<script>
    $(function () {
        $("#handynummer").intlTelInput({
            // allowDropdown: false,
            autoHideDialCode: false,
            autoPlaceholder: false,
            // dropdownContainer: "body",
            // excludeCountries: ["us"],
            geoIpLookup: function (callback) {
                $.get("http://ipinfo.io", function () {
                }, "jsonp").always(function (resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "";
                    //console.log(countryCode);
                    callback(countryCode);
                });
            },
            initialCountry: "auto",
            nationalMode: false,
            // numberType: "MOBILE",
            // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
            // preferredCountries: ['cn', 'jp'],
            // separateDialCode: true,
            utilsScript: "/template/design-1/js/tel-input/build/js/utils.js"
        })
        ////////
        $("#handynummer").on('blur', function () {
            var tel = $("#handynummer").intlTelInput("getNumber");
            $("#phone").val(tel)
        })
        /////
        $("#pickperson").on('change', function () {
            var val = $(this).val();
            var total = $("#base-price").text() * 1 * val;
            $("#total-price").text(total.toFixed(2));
        })
        ////

        $.validator.setDefaults({
            submitHandler: function (form) {
                //alert("submit form");
                $.each($(".sends"), function (i, v) {
                    var name = $(v).attr('name');
                    $(v).attr('name', 'SegContacts[' + name + ']');

                })
                form.submit()

            }
        });


        $("#form-order").validate({
            rules: {
                firstname: {
                    required: true,
                    minlength: 3
                },
                surname: {
                    required: true,
                    minlength: 3
                },
                street: {
                    required: true,
                    minlength: 3
                },
                city: {
                    required: true,
                    minlength: 3
                },
                country: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                handynummer: {
                    required: true,
                    minlength: 10
                },
                check_agb: "required"

            },

            messages: {
                firstname: {
                   required:"<?=YII::t("api","firstname_required");?>",
                    minlength: "<?=YII::t("api","required_3char");?>",
                },
                surname: {
                    required:"<?=YII::t("api","lastname_required");?>",
                    minlength: "<?=YII::t("api","required_3char");?>",
                },
               street: {
                     required:"<?=YII::t("api","housnum_required");?>",
                    minlength: "<?=YII::t("api","required_3char");?>",
                },
                city: {
                     required:"<?=YII::t("api","city_required");?>",
                    minlength: "<?=YII::t("api","required_3char");?>",
                },
                country: {
                    required:"<?=YII::t("api","country_required");?>",
                    minlength: "<?=YII::t("api","required_3char");?>",
                },
                handynummer: {
                    required:"<?=YII::t("api","phone_required");?>",
                    minlength: "<?=YII::t("api","required_10char");?>",
                },
                email: "<?=YII::t("api","email_required");?>",
                check_agb: "<?=YII::t("api","check_ag");?>"
            },

            errorElement: "em",
            errorPlacement: function (error, element) {
                error.addClass("help-block");
                element.parents(".form-group").addClass("has-feedback");
                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element);
                } else {
                    error.insertAfter(element);
                }
                if (!element.next("i")[0]) {
                    $('<i class="fa fa-times form-control-feedback"></i>').insertAfter(element);
                }
            },
            success: function (label, element) {
                if (!$(element).next("i")[0]) {
                    $('<i class="fa fa-check form-control-feedback"></i>').insertAfter($(element));
                }
            },
            highlight: function (element, errorClass, validClass) {
                $(element).parents(".form-group").addClass("has-error").removeClass("has-success");
                $(element).next("i").addClass("fa-times").removeClass("fa-check");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents(".form-group").addClass("has-success").removeClass("has-error");
                $(element).next("i").addClass("fa-check").removeClass("fa-times");
            }
        });


    })
</script>

	
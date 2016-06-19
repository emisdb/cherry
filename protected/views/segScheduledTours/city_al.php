<?
$data = $tours->search()->getData();

$city_name = $model->city_ob->seg_cityname;

$i = 1;
$zp = $gmap = $gmapdiv = '';
foreach ($data as $val) {
    if ($val['gmaps_lnk'] != '') {
        $gmap .= $zp . $i . ':"' . $val['gmaps_lnk'] . '"';
        $i++;
        $zp = ',';
    }
}
$gmap = '{' . $gmap . '}';
if ($gmap == '') {
    $gmapdiv = '<div>NOT MAP</div>';
}
?>

<!--<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js"></script>-->
<script type="text/javascript">
    label = {lat: 52.518343, lng: 13.342357};
    gmap = <?=$gmap;?>;

    /*
     function addMarker(location, map) {
     var marker = new google.maps.Marker({
     position: location,
     label: '',
     map: map
     });
     }
     function initialize() {
     var mapProp = {
     center: label, //new google.maps.LatLng(52.518343, 13.342357),
     zoom:13,
     disableDefaultUI:true,
     mapTypeId:google.maps.MapTypeId.ROADMAP
     };
     var map=new google.maps.Map(document.getElementById("google_map"), mapProp);
     addMarker(label, map);
     }
     */
    function gmaps(x) {
        $("#gmap-cont").attr('src', '').prev('.errorMap').remove();
        if (gmap[x]) {

            $("#gmap-cont").attr('src', gmap[x]);
        }
        else {
            $("#gmap-cont").before('<div class="errorMap">NOT MAP</div>');
        }
    }
    $(function () {
        //initialize();
        gmaps(1);
        var hash = window.location.hash;
        console.log(hash)
        switch (hash) {
            case '#classic':
                $('a[href="#info-tour1"]').trigger('click');
                break;
            case '#historical':
                $('a[href="#info-tour2"]').trigger('click');
                console.log('hist')
                break;
            case '#special':
                $('a[href="#a.info-tour3"]').trigger('click');
                break;
        }
    })

</script>

<nav id="navbar-mobile" class="navbar">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Menu</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../">
                <img alt="Brand" src="/template/design-1/icons/svg-export_cherrytours-symbol-pink.svg" width="50"
                     height="44">
                <span><?= $city_name; ?></span>
            </a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/berlin#classic">Classic Berlin</a></li>
                <li><a href="/munchen#classic">Classic München</a></li>
                <li><a href="/munchen#historical">Historical München</a></li>
            </ul>
        </div>
    </div>
</nav>
<header class="page-all-header"
        style="background:url(/template/design-1/images/<?= $model->city_ob->webadress_en; ?>350.jpg)">
    <div class="layout">


        <div class="container block-logo">
            <div class="logotype">
                <a href="../">
                    <img src="/template/design-1/icons/svg-export_cherrytours-symbol-white.svg" width="100%" height="65"
                         alt="logotype">
                    <strong>Cherrytours</strong>
                </a>
            </div>
            <div class="logotype-city"><?= $city_name; ?></div>
        </div>
    </div>
</header>

<div class="row top-menu">
    <!-- top-menu -->
    <div class="col-sm-3 col-xs-12">&nbsp;</div>
    <div class="col-sm-6 col-xs-12 top-menu-link">
        <ul class="nav nav-tabs" role="tablist">
            <? $this->renderPartial('_top_menu', array('data_tour' => $data)); ?>
        </ul>
    </div>
    <div class="col-sm-3 col-xs-12">&nbsp;</div>
    <!-- top-menu -->
</div>


<div class="clearfix"></div>

<article class="container-fluid">
    <div class="col-md-9 col-xs-12" style="float:right">
        <div class="col-md-8 col-sm-8 col-xs-12 tab-content">
            <? $this->renderPartial('_info_tour', array('data_tour' => $data)); ?>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12 info-detail">
            <? $this->renderPartial('_info_detail', array('data_tour' => $data)); ?>
        </div>
    </div>
    <div class="col-md-3 col-xs-12" id="google_map"
         style="height:240px; float:left; padding-left:0px; padding-right:0px;">
        <iframe src="" width="100%" height="240" frameborder="0" id="gmap-cont"><i class="fa fa-spinner fa-spin"></i>
        </iframe>
    </div>
</article>


<div class="clearfix"></div>

<div class="row row_str">
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
        <div class="col-sm-11 col-xs-12 pull-right search_str">
            <? $this->renderPartial('_form_search_tour', array('model' => $model)); ?>
        </div>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 list_tour_str">
        <? $this->renderPartial('_list_tour', array('data' => $data, 'model' => $model)); ?>
    </div>
</div>
<form action="<?= $model->city_ob->webadress_en . '/book'; ?>" method="post" id="f_book">
    <input name="book-params" id="book-params" type="hidden" value=""/>
    <input name="search-params" id="search-params" type="hidden" value=""/>
</form>
<div class="clearfix"></div>
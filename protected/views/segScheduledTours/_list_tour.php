<?
$i = $ct = 0;
$json_tour = array();

foreach ($data as $val) {

    $tid = $val['id_tour_categories'];
    $tnmax = $val['TNmax'];
    $dp = $model->search_f($tid);
    $pageSize = $dp->pagination->pageSize;
    $dp->pagination->pageSize = 999999;
    $list_data = $dp->getData();
    
    if (count($list_data) > 0) {
        $te = array();
        $str = 0;
        foreach ($list_data as $n => $item) {
			//var_dump($item); exit;
            @$name_user = $item->user_ob->username;
			
            $date_tour = date("d.m.Y", $item->date_now);
            @$rec = User::model()->with(array('guide_ob', 'contact_ob'))->findByPk($item->user_ob->id);
            @$quide_contact = '<h4>' . $rec->guide_ob->guide_shorttext . '</h4><br>' . $rec->guide_ob->guide_maintext;
            $flag_img = array();
            $zp_fl = 0;
            if ($item->language_id == null) {
                foreach ($item->user_ob->languages as $la) {
                    $flag_img[$zp_fl] = $la['flagpic'];
                    $zp_fl++;
                }
            } else {
				//var_dump($item->language_ob); exit;
				$flag_img[$zp_fl] = $item->language_ob["flagpic"];
            }
            $ichel = '<div>';
            if ($tnmax > 0) {
                $iibreak = round($tnmax / 2);
                for ($ii = 0; $ii < $tnmax; $ii++) {
                    if ($ii == $iibreak) $ichel .= '</div><div>';
                    if ($ii < $item->current_subscribers) $ichel .= '<i class="fa fa-user cblack"></i>';
                    else $ichel .= '<i class="fa fa-user cgray"></i>';
                }
                if ($ii > 6) $ichel .= "</div>";
                $rest = $tnmax;
                if ($item->current_subscribers > 0) $rest = $tnmax - $item->current_subscribers;
                $ichel .= '<div>' . $rest . Yii::t('api', 'bt_freepl'); '</div>';
            }
            //// вывод JSON
			$gmt =@$rec->guide_ob->guide_maintext;
			$gst = @$rec->guide_ob->guide_shorttext;
			if (Yii::app()->language == 'en'){
				$gmt =@$rec->guide_ob->guide_maintext_En;
			    $gst = @$rec->guide_ob->guide_shorttext_En;
			}
            $te[$str] = array(
                "img" => @$item->user_ob->guidepic,
                "name" => $name_user,
                "flag" => $flag_img,
                //"date" => CHtml::encode(date('l, d F Y', $item->date_now)),
				"date" => Yii::app()->dateFormatter->format('EEEE, dd MMMM yyyy',$item->date_now),
                "time" => CHtml::encode(substr_replace($item->starttime, '', 5)),
                "guest_all" => $tnmax,
                "guest" => $rest,
                "contact_short" => $gst,
                "contact_main" => $gst,
                "bt_val" => $item->idseg_scheduled_tours . ',' . $tid
            );
            $str++;

        }//foreach2
        $json_tour['tid' . $tid] = $te;

    }
    $i++;
}//foreach1

$json_tour = json_encode($json_tour);

?>
<script type="text/javascript">
    var div_str = '';
    var json_tour = <?=$json_tour;?> ;
    var pageSize = <?=$pageSize;?>;
    function sendBook(x) {
        var val = $(x).attr("data-val");
        var mv = val.split(',');
        var zp = '';
        var str = '';
        $.each($('.sends'), function (i, v) {
            var val = $(v).val();
            var name = $(v).attr('name');
            name = name.replace('SegScheduledTours[', '');
            name = name.replace(']', '');
            str += zp + '"' + name + '":"' + val + '"';
            zp = ',';
        })
        var str_book = '{"sid":' + mv[0] + ',"tid":' + mv[1] + '}';
        var str_search = '{' + str + '}';
        $("#book-params").val(str_book);
        $("#search-params").val(str_search);
        $("#f_book").submit();
    }
    ///
    function modalGuide(x) {
        var $contact = $(x).prev();
        var $img = $(x).children('img');
        $("#work-modal-header").html('Info');
        var htm = '<div class="pull-left col-xs-4"><img src="' + $img.attr('src') + '">' +
            '</div><div class="pull-left col-xs-8">' + $contact.html() + '</div>' +
            '<div class="clearfix"></div>'
        $("#work-modal-body").html(htm);
        $("#work-modal").modal('show');
    }
    /////
function generateList() {
    /////
    var me = Object.keys(json_tour).length;
    if(me==0) {
        div_str = '<div class="col-sm-8 col-xs-12 list-str-none"><?= Yii::t('api','Noresults'); ?></div>';
    }
    var nn = 0;
    var tt = 0;
    var st = '';
    $.each(json_tour, function (i, v) {
        var le = Object.keys(v).length;
        nn++;
        var btDop = '<div class="col-lg-8 col-md-11 col-sm-12 col-xs-12 footer-button">' +
            '<button type="button" class="btn btn-default bt-white bt-page-book" data-tab="1">' +
            '<?= Yii::t('api', 'bt_Show_more'); ?></button></div>';
        var div = '<div class="tab-dop" id="list-tour' + nn + '" ' + st + '>';
        if (le > 0) {
            var dispNone = '';
            tt = 0;
            $.each(v, function (i, v) {
                tt++;
				if (i >= pageSize) dispNone = 'style="display:none" data-disp="0"';

                ///flag
                var flag = '';
                $.each(v.flag, function (i, v) {
                    flag += '<img src="/img/lan/' + v + '">'
                })
                ///guest
                var chel = ichel = '';
                var nmax = v.guest_all;
                var po = Math.ceil(nmax / 2);
                var ost = nmax - v.guest;
                var dis = ' disabled ';
                if (v.guest>0) dis = '';

                for (var s = 0; s < nmax; s++) {
                    if (s == po) ichel += '<br>';
                    if (s >= ost) ichel += '<i class="fa fa-user cgray"></i>';
                    else ichel += '<i class="fa fa-user cblack"></i>';
                }
                chel = '<div>' + v.guest + '  <?= Yii::t('api', 'bt_freepl'); ?></div>';
                ////
                div += '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 str" ' + dispNone + '>' +
                    '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-5">' +
                    '<div style="display:none;" class="guide_contact"><h4>' + v.contact_short + '</h4><br>' + v.contact_main + '</div>' +
                    '<div class="str-foto guide_img">' +
                    '<img src="/image/guide/' + v.img + '">' +
                    '</div>' +
                    '<div class="str-lang">' +
                    '<div>' + v.name + '</div>' +
                    '<div>' + flag + '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-6 col-md-5 col-sm-6 col-xs-7 str-date-time">' +
                    '<div class="col-md-7 col-sm-12 col-xs-6 str-date">' +
                    '<div><img src="/template/design-1/icons/svg-export_calendar-grey.svg">' + v.date + '</div>' +
                    '<div><img src="/template/design-1/icons/svg-export_time-grey.svg">' + v.time + '</div>' +
                    '</div>' +
                    '<div class="col-md-5 col-sm-12 col-xs-6 str-client">' + ichel + chel + '</div>' +
                    '</div>' +
                    '<div class="col-md-3 col-sm-12 col-xs-12 str-button">' +
                   '<div><button type="button" class="btn bt-green bt-book" data-val="' + v.bt_val + '" ' + dis + '><i class="fa fa-chevron-right"></i><span><?= Yii::t('api', 'bt_Select'); ?></span></button></div>' +

                    '</div>' +
                    '</div>';
            })
        }
        else{
            div +='<div class="col-sm-8 col-xs-12 list-str-none"><?= Yii::t('api','Noresults'); ?></div>';
        }
        st = 'style="display:none"';
        if (tt < 6) {
            btDop = '';
        }
        div += btDop + '</div>'
        div_str += div;
    })
   // document.write(div_str);
    $(".list_tour_str > script").after(div_str);
}
    $(function () {
        generateList();
//////
        $('a[role="tab"]').on('click', function () {
            var num = $(this).attr('data-num');
            $("div.tab-dop").hide();
            $("#tab-info-detail" + num).show();
            $("#list-tour" + num).show();
            $(".bt-page-book").attr('data-tab', num);
            gmaps(num);
        })
        ///
        $(".guide_img").on('click', function () {
            modalGuide(this);
        })
        ////////
        $("button.bt-book").on('click', function () {
            sendBook(this);
        })
        ////
        $(".bt-page-book").on('click', function () {
            var num = $(this).attr('data-tab');
            var vis = 0;

            $.each($('#list-tour' + num + ' .str[data-disp="0"]'), function (i, v) {
                vis++;
                if (i < pageSize) {
                    $(v).removeAttr('style').removeAttr('data-disp');
                }
            })
            if (vis < pageSize) {
                $(this).css('display','none');
            }
        })
//////
    })
</script>
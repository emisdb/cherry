/*
setInterval(function () {
    var $img = $('header.big-img');
    $img.toggleClass('bg-2');
}, 6000);
*/

/////
$(function () {

    $(".top-menu-link li").on('click', function () {
        console.log('img')
        var $this = $(this);
        var $img = $this.children().children('img');
        $.each($(".top-menu-link li img"), function (i, v) {
            var svg = $(v).attr('data-svg');
            if (svg != $img.attr('data-svg')) {

                $(v).attr('src', '/template/design-1/icons/' + svg + '-d593a4.svg');
            }
        })
    })
    $(".top-menu-link li").hover(
        function () {
            var $this = $(this);
            var $img = $this.children().children('img');
            if (!$(this).hasClass('active')) {
                var svg = $img.attr('data-svg');
                $img.attr('src', '/template/design-1/icons/' + svg + '-fff.svg');
            }
        },
        function () {
            var $this = $(this);
            var $img = $this.children().children('img');
            if (!$(this).hasClass('active')) {
                var svg = $img.attr('data-svg');
                $img.attr('src', '/template/design-1/icons/' + svg + '-d593a4.svg');
            }
        }
    );

    ///
    jQuery.datetimepicker.setLocale('de');
    jQuery('#pickdate, #pickdate-main').datetimepicker({
        format: 'd.m.Y',
        formatDate: 'd.m.Y',
		//minDate:0,
        timepicker: false
    })
    /*
     var dt = new Date();
     var dtt = dt.toLocaleDateString();
     $("#pickdate, #pickdate-main").val(dtt);
     */

    /////
	/*
    $("#open_agb").on('click', function () {
        //$("#modal_agb").modal('show')
		
    })
	*/
	$.each($(".bottom_link"),function(i,v){
		var text = $(v).text();
		var plink = $(v).attr('href');
		//console.log(text)
		if(text.indexOf('AGB') + 1){
			$("#open_agb").attr('href',plink);
		}
	})
	
	
    ////
	/*
    $("#yes_agb").on('click', function () {
        $("#modal_agb").modal('hide');
        $("#check_agb").prop('checked', true);
    })
	*/
    //////
    $("#pickcity-main").on('change', function () {
        var city = $("#pickcity-main option:selected").attr("data-city");
        if (city != 0) {
            $("#search-form-main").attr('action', city);
            $("#index-submit").removeAttr('disabled');
        }
        else {
            $("#search-form-main").attr('action', city);
            $("#index-submit").attr('disabled', true);
        }
    })
    /////
    $('a[role="tab"]').on('click', function () {
        var num = $(this).attr('data-num');
        $("div.tab-dop").hide();
        $("#tab-info-detail" + num).show();
        $("#list-tour" + num).show();
        gmaps(num);
        strnum = 1;
    })
    /////
    $("#pickcity").on('change', function () {
        var city = $("option:selected", this).attr('data-city');
        if (city != '') {
            location.href = '/' + city;//+'#pickcity';
        }
    })
	///////
	$(".article-content h2").on('click', function () {
		if($(window).width() < 768)
		$(".article-content p").toggle('fast');
	})
    /*
     $(".guide_img").on('click', function(){
     modalGuide(this);
     })
     ////////
     $("button.bt-book").on('click', function(){
     sendBook(this);
     })
     */
    ///////////
    /*
     $(".bt-page-book").on('click', function(){
     countrec --;
     strnum ++;
     var $this = $(this);
     var tid = $this.attr('data-tid');
     var total = $this.attr('data-total');
     var pagesize = $this.attr('data-pagesize');
     //var itemcount = $this.attr('data-itemcount');
     var str = Math.ceil(total / pagesize);
     //if(strnum==0) alert('not found');
     console.log('осталось: ' + countrec);

     $this.html('<i class="fa fa-spinner fa-spin"></i>').attr('disabled',true);
     $.post("/ajaxSearchTours",
     {
     action:'getTours',
     tid:tid,
     page:strnum,
     tnmax:tnmax
     },
     function(data){
     var jo = jQuery.parseJSON(data);

     if(countrec == 0) $this.hide();
     ///
     $.each(jo.data, function(i,v){

     var guide_contact = '<h4>' + v.shorttext +'</h4><br>'+ v.maintext
     var htm_last = $this.parent().prev().clone();
     ///str_foto
     var str_foto = '<img src="/image/guide/'+v.foto_guide+'" >';
     ///str_lang
     var flag = '';
     $.each(v.flag_img, function(i,v){
     flag += '<img src="img/lan/'+v+'">'
     })
     var str_lang = '<div>'+v.name_guide+'</div><div>'+flag+'</div>';
     ///str_date
     var str_date = '<div><img src="/template/design-1/icons/svg-export_calendar-grey.svg">'+v.date_tour + '</div>' +
     '<div><img src="/template/design-1/icons/svg-export_time-grey.svg">'+v.time_tour + '</div>';
     ///str_client
     var nr = Math.floor(v.tnmax / 2);
     var re = v.tnmax - v.rest;
     var iclient = '<div>';
     for(var i=1; i<=v.tnmax; i++){

     if(i>re) iclient += '<i class="fa fa-user cgray"></i>'
     else iclient += '<i class="fa fa-user cblack"></i>'

     if(i==nr) iclient += '</div><div>'
     }
     iclient += '</div><div>'+v.rest+' Freie Plätze</div>';
     var str_client = iclient;
     ////
     var str_button = '';
     if(v.rest>0){
     str_button = '<div><button type="button" class="btn btn-success bt-green bt-book" data-val="'+v.id_tour+','+tid+'"><i class="fa fa-chevron-right"></i><span>Auswählen</span></button></div>';
     }
     ///
     $this.parent().prev().after(htm_last);
     $this.parent().prev().find('.guide_contact').html(guide_contact);
     $this.parent().prev().find('.str-foto').html(str_foto);
     $this.parent().prev().find('.str-lang').html(str_lang);
     $this.parent().prev().find('.str-date').html(str_date);
     $this.parent().prev().find('.str-client').html(str_client);
     $this.parent().prev().find('.str-button').html(str_button);
     })//each
     //
     $("button.bt-book").on('click', function(){ sendBook(this); });
     $(".guide_img").on('click', function(){ modalGuide(this); })
     $this.html('Merh anzeigen').removeAttr('disabled');
     });//post

     })
     */

////	
})
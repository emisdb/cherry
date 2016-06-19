<!DOCTYPE html>
<html lang="<?= Yii::app()->language; ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/fav.ico" type="image/x-icon">
    <title><?= CHtml::encode(Yii::t('main', 'Cherrytours')); ?></title>
    <link href="/template/design-1/css/bootstrap-3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/template/design-1/css/fontawesome/css/font-awesome.min.css">
    <link href="/template/design-1/css/style.css?<?= date('dmYhis'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="/template/design-1/js/countrySelect/css/countrySelect.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="/template/design-1/js/jquery-1.11.1.min.js"></script>
    <!--datetimepicker-->
    <link rel="stylesheet" type="text/css" href="/template/design-1/js/datetimepicker/css/jquery.datetimepicker.css"
    / >
    <script type="text/javascript"
            src="/template/design-1/js/datetimepicker/jquery.datetimepicker.full.min.js"></script>
    <script src="/template/design-1/css/bootstrap-3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/template/design-1/js/custom.js"></script>
</head>
<body>
<?= $content; ?>
<footer>
    <div class="container">
        <nav id="footer-nav">
            <ul class="nav-justified">
                <li><a href=""><?= Yii::t('api', 'bt_aboutus'); ?></a></li>
                <li><a href="">Presse</a></li>
                <li><a href="">AGB’s und Datenschutz</a></li>
                <li><a href=""><?= Yii::t('api', 'contact'); ?></a></li>
                <li>
                    <input type="text" id="select_lang" readonly>
                </li>
            </ul>
        </nav>
        <div class="clearfix"></div>
        <div class="logotype">
            <a href="../"><img src="/template/design-1/icons/svg-export_cherrytours-symbol-white.svg" width="100%"
                               height="65" alt="logotype-img"><strong>Cherrytours</strong></a>
        </div>
    </div>
    <section id="social">
        <div class="container">
            <ul id="social-links">
                <li><a id="facebook" href=""><img src="/template/design-1/icons/svg-export_facebook-white.svg"
                                                  width="100%" height="80" alt=""></a></li>
                <li><a id="twitter" href=""><img src="/template/design-1/icons/svg-export_twitter-white.svg"
                                                 width="100%" height="80" alt=""></a></li>
                <li><a id="instagram" href=""><img src="/template/design-1/icons/svg-export_instagram-white.svg"
                                                   width="100%" height="80" alt=""></a></li>
            </ul>
        </div>
    </section>
</footer>
<!-- modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="work-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-bordo">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="work-modal-header">Заголовок</h4>
            </div>
            <div class="modal-body" id="work-modal-body">
                <p>Модальное окно тест</p>
            </div>
            <!--<div class="modal-footer"></div>-->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="text/javascript" src="/template/design-1/js/countrySelect/js/countrySelect.min.js"></script>
<script type="text/javascript">

    $("#select_lang").countrySelect({
        defaultCountry: "<?=Yii::app()->language;?>",
        onlyCountries: ['de', 'en'],
        preferredCountries: []
    });
    $("#select_lang").on('change', function () {
        var lang = $(this).val();

        switch (lang) {
            case 'Deutsch':
                location.href = "http://<?=Yii::app()->params['site_de'];?>";
                break;
            case 'English':
                location.href = "http://<?=Yii::app()->params['site_en'];?>";
                break;
        }
    })

</script>
</body>
</html>
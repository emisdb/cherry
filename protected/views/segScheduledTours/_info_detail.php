<?
$i = 1;
foreach ($data_tour as $val) {
    $active = $none = '';
    if ($i > 1) {
        $none = 'style="display:none;"';
    }
    $meetingpoint = $val['meetingpoint_description'];
    if (Yii::app()->language == 'en') $meetingpoint = $val['meetingpoint_description_en'];
    ?>
    <div id="tab-info-detail<?= $i; ?>" class="tab-dop" <?= $none; ?>>
        <div>
            <img src="/template/design-1/icons/svg-duration-d593a4.svg"
                 height="80"><span><?= $val['standard_duration']; ?> min</span>
        </div>
        <div>
            <img src="/template/design-1/icons/svg-euro-d593a4.svg"
                 height="80"><span><?= number_format($val['base_price'], 2, '.', ' '); ?><?= Yii::t('api', 'incl'); ?></span>
        </div>
        <div>
            <img src="/template/design-1/icons/svg-pin-d593a4.svg" height="80"><span><?= $meetingpoint; ?></span>
        </div>
    </div>
    <?
    $i++;
}
?>
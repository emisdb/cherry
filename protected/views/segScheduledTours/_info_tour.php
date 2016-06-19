<?
$i = 1;
foreach ($data_tour as $val) {
    $active = '';
    if ($i == 1) {
        $active = 'active';
    }
	$shorttext = $val['shorttext'];
	$maintext = $val['maintext'];
	if (Yii::app()->language == 'en'){
		$shorttext = $val['shorttext_en'];
	    $maintext = $val['maintext_en'];
	}
	if($shorttext ==''){
		$shorttext = 'No description of the tour :(';
	}
    ?>
    <div role="tabpanel" class="tab-pane <?= $active; ?>" id="info-tour<?= $i; ?>">
        <div class="article-content">
            <img src="/template/design-1/icons/svg-info-d593a4.svg">
            <h2><?= $shorttext; ?></h2>
            <p><?= $maintext; ?></p>
        </div>
    </div>
    <?
    $i++;
}
?>
<?php
$this->breadcrumbs=array(
	'Scheduled Tours'=>array('segScheduledTours/admin'),
	'Guides infos',
);
?>


<div class="guide-info-name">Gonorar</div>
<? $x1=number_format($gonorar_tour->base_provision, 2, '.', ' ');
$x2=number_format($gonorar_tour->guestsMinforVariable, 2, '.', ' ');
$x3=number_format($gonorar, 2, '.', ' '); ?>
<table class="table-info-guide">
	<tr>
    	<td colspan="2">Base honorarium:</td>
        <td class="table-info-guide-last"><? echo $x1;?>  &euro;</td>
    </tr>
	<tr>
    <td>Guest Number Variable</td>
        <td><? echo $cifra;?>x</td>
        <td class="table-info-guide-last"><? echo $x2;?>  &euro;</td>
    </tr>
    <tr>
    	<td colspan="2">Total fees:</td>
        <td class="table-info-guide-last"><? echo $x3;?>  &euro;</td>
    </tr>
    <tr>
    	<td colspan="3">(including <? echo $vat;?>% vat)</td>
    </tr>
</table>

<div class="guide-info-name">Kassa</div>
<?php if (!empty($cash)){  $y1=number_format($cash, 2, '.', ' ');
    $y2=number_format($cashincome, 2, '.', ' ');
    
    $y4=number_format($cashincome - $x3, 2, '.', ' ');
    $y5=number_format($cash + $cashincome - $x3, 2, '.', ' ');
 } 
 else 
	 {  $y1=number_format(0+0, 2, '.', ' ');
    $y2=number_format($cashincome, 2, '.', ' ');
    
    $y4=number_format($cashincome - $x3, 2, '.', ' ');
    $y5=number_format($cashincome - $x3, 2, '.', ' ');
 }?>
    <table class="table-info-guide">
        <tr>
            <td>Cash old:</td>
            <td class="table-info-guide-last"><? echo $y1;?>  &euro;</td>
        </tr>
        <tr>
            <td>Cash receipts</td>
            <td class="table-info-guide-last"><? echo $y2;?>  &euro;</td>
        </tr>
        <tr>
            <td>Total fees</td>
            <td class="table-info-guide-last"><? echo $x3;?>  &euro;</td>
        </tr>
        <tr>
            <td>Cash sanderung</td>
            <td class="table-info-guide-last"><? echo $y4;?>  &euro;</td>
        </tr>
        <tr>
            <td>Cash new: </td>
            <td class="table-info-guide-last"><? echo $y5;?>  &euro;</td>
        </tr>
    </table>

    <!-- *********************** BUTTINS ***************************************************************-->
	<?php if(!(isset($ajax)&&$ajax)): ?>
<div class="row buttons">
        <button class="btn btn-primary cancel">
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/segGuidestourinvoicescustomers/current/id_sched/<? echo $id_sched;?>/date/<? echo $date; ?>/time/<? echo $time; ?>">
		<?php echo 'Back'; ?>
        </a>
        </button>
</div>
	<?php	endif; ?>


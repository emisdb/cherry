<div class="guide-info-name">Honorar</div>
<?php
$x1=number_format($gonorar_tour->base_provision, 2, '.', ' ');
$x2=number_format($gonorar_tour->guestsMinforVariable, 2, '.', ' ');
$x3=number_format($gonorar, 2, '.', ' '); 
?>
<table class="table-info-guide">
	<tr>
    	<td colspan="2">Basishonorar:</td>
        <td class="table-info-guide-last"><? echo $x1;?>  &euro;</td>
    </tr>
	<tr>
    <td>Gastanzahl Variable:</td>
        <td><?php echo $cifra;?>x</td>
        <td class="table-info-guide-last"><? echo $x2;?>  &euro;</td>
    </tr>
    <tr>
    	<td colspan="2">Gesamthonorar:</td>
        <td class="table-info-guide-last"><? echo $x3;?>  &euro;</td>
    </tr>
    <tr>
    	<td colspan="3">
        <?php
            if($vattype==1) echo "(Inklusive ".$vat."% Ust; Umsatzsteuer:".$gonorar_vat." &euro;)"; 
            else echo "exklusive Umsatzsteuer <br> (umsatzsteuerfrei nach ".$gonorar_vat." &euro; Abs. 1)"       
        ?>
        </td>
    </tr>
</table>

<div class="guide-info-name">Kassenbestand</div>
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
            <td>Kassenbestand alt:</td>
            <td class="table-info-guide-last"><? echo $y1;?>  &euro;</td>
        </tr>
        <tr>
            <td>Bareinnahmen:</td>
            <td class="table-info-guide-last"><? echo $y2;?>  &euro;</td>
        </tr>
        <tr>
            <td>Gesamthonorar:</td>
            <td class="table-info-guide-last"><? echo $x3;?>  &euro;</td>
        </tr>
        <tr>
            <td>Kassenbestandsänderung:</td>
            <td class="table-info-guide-last"><? echo $y4;?>  &euro;</td>
        </tr>
        <tr>
            <td>Kassenbestand neu: </td>
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


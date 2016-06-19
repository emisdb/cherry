  
<?
$i=1;
foreach($data_tour as $val){
?>
 <iframe style="position:relative; top:-55px; border:none;" src="<?=$val['gmaps_lnk'];?>" width="300" height="300" frameborder="0" id="gmaps<?=$i;?>" style="display:none;" class="gmaps"></iframe>
<?
 $i++;
}
?>

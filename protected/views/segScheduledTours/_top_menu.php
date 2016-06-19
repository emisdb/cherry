<?
$i=1;
foreach($data_tour as $val){
	$active='';
	switch($val['id_tour_categories']){
	   case 1 : $img = '/template/design-1/icons/svg-classic-fff.svg';
	            $svg = 'classic';
				$active='active';
	   break;
	   case 2 : $img = '/template/design-1/icons/svg-historical-d593a4.svg';
	            $svg = 'historical';
	   break;
	   case 3 : $img = '/template/design-1/icons/svg-special-d593a4.svg';
	            $svg = 'special';
	   break;
	   $svg = strtolower($val['name']);	
	}
?>
       <li class="col-sm-4 col-xs-4 <?=$active;?>">
        <a href="#info-tour<?=$i;?>" aria-controls="info-tour<?=$i;?>" role="tab" data-toggle="tab" data-num="<?=$i;?>">
         <img src="<?=$img;?>" data-svg="svg-<?=$svg;?>">
         <div><?=$val['name'];?></div>
         <span class="top-menu-link-caret"><i class="fa fa-caret-down"></i></span>
        </a>
       </li>
<?
 $i++;
}
?>
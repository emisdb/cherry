
<table class='table' >
<tr>
<td>Zeitintervall</td>
<td>Startzeit</td>
<td>STATUS</td>
<td>Aktion</td>
</tr>
<?php foreach($model as $item){?>
    <tr>
    <td><?php echo $item->time;?></td>
    <td><?php echo $item->starttime;?></td>
    <td><?php echo $item->status;?></td>
    <td><?php if($item->status=='frei!'){
         echo CHtml::link("Eintragen",array('guide/take', 'date'=>$item->date, 'time'=>$item->time));
//
//		 		 drawdd($date,$item->time);
   }
	 else {        
        if(substr($item->status,0,5)=='Keine') {
//			if($item->status =='Block after')
//				drawdd($date,$item->time);
//			else 
				echo $item->status."\n";
		}
		else{  
                    if(substr($item->status,0,7) =='Belegt,')
                    {
                        echo CHtml::ajaxLink(
                            "Zeige",
                            $url=array('ajaxShow'),
                            $ajaxOptions= array(
                           'data'=>array('id'=>$item->id),
                             'type'=>'POST',
                                    'success'=>'function(html){ jQuery("#modal-data").html(html);  $("#guideModal").modal("show");return true;}',
               ///             'complete' => 'return true;'
                                                )	  
               //             $htmlOptions=array("data-toggle"=>"modal","data-target"=>"#guideModal" )
                    );                       
                  }
                  else
                   {
                        echo CHtml::ajaxLink(
                            "Zeige",
                            $url=array('ajax_Show'),
                            $ajaxOptions= array(
                           'data'=>array('id'=>$item->id),
                             'type'=>'POST',
                                    'success'=>'function(html){ jQuery("#modal-data").html(html);  $("#guideModal").modal("show");return true;}',
               ///             'complete' => 'return true;'
                                                )	  
               //             $htmlOptions=array("data-toggle"=>"modal","data-target"=>"#guideModal" )
                    );                       
                  }

//		if($item->status =='Belegt') drawdd($date,$item->time);

		}
	}?>
    </td>
  
    
    </tr>
<?php }?>
</table>

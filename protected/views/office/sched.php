<?php $this->renderPartial('_top', array('info'=>$info)); ?>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
<h1>Update ScheduledTours <?php echo $model->idseg_scheduled_tours; ?></h1>
     </section>

        <!-- Main content -->
        <section class="content">

    <?php 
 
            $this->renderPartial('_form_schedo',
		array('model'=>$model, 
                    'routs'=>$routs,
                    'languages'=>$languages,
                    'guides'=>$guides)); 
    ?>
		</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
    <script type="text/javascript">
      <?php
          echo "var routs=".json_encode($routs).";\n";
          echo "var langs=".json_encode($languages).";\n";
          echo "var guides=".json_encode($guides).";\n";
    ?>
        
$(document).ready ( function (){
});
function do_route(val)
{
    var ix, found;
    for(ix=0;ix<routs.length;ix++)
    {
        if(routs[ix][0]==val)
        {
            var selectobject=document.getElementById("guide");
            
            rguis=routs[ix][2];
            for (var i=0; i<selectobject.options.length; i++){
                if(selectobject.options[i].value==""){
                    selectobject.options[i].selected=true;
                    continue;
                }
                found=false;
                for(ixx=0;ixx<rguis.length;ixx++)
                {
                     if(selectobject.options[i].value==rguis[ixx][0]){
                         found=true;
                     }
                 }
                 if(!found) selectobject.options[i].style.display='none';
                 else  selectobject.options[i].style.display='block';
            }
        }
    }
}
function do_lang(val)
{
    alert(val);
}
function do_guide(val)
{
    alert(val);
}
</script>

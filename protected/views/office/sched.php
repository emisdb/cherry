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
    var ix, found, nix, ixx;
    var rguis, rlans;
    var guide_i=document.getElementById("guide");
    var lang_i=document.getElementById("language");
    var guide_v=guide_i.value;
    var lang_v=lang_i.value;
     for(ix=0;ix<routs.length;ix++)
    {
        if(routs[ix][0]==val)
        {
            
            rguis=routs[ix][2];
            rlans=routs[ix][3];
            for (var i=0; i<guide_i.options.length; i++){
                if(guide_i.options[i].value==""){
                    nix=i;
                    continue;
                }
                found=false;
                for(ixx=0;ixx<rguis.length;ixx++)
                {
                     if(guide_i.options[i].value==rguis[ixx]){
                         found=true;
                         break;
                     }
                 }
                 if(found) guide_i.options[i].style.display='block';
                 else {
                     guide_i.options[i].style.display='none';
                     if(guide_i.options[i].value==guide_v){
                          guide_i.options[nix].selected=true;
                     }
 
                 }
            }
           for (var i=0; i<lang_i.options.length; i++){
                if(lang_i.options[i].value==""){
                    nix=i;
                    continue;
                }
                found=false;
                for(ixx=0;ixx<rlans.length;ixx++)
                {
                     if(lang_i.options[i].value==rlans[ixx]){
                         found=true;
                         break;
                     }
                 }
                 if(found) lang_i.options[i].style.display='block';
                 else {
                     lang_i.options[i].style.display='none';
                     if(lang_i.options[i].value==lang_v){
                          lang_i.options[nix].selected=true;
                     }
 
                 }
            }
            break;
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

<?php $this->renderPartial('_top', array('info'=>$info)); ?>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
<h1>Update ScheduledTours <?php echo $model->idseg_scheduled_tours; ?></h1>
     </section>

        <!-- Main content -->
        <section class="content">

    <?php 
		print_r($tours_guide);
 
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
function do_route(val,where)
{
    var ix, nix, ig,jg,il,jl;
    var rguis, rlans, x_a;
	var guide_i;
    var lang_i;
	switch(where)
	{
		case 0:
			x_a=routs;
			guide_i=document.getElementById("guide");
			lang_i=document.getElementById("language");
			ig=1; jg=2; il=2; jl=2;
			break;
		case 1:
			x_a=langs;
			guide_i=document.getElementById("guide");
			lang_i=document.getElementById("route");
			ig=0; jg=2; il=2; jl=3;
			break;
		case 2:
			x_a=guides;
			guide_i=document.getElementById("language");
			lang_i=document.getElementById("route");
			ig=0; jg=3; il=1; jl=3;
			break;
	}
    var guide_v=guide_i.value;
    var lang_v=lang_i.value;
 	if (val==""){
	           for (var i=0; i<guide_i.options.length; i++){
					if(checkarr(ig,jg,guide_i.options[i].value))
						guide_i.options[i].style.display='block';
			   }
            for (var i=0; i<lang_i.options.length; i++){
					if(checkarr(il,jl,lang_i.options[i].value))
						lang_i.options[i].style.display='block';
			   }
 	
	}
	else{
     for(ix=0;ix<x_a.length;ix++)
    {
        if(x_a[ix][0]==val)
        {
            
            rguis=x_a[ix][2];
            rlans=x_a[ix][3];
            for (var i=0; i<guide_i.options.length; i++){
                if(guide_i.options[i].value==""){
                    nix=i;
                    continue;
                }
				if(rguis.indexOf(guide_i.options[i].value)<0)
				{
                    guide_i.options[i].style.display='none';
                     if(guide_i.options[i].value==guide_v){
                          guide_i.options[nix].selected=true;
                     }
				}
				else
				{
					if(checkarr(ig,jg,guide_i.options[i].value))
						guide_i.options[i].style.display='block';
					else
					{
						guide_i.options[i].style.display='none';
						 if(guide_i.options[i].value==guide_v){
							  guide_i.options[nix].selected=true;
						 }
					}
				}

            }
           for (var i=0; i<lang_i.options.length; i++){
                if(lang_i.options[i].value==""){
                    nix=i;
                    continue;
                }
				if(rlans.indexOf(lang_i.options[i].value)<0)
				{
                    lang_i.options[i].style.display='none';
                     if(lang_i.options[i].value==lang_v){
                          lang_i.options[nix].selected=true;
                     }
				}
				else
				{
					if(checkarr(il,jl,lang_i.options[i].value))
						lang_i.options[i].style.display='block';
					else
					{
						lang_i.options[i].style.display='none';
						 if(lang_i.options[i].value==lang_v){
							  lang_i.options[nix].selected=true;
						 }
					}
				}

            }

            break;
        }
    }
	}
}
function checkarr(where, oftype, what)
{
	var x_v, x_a, x;
	switch(where)
	{
		case 0:
			x_a=routs;
			x_v=document.getElementById("route").value;
			break;
		case 1:
			x_a=langs;
			x_v=document.getElementById("language").value;
			break;
		case 2:
			x_a=guides;
			x_v=document.getElementById("guide").value;
			break;
	}
	if(x_v=="") return true;
	for(x in x_a)
	{
		if (x_a[x][0]==x_v)
		{
			if (x_a[x][oftype].indexOf(what)<0) return false;
			else return true;
		}
	}
	return false;
}

</script>

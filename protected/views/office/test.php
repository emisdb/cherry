<?php $this->renderPartial('_top', array('info'=>$info)); ?>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

<h1>Testing value</h1>
      </section>

        <!-- Main content -->
        <section class="content">
<?php	echo json_encode($model);
		echo "<hr>";

?>
			
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seg-scheduled-tours-form',
	'enableAjaxValidation'=>false,
)); ?>
			
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<?php
					echo CHtml::dropDownList('tourroute_id',$tr,CHtml::listData (array_values($model[0]), 0, 1),
	                    array('empty'=>'--','id'=>'route','onChange'=>'do_route(value,0)'));
				?>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<?php 
					echo CHtml::dropDownList('language_id',$lang, CHtml::listData (array_values($model[1]), 0, 1),
						array('empty'=>'--','id'=>'language','onChange'=>'do_route(value,1)'));
					?>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<?php
				 echo CHtml::dropDownList('guide1_id', $gui ,CHtml::listData (array_values($model[2]), 0, 1),
                        array('empty'=>'--','id'=>'guide','onChange'=>'do_route(value,2)'));
			 ?>
			</div>
		</div>
	</div>	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
		</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	     <script type="text/javascript">
      <?php
          echo "var routs=".json_encode($model[0]).";\n";
          echo "var langs=".json_encode($model[1]).";\n";
          echo "var guides=".json_encode($model[2]).";\n";
    ?>
        
$(document).ready ( function (){
});
function do_route(val,where)
{
    var nix, ig,jg,il,jl;
    var rguis, rlans, x_a;
	var guide_i;
    var lang_i;
	switch(where)
	{
		case 0:
			x_a=routs;
			guide_i=document.getElementById("language");
			lang_i=document.getElementById("guide");
			ig=2; jg=3; il=1; jl=3;
			break;
		case 1:
			x_a=langs;
			guide_i=document.getElementById("route");
			lang_i=document.getElementById("guide");
			ig=2; jg=2; il=0; jl=3;
			break;
		case 2:
			x_a=guides;
			guide_i=document.getElementById("route");
			lang_i=document.getElementById("language");
			ig=1; jg=2; il=0; jl=2;
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
            rguis=x_a[val][2];
            rlans=x_a[val][3];
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

	}
}
function checkarr(where, oftype, what)
{
	var x_v, x_a;
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
	if (x_a[x_v][oftype].indexOf(what)<0) return false;
	else return true;

}

</script>

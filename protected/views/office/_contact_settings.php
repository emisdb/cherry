   <div class="box box-warning" >
        <div class="box-header with-border">
            <h4 class="box-title">
                City, languages, tour categories
            </h4>
        </div>
        <div class="box-body" >
  	<div class="row">
            <div class="col-md-4">
                <h4>City</h4>
                <?php 
                    echo $form->radioButtonList($city,'cities_id', $city->getCitiesList());
                 ?>
           </div>
            <div class="col-md-4">
                <h4>Languages</h4>
                <?php 
                    echo CHtml::checkBoxList('SegGuidesOptions[langlist]', $selected_lang_list,$lang_list);
                 ?>
           </div>
            <div class="col-md-4">
                <h4>Tour categories</h4>
                <?php 
                     echo CHtml::checkBoxList('SegGuidesOptions[catlist]', $selected_cat_list,$cat_list);
                 ?>
           </div>
 	</div>
        
        </div>
    </div>

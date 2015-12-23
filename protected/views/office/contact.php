<?php $this->renderPartial('_top', array('info'=>$info)); ?>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
<?php if($model->idcontacts != Yii::app()->user->id) {
$this->breadcrumbs=array(
    'Users'=>array('admin'),
	$update_user->username=>array('userUpdate','id'=>$update_user->id),
	'Update contact',
);
 }else{
$this->breadcrumbs=array(
    'Profile'=>array('user/profile'),
	'Update profile contact',
);
 }
 $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=>$this->breadcrumbs,
        'homeLink'=>false,
        'tagName'=>'ul',
        'separator'=>'',
        'activeLinkTemplate'=>'<li><a href="{url}">{label}</a></li>',
        'inactiveLinkTemplate'=>'<li><span>{label}</span></li>',
        'htmlOptions'=>array ('class'=>'breadcrumb')
    ));


 ?>
<h1>Update contact - <?php echo $update_user->username; ?></h1>
       </section>

        <!-- Main content -->
        <section class="content">
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seg-guidesdata-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>



	<?php echo $form->errorSummary($model); ?>


<?php 
    $this->renderPartial('_form_contact', array('model'=>$model, 'form'=>$form)); 
    $this->renderPartial('_form_gd', array('model'=>$modelgd, 'form'=>$form)); 
    $this->renderPartial('cashinfo', array(
                    'model'=>$modelgd,
                    'form'=>$form)); 
   $this->renderPartial('cashinfo_', array(
 			'link_tourroutes'=>$link_tourroutes,
 			'array_tour' => $array_tour,
			'array_tour_link' => $array_tour_link,
                    'form'=>$form)); 
   $this->renderPartial('_contact_settings', array(
			'selected_lang_list' => $selected_lang_list,
			'lang_list' => $lang_list,
 			'selected_cat_list' => $selected_cat_list,
			'cat_list' => $cat_list,
 			'city' => $city,
                   'form'=>$form)); 
    
?>
	<div class="row buttons">
        <button class="btn btn-primary" type="submit"><?php echo 'Save'; ?></button>
 		<button class="btn btn-primary cancel"><?php echo CHtml::link("Cancel", array("admin")) ?></button>
    </div>


<?php $this->endWidget(); ?>

</div><!-- form -->		
		</section><!-- /.content -->
      </div><!-- /.content-wrapper -->

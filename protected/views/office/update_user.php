<?php 
 Yii::app()->clientScript->registerScriptFile('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js',CClientScript::POS_HEAD);
$this->renderPartial('_top', array('info'=>$info));
?>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
			<?php
$this->breadcrumbs=array(
    'Guides'=>array('admin'),
	'Guideprofil anpaßen',
);

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
        <h1>Guideprofil anpa&szlig;en - <?php echo $model->username; ?> (<?php echo $model->role_ob->groupname; ?> )</h1>
     </section>

        <!-- Main content -->
        <section class="content">
            
<?php if($model->id != Yii::app()->user->id) {
    echo '<div class="create">';
    echo CHtml::link('Kontaktdaten aktualisieren', array('ucontact','id_user'=>$model->id));
    echo '</div>';
    }
    ?>

<?php $this->renderPartial('_form_user', array('model'=>$model)); ?>
		</section><!-- /.content -->
      </div><!-- /.content-wrapper -->

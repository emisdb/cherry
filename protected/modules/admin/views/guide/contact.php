<?php $this->renderPartial('_top', array('info'=>$info)); ?>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

<?php
$this->breadcrumbs=array(
    'Benutzerprofil'=>array('profile'),
	'Kontaktdaten Aktualisieren',
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

<h1>Kontaktdaten Aktualisieren für <?php echo $update_user->username; ?></h1>
       </section>

        <!-- Main content -->
        <section class="content">


<?php $this->renderPartial('_form_contact', array('model'=>$model,'modelgd'=>$modelgd,'info'=>$info,'id_user'=>$id_user)); ?>
		</section><!-- /.content -->
      </div><!-- /.content-wrapper -->

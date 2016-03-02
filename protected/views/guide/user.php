<?php $this->renderPartial('_top', array('info'=>$info)); ?>
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
<?php
$this->breadcrumbs=array(
    'Benutzerprofil'=>array('profile'),
	'Benutzerprofil aktualisieren',
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
<h1>Benutzerprofil aktualisieren für <?php echo $model->username; ?> (<?php echo $model->role_ob->groupname; ?> )</h1>



<hr />	

       </section>

        <!-- Main content -->
        <section class="content">


<?php $this->renderPartial('_form_user', array('model'=>$model/*,'usergroups'=>$usergroups*/)); ?>
     </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

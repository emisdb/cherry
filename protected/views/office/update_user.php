<?php $this->renderPartial('_top', array('info'=>$info)); ?>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>Update user - <?php echo $model->username; ?> (<?php echo $model->role_ob->groupname; ?> )</h1>
     </section>

        <!-- Main content -->
        <section class="content">
            
<?php if($model->id != Yii::app()->user->id) {
    echo '<div class="create">';
    echo CHtml::link('Update contact', array('ucontact','id'=>$model->id_contact,'id_user'=>$model->id));
    echo '</div>';
    if($model->id_guide!=0){
        echo '<div class="create">';
        echo CHtml::link('Update guide info', array('guide','id'=>$model->id_guide,'id_user'=>$model->id));
        echo '</div>';
        }
    }
    ?>

<?php $this->renderPartial('_form_user', array('model'=>$model)); ?>
		</section><!-- /.content -->
      </div><!-- /.content-wrapper -->

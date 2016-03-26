<?php $this->renderPartial('_top', array('info'=>$info)); ?>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

<h1>Testing value</h1>
      </section>

        <!-- Main content -->
        <section class="content">
<?php
    echo json_encode($model);
		echo "<hr>";
                echo $model->from_date." ".$model->to_date;
 
?>
    </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
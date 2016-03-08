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
    echo json_encode($lang_list);
    print_r($lang_list);
		echo "<hr>";
    echo json_encode($cat_list);
		echo "<hr>";

?>
    </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php
	$this->pageTitle = $model->title;
	Yii::app()->clientScript->registerMetaTag($model->description, 'description');
	Yii::app()->clientScript->registerMetaTag($model->keywords, 'keywords');
?>
<h1><?php echo $model->name; ?></h1>
<?php echo $model->text; ?>

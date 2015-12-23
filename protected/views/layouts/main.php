<!doctype html>
<html> 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="de" />
	<link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/fav.ico" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-select.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
    
	<title><?php echo $this->pageTitle; ?></title>
	<?php if (!empty($this->pageDescription)){ echo '<meta name="description" content="' . $this->pageDescription . '" />';}?>
	<?php if (!empty($this->pageKeywords)){ echo '<meta name="keywords" content="' . $this->pageKeywords . '" />';}?>

</head>

<body>
        <?php echo $content;?> 

        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
        <script>window.jQuery || document.write('<script src="<?php echo Yii::app()->request->baseUrl; ?>js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>js/vendor/bootstrap.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>js/bootstrap-select.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>js/main.js"></script>
</body>
</html>
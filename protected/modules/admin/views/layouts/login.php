<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/fav.ico" type="image/x-icon">
	<?php if (!empty($this->pageDescription)){ echo '<meta name="description" content="' . $this->pageDescription . '" />';}?>
	<?php if (!empty($this->pageKeywords)){ echo '<meta name="keywords" content="' . $this->pageKeywords . '" />';}?>

    <link href='http://fonts.googleapis.com/css?family=Roboto&subset=latin,cyrillic,cyrillic-ext' rel='stylesheet' type='text/css' />

    <title><?php echo $this->pageTitle; ?></title>
    <?php Yii::app()->bootstrap->register(); ?>

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />  
</head>

<body>
    <div class="login-str">
            <?php echo $content;?>
    </div>
</body>
</html>
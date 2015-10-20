<!doctype html>
<html lang="en"> 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/fav.ico" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />

   	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/stl.css" />
	<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/js/select.js'></script>

	<title><?php echo $this->pageTitle; ?></title>

	<?php if (!empty($this->pageDescription)){ echo '<meta name="description" content="' . $this->pageDescription . '" />';}?>
	<?php if (!empty($this->pageKeywords)){ echo '<meta name="keywords" content="' . $this->pageKeywords . '" />';}?>
</head>

<body>
    <div class="container" style="width:960px;">
        <!-- head -->
        <div class="row">
            <div class="span12" >
                <div class="logo2">
                    <div class="logo2-x">
                    	<a href="/">
                    		<img src ="<?php echo Yii::app()->request->baseUrl; ?>/img/str2/logo2.png" />
                        </a>
                    </div>
                </div>
                <div class="berlin-pic">
                    <div class="t-main-2">Berlin</div>
                </div>
            </div>
        </div>
        
        <!-- content -->
        <div class="row" style="">
            <div class="span12" style="">
            

            
                  <?php echo $content; ?>
                  
                  
                  
            </div>
        </div>

        <!-- menu -->
        <div class="row" style="">
            <div class="span12" style="margin-top:50px;">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        
                        <div class="collapse navbar-collapse t-footer" id="bs-example-navbar-collapse-1">
                          <ul class="nav navbar-nav">
                              <li class=""><a href="#">ABOUT US <span class="sr-only">(current)</span></a></li>
                              <li><a href="#">JOBS</a></li>
                              <li><a href="#">IMPRESSUM</a></li>
                              <li><a href="#">TERMS</a></li>
                              <li><a href="#">PRIVACY</a></li>
                              <li><a href="#">CONTACT US</a></li>
                          </ul>
                          <ul class="nav navbar-nav navbar-right">
                              <li class="copy">&copy; Copyright Cherrytours 2015</li>
                          </ul>
                        </div>
                      </div>
                 </nav>
            </div>
        </div>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo Yii::app()->request->baseUrl; ?>js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>js/vendor/bootstrap.min.js"></script>
  <!-- <script src="<php echo Yii::app()->request->baseUrl; ?>js/vendor/bootstrap-select.js"></script>-->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>js/main.js"></script>

    <script  type="text/javascript">
		$('#sandbox-container .input-group.date').datepicker({
		});
		
		

	</script>            

</body>
</html>
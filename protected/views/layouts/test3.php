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
    
    <!--<php Yii::app()->bootstrap->register();?>-->
    
	<?php if (!empty($this->pageDescription)){ echo '<meta name="description" content="' . $this->pageDescription . '" />';}?>
	<?php if (!empty($this->pageKeywords)){ echo '<meta name="keywords" content="' . $this->pageKeywords . '" />';}?>

	<style>
    .login-str-nosite{
      top: 50%;
      left: 50%;
      width: 230px;
      height: 50px;
      position: absolute;
      margin-top: -25px;
      margin-left: -115px;
      font-size:20px;
      color:#cccccc;
    }
    </style>
</head>

<body>
    <div class="container" style="width:960px;">
        <!-- logo -->
        <div class="row">
            <div class="span12" >
                <div style="padding-top:20px;">
                    <center><a href="/"><img src ="<?php echo Yii::app()->request->baseUrl; ?>/img/logo.png" /></a></center>
                </div>
            </div>
        </div>
        
        <!-- str -->
        <div class="row" style="">
            <div class="span12" style="">
                 <center><img src ="<?php echo Yii::app()->request->baseUrl; ?>/img/line.png" /> </center>
            </div>
        </div>
        
        <!-- text -->
        <div class="row" >
            <div class="span12" style="">
                <div class="t-main-1" style="padding-top:10px;">
                     <center>Professional guided city tours cherry-picked for you with quality in mind</center>
                </div>
            </div>
        </div>
        
        <!-- slider -->
        <div class="row" style="">
            <div class="span12" style="margin-top:20px;">
                <div class="form-search-x">
                    <div class="form-search-background"></div>
                </div>
                
                <div class="form-search-x">
                    <div class="form-search">

                            <?php $this->widget('application.components.FormMain3'); ?>
                            
							<!--<php $this->widget('application.components.FormMain', array(
                             'username' => '777'
                            )); ?>-->
                      
                    </div>
                </div>
                <div class="ind-x">
                    <div class="ind"></div>
                </div>
              
                    <div class="carousel-city" data-example-id="simple-carousel">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                                <li data-target="#myCarousel" data-slide-to="3"></li>
                                <li data-target="#myCarousel" data-slide-to="4"></li>
                                <li data-target="#myCarousel" data-slide-to="5"></li>
                                <li data-target="#myCarousel" data-slide-to="6"></li>
                            </ol>

                            <div class="carousel-inner"  role="listbox">
                                <div class="active item">
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/berlin.jpg" alt="Berlin" />
                                    <div class="carousel-caption">
                                        <div class="t-carousel-big">Berlin</div>
                                        <div class="t-carousel">Discover the city's main sites with our Classic Tour</div>
                                    </div>
                                </div>
                            
                                <div class="item"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/munich.jpg" alt="Munich" />
                                    <div class="carousel-caption">
                                        <div class="t-carousel-big">Munich</div>
                                        <div class="t-carousel">Learn what makes this city special with our Special Tour</div>
                                    </div>
                                </div>
                                <div class="item"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/dresden.jpg" alt="Dresden" />
                                    <div class="carousel-caption">
                                        <div class="t-carousel-big">Dresden</div>
                                        <div class="t-carousel">Get deep into the city's history with our Historical Tour</div>
                                    </div>
                                </div>
                                <div class="item"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/stuttgart.jpg" alt="Stuttgart" />
                                    <div class="carousel-caption">
                                        <div class="t-carousel-big">Stuttgart</div>
                                        <div class="t-carousel">Discover the city's main sites with our Classic Tour</div>
                                    </div>
                                </div>
                                <div class="item"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/augsburg.jpg" alt="Augsburg" />
                                    <div class="carousel-caption">
                                        <div class="t-carousel-big">Augsburg</div>
                                        <div class="t-carousel">Learn what makes this city special with our Special Tour</div>
                                    </div>
                                </div>
                                <div class="item"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/regensburg.jpg" alt="Regensburg" />
                                    <div class="carousel-caption">
                                        <div class="t-carousel-big">Regensburg</div>
                                        <div class="t-carousel">Get deep into the city's history with our Historical Tour</div>
                                    </div>
                                </div>
                                <div class="item"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/koln.jpg" alt="Koln" />
                                    <div class="carousel-caption">
                                        <div class="t-carousel-big">Köln</div>
                                        <div class="t-carousel">Learn what makes this city special with our Special Tour</div>
                                    </div>    
                                </div>
                            </div>
                            <!-- Carousel nav -->
                            <!--<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                            <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>-->
                        </div>
                    </div>
               
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
		$('#sandbox-container .input-group.date').datepicker({	});
	</script>            

</body>
</html>
<style>
	.text-thank{
		color:#000000;
		font-size:16px;
		margin:0 auto;
		width:500px;
		padding: 50px;
	}
	.thankyou{
		color:#000000;
		font-size:20px;
		padding:10px 20px;
		border:3px solid #000000;
		border-radius:10px;
		width:150px;
		margin:0 auto;	
		text-align:center;
	}
	a .but-book, a:hover .but-book{
		color:#000000;
		text-decoration:none;
		font-size:20px;
	}
	
</style>

<div class="text-thank">
	Thank you for your booking!<br>
    We sent a confirmation to your email.
</div>

<div style="padding:70px 0 110px;">
	<a href="<?php echo Yii::app()->request->baseUrl; ?>/berlin"><button class="but-book" >Thank You!</button></a>
	<!--<div class="thankyou">Thank You!</div>-->
</div>
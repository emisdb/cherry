<?php

// this contains the application parameters that can be maintained via GUI
return array(
	// this is displayed in the header section
	'title'=>'My Yii Blog',
	// this is used in error pages
	'adminEmail'=>'berlin@cherrytours.com',
	'paymenturl'=>"https://test.oppwa.com",
//	'paymenturl'=>"https://test.oppwa.com/v1/checkouts",
	'paymentid'=>
                "authentication.userId=8a829418527de00401527e5f34cf03f1".
		"&authentication.password=CNGKq86H".
		"&authentication.entityId=8a829418527de00401527e5ff82003f5",

	'paymentdata'=>
		"&amount=[amount]".
		"&currency=EUR".
		"&descriptor=Cherrytours".
		"&merchantTransactionId=[trans]".
		"&paymentType=DB",
	'img'=>'img',
	'tourspdf'=>'tourspdf',
	'mailPWD'=>'123',
	// number of posts displayed per page
	'postsPerPage'=>10,
	// maximum number of comments that can be displayed in recent comments portlet
	'recentCommentCount'=>10,
	// maximum number of tags that can be displayed in tag cloud portlet
	'tagCloudCount'=>20,
	// whether post comments need to be approved before published
	'commentNeedApproval'=>true,
	// the copyright information displayed in the footer section
	'copyrightInfo'=>'Copyright &copy; 2009 by My Company.',
	'site_en'=>'cherrytours.com',
	'site_de'=>'cherrytours.de',
);

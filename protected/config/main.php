<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

//bootstrap 2
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'cherrytours.com',

    'sourceLanguage'=>'en',
    'language'=>'en',
    'charset'=>'utf-8',

	// preloading 'log' component
    'preload'=>array('log','bootstrap',),
	//'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

    'modules'=>array(
         // uncomment the following to enable the Gii tool
        'gii'=>array(
             'class'=>'system.gii.GiiModule',
             'password'=>'1111',
//              If removed, Gii defaults to localhost only. Edit carefully to taste.
             'ipFilters'=>array('127.0.0.1','::1'),
             'generatorPaths'=>array('bootstrap.gii'),
         ),
    ),

	'defaultController'=>'main',

	// application components
	'components'=>array(
   
   
        'authManager' => array(
            // Будем использовать свой менеджер авторизации
            'class' => 'PhpAuthManager',
            // Роль по умолчанию. Все, кто не админы, модераторы и юзеры — гости.
            'defaultRoles' => array('guest'),
        ),
   
        'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),
        
        'ih'=>array('class'=>'CImageHandler'),

		'user'=>array(
            'class' => 'WebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
	/*	'db'=>array(
			'connectionString' => 'sqlite:protected/data/blog.db',
			'tablePrefix' => 'tbl_',
		), */
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=cherrydb',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',
		),
/*		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
*/		'urlManager'=>array(
			'urlFormat'=>'path',
            'showScriptName'=>false,
		
			'rules'=>array(
            	'/' => 'segScheduledTours/index',
				'/admin' => 'site/login',
				'/berlin/book' => 'segScheduledTours/book/id/1',
				'/munchen/book' => 'segScheduledTours/book/id/2',
				'/berlin' => 'segScheduledTours/city/city/1',
				'/dresden' => 'segScheduledTours/city/city/3',
				'/munchen' => 'segScheduledTours/city/city/2',
				'/munich' => 'segScheduledTours/city/city/2',
				'/hamburg' => 'segScheduledTours/city/city/3',
				'/<city>' => 'segScheduledTours/city',
				'/<book>/book' => 'segScheduledTours/book',
/**/			
				'post/<id:\d+>/<title:.*?>'=>'post/view',
				'posts/<tag:.*?>'=>'post/index',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(


			'class' => 'CWebLogRoute',
					'enabled'=>YII_DEBUG,
            'categories' => 'application',
            'levels'=>'error, warning, trace, profile, info',				),
				// uncomment the following to show log messages on web pages
				/*array(
					'class'=>'CWebLogRoute',
				),
				
				*/
			),
		),
		            		'mail' => array(
			'class' => 'ext.yii-mail.YiiMail',
			'transportType'=>'smtp',
                        'transportOptions'=>array(
                           'host'=>'smtp.cherrytours.com',
                           'username'=>'berlin@cherrytours.com',
                           'password'=>'1q2w3e4r5t',
                           'port'=>'465',
                           'encryption'=>'ssl',
                    )),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);
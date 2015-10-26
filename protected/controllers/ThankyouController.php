<?php

class ThankyouController extends Controller
{
	public function actionIndex($id)
	{
		if($id==1){
			$this->layout = "berlin";
		}
		if($id==2){
			$this->layout = "munchen";
		}
		
		$this->render('index');
	}
	public function actionMail()
	{

	               Yii::import('ext.yii-mail.YiiMailMessage');
                $message = new YiiMailMessage;
                $message->setBody("<h2>Добрый день</h2>Просим проверить счет. <br>"
                        . " Если согласны, то просим прислать платежное поручение.<br>"
                        . "<i>C уважением, Отдел продаж.</i>", 'text/html');
                $message->subject = "Счет № для ";
                $message->addTo("dentsi@yahoo.com");
//                $message->addTo(Yii::app()->params['adminEmail']);
                $message->from = Yii::app()->params['adminEmail'];
//                $pathto=Yii::app()->params['load_xml_pdf'].$filename;
//                $swiftAttachment = Swift_Attachment::fromPath($pathto); 
//               $message->attach($swiftAttachment);
               $res=Yii::app()->mail->send($message);
			                  if($res)
                 $this->renderText('Отправлена почта. Файл:'); 
               else
                  $this->renderText('Не отправлена почта'); 

	}
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
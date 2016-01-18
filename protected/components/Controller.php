<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to 'column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	protected function sendMail($to,$subject,$body,$att=null)
	{
		        Yii::import('ext.yii-mail.YiiMailMessage');
                $message = new YiiMailMessage;
				$message->setBody($body);
                $message->subject = $subject;
                $message->addTo($to);
                $message->from = Yii::app()->params['adminEmail'];
  				if($att){
					$swiftAttachment = Swift_Attachment::fromPath($att); 
					$message->attach($swiftAttachment);
				}
               return Yii::app()->mail->send($message);
		}
}
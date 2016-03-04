<?php

class DefaultController extends Controller
{
	public $cashsum=0;
	public $totval=0;
 	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated users to access all actions
//				'users'=>array('@'),
                'roles'=>array('root'),                
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
       
        public function init() {
                parent::init();
  		$command=Yii::app()->db->createCommand();
        $command->select('SUM(delta_cash) AS sum');
        $command->from('cashbox_change_requests');
        $command->where('approvedBy IS NOT NULL');

//                $command->where('id_users=:id', array(':id'=>Yii::app()->user->id));
        $this->cashsum= $command->queryScalar();
        }
	public function actionIndex()
	{
//            Yii::app()->theme='bootstrap';
            
		$this->layout='/layouts/root_bs';
		$this->pageTitle="Root - Cherrytours";
		$model=new Languages('search');
 		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
		$this->render('test',array('model'=>$model,
						'info'=>$test,
		));
	}
	public function actionBs()
	{
            Yii::app()->theme='bootstrap';
 		$this->render('index');
	}
        
		public function actionGo()
	{
		if(isset($_POST))
		{
			$val=$_POST['constant'];
			Constants::model()->setCvalue('dayup',$val);
		}
		$this->render('go',array('model'=>$val));
	}
		public function loadContact($id)
	{
		$model=SegContacts::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	public function loadTours()
	{
 		$model=CashboxChangeRequests::model()->with('user')->findAll('(approvedBy IS NULL) AND (reject=0)');
		if($model===null)
			throw new CHttpException(404,'The cashbox model does not exist.');
		return $model;
	}
	public function loadUnreported()
	{
        $id = Yii::app()->user->id;
		$model=SegScheduledTours::model()->findAll('date_now<:date AND openTour IS NULL AND language_id IS NOT NULL',array(':date'=>time()));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

}
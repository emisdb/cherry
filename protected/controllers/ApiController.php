<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
class ApiController extends Controller
{
    public $layout = '//api/default';
    public function actionIndex($cont = 'index', $act = '', $id = '', $nn = '')
    {
        ////change language
        /// language files protected/massages
		$host = str_replace("www.","",$_SERVER['HTTP_HOST']);
        switch ($host) {
            case Yii::app()->params['site_de'] :
                 Yii::app()->language = 'de';
                break;
            case Yii::app()->params['site_en'] :
                Yii::app()->language = 'en';
                break;
        }
		if(Yii::app()->user->isGuest){
	        $this->redirect(array('/admin'));
        }
        /////
        if ($cont == 'index') {
            list($site) = Yii::app()->createController('SegScheduledTours');
            $site->actionIndex();
        } else if ($cont == 'ajaxSearchTours') {
            list($site) = Yii::app()->createController('SegScheduledTours');
            $site->actionAjaxSearchTours();
        } else {
            if ($act === 'book') {
				$sp = '';
				if(isset($_POST["search-params"])){ $sp = $_POST["search-params"]; }
				$bp = '';
				if(isset($_POST["book-params"])){ $bp = $_POST["book-params"]; }
                Yii::app()->user->setState('city_data', $sp);
                Yii::app()->user->setState('book_data', $bp);
                $model_city = SegCities::model()->find('webadress_en=:webadress_en', array(':webadress_en' => $cont));
                $id_city = $model_city->idseg_cities;
                list($site) = Yii::app()->createController('SegScheduledTours');
                $site->actionBook($id_city);
            } else if ($act === 'thankyousend') {
                list($site) = Yii::app()->createController('Thankyousend');
                $site->actionIndex();
            } else {
                $model_city = SegCities::model()->find('webadress_en=:webadress_en', array(':webadress_en' => $cont));
                if($model_city){
					$id_city = $model_city->idseg_cities;
					if ($id_city > 0) {
						list($site) = Yii::app()->createController('SegScheduledTours');
						$site->actionCity($id_city);
                    }
					else {
						$this->redirect(array(''));
                    }
				}
				else{
					$this->redirect(array(''));
				}
            }
        }
    }

}

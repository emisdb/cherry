<?php

class SegScheduledToursController extends Controller
{
    public $layout = '//layouts/front_bs';

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions' => array('result', 'city', 'ajaxLoad', 'ajaxGuide', 'index', 'book', 'booking', 'test', 'dispatch'),
//                'roles' => array('root', 'guide', 'office', 'admin'),
				'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('weeks', 'take', 'show', 'admin', 'admins', 'spontan', 'current'),
                'roles' => array('guide'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('officeadmin', 'update'),
                'roles' => array('office'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array(''),
                'roles' => array('admin'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array(''),
                'roles' => array('root'),
            ),
 //           array('deny',  // deny all users
 //               'users' => array('*'),
 //           ),
        );
    }


    //OFFICE begin
    public function actionOfficeadmin()
    {
        $id_control = Yii::app()->user->id;
        $role_control = User::model()->findByPk($id_control)->id_usergroups;

        if ($role_control == 1) {
            $this->layout = "root";
        }
        if ($role_control == 2) {
            $this->layout = "admin";
        }
        if ($role_control == 3) {
            $this->layout = "office";
        }
        if ($role_control == 5) {
            $this->layout = "guide";
        }

        $languages_guide = Languages::model()->findAll();

        // $criteria = new CDbCriteria;
        // $criteria->condition = 'guide1_id=:guide1_id';
        // $criteria->params = array(':guide1_id' => $id_control);

        $model = new SegScheduledTours();

        $this->render('officeadmin', array(
            'model' => $model,
            'id_control' => $id_control,
            'languages_guide' => $languages_guide,
        ));
    }

    public function actionUpdate($id)
    {
        $id_control = Yii::app()->user->id;
        $role_control = User::model()->findByPk($id_control)->id_usergroups;

        if ($role_control == 1) {
            $this->layout = "root";
        }
        if ($role_control == 2) {
            $this->layout = "admin";
        }
        if ($role_control == 3) {
            $this->layout = "office";
        }
        if ($role_control == 5) {
            $this->layout = "guide";
        }

        //language list
        $languages_guide = Languages::model()->findAll();
        //guide list
        $criteria_guide = new CDbCriteria;
        $criteria_guide->condition = 'id_usergroups=:id_usergroups';
        $criteria_guide->params = array(':id_usergroups' => 5);
        $guide_list = User::model()->findAll($criteria_guide);

        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['SegScheduledTours'])) {
            $model->attributes = $_POST['SegScheduledTours'];
            if ($model->save())
                $this->redirect(array('officeadmin'));
        }

        $this->render('update', array(
            'model' => $model,
            'languages_guide' => $languages_guide,
            'guide_list' => $guide_list,
        ));
    }
    //end OFFICE

    //GUIDE begin

    public function actionBooky($id, $cat)
    {
        $model = $this->loadModel($id);
        $tour = $this->loadTR($model->city_id, $cat);
        $contact = new SegContacts;
        $ticket_count = 0;
        if (isset($_POST['SegScheduledTours'])) {
            $model->tourroute_id = $tour->idseg_tourroutes;
            if (isset($_POST['SegScheduledTours']['language_id']))
                $model->language_id = $_POST['SegScheduledTours']['language_id'];
            if (isset($_POST['SegScheduledTours']['current_subscribers'])) {
                $ticket_count = (int)$_POST['SegScheduledTours']['current_subscribers'];
                if (is_null($model->current_subscribers)) $model->current_subscribers = 0;
                $model->current_subscribers += $ticket_count;
                $model->TNmax_sched = $tour->TNmax;
            }
            $model->save();
            if ($contact->validate()) {
                $contact->attributes = $_POST['SegContacts'];
                $contact->save();

                //save booking
                $id_user = $contact->idcontacts;
                //save guidestourinvoice
                $guidestourinvoices = new SegGuidestourinvoices;


                $guidestourinvoices->creationDate = $model->date;
                $guidestourinvoices->cityid = $model->city_id;
                $guidestourinvoices->sched_tourid = $model->tourroute_id;
                $guidestourinvoices->guideNr = $model->guide1_id;
                $guidestourinvoices->status = 0;
                $guidestourinvoices->contacts_id = $id_user;
                $guidestourinvoices->id_sched = $model->idseg_scheduled_tours;
                $guidestourinvoices->save();


                //save guidestourinvoicecustomers
                $id_invoice = $guidestourinvoices->idseg_guidesTourInvoices;
                for ($j = 0; $j < $ticket_count; $j++) {
                    $guidestourinvoicescustomers = new SegGuidestourinvoicescustomers;
                    $guidestourinvoicescustomers->customersName = $contact->firstname . ' ' . $contact->surname;
//					$guidestourinvoicescustomers->price = $tour->base_price;
                    $guidestourinvoicescustomers->price = 0;
                    $guidestourinvoicescustomers->cityid = $model->city_id;

                    $guidestourinvoicescustomers->tourInvoiceid = $id_invoice;

                    //$guidestourinvoicescustomers->CustomeInvoicNumber = ;
                    $b = $tour->city['seg_cityname']{0};
                    $year = date('y', time());
                    $max = Yii::app()->db->createCommand("SELECT max(CustomerInvoiceNumber) from seg_guidestourinvoicescustomers where cityid=" . $tour->cityid)->queryScalar();
                    $max_i = $max + 1;

                    $guidestourinvoicescustomers->KA_string = 'KA' . $b . $year . '/' . $max_i;
                    $guidestourinvoicescustomers->CustomerInvoiceNumber = $max_i;
                    $guidestourinvoicescustomers->isPaid = 0;
//					$guidestourinvoicescustomers->origin_booking = $id_book;


                    $guidestourinvoicescustomers->save();
                }
                $date_ex = date('d/m/Y', $model->date_now);
                $x1 = strtotime($model->starttime) - strtotime("00:00:00");
                $x2 = $tour->standard_duration * 60;
                $x3 = $x1 + $x2;
                $x4 = $x3 + strtotime("00:00:00");
                $x5 = date('H:i:s', $x4);
                $tourend = $x5;

                $guidename = $model->user_ob->contact_ob->firstname;
                $guidemnr = $model->user_ob->contact_ob->phone;

                $message = "Thank you for booking your city tour with Cherry Tours " . $model->city_ob->seg_cityname;
                $message .= "\n";
                $message .= "\nWe have just reserved the following tour date for you:";
                $message .= "\n" . $date_ex;
                $message .= "\nTour start: " . $model->starttime . " (Please show up at the assigned meeting point about 10 minutes before tour start.)";
                $message .= "\n";
                $message .= "\nEnd of tour: " . $tourend;
                $message .= "\nTour route: " . $model->tourroute_ob->name;
                $message .= "\nTour language: " . $model->language_ob->englishname;
                $message .= "\nTour guide: " . $guidename;
                $message .= "\nGuide phone: " . $guidemnr . "(for last-minute requests regarding weather or meeting point)";

                $message .= "\nFurthermore we recommend:";
                $message .= "\n- comfortable shoes, no high heels";
                $message .= "\n- adequate clothing (below 15 degrees centigrade, we especially recommend wearing warm clothes and gloves)";
                $message .= "\n- sunglasses, if necessary sun protection etc.";
                $message .= "\n";
                $message .= "\nPayment:";
                $message .= "\n- On site";
                $message .= "\n";
                $message .= "\nWe accept the following methods of payment:";
                $message .= "\n- Cash in EUR";
                $message .= "\n- EC";
                $message .= "\n- Credit cards (Visa, Master Card, American Express, JCB Cards, Union Pay)";
                $message .= "\n- Vouchers purchased at Cherry Tours";
                $message .= "\n";

                $message .= "\nWeather:";
                $message .= "\nIf the weather forecast shows a high chance of rain at the tour date, we will contact you near-term via email, SMS or phone and inform you if the tour has to be cancelled.";
                $message .= "\nIf it rains despite a positive weather forecast, the tour guide will decide on-site if the tour can take place. Generally, the tour is arranged along a route where you can always take cover in case of a short rain shower.";
                $message .= "\n";
                $message .= "\n";

                $name_forms = $model->city_ob->seg_cityname;
                $to = $contact->email;
                if ($this->sendMail($to, $name_forms, $message)) {

                    $stuttgart_link = Yii::app()->createUrl('thankyou');
//				    header( 'Location: '.$stuttgart_link.'?id=1' );
                }
            }
            $this->render('result', array(
                'post' => $_POST,
                'contacts' => $contact->attributes,
                'model' => $model->attributes,
            ));
            return;
        }

        $this->render('book', array(
            'post' => $_POST,
            'model' => $model,
            'contact' => $contact,
            'tour' => $tour,
        ));
    }

    public function actionBook($id)
    {
        $sid = '';

        if (Yii::app()->user->hasState("book_data") || $_POST['sid']) {
			if(Yii::app()->user->getState("book_data")){
              $bookdata = get_object_vars(json_decode(Yii::app()->user->getState("book_data")));
              $sid = $bookdata['sid'];
              $tid = $bookdata['tid'];
			}
            //var_dump($sid);
            //var_dump($_POST); exit;
            if (isset($_POST['sid'])) $sid = $_POST['sid'] * 1;
            if (isset($_POST['tid'])) $tid = $_POST['tid'] * 1;
            //
            $model = $this->loadModel($sid);
            $tour = $this->loadTR($model->city_id, $tid);
        }
        $contact = new SegContacts;
        $ticket_count = 0;
        if (isset($_POST['SegScheduledTours'])) {

            $model->tourroute_id = $tour->idseg_tourroutes;
            if (isset($_POST['SegScheduledTours']['language_id'])) $model->language_id = $_POST['SegScheduledTours']['language_id'];
            if (isset($_POST['SegScheduledTours']['current_subscribers'])) {
                $ticket_count = (int)$_POST['SegScheduledTours']['current_subscribers'];
                if (is_null($model->current_subscribers)) $model->current_subscribers = 0;
                $model->current_subscribers += $ticket_count;
                $model->TNmax_sched = $tour->TNmax;
            }

            if (isset($_POST['SegContacts'])) {

                $contact->attributes = $_POST['SegContacts'];

                if ($contact->validate()) {
                    $contact->save();
                    Yii::app()->user->setState('book_data', null);
                    //save booking
                    $id_user = $contact->idcontacts;
                    //save guidestourinvoice
                    $guidestourinvoices = new SegGuidestourinvoices;
                    $guidestourinvoices->creationDate = $model->date;
                    $guidestourinvoices->cityid = $model->city_id;
                    $guidestourinvoices->sched_tourid = $model->tourroute_id;
                    $guidestourinvoices->guideNr = $model->guide1_id;
                    $guidestourinvoices->status = 0;
                    $guidestourinvoices->contacts_id = $id_user;
                    $guidestourinvoices->id_sched = $model->idseg_scheduled_tours;
                    $guidestourinvoices->save();
                    $model->save();
                    //save guidestourinvoicecustomers
                    $id_invoice = $guidestourinvoices->idseg_guidesTourInvoices;
                    for ($j = 0; $j < $ticket_count; $j++) {
                        $guidestourinvoicescustomers = new SegGuidestourinvoicescustomers;
                        $guidestourinvoicescustomers->customersName = $contact->firstname . ' ' . $contact->surname;
                        //$guidestourinvoicescustomers->price = $tour->base_price;
                        $guidestourinvoicescustomers->price = 0;
                        $guidestourinvoicescustomers->cityid = $model->city_id;
                        $guidestourinvoicescustomers->tourInvoiceid = $id_invoice;
                        //$guidestourinvoicescustomers->CustomeInvoicNumber = ;
                        $b = $tour->city['seg_cityname']{0};
                        $year = date('y', time());
                        $max = Yii::app()->db->createCommand("SELECT max(CustomerInvoiceNumber) from seg_guidestourinvoicescustomers where cityid=" . $tour->cityid)->queryScalar();
                        $max_i = $max + 1;
                        $guidestourinvoicescustomers->KA_string = 'KA' . $b . $year . '/' . $max_i;
                        $guidestourinvoicescustomers->CustomerInvoiceNumber = $max_i;
                        $guidestourinvoicescustomers->isPaid = 0;
                        //$guidestourinvoicescustomers->origin_booking = $id_book;
                        $guidestourinvoicescustomers->save();
                    }
                    $to = $contact->email;
                    //////////text email
                    $otpr = $stopt = 0;
                    /////
                    $starttime = str_replace('00:00', '00', $model->starttime);
                    $tourdate = $this->dateEn($model->date);
                    if (!empty($model->duration)) $stopt = $model->duration;
                    else $stopt = $tour->standard_duration;
                    $stoptime = date("H:i", strtotime($model->date . ' ' . $model->starttime) + ($stopt * 60)) . ' Uhr';
                    $tour_name = $model->city_ob->seg_cityname . ' ' . $tour->name;
                    ////lang
                    $text_lang = $model->language_ob->germanname;
                    if (is_null($model->language_id)) {
                        $lang = SegLanguagesGuides::model()->with('languages')->findAll('users_id=' . $model->guide1_id);
                        $zp = $text_lang = '';
                        foreach ($lang as $val) {
                            $text_lang .= $zp . $val->languages->germanname;
                            $zp = ', ';
                        };
                    }
                    ////point
                    $meetingpoint = $tour->meetingpoint_description;
                    if (Yii::app()->language == 'en') $meetingpoint = $tour->meetingpoint_description_en;
                    //settings template mail
                    $mailtext = array(
                        'city_name' => $model->city_ob->seg_cityname,
                        'city_en' => $model->city_ob->webadress_en,
                        'tour_date' => $tourdate,
                        'tour_starttime' => $starttime,
                        'tour_stoptime' => $stoptime,
                        'tour_guest' => $ticket_count,
                        'tour_name' => $tour_name,
                        'tour_lang' => $text_lang,
                        'tour_guide_name' => $model->user_ob->guidename,
                        'tour_guide_tel' => $model->user_ob->contact_ob->phone,
                        'contact_name' => $_POST['SegContacts']['firstname'] . ' ' . $_POST['SegContacts']['surname'],
                        'contact_street' => $_POST['SegContacts']['additional_address'] . '<br>' . $_POST['SegContacts']['street'],
                        'contact_city' => $_POST['SegContacts']['city'],
                        'contact_land' => $_POST['SegContacts']['country'],
                        'contact_tel' => $_POST['SegContacts']['phone'],
                        'contact_email' => $_POST['SegContacts']['email'],
                        'meetingpoint' => $meetingpoint
                    );
                    //template mail
                    $msg = $this->renderPartial('../thankyousend/tour_mail', $mailtext, TRUE);
                    if ($this->sendMail($to, 'Cherrytours: ' . $tour_name, $msg)) {
                        // send mail admin
                        //$email_admin = $model->city_ob->mailInfo;
                        $email_admin = '7454585@gmail.com';
                        $msg = $this->renderPartial('../thankyousend/tour_mail_admin', $mailtext, TRUE);
                        $this->sendMail($email_admin, 'Cherrytours: New client ' . $tour_name, $msg);
                        ///
                        $this->render('thankyou', array(
                            'model' => $model,
                            'tour' => $tour,
                            'post' => $_POST,
                            'sid' => $sid,
                            'tid' => $tid,
                            'guest' => $ticket_count
                        ));
                    } else {
                        $this->render('../thankyousend/mail_success', array(
                                'text_link' => 'Anwendung beibehalten. Ich kann nicht einen Brief schicken.',
                                'city_en' => $model->city_ob->webadress_en
                            )
                        );
                    }
                    //unset($_POST);
                } else {
                    echo 'goto_book';
                    $this->render('book', array(
                        'post' => $_POST,
                        'model' => $model,
                        'contact' => $contact,
                        'tour' => $tour,
                        'sid' => $sid,
                        'tid' => $tid
                    ));
                }
            }
        } else {

            $this->render('book', array(
                'post' => $_POST,
                'model' => $model,
                'contact' => $contact,
                'tour' => $tour,
                'sid' => $sid,
                'tid' => $tid
            ));
        }
    }

    public function actionIndex()
    {
        $model = new SegScheduledTours('search_f');
        $model->setAttribute("date", date("d-m-Y", time()));
        $this->render('front', array('model' => $model));
    }

    public function actionTest()
    {
        /*
        $model=new SegScheduledTours('search_f');
         $model->setAttribute("date", date("d-m-Y",time()));
        $this->render('test',array('model'=>$model,'date'=>date("Y-m-d-n-w")));
        */
    }

    public function actionBooking()
    {
        /*
        $model=  json_decode($_POST["book-params"]);
        $params=json_decode($_POST["search-params"]);
        if(empty($model->sid)) $this->redirect(array("index"));
            $city=SegScheduledTours::model()->with('city_ob')->findByPk($model->sid);
            $url=$this->createUrl("book",array('book'=>$city->city_ob->webadress_en));
//			$url=Yii::app()->request->baseUrl."/".$city->webadress_en;
//			var_dump($url);
            Yii::app()->user->setState('city_data',$_POST["search-params"]);
            Yii::app()->user->setState('book_data',$_POST["book-params"]);
            header("Location:".$url);
            $this->render('test',array('url'=>$url,'date'=>date("Y-m-d-n-w")));

//		if(isset($_POST['book-params'])) var_dump ($_POST['book-params']);
        */

    }

    public function actionDispatch()
    {
        /*
        if(isset($_POST['SegScheduledTours']))
        {
            $post=$_POST['SegScheduledTours'];
            if(empty($post['city_id'])) $this->redirect(array("index"));
            $city=SegCities::model()->findByPk($post['city_id']);
            $url=$this->createUrl("city",array('city'=>$city->webadress_en));
//			$url=Yii::app()->request->baseUrl."/".$city->webadress_en;
//			var_dump($url);
            Yii::app()->user->setState('city_data',json_encode($post));
            header("Location:".$url);
        }
        else $this->redirect(array("index"));
        */

    }

    public function actionCity($city = null)
    {
        $model = new SegScheduledTours('search_f');
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['SegScheduledTours'])) {///kent
            $city = null;
            $json_data = json_encode($_POST['SegScheduledTours']);
            Yii::app()->session->add('last_search', $json_data);
            Yii::app()->user->setState('city_data', $json_data);
        }
        if (Yii::app()->user->hasState("city_data")) {
            if(Yii::app()->user->getState("city_data")){
			  $postdata = get_object_vars(json_decode(Yii::app()->user->getState("city_data")));
              $model->setAttributes($postdata);
			}
            //var_dump($postdata);
            Yii::app()->user->setState('city_data', null);
        }

        if (!is_null($city))
            $model->setAttribute("city_id", $city);
        if (empty($model->city_id)) $this->redirect(array("index"));
//			 throw new CHttpException(403,'Must specify a city before performing this action.');
        $tours = new SegTourroutes('search');
        $tours->setAttribute("cityid", $model->city_id);
        $cur_date = 0;
        $cur_time = 0;

        if (is_null($model->date)) {
            $model->setAttribute("date", date("d-m-Y", time()));
            $cur_date = 1;
        }

        if (is_null($model->starttime)) {
            $time_bd = date('H:i:s', time()); // now time in hosting
            $cur_time = 1;
        } else {
            $time_bd = $model->starttime;
        }
        if (($cur_time == 1) && ($cur_date == 0))
            $model->from_date = date("Y-m-d", strtotime($model->date)) . " 00:00:00";
        else
            $model->from_date = date("Y-m-d", strtotime($model->date)) . " " . $time_bd;

        $this->render('city', array('model' => $model, 'tours' => $tours));
    }
    ////
    //
    //
    ////
    public function actionAjaxSearchTours()
    {
        $error = 1;
        $msg = 'Not found';
        $last_search = Yii::app()->session->get('last_search');
        $arr = json_decode($last_search);
        if (isset($_POST['action'])) {
            $act = $_POST['action'];
            $type = $_POST['tid'];
            $page = $_POST['page'];
            $tnmax = $_POST['tnmax'];
        } else {
            $type = 1;
            $page = 1;
            $tnmax = 12;
        }
        $model = new SegScheduledTours('search_f');
        $model->unsetAttributes();  // clear any default values
        if (!empty($arr->city_id)) $model->setAttribute('city_id', $arr->city_id);
        if (!empty($arr->starttime)) $model->setAttribute('starttime', $arr->starttime);
        if (!empty($arr->guide1_id)) $model->setAttribute('guide1_id', $arr->guide1_id);
        if (!empty($arr->date)) $model->setAttribute('date', $arr->date);
        if (!empty($arr->language_id)) $model->setAttribute('language_id', $arr->language_id);

        $cur_time = 0;
        $dt = "";
        $date_bd = date('Y-m-d', strtotime($arr->date));
        if (is_null($model->starttime)) {
            $time_bd = date('H:i:s', time()); // now time in hosting
            if ($date_bd != date('Y-m-d')) $dt = $date_bd . ' 00:00:00';
        } else {
            $time_bd = $model->starttime;
        }
        if (strlen($dt) == 0) $dt = $date_bd . ' ' . $time_bd;

        $model->from_date = $dt;
        $dp = $model->search_f($type);

        $list_data = $dp->getData();
        //$dp->pagination->pageSize = 100;
        $dp->pagination->currentPage = $page;

        //var_dump($dp->pagination,$page); exit;

        $ar_data = array();

        foreach ($list_data as $n => $item) {
            //var_dump($item->user_ob);exit;
            ////
            $rec = User::model()->with(array('guide_ob', 'contact_ob'))->findByPk($item->user_ob->id);
            ////flag
            $flag_img = array();
            if ($item->language_id == null) {
                foreach ($item->user_ob->languages as $la) {
                    $flag_img[] = $la['flagpic'];
                }
            } else $flag_img[] = $item->language_ob->flagpic;
            /////
            $rest = $tnmax;
            if ($item->current_subscribers > 0) $rest = $tnmax - $item->current_subscribers;
            ////
            $ar_data[$n] = array(
                'name_guide' => $item->user_ob->guidename,
                'foto_guide' => $item->user_ob->guidepic,
                'date_tour' => CHtml::encode(date('l, d F Y', $item->date_now)),
                'time_tour' => CHtml::encode(substr_replace($item->starttime, '', 5)),
                'flag_img' => $flag_img,
                'tnmax' => $tnmax,
                'rest' => $rest,
                'id_tour' => $item->idseg_scheduled_tours,
                'tid' => $type,
                'shorttext' => $rec->guide_ob->guide_shorttext,
                'maintext' => $rec->guide_ob->guide_maintext,
                'visible' => $visible
            );

        }
        //print_r($ar_data);
        if (count($ar_data) > 0) {
            $error = 0;
            $msg = 'found tours';
        }
        $ot = array('error' => $error, 'msg' => $msg, 'data' => $ar_data);
        sleep(1);
        echo json_encode($ot);
        Yii::app()->end();
    }

    ///
    public function actionAjaxGuide()
    {
        if (!Yii::app()->request->isAjaxRequest) {
            echo CJSON::encode(array(
                'status' => 'failure',
                'div' => 'No Request'));
            exit;
        }
        $vali = $_POST['id'];
        if (!empty($vali)) {
            $sid = substr($vali, 4);
            $id = (int)$sid;
            $rec = User::model()->with(array('guide_ob', 'contact_ob'))->findByPk($id);
            $img = CHtml::image(Yii::app()->request->baseUrl . "/image/guide/" . $rec->guidepic, "User Image", array("height" => "150px;"));
            echo CJSON::encode(array(
                'status' => $rec->guidename,
                'div' => "<div>" . $img . "</div><div style='margin:10px 5px;'>" . $rec->guide_ob->guide_shorttext . "</div><div style='font-size:.8em;'>" . $rec->guide_ob->guide_maintext . "</div>"));
        }

    }

    public function actionAjaxLoad()
    {
        $val1 = $_POST;
        $model = new SegScheduledTours('search_f');
//		print_r($val1);
//		return;
        $arr = json_decode($val1['arrdata']);
        if (!empty($arr->city_id)) $model->setAttribute('city_id', $arr->city_id);
        if (!empty($arr->starttime)) $model->setAttribute('starttime', $arr->starttime);
        if (!empty($arr->guide1_id)) $model->setAttribute('guide1_id', $arr->guide1_id);
        if (!empty($arr->date)) $model->setAttribute('date', $arr->date);
        if (!empty($arr->language_id)) $model->setAttribute('language_id', $arr->language_id);
        $cur_time = 0;
        $dt = "";
        $date_bd = date('Y-m-d', strtotime($arr->date));
        if (is_null($model->starttime)) {
            $time_bd = date('H:i:s', time()); // now time in hosting
            if ($date_bd != date('Y-m-d')) $dt = $date_bd . ' 00:00:00';
        } else {
            $time_bd = $model->starttime;
        }
        if (strlen($dt) == 0) $dt = $date_bd . ' ' . $time_bd;
        $model->from_date = $dt;
        $dp = $model->search_f($val1['type']);
        $dp->pagination->currentPage = $val1['page'];
        echo "-" . ($val1['page'] + 1) . "-";
        $this->renderPartial('_loop', array('dataProvider' => $dp,
            'tid' => $val1['type'],
            'tnmax' => $val1['tnmax']));
//		print_r ($model->search_f($val1['type'])->getKeys());
        Yii::app()->end();
    }

    public function actionResult()
    {
        if (isset($_POST['Seachmain']['date'])) {
            if (($_POST['Seachmain']['date'] == null) or ($_POST['Seachmain']['date'] == '')) {
                $date = date('d.m.Y');
            } else {
                $date = $_POST['Seachmain']['date'];
            }
        } else {
            $date = date('d.m.Y');
        }

        //print_r('88');

        if (!isset($_POST['Seachmain']['city'])) {
            $name_city = 1;
        } else {
            if ($_POST['Seachmain']['city'] == 0) {
                $name_city = 1;
            } else {
                $name_city = $_POST['Seachmain']['city'];
            }
        }

        if (isset($_POST['Filter'])) {
            $city_f = $_POST['Filter']['city'];
            $date_f = $_POST['Filter']['date_n'];
            $time_f = $_POST['Filter']['time_n'];


            //print_r($time_f);
            //('888');


            $language_f = $_POST['Filter']['language'];
            $guide_f = $_POST['Filter']['guide'];
        } else {
            $city_f = null;
            $date_f = null;
            $time_f = null;
            $language_f = null;
            $guide_f = null;
        }

        //print_r($city_f);

        if ($name_city == 1) {
            $city_cookie = 'city_berlin';
            $date_cookie = 'date_berlin';
            $cookie_c = new CHttpCookie($city_cookie, $name_city);
            Yii::app()->request->cookies[$city_cookie] = $cookie_c;
            $cookie_d = new CHttpCookie($date_cookie, $date);
            Yii::app()->request->cookies[$date_cookie] = $cookie_d;

            $berlin_link = Yii::app()->createUrl('berlin?city=' . $city_f . '&date=' . $date_f . '&time=' . $time_f . '&language=' . $language_f . '&guide=' . $guide_f);
            header('Location: ' . $berlin_link);
        }
        if ($name_city == 2) {
            $city_cookie = 'city_munich';
            $date_cookie = 'date_munich';
            $cookie_c = new CHttpCookie($city_cookie, $name_city);
            Yii::app()->request->cookies[$city_cookie] = $cookie_c;
            $cookie_d = new CHttpCookie($date_cookie, $date);
            Yii::app()->request->cookies[$date_cookie] = $cookie_d;

            $munich_link = Yii::app()->createUrl('munich');
            header('Location: ' . $munich_link);
        }
        if ($name_city == 'Dresden') {
            $name_city = 'Berlin';
            $city_cookie = 'city';
            $date_cookie = 'date';
            $cookie_c = new CHttpCookie($city_cookie, $name_city);
            Yii::app()->request->cookies[$city_cookie] = $cookie_c;
            $cookie_d = new CHttpCookie($date_cookie, $date);
            Yii::app()->request->cookies[$date_cookie] = $cookie_d;

            $dresden_link = Yii::app()->createUrl('dresden');
            header('Location: ' . $dresden_link);
        }
        if ($name_city == 'Stuttgart') {
            $name_city = 'Berlin';
            $city_cookie = 'city';
            $date_cookie = 'date';
            $cookie_c = new CHttpCookie($city_cookie, $name_city);
            Yii::app()->request->cookies[$city_cookie] = $cookie_c;
            $cookie_d = new CHttpCookie($date_cookie, $date);
            Yii::app()->request->cookies[$date_cookie] = $cookie_d;

            $stuttgart_link = Yii::app()->createUrl('stuttgart');
            header('Location: ' . $stuttgart_link);
        }
        if ($name_city == 'Augsburg') {
            $name_city = 'Berlin';
            $city_cookie = 'city';
            $date_cookie = 'date';
            $cookie_c = new CHttpCookie($city_cookie, $name_city);
            Yii::app()->request->cookies[$city_cookie] = $cookie_c;
            $cookie_d = new CHttpCookie($date_cookie, $date);
            Yii::app()->request->cookies[$date_cookie] = $cookie_d;

            $augsburg_link = Yii::app()->createUrl('augsburg');
            header('Location: ' . $augsburg_link);
        }
        if ($name_city == 'Regensburg') {
            $name_city = 'Berlin';
            $city_cookie = 'city';
            $date_cookie = 'date';
            $cookie_c = new CHttpCookie($city_cookie, $name_city);
            Yii::app()->request->cookies[$city_cookie] = $cookie_c;
            $cookie_d = new CHttpCookie($date_cookie, $date);
            Yii::app()->request->cookies[$date_cookie] = $cookie_d;

            $regensburg_link = Yii::app()->createUrl('regensburg');
            header('Location: ' . $regensburg_link);
        }
        if ($name_city == 'Koln') {
            $name_city = 'Berlin';
            $city_cookie = 'city';
            $date_cookie = 'date';
            $cookie_c = new CHttpCookie($city_cookie, $name_city);
            Yii::app()->request->cookies[$city_cookie] = $cookie_c;
            $cookie_d = new CHttpCookie($date_cookie, $date);
            Yii::app()->request->cookies[$date_cookie] = $cookie_d;

            $koln_link = Yii::app()->createUrl('koln');
            header('Location: ' . $koln_link);
        }
    }

    public function actionShow($id)
    {
        $id_control = Yii::app()->user->id;
        // $update_user = User::model()->findByPk($id_user);
        $role_control = User::model()->findByPk($id_control)->id_usergroups;
        //  $id_guide = SegGuidesdata::model()->findByPk($update_user->id_guide)->idseg_guidesdata;

        if ($role_control == 1) {
            $this->layout = "root";
        }
        if ($role_control == 2) {
            $this->layout = "admin";
        }
        if ($role_control == 3) {
            $this->layout = "office";
        }
        if ($role_control == 5) {
            $this->layout = "guide";
        }

        $model = $this->loadModel($id);

        //city
        //$citie->seg_cityname = '';
        $j = 0;
        $criteria_city = new CDbCriteria;
        $criteria_city->condition = 'users_id=:users_id';
        $criteria_city->params = array(':users_id' => $model->guide1_id);
        $city = SegGuidesCities::model()->find($criteria_city);
        if (isset($city)) {
            $criteria_c = new CDbCriteria;
            $criteria_c->condition = 'idseg_cities=:idseg_cities';
            $criteria_c->params = array(':idseg_cities' => $city->cities_id);
            $citie = SegCities::model()->find($criteria_c);

            $model->city_id_all = $citie->seg_cityname;
            $j = $citie->idseg_cities;
        } else {
            $model->city_id_all = 'no element';
        }

        //language
        if ($model->language_id == NULL) {
            $i = 0;
            $criteria_language = new CDbCriteria;
            $criteria_language->condition = 'users_id=:users_id';
            $criteria_language->params = array(':users_id' => $model->guide1_id);
            $language = SegLanguagesGuides::model()->findAll($criteria_language);
            if (isset($language)) {
                foreach ($language as $item) {
                    $criteria_i = new CDbCriteria;
                    $criteria_i->condition = 'id_languages=:id_languages';
                    $criteria_i->params = array(':id_languages' => $item->languages_id);
                    $languages = Languages::model()->findAll($criteria_i);
                    $model->language_id_all[$i] = $languages;
                    $i++;
                }
            } else {
                $model->language_id_all[0] = 'no element';
            }
        } else {
            $criteria_i = new CDbCriteria;
            $criteria_i->condition = 'id_languages=:id_languages';
            $criteria_i->params = array(':id_languages' => $model->language_id);
            $language = Languages::model()->find($criteria_i);
            $model->language_id_all[0] = $language;
        }

        //tour canegories + tourroute
        //$tourroute_id_all;
        $z = 0;
        $criteria_tour = new CDbCriteria;
        $criteria_tour->condition = 'usersid=:usersid';
        $criteria_tour->params = array(':usersid' => $model->guide1_id);

        $tourcats = SegGuidesTourroutes::model()->findAll($criteria_tour);
        if (isset($tourcats)) {
            foreach ($tourcats as $tourroute) {
                $criteria_t = new CDbCriteria;
                $criteria_t->condition = 'id_tour_categories=:id_tour_categories AND cityid=:cityid';
                $criteria_t->params = array(':id_tour_categories' => $tourroute->tourroutes_id, ':cityid' => $j);
                $tourroutes = SegTourroutes::model()->find($criteria_t);
                $model->tourroute_id_all[$z] = $tourroutes->name;
                $z++;
            }


        } else {
            $model->tourroute_id_all[0] = 'no element';
        }

        $this->render('show', array('model' => $model));


    }

    public function actionWeeks($date)
    {
        $id_control = Yii::app()->user->id;
        // $update_user = User::model()->findByPk($id_user);
        $role_control = User::model()->findByPk($id_control)->id_usergroups;
        //  $id_guide = SegGuidesdata::model()->findByPk($update_user->id_guide)->idseg_guidesdata;

        if ($role_control == 1) {
            $this->layout = "root";
        }
        if ($role_control == 2) {
            $this->layout = "admin";
        }
        if ($role_control == 3) {
            $this->layout = "office";
        }
        if ($role_control == 5) {
            $this->layout = "guide";
        }


        //city work
        $criteria_city = new CDbCriteria;
        $criteria_city->condition = 'users_id=:users_id';
        $criteria_city->params = array(':users_id' => $id_control);
        $id_city = SegGuidesCities::model()->find($criteria_city)->cities_id;


        $model_week = array();
        $i = 0;
        $status_old = '';
        $start_times_tour = SegStarttimes::model()->findAll();
        foreach ($start_times_tour as $item) {
            $day = new DayResult;
            $day->time = $item->timevalue;

            $date_format = strtotime($date);
            $criteria = new CDbCriteria;
            $criteria->condition = 'original_starttime=:original_starttime AND date_now=:date_now AND city_id=:city_id';
            $criteria->params = array(':original_starttime' => $item->timevalue, ':date_now' => $date_format, ':city_id' => $id_city);
            $scheduled_item = SegScheduledTours::model()->find($criteria);
            if (isset($scheduled_item)) {
                $day->id = $scheduled_item->idseg_scheduled_tours;
                $day->starttime = $scheduled_item->starttime;
                if ($scheduled_item->guide1_id == $id_control) {
                    //if($scheduled_item->current_subscribers>0){
                    //    $day->status ='Belegt, braucht aber einen Guide';
                    //}else{
                    $day->status = 'Belegt, Deine Tour!';
                    //}
                } else {
                    $day->status = 'Belegt';
                }
            } else {
                $day->id = 0;
                $day->status = 'frei!';
            }
            if ($status_old == 'Belegt, Deine Tour!') {
                $day->status = 'Block';


            }
            $status_old = $day->status;
            if ($day->status == 'Belegt, Deine Tour!') {
                if ($i != 0) $model_week[$i - 1]->status = 'Block';
            }
            //$day_id_old1 = $day->id;
            //$day_id_old2 = $day->id;


            // $day->status = 1;
            $model_week[$i] = $day;
            $i++;
        }
        // $model=new CActiveDataProvider($model_week);
        //  $date_format = date('Y-m-d', strtotime($date));

        $this->render('weeks', array('date' => $date, 'model' => $model_week));
    }

    public function actionTake($date, $time)
    {
        $id_control = Yii::app()->user->id;
        // $update_user = User::model()->findByPk($id_user);
        $user_control = User::model()->findByPk($id_control);
        $role_control = $user_control->id_usergroups;
        // $id_guide = SegGuidesdata::model()->findByPk($update_user->id_guide)->idseg_guidesdata;

        if ($role_control == 1) {
            $this->layout = "root";
        }
        if ($role_control == 2) {
            $this->layout = "admin";
        }
        if ($role_control == 3) {
            $this->layout = "office";
        }
        if ($role_control == 5) {
            $this->layout = "guide";
        }

        if ($role_control == 5) {
            $date_format = strtotime($date);
            $date_bd = date('Y-m-d', $date_format);

            $criteria_city = new CDbCriteria;
            $criteria_city->condition = 'users_id=:users_id';
            $criteria_city->params = array(':users_id' => $id_control);
            $id_city = SegGuidesCities::model()->find($criteria_city)->cities_id;

            $scheduled_item = new SegScheduledTours;
            $scheduled_item->starttime = $time;
            $scheduled_item->date_now = $date_format;
            $scheduled_item->date = $date_bd;
            $scheduled_item->guide1_id = $id_control;
            $scheduled_item->original_starttime = $time;
            $scheduled_item->visibility = 1;
            // $scheduled_item->tourroute_id =  $tour_schel;//???????????????????????????
            $scheduled_item->city_id = $id_city;
            $scheduled_item->save();
            $this->redirect(Yii::app()->createUrl('segScheduledTours/weeks', array('date' => $date)));
        } else {


        }
    }

    public function actionSpontan()
    {
        $id_control = Yii::app()->user->id;
        // $update_user = User::model()->findByPk($id_user);
        $user_control = User::model()->findByPk($id_control);
        $role_control = $user_control->id_usergroups;
        // $id_guide = SegGuidesdata::model()->findByPk($update_user->id_guide)->idseg_guidesdata;

        if ($role_control == 1) {
            $this->layout = "root";
        }
        if ($role_control == 2) {
            $this->layout = "admin";
        }
        if ($role_control == 3) {
            $this->layout = "office";
        }
        if ($role_control == 5) {
            $this->layout = "guide";
        }
        $model = new SegScheduledTours;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['SegScheduledTours'])) {
            //$model->attributes=$_POST['SegScheduledTours'];
            $datetime = strtotime($_POST['SegScheduledTours']['date_time']);
            $date_bd = date('Y-m-d', $datetime);
            //starttime
            $model->starttime = date('H:i:s', $datetime);
            //date_now
            $model->date_now = strtotime(date('d.m.Y', $datetime));
            $model->date = $date_bd;
            //guide1_id
            $model->guide1_id = $id_control;
            //original_starttime
            $model->original_starttime = '00:00:00';
            //visibility
            $model->visibility = 1;
            //city_id
            $criteria = new CDbCriteria;
            $criteria->condition = 'users_id=:users_id';
            $criteria->params = array(':users_id' => $id_control);
            $model->city_id = SegGuidesCities::model()->find($criteria)->cities_id;

            if ($model->save())
                $this->redirect(array('admin'));
        }

        $this->render('spontan', array(
            'model' => $model,
        ));

    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $this->layout = "admin";
        $model = new SegScheduledTours;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['SegScheduledTours'])) {
            $model->attributes = $_POST['SegScheduledTours'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->idseg_scheduled_tours));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */


    /**
     * Manages all models.
     */
    public function actionAdmins()
    {
        $model = new SegScheduledTours('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['SegScheduledTours']))
            $model->attributes = $_GET['SegScheduledTours'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionAdmin()
    {
        $id_control = Yii::app()->user->id;
        // $update_user = User::model()->findByPk($id_user);
        $role_control = User::model()->findByPk($id_control)->id_usergroups;
        //  $id_guide = SegGuidesdata::model()->findByPk($update_user->id_guide)->idseg_guidesdata;

        if ($role_control == 1) {
            $this->layout = "root";
        }
        if ($role_control == 2) {
            $this->layout = "admin";
        }
        if ($role_control == 3) {
            $this->layout = "office";
        }
        if ($role_control == 5) {
            $this->layout = "guide";
        }


        $criteria = new CDbCriteria;
        $criteria->condition = 'guide1_id=:guide1_id';
        $criteria->params = array(':guide1_id' => $id_control);
        //$//criteria->order = '(date_now DESC) AND (starttime DESC)';
        // $criteria->order = 'starttime DESC';
        //  $model = SegScheduledTours::model()->findAll($criteria);
        //  print_r($model);
        //   $dataProvider =  new CActiveDataProvider($model, array(
        //	'criteria'=>$criteria,
        //  'id'=>'idseg_scheduled_tours',
        //      'sort'=>array(
        //          'attributes'=>array(
        //                  'date_now', 'starttime',
        //           ),
        //       ),
        //	));
        //   $mmm=$dataProvider->getData();
        // $model=new SegScheduledTours('search_s',array('id_guide1'=>$id_control));

        $model = new SegScheduledTours();

        /*$model->unsetAttributes();  // clear any default values
        if(isset($_GET['SegScheduledTours']))
            $model->attributes=$_GET['SegScheduledTours'];*/

        $this->render('admin', array(
            'model' => $model, 'id_control' => $id_control
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return SegScheduledTours the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = SegScheduledTours::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadTR($id, $cat)
    {
        $model = SegTourroutes::model()->findByAttributes(array('cityid' => $id, 'id_tour_categories' => $cat));
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param SegScheduledTours $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'seg-scheduled-tours-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
<?php

class ThankyousendController extends Controller
{
    public $layout = '//layouts/front_bs';

    public function actionIndex()
    {
        $session = new CHttpSession;
        $otpr = $stopt = 0;
        if (isset($_POST['input_email']) && $_POST['input_email'] !== '') {
            $model = SegScheduledTours::model()->findByPk($_POST['sid'] * 1); //$_POST['sid']*1);
            $tour = SegTourroutes::model()->findByAttributes(array('cityid' => $model->city_id, 'id_tour_categories' => $_POST['tid'] * 1));

            /////
            $starttime = str_replace('00:00', '00', $model->starttime);
            $tourdate = $this->dateEn($model->date);

            if (!empty($model->duration)) {
                $stopt = $model->duration;
            } else {
                $stopt = $tour->standard_duration;
            }
            $stoptime = date("H:i", strtotime($model->date . ' ' . $model->starttime) + ($stopt * 60)) . ' Uhr';
            $tour_guest = '';
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
            ////
            ////point
            $meetingpoint = $tour->meetingpoint_description;
            if (Yii::app()->language == 'en') $meetingpoint = $tour->meetingpoint_description_en;
            $session['city_en'] = $model->city_ob->webadress_en;
			$session['city_name'] = $model->city_ob->seg_cityname;
            if (is_array($_POST['input_email'])) {
                $mailtext = array(
                    'city_name' => $model->city_ob->seg_cityname,
                    'city_en' => $model->city_ob->webadress_en,
                    'tour_date' => $tourdate,
                    'tour_starttime' => $starttime,
                    'tour_stoptime' => $stoptime,
                    'tour_guest' => $_POST['guest'],
                    'tour_name' => $tour_name,
                    'tour_lang' => $text_lang,
                    'tour_guide_name' => $model->user_ob->guidename,
                    'tour_guide_tel' => $model->user_ob->contact_ob->phone,
                    'contact_name' => $_POST['contact_name'],
                    'contact_street' => $_POST['contact_street'],
                    'contact_city' => $_POST['contact_city'],
                    'contact_land' => $_POST['contact_land'],
                    'contact_tel' => $_POST['contact_tel'],
                    'contact_email' => $_POST['contact_email'],
					'meetingpoint' => $meetingpoint
                );
                foreach ($_POST['input_email'] as $k => $email) {
                    $msg = $this->renderPartial('tour_mail', $mailtext, TRUE);
                    if ($this->sendMail($email, 'Cherrytours: ' . $tour_name, $msg)) {
                        $otpr++;
                    }

                }
            }
            //$otpr=0;
			
            $session['text_link'] = 'Einladungen werden nicht gesendet. Fehler-Mail-Server.';
            if ($otpr > 0) {
                $session['text_link'] = 'Bestätigung per Email versendet';
				echo '<meta http-equiv="refresh" content="0">';
                exit;
            }
        }
        $this->render('mail_success', array('text_link' =>  $session['text_link'], 'city_en' =>  $session['city_en'], 'city_name' =>  $session['city_name']));
		
    }
}
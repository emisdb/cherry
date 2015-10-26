<?php

class SegGuidestourinvoicescustomersController extends Controller
{
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(''),
	       		'users'=>array('*'),  
			),
		    array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('current','createpdf','info','ajaxInfo'),
                'roles'=>array('guide'),
			),            
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(''),
                'roles'=>array('office'),                
			),
           	array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(''),
                'roles'=>array('admin'),                
			),            
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(''),
                'roles'=>array('root'),                
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),

		);
	}
	
	//*********************************INFO FOR GUIDE***********************************************//
	public function actionInfo($id_sched=null,$date=null,$time=null)
	{
		
		$id_control = Yii::app()->user->id;
		$guide = User::model()->findByPk($id_control);
        $role_control = $guide->id_usergroups;    

         
        if($role_control==1){
            $this->layout = "root";
        }        
        if($role_control==2){
            $this->layout = "admin";
        }   
        if($role_control==3){
            $this->layout = "office";
        } 
        if($role_control==5){
            $this->layout = "guide";
		}
		
		//sched
		$sched = SegScheduledTours::model()->findByPk($id_sched);
		
		//tour
		$tour = SegTourroutes::model()->findByPk($sched->tourroute_id);
		
		//tourroutes
		$criteria_tourroutes = new CDbCriteria;
		$criteria_tourroutes->condition = 'usersid=:usersid AND tourroutes_id=:tourroutes_id';
		$criteria_tourroutes->params = array(':usersid'=>$sched->user_ob->id,'tourroutes_id'=>$tour->id_tour_categories);
		$gonorar_tour = SegGuidesTourroutes::model()->find($criteria_tourroutes);
		
		//mainoption
		$criteria_vat = new CDbCriteria;
		$criteria_vat->condition = 'name=:name ';
		$criteria_vat->params = array(':name'=>'Vat');
		$vat = Mainoptions::model()->find($criteria_vat)->value;
				
		//cash
		$criteria_cash = new CDbCriteria;
		$criteria_cash->order ='timestamp DESC';
		$criteria_cash->condition = 'users_id=:users_id ';
		$criteria_cash->params = array(':users_id'=>$sched->guide1_id);
		$cash = CashboxHistory::model()->find($criteria_cash);
	
		//segguidestourinvoices
		$criteria_invoice = new CDbCriteria;
		$criteria_invoice->condition = 'id_sched=:id_sched ';
		$criteria_invoice->params = array(':id_sched'=>$sched->idseg_scheduled_tours);
		$invoice = SegGuidestourinvoices::model()->find($criteria_invoice);
		$cashincome = $invoice->cashIncome;
		
		//segguidestourinvoicescustomers
		$criteria_c = new CDbCriteria;
		$criteria_c->condition = 'tourInvoiceid=:tourInvoiceid AND isPaid=:isPaid';
		$criteria_c->params = array(':tourInvoiceid'=>$invoice->idseg_guidesTourInvoices, ':isPaid'=>1);
		$invoicecustomer = count(SegGuidestourinvoicescustomers::model()->findAll($criteria_c));
		
		$cifra = $invoicecustomer - $gonorar_tour->guest_variable;
		if($cifra<=0){$cifra=0;}//turists >
		$gonorar = $gonorar_tour->base_provision+$cifra*$gonorar_tour->guestsMinforVariable;//summa gonorar
		//$gonorar_vat = $gonorar*$vat/100;
		
		$this->render('info',array(
			'gonorar_tour'=>$gonorar_tour,
			'cifra'=>$cifra,
			'gonorar'=>$gonorar,
			//'gonorar_vat'=>$gonorar_vat,
			'vat'=>$vat,
			
			'cash'=>$cash,
			'cashincome'=>$cashincome,
			
			'id_sched'=>$id_sched,
			'date'=>$date,
			'time'=>$time,
		));
	}
	public function actionAjaxInfo()
	{
	if (!Yii::app()->request->isAjaxRequest)
			{
				echo CJSON::encode(array(
					'status'=>'failure', 
					'div'=>'No Request'));
//					'div'=>$this->renderPartial('_form', array('model'=>$model), true)));
				exit;               
			}
		$id_sched = $_POST['id_sched'];
		$date = $_POST['date'];
		$time = $_POST['time'];

		$id_control = Yii::app()->user->id;
		$guide = User::model()->findByPk($id_control);
        $role_control = $guide->id_usergroups;    

   
		//sched
		$sched = SegScheduledTours::model()->findByPk($id_sched);
		
		//tour
		$tour = SegTourroutes::model()->findByPk($sched->tourroute_id);
		
		//tourroutes
		$criteria_tourroutes = new CDbCriteria;
		$criteria_tourroutes->condition = 'usersid=:usersid AND tourroutes_id=:tourroutes_id';
		$criteria_tourroutes->params = array(':usersid'=>$sched->user_ob->id,'tourroutes_id'=>$tour->id_tour_categories);
		$gonorar_tour = SegGuidesTourroutes::model()->find($criteria_tourroutes);
		
		//mainoption
		$criteria_vat = new CDbCriteria;
		$criteria_vat->condition = 'name=:name ';
		$criteria_vat->params = array(':name'=>'Vat');
		$vat = Mainoptions::model()->find($criteria_vat)->value;
				
		//cash
		$criteria_cash = new CDbCriteria;
		$criteria_cash->order ='timestamp DESC';
		$criteria_cash->condition = 'users_id=:users_id ';
		$criteria_cash->params = array(':users_id'=>$sched->guide1_id);
		$cash = CashboxHistory::model()->find($criteria_cash);
	
		//segguidestourinvoices
		$criteria_invoice = new CDbCriteria;
		$criteria_invoice->condition = 'id_sched=:id_sched ';
		$criteria_invoice->params = array(':id_sched'=>$sched->idseg_scheduled_tours);
		$invoice = SegGuidestourinvoices::model()->find($criteria_invoice);
		$cashincome = $invoice->cashIncome;
		
		//segguidestourinvoicescustomers
		$criteria_c = new CDbCriteria;
		$criteria_c->condition = 'tourInvoiceid=:tourInvoiceid AND isPaid=:isPaid';
		$criteria_c->params = array(':tourInvoiceid'=>$invoice->idseg_guidesTourInvoices, ':isPaid'=>1);
		$invoicecustomer = count(SegGuidestourinvoicescustomers::model()->findAll($criteria_c));
		
		$cifra = $invoicecustomer - $gonorar_tour->guest_variable;
		if($cifra<=0){$cifra=0;}//turists >
		$gonorar = $gonorar_tour->base_provision+$cifra*$gonorar_tour->guestsMinforVariable;//summa gonorar
		//$gonorar_vat = $gonorar*$vat/100;
		
		$result=$this->renderPartial('info',array(
			'gonorar_tour'=>$gonorar_tour,
			'cifra'=>$cifra,
			'gonorar'=>$gonorar,
			//'gonorar_vat'=>$gonorar_vat,
			'vat'=>$vat,
			
			'cash'=>$cash,
			'cashincome'=>$cashincome,
			
			'id_sched'=>$id_sched,
			'date'=>$date,
			'time'=>$time,
			'ajax'=>true,
		),true);
				echo CJSON::encode(array(
					'status'=>'failure', 
					'div'=>$result));
	}
	
	
	public function actionCreatepdf($id_invoice=null,$id_tour=null)
	{
		
		
		//*********************************INFO FOR PDF***********************************************//
		//tour
		$tour = SegTourroutes::model()->findByPk($id_tour);
		$mails=array();

		
		//invoicecustomers - booking
		$criteria_book = new CDbCriteria;
		$criteria_book->condition = 'tourInvoiceid=:tourInvoiceid ';
		$criteria_book->params = array(':tourInvoiceid'=>$id_invoice);
		$invoicecustomers = SegGuidestourinvoicescustomers::model()->with(array('booking'=>array('contact')))->findAll($criteria_book);

		//create segguidestourinvoices
		$invoice_id = $invoicecustomers[0]->tourInvoiceid;
		
		$invoice = SegGuidestourinvoices::model()->findByPk($invoice_id);
		$id_guide = $invoice->guideNr;
			
		//sched
		//$booking = SegBookings::model()->findByPk($id_book);
		//if(!empty($booking)){
			$sched = SegScheduledTours::model()->findByPk($invoice->id_sched);
			$sched->openTour = 1;//create pdf
			//SRM_guide
			$user = User::model()->findByPk($id_guide);

			if($user->contact_ob['firstname']!=''){$a = $user->contact_ob['firstname']{0};}else{$a='0';}

			if($user->contact_ob['surname']!=''){$b = $user->contact_ob['surname']{0};}else{$b='0';}
			
						
										
			
			$c = $tour->city['seg_cityname']{0};
			$id_guide = $user->id;
			$year = date('y',time());
	
			$num=0;
			$criteria_i = new CDbCriteria;
			$criteria_i->condition = 'guide1_id=:guide1_id AND openTour=:openTour';
			$criteria_i->params = array(':guide1_id'=>$id_guide,'openTour'=>1);
			$schedall = SegScheduledTours::model()->findAll($criteria_i);
			foreach($schedall as $item){
				$year_item = date('y',$item->date_now);
				if($year_item == $year){
					$num++;
				}
			}
			
			$num = $num+1;
			$sched->GN_string = $a.$b.$c.'/'.$id_guide.'/'.$year.'/'.$num;		
					
	
			$invoice->creationDate = $sched->date;

			//tourroutes
			$criteria_tourroutes = new CDbCriteria;
			$criteria_tourroutes->condition = 'usersid=:usersid AND tourroutes_id=:tourroutes_id';
			$criteria_tourroutes->params = array(':usersid'=>$sched->user_ob->id,'tourroutes_id'=>$tour->id_tour_categories);
			$tourroutes = SegGuidesTourroutes::model()->find($criteria_tourroutes);
		//}
		
		//mainoption
		$criteria_vat = new CDbCriteria;
		$criteria_vat->condition = 'name=:name ';
		$criteria_vat->params = array(':name'=>'Vat');
		$vat = Mainoptions::model()->find($criteria_vat)->value;
		
		$criteria_firma = new CDbCriteria;
		$criteria_firma->condition = 'name=:name ';
		$criteria_firma->params = array(':name'=>'Firma');
		$firma = Mainoptions::model()->find($criteria_firma)->value;




		//segguidestourinvoicescustomers-symma
		$criteria_c = new CDbCriteria;
		$criteria_c->condition = 'tourInvoiceid=:tourInvoiceid AND isPaid=:isPaid';
		$criteria_c->params = array(':tourInvoiceid'=>$invoice->idseg_guidesTourInvoices, ':isPaid'=>1);
		$invoicecustomer = count(SegGuidestourinvoicescustomers::model()->findAll($criteria_c));

		$cifra = $invoicecustomer - $tourroutes->guest_variable;
		
	
		
		
		if($cifra<=0){$cifra=0;}//turists >
		
	
		$gonorar = $tourroutes->base_provision+$cifra*$tourroutes->guestsMinforVariable;//summa gonorar
		
	
		$gonorar_vat = $gonorar*(1-1/($vat/100+1));
		
								
		
		$gonorar_vat = number_format($gonorar_vat, 2, '.', ' ');
		
	
		$sum_itog=0;
		$sum_bar=0;
		//foreach($invoicecustomers as $item){
			//$sum_itog=$sum_itog+$item->price;
			//if($item->paymentoptionid==1) $sum_bar = $sum_bar+$item->price;
		//}
	//	$invoice->overAllIncome = $sum_itog;
	//	$invoice->cashIncome =  $sum_bar;




	 	$sum_itog = number_format($invoice->overAllIncome, 2, '.', ' ');
		$sum_bar = number_format($invoice->cashIncome, 2, '.', ' ');
		
		$b = $tour->city['seg_cityname']{0};
		$year = date('y',time());
		$max= Yii::app()->db->createCommand("SELECT max(InvoiceNumber) from seg_guidestourinvoices where cityid=".$tour->cityid)->queryScalar();
		$max_i = $max+1;
		$invoice->TA_string = 'TA'.$b.$year.'/'.$max_i;
		$invoice->InvoiceNumber =$max_i;
		//$invoice->status = 1;
		
		//print_r($invoice);
		$invoice->save();
		
		$sum_vat = $sum_itog*(1-1/($vat/100+1));
		$sum_vat =round($sum_vat , 2);
		$sum_b_vat = $sum_itog - $sum_vat;
		
	
		
		//********************************SAVE INFO FOR PDF************************************************//
		$id_guide = $sched->guide1_id;
		
		$criteria_cash = new CDbCriteria;
		$criteria_cash->order ='timestamp DESC';
		$criteria_cash->condition = 'users_id=:users_id ';
		$criteria_cash->params = array(':users_id'=>$id_guide);
		$cashbox = CashboxHistory::model()->find($criteria_cash);
		
		if(!empty($cashbox)){
			$old_cash = $cashbox->cashBefore;
			$old_delta = $cashbox->delta_cash;
		}else{
			$old_cash = 0;
			$old_delta = 0;
		}
		
		$cashnew = new CashboxHistory;
		$cashnew->users_id = $id_guide;
		$cashnew->delta_cash = $sum_bar;
		$datetime = date('Y-m-d H:i:s', time());
		$cashnew->timestamp =$datetime;
		$cashnew->cashBefore = $old_cash+$old_delta;
		$cashnew->id_type = 1;
		$cashnew->id_sched = $sched->idseg_scheduled_tours;
		$cashnew->save();
		$cashnew1 = new CashboxHistory;
		$cashnew1->users_id = $id_guide;
		$cashnew1->delta_cash = -$gonorar;
		//$datetime = date('Y-m-d H:i:s', time());
		$cashnew1->timestamp =$datetime;
		$cashnew1->id_sched = $sched->idseg_scheduled_tours;
		$cashnew1->cashBefore = $cashnew->cashBefore+$cashnew->delta_cash;
		$cashnew1->id_type = 2;
		$cashnew1->save();
		
		$cashnow = $cashnew->cashBefore+$cashnew->delta_cash;

		//************************************PDF CREATE***************************************************//
		//$pdf->SetFont('freeserif', '', 14);
		$tbl = "" . date('d.m.Y', time()) . "<br>";
		$tbl.= '';

		$printOrders = null;

		$date_format = strtotime($sched->date);
		$date_format = date('d.m.Y',$date_format);
		$time_format = substr_replace($sched->starttime, 0, 4);
		$tbl_array=array();
		$tbl0 = '
				<table style="margin:30px;">
					<tr>
						<td>
							<div style="color:#000000;font-size:20px;font-weight:bold;">Route Accounting<br></div> 
							<table style="width:200px;">
								<tr>
									<td>Invoice number:</td>
									<td style="text-align:right;">'.$invoice->TA_string.'</td>
								</tr>
								<tr>
									<td>Date of invoice:</td>
									<td style="text-align:right;">'.$date_format.'</td>
								</tr>
								<tr>
									<td>Time of day:</td>
									<td style="text-align:right;">'.$time_format.'</td>
								</tr>
								<tr>
									<td>Tour ID:</td>
									<td style="text-align:right;">'.$sched->tourroute_id.'</td>
								</tr>
								<tr>
									<td>Page:</td>
									<td style="text-align:center;">1 of 2</td>
								</tr>
							</table> <br>
							<div style="color:#000000;font-size:15px;">Tour guests on '.$date_format.', '.$time_format.'</div>   
						</td>
						<td style="text-align:right;">';
						$tbl_img = '<img src="'.Yii::app()->request->baseUrl.'/img/str2/logo2.png" width="100px">';
						$tbl01='</td>
					</tr>
				</table>
				<hr style="border:1px solid #000000;">';
				
				$tbl02= '<table style="margin:30px;">
				  <tbody>
					<tr>
					  <th style="font-weight:bold;"><br>&nbsp;<br>TourHostNr<br></th>
					  <th style="font-weight:bold;"><br>&nbsp;<br>Name<br></th>
					  <th style="font-weight:bold;width:100px;"><br>&nbsp;<br>Discount<br></th>
					  <th style="font-weight:bold;"><br>&nbsp;<br>Payment<br></th>
					  <th style="font-weight:bold;width:50px;"><br>&nbsp;<br>Price<br></th>
					  <th style="font-weight:bold;width:50px;"><br>&nbsp;<br>Vat.<br></th>
					  <th style="font-weight:bold;width:100px;text-align:center;"><br>&nbsp;<br>Option<br></th>
					</tr>';
					$i=0;
					if(!empty($invoicecustomers)) { 
						 foreach($invoicecustomers as $item) { 
							 $mails[$item->booking->contact->idcontacts]=$item->booking->contact->email;
						 
							$tbl_zero='<tr>
							  <td>'.$item->KA_string.'</td>
							  <td>'.$item->customersName.'</td>
							  <td>';
								  if($item->discounttype_id==0) {
										$tbl2 = '--';
								  } else {
									  	if($item->discount['val']==0){$tbl2 = $item->discount['name'];}else{
											$tbl2 = $item->discount['val'].' '.$item->discount['type'];
										}
								  }
							  $tbl4 = '</td>
							  <td>'; 
								  if (($item->paymentoptionid==0)or($item->discounttype_id==42)) {
										$tbl5 ='--';
										$work_price = '--';
										$work_vat = '--';
								  } else {
										$tbl5= $item->payment['displayname'];
										$work_price =  $item->price;
										$work_price = number_format($work_price, 2, '.', ' ');
										$work_price = $work_price.'&euro;';
										
										$tr = $item->price*(1-1/($vat/100+1));
										$work_vat =  $tr;
										$work_vat = number_format($work_vat, 2, '.', ' ');
										$work_vat = $work_vat.'&euro;';
								  }
								  if($item->discounttype_id==42) {$option_pdf = $item->invoiceoptions['name'];}else{$option_pdf =null;}
							  $tbl7='</td>
							  <td>'.$work_price.'</td>
							  <td>';
  							  		$tbl8 =$work_vat.'
							  </td>
							  <td style="font-size:8px;text-align:center;">
							  	'.$option_pdf.'
							  </td>
							</tr>';
							$tbl_array[$i] = $tbl_zero.' '.$tbl2.' '.$tbl4.' '.$tbl5.' '.$tbl7.' '.$tbl8;
							$i++;
						  } 
					 } 
					
				  $tbl9='</tbody>
				</table>
				<br>
				<hr style="border:1px solid #000000;">
				<br>&nbsp;<br>
				<table  stytle="border:0px solid red;">
					<tr>
						<td width="45%">&nbsp;</td>
						<td width="30%" style="text-align:left;">Total revenue excluding VAT:</td>
						<td width="10%" style="text-align:right;">'.$sum_b_vat.' &euro;</td>
					</tr>
						<tr>
						<td></td>
						<td style="text-align:left;">Sales tax: </td>
						<td style="text-align:right;">'.$sum_vat.' &euro;</td>
					</tr>
						<tr>
						<td></td>
						<td style="text-align:left;">Total revenue: </td>
						<td style="text-align:right;">'.$sum_itog.' &euro;</td>
					</tr>
						<tr>
						<td></td>
						<td style="text-align:left;font-weight:bold;">Share of cash income includes tax: </td>
						<td style="text-align:right;font-weight:bold;">'.$sum_bar.' &euro;</td>
					</tr>
				</table>
				';
				$tbli='';
				for($j=0;$j<count($tbl_array);$j++){
					$tbli.=$tbl_array[$j];
				}
				$tbl = $tbl0.' '.$tbl_img.' '.$tbl01.' '.$tbl02.' '.$tbli.' '.$tbl9;


				$base_provision = number_format($tourroutes->base_provision, 2, '.', ' ');
				$guestsMinforVariable = number_format($tourroutes->guestsMinforVariable, 2, '.', ' ');
				$gonorar_zero = number_format($gonorar, 2, '.', ' ');
				$cashBefore = number_format($cashnew->cashBefore, 2, '.', ' '); 
				$sum_bar_zero = number_format($sum_bar, 2, '.', ' '); 
				$cashnow_zero = number_format($cashnow, 2, '.', ' '); 
				$delta_cash_zero = number_format($cashnew->delta_cash, 2, '.', ' ');
				$cashnow_enter = $cashnow_zero- $gonorar_zero;
				
				
				$tbl_page2='
				<div style="color:#000000;font-size:20px;font-weight:bold;">Tour Guide</div>
				<br>
				<hr style="border:1px solid #000000;">
				<br>&nbsp;<br>
				<table width="100%" cellpadding="0" cellspacing="3" >
					  <tbody>
						<tr>
						  <td>'.$sched->user_ob->contact_ob['firstname'].' '.$sched->user_ob->contact_ob['surname'].'</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>'.$sched->user_ob->contact_ob['street'].' '.$sched->user_ob->contact_ob['house'].'</td>
						  <td>&nbsp;</td>
						  <td colspan="2" style="font-size:12x;font-weight:bold;">Honorarium&nbsp;accounting:</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>'.$sched->user_ob->contact_ob['postalcode'].' '.$sched->user_ob->contact_ob['city'].'</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>'.$sched->user_ob->contact_ob['country'].'</td>
						  <td>&nbsp;</td>
						  <td>Base honorarium:</td>
						  <td>&nbsp;</td>
						  <td style="text-align:right;">'.$base_provision.'&nbsp;&euro;</td>
						</tr>
						<tr>
						  <td>Tax number</td>
						  <td style="font-weight:bold;text-align:right;">'.$sched->user_ob->guide_ob['taxnumber'].'</td>
						  <td>Guest Number Variable</td>
						  <td style="text-align:center;">'.$cifra.'x</td>
						  <td style="text-align:right;">'.$guestsMinforVariable.'&nbsp;&euro;</td>
						</tr>
						<tr>
						  <td>Tax office</td>
						  <td style="font-weight:bold;text-align:right;">'.$sched->user_ob->guide_ob['taxoffice'].'</td>
						  <td style="font-weight:bold;">Total fees</td>
						  <td>&nbsp;</td>
						  <td style="font-weight:bold;text-align:right;">'.$gonorar_zero.'&nbsp;&euro;</td>
						</tr>
						<tr>
						  <td>Guide`s Invoice</td>
						  <td style="font-weight:bold;text-align:right;">'.$sched->GN_string.'</td>
						  <td colspan="2">(including '.$vat.'% vat:&nbsp;'.$gonorar_vat.'&nbsp;&euro;)</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>The fee in the amount of</td>
						  <td style="font-weight:bold;text-align:right;">'.$gonorar_zero.'&nbsp;&euro;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>Was obtained from</td>
						  <td style="font-weight:bold;text-align:right;">'.$firma.'</td>
						  <td style="font-size:12x;font-weight:bold;">Cash:</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>In cash to</td>
						  <td style="font-weight:bold;text-align:right;">'.$sched->user_ob->contact_ob['firstname'].' '.$sched->user_ob->contact_ob['surname'].'</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>paid</td>
						  <td>&nbsp;</td>
						  <td>Cash old:</td>
						  <td>&nbsp;</td>
						  <td style="text-align:right;">'.$cashBefore.'&nbsp;&euro;</td>
						</tr>
						<tr>
						  <td colspan="2" style="font-weight:bold;">I confirm the new cash bar consisted of</td>
						  <td>Cash receipts</td>
						  <td>&nbsp;</td>
						  <td style="text-align:right;">'.$sum_bar_zero.'&nbsp;&euro;</td>
						</tr>
						<tr>
						  <td colspan="2" style="font-weight:bold;">von&nbsp;'.$cashnow_enter.'&nbsp;&euro;</td>
						  <td>Total fees</td>
						  <td>&nbsp;</td>
						  <td style="text-align:right;">'.$gonorar_zero.'&nbsp;&euro;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td style="font-weight:bold;">Cash sanderung</td>
						  <td>&nbsp;</td>
						  <td style="font-weight:bold;text-align:right;">'.$delta_cash_zero.'&nbsp;&euro;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td colspan="2">Cash new: am '.$date_format.';'.$time_format.'</td>
						  <td style="text-align:right;">'.$cashnow_enter.'&nbsp;&euro;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td colspan="3"><hr></td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td colspan="3">Signature&nbsp;'.$sched->user_ob->contact_ob['firstname'].' '.$sched->user_ob->contact_ob['surname'].'</td>
						</tr>
					  </tbody>
				</table>

				';
				$name_pdf1 = 'TA'.$b.$year.'-'.$max_i;
				
				$date_format_n = strtotime($sched->date);
				$date_format_n = date('Y-m-d',$date_format_n);
				//$time_format_n = substr_replace($sched->starttime, 0, 4);
				
				//$datename = $date_format_n.'-'.$time_format_n;
				$datename = $date_format_n;
				
				$name_pdf2 = $name_pdf1.'_'.$datename;
				$files_name1 = __DIR__.'/../../filespdf/'.$name_pdf2.'.pdf';
				$files_name2 = __DIR__.'/../../filespdf/'.$name_pdf2.'_c.pdf';
				//$path = $_SERVER['DOCUMENT_ROOT'];
				//$path1 = 'Z:&#092;home&#092;seg1&#092;www&#092;';
				//print_r($path);
				//$files_name = $path1.'ggg.pdf';
				$pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 'P', 'cm', 'A4', true, 'UTF-8');
				$pdf->SetCreator(PDF_CREATOR);
				$pdf->SetAuthor("Cheery Tours");
				$pdf->SetTitle("Tourabrechnung");
				$pdf->SetSubject("Tourabrechnung");
				$pdf->SetKeywords("Tourabrechnung");
				$pdf->setPrintHeader(false);
				$pdf->setPrintFooter(false);
				$pdf->AddPage();
				$pdf->SetFont('freeserif', '', 10);

				$pdfm = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 'P', 'cm', 'A4', true, 'UTF-8');
				$pdfm->SetCreator(PDF_CREATOR);
				$pdfm->SetAuthor("Cheery Tours");
				$pdfm->SetTitle("Tourabrechnung");
				$pdfm->SetSubject("Tourabrechnung");
				$pdfm->SetKeywords("Tourabrechnung");
				$pdfm->setPrintHeader(false);
				$pdfm->setPrintFooter(false);
				$pdfm->AddPage();
				$pdfm->SetFont('freeserif', '', 10);
				$pdf->writeHTML($tbl, true, false, false, false, '');
				$pdfm->writeHTML($tbl.$strmail, true, false, false, false, '');
				$pdf->AddPage();
				$pdf->writeHTML($tbl_page2, true, false, false, false, '');
			//fopen($files_name,"w");
			
			   // $pdf->LastPage();

				//$pdf->Output('order.pdf', 'F');
				//Yii::app()->end();
				//$fff='Z:\home\seg1\www\';
				//$rrr = $fff;
			
				$pdfm->Output($files_name2, 'F');
				
				$pdf->Output($files_name1, 'F');	
				
				foreach ($mails as $value) {
					$this->sendMail($value, $files_name2);
			}
				$sched->additional_info2=$name_pdf2;
				$sched->save();
	          $this->redirect( Yii::app()->createUrl('/filespdf/'.$name_pdf2.'.pdf') );

/*			$this->render('testpdf',array(
					'tour'=>$tour,
					'invoicecustomers'=>$invoicecustomers,
					'sched'=>$sched,
					
					'vat'=>$vat,
					'invoice'=>$invoice,
					'sum_vat'=>$sum_vat,
					'sum_b_vat'=>$sum_b_vat,
					));*/
		//}

	}
	protected function sendMail($to,$att)
	{
		        Yii::import('ext.yii-mail.YiiMailMessage');
                $message = new YiiMailMessage;
                $message->setBody("Dear sirs, \n The invoice from Cherry tours.");
                $message->subject = "The invoice from Cherry tours";
                $message->addTo($to);
//                $message->addTo(Yii::app()->params['adminEmail']);
                $message->from = Yii::app()->params['adminEmail'];
//                $pathto=Yii::app()->params['load_xml_pdf'].$filename;
                $swiftAttachment = Swift_Attachment::fromPath($att); 
               $message->attach($swiftAttachment);
               return Yii::app()->mail->send($message);
		}
	
	public function actionCurrent($id_sched=null,$date=null,$time=null)
	{
		//print_r('999');
		/*print_r($id_tour);
				print_r('999');
		print_r($date);
				print_r('999');
		print_r($time);*/
		
		$id_control = Yii::app()->user->id;
        $guide = User::model()->findByPk($id_control);
        $role_control = $guide->id_usergroups;    
        // $id_guide = SegGuidesdata::model()->findByPk($update_user->id_guide)->idseg_guidesdata;
         
        if($role_control==1){
            $this->layout = "root";
        }        
        if($role_control==2){
            $this->layout = "admin";
        }   
        if($role_control==3){
            $this->layout = "office";
        } 
        if($role_control==5){
            $this->layout = "guide";
			
			$date_format = strtotime($date);
			$date_bd = date('Y-m-d',$date_format);
			$dt =$date_bd.' '.$time;

	//print_r($dt);
	
				//booking
				$criteria_booking = new CDbCriteria;
				
				$criteria_booking->condition = 'sched_tourid=:sched_tourid ';
				$criteria_booking->params = array(':sched_tourid'=>$id_sched);
			
				//$criteria_booking->alias = 's';
			//	$criteria_booking->join = 'LEFT JOIN seg_scheduled_tours as sc ON sc.idseg_scheduled_tours=s.sched_tourid';
				//$criteria_booking->condition = 's.sched_tourid=:sched_tourid AND Concat(sc.date," ",sc.starttime)=:dt';
				//$criteria_booking->params = array(':sched_tourid'=>$id_sched,':dt' => $dt);
				$booking = SegBookings::model()->findAll($criteria_booking);
				
				
				
				$criteria_sched = new CDbCriteria;
				$criteria_sched->condition = 'idseg_scheduled_tours=:idseg_scheduled_tours ';
				$criteria_sched->params = array(':idseg_scheduled_tours'=>$id_sched);
				$sched = SegScheduledTours::model()->find($criteria_sched);
				
				
				//print_r(count($booking));
				
				$book_z1 = array();$j=0;
				foreach($booking as $book){
					$book_z1[$j] = $book->idseg_bookings;	
					$j++;
					//print_r($book_z1[$j]);
				}
				
				//print_r(count($booking));
			//	$book_z = '8, 9';
				
				
				
				//guidestourinvoicescustomers
				//cond
				$x=1;$xx=0;$cond='';$y=1;$yy=0;$param=array();
				foreach($booking as $book){
					if($xx==0){
						$xx=1;
					} else {
						$cond.=' OR ';
					}	
					if(($xx!=1)AND($x!=count($booking))) {
						$cond.=' OR ';
					}
					$cond.='origin_booking =:origin_booking'.$x;
					
					
					//param
					$param['origin_booking'.$y] = $book->idseg_bookings;
				
					$yy++;	$x++; $y++;
				}
				
				//print_r($param);
				//foreach($booking as $book) {
					$criteria_invoicecustomer = new CDbCriteria;
					$criteria_invoicecustomer->condition = $cond;
					//$criteria_invoicecustomer->params = array($param);
						$criteria_invoicecustomer->params = $param;
					$model = SegGuidestourinvoicescustomers::model()->findAll($criteria_invoicecustomer);
					//$x++;
				//}
				
				//print_r(count($model));
				//for ($xx=0;$xx<$x;$xx++){
					
				//$model = $model1[$xx];
				//}
				//print_r(count($model2));
				
				
				
				//tour
				/*$tour = SegTourroutes::model()->findByPk($sched->tourroute_id);*/
				
				//$k=0;
				if(!empty($_POST))
				{
					//create guidetourinvoice
					//проверка на существование invoice
					$criteria_prov = new CDbCriteria;
					$criteria_prov->condition = 'guideNr=:guideNr AND id_sched=:id_sched ';
					$criteria_prov->params = array(':guideNr'=>$sched->guide1_id,':id_sched'=>$sched->idseg_scheduled_tours);
					$prov = SegGuidestourinvoices::model()->find($criteria_prov);
					
					if(!empty($prov)){
						$invoice = $prov;
						
					} else {
						$invoice = new SegGuidestourinvoices;
					}

					$invoice->creationDate = $sched->date;
					$invoice->cityid = $sched->city_id;
					$invoice->sched_tourid = $sched->tourroute_id;
					$invoice->guideNr = $sched->guide1_id;
					$invoice->status = 0;
					$invoice->id_sched = $sched->idseg_scheduled_tours;
					//$sum_itog=0;
					//$sum_bar=0;
					//foreach($invoicecustomers as $item){
						//$sum_itog=$sum_itog+$item->price;
						//if($item->paymentoptionid==1) $sum_bar = $sum_bar+$item->price;
					//}
					//print_r($_POST);
					$invoice->overAllIncome = $_POST['price_s_post'];
					$invoice->cashIncome =  $_POST['price_cash_post'];
					
/*					$b = $tour->city['seg_cityname']{0};
					$year = date('y',time());
					$max= Yii::app()->db->createCommand("SELECT max(InvoiceNumber) from seg_guidestourinvoices where cityid=".$tour->cityid)->queryScalar();
					$max_i = $max+1;
					$invoice->TA_string = 'TA'.$b.$year.'/'.$max_i;
					$invoice->InvoiceNumber =$max_i;*/
					
					
					$invoice->save();
					$invoice_id =  $invoice->idseg_guidesTourInvoices;
								
					//foreach($model as $item){
					for($k=0;$k<count($model);$k++){
						$model[$k]->tourInvoiceid = $invoice_id;
						$model[$k]->customersName = $_POST['customersName'.$k];
						$model[$k]->discounttype_id = $_POST['discounttype_id'.$k];
						$model[$k]->paymentoptionid = $_POST['payoption'.$k];
						if(!empty($_POST['price'.$k])) $model[$k]->price = $_POST['price'.$k];
						$model[$k]->id_invoiceoptions = $_POST['option'.$k];
						if($model[$k]->paymentoptionid)$model[$k]->isPaid = 1;
					//	print_r($model[$k]);
						//print_r('8777');
						
						$model[$k]->save();
							//print('555');
					//$model->attributes=$_POST['SegScheduledTours'];
					//if($model->save())
						//$this->redirect(array('officeadmin'));
						//print_r($_POST);
						//print_r('00');
						
					}
				}
	
				//mainoption
				$criteria_vat = new CDbCriteria;
				$criteria_vat->condition = 'name=:name ';
				$criteria_vat->params = array(':name'=>'Vat');
				$vat_nds = Mainoptions::model()->find($criteria_vat)->value;
					
				$this->render('current',array(
					'model'=>$model,
					'guide'=>$guide,
					'sched'=>$sched,
					'id_sched'=>$id_sched,
					'date'=>$date,
					'time'=>$time,
					'vat_nds'=>$vat_nds,
					));
		
			
        }   
	
	}





	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new SegGuidestourinvoicescustomers;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SegGuidestourinvoicescustomers']))
		{
			$model->attributes=$_POST['SegGuidestourinvoicescustomers'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idseg_guidesTourInvoicesCustomers));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SegGuidestourinvoicescustomers']))
		{
			$model->attributes=$_POST['SegGuidestourinvoicescustomers'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idseg_guidesTourInvoicesCustomers));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('SegGuidestourinvoicescustomers');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new SegGuidestourinvoicescustomers('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SegGuidestourinvoicescustomers']))
			$model->attributes=$_GET['SegGuidestourinvoicescustomers'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return SegGuidestourinvoicescustomers the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=SegGuidestourinvoicescustomers::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param SegGuidestourinvoicescustomers $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='seg-guidestourinvoicescustomers-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

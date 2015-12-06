   <div class="box box-success" >
        <div class="box-header with-border">
            <h4 class="box-title">
                Cash information
            </h4>
        </div>
        <div class="box-body" >
  	<div class="row">
            <div class="col-md-12">
 
                <table class="info-table">
                    <tr>
                        <td>Current cashbox</td>
                        <td><?php echo $model->cash_box; ?></td>
                        <td>Sales tax</td>
                         <td>
                            <?php echo $form->radioButtonList(
                                    $model,
                                    'paysUSt', 
                                    array('1'=>'Yes','0'=>'No'), 
                                    array(
                                    'labelOptions'=>array('style'=>'display:inline;'), 
                                    'separator'=>'  ',
                                    ) 
                            ); ?>
                         </td>        
                    </tr>
                    <tr>
                        <td colspan="2">Billings 2015</td>
                        <td colspan="2"><?php echo $form->textField($model,'inVoiceCount2015'); ?></td>
                    </tr>
                    <tr>
                        <td>Tax number</td>
                        <td><?php echo $form->textField($model,'taxnumber'); ?></td>
                        <td>Tax office</td>
                        <td><?php echo $form->textField($model,'taxoffice',array('size'=>45,'maxlength'=>45)); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">BIC</td>
                        <td colspan="2"><?php echo $form->textField($model,'BIC'); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">IBAN</td>
                        <td colspan="2"><?php echo $form->textField($model,'IBAN'); ?></td>
                    </tr>
                </table>

           </div>
 	</div>
        
        </div>
    </div>

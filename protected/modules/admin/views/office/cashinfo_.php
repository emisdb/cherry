   <div class="box box-success" >
        <div class="box-header with-border">
            <h4 class="box-title">
                Tour Routen
            </h4>
        </div>
        <div class="box-body" >
  	<div class="row">
            <div class="col-md-12">
                <?php $count_col = count($array_tour);?> 
                <table class="info-table">
                     <tr>
                      <td></td>
                        <?php
                        for($k=0;$k<$count_col;$k++) {
                             echo '<td>'.$array_tour[$k]['name'].'</td>';
                            } 
                         ?>
                      </tr>
                      <tr>
                   	<td>Grundvergütung</td>
                            <?php for($k=0;$k<$count_col;$k++) {
                                     echo '<td>'.$form->textField($array_tour_link[$k],'base_provision'.$k).'</td>';
                                     }
                                     ?>
                        </tr>
                        <tr>
                            <td>Minimum Gastanzahl</td>
                            <?php for($k=0;$k<$count_col;$k++) {
                                echo  '<td>'.$form->textField($array_tour_link[$k],'guest_variable'.$k).'</td>';
                                } 
                                ?>
                        </tr>
                            <tr>
                                <td>Variable Vergütung pro zusätzlichen Gast</td>
                                <?php for($k=0;$k<$count_col;$k++) {
                                    echo '<td>'.$form->textField($array_tour_link[$k],'guestsMinforVariable'.$k).'</td>';
                                    }
                                    ?>
                            </tr>
                           <tr>
                           	<td>Provision Gutscheinverkauf</td>
                                    <?php for($k=0;$k<$count_col;$k++) {
                                    echo '<td>'.$form->textField($array_tour_link[$k],'voucher_provision'.$k).'</td>';
                                    } ?>
                                </tr>
                    </table>
           </div>
 	</div>
        
        </div>
    </div>

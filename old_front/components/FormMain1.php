<?php

class FormMain1 extends CWidget
{
   public function run()
   {
        $citys = SegCities::model()->findAll();
        $model = new Searchmain;
        
        $this->render('formMain1', array(
            'citys' => $citys, 'model' => $model,
        ));
    }
}
<?php

class FormMain3 extends CWidget
{
   public function run()
   {
        $citys = SegCities::model()->findAll();
        $model = new Searchmain;
        
        $this->render('formMain3', array(
            'citys' => $citys, 'model' => $model,
        ));
    }
}
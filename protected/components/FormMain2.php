<?php

class FormMain2 extends CWidget
{
   public function run()
   {
        $citys = SegCities::model()->findAll();
        $model = new Searchmain;
        
        $this->render('formMain2', array(
            'citys' => $citys, 'model' => $model,
        ));
    }
}
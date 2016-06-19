<?php

class FormMain extends CWidget
{
   public function run()
   {
        $citys = SegCities::model()->findAll();
        $model = new Searchmain;
        
        $this->render('formMain', array(
            'citys' => $citys, 'model' => $model,
        ));
    }
}
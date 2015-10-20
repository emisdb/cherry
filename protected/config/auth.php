<?php
return array(
  /*  'guest' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Guest',
        'bizRule' => null,
        'data' => null
    ),*/
    'guide' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Guide',
        //'children' => array(
        //    'guest',
       // ),
        'bizRule' => null,
        'data' => null
    ),
   /* 'partner' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Moderator',
        'children' => array(
            'guide',          
        ),
        'bizRule' => null,
        'data' => null
    ),*/
    'office' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Moderator',
        'children' => array(
            'guide',          
        ),
        'bizRule' => null,
        'data' => null
    ),
    'admin' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Administrator',
        'children' => array(
            'office',         
        ),
        'bizRule' => null,
        'data' => null
    ),
    'root' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Root',
        'children' => array(
            'admin',
        ),
        'bizRule' => null,
        'data' => null
    ),
);

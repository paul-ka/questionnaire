<?php

class Conf{
  static $debug = 1; //on initialise un niveau de débug
  static $connections = array(); //Mémorisation de la connexion
  static $database = array(
    'default' => array(
      'host'    => 'localhost',
      'database'=> 'questionnaire',
      'login'   => 'globaluser',
      'password'=> 'user'
    )
  );
}

$form = array(
	'id'=>0, 
	'formTitle'=>'', 
	'formPicture'=>'', 
	'formContent'=>'', 
	'question1'=>'',
	'questionType1'=>'',
	'question2'=>'',
	'questionType2'=>'',
	'question3'=>'',
	'questionType3'=>'',
	'question4'=>'',
	'questionType4'=>'',
	'question5'=>'',
	'questionType5'=>''
);

$answer = array(
	'id'=>0, 
	'formId'=>'', 
	'question1'=>'',
	'question2'=>'',
	'question3'=>'',
	'question4'=>'',
	'question5'=>''
);


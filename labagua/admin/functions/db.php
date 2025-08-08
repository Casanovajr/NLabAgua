


<?php

  /* DATABASE CONNECTION*/


        $db['db_host'] = '127.0.0.1';
        $db['db_user'] = 'u863616108_nds';
        $db['db_pass'] = 'sS8&0TgiIY5';
        $db['db_name'] = 'u863616108_labagua';

      foreach($db as $key=>$value){
          define(strtoupper($key),$value);
      }
      global $connection;
      $connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME, 3306);
      if(!$connection){
          die("Cannot Establish A Secure Connection To The Host Server At The Moment!");
      }

      try{
          $db = new PDO('mysql:dbhost=127.0.0.1;dbname=u863616108_labagua;charset=utf8','u863616108_nds','sS8&0TgiIY5');


      }
      catch(Exception $e){

          die('Cannot Establish A Secure Connection To The Host Server At The Moment!');
      }

      /*DATABASE CONNECTION */



?>
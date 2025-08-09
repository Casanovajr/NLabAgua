


<?php

  /* DATABASE CONNECTION*/


        $db['db_host'] = 'localhost';
        $db['db_user'] = 'root';
        $db['db_pass'] = '';
        $db['db_name'] = 'labagua';

      foreach($db as $key=>$value){
          define(strtoupper($key),$value);
      }
      global $connection;
      $connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME, 3306);
      if(!$connection){
          die("Cannot Establish A Secure Connection To The Host Server At The Moment!");
      }
      // Ensure UTF-8 MB4 for emojis and extended chars
      @mysqli_set_charset($connection, 'utf8mb4');
      @mysqli_query($connection, "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");

      try{
          $db = new PDO('mysql:dbhost=localhost;dbname=labagua;charset=utf8mb4','root','');
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


      }
      catch(Exception $e){

          die('Cannot Establish A Secure Connection To The Host Server At The Moment!');
      }

      /*DATABASE CONNECTION */



?>
<?php

   session_start();
   
   function DB_connect() {
      $conn =mysqli_connect('localhost', 'root', '' ,'anyLink');
      return $conn;
   }
?>
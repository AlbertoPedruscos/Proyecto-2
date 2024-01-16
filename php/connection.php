<?php

   $dbserver = "localhost";
   $dbuser = "root";
   $dbpwd = "";
   $dbbasedatos = "db_restaurante";


   try {
      $conn = @mysqli_connect($dbserver, $dbuser, $dbpwd, $dbbasedatos);

   } catch (Exception $e) {
      header('Location: ../fallo.html');
      exit();
   }
<?php
    function conect($host="localhost",$bd="remember",$user="root",$pass="root"){
      try {
        $con = new PDO("mysql:host=".$host.";dbname=".$bd,$user,$pass);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
          echo "ERROR : ".$e->getMessage();
      }
      return $con;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['submit'])) {
            if (isset($_POST['remember'])) {
                $hour = time()+3600*24*90;
                setcookie("_user",$_POST['user'],$hour);
                setcookie("_pass",$_POST['pass'],$hour);
            }
        }
    }

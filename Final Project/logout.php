<?php
    session_destroy();
    if(!isset($_SESSION['username'])){
      header("Location: home.html", true);
      $_SESSION['username'] = null;
      die();
    }
?>
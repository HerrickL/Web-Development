<?php
    session_destroy();
    if(!isset($_SESSION['username'])){
      header("Location: http://web.engr.oregonstate.edu/~herrickl/assignment6/home.html", true);
      $_SESSION['username'] = null;
      die();
    }
?>
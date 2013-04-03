<?php

   require_once 'functions.php';
   require_once 'urlHandler.php';

   $handler = new UrlHandler($_GET);
   $userId = $handler->get_var('userId');

   //Debug-only
   $userId = '5973';

   printLogo();

   printUserProfile($userId);

?>

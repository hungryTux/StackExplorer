<?php 
 
  require_once 'tagArray.php';
  require_once 'functions.php';
  require_once 'urlHandler.php';

  $handler = new UrlHandler($_GET);
  $query = $handler->get_var('query');

  if($query) {

    global $tagArray;
    $found = false;

    foreach ($tagArray as $tag => $frequency) {

      if(strcasecmp($query, $tag) == 0){

        header("location: http://localhost/~vishnusanjit/dbms/tag.php?tag=".$tag);
        exit();
      
      }
    
    }

    if($found == false) {

        printHeader();
        print '<p style="text-align:center;"><b>Tag Not found. Please try a different query.</b><p>';

        printFooter();
    
    }
  
  }


?>

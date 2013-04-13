<?php 

   header('Content-Type: text/html; charset=utf-8');

   require_once 'Apache/Solr/Service.php';
   require_once 'urlHandler.php';

   $handler = new UrlHandler($_GET);
   $query = $handler->get_var('query');
   $results = false;

   $params = array(
        'defType' => 'dismax',
        'pf' => 'title^100',
        'qf' => 'title',
        'q.op' => 'AND'
   );

   if ($query) {
     
     $solr = new Apache_Solr_Service('storm.cise.ufl.edu', 8983, '/solr/');

     try {
       
       $results = $solr->search($query, 0, 10, $params);

     } catch(Exception $e) {
       
     }

   }

?>

   <?php 

   require_once 'functions.php';

   printHeader();

   if($results){

     print '<div>';

     $total = (int) $results->response->numFound;
     print '<p style="text-align:center;"><b>Total Matches Found - '.$total.'</b></p>';
     print '<br>';
     print '<ul class="list">';

     foreach ($results->response->docs as $doc) {

       $postIdField = $doc->getField('id');
       $postId = $postIdField['value'];
       $answerIdField = $doc->getField('answerId');
       $answerId = $answerIdField['value'];
       $titleField = $doc->getField('title');
       $title = $titleField['value'];

       print '<li><a href="viewPost.php?postId='.$postId.'&answerId='.$answerId.'">'.$title.'</a></li>';
     
     }

     print '<ul>';
     print '</div>';
   
   }

   printFooter();

   ?>

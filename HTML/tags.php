<?php 

   $tags = array(); 

   function collectTags() {

     global $tags;

     $file_handle = fopen("tags.txt", "rb");

     $i=0;

     while (!feof($file_handle) ) {

       $line = fgets($file_handle);
       $tokens = explode(' ', $line);

       if($tokens[0] != '') {

         $tags[$i] = array('name' => $tokens[0], 'frequency' => $tokens[1], 'link' => "http://www.google.com");  

         $i++;

       }

     }

     fclose($file_handle);
   
   
   }

   function dumpTags() {

     global $tags;

     $j = 0;

     for($j=0; $j < count($tags); ++$j) {

       print "Name={$tags[$j]['name']} Frequency={$tags[$j]['frequency']} <br />";
     
     }
   
   }

   collectTags();

   dumpTags();

?>

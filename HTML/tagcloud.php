<?php 

  $tags = array();

  function collectTags() {

    global $tags;

    $file_handle = fopen("tags_random.txt", "rb");

    $i=0;

    while (!feof($file_handle) ) {

      $line = fgets($file_handle);
      $tokens = explode(' ', $line);

      if($tokens[0] != '') {

        $tags[$tokens[0]] = $tokens[1];

        $i++;
      
      }
         
    }

    fclose($file_handle);
  
  }

  function print_tag_cloud() {

    global $tags;

    $cloud = "<div class=\"tagcloud\">";

    $max_font_size = 60; /* Maximum font size */
    $min_font_size = 20; /* Maximum font size */
    $min_frequency = 16; /* Frequency lower-bound */
    $max_frequency = 224; /* Frequency upper-bound */


    foreach ($tags as $word => $frequency) {


      $font_size = floor(  ( ($frequency)*($max_font_size-$min_font_size)/($max_frequency) ) + $min_font_size) ;

      /* Define a color index based on the frequency of the word */
      $r = $g = $b = 0; /*$b = floor( 255 * ($frequency / $max_frequency) );*/
      $color = '#' . sprintf('%02s', dechex($r)) . sprintf('%02s', dechex($g)) . sprintf('%02s', dechex($b));


      $cloud .= "<a class=\"anchor-button\" style=\"font-size: {$font_size}px;\" href=\"tag.php?tag=".urlencode($word)."\">$word</a> ";

    }

    $cloud .= "</div>";

    print $cloud;
  
  }

?>

<?php 
         require_once 'functions.php'; 

         collectTags(); 
         printHeader();
         print_tag_cloud();
         printFooter();
?>


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

    $max_font_size = 50; /* Maximum font size */
    $min_font_size = 25; /* Maximum font size */
    $min_frequency = 3870; /* Frequency lower-bound */
    $max_frequency = 63602; /* Frequency upper-bound */


    foreach ($tags as $word => $frequency) {


      $font_size = floor(  ( ($frequency)*($max_font_size-$min_font_size)/($max_frequency) ) + $min_font_size) ;

      /* Define a color index based on the frequency of the word */
      $r = $g = 0; $b = floor( 255 * ($frequency / $max_frequency) );
      $color = '#' . sprintf('%02s', dechex($r)) . sprintf('%02s', dechex($g)) . sprintf('%02s', dechex($b));


      $cloud .= "<a class=\"anchor-button\" style=\"font-size: {$font_size}px;\" href=\"tag.php&tag=$word\">$word</a> ";

    }

    $cloud .= "</div>";

    print $cloud;
  
  }

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>PHP Word Cloud Generator Example - By Sherif Ramadan - sheriframadan.com</title>
    <style>
     .anchor-button { 
           outline: 0; 
           margin: 0 0px 0 0;
           padding: 0 6px 0px 0px;
           display: inline-block;
           text-decoration: none !important; 
           cursor: pointer; 
           position: relative;
           text-align: center; 
           -moz-border-radius: 10px;
           -webkit-border-radius: 10px
    }

    .tagcloud {
           width: 90%;
           margin: 0 auto;
           padding: 15px;
           overflow: hidden;
           text-align: justify;
    }
    </style>

</head>

<body>

    
    <?php 
         require_once 'functions.php'; 

         collectTags(); 
         printLogo();
         print_tag_cloud();
    ?>

</body>
</html>

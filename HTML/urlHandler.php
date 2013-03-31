<?php

   class URLHandler 
   {
     public $get;

     public function __construct( $get )
     {
       $this->get = $get;
     }

     public function get_var( $var )
     {
       return htmlspecialchars( $this->get[$var] );
     }

     public function check_var( $var, $is )
     {
       if( $this->get_var( $var ) == $is )
       {
         return true;
       }
       else
       {
         return false;
       }
     }

   }

?>

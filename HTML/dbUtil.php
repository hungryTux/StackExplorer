<?php

class dbUtil {

  private $user = 'vsanjit';  //Put your username here 
  private $pswd = '';  //Put your password here 
  private $db = '//oracle.cise.ufl.edu/orcl';
  private $conn; 
  private $query; 
  private $row;

  public function __construct(){
    $this->connect();
  }

  private function connect() {

    if(!$this->conn = oci_connect($this->user, $this->pswd, $this->db)) {

      $err = oci_error(); 
      throw new Exception('Could not establish a connection: ' . $err['message']);

    }
  
  }

  public function query($sql) {

    if(!$this->query = oci_parse($this->conn, $sql)) {

      $err = oci_error(); 
      throw new Exception('Failed to execute SQL query: ' . $err['message']);
    
    } else if(!oci_execute($this->query)) {

      $err = oci_error(); 
      throw new Exception('Failed to execute SQL query: ' . $err['message']);
    
    }

    return true;
  
  }

  public function fetch() {

    if($this->row=oci_fetch_assoc($this->query)){ 
      return $this->row; 
    } else { 
      return false;
    }
  
  }

  public function free_statement() {

    oci_free_statement($this->query);
  
  }

  public function done() {

    oci_free_statement($this->query);

    //Should we close this everytime? Seems like a overhead to open new
    //connection everytime
    oci_close($this->conn);
  
  }



}



?>

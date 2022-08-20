<?php

class Db{
  private $host = "localhost";
  private $dbname = "feedback1";
  private $user = "root";
  private $pwd = "";

  public function getHost(){
    return $this->host;
  }

  public function getdbName(){
    return $this->dbname;
  }

  public function getuser(){
    return $this->user;
  }

  public function getpwd(){
    return $this->pwd;
  }

}

 ?>

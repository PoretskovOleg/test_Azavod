<?php
  namespace models;

  class db {
    static private $instance;
    private $db;

    static public function getInstance() {
      if (empty(self::$instance)) {
        self::$instance = new self();
      }
      return self::$instance;
    }

    private function __construct() {}
    private function __sleep() {}
    private function __wakeup() {}
    private function __clone() {}

    public function connect($host, $login, $pass, $base) {
      $this->db = mysqli_connect($host, $login, $pass, $base);
      if (!$this->db) {
        die('Ошибка подключения к базе данных: '.mysqli_connect_error());
      }
    }

    public function close () {
      mysqli_close($this->db);
    }

    public function query($query) {
      $result = mysqli_query($this->db, $query);
      if (!$result) {
        echo mysqli_error($db);
      }
    }

    public function select($query) {
      $result = mysqli_query($this->db, $query);
      if (!$result) {
        echo mysqli_error($this->db);
      } else {
        $res = mysqli_fetch_all($result, 1);
      }
      return $res;
    }
  }

?>

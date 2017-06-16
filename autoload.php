<?php
  class Autoloader {
    static public function autoload($class) {
      $class = str_replace('\\', '/', $class).'.php';
      if (is_file($class)) {
        include_once $class;
      } else {
        throw new Exception('Unable to load '.$class);
      }
    }
  }

  spl_autoload_register(['Autoloader', 'autoload']);
?>

<?php
  namespace controllers;

  abstract class BaseController {
    protected $content;
    protected $titlePage;

    abstract protected function before();

    protected function render() {
      $page = $this->templator('./views/v_main.php', array('content' => $this->content));
      echo $page;
    }

    public function Request($action) {
      $this -> before();
      $this -> $action();
      $this -> render();
    }

    protected function templator($template, $vars=array()) {
      foreach ($vars as $key => $value) {
        $$key = $value;
      }
      ob_start();
      include $template;
      return ob_get_clean();
    }

    public function __call($url, $method) {
      die('Page NOT FOUND');
    }
  }
?>

<?php
  include 'autoload.php';
  include 'config.php';
  
  use controllers\PageController;
  use controllers\EmployeeController;

  use models\db;

  db::getInstance()->connect(HOST, LOGIN, PASS, DBASE);

  $action = 'action_';
  $action.= isset($_GET['action']) ? $_GET['action'] : 'index';
  $page = isset($_GET['page']) ? $_GET['page'] : 'index';
  switch ($page) {
    case 'employee':
      $controller = new EmployeeController();
      break;

    case 'index':
      $controller = new PageController();
      break;
  }
  if ( isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) 
    $controller->$action();
    else $controller->Request($action);

  db::getInstance()->close();
?>

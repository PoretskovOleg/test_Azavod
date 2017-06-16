<?php
  namespace controllers;
  use models\M_Employees;

  class EmployeeController extends BaseController {

    public function before() {
      $this->titlePage = 'Создание сотрудника';
    }

    public function action_index() {
      if (isset($_GET['id'])) {
        $employee = M_Employees::getEmployee($_GET['id']);
        $fio = explode(' ', $employee['name']);
        $values['lastName'] = $fio[0];
        $values['name'] = $fio[1];
        $values['secondName'] = $fio[2];
        $values['id'] = $employee['id'];
        $values['birth'] = date('d.m.y', strtotime($employee['age']));
      } else {
        $values['lastName'] = '';
        $values['name'] = '';
        $values['secondName'] = '';
        $values['id'] = null;
        $values['birth'] = '';
      }
      $this->content = $this->templator('./views/v_employee.php',
        array(
          'titlePage' => $this->titlePage,
          'values' => $values
        ));
    }

    public function action_safeEmployee() {
      if (isset($_POST['safe'])) {
        $message = M_Employees::validateEmployee($_POST);
        if ($_FILES['foto']['name'] && $_FILES['foto']['error'] > 0) 
          $message['foto'] = "Ошибка загрузки файла";

        if (count($message) > 0) {
          $this->content = $this->templator('./views/v_employee.php',
            array(
              'titlePage' => $this->titlePage,
              'values' => $_POST,
              'message' => $message
          ));
        } else {
          if ($_FILES['foto']['name']) {
            $name = M_Employees::translitFileName($_FILES['foto']['name']);
            $path = './img/'.$name;
            $type = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            M_Employees::changeImage(200, 200, $_FILES['foto']['tmp_name'], $path, $type);
          }

          M_Employees::setEmployee($_POST, $path, $_GET['id']);
          header('Location: ./index.php');
        }
      }
    }

  }
?>

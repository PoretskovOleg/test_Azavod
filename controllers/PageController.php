<?php
  namespace controllers;
  use models\M_Employees;

  class PageController extends BaseController {
    protected $employees;
    protected $numderPages;

    public function before() {
      $this->titlePage = 'Реестр сотрудников';
      $this->employees = M_Employees::getEmployees();
    }

    public function action_index() {
      $this->content = $this->templator('./views/v_employees.php',
        array(
          'titlePage' => $this->titlePage,
          'employees' => $this->employees,
          'numberPages' => $this->numderPages
        ));
    }

    public function action_findEmployees() {
      echo json_encode(M_Employees::getEmployees($_POST));
    }

    public function action_deleteEmployee() {
      M_Employees::deleteEmployee($_POST[id]);
    }

  }
?>

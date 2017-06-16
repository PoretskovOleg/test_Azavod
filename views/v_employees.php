<div class="content">
  <div class="title">
    <h1><?=$titlePage?></h1>
  </div>
  <div class="add_employee">
    <a href="./index.php?page=employee"> + Добавить сотрудника</a>
  </div>
  <div class="clear"></div>
  <div class="find">
    <form id="form">
      <input type="text" name="fio" placeholder="Поиск"> <br>
      <label><b>Пол:</b></label> <label class="label_age"><b>Возраст:<b></label> <br>
      <input type="checkbox" name="man" checked> Муж 
      <input type="text" name="from" placeholder="c"><br>
      <input type="checkbox" name="woman" checked> Жен
      <input type="text" name="to" placeholder="по">
      <button type="button" id="btn_find" name="btn_find">Поиск</button>
    </form>
  </div>
  <div class="div_employees">
    <table class="table_employees">
      <thead>
        <tr>
          <th class="id">№ id</th>
          <th class="foto">Фото</th>
          <th class="name">ФИО</th>
          <th class="age">Возраст</th>
          <th class="sex">Пол</th>
          <th class="action">Действие</th>
        </tr>
      </thead>
      <tbody id="employees">
      </tbody>
    </table>
  </div>
  <div id="foto_big_size"></div>
  <div>
    <p>Страницы</p>
    <table id="numberPages">
      <tr>
      </tr>
    </table>
  </div>
</div>

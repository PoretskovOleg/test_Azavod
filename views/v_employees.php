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
  <div>
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
        <? foreach ($employees[employees] as $person) : ?>
          <tr>
            <td class="id"><?=$person[id]?></td>
            <td class="foto"> <img src="<?=$person[foto]?>" alt="фото"> </td>
            <td class="name"><?=$person[name]?></td>
            <td class="age"><?=$person[age]?> лет </td>
            <td class="sex <?=($person[sex] == 'муж') ? 'man' : 'woman' ?>"><?=$person[sex]?></td>
            <td class="action"><span><a href="./index.php?page=employee&id=<?=$person[id]?>">Ред</a></span> , <span onclick = "deleteEmployee(<?=$person[id]?>)">удал</span></td>
          </tr>
        <? endforeach; ?>
      </tbody>
    </table>
  </div>
  <div id="foto_big_size"></div>
  <div>
    <p>Страницы</p>
    <table id="numberPages">
      <tr>
        <? for ($i=0; $i < $employees[pages]; $i++) : ?> 
          <td><?=$i+1?></td>
       <? endfor; ?>
      </tr>
    </table>
  </div>
</div>

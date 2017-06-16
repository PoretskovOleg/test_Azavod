<div class="content_2">
  <div class="title_2">
    <h1><?=$titlePage?></h1>
  </div>
  <div class="form_add_employee">
    <form action="./index.php?page=employee&action=safeEmployee&id=<?=$values['id']?>" method="POST" enctype="multipart/form-data">      
      <div class="label">
        <div>Фамилия: </div>
        <div>Имя: </div>
        <div>Отчество: </div>
        <div>Дата рождения: </div>
      </div>
      <div class="input">
        <input type="text" id="lastName" name="lastName" required placeholder="Иванов" value="<?=$values['lastName']?>">*
        <div><?=isset($message['lastName']) ? $message['lastName'] : ''?></div>
        <input type="text" id="name" name="name" required placeholder="Николай" value="<?=$values['name']?>">*
        <div><?=isset($message['name']) ? $message['name'] : ''?></div>
        <input type="text" id="secondName" name="secondName" placeholder="Альбертович" value="<?=$values['secondName']?>">
        <div><?=isset($message['secondName']) ? $message['secondName'] : ''?></div>
        <input type="text" id="birth" name="birth" required value="<?=$values['birth']?>">*
        <div><?=isset($message['birth']) ? $message['birth'] : ''?></div>
      </div>
      <div class="clear"></div>
      <div class="label_2">
        <p>Пол: </p>
        <p>Фото: </p>
      </div>
      <div class="input_2">
        <select name="sex" id="sex" required>
          <option value="" disabled selected> Выберите пол </option>
          <option value="1">муж</option>
          <option value="2">жен</option>
        </select>*<br>
        <input type = "hidden" name = "MAX_FILE_SIZE" value = "204800" />
        <input type="file" name="foto" accept="image/jpeg,image/png,image/gif">
        <span><?=isset($message['foto']) ? $message['foto'] : ''?></span> <br>
      </div>
      <div class="button">
        <button type="submit" name="safe">Сохранить</button>
        <button type="button"><a href="./index.php">Отмена</a></button>
      </div>
    </form>
  </div>
</div>
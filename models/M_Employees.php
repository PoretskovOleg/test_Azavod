<?php
  namespace models;
  use models\db;

  class M_Employees {

    static public function getEmployees($params = array()) {
      $num = isset($params[num]) ? $params[num]*5 - 5 : 0;
      $name = $params[fio];
      $ageFrom = !empty($params[from]) ? $params[from] : 0;
      $ageTo = !empty($params[to]) ? $params[to] : 100;
      if ( (isset($params[man]) && isset($params[woman])) ||
          (!isset($params[man]) && !isset($params[woman])) ) {$sexM = 'муж'; $sexW = 'жен';}
      elseif (isset($params[man]) && !isset($params[woman])) $sexM = 'муж';
      else $sexW = 'жен';
      $query = "SELECT id, foto, name, sex, ((YEAR(CURRENT_DATE) - YEAR(age)) - (DATE_FORMAT(CURRENT_DATE, '%m%d') < DATE_FORMAT(age, '%m%d'))) AS age FROM employees
        WHERE ((YEAR(CURRENT_DATE) - YEAR(age)) - (DATE_FORMAT(CURRENT_DATE, '%m%d') < DATE_FORMAT(age, '%m%d'))) >= '$ageFrom'
          AND ((YEAR(CURRENT_DATE) - YEAR(age)) - (DATE_FORMAT(CURRENT_DATE, '%m%d') < DATE_FORMAT(age, '%m%d'))) <= '$ageTo'
          AND sex IN ('$sexM', '$sexW')
          AND name LIKE '%$name%'";
      $employees = db::getInstance()->select($query);
      $count = ceil(count($employees) / 5);
      return array('employees' => array_slice($employees, $num, 5), 'pages' => $count);
    }

    static public function deleteEmployee($id) {
      $query = "DELETE FROM employees WHERE id = '$id'";
      db::getInstance()->query($query);
    }

    static public function validateEmployee($params) {
      $message = array();

      if (!preg_match('/^[а-яА-ЯёЁ]+$/u', $params[name])) {
        $message[name] = 'Можно вводить только русские буквы';
      }
      
      if (!preg_match('/^[а-яА-ЯёЁ]+$/u', $params[lastName])) {
        $message[lastName] = 'Можно вводить только русские буквы';
      }

      if ($params[secondName]) {
        if (!preg_match('/^[а-яА-ЯёЁ]+$/u', $params[secondName])) {
          $message[secondName] = 'Можно вводить только русские буквы';
        }
      }

      if (!preg_match('/^\d\d\.\d\d\.\d\d$/', $params[birth])) {
        $message[birth] = 'Формат даты: дд.мм.гг';
      }

      return $message;
    }

    static public function translitFileName($string) {
      $translit = array(
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
        'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ы' => 'y', 'ъ' => '', 'ь' => '', 'э' => 'eh', 'ю' => 'yu', 'я'=>'ya');

      return str_replace(' ', '_', strtr(mb_strtolower(trim($string)), $translit));
    }

    static public function changeImage($h, $w, $src, $newsrc, $type) {
    $newimg = imagecreatetruecolor($h, $w);
    switch ($type) {
      case 'jpeg':
        $img = imagecreatefromjpeg($src);
        imagecopyresampled($newimg, $img, 0, 0, 0, 0, $h, $w, imagesx($img), imagesy($img));
        imagejpeg($newimg, $newsrc);
        break;
      case 'jpg':
        $img = imagecreatefromjpeg($src);
        imagecopyresampled($newimg, $img, 0, 0, 0, 0, $h, $w, imagesx($img), imagesy($img));
        imagejpeg($newimg, $newsrc);
        break;
      case 'png':
        $img = imagecreatefrompng($src);
        imagecopyresampled($newimg, $img, 0, 0, 0, 0, $h, $w, imagesx($img), imagesy($img));
        imagepng($newimg, $newsrc);
        break;
      case 'gif':
        $img = imagecreatefromgif($src);
        imagecopyresampled($newimg, $img, 0, 0, 0, 0, $h, $w, imagesx($img), imagesy($img));
        imagegif($newimg, $newsrc);
        break;
    }
  }

    static public function setEmployee($user, $pathFoto, $id = 0) {
      $date = date('Y-m-d', strtotime(implode('-', array_reverse(explode('.', $user[birth])))));
      if (!$id) {
        $query = "INSERT INTO employees (foto, name, age, sex)
        VALUES ('$pathFoto', '$user[lastName] $user[name] $user[secondName]', '$date', '$user[sex]')";
      } elseif ($pathFoto) {
          $query = "UPDATE employees SET foto='$pathFoto', name='$user[lastName] $user[name] $user[secondName]',
          age = '$date', sex = '$user[sex]' WHERE id = '$id'";
      } else $query = "UPDATE employees SET name='$user[lastName] $user[name] $user[secondName]',
          age = '$date', sex = '$user[sex]' WHERE id = '$id'";
          
      db::getInstance()->query($query);
    }

    static public function getEmployee($id) {
      $query = "SELECT * FROM employees WHERE id = '$id'";
      return db::getInstance()->select($query)[0];
    }
  }
?>
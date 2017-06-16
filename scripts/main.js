'use strict';

function dataForm() {
  var dataout = {};
  $('#form').find('input').each(function() {
    if (this.type === 'checkbox') {
      if ($(this).prop('checked')) {
        dataout[this.name] = $(this).val();
      }
    } else {
      dataout[this.name] = $(this).val();
    }
  });
  return dataout;
}

function requestEmployees(data) {
  $.ajax({
    url: './index.php?action=findEmployees',
    type: 'POST',
    data: data,
    dataType: 'json',
    success: function(data) {
      $('#employees').html('');
      $('#numberPages tr').html('');
      $('.div_employees div').html('');
      if (data.employees.length > 0) {
        data.employees.forEach(function(person) {
          var classSex = (person.sex == '1') ? 'man' : 'woman';
          var sex = (person.sex == '1') ? 'муж' : 'жен';
          $('#employees').append(
            '<tr><td class="id">'  + person.id + 
            '</td><td class="foto"> <img src="' + person.foto + '" alt="фото">' +
            '</td><td class="name">' + person.name +
            '</td><td class="age">' + person.age + ' лет ' +
            '</td><td class="sex ' + classSex + '">' + sex +
            '</td><td class="action">' + '<span><a href="./index.php?page=employee&id=' + 
              person.id + '">Ред</a></span> , <span onclick="deleteEmployee(' + person.id + ')">удал</span>' +
            '</td></tr>'
          );
        });
      } else {
        $('.div_employees').append('<div> Список пуст </div>');
      }
     
      if (data.pages) {
        for (var i = 1; i <= data.pages; i++) {
          $('#numberPages tr').append('<td>' + i + '</td>');
        };
      }

      $('.foto img').hover(function(event){
        $('#foto_big_size').append('<img src="' + $(this).attr('src') + '" alt="фото">');
        },
        function(){
          $('#foto_big_size').html('');
      });
    },
    error: function(xhr, status, error) {
      console.log(xhr.responseText + '|\n' + status + '|\n' + error);
    }
  })
}

$('#btn_find').click(function(){
  event.preventDefault();
  requestEmployees(dataForm());
});


$('#numberPages').click(function(event) {
  event.preventDefault();
  var data = dataForm();
  data.num = event.target.innerText;
  requestEmployees(data);
});

$('.foto img').hover(function(event){
  $('#foto_big_size').append('<img src="' + $(this).attr('src') + '" alt="фото">');
  },
  function(){
    $('#foto_big_size').html('');
});

function deleteEmployee(id) {
  var result = confirm('Вы дествительно хотите удалить пользователя под номером ' + id + ' ?');
  if(result) {
    $.ajax({
      url: './index.php?action=deleteEmployee',
      type: 'POST',
      data: 'id=' + id,
      success: function() {
        requestEmployees(dataForm());
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText + '|\n' + status + '|\n' + error);
      }
    })
  }
}

$('#birth').datepicker({
    dateFormat: "dd.mm.y",
    monthNames: ["Январь", "Февраль", "Март", "Апрель", "Май","Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
    dayNamesMin: ["ВС", "ПН", "ВТ", "СР", "ЧТ", "ПТ", "СБ"],
    firstDay: 1
  });

  requestEmployees(dataForm());
  jQuery(document).ready(function ($) {

    var timer = false;
    var timerId;
    var currentTimeInMinutes = 0;

    $('#action').on('click', function(){
      if (timer) {
        timerPause();
      } else {
        timerStart();
      }
    });

    function timerStart(){
      timer = true;

      timerId = setInterval(function() {
        timerTick();
      }, 60000);

      $('#action').html('Пауза');
      $('#stop').show();
    }

    function timerStop(){
      timer = false;

      clearInterval(timerId);
      saveTime();

      $('#action').html('Начать');
      $('#stop').hide();
    }

    function timerPause(){
      timer = false;

      clearInterval(timerId);

      $('#action').html('Начать');
      $('#pause').hide();
    }

    function timerTick(){
      currentTimeInMinutes++;
      var hours = Math.floor( currentTimeInMinutes / 60);
      var minutes = currentTimeInMinutes % 60;
      $('#time').html( hours + 'ч ' + minutes + 'м');
    }

    function saveTime(){
      // Не забыть обнулить
    }

  });

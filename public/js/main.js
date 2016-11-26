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

    $('#stop').on('click', function(){
      timerStop();
    });

    function timerStart(){
      timer = true;

      timerId = setInterval(function() {
        timerTick();
      }, 60000);

      $('#time').addClass('start');
      $('#action').html('Пауза');
      $('#stop').show();
      $('#stop').addClass('btn btn-info');
    }

    function timerStop(){
      timer = false;

      clearInterval(timerId);
      saveTime();

      $('#time').removeClass('start');
      $('#action').html('Начать');
      
      $('#stop').hide();
      $('#stop').addClass('btn btn-info');
    }

    function timerPause(){
      timer = false;

      clearInterval(timerId);

      $('#time').removeClass('start');
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

  jQuery(document).ready(function ($) {

    var timer = false;
    var timerId;
    var currentTimeInMinutes = 0;
    var secondInMinutes = 1000; // 60000

    getTime();

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
      }, secondInMinutes);

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

      var token = $('input[name=_token]').val();
      var what_action = $('#what_action').val();

      $.ajax({
        type: 'POST',
        url: 'time/save',
        data: {
          _token: token,
          time: currentTimeInMinutes,
          what_action: what_action
        },
        success: function (msg) {
          currentTimeInMinutes = 0;
          var hours = Math.floor( currentTimeInMinutes / 60);
          var minutes = currentTimeInMinutes % 60;
          $('#time').html( hours + 'ч ' + minutes + 'м');
          $('#what_action').val('');
          getTime();
        }
      });

    }

    function getTime(){

      var token = $('input[name=_token]').val();

      $.ajax({
        type: 'POST',
        url: 'time/getTimeForDate',
        data: {
          _token: token,
        },
        success: function (msg) {
          fillTimeTable(msg);
        }
      });

    }

    function fillTimeTable( json ){
      $('#time-tbody').html('');
      var time = JSON.parse(json);
       if (time.length > 0) {
          var i = 1;
          for(var key in time){
            var append = '';
            append += '<td>' + i + '</td>';
            append += '<td>' + time[key].date + '</td>';
            append += '<td>' + time[key].what_action + '</td>';

            var hours = Math.floor( time[key].time / 60);
            var minutes = time[key].time % 60;

            append += '<td>' + hours + 'ч ' + minutes + 'м' + '</td>';

            $('#time-tbody').append( "<tr>" + append + "</tr>" );
            i++;
          }
        } else {
          $('#time-tbody').append( "<tr><td></td><td></td><td>Сегодня пока еще ничего нет :c </td><td></td></tr>" );
        }
    }

    $(window).on('beforeunload ',function() {
       if (timer){
        return 'Are you sure ?';
      }
    });

    function setCookie(name, value, options) {
          options = options || {};

          var expires = options.expires;

          if (typeof expires == "number" && expires) {
            var d = new Date();
            d.setTime(d.getTime() + expires * 1000);
            expires = options.expires = d;
          }
          if (expires && expires.toUTCString) {
            options.expires = expires.toUTCString();
          }

          value = encodeURIComponent(value);

          var updatedCookie = name + "=" + value;

          for (var propName in options) {
            updatedCookie += "; " + propName;
            var propValue = options[propName];
            if (propValue !== true) {
              updatedCookie += "=" + propValue;
            }
          }

          document.cookie = updatedCookie;
        }

  });

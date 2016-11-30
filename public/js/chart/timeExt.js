function _nuTime(){
    var self=this;
    this.unixToDate=function(unix_timestamp){
        unix_timestamp=parseInt(unix_timestamp);
        var a = new Date(unix_timestamp * 1000);

        var months = ['01','02','03','04','05','06','07','08','09','10','11','12'];
        var year = a.getUTCFullYear();
        var year = year - 2000;
        var month = months[a.getUTCMonth()];
        //var month = a.getUTCMonth();
        var date = a.getUTCDate();
        var day = date + '/' + month + '/' + year;
        //console.log("-----");
        //console.log(a);
        //console.log(day);
        return day;
    };
    this.unixToTime = function(unix_timestamp){
            unix_timestamp=parseInt(unix_timestamp);
            var dt,minutes,hour,date,month,year;
            var months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
            dt = new Date(unix_timestamp*1000);
            minutes=dt.getMinutes();
        switch(minutes) {
            case 1:
                minutes = "01";
                break;
            case 2:
                minutes = "02";
                break;
            case 3:
                minutes = "03";
                break;
            case 4:
                minutes = "04";
                break;
            case 5:
                minutes = "05";
                break;
            case 6:
                minutes = "06";
                break;
            case 7:
                minutes = "07";
                break;
            case 8:
                minutes = "08";
                break;
            case 9:
                minutes = "09";
                break;
            case 0:
                minutes = "00";
                break;
        };
            hour=dt.getHours();
            date=dt.getDate();
            month = months[dt.getMonth()];
            year=dt.getFullYear();
            nowIs=date+'/'+month+'/'+year +"  "+ hour +':'+minutes;
            return nowIs;
    };

    this.dateToUnix=function (date) {
        var a = new Date(unix_timestamp * 1000);
        var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var year = a.getFullYear();
        var month = months[a.getMonth()];
        var date = a.getDate();
        var day = date + ' ' + month + ' ' + year;
        return time;
    };

    this.getThisWeekfunction=function () {
        var date = new Date();

        date.setHours(0, 0, 0, 0); //no hours or min
        //console.log(date);
        var thisWeek = [];

        for (var i = 0; i < 8; i++) {
            date.setDate(date.getDate() - 1);
            thisWeek[i] = Date.parse(date) / 1000;
            //console.log(this.unixToDate(thisWeek[i]));
        };
        //console.log(thisWeek);
        return thisWeek;
    }
    this.filterData = function(period, object){

      var output = {};

      var KEYS_ARRAY = [];
      var VALUES_ARRAY = [];

      for (var key in object) {
        KEYS_ARRAY.push(key);
        VALUES_ARRAY.push(object[key]);
      }

      var next = KEYS_ARRAY.length - 1;

      for(var i = 0; i < 7; i++){
        output[KEYS_ARRAY[next]] = VALUES_ARRAY[next];
        next -= period;
      }

      return output;
    }
}

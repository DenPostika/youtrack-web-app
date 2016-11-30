var nuApp = {};

nuApp.time = new _nuTime();
nuApp.chartHelper = new _nuChartHelper();

var data={
  1475153090.0 : "447",
 1475066690.0 : "710",
 1474980290.0 : "591",
 1474893890.0 : "449",
 1474807490.0 : "772",
 1474721090.0 : "247",
 1474634690.0 : "730",
 1474548290.0 : "177",
 1474461890.0 : "322",
 1474375490.0 : "420",
 1474289090.0 : "509",
 1474202690.0 : "194",
 1474116290.0 : "413",
 1474029890.0 : "591",
 1473943490.0 : "261",
 1473857090.0 : "443",
 1473770690.0 : "430",
 1473684290.0 : "114",
 1473597890.0 : "418",
 1473511490.0 : "393",
 1473425090.0 : "702",
 1473338690.0 : "469",
 1473252290.0 : "389",
 1473165890.0 : "745",
 1473079490.0 : "113",
 1472993090.0 : "680",
 1472906690.0 : "416",
 1472820290.0 : "296",
 1472733890.0 : "369",
 1472647490.0 : "666",
 1472561090.0 : "349",
 1472474690.0 : "322",
 1472388290.0 : "253",
 1472301890.0 : "178",
 1472215490.0 : "743",
 1472129090.0 : "285",
 1472042690.0 : "336",
 1471956290.0 : "299",
 1471869890.0 : "470",
 1471783490.0 : "144",
 1471697090.0 : "594",
 1471610690.0 : "196",
 1471524290.0 : "187",
 1471437890.0 : "784",
 1471351490.0 : "307",
 1471265090.0 : "352",
 1471178690.0 : "219",
 1471092290.0 : "164",
 1471005890.0 : "767",
 1470919490.0 : "167",
 1470833090.0 : "595",
 1470746690.0 : "633",
 1470660290.0 : "761",
 1470573890.0 : "518",
 1470487490.0 : "280",
 1470401090.0 : "202",
 1470314690.0 : "322",
 1470228290.0 : "713",
 1470141890.0 : "230",
 1470055490.0 : "769"

}

jQuery(document).ready(function() {

  // function getRandomInt(min, max) {
  //       return Math.floor(Math.random() * (max - min)) + min;
  // }
  //
  // var tomorrow = new Date();
  //
  // for(i = 0; i < 60; i++){
  //
  //   var unix = Math.round(+tomorrow / 1000);
  //       tomorrow.setDate(tomorrow.getDate() - 1);
  //
  //   console.log(unix + '.0 : "'+getRandomInt(100, 800)+'",');
  //
  // }

    calculateDates = nuApp.time.filterData( 1 , data);

    nuApp.chartHelper.updateLineChart(calculateDates, 'chart1', "sample", '.totalBotnetAttacks', 0, false, true, "addTotals");
    jQuery('.chartTitle').html(getDateForTittle('week' , calculateDates));

    jQuery("li").on('click' , function(){

      jQuery('li').removeClass('active');
      jQuery(this).addClass('active');

      switch (this.id) {
        case 'week':
            calculateDates = nuApp.time.filterData( 1 , data);
            nuApp.chartHelper.updateChart(calculateDates);
            jQuery('.chartTitle').html(getDateForTittle(this.id, calculateDates));
          break;
        case 'month':
            calculateDates = nuApp.time.filterData( 4 , data);
            nuApp.chartHelper.updateChart(calculateDates);
            jQuery('.chartTitle').html(getDateForTittle(this.id, calculateDates));
          break;
        case 'two_month':
            calculateDates = nuApp.time.filterData( 8 , data);
            nuApp.chartHelper.updateChart(calculateDates);
            jQuery('.chartTitle').html(getDateForTittle(this.id, calculateDates));
          break;
        default:
      }
    });

    function getDateForTittle(period , data){
      var firsDate = new Date (Object.keys(data)[6] * 1000);
      var lastDate = new Date (Object.keys(data)[0] * 1000);
      var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

      return months[lastDate.getMonth()] + ' ' + lastDate.getDate() + ' - ' + months[firsDate.getMonth()] + ' ' + firsDate.getDate() + ', ' + firsDate.getFullYear();

    }

});

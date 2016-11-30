function _nuChartHelper(){

  var CHART;
  var self=this;

  // Chart.defaults.global.legend.position="bottom;"
  var colors={
    backgroundColor:[
      'rgba(255, 99, 132, 1)',
      'rgba(54, 162, 235, 1)',
      'rgba(255, 206, 86, 1)',
      'rgba(75, 192, 192, 1)',
      'rgba(153, 102, 255, 1)',
      'rgba(255, 159, 64, 1)'
    ],
    hoverBackgroundColor: [
      'rgba(255, 99, 132, 0.6)',
      'rgba(54, 162, 235, 0.6)',
      'rgba(255, 206, 86, 0.6)',
      'rgba(75, 192, 192, 0.6)',
      'rgba(153, 102, 255, 0.6)',
      'rgba(255, 159, 64, 0.6)'
    ],
    borderColor: [
      'rgba(255, 99, 132, 1)',
      'rgba(54, 162, 235, 1)',
      'rgba(255, 206, 86, 1)',
      'rgba(75, 192, 192, 1)',
      'rgba(153, 102, 255, 1)',
      'rgba(255, 159, 64, 1)'
    ]
  };

  this.updateDoughnut=function(thisData,myPlace){
    if(thisData.status==1) {

      //self.data[obj]=data;
      // console.log(data);
      var ctx = jQuery('#'+myPlace);
      var chartData = {
        labels: [],
        datasets: [
          {
            data: [],
            backgroundColor: [],
            hoverBackgroundColor: [],
            borderColor: [],
          }]
        };
        var i=0;
        for (var key in thisData.data) {
          //console.log(i);
          chartData.labels.push(key);
          chartData.datasets[0].data.push(thisData.data[key]);
          chartData.datasets[0].backgroundColor.push(colors.backgroundColor[i]);
          chartData.datasets[0].hoverBackgroundColor.push(colors.hoverBackgroundColor[i]);
          chartData.datasets[0].borderColor.push(colors.borderColor[i]);
          i=i+1;
        };

        var myChart=new Chart(ctx,{
          type: 'doughnut',
          data: chartData,
          options: {
            cutoutPercentage:80,
            title:{
              display:false,
              //text:'title of chart'
            },
            tooltips: {
              callbacks: {
                label: function(tooltipItem, data) {
                  var value = data.datasets[0].data[tooltipItem.index];
                  var label = data.labels[tooltipItem.index];
                  return label + ' ' + value + '%';
                }
              }
            },
            animation:{
              animateScale:true,
              animateRotate: true
            },
            legend:{
              display:false
            },
            legendCallback: function(chart) {
              //console.log(chart.data);
              var text = [];
              text.push('<ul>');
              for (var i=0; i<chart.data.datasets[0].data.length; i++) {
                text.push('<li >');
                text.push('<span style="background-color:' + chart.data.datasets[0].backgroundColor[i] + '" >'+chart.data.datasets[0].data[i]+'%</span>');
                if (chart.data.labels[i]) {
                  text.push(chart.data.labels[i]);
                }
                text.push('</li>');
              }
              text.push('</ul>');
              return text.join("");
            },


          }

        });

        jQuery('#'+myPlace+'Legend').html(myChart.generateLegend());
      }else{
        //to do catch error
        console.log("error in getting data");
        document.location.href="/login?error";
      }
      ///


      ///

    };
    this.updateBarChart=function(thisData,myPlace,myLabel){
      //Chart.defaults.global.maintainAspectRatio = false;
      if(thisData.status==1) {
        console.log(thisData);
        var ctx = jQuery('#'+myPlace);
        var chartData = {
          labels: [],
          datasets: [
            {
              label: myLabel,
              data: [],
              backgroundColor: [],
              hoverBackgroundColor: [],
              borderColor: [],
            }]
          };
          var i=0;
          for (var key in thisData.data) {
            chartData.labels.push(nuApp.time.unixToDate(key));
            chartData.datasets[0].data.push(thisData.data[key]);

            chartData.datasets[0].backgroundColor.push(colors.backgroundColor[i]);
            chartData.datasets[0].hoverBackgroundColor.push(colors.hoverBackgroundColor[i]);
            chartData.datasets[0].borderColor.push(colors.borderColor[i]);
            i=i+1;
          };

          var myChart = new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: {
              scales: {
                xAxes:[{
                  ticks: {
                    beginAtZero:false
                  },
                  gridLines : {
                    display : false
                  },
                  display:false
                }],
                yAxes: [{
                  ticks: {
                    beginAtZero:false
                  },
                  gridLines : {
                    display : false
                  },
                  display:false
                }],

              },
              maintainAspectRatio:true,

              animation:{
                animateScale:true,
              },
              legend:{
                display:false
              },
            },

          });
        }else{
          //to do catch error
          console.log("error in getting data");
          document.location.href="/login?error";
        }

      };

      this.updateChart = function (data){

        var i = 0;

        for (var key in data) {
          CHART.data.labels[i] = getDayToChart(key);
          CHART.data.datasets[0].data[i] = data[key];
          i++;
        }
        CHART.update();
      };

      function getDayToChart (unix){

        var days = ['ВСКР','ПН','ВТ','СР','ЧТ','ПТ','СБ'];
        var date = new Date(unix * 1000);

        return days[ date.getDay() ] + ' ' + date.getDate() + '.' + date.getMonth() + '.' + (date.getYear() - 100);
      }

      this.updateLineChart = function( thisData,myPlace,myLabel,aspectRatio,gridDisplay){

        var blocksObject = [];
        var originalLineController = Chart.controllers.line;
        var pointCursor = {
          x : 0,
          y : 0
        }

        Chart.controllers.line = Chart.controllers.line.extend({
          draw: function() {


            var ctx = this.chart.chart.ctx;
            var originalStroke = ctx.stroke;

              // Shadow

              ctx.stroke = function () {
                ctx.save();
                ctx.shadowColor = '#BDBDBD';
                ctx.shadowBlur = 20;
                ctx.shadowOffsetX = 2;
                ctx.shadowOffsetY = 10;
                originalStroke.apply(this, arguments)
                ctx.restore();
              }

              originalLineController.prototype.draw.call(this, arguments[0]);
            }
          });

          var ctx = jQuery('#'+myPlace);
          ctx.width = 400;

          var chartData = {
            labels: [],
            datasets: [
              {
                label: 'Dataset 1',
                data: [],
                fill: false,
                borderColor: "#3097D1",
                borderWidth: 4,
                backgroundColor: "#3097D1",
                pointBorderWidth: 0.1,
                pointHoverRadius: 6,
                pointHoverBorderWidth: 2,
                pointHoverBackgroundColor: "#8ABA56",
                pointHoverBorderColor: "#FEEDF4",
                hitRadius: 40,
              }]
            };

            for (var key in thisData) {
              chartData.labels.push(getDayToChart(key));
              chartData.datasets[0].data.push(thisData[key]);
            };


            CHART = new Chart(ctx, {
              type: 'line',
              data: chartData,
              options: {
                global: {
                 responsive: false,
                 maintainAspectRatio: false
                },
                hover: {
                  onHover: null,
                  mode: 'x-axis',
                  animationDuration: 400
                },

                tooltips:{
                  xPadding: 15,
                  yPadding: 15,
                  yAlign: 'bottom',
                  cornerRadius: 3,
                  caretSize: 3,
                  mode: 'x-axis',
                  bodyFontSize: 20,
                  callbacks: {
                    title: function(tooltipItem, data){
                      return '';
                    },
                    label: function(tooltipItem, data) {
                      var value = data.datasets[0].data[tooltipItem.index];
                      var hours = Math.floor( value / 60);
                      var minutes = value % 60;
                      return hours + 'ч ' + minutes + 'м';
                    }
                  }
                },

                scales: {
                  xAxes:[{
                    ticks: {
                      beginAtZero:false
                    },
                    gridLines : {
                      display : true
                    },
                    display:true
                  }],
                  yAxes: [{
                    ticks: {
                      beginAtZero:false
                    },
                    gridLines : {
                      display : true
                    },
                    display:true
                  }],

                },

                animation:{
                  animateScale:true,
                },

                legend:{
                  display:false
                }
              },
            });

            // var helpers = Chart.helpers;
            // helpers.bindEvents(CHART, ["mousemove"], function(evt){
            //
            //   pointCursor.x = evt.offsetX;
            //   pointCursor.y = evt.offsetY;
            //
            //   for (var i in blocksObject){
            //     if((blocksObject[i].firstPointX < evt.offsetX &&
            //       blocksObject[i].firstPointY < evt.offsetY &&
            //       blocksObject[i].secondPointX > evt.offsetX &&
            //       blocksObject[i].secondPointY > evt.offsetY) &&
            //       !blocksObject[i].hover
            //     ){
            //       CHART.render();
            //     } else if (!(blocksObject[i].firstPointX < evt.offsetX &&
            //       blocksObject[i].firstPointY < evt.offsetY &&
            //       blocksObject[i].secondPointX > evt.offsetX &&
            //       blocksObject[i].secondPointY > evt.offsetY ) && blocksObject[i].hover){
            //       CHART.render();
            //       }
            //     }
            //   });

            };

          }

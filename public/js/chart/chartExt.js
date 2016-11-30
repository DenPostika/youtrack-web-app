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

        var days = ['SUN','MON','TUE','WED','THU','FRI','SAT'];
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

            var points = this.chart.data.datasets[0]._meta[0].data;
            var scale = this;

            var distance = (points[1]._model.x - points[0]._model.x) / 2;
            var nexPointX = points[0]._model.x;

            blocksObject = [];

            blocksObject.push({
              firstPointX: nexPointX + 1 ,
              firstPointY: 7,
              secondPointX: points[0]._model.x + (distance / 2) + 1,
              secondPointY: points[0]._xScale.bottom - 28
            });

            nexPointX += distance / 2;

            for (var i = 1; i < points.length * 2; i++){
              blocksObject.push({
                firstPointX: nexPointX + 1,
                firstPointY: 7,
                secondPointX: nexPointX + distance + 1,
                secondPointY: points[0]._xScale.bottom - 28,
              });
              nexPointX += distance;
            }


            for (var block in blocksObject){

              ctx.beginPath();

              if (blocksObject[block].firstPointX < pointCursor.x &&
                blocksObject[block].firstPointY < pointCursor.y &&
                blocksObject[block].secondPointX > pointCursor.x &&
                blocksObject[block].secondPointY > pointCursor.y){
                  var hover = true
                  ctx.fillStyle = "rgba(225,237,246,0.6)";
                } else {
                  ctx.fillStyle = "rgba(220,220,220,0)";
                  hover = false;
                }

                ctx.lineWidth = 1.2;

                ctx.moveTo(blocksObject[block].firstPointX , blocksObject[block].firstPointY);
                ctx.lineTo(blocksObject[block].secondPointX, blocksObject[block].firstPointY);
                ctx.lineTo(blocksObject[block].secondPointX, blocksObject[block].secondPointY);
                ctx.lineTo(blocksObject[block].firstPointX, blocksObject[block].secondPointY);
                ctx.lineTo(blocksObject[block].firstPointX , blocksObject[block].firstPointY);

                // ctx.moveTo(blocksObject[block].firstPointX + (distance / 2) , blocksObject[block].firstPointY);
                // ctx.lineTo(blocksObject[block].firstPointX + (distance / 2) , blocksObject[block].secondPointY);

                ctx.fill();
                ctx.stroke();
                ctx.closePath();

                blocksObject[block].hover = hover;

              }
              // Shadow

              ctx.stroke = function () {
                ctx.save();
                ctx.shadowColor = '#BDBDBD';
                ctx.shadowBlur = 30;
                ctx.shadowOffsetX = 2;
                ctx.shadowOffsetY = 25;
                originalStroke.apply(this, arguments)
                ctx.restore();
              }

              originalLineController.prototype.draw.call(this, arguments[0]);
            }
          });

          var ctx = jQuery('#'+myPlace);

          var chartData = {
            labels: [],
            datasets: [
              {
                label: 'Dataset 1',
                data: [],
                fill: false,
                borderColor: "#2096EF",
                borderWidth: 6,
                backgroundColor: "#2096EF",
                pointBorderWidth: 0.1,
                pointHoverRadius: 9,
                pointHoverBorderWidth: 4,
                pointHoverBackgroundColor: "#8ABA56",
                pointHoverBorderColor: "#FEEDF4",
                hitRadius: 40
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
                      return value;
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

            var helpers = Chart.helpers;
            helpers.bindEvents(CHART, ["mousemove"], function(evt){

              pointCursor.x = evt.offsetX;
              pointCursor.y = evt.offsetY;

              for (var i in blocksObject){
                if((blocksObject[i].firstPointX < evt.offsetX &&
                  blocksObject[i].firstPointY < evt.offsetY &&
                  blocksObject[i].secondPointX > evt.offsetX &&
                  blocksObject[i].secondPointY > evt.offsetY) &&
                  !blocksObject[i].hover
                ){
                  CHART.render();
                } else if (!(blocksObject[i].firstPointX < evt.offsetX &&
                  blocksObject[i].firstPointY < evt.offsetY &&
                  blocksObject[i].secondPointX > evt.offsetX &&
                  blocksObject[i].secondPointY > evt.offsetY ) && blocksObject[i].hover){
                  CHART.render();
                  }
                }
              });

            };

          }

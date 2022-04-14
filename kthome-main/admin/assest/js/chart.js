
$(function () {
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d');
    var array1 = document.getElementById('total1').value;
    var array2 = document.getElementById('total2').value;
    var array3 = document.getElementById('total3').value;
    var array4 = document.getElementById('total4').value;
    var array5 = document.getElementById('total5').value;
    var array6 = document.getElementById('total6').value;
    var array7 = document.getElementById('total7').value;
    var array8 = document.getElementById('total8').value;
    var array9 = document.getElementById('total9').value;
    var array10 = document.getElementById('total10').value;
    var array11 = document.getElementById('total11').value;
    var array12 = document.getElementById('total12').value;
    var areaChartData = {
    labels: ['Tháng 1', 'Tháng 2', 'tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
    datasets: [
    {
    label: 'This year',
    backgroundColor: 'rgba(60,141,188,0.9)',
    borderColor: 'rgba(60,141,188,0.8)',
    pointRadius: false,
    pointColor: '#3b8bba',
    pointStrokeColor: 'rgba(60,141,188,1)',
    pointHighlightFill: '#fff',
    pointHighlightStroke: 'rgba(60,141,188,1)',
    data: [array1, array2, array3, array4, array5, array6, array7, array8, array9, array10, array11, array12]
    },
    {
    label: 'Last year',
    backgroundColor: 'rgba(210, 214, 222, 1)',
    borderColor: 'rgba(210, 214, 222, 1)',
    pointRadius: false,
    pointColor: 'rgba(210, 214, 222, 1)',
    pointStrokeColor: '#c1c7d1',
    pointHighlightFill: '#fff',
    pointHighlightStroke: 'rgba(220,220,220,1)',
    data: [6500000.000, 5900000.000, 8000000.000, 8100000.000, 5600000.000, 5500000.000, 4000000.000, 6000000.000, 7000000.000, 9000000.000, 5000000.000, 3000000.000]
    },
        ]
    }

    var areaChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
        display: false
    },
    scales: {
    xAxes: [{
    gridLines: {
    display: false,
    }
    }],
    yAxes: [{
    gridLines: {
    display: false,
    }
    }]
    }
    }

    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvas, {
    type: 'line',
    data: areaChartData,
    options: areaChartOptions
    })
    })

//bar chart

$(function () {
    var d = new Date();
    if (d.getMonth() >= 0) {
        c = d.getMonth()+1;
    }
    var day1 = document.getElementById('today').value;
    var day2 = document.getElementById('day1').value;
    var day3 = document.getElementById('day2').value;
    var day4 = document.getElementById('day3').value;
    var day5 = document.getElementById('day4').value;
    var day6 = document.getElementById('day5').value;
    var day7 = document.getElementById('day6').value;

    var areaChartData = {
        labels  : [d.getDate()-6+"/"+c, d.getDate()-5+"/"+c, d.getDate()-4+"/"+c, d.getDate()-3+"/"+c, d.getDate()-2+"/"+c, d.getDate()-1+"/"+c,d.getDate()+"/"+c],
        datasets: [
            {
                label               : 'Digital Goods',
                backgroundColor     : '#007bff',
                borderColor         : 'rgba(60,141,188,0.8)',
                pointRadius          : false,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(60,141,188,1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data                : [day7, day6, day5, day4, day3, day2, day1]
            },
            {
                label               : 'Electronics',
                backgroundColor     : 'rgba(210, 214, 222, 1)',
                borderColor         : 'rgba(210, 214, 222, 1)',
                pointRadius         : false,
                pointColor          : 'rgba(210, 214, 222, 1)',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data                : [0, 0, 0, 0, 0, 0, 0]
            },
        ]
    }
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
        responsive              : true,
        maintainAspectRatio     : false,
        datasetFill             : false
    }

    new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
    })
})

$(function () {
    /* jQueryKnob */

    $('.knob').knob({
       /* change : function (value) {
         console.log("change : " + value);
         },
         release : function (value) {
         console.log("release : " + value);
         },
         cancel : function () {
         console.log("cancel : " + this.value);
         },*/
        draw: function () {

            // "tron" case
            if (this.$.data('skin') == 'tron') {

                var a   = this.angle(this.cv)  // Angle
                    ,
                    sa  = this.startAngle          // Previous start angle
                    ,
                    sat = this.startAngle         // Start angle
                    ,
                    ea                            // Previous end angle
                    ,
                    eat = sat + a                 // End angle
                    ,
                    r   = true

                this.g.lineWidth = this.lineWidth

                this.o.cursor
                && (sat = eat - 0.3)
                && (eat = eat + 0.3)

                if (this.o.displayPrevious) {
                    ea = this.startAngle + this.angle(this.value)
                    this.o.cursor
                    && (sa = ea - 0.3)
                    && (ea = ea + 0.3)
                    this.g.beginPath()
                    this.g.strokeStyle = this.previousColor
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false)
                    this.g.stroke()
                }

                this.g.beginPath()
                this.g.strokeStyle = r ? this.o.fgColor : this.fgColor
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false)
                this.g.stroke()

                this.g.lineWidth = 2
                this.g.beginPath()
                this.g.strokeStyle = this.o.fgColor
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false)
                this.g.stroke()

                return false
            }
        }
    })
})


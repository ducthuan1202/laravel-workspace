class DemoApexChart {

    constructor() {
        this.init();
    }

    randomIntFromInterval(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    }

    init() {
        this.stackedBar();
        this.pie();
        this.columns();
        this.dynamicLoad();
        this.dashed();
        this.distributed();
    }

    stackedBar() {
        const self = this;

        const options = {
            chart: {
                height: 350,
                type: 'bar',
                stacked: true,
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                },
            },
            stroke: {
                width: 1,
                colors: ['#fff']
            },
            series: [{
                name: 'Marine Sprite',
                data: [44, 55, 41, 37, 22, 43, 21]
            }, {
                name: 'Striking Calf',
                data: [53, 32, 33, 52, 13, 43, 32]
            }, {
                name: 'Tank Picture',
                data: [12, 17, 11, 9, 15, 11, 20]
            }, {
                name: 'Bucket Slope',
                data: [9, 7, 5, 8, 6, 9, 4]
            }, {
                name: 'Reborn Kid',
                data: [25, 12, 19, 32, 25, 24, 10]
            }],
            title: {
                text: 'Fiction Books Sales',
                align: 'center',
            },
            xaxis: {
                categories: [2008, 2009, 2010, 2011, 2012, 2013, 2014],
                labels: {
                    formatter: function (val) {
                        return val + "K"
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + "K"
                    }
                }
            },
            fill: {
                opacity: 1
            },
            legend: {
                position: 'bottom',
                horizontalAlign: 'center',
            }
        };

        let chart = new ApexCharts(
            document.querySelector("#apexStackBar"),
            options
        );

        chart.render();

        setTimeout(function () {
            // nếu cần cập nhật thêm thông tin, thì sử dụng updateOptions

            chart.updateSeries([
                {
                    name: 'Marine Sprite',
                    data: [self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100)]
                }, {
                    name: 'Striking Calf',
                    data: [self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100)]
                }, {
                    name: 'Tank Picture',
                    data: [self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100)]
                }, {
                    name: 'Bucket Slope',
                    data: [self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100)]
                }, {
                    name: 'Reborn Kid',
                    data: [self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100), self.randomIntFromInterval(1, 100)]
                }
            ])

        }, 3e3);
    }

    pie() {
        const options = {
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
            series: [44, 55, 13, 43, 22],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        const chart = new ApexCharts(
            document.querySelector("#apexPie"),
            options
        );

        chart.render();

    }

    columns() {
        const options = {
            chart: {
                height: 350,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val + "%";
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            },
            series: [{
                name: 'Inflation',
                data: [2.3, 3.1, 4.0, 10.1, 4.0, 3.6, 3.2, 2.3, 1.4, 0.8, 0.5, 0.2]
            }],
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                position: 'top',
                labels: {
                    offsetY: -18,

                },
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    fill: {
                        type: 'gradient',
                        gradient: {
                            colorFrom: '#D8E3F0',
                            colorTo: '#BED1E6',
                            stops: [0, 100],
                            opacityFrom: 0.4,
                            opacityTo: 0.5,
                        }
                    }
                },
                tooltip: {
                    enabled: true,
                    offsetY: -35,

                }
            },
            fill: {
                gradient: {
                    shade: 'light',
                    type: "horizontal",
                    shadeIntensity: 0.25,
                    gradientToColors: undefined,
                    inverseColors: true,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [50, 0, 100, 100]
                },
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                    formatter: function (val) {
                        return val + "%";
                    }
                }

            },
            title: {
                text: 'Monthly Inflation in Argentina, 2002',
                floating: true,
                offsetY: 320,
                align: 'center',
                style: {
                    color: '#444'
                }
            },
        }

        const chart = new ApexCharts(
            document.querySelector("#apexColumns"),
            options
        );

        chart.render();

    }

    dashed() {
        const options = {
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: [5, 7, 5],
                curve: 'straight',
                dashArray: [0, 8, 5]
            },
            series: [{
                name: "Session Duration",
                data: [45, 52, 38, 24, 33, 26, 21, 20, 6, 8, 15, 10]
            },
                {
                    name: "Page Views",
                    data: [35, 41, 62, 42, 13, 18, 29, 37, 36, 51, 32, 35]
                },
                {
                    name: 'Total Visits',
                    data: [87, 57, 74, 99, 75, 38, 62, 47, 82, 56, 45, 47]
                }
            ],
            title: {
                text: 'Page Statistics',
                align: 'left'
            },
            markers: {
                size: 0,

                hover: {
                    sizeOffset: 6
                }
            },
            xaxis: {
                categories: ['01 Jan', '02 Jan', '03 Jan', '04 Jan', '05 Jan', '06 Jan', '07 Jan', '08 Jan', '09 Jan',
                    '10 Jan', '11 Jan', '12 Jan'
                ],
            },
            tooltip: {
                y: [{
                    title: {
                        formatter: function (val) {
                            return val + " (mins)"
                        }
                    }
                }, {
                    title: {
                        formatter: function (val) {
                            return val + " per session"
                        }
                    }
                }, {
                    title: {
                        formatter: function (val) {
                            return val;
                        }
                    }
                }]
            },
            grid: {
                borderColor: '#f1f1f1',
            }
        }

        const chart = new ApexCharts(
            document.querySelector("#apexDashed"),
            options
        );

        chart.render();

    }

    dynamicLoad() {

        const Apex = {
            chart: {
                toolbar: {
                    show: false
                }
            },
            tooltip: {
                shared: false
            },
        };

        const colors = ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0', '#00D9E9', '#FF66C3'];

        /**
         * Randomize array element order in-place.
         * Using Durstenfeld shuffle algorithm.
         */
        function shuffleArray(array) {
            for (var i = array.length - 1; i > 0; i--) {
                var j = Math.floor(Math.random() * (i + 1));
                var temp = array[i];
                array[i] = array[j];
                array[j] = temp;
            }
            return array;
        }

        const arrayData = [
            {
                y: 400,
                quarters: [{
                    x: 'Q1',
                    y: 120
                }, {
                    x: 'Q2',
                    y: 90
                }, {
                    x: 'Q3',
                    y: 100
                }, {
                    x: 'Q4',
                    y: 90
                }]
            }, {
                y: 430,
                quarters: [{
                    x: 'Q1',
                    y: 120
                }, {
                    x: 'Q2',
                    y: 110
                }, {
                    x: 'Q3',
                    y: 90
                }, {
                    x: 'Q4',
                    y: 110
                }]
            }, {
                y: 448,
                quarters: [{
                    x: 'Q1',
                    y: 70
                }, {
                    x: 'Q2',
                    y: 100
                }, {
                    x: 'Q3',
                    y: 140
                }, {
                    x: 'Q4',
                    y: 138
                }]
            }, {
                y: 470,
                quarters: [{
                    x: 'Q1',
                    y: 150
                }, {
                    x: 'Q2',
                    y: 60
                }, {
                    x: 'Q3',
                    y: 190
                }, {
                    x: 'Q4',
                    y: 70
                }]
            }, {
                y: 540,
                quarters: [{
                    x: 'Q1',
                    y: 120
                }, {
                    x: 'Q2',
                    y: 120
                }, {
                    x: 'Q3',
                    y: 130
                }, {
                    x: 'Q4',
                    y: 170
                }]
            }, {
                y: 580,
                quarters: [{
                    x: 'Q1',
                    y: 170
                }, {
                    x: 'Q2',
                    y: 130
                }, {
                    x: 'Q3',
                    y: 120
                }, {
                    x: 'Q4',
                    y: 160
                }]
            }];

        function makeData() {
            const dataSet = shuffleArray(arrayData);

            const dataYearSeries = [{
                x: "2011",
                y: dataSet[0].y,
                color: colors[0],
                quarters: dataSet[0].quarters
            }, {
                x: "2012",
                y: dataSet[1].y,
                color: colors[1],
                quarters: dataSet[1].quarters
            }, {
                x: "2013",
                y: dataSet[2].y,
                color: colors[2],
                quarters: dataSet[2].quarters
            }, {
                x: "2014",
                y: dataSet[3].y,
                color: colors[3],
                quarters: dataSet[3].quarters
            }, {
                x: "2015",
                y: dataSet[4].y,
                color: colors[4],
                quarters: dataSet[4].quarters
            }, {
                x: "2016",
                y: dataSet[5].y,
                color: colors[5],
                quarters: dataSet[5].quarters
            }];

            return dataYearSeries
        }

        const optionsYear = {
            chart: {
                id: 'barYear',
                height: 400,
                width: '100%',
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    distributed: true,
                    horizontal: true,
                    barHeight: '75%',
                    dataLabels: {
                        position: 'bottom'
                    }
                }
            },
            dataLabels: {
                enabled: true,
                textAnchor: 'start',
                style: {
                    colors: ['#fff']
                },
                formatter: function (val, opt) {
                    return opt.w.globals.labels[opt.dataPointIndex]
                },
                offsetX: 0,
                dropShadow: {
                    enabled: true
                }
            },

            colors: colors,
            series: [{
                data: makeData()
            }],
            states: {
                normal: {
                    filter: {
                        type: 'desaturate'
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: true,
                    filter: {
                        type: 'darken',
                        value: 1
                    }
                }
            },
            tooltip: {
                x: {
                    show: false
                },
                y: {
                    title: {
                        formatter: function (val, opts) {
                            return opts.w.globals.labels[opts.dataPointIndex]
                        }
                    }
                }
            },
            title: {
                text: 'Biểu đồ tổng quan',
                offsetX: 15
            },
            subtitle: {
                text: '(Click on bar to see details)',
                offsetX: 15
            },
            yaxis: {
                labels: {
                    show: false
                }
            },
        }

        const yearChart = new ApexCharts(document.querySelector("#chart-year"), optionsYear);

        yearChart.render();

        function updateQuarterChart(sourceChart, destChartIDToUpdate) {
            var series = [];
            var seriesIndex = 0;
            var colors = []

            if (sourceChart.w.globals.selectedDataPoints[0]) {
                var selectedPoints = sourceChart.w.globals.selectedDataPoints;
                for (var i = 0; i < selectedPoints[seriesIndex].length; i++) {
                    var selectedIndex = selectedPoints[seriesIndex][i];
                    var yearSeries = sourceChart.w.config.series[seriesIndex];
                    series.push({
                        name: yearSeries.data[selectedIndex].x,
                        data: yearSeries.data[selectedIndex].quarters
                    })
                    colors.push(yearSeries.data[selectedIndex].color)
                }

                if (series.length === 0) series = [{
                    data: []
                }]

                return ApexCharts.exec(destChartIDToUpdate, 'updateOptions', {
                    series: series,
                    colors: colors,
                    fill: {
                        colors: colors
                    }
                })

            }

        }

        const optionsQuarters = {
            chart: {
                id: 'barQuarter',
                height: 400,
                width: '100%',
                type: 'bar',
                stacked: true
            },
            plotOptions: {
                bar: {
                    columnWidth: '50%',
                    horizontal: false
                }
            },
            series: [{
                data: []
            }],
            legend: {
                show: false
            },
            grid: {
                yaxis: {
                    lines: {
                        show: false,
                    }
                },
                xaxis: {
                    lines: {
                        show: true,
                    }
                }
            },
            yaxis: {
                labels: {
                    show: false
                }
            },
            title: {
                text: 'Biểu đồ chi tiết',
                offsetX: 10
            },
            tooltip: {
                x: {
                    formatter: function (val, opts) {
                        return opts.w.globals.seriesNames[opts.seriesIndex]
                    }
                },
                y: {
                    title: {
                        formatter: function (val, opts) {
                            return opts.w.globals.labels[opts.dataPointIndex]
                        }
                    }
                }
            }
        }

        const chartQuarters = new ApexCharts(
            document.querySelector("#chart-quarter"),
            optionsQuarters
        );

        chartQuarters.render();

        yearChart.addEventListener('dataPointSelection', function (e, chart, opts) {
            var quarterChartEl = document.querySelector("#chart-quarter");
            var yearChartEl = document.querySelector("#chart-year");

            if (opts.selectedDataPoints[0].length === 1) {
                if (quarterChartEl.classList.contains("active")) {
                    updateQuarterChart(chart, 'barQuarter')
                } else {
                    yearChartEl.classList.add("chart-quarter-activated")
                    quarterChartEl.classList.add("active");
                    updateQuarterChart(chart, 'barQuarter')
                }
            } else {
                updateQuarterChart(chart, 'barQuarter')
            }

            if (opts.selectedDataPoints[0].length === 0) {
                yearChartEl.classList.remove("chart-quarter-activated")
                quarterChartEl.classList.remove("active");
            }

        });

        yearChart.addEventListener('updated', function (chart) {
            updateQuarterChart(chart, 'barQuarter')
        });

        document.querySelector("#model").addEventListener("change", function (e) {
            yearChart.updateSeries([{
                data: makeData()
            }])
        });

    }

    distributed() {
        const self = this;

        const colors = ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0', '#546E7A', '#26a69a', '#D10CE8'];
        const options = {
            chart: {
                height: 350,
                type: 'bar',
                events: {
                    click: function (chart, w, e) {
                        // Evetn là sự kiện
                        // w là chartContext
                        // e là config
                        console.log(chart, w, e)
                    }
                },
                animations: {
                    enabled: true,
                    easing: 'easeout',
                    speed: 300,
                    animateGradually: {
                        enabled: true,
                        delay: 150
                    },
                    dynamicAnimation: {
                        enabled: true,
                        speed: 350
                    }
                }
            },
            colors: colors,
            plotOptions: {
                bar: {
                    columnWidth: '45%',
                    distributed: true
                }
            },
            dataLabels: {
                enabled: false,
            },
            series: [{
                data: [21, 22, 10, 28, 16, 21, 13, 30]
            }],
            xaxis: {
                categories: ['John', 'Joe', 'Jake', 'Amber', 'Peter', 'Mary', 'David', 'Lily'],
                labels: {
                    style: {
                        colors: colors,
                        fontSize: '14px'
                    }
                }
            }
        }

        const chart = new ApexCharts(
            document.querySelector("#apexDistributed"),
            options
        );

        chart.render();


        setInterval(function () {
            chart.updateSeries([{
                data: [
                    self.randomIntFromInterval(1, 100),
                    self.randomIntFromInterval(1, 100),
                    self.randomIntFromInterval(1, 100),
                    self.randomIntFromInterval(1, 100),
                    self.randomIntFromInterval(1, 100),
                    self.randomIntFromInterval(1, 100),
                    self.randomIntFromInterval(1, 100),
                    self.randomIntFromInterval(1, 100),
                ]
            }])
        }, 3e3);


    }
}

new DemoApexChart();
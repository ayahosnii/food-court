/*=========================================================================================
    File Name: basic-line.js
    Description: echarts basic line chart
    ----------------------------------------------------------------------------------------
    Item Name: Modern Admin - Clean Bootstrap 4 Dashboard HTML Template
    Version: 1.0
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

// Basic line chart
// ------------------------------

$(window).on("load", function(){

    // Set paths
    // ------------------------------

    require.config({
        paths: {
            echarts: '../../../admin-assets/vendors/js/charts/echarts'
        }
    });


    // Configuration
    // ------------------------------

    require(
        [
            'echarts',
            'echarts/chart/bar',
            'echarts/chart/line'
        ],


        // Charts setup
        function (ec) {
            // Initialize chart
            // ------------------------------
            var myChart = ec.init(document.getElementById('basic-line'));

            // Chart Options
            // ------------------------------
            chartOptions = {

                // Setup grid
                grid: {
                    x: 40,
                    x2: 40,
                    y: 45,
                    y2: 25
                },

                // Add Tooltip
                tooltip : {
                    trigger: 'axis'
                },

                // Add Legend
                legend: {
                    data:['Sales in this week','Sales last week']
                },

                // Add custom colors
                color: ['#27d700', '#e3c500'],

                // Enable drag recalculate
                calculable : true,

                // Horizontal Axiz
                xAxis : [
                    {
                        type : 'category',
                        boundaryGap : false,
                        data : ['Mon','Tue','Wed','Thu','Fri','Sat','Sun']
                    }
                ],

                // Vertical Axis
                yAxis : [
                    {
                        type : 'value',
                        axisLabel : {
                            formatter: '{value}'
                        }
                    }
                ],

                // Add Series
                series : [
                    {
                        name:'Sales in this week',
                        type:'line',
                        data:[0, 0, 0, 0, 0, 0, 0],
                        markPoint : {
                            data : [
                                {type : 'max', name: 'Max'},
                                {type : 'min', name: 'Min'}
                            ]
                        },
                        markLine : {
                            data : [
                                {type : 'average', name: 'Average'}
                            ]
                        }
                    },
                    {
                        name:'Sales last week',
                        type:'line',
                        data:[0, 0, 0, 0, 0, 0, 0],
                        markPoint : {
                            data : [
                                {name : 'Week low', value : -2, xAxis: 1, yAxis: -1.5}
                            ]
                        },
                        markLine : {
                            data : [
                                {type : 'average', name : 'Average'}
                            ]
                        }
                    }
                ]
            };

            // Apply options
            // ------------------------------

            myChart.setOption(chartOptions);

            $.get('/api/weekly-orders', function(data) {
                console.log('Weekly Sales:', data.daily_sales_current);
                console.log('Last Week Sales:', data.daily_sales_last);
                console.log(chartOptions);

                // Update the 'data' arrays in the 'series' section of chartOptions
                chartOptions.series[0].data = data.daily_sales_current;
                chartOptions.series[1].data = data.daily_sales_last;
                chartOptions.series[2].data = data.daily_sales_current;

                // Set the updated chart options
                myChart.setOption(chartOptions);
               });


            // Resize chart
            // ------------------------------

            $(function () {

                // Resize chart on menu width change and window resize
                $(window).on('resize', resize);
                $(".menu-toggle").on('click', resize);

                // Resize function
                function resize() {
                    setTimeout(function() {

                        // Resize chart
                        myChart.resize();
                    }, 200);
                }
            });
        }
    );
});

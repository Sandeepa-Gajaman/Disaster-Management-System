$(function() {
    $.ajax({

        url: 'http://localhost:8080/Web App/Incident Reporting App/chartsyear/chartminorlyInjuredwholeYear.php',
        type: 'GET',
        success: function(data) {
            chartData = data;
            var chartProperties = {
                "caption": "Minorly Injured in Whole Year",
                "xAxisName": "Category",
                "yAxisName": "Number of Minorly Injured",
                "rotatevalues": "1",
                "theme": "zune"
            };

            apiChart = new FusionCharts({
                type: 'column3d',
                renderAt: 'chart-container4',
                width: '550',
                height: '350',
                dataFormat: 'json',
                dataSource: {
                    "chart": chartProperties,
                    "data": chartData
                }
            });
	
            apiChart.render();
        }
    });
});
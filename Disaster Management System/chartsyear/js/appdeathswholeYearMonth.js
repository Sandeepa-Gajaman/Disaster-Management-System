$(function() {
    $.ajax({

        url: 'http://localhost:8080/Web App/Incident Reporting App/chartsyear/chartdeathswholeYearMonth.php',
        type: 'GET',
        success: function(data) {
            chartData = data;
            var chartProperties = {
                "caption": "Monthly Deaths",
                "xAxisName": "Month",
                "yAxisName": "Deaths count",
                "rotatevalues": "1",
                "theme": "zune"
            };

            apiChart = new FusionCharts({
                type: 'bar3d',
                renderAt: 'chart-container5',
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
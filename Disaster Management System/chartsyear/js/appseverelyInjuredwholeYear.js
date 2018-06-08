$(function() {
    $.ajax({

        url: 'http://localhost:8080/Web App/Incident Reporting App/chartsyear/chartseverelyInjuredwholeYear.php',
        type: 'GET',
        success: function(data) {
            chartData = data;
            var chartProperties = {
                "caption": "Severely Injured in Whole Year",
                "xAxisName": "Category",
                "yAxisName": "Number of Severely Injured",
                "rotatevalues": "1",
                "theme": "zune"
            };

            apiChart = new FusionCharts({
                type: 'column3d',
                renderAt: 'chart-container3',
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